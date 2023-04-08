<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AgentService extends Model
{
    protected $fillable=['name','hospital_id'];
    use HasFactory;
    public function patients(): HasMany
    {
        return $this->hasMany(AgentPatient::class);
    }
    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }
}
