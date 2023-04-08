<?php

namespace App\Http\Repositories\Admin\Others;

use App\Models\AgentService;

class AgentServiceRepository
{
    //Get all services
    public function get()
    {
        $services = AgentService::orderBy('name', 'asc')
            ->where('hospital_id', auth()->user()->hospital->id)
            ->get();
        return $services;
    }
    //Create service
    public function create(array $inputs): AgentService
    {
        $service = AgentService::create([
            'name' => $inputs['name'],
            'hospital_id' => auth()->user()->hospital->id,
        ]);
        return $service;
    }
    //Show spécific service
    public function show(int $id): AgentService
    {
        $service = AgentService::find($id);
        return $service;
    }

    //Update Specific
    public function update(int $id, array $inputs): AgentService
    {
        $service = $this->show($id);
        $service->name = $inputs['name'];
        $service->update();
        return $service;
    }
    //Delete service
    public function delete(int $id): bool
    {
        $service = $this->show($id);
        if ($service->delete()) {
            $status = true;
        }
        return $status;
    }
}
