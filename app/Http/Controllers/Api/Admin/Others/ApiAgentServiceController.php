<?php

namespace App\Http\Controllers\Api\Admin\Others;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\Others\AgentServiceRepository;
use App\Http\Resources\AgentServiceResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiAgentServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $services = (new AgentServiceRepository())->get();
            return AgentServiceResource::collection($services);
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
            'hospital_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            $inputs['name'] = $request->name;
            $inputs['hospital_id'] = $request->hospital_id;
            $service = (new AgentServiceRepository())->create($inputs);
            $response = [
                'success' => true,
                'message' => 'Branch added successfull',
                'service' => new AgentServiceResource($service)
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
            $service = (new AgentServiceRepository())->show($id);
            return new AgentServiceResource($service);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $inputs['name'] = $request->name;
        $service = (new AgentServiceRepository())->update($id, $inputs);
        $response = [
            'success' => true,
            'message' => 'Branch updated successfull',
            'service' => new AgentServiceResource($service)
        ];
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
