<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificacaoRequest extends FormRequest
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
            'nome_profissional' => 'required|string',
            'categoria'  => 'required|string',
            'cbo',
            'dormencia',
            'formigamento',
            'area_ador',
            'caimbra',
            'picadas',
            'manchas',
            'dor_nervo',
            'carocos',
            'inchaco_mao_pe',
            'inchaco_rosto',
            'fraqueza_mao',
            'fraqueza_pe',
            'perda_cilios',
            'historico_fam',
            'status' => ['required', 'not_in:Selecione uma opção'],
            'tipo_local' => ['required', 'not_in:Selecione uma opção'],
            'local_atendimento' => 'required|string',
            'paciente_id' => 'int', //chave estrangeira da tabela tb_pacintes
            'user_id', // chave estrangeira da tabela users
            'updated_by',
        ];
    }

    public function messages(): array
    {
        return[
            /*'tipo_notificacao.required' => 'O campo tipo de notificação é obrigatório!' => ['required', 'not_in:Selecione uma opção'],
            'data_notif.required' => 'O campo data da notificação é obrigatório!' => ['required', 'not_in:Selecione uma opção'],
            'sem_epi.required'  => 'O campo semana epidemiológica é obrigatório!' => ['required', 'not_in:Selecione uma opção'],
            'data_admi.required' => 'O campo data da admissão é obrigatório!' => ['required', 'not_in:Selecione uma opção'],

            'mun_ocorrencia.required' => 'O campo municípioda notificação é obrigatório!' => ['required', 'not_in:Selecione uma opção'],
            'und_ocorrencia.required' => 'O campo unidade da notificação é obrigatório!' => ['required', 'not_in:Selecione uma opção'],
            'setor_int.required' => 'O campo setor da notificação é obrigatório!' => ['required', 'not_in:Selecione uma opção'],        
            'grupo_eta.required' => 'O campo grupo estário é obrigatório!' => ['required', 'not_in:Selecione uma opção'],
            'gest_puer.required' => 'O campo gestante puerpera é obrigatório!' => ['required', 'not_in:Selecione uma opção'],
            'dae.required' => 'O campo doenças, agravos e eventos é obrigatório!' => ['required', 'not_in:Selecione uma opção'],
            'notifica_para.required' => 'O campo notifica para é obrigatório!' => ['required', 'not_in:Selecione uma opção'],
            'dt_prime_sintomas.required' => 'O campo data dos primeiros sintomas é obrigatório!' => ['required', 'not_in:Selecione uma opção'],
            'sinais_sintomas.required' => 'O campo sinais e sintomas é obrigatório!' => ['required', 'not_in:Selecione uma opção'],
            'vigi_laboratorial.required' => 'O campo vigilância laboratorial é obrigatório!' => ['required', 'not_in:Selecione uma opção'],
            'class_final.required' => 'O campo classificação final é obrigatório!' => ['required', 'not_in:Selecione uma opção'],
            'criterio_confir.required' => 'O campo critério de confirmação é obrigatório!' => ['required', 'not_in:Selecione uma opção'],
            'evolu_caso.required' => 'O campo evolução do caso é obrigatório!' => ['required', 'not_in:Selecione uma opção'],
            'num_do.required' => 'O campo número da declaração de óbito é obrigatório!' => ['required', 'not_in:Selecione uma opção'],
            'num_sivep_gripe.required' => 'O campo número da sivep-gripe é obrigatório!' => ['required', 'not_in:Selecione uma opção'],
            'num_sinan.required' => 'O campo número do sinan é obrigatório!' => ['required', 'not_in:Selecione uma opção'],
            'num_esus.required' => 'O campo número do e-sus é obrigatório!' => ['required', 'not_in:Selecione uma opção'],
            'num_snc19.required' => 'O campo número do snc19 é obrigatório!' => ['required', 'not_in:Selecione uma opção'],
            'observacao.required' => 'O campo obeservação é obrigatório!' => ['required', 'not_in:Selecione uma opção'],
            //'paciente_id' => 'required_if:paciente_id,!=,null' => ['required', 'not_in:Selecione uma opção'],
            //'user_id' => 'required' => ['required', 'not_in:Selecione uma opção'],
            //'updated_by' => 'required' => ['required', 'not_in:Selecione uma opção'],*/
        ];
    }
}
