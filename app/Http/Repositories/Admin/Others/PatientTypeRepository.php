<?php
namespace App\Http\Repositories\Admin\Others;

use App\Models\PatientType;

class PatientTypeRepository{
    //Get all Patient types
    public function get()
    {
        $types = PatientType::orderBy('name', 'asc')->get();
        return $types;
    }
    //Create Patient type
    public function create(array $inputs): PatientType
    {
        $type = PatientType::create([
            'name' => $inputs['name'],
            'hospital_id' => auth()->user()->hospital->id
        ]);
        return $type;
    }
    //Show spécific Patient type
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
        $type->hospital_id = auth()->user()->hospital->id;
        $type->update();
        return $type;
    }
    //Delete Patient type
    public function delete(int $id):bool{
        $type= $this->show($id);
        if ($type->delete()) {
             $status=true;
        }
        return $status;
     }
}
