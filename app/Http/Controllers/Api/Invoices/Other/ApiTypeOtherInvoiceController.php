<?php

namespace App\Http\Controllers\Api\Invoices\Other;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Invoices\Others\OtherInvoiceTypeRepository;
use App\Http\Resources\TypeOtherInvoiceResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiTypeOtherInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $types=(new OtherInvoiceTypeRepository())->get();
            return TypeOtherInvoiceResource::collection($types);
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
            $type = (new OtherInvoiceTypeRepository())->create($inputs);
            $response = [
                'success' => true,
                'message' => 'Type other added successfull',
                'invoice' => new TypeOtherInvoiceResource($type)
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
            $type=(new OtherInvoiceTypeRepository())->show($id);
            return new TypeOtherInvoiceResource($type);
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
            $type = (new OtherInvoiceTypeRepository())->update($id,$inputs);
            $response = [
                'success' => true,
                'message' => 'Type other added successfull',
                'invoice' => new TypeOtherInvoiceResource($type)
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
            $status=(new OtherInvoiceTypeRepository())->delete($id);
            if ($status==true) {
                $response = [
                    'success' => true,
                    'message' => 'Type other deleted successfull',
                ];
            }else{
                $response = [
                    'success' => false,
                    'message' => 'Action fails this type take data !',
                ];
            }
            return response()->json($response, 200);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }
}
