<?php

namespace App\Http\Repositories\Invoices;

use App\Http\Actions\InvoiActions;
use App\Models\InvoicePrivate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoicePrivateRepository extends InvoiActions
{
    //Get all invoices
    public function get($date, $month, $year)
    {
        if ($date != null) {
            $invoices = InvoicePrivate::where('hospital_id', auth()->user()->hospital->id)
                ->where('branch_id', auth()->user()->branch->id)
                ->whereDate('created_at', $date)
                ->whereYear('created_at', $year)
                ->orderBy('created_at', 'asc')
                ->get();
        } elseif ($month != null) {
            $invoices = InvoicePrivate::where('hospital_id', auth()->user()->hospital->id)
                ->where('branch_id', auth()->user()->branch->id)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->orderBy('created_at', 'asc')
                ->get();
        } elseif ($month == null && $date == null) {
            $invoices = InvoicePrivate::where('hospital_id', auth()->user()->hospital->id)
                ->where('branch_id', auth()->user()->branch->id)
                ->whereMonth('created_at', date('m'))
                ->whereYear('created_at', $year)
                ->orderBy('created_at', 'asc')
                ->get();
        }
        return $invoices;
    }

    public function createInvoice($invoice_number, $form_patient_id, $consultation_id, $rate_id, $currency_id): InvoicePrivate
    {

        $invoice = InvoicePrivate::create([
            'invoice_number' => $invoice_number,
            'hospital_id' => auth()->user()->hospital->id,
            'branch_id' => auth()->user()->branch->id,
            'form_patient_id' => $form_patient_id,
            'consultation_id' => $consultation_id,
            'user_id' => auth()->user()->id,
            'rate_id' => $rate_id,
            'currency_id' => $currency_id,
        ]);
        return $invoice;
    }
    public function checkPatientExistInvoiceInCurrectMonth($form_id)
    {
        $invoice = InvoicePrivate::where('form_patient_id', $form_id)
            ->whereMonth('created_at', date('m'))->first();
        return $invoice;
    }

    public function show(int $id): InvoicePrivate
    {
        return InvoicePrivate::find($id);
    }

}
