<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'subscription_id',
        'hospital_id',
    ];

    public function patientSubscribers(): HasMany
    {
        return $this->hasMany(PatientSubscribe::class);
    }

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }

    /**
     * Get all of the invoices for the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(InvoiceSubscribe::class);
    }

    /**
     * Get all of the otherInvoices for the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function otherInvoices(): HasMany
    {
        return $this->hasMany(OtherInvoiceSubscribe::class);
    }

}
