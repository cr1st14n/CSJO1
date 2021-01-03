<?php

namespace App\Http\Controllers;

use App\recepNotas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AjaxNotPreController extends Controller
{

    public function listNotasActual($user){
        $fecha = Carbon::now()->format('Y-m-d');

        $notas = recepNotas::where('rn_cod_usu',$user)->where('rn_fecha',$fecha)->orderBy('ca_fecha','desc')->get();
        return $notas;
    }
    public function buscarNota($n){
        $nota = recepNotas::where('id',$n)->value('rn_nota');
        return  $nota;
    }

}
