<?php

namespace App\Http\Controllers\Api\Admin\Hospital;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\Hospital\FormPatientRepository;
use App\Http\Repositories\Admin\Hospital\PatientSubscribeRepository;
use App\Http\Repositories\Invoices\InvoiceSubscribeRepository;
use App\Http\Repositories\Others\FormPatientNumberFormat;
use App\Http\Requests\PatientSubscribeRequest;
use App\Http\Resources\PatientSubscribeResource;
use App\Models\Currency;
use App\Models\Rate;
use Exception;
use Illuminate\Http\Request;

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
            $currency=Currency::where('name','CDF')->first();
            $rate=Rate::where('status',true)->first();
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
                (new InvoiceSubscribeRepository())
                ->createInvoice(rand(10,100),$form->id,$request->consultation_id,$rate->id,$currency->id,$request->company_id);
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
    public function update(Request $request, string $id)
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

    //Request consultation
    public function makeConsultation(Request $request){
        try {
            $currency=Currency::where('name','CDF')->first();
            $rate=Rate::where('status',true)->first();
            $invoice=(new InvoiceSubscribeRepository())
                ->checkPatientExistInvoiceInCurrectMonth($request->form_id,$request->company_id);
            if ($invoice) {
                $response = [
                    'success' => false,
                    'message' => 'This patient already has a cosulation for this month',
                ];
            }else{
                (new InvoiceSubscribeRepository())
                    ->createInvoice(rand(10,100),$request->form_id,$request->consultation_id,$rate->id,$currency->id,$request->company_id);
                $response = [
                    'success' => true,
                    'message' => 'Consultation requested successfull',
                ];
            }
            return response()->json($response);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }
}
