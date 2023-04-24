<?php

namespace App\Http\Controllers\Api\Invoices;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Invoices\InvoiceItemsRepository;
use App\Models\InvoicePrivate;
use App\Models\InvoiceSubscribe;
use App\Models\OtherInvoice;
use App\Models\OtherInvoiceSubscribe;
use Exception;
use Illuminate\Http\Request;

class ApiItemsInvoiceController extends Controller
{
    //Create invoice private itmes
    public function createInvoicePrivateItems(Request $request,$id)
    {
        try {
            $invoice = InvoicePrivate::find($id);
            $data = [
                [
                    'invoice_private_id' => $request->id,
                    'tarification_id' => 1
                ],
                [
                    'invoice_private_id' => $request->id,
                    'tarification_id' => 2
                ],
                [
                    'invoice_private_id' => $request->id,
                    'tarification_id' => 3
                ]
            ];
            (new InvoiceItemsRepository())->createInvoiceLines('invoice_private_tarification',$data);
            $response = [
                'success' => true,
                'message' => 'Items invoice added successfull',
            ];
            return response()->json($response, 200);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }
    //Create invoice subscribe itmes
    public function createInvoicesSubscribeItems(Request $request,$id)
    {
        try {
            $invoice = InvoiceSubscribe::find($id);
            $data = [
                [
                    'invoice_subscribe_id' => $invoice->id,
                    'tarification_id' => 1
                ],
                [
                    'invoice_subscribe_id' => $invoice->id,
                    'tarification_id' => 2
                ],
                [
                    'invoice_subscribe_id' => $invoice->id,
                    'tarification_id' => 3
                ]
            ];
            (new InvoiceItemsRepository())->createInvoiceLines('invoice_subscribe_tarification',$data);
            $response = [
                'success' => true,
                'message' => 'Items invoice added successfull',
            ];
            return response()->json($response, 200);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }
    //Create other invoice  itmes
    public function createOtherInvoiceItems(Request $request,$id)
    {
        try {
            $invoice = OtherInvoice::find($id);
            $data = [
                [
                    'other_invoice_id' => $invoice->id,
                    'tarification_id' => 1
                ],
                [
                    'other_invoice_id' => $invoice->id,
                    'tarification_id' => 2
                ],
                [
                    'other_invoice_id' => $invoice->id,
                    'tarification_id' => 3
                ]
            ];
            (new InvoiceItemsRepository())->createInvoiceLines('other_invoice_tarification',$data);
            $response = [
                'success' => true,
                'message' => 'Items invoice added successfull',
            ];
            return response()->json($response, 200);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }
    //Create invoice private itmes
    public function createOtherInvoiceSubscribeItems(Request $request,$id)
    {
        try {
            $invoice = OtherInvoiceSubscribe::find($id);
            $data = [
                [
                    'other_invoice_subscribe_id' => $invoice->id,
                    'tarification_id' => 1
                ],
                [
                    'other_invoice_subscribe_id' => $invoice->id,
                    'tarification_id' => 2
                ],
                [
                    'other_invoice_subscribe_id' => $invoice->id,
                    'tarification_id' => 3
                ]
            ];
            (new InvoiceItemsRepository())->createInvoiceLines('other_invoice_subscribe_tarification',$data);
            $response = [
                'success' => true,
                'message' => 'Items invoice added successfull',
            ];
            return response()->json($response, 200);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    public function deleIvoiceItem(Request $request,$id){
        //return $request;
        try {
            (new InvoiceItemsRepository())->deleteItemInvoice($id,$request->table);
            $response = [
                'success' => true,
                'message' => 'Items invoice deleted successfull',
            ];
            return response()->json($response, 200);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

    public function  updateQtyInvoiceItem(Request $request,$id){
        //return $request;
        try {
            (new InvoiceItemsRepository())->udateItemInvoiceQty($id,$request->table,$request->qty);
            $response = [
                'success' => true,
                'message' => 'Qty invoice updated successfull',
            ];
            return response()->json($response, 200);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }


}
