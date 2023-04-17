<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TarificationRequest extends FormRequest
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
            'abreviation' => 'nullable|string',
            'price_private' => 'numeric|string',
            'price_subscribe' => 'numeric|string',
            'category_tarification_id' => 'numeric|string',
        ];
    }
}
