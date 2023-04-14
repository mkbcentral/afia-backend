<?php

namespace App\Http\Controllers\Api\Admin\Hospital;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\Hospital\FormPatientRepository;
use App\Http\Repositories\Admin\Hospital\PatientSubscribeRepository;
use App\Http\Repositories\Others\FormPatientNumberFormat;
use App\Http\Resources\PatientSubscribeResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'gender' => 'required|string',
            'data_of_birth' => 'required|date',
            'phone' => 'nullable|string',
            'other_phone' => 'nullable|string',
            'quartier' => 'nullable|string',
            'parcel_number' => 'nullable|numeric',
            'street' => 'nullable|string',
            'compny_id' => 'nullable|numeric',
            'patient_type_id' => 'nullable|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            //Create first form
            $inputs['number'] = (new FormPatientNumberFormat())->getFormPrivateNumber();
            $form = (new FormPatientRepository())->create($inputs);
            //Create Patient
            $inputs['name'] = $request->name;
            $inputs['gender'] = $request->gender;
            $inputs['data_of_birth'] = $request->data_of_birth;
            $inputs['phone'] = $request->phone;
            $inputs['other_phone'] = $request->other_phone;
            $inputs['quartier'] = $request->quartier;
            $inputs['street'] = $request->street;
            $inputs['parcel_number'] = $request->parcel_number;
            $inputs['commune_id'] = $request->commune_id;
            $inputs['company_id'] = $request->company_id;
            $inputs['patient_type_id'] = $request->patient_type_id;
            $inputs['form_patient_id'] = $form->id;
            $patient = (new PatientSubscribeRepository())->create($inputs);
            $response = [
                'success' => true,
                'message' => 'Patient added successfull',
                'patient' => new PatientSubscribeResource($patient)
            ];
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
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'gender' => 'required|string',
            'data_of_birth' => 'required|date',
            'phone' => 'nullable|string',
            'other_phone' => 'nullable|string',
            'quartier' => 'nullable|string',
            'parcel_number' => 'nullable|numeric',
            'street' => 'nullable|string',
            'compny_id' => 'nullable|numeric',
            'patient_type_id' => 'nullable|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {

            $inputs['name'] = $request->name;
            $inputs['gender'] = $request->gender;
            $inputs['data_of_birth'] = $request->data_of_birth;
            $inputs['phone'] = $request->phone;
            $inputs['other_phone'] = $request->other_phone;
            $inputs['quartier'] = $request->quartier;
            $inputs['parcel_number'] = $request->parcel_number;
            $inputs['street'] = $request->street;
            $inputs['commune_id'] = $request->commune_id;
            $inputs['company_id'] = $request->company_id;
            $inputs['patient_type_id'] = $request->patient_type_id;
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
}
