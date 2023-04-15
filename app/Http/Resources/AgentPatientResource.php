<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AgentPatientResource extends JsonResource
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
            'street'=>$this->street,
            'parcel_number'=>$this->parcel_number,
            'type_name'=>$this->type->name,
            'service_name'=>$this->service->name,
            'commune'=>new CommuneResource($this->commune),
            'type'=>new PatientTypeResource($this->type),
            'service'=>new AgentServiceResource($this->service),
            'form'=>new FormPatientResource($this->formPatient),
        ];
    }
}
