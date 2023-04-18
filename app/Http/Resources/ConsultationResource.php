<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultationResource extends JsonResource
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
            'price_private'=>$this->price_private,
            'price_subscribe'=>$this->price_subscribe,
            'hospital'=>new HospitalResource($this->hospital),
            'status'=>$this->status,
            'starus_name'=>$this->status==true?'ENABLE':'DISABLE',
            'color_status'=>$this->status==true?'primary':'danger',
        ];
    }
}
