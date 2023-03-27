<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FormPatientResource extends JsonResource
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
            'number'=>$this->number,
            'hospital'=>new HospitalResource($this->hospital),
            'branch'=>new BranchResource($this->branch),
            'created_by'=>new UserResource($this->user),
        ];
    }
}
