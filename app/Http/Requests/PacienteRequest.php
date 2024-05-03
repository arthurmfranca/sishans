<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PacienteRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome_paciente' => 'required',
            'idade'  => 'required',
            'endereco' => 'required',
            'cartao_sus'  => 'required|max:15',
            'cpf'  => 'required|max:14',
            'telefone'  => 'required|max:15',
            'mun_res'  => ['required', 'not_in:Selecione uma opção'],
            'dt_nasc'  => 'required',
            'sexo'  => ['required', 'not_in:Selecione uma opção'],
            'raca_cor'  => ['required', 'not_in:Selecione uma opção']
        ];
    }

    public function messages(): array
    {
        return[
            'nome_paciente.required' => 'O campo nome do paciente é obrigatório!',
            'idade.required' => 'O campo idade é obrigatório!',
            'endereco.required' => 'O campo endereço é obrigatório!',
            'cartao_sus.required' => 'O campo cartão sus é obrigatório!',
            'cpf.required' => 'O campo cpf é obrigatório!',
            'telefone.required' => 'O campo telefone é obrigatório!',
            'mun_res.required' => 'O campo município é obrigatório!',    
            'dt_nasc.required' => 'O campo data de nascimento é obrigatório!',
            'sexo.required' => 'O campo sexo é obrigatório!',
            'raca_cor.required' => 'O campo raça/cor é obrigatório!',
        ];
    }
}
