<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pacientes extends Model
{
    protected $table = 'pacientes';
    public function scopebuscar_pa_hcl($query, $pa_hcl)
    {
        $resultado = $query->where('pa_hcl', $pa_hcl);
        return $resultado;
    }

    public function scopeBusqueda($query, $num, $nom, $apep, $apem)
    {
        if ($num != null) {

            //$resultado= $query->where('pa_ci','like', $num.'%')->orwhere('pa_hcl','like',$num.'%');
            $resultado = $query->where('pa_ci', 'like', $num . '%')->orwhere('pa_hcl', $num);
        } else {
            if ($nom != null) {

                //select * from users where pais = $pais  and (nombres like %$dato% or apellidos like %$dato%  or email like  %$dato% )
                $resultado = $query->where('pa_nombre', 'like', '%' . $nom . '%')
                    ->Where(function ($q) use ($apep, $apem) {
                        $q->where('pa_appaterno', 'like', $apep . '%')
                            ->Where('pa_apmaterno', 'like', $apem . '%');
                    });
            } else {

                $resultado = $query->where('pa_appaterno', 'like', $apep . '%')
                    ->Where(function ($q) use ($apem) {
                        $q->where('pa_apmaterno', 'like', $apem . '%');
                    });
            }
        }

        return  $resultado;
    }
}
