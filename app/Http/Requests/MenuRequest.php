<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'nome' => 'required',
            'codigo' => 'required|min:4',
            'tipo' => 'required',
            'ordem' => 'required',
            'menu_perfil' => 'array'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Nome é obrigatório',
            'codigo.required' => 'Codigo é obrigatório',
            'codigo.min' => 'Codigo deve conter no mínimo 4 caracteres',
            'tipo.required' => 'Tipo é obrigatório',
            'ordem.required' => 'Ordem é obrigatório',
        ];
    }
}
