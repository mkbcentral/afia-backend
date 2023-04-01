<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable=[
<<<<<<< HEAD
        'name',
        'amount',
        'familly_quota',
        'hospital_id'
=======
        'name','amount','familly_quota','hospital_id'
>>>>>>> fecc3dd15dc169715bcf6ee1b0e4de856c42f29a
    ];
    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }
}
