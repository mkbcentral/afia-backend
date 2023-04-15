<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Commune extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','hospital_id'
    ];

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
