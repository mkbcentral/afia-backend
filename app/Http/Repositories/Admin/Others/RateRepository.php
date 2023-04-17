<?php

namespace App\Http\Repositories\Admin\Others;

use App\Models\Rate;

class RateRepository
{
    //Get all rates
    public function get()
    {
        $rate = Rate::where('hospital_id', auth()->user()->hospital->id)
            ->get();
        return $rate;
    }
    //Create rate
    public function create(array $inputs): Rate
    {
        $reate = Rate::create([
            'amount' => $inputs['amount'],
            'hospital_id' => auth()->user()->hospital->id,
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
        $rate = $this->show($id);
        $rate->amount = $inputs['amount'];
        $rate->update();
        return $rate;
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
    public function changeStatus(int $id): Rate
    {
        $rate = $this->show($id);
        if ($rate->status == false) {
            $rate->status = true;
        } else {
            $rate->status = false;
        }
        $rate->update();
        return $rate;
    }
    //Get current rate
    public function getCurrentRate():Rate{
        $rate=Rate::where('status',true)->first();
        return $rate;
    }
}
