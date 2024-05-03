<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class Hospital extends Model implements Auditable
{
    use HasFactory, AuditingAuditable;

    protected $table = 'tb_hospitais';
    protected $fillable = ['unidades', 'reg_saude_id', 'municipio_id'];

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id');
    }
}
