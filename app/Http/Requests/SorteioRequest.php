<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SorteioRequest extends FormRequest
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
            'titulo_sorteio' => 'required|string',
            'descricao_sorteio' => 'required|string',
            'brinde_sorteio' => 'required|string',
            'foto_sorteio' => 'required|image|mimes:jpg,jpeg,bmp,png',
            'data_inicio'=> 'required|date_format:Y-m-d',
            'data_fim'=> 'required|date_format:Y-m-d'
        ];
    }
}
