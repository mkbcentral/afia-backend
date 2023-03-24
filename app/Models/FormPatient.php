<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormPatient extends Model
{
    use HasFactory;

    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }


    public function patientSubscribers(): HasMany
    {
        return $this->hasMany(PatientSubscribe::class);
    }

    public function agentPatients(): HasMany
    {
        return $this->hasMany(AgentPatient::class);
    }

    public function patientPrivates(): HasMany
    {
        return $this->hasMany(PatientPrivate::class);
    }
}
