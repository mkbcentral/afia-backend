<?php

namespace App\Http\Controllers\Api\Admin\Hospital;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\Hospital\HospitalRepository;
use App\Http\Resources\HospitalResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiHospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $hospitals = (new HospitalRepository())->get();
            return HospitalResource::collection($hospitals);
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
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'logo' => 'string|nullable',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            $inputs['name'] = $request->name;
            $inputs['email'] = $request->email;
            $inputs['phone'] = $request->phone;
            $inputs['logo'] = $request->logo;
            $hospital = (new HospitalRepository())->create($inputs);
            $response = [
                'success' => true,
                'message' => 'Hospital added successfull',
                'hospital' => new HospitalResource($hospital)
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
            $hospital = (new HospitalRepository())->show($id);
            return new HospitalResource($hospital);
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
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            $inputs['name'] = $request->name;
            $inputs['email'] = $request->email;
            $inputs['phone'] = $request->phone;
            $hospital = (new HospitalRepository())->update($id, $inputs);
            $response = [
                'success' => true,
                'message' => 'Hospital updated successfull',
                'hospital' => new HospitalResource($hospital)
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
            $hospital = $this->show($id);
            if ($hospital->users->isEmpty() && $hospital->status == "ENABLE") {
                $response = [
                    'success' => false,
                    'message' => 'Action faild this hosp take data',
                ];
            } else {
                $status = (new HospitalRepository())->delete($id);
                $response = [
                    'success' => $status,
                    'message' => 'Hospital deleted successfull',
                ];
            }
            return response()->json($response);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    //Change status
    public function changeStatus(int $id, Request $request)
    {
        try {
            (new HospitalRepository())->changeStatus($id, $request->status);
            $response = [
                'success' => true,
                'message' => 'Status hospital changed'
            ];
            return response()->json($response, 200);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }
    //Update logo
    public function updateLogo($id, Request $request)
    {
        try {
            $response = [
                'path' => $request->logo
            ];
            return response()->json($response);
        } catch (Exception $ex) {
            $response = [
                'success' => false,
                'message' => $ex->getMessage()
            ];
            return response()->json($response);
        }
    }
}
