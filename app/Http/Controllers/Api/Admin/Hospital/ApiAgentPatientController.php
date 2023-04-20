<?php

namespace App\Http\Controllers\Api\Admin\Hospital;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\Hospital\AgentPatientRepository;
use App\Http\Repositories\Admin\Hospital\FormPatientRepository;
use App\Http\Repositories\Invoices\AgentInvoiceRepository;
use App\Http\Repositories\Others\FormPatientNumberFormat;
use App\Http\Requests\AgentPatientRequest;
use App\Http\Resources\AgentPatientResource;
use App\Models\Currency;
use App\Models\Rate;
use Exception;
use Illuminate\Http\Request;

class ApiAgentPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $patients = (new AgentPatientRepository())->get();
            return AgentPatientResource::collection($patients);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AgentPatientRequest $request)
    {
        try {
            //Create first form
            $inputs['number']=(new FormPatientNumberFormat())->getFormPrivateNumber();
            $currency=Currency::where('name','CDF')->first();
            $rate=Rate::where('status',true)->first();

            $inputs['name'] = $request->name;
            $inputs['gender'] = $request->gender;
            $inputs['date_of_birth'] = $request->date_of_birth;
            $inputs['phone'] = $request->phone;
            $inputs['other_phone'] = $request->other_phone;
            $inputs['quartier'] = $request->quartier;
            $inputs['street'] = $request->street;
            $inputs['parcel_number'] = $request->parcel_number;
            $inputs['commune_id'] = $request->commune_id;
            $inputs['agent_service_id'] = $request->agent_service_id;
            $inputs['patient_type_id'] = $request->patient_type_id;
            $patient = (new AgentPatientRepository())->create($inputs);
            if ($patient) {
                $form=(new FormPatientRepository())->create($inputs);
                $patient->form_patient_id=$form->id;
                (new AgentInvoiceRepository())
                ->createInvoice(
                    rand(10,100),
                    $form->id,
                    $request->consultation_id,
                    $rate->id,
                    $currency->id,
                    $request->agent_service_id);
                $patient->update();
                $response = [
                    'success' => true,
                    'message' => 'Patient added successfull',
                'patient' => new AgentPatientResource($patient)
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
            $patient = (new AgentPatientRepository())->show($id);
            return new AgentPatientResource($patient);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        try {
            $inputs['name'] = $request->name;
            $inputs['gender'] = $request->gender;
            $inputs['date_of_birth'] = $request->date_of_birth;
            $inputs['phone'] = $request->phone;
            $inputs['other_phone'] = $request->other_phone;
            $inputs['quartier'] = $request->quartier;
            $inputs['street'] = $request->street;
            $inputs['parcel_number'] = $request->parcel_number;
            $inputs['commune_id'] = $request->commune_id;
            $inputs['agent_service_id'] = $request->agent_service_id;
            $inputs['patient_type_id'] = $request->patient_type_id;
            $patient = (new AgentPatientRepository())->update($id, $inputs);
            $response = [
                'success' => true,
                'message' => 'Patient updated successfull',
                'patient$patient' => new AgentPatientResource($patient)
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
            $status = (new AgentPatientRepository())->delete($id);
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
            $patients = (new AgentPatientRepository())->search($searchQuery);
            return AgentPatientResource::collection($patients);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }
    //Rquest consultation
    public function makeConsultation(Request $request){
        try {
            $currency=Currency::where('name','CDF')->first();
            $rate=Rate::where('status',true)->first();
            $invoice=(new AgentInvoiceRepository())
            ->checkPatientExistInvoiceInCurrectMonth($request->form_id,$request->agent_service_id);
            if ($invoice) {
                $response = [
                    'success' => false,
                    'message' => 'This patient already has a cosulation for this month',
                ];
            }else{
                (new AgentInvoiceRepository())
                ->createInvoice(
                    rand(10,100),
                    $request->form_id,
                    $request->consultation_id,
                    $rate->id,
                    $currency->id,
                    $request->agent_service_id);
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
