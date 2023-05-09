<?php

namespace App\Http\Controllers\Api\Invoices;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Invoices\InvoicePrivateRepository;
use App\Http\Resources\InvoicePrivateResource;
use Exception;
use Illuminate\Http\Request;

class ApiInvoicePrivateController extends Controller
{
    public function getInvoices()
    {
        //dd(request('date'));
        try {
            $invoices = (new InvoicePrivateRepository())
                ->get(request('date'), request('month'), request('year'));
            return InvoicePrivateResource::collection($invoices);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }
    public function show($id)
    {
        try {
            $invoice = (new InvoicePrivateRepository())->show($id);
            return new InvoicePrivateResource($invoice);
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        }
    }
}
