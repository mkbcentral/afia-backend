<?php

namespace App\Http\Repositories\Admin\Hospital;

use App\Models\PatientSubscribe;
use Illuminate\Support\Facades\Auth;

class PatientSubscribeRepository
{
    //Get all patient
    public function get()
    {
        $page=request('page_page');
        $patients = PatientSubscribe::join('form_patients', 'form_patients.id', '=', 'patient_subscribes.form_patient_id')
            ->select('patient_subscribes.*')
            ->where('form_patients.hospital_id', auth()->user()->hospital->id)
            ->where('form_patients.branch_id', auth()->user()->branch->id)
            ->orderBy('form_patients.number', 'DESC')
            ->paginate($page);
        return $patients;
    }
    //Create patient
    public function create(array $inputs): PatientSubscribe
    {
        $patient = PatientSubscribe::create([
            'name' => $inputs['name'],
            'gender' => $inputs['gender'],
            'date_of_birth' => $inputs['date_of_birth'],
            'phone' => $inputs['phone'],
            'other_phone' => $inputs['other_phone'],
            'email' => $inputs['email'],
            'quartier' => $inputs['quartier'],
            'parcel_number' => $inputs['parcel_number'],
            'street' => $inputs['street'],
            'commune_id' => $inputs['commune_id'],
            'patient_type_id' => $inputs['patient_type_id'],
            'company_id' => $inputs['company_id'],
            'registration_number' => $inputs['registration_number'],
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
        $patient->date_of_birth = $inputs['date_of_birth'];
        $patient->phone = $inputs['phone'];
        $patient->other_phone = $inputs['other_phone'];
        $patient->quartier = $inputs['quartier'];
        $patient->street = $inputs['street'];
        $patient->parcel_number = $inputs['parcel_number'];
        $patient->commune_id = $inputs['commune_id'];
        $patient->patient_type_id = $inputs['patient_type_id'];
        $patient->company_id = $inputs['company_id'];
        $patient->registration_number = $inputs['registration_number'];
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

    //Search user
    public function search($query)
    {
        $patients = PatientSubscribe::join('form_patients', 'form_patients.id', '=', 'patient_subscribes.form_patient_id')
            ->select('patient_subscribes.*')
            ->where('form_patients.hospital_id', auth()->user()->hospital->id)
            ->where('form_patients.branch_id', auth()->user()->branch->id)
            ->orderBy('form_patients.number', 'DESC')
            ->where('patient_subscribes.name', 'like', "%{$query}%")
            ->get();
        return $patients;
    }
}
