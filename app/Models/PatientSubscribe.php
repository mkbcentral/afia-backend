<?php

namespace App\Models;

use App\Http\Repositories\Others\DateFormatHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientSubscribe extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'gender',
        'data_of_birth',
        'phone',
        'other_phone',
        'commune_id',
        'quartier',
        'street',
        'parcel_number',
        'company_id',
        'patient_type_id',
        'form_patient_id'
    ];

    public function getAge($date){
        return (new DateFormatHelper())->getUserAge($date);
    }

    public function commune(): BelongsTo
    {
        return $this->belongsTo(Commune::class, 'commune_id');
    }

    public function formPatient(): BelongsTo
    {
        return $this->belongsTo(FormPatient::class, 'form_patient_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function patientType(): BelongsTo
    {
        return $this->belongsTo(PatientType::class, 'patient_type_id');
    }
}
