<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    public function __construct()
    {
        $this->middleware('auth');
    }
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/adm/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            
            'usu_ci' => 'required|string|max:10|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'usu_nombre' => 'required|string|max:30',
            'usu_appaterno' => 'string|max:30|nullable',
            'usu_apmaterno' => 'string|max:30|nullable',
            'usu_sexo' => 'string|max:10|required',
            'usu_telf' => 'string|required',
            'usu_telfref' => 'string|nullable',  
            'usu_zona' => 'string|max:30|nullable',
            'usu_domicilio' => 'string|max:200|nullable' ,
            'usu_area' => 'required|string|max:30',
            'usu_cargo' => 'string|max:20|required',
            'usu_fechnac'=> 'nullable|date|date_format:Y-m-d|before:tomorrow',





        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
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
            'usu_fechnac' =>$data['usu_fechnac'],
            'usu_telf' => $data['usu_telf'],
            'usu_telfref' => $data['usu_telfref'],
            'usu_zona' => $data['usu_zona'],
            'usu_domicilio' => $data['usu_domicilio'],
            
            //datos institucionales
            'usu_acceso' => '0',
            'usu_tipo' => 'Administracion',
            'usu_area' => $data['usu_area'],
            'usu_cargo' => $data['usu_cargo'], 
        ]);
        Session::flash('flash_message_correcto', 'Paciente registrado exitosamente.');
   
    }
}
