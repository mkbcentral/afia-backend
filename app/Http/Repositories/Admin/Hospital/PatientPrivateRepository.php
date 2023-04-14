<?php

namespace App\Http\Repositories\Admin\Hospital;

use App\Models\patient;
use App\Models\PatientPrivate;
use Illuminate\Support\Facades\Auth;

class PatientPrivateRepository
{
    //Get all patients
    public function get()
    {
        $patients = PatientPrivate::join('form_patients', 'form_patients.id', '=', 'patient_privates.form_patient_id')
            ->select('patient_privates.*')
            ->where('form_patients.hospital_id', auth()->user()->hospital->id)
            ->where('form_patients.branch_id', auth()->user()->branch->id)
            ->orderBy('form_patients.number', 'DESC')
            ->get();
        return $patients;
    }
    //Create new patient
    public function create(array $inputs): PatientPrivate
    {
        $patient = PatientPrivate::create([
            'name' => $inputs['name'],
            'gender' => $inputs['gender'],
            'data_of_birth' => $inputs['data_of_birth'],
            'phone' => $inputs['phone'],
            'other_phone' => $inputs['other_phone'],
            'quartier' => $inputs['quartier'],
            'street' => $inputs['street'],
            'parcel_number' => $inputs['parcel_number'],
            'commune_id' => $inputs['commune_id'],
            'form_patient_id' => $inputs['form_patient_id'],
        ]);
        return $patient;
    }
    //Show spécific user
    public function show(int $id): PatientPrivate
    {
        $patient = PatientPrivate::find($id);
        return $patient;
    }

    //Update Specific patient
    public function update(int $id, array $inputs): PatientPrivate
    {
        $patient = $this->show($id);
        $patient->name = $inputs['name'];
        $patient->gender = $inputs['gender'];
        $patient->data_of_birth = $inputs['data_of_birth'];
        $patient->phone = $inputs['phone'];
        $patient->other_phone = $inputs['other_phone'];
        $patient->quartier = $inputs['quartier'];
        $patient->street = $inputs['street'];
        $patient->commune_id = $inputs['commune_id'];
        $patient->parcel_number = $inputs['parcel_number'];
        $patient->update();
        return $patient;
    }
    //Delete Specific patient
    public function delete(int $id): bool
    {
        $patient = $this->show($id);
        if ($patient->delete()) {
            $status = true;
        }
        return $status;
    }
}
