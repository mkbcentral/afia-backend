<?php

namespace App\Http\Repositories\Admin\Others;

use App\Models\Currency;

class CurrencyRepository
{
    //Get all currncies
    public function get()
    {
        $currencie = Currency::all();
        return $currencie;
    }
    //Create currency
    public function create(array $inputs): Currency
    {
        $currency = Currency::create([
            'name' => $inputs['name'],
            'hospital_id' => $inputs['hospital_id'],
        ]);
        return $currency;
    }
    //Show spécific service
    public function show(int $id): Currency
    {
        $currency = Currency::find($id);
        return $currency;
    }

    //Update Specific
    public function update(int $id, array $inputs): Currency
    {
        $currency = $this->show($id);
        $currency->name = $inputs['name'];
        $currency->update();
        return $currency;
    }
    //Delete service
    public function delete(int $id): bool
    {
        $currency = $this->show($id);
        if ($currency->delete()) {
            $status = true;
        }
        return $status;
    }
}
