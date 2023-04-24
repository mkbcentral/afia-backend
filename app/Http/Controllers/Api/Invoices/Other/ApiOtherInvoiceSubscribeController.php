<?php

namespace App\Http\Controllers\Api\Invoices\Other;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Invoices\Others\CrudOtherInvoiceSubscribeRepository;
use App\Http\Resources\OtherInvoiceSubscribeResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiOtherInvoiceSubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $invoices = (new CrudOtherInvoiceSubscribeRepository())->get(request('company_id'));
            return OtherInvoiceSubscribeResource::collection($invoices);
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
            'gender' => 'nullable|string',
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
            $inputs['company_id'] = $request->company_id;
            $inputs['form_id'] = $request->form_patient_id;
            $inputs['company_id'] = $request->company_id;
            $invoice = (new CrudOtherInvoiceSubscribeRepository())->create($inputs);
            $response = [
                'success' => true,
                'message' => 'Invoice added successfull',
                'invoice' => new OtherInvoiceSubscribeResource($invoice)
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
            $invoice = (new CrudOtherInvoiceSubscribeRepository())->show($id);
            return new OtherInvoiceSubscribeResource($invoice);
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
            'gender' => 'nullable|string',
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
            $inputs['company_id'] = $request->company_id;
            $invoice = (new CrudOtherInvoiceSubscribeRepository())->update($id, $inputs);
            $response = [
                'success' => true,
                'message' => 'Invoice updated successfull',
                'invoice' => new OtherInvoiceSubscribeResource($invoice)
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
        try {
            $status = (new CrudOtherInvoiceSubscribeRepository())->delete($id);
            if ($status == true) {
                $response = [
                    'success' => true,
                    'message' => 'Invoice deleted successfull',
                ];
                return response()->json($response, 200);
            } else {
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
             (new CrudOtherInvoiceSubscribeRepository())
                 ->enableStatusInvoice($id, 'other_invoice_subscribes', $request->column_name);
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
             (new CrudOtherInvoiceSubscribeRepository())
                 ->disableStatusInvoice($id, 'other_invoice_subscribes', $request->column_name);
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
