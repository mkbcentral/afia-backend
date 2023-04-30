<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tarification extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'abreviation',
        'price_private',
        'price_subscribe',
        'hospital_id',
        'category_tarification_id'
    ];
    /**
     * Get the Hospital that owns the CategoryTarification
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }
    /**
     * Get the Category that owns the CategoryTarification
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryTarification::class, 'category_tarification_id');
    }

     /**
     * The roles that belong to the PatientPrivate
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function privateInvoices(): BelongsToMany
    {
        return $this->belongsToMany(InvoicePrivate::class, 'invoice_private_tarification', 'invoice_private_id', 'tarification_id')
                    ->withPivot(['id','qty']);
    }
}
