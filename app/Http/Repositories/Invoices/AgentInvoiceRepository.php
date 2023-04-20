<?php

namespace App\Http\Repositories\Invoices;

use App\Http\Actions\InvoiActions;
use App\Models\AgentInvoice;

class AgentInvoiceRepository extends InvoiActions{
    public function createInvoice($invoice_number,$form_patient_id,$consultation_id,$rate_id,$currency_id,$agent_service_id):AgentInvoice{

        $invoice=AgentInvoice::create([
            'invoice_number'=>$invoice_number,
            'hospital_id'=>auth()->user()->hospital->id,
            'branch_id'=>auth()->user()->branch->id,
            'form_patient_id'=>$form_patient_id,
            'consultation_id'=>$consultation_id,
            'user_id'=>auth()->user()->id,
            'rate_id'=>$rate_id,
            'currency_id'=>1,
            'agent_service_id'=>$agent_service_id,
        ]);
        return $invoice;
    }

    public function checkPatientExistInvoiceInCurrectMonth($form_id,$service_id){
        $invoice=AgentInvoice::where('form_patient_id',$form_id)
            ->where('agent_service_id',$service_id)
            ->whereMonth('created_at',date('m'))
            ->first();
        return $invoice;
    }
}
