<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class Paciente extends Model implements Auditable
{
    use HasFactory, AuditingAuditable;

    protected $table = 'tb_pacientes';
    protected $fillable = [
        'nome_paciente',
        'endereco',
        'idade',
        'telefone',
        'cpf',
        'cartao_sus',
        'mun_res',
        'dt_nasc',
        'sexo',
        'raca_cor',
        'user_id',
        'updated_by',
    ];

    // Criar relacionamento entre um e muitos
    public function notificacao()
    {
        return $this->hasMany(Notificacao::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'uf_res');
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'mun_res');
    }
}
