<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class Notificacao extends Model implements Auditable
{
    use HasFactory, AuditingAuditable;

    // Indicar o nome da tabela
    protected $table = 'tb_notificacoes';

    // Indicar quais colunas podem ser cadastrada
    protected $fillable = [
        'nome_profissional',
        'categoria',
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
        'status',
        'local_atendimento',
        'tipo_local',
        'paciente_id',   
        'user_id',
        'updated_by',
    ];

    // Criar relacionamento entre um e muitos
    /*public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }*/

    public function paciente (){

        return $this->belongsTo(Paciente::class, 'paciente_id', 'id');
        
    }

    public function createdBy(){

        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function updatedBy(){

        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
