<?php

namespace App\Http\Controllers\Api\Invoices;

use App\Http\Actions\InvoiActions;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Invoices\InvoiceItemsRepository;
use App\Http\Repositories\Invoices\InvoicePrivateRepository;
use App\Http\Repositories\Invoices\InvoiceSubscribeRepository;
use Exception;
use Illuminate\Http\Request;

class ApiItemsInvoiceController extends Controller
{
    //Get items invoice
    public function getItemsInvoicePrivate($id){
        try {
            $items_invoice= (new InvoicePrivateRepository())->getInvoiceItemPrivate($id);
            $response = [
                'items_invoice'=>$items_invoice
            ];
            return response()->json($response, 200);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }
     //Get items invoice
     public function getItemsInvoiceSubscribe($id){
        try {
            $items_invoice= (new InvoiceSubscribeRepository())->getInvoiceItemSubscribe($id);
            $response = [
                'items_invoice'=>$items_invoice
            ];
            return response()->json($response, 200);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }
    //Create invoice private itmes
    public function createInvoiceItems(Request $request,$id)
    {
        try {
            foreach ($request->items as $item){
                $data=(new InvoiActions())->checkIfItemExistOnInvoice(
                    'invoice_private_tarification',
                    'invoice_private_id',
                    $item['invoice_private_id'],
                );
                foreach ($data as $val){
                    if($item['tarification_id']==$val->tarification_id){
                        (new InvoiActions())->deleteInvoiceItem($val->id,'invoice_private_tarification');
                    }
                }
            }
            (new InvoiceItemsRepository())
                ->createInvoiceLines(request('table'),$request->items);
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
    public function  updateQtyInvoiceItem(Request $request,$id){
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
    //Delete item invoice
    public function deleteIvoiceItem(int $id){
        try {
            (new InvoicePrivateRepository())->deleteInvoiceItem($id,\request('table'));
            $response = [
                'message'=>'Item deleted successfull',
                'status'=>true
            ];
            return response()->json($response, 200);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }
}
