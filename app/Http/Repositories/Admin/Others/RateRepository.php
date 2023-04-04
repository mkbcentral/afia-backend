<?php

namespace App\Http\Repositories\Admin\Others;

use App\Models\Rate;

class RateRepository
{
    //Get all rates
    public function get()
    {
        $rate = Rate::whereStatus(true)
            ->where('hospital_id', request('hospital'))
            ->first();
        return $rate;
    }
    //Create rate
    public function create(array $inputs): Rate
    {
        $reate = Rate::create([
            'amount' => $inputs['amount'],
            'hospital_id' => $inputs['hospital_id'],
        ]);
        return $reate;
    }
    //Show spécific service
    public function show(int $id): Rate
    {
        $rate = Rate::find($id);
        return $rate;
    }

    //Update Specific
    public function update(int $id, array $inputs): Rate
    {
        $service = $this->show($id);
        $service->amount = $inputs['amount'];
        $service->update();
        return $service;
    }
    //Delete service
    public function delete(int $id): bool
    {
        $rate = $this->show($id);
        if ($rate->delete()) {
            $status = true;
        }
        return $status;
    }

    //Change Status rate
    public function changeStatus(int $id): bool
    {
        $rate = $this->show($id);
        if ($rate->status == false) {
            $rate->status = true;
        } else {
            $rate->status = true;
        }
        return $rate->status;
    }
}
