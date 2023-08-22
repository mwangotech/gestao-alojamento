<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class ClienteRequest extends FormRequest
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
        //dd($this->id);
        return [
            'nome' => 'required',
            'email' => 'required',
            'idNacionalidade' => 'required',
            'idProvincia' => 'required',
            'BI' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Nome é obrigatório',
            'email.required' => 'Email é obrigatório',
            'idNacionalidade.required' => 'Nacionalidade é obrigatório',
            'idProvincia.required' => 'Província é obrigatório',
            'BI.required' => 'BI / NIF é obrigatório',
        ];
    }
 
}
