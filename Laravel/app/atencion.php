<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class atencion extends Model
{
     protected $table = 'atencion';

     public function scopeBusquedaAtencion($query,$turno,$tipo,$fecha)
     {
     			$resultado=$query->where('ate_turno',$turno)
     								->where(function($q)use($fecha){
     									$q->where('ate_fecha',$fecha);});
     return $resultado;
     }
    public function scopeUsuarios()
    {
        return $this->belongsTo(User::class,'usu_ci','usu_ci');
    }
}


     		
   	


     

