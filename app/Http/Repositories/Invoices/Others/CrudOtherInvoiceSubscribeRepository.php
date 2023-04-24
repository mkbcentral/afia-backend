<?php

namespace App\Http\Repositories\Invoices\Others;

use App\Http\Actions\InvoiActions;
use App\Models\Currency;
use App\Models\OtherInvoiceSubscribe;
use App\Models\Rate;

class CrudOtherInvoiceSubscribeRepository extends InvoiActions
{
    //Get all invoices
    public function get($company_id)
    {
        $invoices = OtherInvoiceSubscribe::where('hospital_id', auth()->user()->hospital->id)
            ->orderBy('name', 'asc')
            ->where('branch_id',auth()->user()->branch->id)
            ->whereMonth('created_at',date('m'))
            ->where('company_id',$company_id)
            ->get();
        return $invoices;
    }
    //Create new invoice
    public function create(array $inputs): OtherInvoiceSubscribe
    {
        $currency = Currency::where('name', 'CDF')->first();
        $rate = Rate::where('status', true)->first();
        $invoice = OtherInvoiceSubscribe::create([
            'invoice_number' => rand(100,1000),
            'gender' => $inputs['gender'],
            'date_of_birth' => $inputs['date_of_birth'],
            'email' => $inputs['email'],
            'form_patient_id' => $inputs['form_id'],
            'currency_id' => $currency->id,
            'rate_id' => $rate->id,
            'hospital_id' => auth()->user()->hospital->id,
            'company_id' => $inputs['company_id'],
            'branch_id' => auth()->user()->branch->id,
            'user_id' => auth()->user()->id,
        ]);
        return $invoice;
    }
    //Show specific invoice
    public function show(int $id): OtherInvoiceSubscribe
    {
        $invoice = OtherInvoiceSubscribe::find($id);
        return $invoice;
    }
    //Update specific invoice
    public function update(int $id, array $inputs): OtherInvoiceSubscribe
    {
        $invoice = $this->show($id);
        $invoice->name = $inputs['name'];
        $invoice->gender = $inputs['gender'];
        $invoice->phone = $inputs['phone'];
        $invoice->email = $inputs['email'];
        $invoice->company_id = $inputs['company_id'];
        $invoice->update();
        return $invoice;
    }
    //Delete specific invoice
    public function delete(int $id,): bool
    {
        $invoice = $this->show($id);
        $status = false;
        if ($invoice->delete()) {
            $status = true;
        } else {
            $status = false;
        }
        return $status;
    }
}
