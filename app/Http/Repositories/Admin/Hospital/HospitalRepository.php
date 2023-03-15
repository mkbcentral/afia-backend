<?php

namespace App\Http\Repositories\Admin\Hospital;

use App\Http\Resources\HospitalResource;
use App\Models\Hospital;

class HospitalRepository
{
    //Get all hospital
    public function get()
    {
        $hospitals = Hospital::orderBy('name', 'asc')->get();
        return $hospitals;
    }
    //Create hospital
    public function create(array $inputs): Hospital
    {
        $hospital = Hospital::create([
            'name' => $inputs['name'],
            'logo' => $inputs['logo'],
            'email' => $inputs['email'],
            'phone' => $inputs['phone']
        ]);
        return new $hospital;
    }
    //Show spécific user
    public function show(int $id): Hospital
    {
        $hospital = Hospital::find($id);
        return $hospital;
    }

    //Update Specific
    public function update(int $id, array $inputs): Hospital
    {
        $hospital = $this->show($id);
        $hospital->name = $inputs['name'];
        $hospital->email = $inputs['email'];
        $hospital->phone = $inputs['phone'];
        $hospital->update();
        return $hospital;
    }
    // Disable hospital
    public function changeStatus(int $id, string $status): void
    {
        $hospital = $this->show($id);
        $hospital->status = $status;
        $hospital->update();
    }
}
