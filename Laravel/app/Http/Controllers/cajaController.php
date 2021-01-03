<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use Carbon\Carbon;
use App\atencion;
use App\personalSalud;


class cajaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('acceso');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $fecha=Carbon::now()->format('Y-m-d');
        $paci_fila=atencion::where('ate_pago','pendiente')->where('ate_fecha',$fecha)->count();
        $paci_pagaron=atencion::where('ate_pago','cancelado')->where('ate_fecha',$fecha)->count();

        return view('viewCaja.cajaHome')->with("paci_fila",$paci_fila)->with("paci_pagaron",$paci_pagaron);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pacientes_cola()
    {   
        $date=Carbon::now();
        $date=$date->format('Y-m-d');
        $PC=atencion::where('ate_fecha',$date)
            ->join('pacientes','pacientes.pa_id','=','atencion.pa_id')
            ->join('especialidad','especialidad.id','=','atencion.ate_especialidad')
            ->join('personalSalud','personalSalud.id','=','atencion.ate_med')
            ->addSelect('atencion.*','especialidad.nombre','pacientes.pa_nombre','pacientes.pa_appaterno','pacientes.pa_apmaterno','pacientes.pa_ci','pacientes.pa_hcl','personalSalud.ps_appaterno','personalSalud.ps_apmaterno','personalSalud.ps_nombre')
            ->latest('atencion.created_at')
            ->paginate('50');

        //return $PC;0
        return view('viewCaja.pacicola')->with("PC",$PC);
    }
    public function pago($id)
    {
        $pago=atencion::where('id',$id)->value('ate_pago');
        if ($pago == 'pendiente') {
        $resul=atencion::where('id',$id)->update(['ate_pago'=>'cancelado']);
        if($resul){\Session::flash('flash_message_correcto', 'Pago registrado exitosamente.');}
        else
        {\Session::flash('flash_message_rechazado', 'Huvo un error al registrar el pago vuelva a intentarlo');}

        }elseif ($pago == 'cancelado') {
        $resul=atencion::where('id',$id)->update(['ate_pago'=>'pendiente']);
            
        if($resul){\Session::flash('flash_message_correcto', 'Pago modificado exitosamente.');}
        else
        {\Session::flash('flash_message_rechazado', 'Huvo un error al modificar el pago vuelva a intentarlo');}
        }

        return redirect()->action('cajaController@pacientes_cola');
    }
    public function store_show()
    {

    }
    public function store_pagos(Request $request)
    {
        $tabla='0';     
        $time=Carbon::now()->format('Y-m-d');
        $tipo='';
        $turno='';
        $ate_pago='';
        return view('viewCaja.listpago')->with("fecha",$time)->with("tabla",$tabla)->with("tipo",$tipo)->with("turno",$turno)->with("ate_pago",$ate_pago);
    }
    public function store_filter_pagos (Request $request)
    {
        $time=Carbon::now()->format('Y-m-d');

        $fecha= $request->input("pago_fecha");
        $turno= $request->input("turno");
        $tipo= $request->input("tipo");
        $ate_pago=$request->input("ate_pago");

        $pago_mañana='';
        $pago_tarde='';
        $pago_jornada='';
        $noPago='';
        switch ($turno) {
            case 'J':
                    switch ($tipo) {
                        case 'P':
                            $tabla='1';

                            $pago=atencion::where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->addSelect('atencion.*','especialidad.nombre','pacientes.pa_nombre','pacientes.pa_appaterno','pacientes.pa_hcl','pacientes.pa_apmaterno','pacientes.pa_ci')->join('pacientes','pacientes.pa_id','=','atencion.pa_id')->join('especialidad','especialidad.id','=','atencion.ate_especialidad')->latest('atencion.created_at')->get(); 
                //--con dos fechas $pago=atencion::select('id','ate_fecha')->where('ate_fecha','<', '2018-04-08')->where('ate_fecha','>', '2018-04-06')->get();
                            break;
                        case 'E':
                            $tabla='2';
                            $pago=atencion::join('especialidad','especialidad.id','=','atencion.ate_especialidad')->where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->select('ate_especialidad','nombre')->select(DB::raw('count(nombre) as count,nombre'))->groupBy('nombre')->get();
                            break;
                        case 'M':
                            $tabla='3';
                            $pago=atencion::where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->select(DB::raw('count(*) as count,ate_med'))->groupBy('ate_med')->get();

                            # code...
                            break;
                        case 'T':
                            $tabla='4';

                            $pago=atencion::where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->select(DB::raw('count(*) as count,ate_especialidad'))->groupBy('ate_especialidad')->get();
                            $pago_mañana=atencion::where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->where('ate_turno','Mañana')->count();
                            $pago_tarde=atencion::where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->where('ate_turno','Tarde')->count();
                            $pago_jornada=atencion::where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->count();
                            

                            # code...
                            break;
                    }
                break;
            case 'Mañana'|| 'Tarde':
                     switch ($tipo) {
                        case 'P':
                            $tabla='1';
                            $pago=atencion::where('ate_turno',$turno)->where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->addSelect('atencion.*','pacientes.pa_hcl','especialidad.nombre','pacientes.pa_nombre','pacientes.pa_appaterno','pacientes.pa_apmaterno','pacientes.pa_ci')->join('pacientes','pacientes.pa_id','=','atencion.pa_id')->join('especialidad','especialidad.id','=','atencion.ate_especialidad')->latest('atencion.created_at')->get();  
                            
                            break;

                        case 'E':
                            $tabla='2';
                            $pago=atencion::join('especialidad','especialidad.id','=','atencion.ate_especialidad')->where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->where('ate_turno',$turno)->select('ate_especialidad','nombre')->select(DB::raw('count(nombre) as count,nombre'))->groupBy('nombre')->get();
                            # code...
                            break;
                        case 'M':
                            $tabla='3';
                            $pago=atencion::where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->where('ate_turno',$turno)->select(DB::raw('count(*) as count,ate_med'))->groupBy('ate_med')->get();
                            

                            # code...
                            break;
                        case 'T':
                            $tabla='4';

                            $pago=atencion::where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->where('ate_turno',$turno)->select(DB::raw('count(*) as count,ate_especialidad'))->groupBy('ate_especialidad')->get();
                            $pago_mañana=atencion::where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->where('ate_turno',$turno)->where('ate_turno','Mañana')->count();
                            $pago_tarde=atencion::where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->where('ate_turno',$turno)->where('ate_turno','Tarde')->count();
                            $pago_jornada=atencion::where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->where('ate_turno',$turno)->count();

                            # code...
                            break;
                    }
            break;
            default:
                # code...
                break;
        }
        

        //return $pago;
        return view('viewCaja.listpago')->with("pago",$pago)->with("fecha",$fecha)->with("tabla",$tabla)->with("pago_mañana",$pago_mañana)->with("pago_tarde",$pago_tarde)->with("pago_jornada",$pago_jornada)->with("turno",$turno)->with("tipo",$tipo)->with("ate_pago",$ate_pago);
        
    }

    public function reportes()
    {
        $fecha_actual=Carbon::now()->format('Y-m-d');
        return view('viewCaja.formReportes')->with("fecha_actual",$fecha_actual);

    }
    public function reporteDiario(Request $Request )
    {
        $fecha_actual=Carbon::now()->format('d-m-Y');
        
        $fecha=$Request->input("p_fecha");
        
        $fecha= Carbon::parse($fecha)->format('Y-m-d');
        $fecha_re= Carbon::parse($fecha)->format('d-m-Y');
        $pago_mañana='';
        $pago_tarde='';
        $pago_jornada='';
        //$fecha_pago=$fecha->format('Y-m-d');
        $ate_pago=$Request->input("pago");
        $turno=$Request->input("turno");
        $tipo=$Request->input("tipo");
        switch ($tipo) {
            case 'P':
                $tipo_re='Paciente';
                break;
            case 'E':
                $tipo_re='Esepecialidad';
                break;
                case 'M':
                $tipo_re='Medico';
                    break;
                case 'T':
                $tipo_re='Estimacion Total';
                    break;
        }
        switch ($turno) {
            case 'Jornada':
                    switch ($tipo) {
                        case 'P':
                            $tabla='1';

                            $pago=atencion::where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->addSelect('atencion.*','especialidad.nombre','pacientes.pa_hcl','pacientes.pa_nombre','pacientes.pa_appaterno','pacientes.pa_apmaterno','pacientes.pa_ci','personalSalud.ps_appaterno','personalSalud.ps_apmaterno','personalSalud.ps_nombre')->join('pacientes','pacientes.pa_id','=','atencion.pa_id')->join('especialidad','especialidad.id','=','atencion.ate_especialidad')->join('personalSalud','personalSalud.id','=','atencion.ate_med')->latest('atencion.created_at')->get(); 
                //--con dos fechas $pago=atencion::select('id','ate_fecha')->where('ate_fecha','<', '2018-04-08')->where('ate_fecha','>', '2018-04-06')->get();
                            break;
                        case 'E':
                            $tabla='2';
                            $pago=atencion::join('especialidad','especialidad.id','=','atencion.ate_especialidad')->where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->select('ate_especialidad','nombre')->select(DB::raw('count(nombre) as count,nombre'))->groupBy('nombre')->get();
                            break;
                        case 'M':
                            $tabla='3';
                            $pago=atencion::join('personalSalud','personalSalud.id','=','atencion.ate_med')->where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->select(DB::raw('count(*) as count,ps_appaterno'))->groupBy('ps_appaterno')->get();
                            //$pago=$pago->join('personalSalud','personalSalud.id','=','id')->get();
                            //$pago=personalSalud::select('*');
                            //$pago=$pago->join('personalSalud','ate_med','=','count')->get();
                            //$pago=$pago->select('ate_med')->get();

                            # code...
                            break;
                        case 'T':
                            $tabla='4';

                            $pago=atencion::where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->select(DB::raw('count(*) as count,ate_especialidad'))->groupBy('ate_especialidad')->get();
                            $pago_mañana=atencion::where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->where('ate_turno','Mañana')->count();
                            $pago_tarde=atencion::where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->where('ate_turno','Tarde')->count();
                            $pago_jornada=atencion::where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->count();
                            $turno='Jornada';
                            

                            # code...
                            break;
                    }
                break;
            case 'Mañana'|| 'Tarde':
                     switch ($tipo) {
                        case 'P':
                            $tabla='1';
                            $pago=atencion::where('ate_turno',$turno)->where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->addSelect('atencion.*','especialidad.nombre','pacientes.pa_hcl','pacientes.pa_nombre','pacientes.pa_appaterno','pacientes.pa_apmaterno','pacientes.pa_ci','personalSalud.ps_appaterno','personalSalud.ps_apmaterno','personalSalud.ps_nombre')->join('pacientes','pacientes.pa_id','=','atencion.pa_id')->join('especialidad','especialidad.id','=','atencion.ate_especialidad')->join('personalSalud','personalSalud.id','=','atencion.ate_med')->latest('atencion.created_at')->get();  
                            
                            break;

                        case 'E':
                            $tabla='2';
                            $pago=atencion::join('especialidad','especialidad.id','=','atencion.ate_especialidad')->where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->where('ate_turno',$turno)->select('ate_especialidad','nombre')->select(DB::raw('count(nombre) as count,nombre'))->groupBy('nombre')->get();
                            # code...
                            break;
                        case 'M':
                            $tabla='3';
                            //$pago=atencion::where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->where('ate_turno',$turno)->select(DB::raw('count(*) as count,ate_med'))->groupBy('ate_med')->get();
                            $pago=atencion::join('personalSalud','personalSalud.id','=','atencion.ate_med')->where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->where('ate_turno',$turno)->select(DB::raw('count(*) as count,ps_appaterno'))->groupBy('ps_appaterno')->get();

                            # code...
                            break;
                        case 'T':
                            $tabla='4';

                            $pago=atencion::where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->where('ate_turno',$turno)->select(DB::raw('count(*) as count,ate_especialidad'))->groupBy('ate_especialidad')->get();
                            $pago_mañana=atencion::where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->where('ate_turno',$turno)->where('ate_turno','Mañana')->count();
                            $pago_tarde=atencion::where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->where('ate_turno',$turno)->where('ate_turno','Tarde')->count();
                            $pago_jornada=atencion::where('ate_fecha',$fecha)->where('ate_pago',$ate_pago)->where('ate_turno',$turno)->count();
                            $turno='Jornada';

                            # code...
                            break;
                    }
            break;
            default:
                # code...
                break;
        }
        

        //return "$fecha $ate_pago $turno $tipo";
        //return view('viewCaja.listpago')->with("pago",$pago)->with("fecha",$fecha)->with("tabla",$tabla)->with("pago_mañana",$pago_mañana)->with("pago_tarde",$pago_tarde)->with("pago_jornada",$pago_jornada)->with("turno",$turno)->with("tipo",$tipo)->with("ate_pago",$ate_pago);

        //return $pago;
        return view('pdf.reporteCaja')->with("fecha_actual",$fecha_actual)->with("tabla",$tabla)->with("pago",$pago)->with("turno",$turno)->with("ate_pago",$ate_pago)->with("tipo",$tipo)->with("fecha",$fecha)->with("tipo_re",$tipo_re)->with("fecha_re",$fecha_re)->with("pago_mañana",$pago_mañana)->with("pago_tarde",$pago_tarde)->with("pago_jornada",$pago_jornada);
    }
    public function reporteMensual(Request $Request )
    {
        $this->validator($Request->all())->validate();


        $fecha_actual=Carbon::now()->format('d-m-Y');
        
        $fecha_I=$Request->input("p_fecha_I");
        $fecha_F=$Request->input("p_fecha_F");
        $fecha_I=Carbon::parse($fecha_I)->format('Y-m-d');
        $fecha_F=Carbon::parse($fecha_F)->format('Y-m-d');
        $fecha_I_RE=Carbon::parse($fecha_I)->format('d-m-Y');
        $fecha_F_RE=Carbon::parse($fecha_F)->format('d-m-Y');
                

        //$fecha= Carbon::parse($fecha)->format('Y-m-d');
        //$fecha_re= Carbon::parse($fecha)->format('d-m-Y');
        $pago_mañana='';
        $pago_tarde='';
        $pago_jornada='';
        //$fecha_pago=$fecha->format('Y-m-d');
        $ate_pago=$Request->input("pago");
        $turno=$Request->input("turno");
        $tipo=$Request->input("tipo");
        switch ($tipo) {
            case 'P':
                $tipo_re='Paciente';
                break;
            case 'E':
                $tipo_re='Esepecialidad';
                break;
                case 'M':
                $tipo_re='Medico';
                    break;
                case 'T':
                $tipo_re='Estimacion Total';
                    break;
        }
        switch ($turno) {
            case 'Jornada':
                    switch ($tipo) {
                        case 'P':
                            $tabla='1';
                            
                            $pago=atencion::whereBetween('ate_fecha', [$fecha_I, $fecha_F])->where('ate_pago',$ate_pago)->addSelect('atencion.*','especialidad.nombre','pacientes.pa_hcl','pacientes.pa_nombre','pacientes.pa_appaterno','pacientes.pa_apmaterno','pacientes.pa_ci','personalSalud.ps_appaterno','personalSalud.ps_apmaterno','personalSalud.ps_nombre')->join('pacientes','pacientes.pa_id','=','atencion.pa_id')->join('especialidad','especialidad.id','=','atencion.ate_especialidad')->join('personalSalud','personalSalud.id','=','atencion.ate_med')->latest('atencion.created_at')->get(); 
                            //$pago=atencion::where('ate_fecha','=<',$fecha_I)->where('ate_fecha','>=',$fecha_F)->where('ate_pago',$ate_pago)->addSelect('atencion.*','especialidad.nombre','pacientes.pa_nombre','pacientes.pa_appaterno','pacientes.pa_apmaterno','pacientes.pa_ci','personalSalud.ps_appaterno','personalSalud.ps_apmaterno','personalSalud.ps_nombre')->join('pacientes','pacientes.pa_hcl','=','atencion.pa_hcl')->join('especialidad','especialidad.id','=','atencion.ate_especialidad')->join('personalSalud','personalSalud.id','=','atencion.ate_med')->latest('atencion.created_at')->get(); 
                //--con dos fechas $pago=atencion::select('id','ate_fecha')->where('ate_fecha','<', '2018-04-08')->where('ate_fecha','>', '2018-04-06')->get();
                            break;
                        case 'E':
                            $tabla='2';
                            $pago=atencion::join('especialidad','especialidad.id','=','atencion.ate_especialidad')->where('ate_fecha','>=',$fecha_I)->where('ate_fecha','<=',$fecha_F)->where('ate_pago',$ate_pago)->select('ate_especialidad','nombre')->select(DB::raw('count(nombre) as count,nombre'))->groupBy('nombre')->get();
                            break;
                        case 'M':
                            $tabla='3';
                            
                            $pago=atencion::join('personalSalud','personalSalud.id','=','atencion.ate_med')->where('ate_fecha','>=',$fecha_I)->where('ate_fecha','<=',$fecha_F)->where('ate_pago',$ate_pago)->select(DB::raw('count(*) as count,ps_appaterno'))->groupBy('ps_appaterno')->get();

                            # code...
                            break;
                        case 'T':
                            $tabla='4';

                            $pago=atencion::where('ate_fecha','>=',$fecha_I)->where('ate_fecha','<=',$fecha_F)->where('ate_pago',$ate_pago)->select(DB::raw('count(*) as count,ate_especialidad'))->groupBy('ate_especialidad')->get();
                            $pago_mañana=atencion::where('ate_fecha','>=',$fecha_I)->where('ate_fecha','<=',$fecha_F)->where('ate_pago',$ate_pago)->where('ate_turno','Mañana')->count();
                            $pago_tarde=atencion::where('ate_fecha','>=',$fecha_I)->where('ate_fecha','<=',$fecha_F)->where('ate_pago',$ate_pago)->where('ate_turno','Tarde')->count();
                            $pago_jornada=atencion::where('ate_fecha','>=',$fecha_I)->where('ate_fecha','<=',$fecha_F)->where('ate_pago',$ate_pago)->count();
                            $turno='Jornada';
                            

                            # code...
                            break;
                    }
                break;
            case 'Mañana'|| 'Tarde':
                     switch ($tipo) {
                        case 'P':
                            $tabla='1';
                            $pago=atencion::where('ate_turno',$turno)->where('ate_fecha','>=',$fecha_I)->where('ate_fecha','<=',$fecha_F)->where('ate_pago',$ate_pago)->addSelect('atencion.*','especialidad.nombre','pacientes.pa_nombre','pacientes.pa_hcl','pacientes.pa_appaterno','pacientes.pa_apmaterno','pacientes.pa_ci')->join('pacientes','pacientes.pa_id','=','atencion.pa_id')->join('especialidad','especialidad.id','=','atencion.ate_especialidad')->latest('atencion.created_at')->get();  
                            
                            break;

                        case 'E':
                            $tabla='2';
                            $pago=atencion::join('especialidad','especialidad.id','=','atencion.ate_especialidad')->where('ate_fecha','>=',$fecha_I)->where('ate_fecha','<=',$fecha_F)->where('ate_pago',$ate_pago)->where('ate_turno',$turno)->select('ate_especialidad','nombre')->select(DB::raw('count(nombre) as count,nombre'))->groupBy('nombre')->get();
                            # code...
                            break;
                        case 'M':
                            $tabla='3';
                            
                             $pago=atencion::join('personalSalud','personalSalud.id','=','atencion.ate_med')->where('ate_fecha','>=',$fecha_I)->where('ate_fecha','<=',$fecha_F)->where('ate_pago',$ate_pago)->where('ate_turno',$turno)->select(DB::raw('count(*) as count,ps_appaterno'))->groupBy('ps_appaterno')->get();

                            # code...
                            break;
                        case 'T':
                            $tabla='4';

                            $pago=atencion::where('ate_fecha','>=',$fecha_I)->where('ate_fecha','<=',$fecha_F)->where('ate_pago',$ate_pago)->where('ate_turno',$turno)->select(DB::raw('count(*) as count,ate_especialidad'))->groupBy('ate_especialidad')->get();
                            $pago_mañana=atencion::where('ate_fecha','>=',$fecha_I)->where('ate_fecha','<=',$fecha_F)->where('ate_pago',$ate_pago)->where('ate_turno',$turno)->where('ate_turno','Mañana')->count();
                            $pago_tarde=atencion::where('ate_fecha','>=',$fecha_I)->where('ate_fecha','<=',$fecha_F)->where('ate_pago',$ate_pago)->where('ate_turno',$turno)->where('ate_turno','Tarde')->count();
                            $pago_jornada=atencion::where('ate_fecha','>=',$fecha_I)->where('ate_fecha','<=',$fecha_F)->where('ate_pago',$ate_pago)->where('ate_turno',$turno)->count();
                            $turno='Jornada';
                            
                            # code...
                            break;
                    }
            break;
            default:
                # code...
                break;
        }
        

        
        //return "$fecha_F_RE $fecha_I_RE";
        return view('pdf.reporteCaja2')->with("fecha_actual",$fecha_actual)->with("tabla",$tabla)->with("pago",$pago)->with("turno",$turno)->with("ate_pago",$ate_pago)->with("tipo",$tipo)->with("fecha_I_RE",$fecha_I_RE)->with("fecha_F_RE",$fecha_F_RE)->with("tipo_re",$tipo_re)->with("pago_mañana",$pago_mañana)->with("pago_tarde",$pago_tarde)->with("pago_jornada",$pago_jornada);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            
            'p_fecha_I' => 'required|date|date_format:Y-m-d|before:today',
            'p_fecha_F' => 'required|date|date_format:Y-m-d|before:tomorrow',

        ]);
    }















    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
