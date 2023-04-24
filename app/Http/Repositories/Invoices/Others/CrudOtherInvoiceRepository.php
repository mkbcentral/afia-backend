<?php

namespace App\Http\Repositories\Invoices\Others;

use App\Http\Actions\InvoiActions;
use App\Models\Currency;
use App\Models\OtherInvoice;
use App\Models\Rate;

;

class CrudOtherInvoiceRepository extends InvoiActions
{
    //Get all invoices
    public function get()
    {
        $types = OtherInvoice::where('hospital_id', auth()->user()->hospital->id)
            ->where('branch_id',auth()->user()->branch->id)
            ->whereMonth('created_at',date('m'))
            ->orderBy('name', 'asc')
            ->get();
        return $types;
    }
    //Create new invoice
    public function create(array $inputs): OtherInvoice
    {
        $currency = Currency::where('name', 'CDF')->first();
        $rate = Rate::where('status', true)->first();
        $invoice = OtherInvoice::create([
            'invoice_number' => rand(100,1000),
            'name' => $inputs['name'],
            'gender' => $inputs['gender'],
            'date_of_birth' => $inputs['date_of_birth'],
            'email' => $inputs['email'],
            'phone' => $inputs['phone'],
            'form_patient_id' => $inputs['form_id'],
            'rate_id' => $rate->id,
            'currency_id' => $currency->id,
            'type_other_invoice_id' => $inputs['type_other_invoice_id'],
            'hospital_id' => auth()->user()->hospital->id,
            'branch_id' => auth()->user()->branch->id,
            'user_id' => auth()->user()->id,
        ]);
        return $invoice;
    }
    //Show specific invoice
    public function show(int $id): OtherInvoice
    {
        $invoice = OtherInvoice::find($id);
        return $invoice;
    }
    //Update specific invoice
    public function update(int $id, array $inputs): OtherInvoice
    {
        $invoice = $this->show($id);
        $invoice->name = $inputs['name'];
        $invoice->gender = $inputs['gender'];
        $invoice->phone = $inputs['phone'];
        $invoice->email = $inputs['email'];
        $invoice->type_other_invoice_id = $inputs['type_other_invoice_id'];
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
