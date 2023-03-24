<?php

namespace App\Http\Controllers\Api\Admin\Others;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\Others\CommuneRepository;
use App\Http\Resources\CommuneResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiCommuneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $communes=(new CommuneRepository())->get();
            return CommuneResource::collection($communes);
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
            $inputs['name']=$request->name;
            $commune=(new CommuneRepository())->create($inputs);
            $response = [
                'success' => true,
                'message' => 'Commune added successfull',
                'commune'=>new CommuneResource($commune)
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
            $commune=(new CommuneRepository())->show($id);
            return new CommuneResource($commune);
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
            $inputs['name']=$request->name;
            $commune=(new CommuneRepository())->update($id,$inputs);
            $response = [
                'success' => true,
                'message' => 'Commune updated successfull',
                'commune'=>new CommuneResource($commune)
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
        $commune=$this->show($id);
        if ($commune->patients->isEmpty()) {
            $status=(new CommuneRepository())->delete($id);
            $response = [
                'success' => $status,
                'message' => 'Commune deleted successfull',
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Action faild this role take data',
            ];
        }
        return response()->json($response);
    }
}
