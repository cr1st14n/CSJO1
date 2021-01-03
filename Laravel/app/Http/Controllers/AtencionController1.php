<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Pacientes;
use App\atencion;
use App\PersonalSalud;
use App\especialidad;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AtencionController extends Controller
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
    //se esta enviando la ID no el pahcl
    public function index($pa_hcl)
    {   
        $turno=Carbon::now()->format('A');
        if ($turno == 'PM') {
            $turno='Tarde';
        } elseif ($turno == 'AM') {
            $turno='Mañana';
        }

        $especialidad=DB::table('especialidad')->orderBy('nombre')->get();
        //$medico= DB::table('users')->where('usu_tipo','medio')->get();
        $medico=PersonalSalud::select('id','ps_appaterno','ps_apmaterno','ps_nombre')->orderBy('ps_appaterno')->get();
         //$paciente=Pacientes::where('pa_hcl','//');
         $dato = DB::table('Pacientes')->where('pa_id',$pa_hcl)->first();
         $var = $dato->pa_zona;
         if ($var == 'SAN LUIS TASA') {
                
                $ZD='descuento' ;
         }else { 
                $ZD='';
         }
             
         //$contador=count($paciente->pa_hcl);
         $FN = DB::table('Pacientes')->where('pa_id',$pa_hcl)->value('pa_fechnac'); 
         $FN = Carbon::parse($FN)->format('Y-m-d');
         $FecNac = Carbon::parse($FN)->format('d-m-Y');
         $act = Carbon::now()->format('Y-m-d');
          if ($FN > $act || $FN == null) {
              $edad='Error en fecha de nacimiento';
          }else {
              //$edad=Carbon::parse('2017-03-15')->age;;
                $eda= Carbon::parse($FN)->age;
                if ($eda == '1') {
                $edad= " $eda año";
                }elseif ($eda > '1') {
                $edad= " $eda años";
                }elseif ($eda == '0') {
                $edad= "Recien nacido o menor a un año de edad ";
                }
          }


         //$e=  Carbon::parse('2017-03-15')->age;
         //$d = $e->format('d');
         //$m = $e->format('m');
         //$a = $e->format('Y');
        //$edad = DB::table('Pacientes')->where('pa_hcl',$pa_hcl)->value('pa_nombre'); // 43
         //$edad = Carbon::createFromDate($e)->age; // 43
         //$edad = $e;
         if($dato != null){          
           return  view('viewRecepcion.FormRegisterAtencion')->with("dato",$dato)->with("especialidad",$especialidad)->with("medico",$medico)->with("edad",$edad)->with("FecNac",$FecNac)->with("ZD",$ZD)->with("turno",$turno);
           // return view("viewRecepcion.FormRegisterAtencion")->with("paciente",$paciente);    
        }
        else
        {            
            \Session::flash('flash_message_rechazado', 'Error inesperado vuelva a intertarlo');
            return redirect()->back();  
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        $data=Request()->all();
        $this->validator($request->all())->validate();
        
        $datetime = Carbon::now()->format('Y-m-d');
        $time_at = Carbon::now()->format('H:i');
        $user = Auth::user()->usu_ci;
        $ate_cod = DB::table('atencion')->max('ate_cod')+1;
        $turno=$data["ate_turno"];
        $tipo='';
        $especialidad=$data["ate_especialidad"];
        $A_P=$request->input("R_P");
        if ($A_P == 'on') {
            $pago='cancelado';
        }else {
            $pago='pendiente';
        }
        //$ticked=atencion::BusquedaAtencion($turno,$tipo,$datetime)->where('ate_especialidad',$especialidad)->max('ate_num_ticked')+1;


        
        $atencion = new atencion;
        $atencion->usu_ci = $user;
        $atencion->ate_cod = $ate_cod;
        $atencion->pa_id = $data["pa_id"];
        $atencion->ate_especialidad = $data["ate_especialidad"];
        $atencion->ate_procedimiento = $data["ate_procedimiento"];
        $atencion->ate_med = $data["ate_med"];
        //$atencion->ate_descripcion = $data["ate_descripcion"];
        $atencion->ate_turno = $data["ate_turno"];
        $atencion->ate_fecha = $datetime;
        $atencion->time_at = $time_at;

        $atencion->ate_num_ticked = $data["ticked"];
        $atencion->ate_pago = $pago;

        $resul=$atencion->save();
        if($resul){
            \Session::flash('flash_message_correcto', 'Atencion registrada exitosamente.');
            //return view("mensajes.msj_correcto")->with("msj","Usuario Registrado Correctamente");   
        }
        else
        {
             \Session::flash('flash_message_rechazado', 'Huvo un error al registrar la atecion vuelva a intentarlo');
            // return view("mensajes.msj_rechazado")->with("msj","hubo un error vuelva a intentarlo");  

        }
        //event(new Registered($user = $this->create($request->all())));
       //ingreso luego del registro  $this->guard()->login($user);      
        return redirect ()->route('form_buscar_paciente');
       






       
    }
     protected function validator(array $data)
    {
        return Validator::make($data, [
            
            'usu_ci'=>'',
            'pa_id'=>'required',
            'ate_especialidad'=>'required',
            'ate_procedimiento'=>'required',
            'ate_med'=>'required',
            'ate_descripcion'=>'string|max:200|nullable',
            'ate_turno'=>'required',
            'ticked'=>'required',
            

        ]);
    }
    protected function validator_update(array $data)
    {
        return Validator::make($data, [
            
            'ate_especialidad'=>'required',
            'ate_procedimiento'=>'required',
            'ate_med'=>'required',
            'ate_descripcion'=>'string|max:200|nullable',
            'ate_turno'=>'required',
            'ticked'=>'required',

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showAll(Request $request)
    {
        $actualizar='0';
        $time=Carbon::now();
        $time=$time->format('Y-m-d');
        $tabla='1';  
        $tipo='P';
        $turno=Carbon::now()->format('A');
        if ($turno == 'PM') {
            $turno='Tarde';
            $turno_1='T';
        } elseif ($turno == 'AM') {
            $turno='Mañana';
            $turno_1='M';
        }
        $atencion=atencion::join('especialidad','especialidad.id','=','atencion.ate_especialidad')->join('pacientes','pacientes.pa_id','=','atencion.pa_id')->join('personalSalud','personalSalud.id','=','atencion.ate_med')->orderBy('atencion.created_at','desc' )->where('ate_turno','like' ,$turno.'%')->where('ate_fecha',$time)->select('atencion.id as ate_id','pacientes.pa_hcl','atencion.ate_turno','atencion.ate_num_ticked','atencion.ate_pago','especialidad.nombre','personalSalud.ps_nombre','personalSalud.ps_appaterno','personalSalud.ps_apmaterno','atencion.created_at','atencion.time_at')->latest('ate_id' )->get();   


        //$atencion=atencion::SELECT(DB::raw('count(*) as agrupado,ate_turno'))->where('ate_fecha',$time)->groupBy('ate_turno')->get();
        //return $time;
        return view('viewRecepcion.FormListAtencion')->with("atencion",$atencion)->with("time",$time)->with("tabla",$tabla)->with("turno",$turno_1)->with("tipo",$tipo)->with("actualizar",$actualizar);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {   
        $actualizar='0';
        $data=Request()->all();
        $fecha=$data["fecha"];
        $turno=$data["turno"];
        $tipo=$data["tipo"];
        $tabla='';
        $texto="Selecciono $tipo en turno $turno ";
        switch ($turno) {
            case 'J':
            if ($tipo=='P') {
                $tabla='1';
                $resultado=atencion::join('especialidad','especialidad.id','=','atencion.ate_especialidad')->join('pacientes','pacientes.pa_id','=','atencion.pa_id')->join('personalSalud','personalSalud.id','=','atencion.ate_med')->orderBy('atencion.created_at','desc' )->where('ate_fecha',$fecha)->select('atencion.id as ate_id','pacientes.pa_hcl','atencion.ate_turno','atencion.ate_num_ticked','atencion.ate_pago','especialidad.nombre','personalSalud.ps_nombre','personalSalud.ps_appaterno','personalSalud.ps_apmaterno','atencion.created_at')->latest('ate_id' )->get();     
                
                //$resultado=atencion::latest('created_at')->where('ate_fecha',$fecha)->get();  
            }elseif ($tipo=='E') {
                $tabla='2';
                $resultado=atencion::join('especialidad','especialidad.id','=','atencion.ate_especialidad')->SELECT(DB::raw('count(*) as agrupado,nombre'))->where('ate_fecha',$fecha)->groupBy('nombre')->get();   
                //$resultado=atencion::SELECT(DB::raw('count(*) as agrupado,ate_especialidad'))->where('ate_fecha',$fecha)->groupBy('ate_especialidad')->get();    
            }elseif ($tipo=='T') {
                $tabla='2';
                $resultado=atencion::SELECT(DB::raw('count(*) as agrupado,ate_turno'))->where('ate_fecha',$fecha)->groupBy('ate_turno')->get();
            }
                break;
                
            case 'M'||'T':
                if ($tipo=='P') {
                    $tabla='1';
                $resultado=atencion::join('especialidad','especialidad.id','=','atencion.ate_especialidad')->join('pacientes','pacientes.pa_id','=','atencion.pa_id')->join('personalSalud','personalSalud.id','=','atencion.ate_med')->orderBy('atencion.created_at','desc' )->where('ate_fecha',$fecha)->where('ate_turno','like' ,$turno.'%')->select('atencion.id as ate_id','pacientes.pa_hcl','atencion.ate_turno','atencion.ate_num_ticked','atencion.ate_pago','especialidad.nombre','personalSalud.ps_nombre','personalSalud.ps_appaterno','personalSalud.ps_apmaterno','atencion.created_at')->latest('ate_id' )->get();      
                  
                }elseif ($tipo=='E') {
                    $tabla='2';
                //$resultado=atencion::SELECT(DB::raw('count(*) as agrupado,ate_especialidad'))->where('ate_fecha',$fecha)->groupBy('ate_especialidad')->where('ate_turno','like' ,$turno.'%')->get();
                $resultado=atencion::join('especialidad','especialidad.id','=','atencion.ate_especialidad')->SELECT(DB::raw('count(*) as agrupado,nombre'))->where('ate_fecha',$fecha)->where('ate_turno','like' ,$turno.'%')->groupBy('nombre')->get();   
                }elseif ($tipo=='T') {
                    $tabla='2';
                $resultado=atencion::SELECT(DB::raw('count(*) as agrupado,ate_turno'))->where('ate_fecha',$fecha)->groupBy('ate_turno')->where('ate_turno','like' ,$turno.'%')->get();  
                }
               
                
                break;
            
            default:
                # code...
                break;
        }

       //return "$fecha $turno  $tipo $resultado ";
        return view('viewRecepcion.FormListAtencion')->with("atencion",$resultado)->with("time",$fecha)->with("tipo",$tipo)->with("turno",$turno)->with("actualizar",$actualizar);



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPa_Ate1()
    {
        $t='0';
        $actualizar='0';
        $turno='';
        $fecha=Carbon::now()->format('Y-m-d');
        $t=Carbon::now()->format('A');
        if ($t =='AM') {$turno = 'M';}elseif ($t == 'PM') {$turno = 'T';}

        $especialidades=especialidad::select('id','nombre')->orderBy('nombre', 'asc')->get();
        return view('viewRecepcion.FormListPa_Ate')->with("time",$fecha)->with("turno",$turno)->with("actualizar",$actualizar)->with('ESP',$especialidades)->with("t",$t);
        
    }
    public function showPa_Ate_list(Request $request)
    {
        $t='1';
        $actualizar='0';
        $fecha= $request->input("fecha");
        $turno= $request->input("turno");
        $tipo= $request->input("tipo");
        $especialidades=especialidad::select('id','nombre')->orderBy('nombre', 'asc')->get();
        if ($turno == 'J') {
            $atencion=atencion::where('ate_especialidad',$tipo)->where('ate_fecha',$fecha)->join('especialidad','especialidad.id','=','atencion.ate_especialidad')->join('pacientes','pacientes.pa_id','=','atencion.pa_id')->join('personalSalud','personalSalud.id','=','atencion.ate_med')->select('atencion.id as ate_id','pacientes.pa_hcl','pacientes.pa_nombre','pacientes.pa_appaterno','pacientes.pa_ci','pacientes.pa_apmaterno','atencion.ate_turno','atencion.ate_num_ticked','atencion.ate_pago','especialidad.nombre','personalSalud.ps_nombre','personalSalud.ps_appaterno','personalSalud.ps_apmaterno','atencion.created_at')->orderBy('ate_turno','asc')->orderBy('ate_num_ticked','desc')->get();    
        }else {
            $atencion=atencion::where('ate_especialidad',$tipo)->where('ate_fecha',$fecha)->where('ate_turno',$turno)->join('especialidad','especialidad.id','=','atencion.ate_especialidad')->join('pacientes','pacientes.pa_id','=','atencion.pa_id')->join('personalSalud','personalSalud.id','=','atencion.ate_med')->select('atencion.id as ate_id','pacientes.pa_hcl','pacientes.pa_nombre','pacientes.pa_appaterno','pacientes.pa_ci','pacientes.pa_apmaterno','atencion.ate_turno','atencion.ate_num_ticked','atencion.ate_pago','especialidad.nombre','personalSalud.ps_nombre','personalSalud.ps_appaterno','personalSalud.ps_apmaterno','atencion.created_at')->orderBy('ate_turno','asc')->orderBy('ate_num_ticked','desc')->get();
        }
        

        
        //return "$atencion";
         
        return view('viewRecepcion.FormListPa_Ate')->with("time",$fecha)->with("tipo",$tipo)->with("turno",$turno)->with("actualizar",$actualizar)->with('ESP',$especialidades)->with('atencion',$atencion)->with("t",$t);

    }
    public function edit($ate_id)
    {
        $atencion=atencion::where('id',$ate_id)->first();
        $nom_especialidad=especialidad::where('id',($atencion->ate_especialidad))->value('nombre');
        $especialidad=DB::table('especialidad')->orderBy('nombre')->get();
        $medico=PersonalSalud::select('id','ps_appaterno','ps_apmaterno','ps_nombre')->orderBy('ps_appaterno')->get();
        $dato=atencion::where('id',$ate_id)->value('pa_id');
        $dato=pacientes::where('pa_id',$dato)->first();
        $var = $dato->pa_zona;
         if ($var == 'SAN LUIS TASA') {
                $ZD='descuento' ;
         }else { 
                $ZD='';
         }
         $FN = $dato->pa_fechnac; 
         $FN = Carbon::parse($FN)->format('Y-m-d');
         $FecNac = Carbon::parse($FN)->format('d-m-Y');
         $act = Carbon::now()->format('Y-m-d');
          if ($FN > $act || $FN == null) {
              $edad='Error en fecha de nacimiento';
          }else {
              //$edad=Carbon::parse('2017-03-15')->age;;
                $eda= Carbon::parse($FN)->age;
                if ($eda == '1') {
                $edad= " $eda año";
                }elseif ($eda > '1') {
                $edad= " $eda años";
                }elseif ($eda == '0') {
                $edad= "Recien nacido o menor a un año de edad ";
                }
          }

        return  view('viewRecepcion.FormEditAtencion')->with("dato",$dato)->with("especialidad",$especialidad)->with("medico",$medico)->with("edad",$edad)->with("FecNac",$FecNac)->with("ZD",$ZD)->with("atencion",$atencion)->with("nom_especialidad",$nom_especialidad);
         /*
         if($dato != null){          
           return  view('viewRecepcion.FormRegisterAtencion')->with("dato",$dato)->with("especialidad",$especialidad)->with("medico",$medico)->with("edad",$edad)->with("FecNac",$FecNac)->with("ZD",$ZD);
           // return view("viewRecepcion.FormRegisterAtencion")->with("paciente",$paciente);    
        }
        else
        {            
            \Session::flash('flash_message_rechazado', 'Error inesperado vuelva a intertarlo');
            return redirect()->back();  
        }*/



        //return "$dato ";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validator_update($request->all())->validate();
        
        $turno=$request->input("ate_turno");
        $especialidad=$request->input("ate_especialidad");
        
        $tipo='';
        $datetime=Carbon::now()->format('Y-m-d');
        $time_at = Carbon::now()->format('H:i');

        //$ticked=atencion::BusquedaAtencion($turno,$tipo,$datetime)->where('ate_especialidad',$especialidad)->max('ate_num_ticked')+1;
       
        $id=$request->input("ate_id");
        //return"$id $turno $especialidad $ate_procedimiento $ate_med $ate_descripcion $datetime $ticked";
        
        $resul=atencion::where('id',$id)->update(['ate_especialidad'=>$request->input("ate_especialidad"),
                                                     'ate_procedimiento'=>$request->input("ate_procedimiento"),
                                                     'ate_med'=>$request->input("ate_med"),   
                                                     'ate_num_ticked'=>$request->input("ticked"),   
                                                     //'ate_descripcion'=>$request->input("ate_descripcion"),   
                                                     'ate_turno'=>$request->input("ate_turno"),
                                                      ]);
         if($resul){
            \Session::flash('flash_message_correcto', 'Atencion actualizada exitosamente.');
            //return view("mensajes.msj_correcto")->with("msj","Usuario Registrado Correctamente");   
        }
        else
        {
             \Session::flash('flash_message_rechazado', 'Huvo un error al actualizar vuelva a intentarlo');
            // return view("mensajes.msj_rechazado")->with("msj","hubo un error vuelva a intentarlo");  

        }
        return redirect()->action('AtencionController@showAll');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $atencion=atencion::find($id);
        $resultado=$atencion->delete();
        $actualizar='1';

        if($resultado){
            \Session::flash('flash_message_correcto', 'registro eliminado exitosamente.');
            //return view("mensajes.msj_correcto")->with("msj","Usuario Registrado Correctamente");   
        }
        else
        {
             \Session::flash('flash_message_rechazado', 'Huvo un error al eliminar registro vuelva a intentarlo');
            // return view("mensajes.msj_rechazado")->with("msj","hubo un error vuelva a intentarlo");  

        }
         return redirect()->route('showAll_atencion')->with("actualizar",$actualizar);


    }
/*---------GENERADOR DE REPORTES----------------*/
    public function reporte_index(Request $Request)
    {
    $fecha_actual=Carbon::now()->format('Y-m-d');

    return view('viewRecepcion.formReportePacientes')->with("fecha_actual",$fecha_actual);
    }
    public function reporte_diario(Request $Request)
    {
        $tipo=$Request->input("tipo_reporte");
        $p_fecha=$Request->input("p_fecha");

        if ($tipo == 'C') {
        $data = pacientes::where('ca_fecha','like',$p_fecha.'%')->orderBy('pa_hcl', 'desc')->get();
        return  view('pdf.reporteRecepcion2')->with("pacientes",$data);  
        }elseif ($tipo == 'R') {
        
        $fecha_actual=Carbon::now()->format('d-m-Y');
        $fecha=Carbon::parse($p_fecha)->format('d-m-Y');
        $data = pacientes::where('ca_fecha','like',$p_fecha.'%')->get();
        $total_p = pacientes::where('ca_fecha','like',$p_fecha.'%')->count();
        //return $data;
        return view('pdf.reporteRecepcion1')->with("fecha",$fecha)->with("fecha_actual",$fecha_actual)->with("pacientes",$data)->with("total_p",$total_p);
        }elseif ($tipo == 'I_D') {

            $fecha=Carbon::parse($p_fecha)->format('d-m-Y');
            $to_afi=pacientes::where('ca_fecha','like',$p_fecha.'%')->count();
            $to_ate=atencion::where('ate_fecha',$p_fecha)->count();
            $atencion=atencion::where('ate_fecha',$p_fecha)->join('especialidad','especialidad.id','=','atencion.ate_especialidad')->join('pacientes','pacientes.pa_id','=','atencion.pa_id')->join('personalSalud','personalSalud.id','=','atencion.ate_med')->select('atencion.id as ate_id','pacientes.pa_hcl','pacientes.pa_nombre','pacientes.pa_appaterno','pacientes.pa_ci','pacientes.pa_apmaterno','atencion.ate_turno','atencion.ate_num_ticked','atencion.ate_pago','especialidad.nombre','personalSalud.ps_nombre','personalSalud.ps_appaterno','personalSalud.ps_apmaterno','atencion.created_at')->orderBy('ate_turno','asc')->orderBy('ate_med','asc')->orderBy('ate_num_ticked','asc')->get();
        return view('pdf.reporteRecepcion3')->with("fecha",$p_fecha)->with("fecha_actual",$fecha)->with("atencion",$atencion)->with("to_afi",$to_afi)->with("to_ate",$to_ate);

        }





    }

    //pago de ficha
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

        return redirect()->action('AtencionController@showAll');
    }
}
