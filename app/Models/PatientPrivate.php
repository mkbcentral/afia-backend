<?php

namespace App\Models;

use App\Http\Repositories\Others\DateFormatHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PatientPrivate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'date_of_birth',
        'phone',
        'other_phone',
        'commune_id',
        'quartier',
        'street',
        'parcel_number',
        'form_patient_id'
    ];

    public function getAge($date)
    {
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

    public function type(): BelongsTo
    {
        return $this->belongsTo(PatientType::class, 'patient_id');
    }

    /**
     * The roles that belong to the PatientPrivate
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tarifications(): BelongsToMany
    {
        return $this->belongsToMany(Tarification::class, 'invoice_private_tarification', 'invoice_private_id', 'tarification_id');
    }
}
