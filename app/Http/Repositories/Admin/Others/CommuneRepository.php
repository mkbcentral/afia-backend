<?php

namespace App\Http\Repositories\Admin\Others;

use App\Models\Commune;

class CommuneRepository
{
    //Get all communes
    public function get()
    {
        $communes = Commune::orderBy('name', 'asc')
        ->where('hospital_id', auth()->user()->hospital->id)
        ->get();
        return $communes;
    }
    //Create commune
    public function create(array $inputs): Commune
    {
        $commune = Commune::create([
            'name' => $inputs['name'],
            'hospital_id' => auth()->user()->hospital->id
        ]);
        return $commune;
    }
    //Show spécific commune
    public function show(int $id): Commune
    {
        $commune = Commune::find($id);
        return $commune;
    }

    //Update Specific
    public function update(int $id, array $inputs): Commune
    {
        $commune = $this->show($id);
        $commune->name = $inputs['name'];
        $commune->hospital_id = auth()->user()->hospital->id;
        $commune->update();
        return $commune;
    }
    //Delete commune
    public function delete(int $id): bool
    {
        $commune = $this->show($id);
        if ($commune->delete()) {
            $status = true;
        }
        return $status;
    }
}
