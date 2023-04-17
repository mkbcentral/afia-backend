<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
