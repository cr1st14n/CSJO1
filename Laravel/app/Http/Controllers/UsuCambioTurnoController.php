<?php

namespace App\Http\Controllers;

use App\usuCambioTurno;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuCambioTurnoController extends Controller
{
    public function list(Request $request)
    {
        return usuCambioTurno::where('cod_usu',$request->input('id'))->orderBy('created_at','desc')->get();
    }

    public function create(Request $request)
    {
        $n=new usuCambioTurno();
        $n->cod_usu=$request->input('cod_usu');
        $n->cod_usu2=$request->input('cod_usu2');
        $n->uct_codDoc=$request->input('uct_codDoc');
        $n->uct_motivo=$request->input('uct_motivo');
        $n->uct_fecha=$request->input('uct_fecha');
        $n->uct_horario=$request->input('uct_horario');
        $n->ca_usu_cod=Auth::user()->usu_ci;
        $n->ca_tipo="create";
        $n->ca_fecha=Carbon::now()->format('Y-m-d');
        $n->ca_estado="1";
        $r=$n->save();
        if ($r) {
            return "success";
        } else {
            return "fail";
        }
        
    }

    public function edit(Request $request)
    {
        return usuCambioTurno::where('id',$request->input('id'))->first();
    }

    public function update(Request $request)
    {
        $r=usuCambioTurno::where('id',$request->input('id'))->update([
            'uct_motivo'=>$request->input('uct_motivo'),
            'cod_usu2'=>$request->input('cod_usu2'),
            'uct_fecha'=>$request->input( 'uct_fecha'),
            'uct_codDoc'=>$request->input('uct_codDoc'),
            'uct_horario'=>$request->input('uct_horario')
           
        ]);
        if ($r) {
            return "success";
        } else {
            return "fail";
        }
        
    }

    public function delete(Request $request)
    {
        $r=usuCambioTurno::where('id',$request->input('id'))->delete();
        if ($r) {
            return "success";
        } else {
            return "fail";
        }
        
    }
}
