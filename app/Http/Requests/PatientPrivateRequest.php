<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientPrivateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'gender' => 'required|string',
            'date_of_birth' => 'required',
            'phone' => 'nullable|string|unique:patient_privates,phone',
            'other_phone' => 'nullable|string|unique:patient_privates,other_phone',
            'email' => 'nullable|string',
            'quartier' => 'nullable|string',
            'parcel_number' => 'nullable|numeric',
            'street' => 'nullable|string',
            'commune_id' => 'required|numeric',
            'consultation_id' => 'required|numeric',
        ];
    }
}
