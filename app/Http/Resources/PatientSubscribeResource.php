<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientSubscribeResource extends JsonResource
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
            'number'=>$this->formPatient->number,
            'name'=>$this->name,
            'gender'=>$this->gender,
            'data_of_birth'=>$this->data_of_birth,
            'phone'=>$this->phone,
            'other_phone'=>$this->other_phone,
            'quartier'=>$this->quartier,
            'parcel_number'=>$this->parcel_number,
            'street'=>$this->street,
            'company_name'=>$this->company->name,
            'type_name'=>$this->patientType->name,
            'commune'=>new CommuneResource($this->commune),
            'company'=>new CompanyResource($this->company),
            'type'=>new PatientTypeResource($this->patientType),
            'form'=>new FormPatientResource($this->formPatient),
        ];
    }
}
