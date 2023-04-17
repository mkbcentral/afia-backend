<?php

namespace App\Http\Controllers\Api\Admin\Hospital;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\Hospital\FormPatientRepository;
use App\Http\Repositories\Admin\Hospital\PatientSubscribeRepository;
use App\Http\Repositories\Others\FormPatientNumberFormat;
use App\Http\Requests\PatientSubscribeRequest;
use App\Http\Resources\PatientSubscribeResource;
use Exception;

class ApiPatientSubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $patients = (new PatientSubscribeRepository())->get();
            return PatientSubscribeResource::collection($patients);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PatientSubscribeRequest $request)
    {

        try {
            //Create first form
            $inputs['number'] = (new FormPatientNumberFormat())->getFormPrivateNumber();

            //Create Patient
            $inputs['name'] = $request->name;
            $inputs['gender'] = $request->gender;
            $inputs['date_of_birth'] = $request->date_of_birth;
            $inputs['phone'] = $request->phone;
            $inputs['other_phone'] = $request->other_phone;
            $inputs['quartier'] = $request->quartier;
            $inputs['street'] = $request->street;
            $inputs['parcel_number'] = $request->parcel_number;
            $inputs['commune_id'] = $request->commune_id;
            $inputs['company_id'] = $request->company_id;
            $inputs['patient_type_id'] = $request->patient_type_id;
            $inputs['registration_number'] = $request->registration_number;
            $patient = (new PatientSubscribeRepository())->create($inputs);
            if ($patient) {
                $form = (new FormPatientRepository())->create($inputs);
                $patient->form_patient_id=$form->id;
                $patient->update();
                $response = [
                    'success' => true,
                    'message' => 'Patient added successfull',
                    'patient' => new PatientSubscribeResource($patient)
                ];
            }
            return response()->json($response, 200);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $patient = (new PatientSubscribeRepository())->show($id);
            return new PatientSubscribeResource($patient);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(PatientSubscribeRequest $request, string $id)
    {
        try {
            $inputs['name'] = $request->name;
            $inputs['gender'] = $request->gender;
            $inputs['date_of_birth'] = $request->date_of_birth;
            $inputs['phone'] = $request->phone;
            $inputs['other_phone'] = $request->other_phone;
            $inputs['quartier'] = $request->quartier;
            $inputs['parcel_number'] = $request->parcel_number;
            $inputs['street'] = $request->street;
            $inputs['commune_id'] = $request->commune_id;
            $inputs['company_id'] = $request->company_id;
            $inputs['patient_type_id'] = $request->patient_type_id;
            $inputs['registration_number'] = $request->registration_number;
            $patient = (new PatientSubscribeRepository())->update($id, $inputs);
            $response = [
                'success' => true,
                'message' => 'Patient updated successfull',
                'patient' => new PatientSubscribeResource($patient)
            ];
            return response()->json($response, 200);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $patient = $this->show($id);
            $status = (new PatientSubscribeRepository())->delete($id);
            $response = [
                'success' => $status,
                'message' => 'Patient deleted successfull',
            ];
            $patient->formPatient->delete();
            return response()->json($response);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    //Search user
    public function searchPatient()
    {
        $searchQuery = request('query');
        try {
            $patients = (new PatientSubscribeRepository())->search($searchQuery);
            return PatientSubscribeResource::collection($patients);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }
}
