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
            (new HospitalRepository())->create($inputs);
            $response = [
                'success' => true,
                'message' => 'Hospital added successfull'
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
        $inputs['name'] = $request->name;
        $inputs['email'] = $request->email;
        $inputs['phone'] = $request->phone;
        (new HospitalRepository())->update($id, $inputs);
        $response = [
            'success' => true,
            'message' => 'Hospital updated successfull'
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

    //Chang status
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
}
