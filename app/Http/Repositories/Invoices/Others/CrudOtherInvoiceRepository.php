<?php

namespace App\Http\Repositories\Invoices\Others;

use App\Models\OtherInvoice;;

class OtherInvoiceRepository
{
    //Get all invoices
    public function get()
    {
        $types = OtherInvoice::where('hospital_id', auth()->user()->hospital->id)
            ->orderBy('name', 'asc')
            ->get();
        return $types;
    }
    //Create new invoice
    public function create(array $inputs): OtherInvoice
    {
        $invoice = OtherInvoice::create([
            'invoice_number' => $inputs['invoice_number'],
            'genger' => $inputs['genger'],
            'date_of_birth' => $inputs['date_of_birth'],
            'email' => $inputs['email'],
            'form_patient_id' => $inputs['form_id'],
            'rate_id' => $inputs['rate_id'],
            'currency_id' => $inputs['currency_id'],
            'type_other_invoice_id' => $inputs['type_other_invoice_id'],
            'hospital_id' => auth()->user()->hospital->id,
            'branch_id' => auth()->user()->branch_id->id,
            'user_id' => auth()->user()->id,
        ]);
        return $invoice;
    }
    //Show specific invoice
    public function show(int $id): OtherInvoice
    {
        $type = OtherInvoice::find($id);
        return $type;
    }
    //Update specific invoice
    public function update(int $id, array $inputs): OtherInvoice
    {
        $type = $this->show($id);

        $type->name = $inputs['name'];
        $type->name = $inputs['gender'];
        $type->name = $inputs['phone'];
        $type->name = $inputs['email'];
        $type->name = $inputs['type_other_invoice_id'];
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
