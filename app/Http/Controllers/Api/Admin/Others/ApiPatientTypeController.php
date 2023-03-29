<?php

namespace App\Http\Controllers\Api\Admin\Others;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\Others\PatientTypeRepository;
use App\Http\Resources\PatientTypeResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiPatientTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $types = (new PatientTypeRepository())->get();
            return PatientTypeResource::collection($types);
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
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            $inputs['name'] = $request->name;
            $type = (new PatientTypeRepository())->create($inputs);
            $response = [
                'success' => true,
                'message' => 'TYpe patient added successfull',
                'type' => new PatientTypeResource($type)
            ];
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
            $type = (new PatientTypeRepository())->show($id);
            return new PatientTypeResource($type);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            $inputs['name'] = $request->name;
            $type = (new PatientTypeRepository())->update($id, $inputs);
            $response = [
                'success' => true,
                'message' => 'TYpe patient updated successfull',
                'type' => new PatientTypeResource($type)
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
            $type = $this->show($id);
            if (
                $type->patientSubscribers->isEmpty() && $type->agentPatients->isEmpty()
            ) {
                $status=(new PatientTypeRepository())->delete($id);
                $response = [
                    'success' => $status,
                    'message' => 'Type patient deleted successfull',
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Action faild this type patient take data',
                ];
            }
            return response()->json($response);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }
}
