<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class Estado extends Model implements Auditable
{
    use HasFactory, AuditingAuditable;

    //Indicar o nome da tabela
    protected $table = 'tb_estado';
    protected $fillable = ['estados'];

    public function municipios()
    {
        return $this->hasMany(Municipio::class, 'estado_id');
    }
}