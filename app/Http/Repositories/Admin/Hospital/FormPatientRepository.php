<?php

namespace App\Http\Repositories\Admin\Hospital;

use App\Models\FormPatient;
use Illuminate\Support\Facades\Auth;

class FormPatientRepository
{
    //Get all form
    public function get()
    {
        $form = FormPatient::orderBy('created_at', 'desc')->get();
        return $form;
    }
    //Create form
    public function create(array $inputs): FormPatient
    {
        $form = FormPatient::create([
            'number' => $inputs['number'],
            'hospital_id' => $inputs['hospital_id'],
            'branch_id' => $inputs['branch_id'],
            'user_id' => $inputs['user_id'],
        ]);
        return $form;
    }
    //Show spécific user
    public function show(int $id): FormPatient
    {
        $form = FormPatient::find($id);
        return $form;
    }

    //Update Specific form
    public function update(int $id, array $inputs): FormPatient
    {
        $form = $this->show($id);
        $form->name = $inputs['name'];
        $form->update();
        return $form;
    }
    //Delete form
    public function delete(int $id):bool{
        $form= $this->show($id);
        if ($form->delete()) {
             $status=true;
        }
        return $status;
     }
    // Disable form
    public function changeStatus(int $id, string $status): void
    {
        $form = $this->show($id);
        $form->status = $status;
        $form->update();
    }
}