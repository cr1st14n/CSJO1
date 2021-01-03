<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pacientes;
use App\especialidad;
use App\atencion;
use App\personalSalud;
use App\User;
use Illuminate\Support\Carbon;

class admRecepController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index()
  {
    $total = pacientes::max('pa_hcl');

    $usuariosArea = User::where('usu_area', "Recepcion")->get();

    $year =  Carbon::now()->format('Y');
    $enero = pacientes::whereYear('created_at', $year)->whereMonth('created_at', 1)->count();
    $febrero = pacientes::whereYear('created_at', $year)->whereMonth('created_at', 2)->count();
    $marzo = pacientes::whereYear('created_at', $year)->whereMonth('created_at', 3)->count();
    $abril = pacientes::whereYear('created_at', $year)->whereMonth('created_at', 4)->count();
    $mayo = pacientes::whereYear('created_at', $year)->whereMonth('created_at', 5)->count();
    $junio = pacientes::whereYear('created_at', $year)->whereMonth('created_at', 6)->count();
    $julio = pacientes::whereYear('created_at', $year)->whereMonth('created_at', 7)->count();
    $agosto = pacientes::whereYear('created_at', $year)->whereMonth('created_at', 8)->count();
    $septiembre = pacientes::whereYear('created_at', $year)->whereMonth('created_at', 9)->count();
    $octubre = pacientes::whereYear('created_at', $year)->whereMonth('created_at', 10)->count();
    $noviembre = pacientes::whereYear('created_at', $year)->whereMonth('created_at', 11)->count();
    $diciembre = pacientes::whereYear('created_at', $year)->whereMonth('created_at', 12)->count();




    return view('viewAdm.admRecepHome')
      ->with("total", $total)
      ->with("enero", $enero)
      ->with("febrero", $febrero)
      ->with("marzo", $marzo)
      ->with("abril", $abril)
      ->with("mayo", $mayo)
      ->with("junio", $junio)
      ->with("julio", $julio)
      ->with("agosto", $agosto)
      ->with("septiembre", $septiembre)
      ->with("octubre", $octubre)
      ->with("noviembre", $noviembre)
      ->with("diciembre", $diciembre)
      ->with("usuarios", $usuariosArea);
  }

  public function uno()
  {
    $total = pacientes::count();
    $paHombre = pacientes::where('pa_sexo', 'M')->count();
    $paMujer = pacientes::where('pa_sexo', 'F')->count();
    $sinSexo = pacientes::count() - $paMujer - $paHombre;

    $paH = round(floatval(($paHombre * 100) / $total), 2);
    $paM = round(floatval(($paMujer * 100) / $total), 2);
    $paS = round(floatval(($sinSexo * 100) / $total), 2);

    $año = Carbon::now()->format('Y');
    $edad1 = pacientes::whereYear('pa_fechnac', '<', $año)->count();
    $edad2 = pacientes::whereYear('pa_fechnac', '<', $año - 25)->count();
    $edad3 = pacientes::whereYear('pa_fechnac', '<', $año - 50)->count();

    $edad1 = ($edad2 + $edad3) - $edad1;
    $edad2 = $edad2 - $edad3;
    $edad3 = $edad3;
    $edadTotal = $edad1 + $edad2 + $edad3;

    $edad1P = round(floatval($edad1 * 100 / $edadTotal), 2);
    $edad2P = round(floatval($edad2 * 100 / $edadTotal), 2);
    $edad3P = round(floatval($edad3 * 100 / $edadTotal), 2);


    $array = [
      'Total' => $total,
      'TotalHombre' => $paHombre,
      'TotalMujer' => $paMujer,
      'TotalSinSexo' => $sinSexo,
      'porcentajeHombre' => $paH,
      'porcentajeMujer' => $paM,
      'porcentajeSinSexo' => $paS,
      'edad1' => $edad1,
      'edad2' => $edad2,
      'edad3' => $edad3,
      'edad1P' => $edad1P,
      'edad2P' => $edad2P,
      'edad3P' => $edad3P
    ];
    return $array;
  }

  public function buscasrHCL(Request $request)
  {
    // return $request['dato'];
    $resultado = '';
    if ($request['tipo'] == 1) {
      $resultado = pacientes::where('pa_hcl', 'like', ($request['dato']) . '%')->orderBy('pa_hcl', 'asc')->limit(10)->get();
    }
    if ($request['tipo'] == 2) {
      $nombre = $request['dato'];
      $resultado = $this->buscarPacientesText($nombre);
    }
    if ($resultado->count() == 0) {
      $resultado = 'vacio';
    }
    return $resultado;
  }

  public function buscarPacientesText($texto)
  {
    #return $texto;
    $var_Busqueda = '';
    $apep = '';
    $apem = '';
    $apem2 = '';
    $a = '';
    $b = '';
    $c = '';
    //fragmentar input por estacio
    $trozo = preg_split("/[ ]+/", $texto);
    for ($i = 0; $i < count($trozo); $i++) {
      switch ($i) {
        case '0':
          $nom = $trozo[$i];
          break;
        case '1':
          $apep = $trozo[$i];
          break;
        case '2':
          $apem = $trozo[$i];
          break;
        case '3':
          $apem2 = $trozo[$i];
          break;
      }
    }

    if ($apem2 != '') {
      $apem = "$apem $apem2";
    }
    //generar valores de verdad
    if ($nom == '0' || $nom == null) {
      $a = 'f';
    } else {
      $a = 'v';
    }
    if ($apep == '0' || $apep == null) {
      $b = 'f';
    } else {
      $b = 'v';
    }
    if ($apem == '0' || $apem == null || $apem == ' ') {
      $c = 'f';
    } else {
      $c = 'v';
    }

    $var_Busqueda = "$nom $apep $apem";
    $i = "$a$b$c";
    switch ($i) {
      case 'vvv':
        # code...
        //echo "primera iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1'";
        //$pacientes = pacientes::where(('pa_nombre','Like',$nom.'%') && 'pa_appaterno','Like',$apep.'%' && 'pa_apmaterno','Like',$apem.'%')->get();

        return pacientes::Where(function ($q) use ($nom, $apep, $apem) {
          $q->where('pa_nombre', 'like', '%' . $nom . '%')
            ->where('pa_appaterno', 'like', $apep . '%')
            ->Where('pa_apmaterno', 'like', $apem . '%');
        })->limit(50)->get();
        //$pacientes=pacientes::where([['pa_nombre','like','%'.$nom.'%'],['pa_appaterno','like',$apep.'%'],['pa_apmaterno','like',$apem.'%']])->get();
        break;
      case 'vvf':
        # code...
        //echo "segunda iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1' " ;
        return pacientes::Where(function ($q) use ($nom, $apep, $apem) {
          $q->where('pa_nombre', 'like', '%' . $nom . '%')
            ->where('pa_appaterno', 'like', $apep . '%');
        })->limit(50)->get();
        break;
      case 'vfv':
        # code...
        //echo "tercera iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1' ";
        return pacientes::Where(function ($q) use ($nom, $apep, $apem) {
          $q->where('pa_nombre', 'like', '%' . $nom . '%')
            ->Where('pa_apmaterno', 'like', $apem . '%');
        })->limit(50)->get();
        break;
      case 'vff':
        # code...
        //echo "cuarta iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1' ";
        return pacientes::Where(function ($q) use ($nom, $apep, $apem) {
          $q->where('pa_nombre', 'like', '%' . $nom . '%');
        })->limit(50)->get();


        break;
      case 'fvv':
        # code...
        //echo "quinta iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1' ";
        return pacientes::Where(function ($q) use ($nom, $apep, $apem) {
          $q->where('pa_appaterno', 'like', $apep . '%')
            ->Where('pa_apmaterno', 'like', $apem . '%');
        })->limit(50)->get();
        break;
      case 'fvf':
        # code...
        //echo "sexta iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1' ";
        return pacientes::Where(function ($q) use ($nom, $apep, $apem) {
          $q->where('pa_appaterno', 'like', $apep . '%');
        })->limit(50)->get();
        break;
      case 'ffv':
        # code...
        //echo "septima iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1' ";
        return pacientes::Where(function ($q) use ($nom, $apep, $apem) {
          $q->Where('pa_apmaterno', 'like', $apem . '%');
        })->limit(50)->get();
        break;
      case 'fff':
        # code...
        //echo "octava iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1' ";
        $tabla = '0';
        // return view('viewRecepcion.formBuscarPaciente')->with("tabla",$tabla)->with("num",|$var_num)->with("Busqueda",$var_Busqueda);

        break;

      default:
        # code...
        break;
    }
    return "error revisar AjaxPacienteController";
  }

  public function InfoCajaList(Request $request)
  {
    $especialidades = especialidad::select('id', 'nombre')->orderBy('nombre', 'asc')->get();
    $lista = array();
    foreach ($especialidades as $es) {
      if ($request->mez == 'Anual') {
        $atencion = atencion::where('ate_especialidad', $es->id)->whereYear('created_at', $request->año)->count();
      } else {
        $atencion = atencion::where('ate_especialidad', $es->id)
          ->whereYear('created_at', $request->año)
          ->whereMonth('created_at', $request->mez)
          ->count();
      }
      $var = array("nombre" => $es->nombre, "id" => $es->id, "cantidad" => $atencion);

      array_push($lista, $var);
    }
    return $lista;
  }

  function detalleCajaEspecialidad(Request $request)
  {
    // return $request;
    $enero = atencion::where('ate_especialidad', $request->id)->whereYear('created_at', $request->año)->whereMonth('created_at', 1)->count();
    $febrero = atencion::where('ate_especialidad', $request->id)->whereYear('created_at', $request->año)->whereMonth('created_at', 2)->count();
    $marzo = atencion::where('ate_especialidad', $request->id)->whereYear('created_at', $request->año)->whereMonth('created_at', 3)->count();
    $abril = atencion::where('ate_especialidad', $request->id)->whereYear('created_at', $request->año)->whereMonth('created_at', 4)->count();
    $mayo = atencion::where('ate_especialidad', $request->id)->whereYear('created_at', $request->año)->whereMonth('created_at', 5)->count();
    $junio = atencion::where('ate_especialidad', $request->id)->whereYear('created_at', $request->año)->whereMonth('created_at', 6)->count();
    $julio = atencion::where('ate_especialidad', $request->id)->whereYear('created_at', $request->año)->whereMonth('created_at', 7)->count();
    $agosto = atencion::where('ate_especialidad', $request->id)->whereYear('created_at', $request->año)->whereMonth('created_at', 8)->count();
    $septiembre = atencion::where('ate_especialidad', $request->id)->whereYear('created_at', $request->año)->whereMonth('created_at', 9)->count();
    $octubre = atencion::where('ate_especialidad', $request->id)->whereYear('created_at', $request->año)->whereMonth('created_at', 10)->count();
    $noviembre = atencion::where('ate_especialidad', $request->id)->whereYear('created_at', $request->año)->whereMonth('created_at', 11)->count();
    $diciembre = atencion::where('ate_especialidad', $request->id)->whereYear('created_at', $request->año)->whereMonth('created_at', 12)->count();
    $lista = array();
    array_push($lista, ["elapsed" => "ene: $enero", "value" => $enero]);
    array_push($lista, ["elapsed" => "feb: $febrero", "value" => $febrero]);
    array_push($lista, ["elapsed" => "mar: $marzo", "value" => $marzo]);
    array_push($lista, ["elapsed" => "abr: $abril", "value" => $abril]);
    array_push($lista, ["elapsed" => "may: $mayo", "value" => $mayo]);
    array_push($lista, ["elapsed" => "jun: $junio", "value" => $junio]);
    array_push($lista, ["elapsed" => "jul: $julio", "value" => $julio]);
    array_push($lista, ["elapsed" => "ago: $agosto", "value" => $agosto]);
    array_push($lista, ["elapsed" => "sep: $septiembre", "value" => $septiembre]);
    array_push($lista, ["elapsed" => "oct: $octubre", "value" => $octubre]);
    array_push($lista, ["elapsed" => "nov: $noviembre", "value" => $noviembre]);
    array_push($lista, ["elapsed" => "dic: $diciembre", "value" => $diciembre]);
    return $lista;
  }

  function historiaHCLAte($id)
  {
    $paciente = pacientes::where('pa_id', $id)->select('pa_hcl', 'pa_nombre', 'pa_appaterno', 'pa_apmaterno', 'pa_ci')->first();
    $historia = atencion::where('pa_id', $id)
      ->join('especialidad as esp', 'esp.id', 'atencion.ate_especialidad')
      ->join('personalsalud as ps', 'ps.id', 'atencion.ate_med')
      ->select('atencion.created_at', 'atencion.ate_procedimiento', 'esp.nombre', 'ps.ps_nombre', 'ps.ps_appaterno', 'ps.ps_apmaterno')
      ->get();

    $res = array("datos" => $historia, "hcl" => $paciente->pa_hcl, "nombre" => $paciente->pa_nombre, "apellido1" => $paciente->pa_appaterno, "apellido2" => $paciente->pa_apmaterno);
    return $res;
  }
  function actRegistroPaci()
  {
    $fecha = Carbon::now()->format('Y-m-d');
    // $fecha = '2019-09-19';
    $regPacMañana = pacientes::whereDate('created_at', $fecha)
      ->whereTime('created_at', '>=', '00:00')
      ->whereTime('created_at', '<=', '12:00')
      ->count();
    $regPacTarde = pacientes::whereDate('created_at', $fecha)
      ->whereTime('created_at', '>=', '12:00')
      ->whereTime('created_at', '<=', '24:00')
      ->count();
    $respuesta = array('regPacMañana' => $regPacMañana, 'regPacTarde' => $regPacTarde);
    return $respuesta;
  }
  function actRegistroEsp(Request $request)
  {
    $fecha = Carbon::now();
    $lista = array();
    if ($request->tipo == 'med') {
      $medicos = personalSalud::select('id', 'ps_appaterno')->get();
      foreach ($medicos as $med) {
        if ($request->fecha == 'dia') {
          $cant = atencion::where('ate_med', $med->id)
            ->whereDay('created_at', $fecha->format('d'))
            ->whereYear('created_at', $fecha->format('Y'))->count();
        }
        $var = array("id" => $med->id, "nombre" => $med->ps_appaterno, "cantidad" => $cant);

        array_push($lista, $var);
      }
    } else {
      $especialidades = especialidad::select('id', 'nombre')->orderBy('nombre', 'asc')->get();
      foreach ($especialidades as $es) {
        if ($request->fecha == 'dia') {
          $atencion = atencion::where('ate_especialidad', $es->id)
            ->whereDay('created_at', $fecha->format('d'))
            ->whereYear('created_at', $fecha->format('Y'))->count();
        }
        $var = array("id" => $es->id, "nombre" => $es->nombre,  "cantidad" => $atencion);

        array_push($lista, $var);
      }
    }
    return $lista;
  }
  function actRegistroMed(Request  $request)
  {
    $ps=personalSalud::select('id','ps_appaterno','ps_especialidad')->orderBy('ps_appaterno','asc')->get();
    $lista=array();
    if ($request->gestion=="anual") {
      foreach ($ps as $ps) {
        $count=atencion::where('ate_med',$ps->id)
        ->whereYear('created_at',$request->año)
        ->count();
        array_push($lista,array("id"=>$ps->id,'apellido'=>$ps->ps_appaterno,'especialidad'=>$ps->ps_especialidad,"cantidad"=>$count));
      }
    }else{
      foreach ($ps as $ps) {
        $count=atencion::where('ate_med',$ps->id)
        ->whereYear('created_at',$request->año)
        ->whereMonth('created_at',$request->gestion)
        ->count();
        array_push($lista,array("id"=>$ps->id,'apellido'=>$ps->ps_appaterno,'especialidad'=>$ps->ps_especialidad,"cantidad"=>$count));
      }
    }
    return $lista;
  }
  function DatosEstAnualesMedico(Request $request)
  {
    // return $request;
    $enero = atencion::where('ate_med', $request->id)->whereYear('created_at', $request->año)->whereMonth('created_at', 1)->count();
    $febrero = atencion::where('ate_med', $request->id)->whereYear('created_at', $request->año)->whereMonth('created_at', 2)->count();
    $marzo = atencion::where('ate_med', $request->id)->whereYear('created_at', $request->año)->whereMonth('created_at', 3)->count();
    $abril = atencion::where('ate_med', $request->id)->whereYear('created_at', $request->año)->whereMonth('created_at', 4)->count();
    $mayo = atencion::where('ate_med', $request->id)->whereYear('created_at', $request->año)->whereMonth('created_at', 5)->count();
    $junio = atencion::where('ate_med', $request->id)->whereYear('created_at', $request->año)->whereMonth('created_at', 6)->count();
    $julio = atencion::where('ate_med', $request->id)->whereYear('created_at', $request->año)->whereMonth('created_at', 7)->count();
    $agosto = atencion::where('ate_med', $request->id)->whereYear('created_at', $request->año)->whereMonth('created_at', 8)->count();
    $septiembre = atencion::where('ate_med', $request->id)->whereYear('created_at', $request->año)->whereMonth('created_at', 9)->count();
    $octubre = atencion::where('ate_med', $request->id)->whereYear('created_at', $request->año)->whereMonth('created_at', 10)->count();
    $noviembre = atencion::where('ate_med', $request->id)->whereYear('created_at', $request->año)->whereMonth('created_at', 11)->count();
    $diciembre = atencion::where('ate_med', $request->id)->whereYear('created_at', $request->año)->whereMonth('created_at', 12)->count();
    $lista = array();
    array_push($lista, ["elapsed" => "ene: $enero", "value" => $enero]);
    array_push($lista, ["elapsed" => "feb: $febrero", "value" => $febrero]);
    array_push($lista, ["elapsed" => "mar: $marzo", "value" => $marzo]);
    array_push($lista, ["elapsed" => "abr: $abril", "value" => $abril]);
    array_push($lista, ["elapsed" => "may: $mayo", "value" => $mayo]);
    array_push($lista, ["elapsed" => "jun: $junio", "value" => $junio]);
    array_push($lista, ["elapsed" => "jul: $julio", "value" => $julio]);
    array_push($lista, ["elapsed" => "ago: $agosto", "value" => $agosto]);
    array_push($lista, ["elapsed" => "sep: $septiembre", "value" => $septiembre]);
    array_push($lista, ["elapsed" => "oct: $octubre", "value" => $octubre]);
    array_push($lista, ["elapsed" => "nov: $noviembre", "value" => $noviembre]);
    array_push($lista, ["elapsed" => "dic: $diciembre", "value" => $diciembre]);
    return $lista;
  }
}
