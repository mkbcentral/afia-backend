<?php
namespace App\Http\Repositories\Admin\Others;

use App\Models\Commune;
use App\Models\PatientType;

class PatientTypeRepository{
    //Get all communes
    public function get()
    {
        $types = PatientType::orderBy('name', 'asc')->get();
        return $types;
    }
    //Create commune
    public function create(array $inputs): PatientType
    {
        $type = PatientType::create([
            'name' => $inputs['name'],
        ]);
        return $type;
    }
    //Show spécific commune
    public function show(int $id): PatientType
    {
        $type = PatientType::find($id);
        return $type;
    }

    //Update Specific
    public function update(int $id, array $inputs): PatientType
    {
        $type = $this->show($id);
        $type->name = $inputs['name'];
        $type->update();
        return $type;
    }
    //Delete commune
    public function delete(int $id):bool{
        $type= $this->show($id);
        if ($type->delete()) {
             $status=true;
        }
        return $status;
     }
}
