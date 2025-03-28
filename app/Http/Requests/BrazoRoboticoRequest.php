<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrazoRoboticoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'modelo' => 'required|string|max:255',
            'fabricante' => 'required|string|max:255',
            'user_id' => 'nullable|integer'
        ];
    }

    public function messages()
    {
        return [
            'modelo.required' => 'El modelo es obligatorio',
            'fabricante.required' => 'El fabricante es obligatorio',
        ];
    }
}
