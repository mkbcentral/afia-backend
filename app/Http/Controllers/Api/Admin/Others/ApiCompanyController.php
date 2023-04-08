<?php

namespace App\Http\Controllers\Api\Admin\Others;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Admin\Others\CompanyRepository;
use App\Http\Resources\CompanyResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $companies=(new CompanyRepository())->get();
            return CompanyResource::collection($companies);
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
            'subscription_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $inputs['name']=$request->name;
            $inputs['subscription_id']=$request->subscription_id;
            $company=(new CompanyRepository())->create($inputs);
            $response = [
                'success' => true,
                'message' => 'Company added successfull',
                'company'=>NEW CompanyResource($company)
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
            $company=(new CompanyRepository())->show($id);
            return new CompanyResource($company);
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
            'subscription_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            $inputs['name']=$request->name;
            $inputs['subscription_id']=$request->subscription_id;
            $company=(new CompanyRepository())->update($id,$inputs);
            $response = [
                'success' => true,
                'message' => 'Company updated successfull',
                'company'=>$company
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
            $company=$this->show($id);
            if ($company->patientSubscribers->isEmpty()) {
                $status=(new CompanyRepository())->delete($id);
                $response = [
                    'success' => $status,
                    'message' => 'Companyu deleted successfull',
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Action fail
                    d this commune take data',
                ];
            }
            return response()->json($response);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }
}
