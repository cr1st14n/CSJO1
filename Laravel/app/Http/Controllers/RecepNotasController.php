<?php

namespace App\Http\Controllers;

use App\recepNotas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\personalSalud;



class RecepNotasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('viewRecepcion.FormNotasrecepcion');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $nota = new recepNotas();
        $nota->rn_cod_usu = Auth::user()->usu_ci;
        $nota->rn_fecha = Carbon::now()->format('Y-m-d');;
        $nota->rn_nota = $request->input('nota');
        $nota->ca_cod_usu = Auth::user()->usu_ci;
        $nota->ca_tipo = "create";
        $nota->ca_fecha = Carbon::now();
        $nota->ca_estado = "1";
        $res = $nota->save();
        if ($res){
            $usu= $nota->rn_cod_usu;
            $fecha=$nota->rn_fecha;
            $notas = recepNotas::where('rn_cod_usu',$usu)->where('rn_fecha',$fecha)->orderBy('ca_fecha','desc')->get();
            return $notas;
        }else{
            return "error";
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
     * @param  \App\recepNotas  $recepNotas
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $usu = Auth::user()->usu_ci;
        $fecha = Carbon::now()->format('Y-m-d');
        $notas = recepNotas::where('rn_cod_usu',$usu)->where('rn_fecha',$fecha)->orderBy('ca_fecha','desc')->get();
        return $notas;
    }
    public function filtrarPrestamos(Request $request)
    {
        $fecha= $request->input("fechaFiltro");
        return recepNotas::whereDate('created_at',$fecha)->get();
    }
    public function edit(recepNotas $recepNotas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\recepNotas  $recepNotas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->input("id");
        $nota=$request->input('nota');
        $fecha = Carbon::now()->format('Y-m-d');
        $ca_fecha = Carbon::now();
        $usu= Auth::user()->usu_ci;
       $res = recepNotas::where('id',$id)->update(['rn_nota' => $nota,'ca_tipo'=>"update",'ca_fecha'=> $ca_fecha,'ca_cod_usu'=>$usu]);
       if ($res){
           $notas = recepNotas::where('rn_cod_usu',$usu)->where('rn_fecha',$fecha)->orderBy('ca_fecha','desc')->get();
           return $notas;
       }else{
           return "error";
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\recepNotas  $recepNotas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //return "error";
        $res = recepNotas::where('id',$id)->delete();
        if ($res){
            $usu = Auth::user()->usu_ci;
            $fecha = Carbon::now()->format('Y-m-d');
            $notas = recepNotas::where('rn_cod_usu',$usu)->where('rn_fecha',$fecha)->orderBy('ca_fecha','desc')->get();
            return $notas;
        }else{
            return "error";
        }

    }
//    ----- funciones para presaramos de HCL
    public function listUset(){

    }
}
