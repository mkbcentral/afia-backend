<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientPrivateResource extends JsonResource
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
            'number'=>$this->formPatient->number,
            'gender'=>$this->gender,
            'date_of_birth'=>$this->date_of_birth,
            'age'=>$this->getAge($this->date_of_birth),
            'phone'=>$this->phone,
            'other_phone'=>$this->other_phone,
            'parcel_number'=>$this->parcel_number,
            'quartier'=>$this->quartier,
            'street'=>$this->street,
            'commune'=>new CommuneResource($this->commune),
            'form'=>new FormPatientResource($this->formPatient),
        ];
    }
}
