<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use DB;
use App\atencion;
use App\pacientes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('acceso');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $user = Auth::user()->usu_area;
        $acceso = Auth::User()->usu_acceso;
        if ($acceso == '1' ) {

            switch ($user) {
                case 'Administracion':
                    # code...
                    //return 'estas en adm';
                    return redirect()->route('adm.Home');
                    break;
                case 'Recepcion':
                    # code...
                    //return 'estas en recepcion';
                    return redirect()->route('recepcion.home');
                    break;
                case 'Caja':
                    # code...
                    return redirect()->route('cajaHome');
                    break;
                case 'internaciones':
                    # code...
                    break;
                case 'Quirofano':
                    # code...
                    break;
                default:
                    # code...
            return "jeje no da $user";
                    break;
            }
        }else {
            return view('block');
        }

        //return view('home');
    }


    public function admHome()
    {
        return view('viewAdm.admHome');
    }
    public function datosAdmHome()
    {
        $data = array();
        array_push($data, pacientes::max('pa_hcl'));
        array_push($data, User::where('id', '>', 0)->select('id')->count('id'));
        return $data;
    }
    public function recepHome()
    {
        $paciente=DB::table('pacientes')->max('pa_hcl');
        $areas=DB::table('area')->count();
        $especialidades=DB::table('especialidad')->count();
        $fecha=Carbon::now();
        $fecha=$fecha->format('Y-m-d');
        $Turno_mañana = atencion::where('ate_turno','Mañana')->where('ate_fecha',$fecha)->count('pa_id');
        $Turno_tarde = atencion::where('ate_turno','Tarde')->where('ate_fecha',$fecha)->count('pa_id');


        $resultado=atencion::SELECT(DB::raw('count(*) as agrupado,ate_turno'))->where('ate_fecha',$fecha)->groupBy('ate_turno')->get();
        return view('viewRecepcion.home')->with("paciente",$paciente)->with("areas",$areas)->with("especialidades",$especialidades)->with("Turno_mañana",$Turno_mañana)->with("Turno_tarde",$Turno_tarde);
    }
    public function store_perfil()
    {
        $usuario= Auth::user()->usu_area;
        switch ($usuario) {
            case 'Administracion':
                return view('formUserEditAdm');
                break;
            case 'Recepcion':
                return view('formUserEditRecepcion');
                break;
            case 'Caja':
                return view('formUserEditCaja');
                break;
            default:
                return redirect()->back();
                break;
        }



        return " ";
    }
    public function update_perfil_datos(Request $Request)
    {
        $usuario=$Request->input("usu_ci");
        $user=Auth::user()->usu_ci;;
        $id=Auth::user()->id;

        if ($usuario == $user) {

        $this->validar_date_1($Request->all())->validate();
        $resultado=User::where('id',$id)->update([ 'usu_nombre'=>$Request->input("usu_nombre"),
                                                   'usu_appaterno'=>$Request->input("usu_appaterno"),
                                                   'usu_apmaterno'=>$Request->input("usu_apmaterno"),
                                                   'usu_fechnac'=>$Request->input("usu_fechnac"),
                                                   'usu_sexo'=>$Request->input("usu_sexo"),
                                                   'usu_zona'=>$Request->input("usu_zona"),
                                                   'usu_domicilio'=>$Request->input("usu_domicilio"),
                                                   'usu_telf'=>$Request->input("usu_telf"),
                                                   'usu_telfref'=>$Request->input("usu_telfref"),
                                                    ]);
            if($resultado){
                \Session::flash('flash_message_correcto', 'Datos actualizados exitosamente.');
                //return view("mensajes.msj_correcto")->with("msj","Usuario Registrado Correctamente");   
            }
            else
            {
                 \Session::flash('flash_message_rechazado', 'Huvo un error al actualizar tus datos vuelva a intentarlo');
                // return view("mensajes.msj_rechazado")->with("msj","hubo un error vuelva a intentarlo");  

            }

        return redirect()->back();
        }elseif ($usuario != $user) {
        $this->validar_date_2($Request->all())->validate();
        $resultado=User::where('id',$id)->update([ 'usu_ci'=>$Request->input("usu_ci"),
                                                   'usu_nombre'=>$Request->input("usu_nombre"),
                                                   'usu_appaterno'=>$Request->input("usu_appaterno"),
                                                   'usu_apmaterno'=>$Request->input("usu_apmaterno"),
                                                   'usu_fechnac'=>$Request->input("usu_fechnac"),
                                                   'usu_sexo'=>$Request->input("usu_sexo"),
                                                   'usu_zona'=>$Request->input("usu_zona"),
                                                   'usu_domicilio'=>$Request->input("usu_domicilio"),
                                                   'usu_telf'=>$Request->input("usu_telf"),
                                                   'usu_telfref'=>$Request->input("usu_telfref"),
                                                    ]);
            if($resultado){
                \Session::flash('flash_message_correcto', 'Datos actualizados exitosamente.');
                //return view("mensajes.msj_correcto")->with("msj","Usuario Registrado Correctamente");   
            }
            else
            {
                 \Session::flash('flash_message_rechazado', 'Huvo un error al actualizar tus datos vuelva a intentarlo');
                // return view("mensajes.msj_rechazado")->with("msj","hubo un error vuelva a intentarlo");  

            }

        return redirect()->back();
        }
        //return "$usuario";
    }
    public function update_perfil_email(Request $Request)
    {
        $id=Auth::user()->id;
        $email=Auth::user()->email;
        $email_i=$Request->input("email");
        $password=$Request->input("password");

        if ($email != $email_i && $password != null ) {
            $this->validar_email($Request->all())->validate();
            $this->validar_contraseña($Request->all())->validate();
            $resultado=User::where('id',$id)->update([ 'email'=>$Request->input("email"),
                                                   'password'=>bcrypt($Request->input("password")),]);
            if($resultado){
             \Session::flash('flash_message_correcto', 'Correo y contraseña actualizados exitosamente.');}
            else
            {\Session::flash('flash_message_rechazado', 'Huvo un error al actualizar vuelva a intentarlo');}
                return redirect()->back();

        }elseif ($email == $email_i && $password != null) {
            $this->validar_contraseña($Request->all())->validate();
            $resultado=User::where('id',$id)->update(['password'=>bcrypt($Request->input("password")),]);
            if($resultado){
             \Session::flash('flash_message_correcto', 'Contraseña actualizada exitosamente.');}
            else
            {\Session::flash('flash_message_rechazado', 'Huvo un error al actualizar vuelva a intentarlo');}
                return redirect()->back();
        }elseif ($email != $email_i && $password == null) {
            $this->validar_email($Request->all())->validate();
            $resultado=User::where('id',$id)->update([ 'email'=>$Request->input("email"),]);
            if($resultado){
             \Session::flash('flash_message_correcto', 'Correo actualizado exitosamente.');}
            else
            {\Session::flash('flash_message_rechazado', 'Huvo un error al actualizar vuelva a intentarlo');}
                return redirect()->back();
        }else {
            \Session::flash('flash_message_rechazado', 'No se realizo ningun cambio en correo / contraseña');
            return back();
        }

    } 
    protected function validar_date_1(array $data)
    {
        return Validator::make($data, [
            
            'usu_nombre' => 'required|string|max:30',
            'usu_appaterno' => 'string|max:30|nullable',
            'usu_apmaterno' => 'string|max:30|nullable',
            'usu_sexo' => 'string|max:10|required',
            'usu_telf' => 'string|required',
            'usu_telfref' => 'string|nullable',  
            'usu_zona' => 'string|max:30|required',
            'usu_domicilio' => 'string|max:200|required' ,
            'usu_fechnac'=> 'required|date|date_format:Y-m-d|before:today',
        ]);
    }  
    protected function validar_date_2(array $data)
    {
        return Validator::make($data, [
            'usu_ci' => 'required|string|max:10|unique:users',
            'usu_nombre' => 'required|string|max:30',
            'usu_appaterno' => 'string|max:30|nullable',
            'usu_apmaterno' => 'string|max:30|nullable',
            'usu_sexo' => 'string|max:10|required',
            'usu_telf' => 'string|required',
            'usu_telfref' => 'string|nullable',  
            'usu_zona' => 'string|max:30|required',
            'usu_domicilio' => 'string|max:200|required' ,
            'usu_fechnac'=> 'required|date|date_format:Y-m-d|before:today',
            
        ]);
    }

    protected function validar_email(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
        ]);
    } 
    protected function validar_contraseña(array $data)
    {
        return Validator::make($data, [
            'password' => 'required|string|min:6|confirmed',
        ]);
    } 

    public function admReportHome()
    {   $fecha_actual=Carbon::now()->format('Y-m-d');
        return view('viewAdm.FormReportes')->with("fecha_actual",$fecha_actual);
    } 
    public function time()
    {
        $time=Carbon::now();
        $time=$time->format('H:i');
        return $time;
    }



}
