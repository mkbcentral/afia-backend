<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class InvoicePrivate extends Model
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
     * Get the consultation that owns the InvoicePrivate
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function consultation(): BelongsTo
    {
        return $this->belongsTo(Consultation::class, 'consultation_id');
    }

    /**
     * The tarifications that belong to the InvoicePrivate
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tarifications(): BelongsToMany
    {
        return $this->belongsToMany(Tarification::class,'invoice_private_tarification', 'invoice_private_id', 'tarification_id')
        ->withPivot(['id','qty']);
    }

    public  function  getAmountInvoice($id){
        $invoice=InvoicePrivate::find($id);
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
            $total_invoice+=$item->price_private*$item->qty;
        }
        return request('currency')=='CDF'
                ?$total_invoice*$invoice->rate->amount
                :$total_invoice;
    }

}
