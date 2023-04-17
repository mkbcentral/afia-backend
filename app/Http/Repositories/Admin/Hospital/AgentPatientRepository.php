<?php

namespace App\Http\Repositories\Admin\Hospital;

use App\Models\AgentPatient;
use Illuminate\Support\Facades\Auth;

class AgentPatientRepository
{
    //Get all patient
    public function get()
    {
        $page=request('page_page');
        $patients = AgentPatient::join('form_patients', 'form_patients.id', '=', 'agent_patients.form_patient_id')
            ->select('agent_patients.*')
            ->where('form_patients.hospital_id', auth()->user()->hospital->id)
            ->where('form_patients.branch_id', auth()->user()->branch->id)
            ->orderBy('form_patients.number', 'DESC')
            ->paginate($page);
        return $patients;
    }
    //Create patient
    public function create(array $inputs): AgentPatient
    {
        $patient = AgentPatient::create([
            'name' => $inputs['name'],
            'gender' => $inputs['gender'],
            'date_of_birth' => $inputs['date_of_birth'],
            'phone' => $inputs['phone'],
            'other_phone' => $inputs['other_phone'],
            'quartier' => $inputs['quartier'],
            'street' => $inputs['street'],
            'parcel_number' => $inputs['parcel_number'],
            'commune_id' => $inputs['commune_id'],
            'patient_type_id' => $inputs['patient_type_id'],
            'agent_service_id' => $inputs['agent_service_id'],
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
        $patient->date_of_birth = $inputs['date_of_birth'];
        $patient->phone = $inputs['phone'];
        $patient->other_phone = $inputs['other_phone'];
        $patient->quartier = $inputs['quartier'];
        $patient->street = $inputs['street'];
        $patient->parcel_number = $inputs['parcel_number'];
        $patient->commune_id = $inputs['commune_id'];
        $patient->patient_type_id = $inputs['patient_type_id'];
        $patient->agent_service_id = $inputs['agent_service_id'];
        $patient->update();
        return $patient;
    }
    //Delete patient
    public function delete(int $id): bool
    {
        $patient = $this->show($id);
        if ($patient->delete()) {
            $status = true;
        }
        return $status;
    }

    //Search user
    public function search($query)
    {
        $patients = AgentPatient::join('form_patients', 'form_patients.id', '=', 'agent_patients.form_patient_id')
            ->select('agent_patients.*')
            ->where('form_patients.hospital_id', auth()->user()->hospital->id)
            ->where('form_patients.branch_id', auth()->user()->branch->id)
            ->orderBy('form_patients.number', 'DESC')
            ->where('agent_patients.name', 'like', "%{$query}%")
            ->get();
        return $patients;
    }
}
