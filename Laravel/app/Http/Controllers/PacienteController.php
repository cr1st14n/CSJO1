<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Pacientes;
use DB;
use Carbon\Carbon;


class PacienteController extends Controller
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

    public function home()
    {
       return view('viewsRecepcion.viewRecepcion');
    }
    
    public function index()
    {   
      $dato = DB::table('Pacientes')->max('pa_hcl')+1;
      //return redirect()->back();
       return view('viewRecepcion.FormRegisterPaciente')->with("dato", $dato );
        //return $dato;
    }

    /**
     * Show the form for creating a new resource.
     * Muestra el formulario para crear un nuevo recurso.
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        $HCL = DB::table('Pacientes')->max('pa_hcl')+1;

        $now = Carbon::now();
        $datetime = $now->format('Y-m-d H:i:s');
        $user = Auth::user()->usu_ci;
        $this->validator($request->all())->validate();

        $data=Request()->all();
        $pa_hcl=$data["pa_hcl"];
        $paciente = new Pacientes;
        $paciente ->pa_hcl = $HCL;
        $paciente ->pa_ci = $data["pa_ci" ];
        $paciente ->pa_nombre = $data["pa_nombre" ];
        $paciente ->pa_appaterno  = $data["pa_appaterno" ];
        $paciente ->pa_apmaterno = $data["pa_apmaterno" ];
        $paciente ->pa_sexo  = $data["pa_sexo" ];
        $paciente ->pa_pais_nac = $data["pa_pais_nac" ];
        $paciente ->pa_ciudad_nac = $data["pa_ciudad_nac" ];
        $paciente ->pa_estado_civil = $data["pa_estado_civil"];
        $paciente ->pa_telf = $data["pa_telf" ];
        $paciente ->pa_telfref = $data["pa_telfref" ];
        $paciente ->pa_zona  = $data["pa_zona"];
        $paciente ->pa_domicilio = $data["pa_domicilio" ];
        $paciente ->pa_fechnac = $data["pa_fechnac"];
        //campos de auditoria
        $paciente ->ca_cod_usu = $user;
        $paciente ->ca_fecha =  $datetime;

        $resul=$paciente->save();
        if($resul){
            \Session::flash('flash_message_correcto', 'Paciente registrado exitosamente.');
            //return view("mensajes.msj_correcto")->with("msj","Usuario Registrado Correctamente");   
            $pa_id=Pacientes::max('pa_id');
            return redirect()->action('AtencionController@index',$pa_id);
        }
        else
        {
             \Session::flash('flash_message_rechazado', 'Huvo un error al registrar vuelva a intentarlo');
            // return view("mensajes.msj_rechazado")->with("msj","hubo un error vuelva a intentarlo");  

              return redirect ()->route('index_paciente');
        }
        //event(new Registered($user = $this->create($request->all())));
       //ingreso luego del registro  $this->guard()->login($user);      
    }


     protected function validator(array $data)
    {
        return Validator::make($data, [
            
            'pa_ci' => ' nullable|string|max:10|unique:Pacientes',
            'pa_nombre' => 'required|string|max:200|',
            'pa_appaterno' => 'string|max:100|nullable',
            'pa_apmaterno' => 'string|max:100|nullable',
            'pa_sexo' => 'nullable|string|max:20',
            'pa_pais_nac' => 'string|max:50|nullable',
            'pa_ciudad_nac' => 'string|max:50|nullable',
            'pa_estado_civil' => 'string|max:20',
            'pa_telf' => 'nullable|string|max:11',
            'pa_telfref' => 'nullable|string|max:11',
            'pa_zona' => 'nullable|string|max:50',
            'pa_domicilio' => 'nullable|string|max:200',
            'pa_fechnac' => 'nullable|date|date_format:Y-m-d|before:today',

           

        ]);
    }
     protected function validator_edit(array $data)
    {
        return Validator::make($data, [
            
            'pa_ci' => ' nullable|string|max:11',
            'pa_nombre' => 'nullable|string|max:200|',
            'pa_appaterno' => 'string|max:100|nullable',
            'pa_apmaterno' => 'string|max:100|nullable',
            'pa_sexo' => 'nullable|string|max:20',
            'pa_pais_nac' => 'string|max:50|nullable',
            'pa_ciudad_nac' => 'string|max:50|nullable',
            'pa_estado_civil' => 'nullable|string|max:20',
            'pa_telf' => 'nullable|string|max:11',
            'pa_telfref' => 'nullable|string|max:11',
            'pa_zona' => 'nullable|string|max:50',
            'pa_domicilio' => 'nullable|string|max:200',
            'pa_fechnac' => 'nullable|date|date_format:Y-m-d|before:today',

           

        ]);
    }

    /**
     * Store a newly created resource in storage.
     * Almacene un recurso recién creado en el almacenamiento.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function formBuscarPaciente()
    {   
      $tabla='0';
      $var_Busqueda='';
      $var_num='';

      return view('viewRecepcion.formBuscarPaciente')->with("tabla",$tabla)->with("num",$var_num)->with("Busqueda",$var_Busqueda);
    }
    public function buscar (Request $request)
    {   /*
        $tabla='1';
        $num='';
        $nom='';
        $apep='';
        $apem=''; 

        $data=Request()->all();
        $num= $data["num"];
        $dato1= $data["dato1"];

        $trozo = preg_split("/[\s,]+/", $dato1);
        for ($i=0; $i < count($trozo); $i++) { 
          switch ($i) {
            case '0':
              $apep=$trozo[$i];
              if ($apep == '0') {
                $apep='';
              }
              break;
            case '1':
              $apem=$trozo[$i];
              if ($apem == '0') {
                $apem='';
              }
              break;
            case '2':
              $nom=$trozo[$i];
              if ($nom == '0') {
                $nom='';
              }
              break;
          }
        }
        $var_Busqueda="$apep $apem $nom";
        $var_num=$num;
        $pacientes= Pacientes::Busqueda($num,$nom,$apep,$apem)->paginate(30); 
        return view('viewRecepcion.formBuscarPaciente')
        ->with("pacientes", $pacientes )->with("tabla",$tabla)->with("num",$var_num)->with("Busqueda",$var_Busqueda); 
        
        return "$apep $apem $nom";

    */
        
        $tabla='1';
        $var_Busqueda='';
        $num=null;
        $nom='';
        $apep='';
        $apem=''; 
        $apem2='';
        $a = ''; 
        $b = ''; 
        $c = ''; 

        $data=Request()->all();
        $num= $data["num"];
        $dato1= $data["dato1"];
        if ($num != '') {
          $pacientes=pacientes::where('pa_ci', $num)->orwhere('pa_hcl','like',$num.'%')->orderBy('pa_hcl','asc')->paginate(100);
        }else{



        //fragmentar input por estacio
        $trozo = preg_split("/[\s,]+/", $dato1);
        for ($i=0; $i < count($trozo); $i++) { 
          switch ($i) {
            case '0':
              $nom=$trozo[$i];
              
              break;
            case '1':
              $apep=$trozo[$i];
              
              break;
            case '2':
              $apem=$trozo[$i];
              
              break;
            case '3':
              $apem2=$trozo[$i];
              
              break;
          }
        }
        if ($apem2 != '') {$apem="$apem $apem2";}
        //generar valores de verdad
        if ($nom == '0' || $nom == null) {$a='f';}else{$a='v';}
        if ($apep == '0' || $apep == null) {$b='f';}else{$b='v';}
        if ($apem == '0'|| $apem == null || $apem == ' ' ) {$c='f';}else{$c='v';}

        $var_Busqueda="$nom $apep $apem";
        $var_num=$num;
        $i="$a$b$c";
        switch ($i) {
          case 'vvv':
            # code...
          //echo "primera iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1'";
            //$pacientes = pacientes::where(('pa_nombre','Like',$nom.'%') && 'pa_appaterno','Like',$apep.'%' && 'pa_apmaterno','Like',$apem.'%')->get();
            $pacientes= pacientes::Where(function($q) use ($nom,$apep,$apem){
                              $q->where('pa_nombre','like','%'.$nom.'%')
                                ->where('pa_appaterno','like',$apep.'%')
                                ->Where('pa_apmaterno','like',$apem.'%'); })->paginate(200);
            //$pacientes=pacientes::where([['pa_nombre','like','%'.$nom.'%'],['pa_appaterno','like',$apep.'%'],['pa_apmaterno','like',$apem.'%']])->get();
            break;
          case 'vvf':
            # code...
          echo "segunda iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1' " ;
            $pacientes= pacientes::Where(function($q) use ($nom,$apep,$apem){
                              $q->where('pa_nombre','like','%'.$nom.'%')
                                ->where('pa_appaterno','like',$apep.'%'); })->paginate(200);
            break;
          case 'vfv':
            # code...
          //echo "tercera iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1' ";
            $pacientes= pacientes::Where(function($q) use ($nom,$apep,$apem){
                              $q->where('pa_nombre','like','%'.$nom.'%')
                                ->Where('pa_apmaterno','like',$apem.'%'); })->paginate(200);          
            break;
          case 'vff':
            # code...
          //echo "cuarta iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1' ";
             $pacientes= pacientes::Where(function($q) use ($nom,$apep,$apem){
                              $q->where('pa_nombre','like','%'.$nom.'%'); })->paginate(200);                  

            break;
          case 'fvv':
            # code...
          //echo "quinta iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1' ";
            $pacientes= pacientes::Where(function($q) use ($nom,$apep,$apem){
                              $q->where('pa_appaterno','like',$apep.'%')
                                ->Where('pa_apmaterno','like',$apem.'%'); })->paginate(200);
            break;
          case 'fvf':
            # code...
          //echo "sexta iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1' ";
            $pacientes= pacientes::Where(function($q) use ($nom,$apep,$apem){
                              $q->where('pa_appaterno','like',$apep.'%')
                                ; })->paginate(50);
            break;
          case 'ffv':
            # code...
          //echo "septima iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1' ";
            $pacientes= pacientes::Where(function($q) use ($nom,$apep,$apem){
                              $q->Where('pa_apmaterno','like',$apem.'%'); })->paginate(200);
            break;
          case 'fff':
            # code...
          //echo "octava iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1' ";
            $tabla='0';
          return view('viewRecepcion.formBuscarPaciente')->with("tabla",$tabla)->with("num",$var_num)->with("Busqueda",$var_Busqueda);

            break;

          default:
            # code...
            break;
        }
        }
        return view('viewRecepcion.formBuscarPaciente')->with("pacientes", $pacientes )->with("tabla",$tabla)->with("num",$num)->with("Busqueda",$var_Busqueda);
    }

    public function buscar_paciente($sexo="",$dato)
    {

        $usuarios= Pacientes::Busqueda($sexo,$dato);  
        
        
        return view('viewRecepcion.formBuscarPaciente')
        ->with("usuarios", $usuarios );       
    }







    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * Mostrar el recurso especificado.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * Muestra el formulario para editar el recurso especificado.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



    public function showAll()
    {
        $Pacientes= Pacientes::paginate(900);
        
        // return view('listados.listado_usuarios')->with("usuarios", $usuarios );

        return view('viewsRecepcion.formListPacientes')->with("Pacientes",$Pacientes);
    } 



    public function edit($pa_id)
    {
        $paciente=Pacientes::where('pa_id',$pa_id)->first();
        //$contador=count($paciente);
        if($paciente != null){          
            //return 'vamos bien ' $paciente->pa_hcl;
            return view("viewRecepcion.formEditPaciente")->with("paciente",$paciente);   
        }
        else
        {            
            \Session::flash('flash_message_rechazado', 'El paceinte no existe o fue aliminado vuelva a intentarlo.');
            return redirect()->back();  
        }
    }

    /**
     * Update the specified resource in storage.
     * Actualice el recurso especificado en el almacenamiento.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $now = new \DateTime();
        $datetime = $now->format('d-m-y H:i:s');
        $user = Auth::user()->usu_ci;
        $this->validator_edit($request->all())->validate();
        $data=Request()->all();
        $pa_id=$data["pa_id"];
        $resul=DB::table('pacientes')
            ->where('pa_id', $data["pa_id"])
            ->update(['pa_nombre' => $data["pa_nombre"],
                      'pa_appaterno'=> $data["pa_appaterno"],
                      'pa_ci'=>$data["pa_ci"],
                      'pa_apmaterno'=>$data["pa_apmaterno"],'pa_sexo'=>$data["pa_sexo"],
                      'pa_pais_nac'=>$data["pa_pais_nac"],'pa_estado_civil'=>$data["pa_estado_civil"],
                      'pa_ciudad_nac'=>$data["pa_ciudad_nac"],
                      'pa_telf'=>$data["pa_telf"],'pa_telfref'=>$data["pa_telfref"],
                      'pa_zona'=>$data["pa_zona"],'pa_domicilio'=>$data["pa_domicilio"],
                      'pa_fechnac'=>$data["pa_fechnac"],'pa_fechnac'=>$data["pa_fechnac"]
                  ]);
        if($resul){
            \Session::flash('flash_message_correcto', 'Paciente actualizado exitosamente.');
            //return view("mensajes.msj_correcto")->with("msj","Usuario Registrado Correctamente"); 
            return redirect()->action('AtencionController@index',$pa_id);  
        }
        else
        {
             \Session::flash('flash_message_rechazado', 'Huvo un error al actualizar vuelva a intentarlo');
            // return view("mensajes.msj_rechazado")->with("msj","hubo un error vuelva a intentarlo");  

        }
        //event(new Registered($user = $this->create($request->all())));
       //ingreso luego del registro  $this->guard()->login($user);    
        return redirect ()->route('form_buscar_paciente');
    }

    /**
     * Remove the specified resource from storage.
     * Elimine el recurso especificado del almacenamiento.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($pa_id)
    {
        $resul=DB::table('pacientes')->where('pa_id', $pa_id)->delete();

        if($resul){
            \Session::flash('flash_message_correcto', 'registro eliminado exitosamente.');
            //return view("mensajes.msj_correcto")->with("msj","Usuario Registrado Correctamente");   
        }
        else
        {
             \Session::flash('flash_message_rechazado', 'Huvo un error al eliminar registro vuelva a intentarlo');
            // return view("mensajes.msj_rechazado")->with("msj","hubo un error vuelva a intentarlo");  

        }
         return redirect ()->route('form_buscar_paciente');
    }
    public function print_HCl(Request $request )
    {
      $pa_id=$request->input("pa_id");
      $paciente =  DB::table('Pacientes')->where('pa_id',$pa_id)->first();
      $fechnac=$paciente->pa_fechnac;
      $fechnac=Carbon::parse($fechnac)->format('d-m-Y');
      return view('pdf.pdf_HCL')->with("paciente",$paciente)->with("fechnac",$fechnac);

    }
    public function print_HCl_1($pa_id)
    {
      $paciente=DB::table('Pacientes')->where('pa_id',$pa_id)->first();
      $fechnac=$paciente->pa_fechnac;
      $fechnac=Carbon::parse($fechnac)->format('d-m-Y');
      return view('pdf.pdf_HCL')->with("paciente",$paciente)->with("fechnac",$fechnac);

    }
}
