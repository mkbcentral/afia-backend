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
            'name'=>$this->name,
            'gender'=>$this->gender,
            'data_of_birth'=>$this->data_of_birth,
            'phone'=>$this->phone,
            'other_phone'=>$this->other_phonen,
            'quartier'=>$this->quartier,
            'street'=>$this->street,
            'commune'=>new CommuneResource($this->commune),
            'company'=>new CompanyResource($this->company),
            'form'=>new FormPatientResource($this->formPatient),
        ];
    }
}
