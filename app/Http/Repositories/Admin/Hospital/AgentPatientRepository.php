<?php

namespace App\Http\Repositories\Admin\Hospital;

use App\Models\AgentPatient;
use Illuminate\Support\Facades\Auth;

class AgentPatientRepository
{
    //Get all patient
    public function get()
    {
        $patients = AgentPatient::orderBy('name', 'asc')->get();
        return $patients;
    }
    //Create patient
    public function create(array $inputs): AgentPatient
    {
        $patient = AgentPatient::create([
            'name' => $inputs['name'],
            'gender' => $inputs['gender'],
            'data_of_birth' => $inputs['data_of_birth'],
            'phone' => $inputs['phone'],
            'other_phone' => $inputs['other_phone'],
            'quartier' => $inputs['quartier'],
            'street' => $inputs['street'],
            'commune_id' => $inputs['commune_id'],
            'patient_type_id' => $inputs['patient_type_id'],
            'agent_service_id' => $inputs['agent_service_id'],
            'form_patient_id' => $inputs['form_patient_id'],
        ]);
        return $patient;
    }
    //Show spécific user
    public function show(int $id): AgentPatient
    {
        $patient = AgentPatient::find($id);
        return $patient;
    }

    //Update Specific patient
    public function update(int $id, array $inputs): AgentPatient
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
        $patient->agent_service_id = $inputs['agent_service_id'];

        $patient->update();
        return $patient;
    }
    //Delete patient
    public function delete(int $id):bool{
        $patient= $this->show($id);
        if ($patient->delete()) {
             $status=true;
        }
        return $status;
     }
}
