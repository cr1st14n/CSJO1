<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\especialidad;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class especialidadcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $especialidades=DB::table('especialidad')->get();
        return view('ViewAdm.FormRegistroEspecialidad')->with("especialidades",$especialidades);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $data=Request()->all();
        $especialidad = new especialidad;
        $especialidad->nombre = $data["nombre"];
        $especialidad->descripcion = $data["descripcion"];

        $resul=$especialidad->save();
        if($resul){
            \Session::flash('flash_message_correcto', 'Especialidad Creada exitosamente.');
            //return view("mensajes.msj_correcto")->with("msj","Usuario Registrado Correctamente");   
        }
        else
        {
             \Session::flash('flash_message_rechazado', 'Huvo un error al Crear la especialidad vuelva a intentarlo');
            // return view("mensajes.msj_rechazado")->with("msj","hubo un error vuelva a intentarlo");  

        }

        return redirect()->back();
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            
            'nombre' => 'required|string|max:50|unique:especialidad',
            'descripcion' => 'string|max:200|nullable',

        ]);
    }
    protected function validator_edit(array $data)
    {
        return Validator::make($data, [
            
            'nombre' => 'required|string|max:50',
            'descripcion' => 'string|max:200|nullable',

        ]);
    }

    public function create()
    {
         return User::create([
            
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            
            //'usu_cod' => $data['usu_cod'],
            'usu_ci' => $data['usu_ci'],
            'usu_nombre' =>$data['usu_nombre'],
            'usu_appaterno' => $data['usu_appaterno'],
            'usu_apmaterno' => $data['usu_apmaterno'],
            'usu_sexo' => $data['usu_sexo'],
            'usu_fechnac' =>'2010-02-02',
            'usu_telf' => $data['usu_telf'],
            'usu_telfref' => $data['usu_telfref'],
            'usu_zona' => $data['usu_zona'],
            'usu_domicilio' => $data['usu_domicilio'],
            
            //datos institucionales
            'usu_tipo' => 'salud',
            'usu_area' => $data['usu_area'],
            'usu_especialidad' => $data['usu_especialidad'], 
        ]);
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
    {   $especialidades=DB::table('especialidad')->get();
        $especialidad=DB::table('especialidad')->where('id', $id)->first();
        return view('ViewAdm.FormEditEspecialidad')->with("especialidades",$especialidades)->with("especialidad",$especialidad);

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
    public function update(Request $request )
    {
        $this->validator_edit($request->all())->validate();
        $data=Request()->all();
        $resul=DB::table('Especialidad')->where('id',$data["id"])
                            ->update(['nombre'=>$data["nombre"],
                                      'descripcion'=>$data["descripcion"]
                        ]);
        if($resul){
            \Session::flash('flash_message_correcto', 'Especialidad actualizada exitosamente.');
            //return view("mensajes.msj_correcto")->with("msj","Usuario Registrado Correctamente");   
        }
        else
        {
             \Session::flash('flash_message_rechazado', 'Huvo un error al actualizar vuelva a intentarlo');
            // return view("mensajes.msj_rechazado")->with("msj","hubo un error vuelva a intentarlo");  

        }
        //event(new Registered($user = $this->create($request->all())));
       //ingreso luego del registro  $this->guard()->login($user);    
        return redirect ()->route('formNewEspecialidad');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
    {
        $resul=DB::table('especialidad')->where('id', $id)->delete();

        if($resul){
            \Session::flash('flash_message_correcto', 'registro eliminado exitosamente.');
            //return view("mensajes.msj_correcto")->with("msj","Usuario Registrado Correctamente");   
        }
        else
        {
             \Session::flash('flash_message_rechazado', 'Huvo un error al eliminar registro vuelva a intentarlo');
            // return view("mensajes.msj_rechazado")->with("msj","hubo un error vuelva a intentarlo");  

        }
         return redirect ()->route('formNewEspecialidad');
    }
}
