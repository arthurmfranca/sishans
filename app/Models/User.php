<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Support\Facades\Auth;

use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements Auditable
{
    use HasApiTokens, HasFactory, Notifiable, AuditingAuditable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'municipio_id',
        'und_saude_id',
        'email',
        'status',
        'password',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function countNotificacoes()
    {
        return $this->hasMany(Notificacao::class, 'user_id')->count();
    }

    public function pacienteNotificacoes()
    {
        return $this->hasManyThrough(Notificacao::class, Paciente::class, 'paciente_id', 'user_id');
    }

    public function notificacao()
    {
    return $this->hasMany(Notificacao::class, 'user_id');
    }

    public function municipio(){

        return $this->belongsTo(Municipio::class, 'municipio_id');

    }

    public function hospital(){

        return $this->belongsTo(Hospital::class, 'und_saude_id');

    }

    /*public function createdBy(){

        return $this->belongsTo(User::class, 'created_by', 'id');
    }*/

    /*public function updatedBy(){

        return $this->belongsTo(User::class, 'updated_by', 'id');
    }*/
    
}