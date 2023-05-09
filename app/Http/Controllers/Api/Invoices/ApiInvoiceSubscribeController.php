<?php

namespace App\Http\Controllers\Api\Invoices;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Invoices\InvoiceSubscribeRepository;
use App\Http\Resources\InvoiceSubscribeResource;
use Exception;
use Illuminate\Http\Request;

class ApiInvoiceSubscribeController extends Controller
{

    public function getInvoices(){
        try {
            $invoices=(new InvoiceSubscribeRepository())->get();
            return InvoiceSubscribeResource::collection($invoices);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }

}
