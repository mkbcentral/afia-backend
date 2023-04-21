<?php

namespace App\Http\Controllers\Api\Invoices\Other;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Invoices\Others\OtherInvoiceRepository;
use App\Http\Resources\OtherInvoiceResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiOtherInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $invoices=(new OtherInvoiceRepository())->get();
            return OtherInvoiceResource::collection($invoices);
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
            'name' => 'nullable|string',
            'genger' => 'nullable|string',
            'date_of_birth' => 'nullable|string|date',
            'email' => 'nullable|string',
            'phone' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            if ($request->form_id != null) {
                $inputs['type_other_invoice_id'] = $request->type_other_invoice_id;
                $inputs['form_patient_id'] = $request->form_patient_id;
            }else{
                $inputs['name'] = $request->name;
                $inputs['genger'] = $request->genger;
                $inputs['date_of_birth'] = $request->date_of_birth;
                $inputs['email'] = $request->email;
                $inputs['phone'] = $request->phone;
                $inputs['type_other_invoice_id'] = $request->type_other_invoice_id;
            }
            $invoice = (new OtherInvoiceRepository())->create($inputs);
            $response = [
                'success' => true,
                'message' => 'Invoice added successfull',
                'invoice' => new OtherInvoiceResource($invoice)
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
            $invoice=(new OtherInvoiceRepository())->show($id);
            return new OtherInvoiceResource($invoice);
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
            'name' => 'nullable|string',
            'genger' => 'nullable|string',
            'date_of_birth' => 'nullable|string|date',
            'email' => 'nullable|string',
            'phone' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            if ($request->form_id != null) {
                $inputs['type_other_invoice_id'] = $request->type_other_invoice_id;
                $inputs['form_patient_id'] = $request->form_patient_id;
            }else{
                $inputs['name'] = $request->name;
                $inputs['genger'] = $request->genger;
                $inputs['date_of_birth'] = $request->date_of_birth;
                $inputs['email'] = $request->email;
                $inputs['phone'] = $request->phone;
                $inputs['type_other_invoice_id'] = $request->type_other_invoice_id;
            }
            $invoice = (new OtherInvoiceRepository())->update($id,$inputs);
            $response = [
                'success' => true,
                'message' => 'Invoice added successfull',
                'invoice' => new OtherInvoiceResource($invoice)
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
        //
    }
}
