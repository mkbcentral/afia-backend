<?php

namespace App\Http\Repositories\Admin\Hospital;

use App\Models\PatientSubscribe;
use Illuminate\Support\Facades\Auth;

class PatientSubscribeRepository
{
    //Get all patient
    public function get()
    {
        $patients = PatientSubscribe::orderBy('name', 'asc')->get();
        return $patients;
    }
    //Create patient
    public function create(array $inputs): PatientSubscribe
    {
        $patient = PatientSubscribe::create([
            'name' => $inputs['name'],
            'gender' => $inputs['gender'],
            'data_of_birth' => $inputs['data_of_birth'],
            'phone' => $inputs['phone'],
            'other_phone' => $inputs['other_phone'],
            'quartier' => $inputs['quartier'],
            'street' => $inputs['street'],
            'commune_id' => $inputs['commune_id'],
            'patient_type_id' => $inputs['patient_type_id'],
            'company_id' => $inputs['company_id'],
            'form_patient_id' => $inputs['form_patient_id'],
        ]);
        return $patient;
    }
    //Show spécific user
    public function show(int $id): PatientSubscribe
    {
        $patient = PatientSubscribe::find($id);
        return $patient;
    }

    //Update Specific
    public function update(int $id, array $inputs): PatientSubscribe
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
        $patient->patient_id = $inputs['patient_id'];
        $patient->company_id = $inputs['company_id'];

        $patient->update();
        return $patient;
    }
    //Delete role
    public function delete(int $id):bool{
        $patient= $this->show($id);
        if ($patient->delete()) {
             $status=true;
        }
        return $status;
     }
}
