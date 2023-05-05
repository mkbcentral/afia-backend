<?php

namespace App\Http\Repositories\Invoices;

use App\Http\Actions\InvoiActions;
use App\Models\InvoicePrivate;
use Illuminate\Support\Facades\DB;

class InvoicePrivateRepository extends InvoiActions{
    //Get all invoices
    public function get()
    {
        $invoices = InvoicePrivate::where('hospital_id', auth()->user()->hospital->id)
            ->where('branch_id',auth()->user()->branch->id)
            ->whereMonth('created_at',date('m'))
            ->orderBy('created_at', 'asc')
            ->get();
        return $invoices;
    }
    public function createInvoice($invoice_number,$form_patient_id,$consultation_id,$rate_id,$currency_id):InvoicePrivate{

        $invoice=InvoicePrivate::create([
            'invoice_number'=>$invoice_number,
            'hospital_id'=>auth()->user()->hospital->id,
            'branch_id'=>auth()->user()->branch->id,
            'form_patient_id'=>$form_patient_id,
            'consultation_id'=>$consultation_id,
            'user_id'=>auth()->user()->id,
            'rate_id'=>$rate_id,
            'currency_id'=>$currency_id,
        ]);
        return $invoice;
    }
    public function checkPatientExistInvoiceInCurrectMonth($form_id){
        $invoice=InvoicePrivate::where('form_patient_id',$form_id)
            ->whereMonth('created_at',date('m'))->first();
        return $invoice;
    }



    public function show(int $id):InvoicePrivate{
        return InvoicePrivate::find($id);
    }
    public function getInvoiceItem($id)
    {
        $invoice=InvoicePrivate::find($id);
        $consultation=$invoice->consultation;
        $items_invoice=DB::table('invoice_private_tarification')->where('invoice_private_id',$invoice->id)
            ->join(
                'tarifications',
                'tarifications.id','=',
                'invoice_private_tarification.tarification_id'
            )
            ->join(
                'category_tarifications',
                'category_tarifications.id','=',
                'tarifications.category_tarification_id'
            )
            ->select(
                'category_tarifications.name as category',
                'invoice_private_tarification.id',
                'tarifications.name',
                'tarifications.price_private',
                'invoice_private_tarification.qty'
            )
            ->groupBy(
                'category',
                'invoice_private_tarification.id',
                'tarifications.name',
                'tarifications.price_private',
                'invoice_private_tarification.qty'
            )
            ->get();
        $groupedItems = [];
        $total_invoice=0;
        foreach ($items_invoice as $item) {
            $category = $item->category;
            // Si la clé de catégorie n'existe pas encore dans le tableau, on l'initialise
            if (!isset($groupedItems[$category])) {
                $groupedItems[$category] = ['data'=>[]];
            }
            // Ajouter l'élément au tableau associatif pour cette catégorie
            $groupedItems[$category]['data'][] =[
                'id' => $item->id,
                'name' => $item->name,
                'qty' => $item->qty,
                'price' => request('currency')=='CDF'
                    ? number_format($item->price_private*$invoice->rate->amount, 1, ',', ' ')
                    :number_format($item->price_private, 1, ',', ' '),
                'total'=>
                    request('currency')=='CDF'
                        ?number_format($item->price_private*$item->qty*$invoice->rate->amount, 1, ',', ' ')
                        :number_format($item->price_private*$item->qty, 1, ',', ' ')
            ];
            $total_invoice+=$item->price_private*$item->qty;
        }
        return [
            'total_invoice'=>request('currency')=='CDF'
                ?number_format(($total_invoice+$consultation->price_private)*$invoice->rate->amount, 1, ',', ' ')
                :number_format($total_invoice+$consultation->price_private, 1, ',', ' '),
            'consultation'=>[
                'name'=>$consultation->name,
                'amount'=>request('currency')=='CDF'
                        ?number_format($consultation->price_private*$invoice->rate->amount, 1, ',', ' ')
                        :number_format( $consultation->price_private, 1, ',', ' ')
            ],
            'data'=>$groupedItems,
        ];
    }
}
