<?php

namespace App\Http\Controllers\Api\Invoices\Other;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Invoices\Others\CrudOtherInvoiceRepository;
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
            $invoices=(new CrudOtherInvoiceRepository())->get();
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
            $inputs['name'] = $request->name;
            $inputs['gender'] = $request->gender;
            $inputs['date_of_birth'] = $request->date_of_birth;
            $inputs['email'] = $request->email;
            $inputs['phone'] = $request->phone;
            $inputs['type_other_invoice_id'] = $request->type_other_invoice_id;
            $inputs['form_id'] = $request->form_id;
            $invoice = (new CrudOtherInvoiceRepository())->create($inputs);
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
            $invoice=(new CrudOtherInvoiceRepository())->show($id);
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
            $inputs['name'] = $request->name;
            $inputs['gender'] = $request->gender;
            $inputs['date_of_birth'] = $request->date_of_birth;
            $inputs['email'] = $request->email;
            $inputs['phone'] = $request->phone;
            $inputs['type_other_invoice_id'] = $request->type_other_invoice_id;
            $invoice = (new CrudOtherInvoiceRepository())->update($id,$inputs);
            $response = [
                'success' => true,
                'message' => 'Invoice updated successfull',
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
    public function destroy(int $id)
    {
        try {
            $status=(new CrudOtherInvoiceRepository())->delete($id);
            if ($status==true) {
                $response = [
                    'success' => true,
                    'message' => 'Invoice deleted successfull',
                ];
                return response()->json($response, 200);
            }else{
                $response = [
                    'success' => false,
                    'message' => 'Action faild',
                ];
                return response()->json($response);
            }
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

     //Enable specific status column
     public function enableStatus(Request $request, int $id)
     {
         try {
             (new CrudOtherInvoiceRepository())
                 ->enableStatusInvoice($id, 'other_invoices', $request->column_name);
             $response = [
                 'success' => true,
                 'message' => 'Status changed successfull',
             ];
             return response()->json($response);
         } catch (Exception $ex) {
             return response()->json(['errors' => $ex->getMessage()]);
         }
     }
     //Disable specific status column
     public function disablleStatus(Request $request, int $id)
     {
         try {
             (new CrudOtherInvoiceRepository())
                 ->disableStatusInvoice($id, 'other_invoices', $request->column_name);
             $response = [
                 'success' => true,
                 'message' => 'Status changed successfull',
             ];
             return response()->json($response);
         } catch (Exception $ex) {
             return response()->json(['errors' => $ex->getMessage()]);
         }
     }
}
