<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class InvoiceSubscribe extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * Get the hospital that owns the OtherInvoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }
    /**
     * Get the branch that owns the OtherInvoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    /**
     * Get the formPatient that owns the OtherInvoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function formPatient(): BelongsTo
    {
        return $this->belongsTo(FormPatient::class, 'form_patient_id');
    }
    /**
     * Get the user that owns the OtherInvoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    /**
     * Get the rate that owns the OtherInvoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rate(): BelongsTo
    {
        return $this->belongsTo(Rate::class, 'rate_id');
    }
    /**
     * Get the currency that owns the OtherInvoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
    /**
     * Get the company that owns the InvoiceSubscribe
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    /**
     * Get the consultation that owns the InvoiceSubscribe
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function consultation(): BelongsTo
    {
        return $this->belongsTo(Consultation::class, 'consultation_id');
    }

    public function tarifications(): BelongsToMany
    {
        return $this->belongsToMany(Tarification::class,'invoice_subscribe_tarification', 'invoice_subscribe_id', 'tarification_id')
        ->withPivot(['id','qty']);
    }

    public  function  getAmountInvoice($id){
        $invoice=InvoiceSubscribe::find($id);
        $amount_cons=$invoice->consultation->price_subscribe;
        $items_invoice=DB::table('invoice_subscribe_tarification')->where('invoice_subscribe_id',$invoice->id)
            ->join(
                'tarifications',
                'tarifications.id','=',
                'invoice_subscribe_tarification.tarification_id'
            )
            ->join(
                'category_tarifications',
                'category_tarifications.id','=',
                'tarifications.category_tarification_id'
            )
            ->select(
                'category_tarifications.name as category',
                'invoice_subscribe_tarification.id',
                'tarifications.name',
                'tarifications.price_subscribe',
                'invoice_subscribe_tarification.qty'
            )
            ->groupBy(
                'category',
                'invoice_subscribe_tarification.id',
                'tarifications.name',
                'tarifications.price_subscribe',
                'invoice_subscribe_tarification.qty'
            )
            ->get();
        $groupedItems = [];
        $total_invoice=0;
        foreach ($items_invoice as $item) {
            $total_invoice+=$item->price_subscribe*$item->qty;
        }
        return request('currency')=='CDF'
                ?($total_invoice+$amount_cons)*$invoice->rate->amount
                :$total_invoice+$amount_cons;
    }

}
