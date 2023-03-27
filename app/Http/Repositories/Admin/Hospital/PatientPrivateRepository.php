<?php

namespace App\Http\Repositories\Admin\Hospital;

use App\Models\patient;
use App\Models\PatientPrivate;
use Illuminate\Support\Facades\Auth;

class PatientPrivateRepository
{
    //Get all patient
    public function get()
    {
        $patients = PatientPrivate::orderBy('name', 'asc')->get();
        return $patients;
    }
    //Create patient
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

    //Update Specific
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
        $patient->street = $inputs['commune_id'];
        $patient->update();
        return $patient;
    }
    //Delete role
    public function delete(int $id): bool
    {
        $patient = $this->show($id);
        if ($patient->delete()) {
            $status = true;
        }
        return $status;
    }
}
