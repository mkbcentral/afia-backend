<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoicePrivateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return  [
            'id'=>$this->id,
            'invoice_number'=>$this->invoice_number,
            'patient_name'=>$this->formPatient->patientPrivate->name,
            'patient_gender'=>$this->formPatient->patientPrivate->gender,
            'patient_phone'=>$this->formPatient->patientPrivate->phone,
            'patient_email'=>$this->formPatient->patientPrivate->email,
            'form_number'=>$this->formPatient->number,
            'patient_age'=>$this->formPatient->patientPrivate->getAge($this->formPatient->patientPrivate->date_of_birth),
            'created_at'=>$this->created_at->format('d/m/Y'),
            'hospital'=>$this->hospital,
            'branch'=>$this->branch,
            'formPatient'=>new FormPatientResource($this->formPatient),
            'user'=>$this->user,
            'rate'=>$this->rate,
            'currency'=>$this->currency,
            'consultation_name'=>$this->consultation->name,
            'consultation_amount'=>$this->consultation->price_private,
            'is_valided'=>$this->is_valided,
            'is_paid'=>$this->is_paid,
            'is_printed'=>$this->is_printed,
            'product_delivered'=>$this->product_delivered,
            'items'=>$this->tarifications,
            'amount'=>$this->getAmountInvoice($this->id)
        ];
    }
}
