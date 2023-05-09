<?php

namespace App\Http\Repositories\Invoices;

use App\Http\Actions\InvoiActions;
use App\Models\InvoiceSubscribe;

class InvoiceSubscribeRepository extends InvoiActions{
    //Get all invoices
    public function get()
    {
        $invoices = InvoiceSubscribe::where('hospital_id', auth()->user()->hospital->id)
            ->where('branch_id',auth()->user()->branch->id)
            ->whereYear('created_at',date('Y'))
            //->orderBy('patient_name', 'asc')
            ->get();
        return $invoices;
    }
    public function createInvoice($invoice_number,$form_patient_id,$consultation_id,$rate_id,$currency_id,$company_id):InvoiceSubscribe{

        $invoice=InvoiceSubscribe::create([
            'invoice_number'=>$invoice_number,
            'hospital_id'=>auth()->user()->hospital->id,
            'branch_id'=>auth()->user()->branch->id,
            'form_patient_id'=>$form_patient_id,
            'consultation_id'=>$consultation_id,
            'user_id'=>auth()->user()->id,
            'rate_id'=>$rate_id,
            'currency_id'=>$currency_id,
            'company_id'=>$company_id,
        ]);
        return $invoice;
    }

    public function checkPatientExistInvoiceInCurrectMonth($form_id,$company_id){
        $invoice=InvoiceSubscribe::where('form_patient_id',$form_id)
            ->where('company_id',$company_id)
            ->whereMonth('created_at',date('m'))
            ->first();
        return $invoice;
    }
}
