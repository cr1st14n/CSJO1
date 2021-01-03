<?php

namespace App\Http\Controllers;

use App\permisos;
use App\usuPermiso;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PermisosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $per = new usuPermiso;
        $per->cod_usu = $request->input('codUsu1');
        $per->up_motivo = $request->input('motivo');
        $per->up_remplazo = $request->input('remplazo');
        $per->up_fechaSolicitud = $request->input('fechaSolicitud');
        $per->up_fechaPermiso = $request->input('fechaPermiso');
        $per->up_horaInicio = $request->input('horaInicio');
        $per->up_horaFinal = $request->input('horaFinal');
        $per->up_codRespaldoDoc = $request->input('codRespaldoDoc');
        // *---campos de auditoria
        $per->ca_usu_cod = Auth::user()->usu_ci;
        $per->ca_tipo = 'create';
        $per->ca_fecha = Carbon::now()->format('Y-m-d');
        $per->ca_estado = 1;
        $resp = $per->save();
        if ($resp) {
            return 'success';
        } else {
            return 'fail';
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\permisos  $permisos
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $idUsu = $request->input('userId');
        return usuPermiso::where('cod_usu', $idUsu)->orderBy('created_at', 'desc')->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\permisos  $permisos
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return usuPermiso::where('id', $request->input('id'))->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\permisos  $permisos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $r = usuPermiso::where('id', $request->input('id'))->update([
            'up_motivo' => $request->input('up_motivo'),
            'up_remplazo' => $request->input('up_remplazo'),
            'up_fechaSolicitud' => $request->input('up_fechaSolicitud'),
            'up_fechaPermiso' => $request->input('up_fechaPermiso'),
            'up_horaInicio' => $request->input('up_horaInicio'),
            'up_horaFinal' => $request->input('up_horaFinal'),
            'up_codRespaldoDoc' => $request->input('up_codRespaldoDoc'),
        ]);
        if ($r) {
            return 'success';
        } else {
            return 'fail';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\permisos  $permisos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $r=usuPermiso::where('id',$request->input('id'))->delete();
        if ($r) {
            return "success";
        }else {
            return "fail";
        }
    }
}
