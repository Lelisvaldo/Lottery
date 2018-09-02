<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required|string|max:60',
            'email' => 'nullable|email|unique:users',
            'cpf' => 'nullable|string|max:11',
            'dtnasc'=> 'required|date_format:Y-m-d',
            'genero_id'=> 'required|numeric'
        ];
    }
}
