<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservaRequest extends FormRequest
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
            'totalAdulto' => 'required',
            'totalCrianca' => 'required',
            'dataInicio' => 'required',
            'qtdDias' => 'required',
            'idCliente' => 'required',
            'idQuarto' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'totalAdulto.required' => 'Quantidade de Adultos é obrigatório',
            'totalCrianca.required' => 'Quantidade de Crianças é obrigatório',
            'dataInicio.required' => 'Data de Inicio da reserva é obrigatório',
            'dataInicio.required' => 'Data de Termino da reserva é obrigatório',
            'qtdDias.required' => 'Quantidade de Dias é obrigatório',
            'idCliente.required' => 'Cliente é obrigatório',
            'idQuarto.required' => 'QUarto é obrigatório',
        ];
    }
}
