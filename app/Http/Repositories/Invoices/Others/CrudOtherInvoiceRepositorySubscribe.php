<?php

namespace App\Http\Repositories\Invoices\Others;

use App\Models\OtherInvoiceSubscribe;

class OtherInvoiceSubscribeRepository
{
    //Get all invoices
    public function get()
    {
        $invoices = OtherInvoiceSubscribe::where('hospital_id', auth()->user()->hospital->id)
            ->orderBy('name', 'asc')
            ->get();
        return $invoices;
    }
    //Create new invoice
    public function create(array $inputs): OtherInvoiceSubscribe
    {
        $invoice = OtherInvoiceSubscribe::create([
            'invoice_number' => $inputs['invoice_number'],
            'genger' => $inputs['genger'],
            'date_of_birth' => $inputs['date_of_birth'],
            'email' => $inputs['email'],
            'form_patient_id' => $inputs['form_id'],
            'rate_id' => $inputs['rate_id'],
            'currency_id' => $inputs['currency_id'],
            'company_id' => $inputs['company_id'],
            'hospital_id' => auth()->user()->hospital->id,
            'branch_id' => auth()->user()->branch_id->id,
            'user_id' => auth()->user()->id,
        ]);
        return $invoice;
    }
    //Show specific invoice
    public function show(int $id): OtherInvoiceSubscribe
    {
        $type = OtherInvoiceSubscribe::find($id);
        return $type;
    }
    //Update specific invoice
    public function update(int $id, array $inputs): OtherInvoiceSubscribe
    {
        $type = $this->show($id);
        $type->name = $inputs['name'];
        $type->gender = $inputs['gender'];
        $type->phone = $inputs['phone'];
        $type->email = $inputs['email'];
        $type->company_id = $inputs['company_id'];
        $type->update();
        return $type;
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
