<?php

namespace App\Http\Repositories\Invoices\Others;
use App\Models\TypeOtherInvoice;

class OtherInvoiceTypeRepository
{
    //Get all types
    public function get()
    {
        $types = TypeOtherInvoice::where('hospital_id', auth()->user()->hospital->id)
            ->orderBy('name', 'asc')
            ->get();
        return $types;
    }
    //Create new type
    public function create(array $inputs): TypeOtherInvoice
    {
        $type = TypeOtherInvoice::create([
            'name' => $inputs['name'],
            'hospital_id' => auth()->user()->hospital->id
        ]);
        return $type;
    }
    //Show specific type
    public function show(int $id): TypeOtherInvoice
    {
        $type = TypeOtherInvoice::find($id);
        return $type;
    }

    public function update(int $id, array $inputs): TypeOtherInvoice
    {
        $type = $this->show($id);
        $type->name = $inputs['name'];
        $type->update();
        return $type;
    }

    public function delete(int $id,): bool
    {
        $type = $this->show($id);
        $status = false;
        if ($type->invoices->isEmpty()) {
            $type->delete();
            $status = true;
        } else {
            $status = false;
        }
        return $status;
    }
}
