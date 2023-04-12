<?php

namespace App\Http\Repositories\Others;

use App\Models\FormPatient;

class FormPatientNumberFormat{
    private string $formNumber="";
    public function getFormPrivateNumber():string{
        $forms=FormPatient::where('hospital_id',auth()->user()->hospital->id)
                ->where('branch_id',auth()->user()->branch->id)
                ->get();

        $number=sprintf('%05d',$forms->count()+1);
        $this->formNumber="$number/".date('Y');
        return $this->formNumber;
    }
}
