<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email'=>$this->email,
            'phone'=>$this->phone,
            'status'=>$this->status,
            'hospital_name'=>$this->hospital->name,
            'role_name'=>$this->role->name,
            'color'=>$this->status=='ENABLE'?'primary':'danger',
            'role'=>new RoleResource($this->role),
            'hospital'=>new HospitalResource($this->hospital)
        ];
    }
}
