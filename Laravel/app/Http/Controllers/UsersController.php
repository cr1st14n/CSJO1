<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
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

    public function index()
    {
        return view('viewAdm.FormRegistroUsersPA');
    }
    public function indexPM()
    {
        
        return view('viewAdm.FormRegistroUsersPM');
    }
    //----------registro de user Personal medico
   public function register(Request $request)
    {
        
    }
    protected function validator_update(array $data)
    {
        return Validator::make($data, [
            
            'usu_ci' => 'required|string|max:10',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
            'usu_nombre' => 'required|string|max:30',
            'usu_appaterno' => 'string|max:30|nullable',
            'usu_apmaterno' => 'string|max:30',
            'usu_sexo' => 'string|max:10|required',
            'usu_telf' => 'string|required',
            'usu_telfref' => 'string|nullable',  
            'usu_zona' => 'string|max:30|required',
            'usu_domicilio' => 'string|max:200|required' ,
            'usu_area' => 'required',
            'usu_especialidad' => 'string|max:20|required',
            'usu_fechnac'=> 'required|date|date_format:Y-m-d|before:today',

        ]);
    }
    protected function create(array $data)
    {  
        

   
    }

    public function store(Request $request)
    {
        $datos=User::get();
        return view('viewAdm.listUsers')->with("datos",$datos);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::where('id',$id)->first();
        //return $user;
        return view('viewAdm.FormUserEdit')->with("user",$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_date(Request $Request)
    {
         //$this->validator_update($request->all())->validate();

        $id=$Request->input("usu_id");
        $usuario=$Request->input("usu_ci");
        $user=User::where('id',$id)->value('usu_ci');
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

        }



        return redirect()->action('UsersController@store');
    }

    public function update_acceso(Request $Request)
    {
        $id=$Request->input("usu_id");
        $email=User::where('id',$id)->value('email');
        $email_i=$Request->input("email");
        $password=$Request->input("password");
        //return "$id $email $email_i $password";
        if ($email != $email_i && $password != null ) {
            $this->validar_email($Request->all())->validate();
            $this->validar_contraseña($Request->all())->validate();

            $resultado=User::where('id',$id)->update([  'email'=>$Request->input("email"),
                                                        'usu_area'=>$Request->input("usu_area"),
                                                        'usu_cargo'=>$Request->input("usu_cargo"),
                                                        'password'=>bcrypt($Request->input("password")),
                                                    ]);
            if($resultado){
             \Session::flash('flash_message_correcto', 'Correo y contraseña actualizados exitosamente.');}
            else
            {\Session::flash('flash_message_rechazado', 'Huvo un error al actualizar vuelva a intentarlo');}
                return redirect()->back();

        }elseif ($email == $email_i && $password != null) {
            $this->validar_contraseña($Request->all())->validate();

            $resultado=User::where('id',$id)->update([  'password'=>bcrypt($Request->input("password")),
                                                        'usu_area'=>$Request->input("usu_area"),
                                                        'usu_cargo'=>$Request->input("usu_cargo"),
                                                    ]);
            if($resultado){
             \Session::flash('flash_message_correcto', 'Contraseña actualizada exitosamente.');}
            else
            {\Session::flash('flash_message_rechazado', 'Huvo un error al actualizar vuelva a intentarlo');}
            return redirect()->back();
        }elseif ($email != $email_i && $password == null) {
            $this->validar_email($Request->all())->validate();

            $resultado=User::where('id',$id)->update([ 'email'=>$Request->input("email"),
                                                        'usu_area'=>$Request->input("usu_area"),
                                                        'usu_cargo'=>$Request->input("usu_cargo"),
                                                    ]);
            if($resultado){
             \Session::flash('flash_message_correcto', 'Correo actualizado exitosamente.');}
            else
            {\Session::flash('flash_message_rechazado', 'Huvo un error al actualizar vuelva a intentarlo');}
                return redirect()->back();
        }else {
            $resultado=User::where('id',$id)->update([ 
                                                        'usu_area'=>$Request->input("usu_area"),
                                                        'usu_cargo'=>$Request->input("usu_cargo"),
                                                    ]);
            if($resultado){
             \Session::flash('flash_message_correcto', 'Area y descripcion Actualizado exitosamente.');}
            else
            {\Session::flash('flash_message_rechazado', 'Huvo un error al actualizar vuelva a intentarlo');}
                return redirect()->back();
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
            'usu_area' => 'string|required',
            'usu_cargo' => 'string|required',
        ]);
    } 
    protected function validar_contraseña(array $data)
    {
        return Validator::make($data, [
            'password' => 'required|string|min:6|confirmed',
            'usu_area' => 'string|required',
            'usu_cargo' => 'string|required',
        ]);
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
        return 'editar datdos personales';
    }
    public function update_perfil_email(Request $Request)
    {
        return 'editar email y contraseña';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resul=User::where('id',$id)->delete();
         if($resul){
            \Session::flash('flash_message_correcto', 'Usuario  eliminado exitosamente.');
            //return view("mensajes.msj_correcto")->with("msj","Usuario Registrado Correctamente");   
        }
        else
        {
             \Session::flash('flash_message_rechazado', 'Huvo un error al eliminar el usuario vuelva a intentarlo');
            // return view("mensajes.msj_rechazado")->with("msj","hubo un error vuelva a intentarlo");  

        }
         return redirect ()->action('UsersController@store');
    }
    public function accesoOnOFF($id)
    {
        $estado=user::where('id',$id)->value('usu_acceso');
        if ($estado== '1') {
            
            $resul=User::where('id',$id)->update(['usu_acceso'=>'0']);
            return redirect()->action('UsersController@store');
            //return ' se cambio a denegado';

        }elseif ($estado=='0') {
            
            $resul=User::where('id',$id)->update(['usu_acceso'=>'1']);
            return redirect()->action('UsersController@store');
            //return 'se cambio a admitido';
        }
    }
}
