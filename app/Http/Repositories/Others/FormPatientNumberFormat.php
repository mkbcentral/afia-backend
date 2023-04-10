<?php

namespace App\Http\Repositories\Others;

use App\Models\FormPatient;

class FormPatientNumberFormat{
    private string $formNumber="";
    public function getFormPrivateNumber():string{
        $forms=FormPatient::all();
        $number=sprintf('%05d',$forms->count());
        $this->formNumber="$number/".date('Y');
        return $this->formNumber;
    }
}
