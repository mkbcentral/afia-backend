<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceSubscribeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'invoice_number'=>$this->invoice_number,
            'patient_name'=>$this->formPatient->patientSubscriber?->name,
            'patient_gender'=>$this->formPatient->patientSubscriber?->gender,
            'patient_phone'=>$this->formPatient->patientSubscriber?->phone,
            'patient_email'=>$this->formPatient->patientSubscriber?->email,
            'form_number'=>$this->formPatient->number,
            'patient_age'=>$this->formPatient->patientSubscriber?->getAge($this->formPatient->patientSubscriber->date_of_birth),
            'created_at'=>$this->created_at->format('d/m/Y'),
            'company_name'=>$this->company->name,
            'consultation_name'=>$this->consultation->name,
            'consultation_amount'=>$this->consultation->price_private,
            'is_valided'=>$this->is_valided,
            'is_paid'=>$this->is_paid,
            'is_printed'=>$this->is_printed,
            'product_delivered'=>$this->product_delivered,
            'hospital'=>$this->hospital,
            'branch'=>$this->branch,
            'formPatient'=>new FormPatientResource($this->formPatient),
            'user'=>$this->user,
            'rate'=>$this->rate,
            'currency'=>$this->currency,
            'items'=>$this->tarifications,
            'amount'=>$this->getAmountInvoice($this->id)
        ];
    }
}
