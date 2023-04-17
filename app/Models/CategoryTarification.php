<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryTarification extends Model
{
    use HasFactory;
    protected $fillable=['name','price_private','price_subscribe','hospital_id'];

    /**
     * Get the user that owns the CategoryTarification
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }
    /**
     * Get all of the tarifications for the CategoryTarification
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tarifications(): HasMany
    {
        return $this->hasMany(Tarification::class);
    }
}
