<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class Entrevistador extends Model implements Auditable
{
    use HasFactory, AuditingAuditable;

    //Indicar o nome da tabela
    protected $table = 'tb_entrevistador';

    //Indicar quais colunas podem ser cadastradas
    protected $fillable = [
        'nome_profissional',
        'categoria',
        'cbo',
    ];

    // Relacionamento com a model Entrevistador
    /*public function entrevistador()
    {
        return $this->belongsTo(Entrevistador::class, 'tb_entrevistador_id');
    }*/

    public function notificacoes()
    {
        return $this->hasMany(Notificacao::class, 'tb_entrevistador_id');
    }
}
