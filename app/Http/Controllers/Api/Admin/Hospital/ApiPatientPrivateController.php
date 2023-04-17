<?php

namespace App\Http\Controllers\Api\Admin\Hospital;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\Hospital\FormPatientRepository;
use App\Http\Repositories\Admin\Hospital\PatientPrivateRepository;
use App\Http\Repositories\Others\FormPatientNumberFormat;
use App\Http\Requests\PatientPrivateRequest;
use App\Http\Resources\PatientPrivateResource;
use Exception;


class ApiPatientPrivateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $patients = (new PatientPrivateRepository())->get();
            return PatientPrivateResource::collection($patients);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PatientPrivateRequest $request)
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
            $inputs['commune_id'] = $request->commune_id;
            $inputs['parcel_number'] = $request->parcel_number;
            $inputs['quartier'] = $request->quartier;
            $inputs['street'] = $request->street;
            $patient = (new PatientPrivateRepository())->create($inputs);
            if ($patient) {
                $form = (new FormPatientRepository())->create($inputs);
                $patient->form_patient_id=$form->id;
                $patient->update();
                $response = [
                    'success' => true,
                    'message' => 'Patient added successfull',
                    'patient' => new PatientPrivateResource($patient)
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
    public function show(int $id)
    {
        try {
            $patient = (new PatientPrivateRepository())->show($id);
            return new PatientPrivateResource($patient);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PatientPrivateRequest $request, int $id)
    {
        try {
            //Update Patient
            $inputs['name'] = $request->name;
            $inputs['gender'] = $request->gender;
            $inputs['date_of_birth'] = $request->date_of_birth;
            $inputs['phone'] = $request->phone;
            $inputs['other_phone'] = $request->other_phone;
            $inputs['parcel_number'] = $request->parcel_number;
            $inputs['quartier'] = $request->quartier;
            $inputs['street'] = $request->street;
            $inputs['commune_id'] = $request->commune_id;
            $patient = (new PatientPrivateRepository())->update($id, $inputs);
            $response = [
                'success' => true,
                'message' => 'Patient updated successfull',
                'patient' => new PatientPrivateResource($patient)
            ];
            return response()->json($response, 200);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $patient = $this->show($id);
            $status = (new PatientPrivateRepository())->delete($id);
            $patient->formPatient->delete();
            $response = [
                'success' => $status,
                'message' => 'Patient deleted successfull',
            ];
            return response()->json($response);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    //Search user
    public function searchPatient(){
        $searchQuery=request('query');
        try {
            $patients= (new PatientPrivateRepository())->search($searchQuery);
            return PatientPrivateResource::collection($patients);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }
}
