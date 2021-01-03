<?php

namespace App\Http\Controllers;

use App\atencion;
use App\citPrev;
use App\especialidad;
use App\pacientes;
use App\personalSalud;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CitPrevController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function infoPaci(Request $request)
    {
        $especialidad=especialidad::orderBy('nombre')->get();
        $medico=personalSalud::select('id','ps_appaterno','ps_apmaterno','ps_nombre')->orderBy('ps_appaterno')->get();
        $pacientes= pacientes::where('pa_id',$request->input('id'))->first();
        $date=Carbon::now()->addDays(1)->format('Y-m-d');
        $data=['esp'=>$especialidad,'med'=>$medico,'pac'=>$pacientes,'date'=>$date];
        return $data;
    }
    public function create(Request $request)
    {
        $cp= new citPrev();
        $cp->cp_paciente= $request->input('ip_Pa');
        $cp->cp_especialidad= $request->input('especialidad');
        $cp->cp_procedimiento= $request->input('procedimiento');
        $cp->cp_med = $request->input('medico');
        $cp->cp_num_ticked= $request->input('nroTicked');
        $cp->cp_turno= $request->input('turno');
        $cp->cp_fecha= $request->input('fecha');
        $cp->cp_time= $request->input('hora');
        $cp->cp_observacion= $request->input('observacion');
        $cp->cp_estado= 0;
        $res=$cp->save();
        if ($res) {
            return 1;
        } else {
            return 0;
        }
        
    }
    public function indexCitasPrevias()
    {
        // return 'hola';
        $fechaActual=Carbon::now()->format('Y-m-d');
        $especialidad=especialidad::select('id','nombre')->get();
        $medicos=personalSalud::select('id','ps_appaterno','ps_nombre')->get();
        return view('viewRecepcion.homeCitasPrevias')
        ->with('fechActual',$fechaActual)
        ->with('especialidades',$especialidad)
        ->with('medicos',$medicos);
    }
    public function listCitasPrevias(Request $req)
    {
        if ($req->input('turno')=='Jornal') {
            return citPrev::where('cp_fecha',Carbon::parse($req->input('date')))->select('cit_prevs.id','cp_turno','cp_num_ticked','cp_time')
            ->where('cp_estado',0)
            ->join('pacientes as pa','pa.pa_id','cit_prevs.cp_paciente')->addSelect('pa_hcl','pa_nombre','pa_appaterno')
            ->join('especialidad as esp','esp.id','cit_prevs.cp_especialidad')->addSelect('esp.nombre')
            ->get();
        } else {
            return citPrev::where('cp_fecha',Carbon::parse($req->input('date')))->select('cit_prevs.id','cp_turno','cp_num_ticked','cp_time')
            ->where('cp_estado',0)
            ->join('pacientes as pa','pa.pa_id','cit_prevs.cp_paciente')->addSelect('pa_hcl','pa_nombre','pa_appaterno')
            ->join('especialidad as esp','esp.id','cit_prevs.cp_especialidad')->addSelect('esp.nombre')
            ->where('cp_turno',$req->input('turno'))
            ->get();
        }
    }
    public function agendarCitPrev(Request $request)
    {
        return citPrev::where('id',$request->input('id'))->first();
    }
    public function createCitPrevAgendar(Request $request)
    {
        citPrev::where('id',$request->input('id'))->update(['cp_estado'=>1]);
        if ($request->input('pago') == 'on') {
            $pago='cancelado';
        }else {
            $pago='pendiente';
        }
        $atencion = new atencion;
        $atencion->usu_ci = Auth::user()->usu_ci;
        $atencion->ate_cod = atencion::max('ate_cod')+1;
        $atencion->pa_id = citPrev::where('id',$request->input('id'))->value('cp_paciente');
        $atencion->ate_especialidad = $request->input('especialidad');
        $atencion->ate_procedimiento = $request->input('procedimiento');
        $atencion->ate_med = $request->input('medico');
        $atencion->ate_turno = $request->input('turno');
        $atencion->ate_fecha = $request->input('fecha');
        $atencion->time_at = Carbon::parse( $request->input('hora') )->format('H:i:s');
        $atencion->ate_num_ticked = $request->input('ticked');
        $atencion->ate_pago = $pago;
        $resul=$atencion->save();
        if ($resul) {
            return 1;
        } else {
            return 0;
        }
        
    }
    public function destroy(Request $request)
    {
        $res= citPrev::where('id',$request->input('id'))->delete();            
        return $res;
    }
    public function listagenda1(Request $request)
    {
        return citPrev::where(['cp_especialidad'=>$request->input('id'),'cp_fecha'=>$request->input('date')])
        ->join('pacientes as pa','pa.pa_id','cit_prevs.cp_paciente')
        ->select('cit_prevs.*')
        ->addSelect('pa.pa_hcl','pa.pa_nombre','pa.pa_appaterno')
        ->get();
    }
}
