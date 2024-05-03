<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class Municipio extends Model implements Auditable
{
    use HasFactory, AuditingAuditable;

    protected $table = 'tb_municipios';
    protected $fillable = ['municipio', 'estado_id'];

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    /*public function regSaude()
    {
        return $this->belongsTo(RegSaude::class, 'reg_saude_id');
    }*/

    /*public function hospitais()
    {
        return $this->hasMany(Hospital::class, 'municipio_id');
    }*/
    
}