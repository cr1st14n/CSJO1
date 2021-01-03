<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\atencion;


class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'name', 'email', 'password','usu_ci','usu_nombre','usu_appaterno',
        'usu_apmaterno','usu_sexo','usu_fechnac','usu_estadocivil','usu_telf',
        'usu_telfref','usu_zona','usu_domicilio','usu_tipo','usu_area',
        'usu_cargo','usu_acceso'

    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function scopeUsuarios()
    {
        return User::join('atencion','atencion.usu_ci','users.usu_ci');

//        return $this->hasMany(\App\atencion::class,'usu_ci','usu_ci');
//        return $this->belongsTo('App\atencion','usu_ci','usu_ci');
    }
}
