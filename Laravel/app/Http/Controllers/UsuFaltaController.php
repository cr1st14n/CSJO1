<?php

namespace App\Http\Controllers;

use App\usuFalta;
use Illuminate\Http\Request;

class UsuFaltaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        return usuFalta::where('cod_usu',$request->input('userId'))->orderby('created_at','desc')->get();
    }
    public function create(Request $request)
    {
        $nf=new usuFalta();
        $nf->cod_usu=$request->input('codUsu1');
        $nf->uf_motivo=$request->input('uf_motivo');
        $nf->uf_fecha=$request->input('uf_fecha');
        $nf->uf_horario=$request->input('uf_horario');
        $nf->uf_codDoc=$request->input('uf_codDoc');
        $r=$nf->save();
        if ($r) {
            return "success";
        } else {
            return "fail";
        }  
        return "fail";
    }
    public function edit(Request $request)
    {
        return usuFalta::where('id',$request->input('id'))
        ->select('cod_usu','uf_codDoc','uf_motivo','uf_fecha','uf_horario','id')
        ->first();
    }
    public function update(Request $request)
    {
        $r=usuFalta::where('id',$request->input('id'))
            ->update(['uf_motivo'=>$request->input('uf_motivo'),
                        'uf_fecha'=>$request->input('uf_fecha'),
                        'uf_horario'=>$request->input('uf_horario'),
                        'uf_codDoc'=>$request->input('uf_codDoc')]);
        if ($r) {
            return "success";
        } else {
            return "fail";
        }
        
    }
    public function delete(Request $request)
    {
        $r = usuFalta::where('id',$request->input('id'))->delete();
        if ($r) {
            return "success";
        } else {
            return "fail";
        }
        
    }
}
