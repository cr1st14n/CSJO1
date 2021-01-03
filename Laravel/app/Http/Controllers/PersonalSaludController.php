<?php

namespace App\Http\Controllers;

use App\personalSalud;
use App\area;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;


class PersonalSaludController extends Controller
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
        
        $form='create';
        $datos=personalSalud::select('personalSalud.id as ps_id','personalSalud.ps_ci','personalSalud.ps_nombre','personalSalud.ps_appaterno','personalSalud.ps_apmaterno','personalSalud.ps_tipo','area.nombre' )->join('area','area.id','=','personalSalud.ps_area')->get();
        $areas=area::select('id','nombre')->get();
        return view('viewAdm.FormRegistroPS')->with("datos",$datos)->with("areas",$areas)->with("form",$form);
        //return $datos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        $now = Carbon::now();
        //$datetime = $now->format('d-m-Y H:i:s');
        $user = Auth::user()->usu_ci;

        $this->validatorCreate($request->all())->validate();
        $data=Request()->all();
        $ps = new personalSalud;
        $ps->ps_ci= $data["ps_ci"];
        $ps->ps_nombre= $data["ps_nombre"];
        $ps->ps_appaterno= $data["ps_appaterno"];
        $ps->ps_apmaterno= $data["ps_apmaterno"];
        $ps->ps_sexo= $data["ps_sexo"];
        $ps->ps_telf= $data["ps_telf"];
        $ps->ps_tipo= $data["ps_tipo"];
        $ps->ps_area= $data["ps_area"];
        $ps->ps_especialidad= $data["ps_especialidad"];
        //campos de auditoria
        $ps->ca_usu_cod=$user;
        $ps->ca_fecha=$now;
        $resul=$ps->save();
        if($resul){
            \Session::flash('flash_message_correcto', 'Personal de salud registrado exitosamente.');
            //return view("mensajes.msj_correcto")->with("msj","Usuario Registrado Correctamente");   
        }
        else
        {
             \Session::flash('flash_message_rechazado', 'Huvo un error en el registro vuelva a intentarlo');
            // return view("mensajes.msj_rechazado")->with("msj","hubo un error vuelva a intentarlo");  

        }

        return redirect()->action('PersonalSaludController@index');


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function validatorCreate(array $data)
    {
        return Validator::make($data, [
            
            'ps_ci' => 'required|string|max:11|unique:personalSalud',
            'ps_nombre' => 'string|max:50|nullable',
            'ps_appaterno'=>'required|string|max:50',
            'ps_apmaterno'=>'required|string|max:50|nullable',
            'ps_sexo'=>'string|max:10|nullable',
            'ps_telf'=>'string|max:15|nullable',
            'ps_tipo'=>'required|string|max:20',
            'ps_area'=>'required|string|max:20',
            'ps_especialidad'=>'required|string|max:100',


        ]);
    }
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\personalSalud  $personalSalud
     * @return \Illuminate\Http\Response
     */
    public function show($ps_ci)
    {
                
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\personalSalud  $personalSalud
     * @return \Illuminate\Http\Response
     */
    public function edit($ps_id)
    {
        $ps=DB::table('personalSalud')->where("id",$ps_id)->first();
        $form='edit';
        $areas=area::select('id','nombre')->get();
        $datos=personalSalud::select('personalSalud.id as ps_id','ps_ci','ps_nombre','ps_appaterno','ps_apmaterno','ps_tipo','area.nombre')->join('area','area.id','=','personalSalud.ps_area')->get();
        return view('viewAdm.FormRegistroPS')->with("ps",$ps)->with("form",$form)->with("areas",$areas)->with("datos",$datos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\personalSalud  $personalSalud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, personalSalud $personalSalud)
    {
        $this->validatorUpdate($request->all())->validate();
        $now = Carbon::now();
        //$datetime = $now->format('d-m-Y H:i:s');
        $user = Auth::user()->usu_ci;
        $data=Request()->all();
        
        
        $resul=DB::table('personalSalud')->where('id',$data["ps_id"])
            ->update(['ps_ci'=>$data["ps_ci"],
                      'ps_nombre' => $data["ps_nombre"],
                      'ps_appaterno'=> $data["ps_appaterno"],
                      'ps_apmaterno'=>$data["ps_apmaterno"],
                      'ps_telf'=>$data["ps_telf"],
                      'ps_sexo'=>$data["ps_sexo"],
                      'ps_tipo'=>$data["ps_tipo"],
                      'ps_area'=>$data["ps_area"],
                      'ps_especialidad'=>$data["ps_especialidad"]]);
        if($resul){
            \Session::flash('flash_message_correcto', 'Personal actualizado exitosamente.');
            //return view("mensajes.msj_correcto")->with("msj","Usuario Registrado Correctamente");   
        }
        else
        {
             \Session::flash('flash_message_rechazado', 'Huvo un error al actualizar vuelva a intentarlo');
            // return view("mensajes.msj_rechazado")->with("msj","hubo un error vuelva a intentarlo");  

        }



        return redirect()->action('PersonalSaludController@index');
    }
     protected function validatorUpdate(array $data)
    {
        return Validator::make($data, [
            
            'ps_ci' => 'required|string|max:11',
            'ps_nombre' => 'string|max:50|nullable',
            'ps_appaterno'=>'required|string|max:50',
            'ps_apmaterno'=>'required|string|max:50|nullable',
            'ps_sexo'=>'string|max:10|nullable',
            'ps_telf'=>'string|max:15|nullable',
            'ps_tipo'=>'required|string|max:20',
            'ps_area'=>'required|string|max:20',
            'ps_especialidad'=>'required|string|max:100',


        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\personalSalud  $personalSalud
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*$PS=personalSalud::find($id);
        $resul=$PS->delete();*/
        $resul=DB::table('personalSalud')->where('ps_ci',$id)->delete();
        if($resul){
            \Session::flash('flash_message_correcto', 'registro eliminado exitosamente.');
            //return view("mensajes.msj_correcto")->with("msj","Usuario Registrado Correctamente");   
        }
        else
        {
             \Session::flash('flash_message_rechazado', 'Huvo un error al eliminar registro vuelva a intentarlo');
            // return view("mensajes.msj_rechazado")->with("msj","hubo un error vuelva a intentarlo");  

        }  
        return redirect()->action('PersonalSaludController@index');      
    }
}
