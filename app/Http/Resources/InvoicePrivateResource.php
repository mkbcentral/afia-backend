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
            'hospital'=>$this->hospital,
            'branch'=>$this->branch,
            'formPatient'=>$this->formPatient,
            'user'=>$this->user,
            'rate'=>$this->rate,
            'currency'=>$this->currency,
            'consultation'=>$this->consultation,
            'is_valided'=>$this->is_valided,
            'is_paid'=>$this->is_paid,
            'is_printed'=>$this->is_printed,
            'product_delivered'=>$this->product_delivered,
        ];
    }
}
