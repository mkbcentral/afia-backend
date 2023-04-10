<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FormPatient extends Model
{
    use HasFactory;

    protected $fillable=['hospital_id','number','branch_id','user_id'];

    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function patientSubscriber(): HasOne
    {
        return $this->hasOne(PatientSubscribe::class);
    }

    public function agentPatient(): HasOne
    {
        return $this->hoasOne(AgentPatient::class);
    }

    public function patientPrivate(): HasOne
    {
        return $this->hasOne(PatientPrivate::class);
    }
}
