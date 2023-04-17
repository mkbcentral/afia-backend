<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TarificationResource extends JsonResource
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
            'abreviation'=>$this->abreviation,
            'price_private'=>$this->price_private,
            'price_subscribe'=>$this->price_subscribe,
            'hospital'=>new HospitalResource($this->hospital),
            'category'=>new CategoryTarificationResource($this->category),
            'status'=>$this->status,
        ];
    }
}
