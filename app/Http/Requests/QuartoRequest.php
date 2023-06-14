<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class QuartoRequest extends FormRequest
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
            'preco' => 'required',
            'numero' => 'required',
            'idEstadoQuarto' => 'required',
            'limit_adulto' => 'required',
            'limit_crianca' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Nome é obrigatório',
            'preco.required' => 'Preço é obrigatório',
            'numero.required' => 'Número é obrigatório',
            'idEstadoQuarto.required' => 'Estado Quarto é obrigatório',
            'limit_adulto.required' => 'Limite Adulto é obrigatório',
            'limit_crianca.required' => 'Limite Criança é obrigatório',
        ];
    }
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
       
    }
}
