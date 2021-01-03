<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\atencion;
use App\usuContrato;
use App\userDatosInst;
use App\userDoc;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

// use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class empleadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function index()
    {
        return view('viewRRHH.viewEmp.viewEmp');
        /*return User::where('id','0')->firstOr(function (){
            return"hola";
        });*/
    }
    function showEmpTodos()
    {
        // return User::orderBy('created_at','desc')->get();
        return User::select('usu_nombre', 'usu_appaterno', 'usu_apmaterno', 'usu_area', 'usu_ci', 'users.created_at', 'users.id')
            // ->join('usu_contratos as cot','users.id','cot.cod_usu')
            // ->addSelect('cot.uc_area')
            ->join('usu_contratos as uco', 'uco.cod_usu', 'users.id')
            ->addSelect('uco.uc_area', 'uc_estado')->where('uc_estado', 1)
            ->join('user_datos_insts as udi', 'users.id', 'udi.cod_usu')
            ->addSelect('udi.di_profecion')->orderBy('created_at', 'desc')
            ->get();
    }
    function showDatosEmp($id)
    {
        $res = User::where('users.id', $id)
            ->join('user_datos_insts as udi', 'users.id', 'udi.cod_usu')
            ->select('udi.id as id_datIns', 'udi.di_titulo', 'udi.di_profecion', 'udi.di_especialidad', 'udi.di_seguroNombreCP', 'udi.di_codSeguroCP', 'udi.di_seguroNombreLP', 'udi.di_seguroNua', 'udi.di_seguroCua')
            ->addSelect('users.*')
            ->first();
        $res3 = usuContrato::where('cod_usu', $id)->where('uc_nroContrato', (usuContrato::where('cod_usu', $id)->max('uc_nroContrato')))->first();
        $ret = array();
        array_push($ret, $res);
        array_push($ret, $res3);
        return $ret;
    }

    function editDatos1Emp(Request $request)
    {
        return User::where('id', $request->id)->first();
    }
    function editDatos2Emp(Request $request)
    {
        $dat1 = usuContrato::where('cod_usu', $request->input('id'))->where('uc_nroContrato', (usuContrato::where('cod_usu', $request->input('id')))->max('uc_nroContrato'))->first();
        $dat2 = userDatosInst::where('cod_usu', $request->input('id'))->first();
        $dat3 = User::where('id', $request->input('id'))->select('usu_area', 'usu_acceso')->first();
        $req = array();
        array_push($req, $dat1);
        array_push($req, $dat2);
        array_push($req, $dat3);
        return $req;
    }

    function updateDatos1Emp(Request $request)
    {
        if ($request->input('emailUp') == User::where('id', $request->input('idEdituser'))->value('email')) {
        } else {
            if (User::where('email', $request->input('emailUp'))->value('email') != null) {
                return "email ya registrado";
            }
        }
        if ($request->input('createUserCiUp') == User::where('id', $request->input('idEdituser'))->value('usu_ci')) {
        } else {
            if (User::where('usu_ci', $request->input('createUserCiUp'))->value('usu_ci') != null) {
                return "ci ya registrado";
            }
        }
        return $resp = User::where('id', $request->input('idEdituser'))
            ->update([
                'usu_ci' => $request->input('createUserCiUp'),
                'usu_nombre' => $request->input('nombreUp'),
                'usu_appaterno' => $request->input('apellido1Up'),
                'usu_apmaterno' => $request->input('apellido2Up'),
                'usu_sexo' => $request->input('sexoUp'),
                'usu_fechnac' => $request->input('fechaNacimientoUp'),
                'usu_paisnac' => $request->input('paisNacimientoUp'),
                'usu_depnac' => $request->input('depNacimientoUp'),
                'usu_tipoSangre' => $request->input('tipoSangreUp'),
                'usu_estadocivil' => $request->input('estadoCivilUp'),
                'usu_telf' => $request->input('telfUp'),
                'usu_telfref' => $request->input('telfRefUp'),
                'usu_zona' => $request->input('zonaUp'),
                'usu_domicilio' => $request->input('domicilioUp'),
                'usu_zonaSufragio' => $request->input('zonaSufragioUp'),
                'email' => $request->input('emailUp'),
                'ca_tipo' => 'update',
                'updated_at' => Carbon::now()->format('Y-m-d'),
            ]);
        if ($resp) {
            return "success";
        } else {
            return "fail";
        }
    }

    function updateDatos2Emp(Request $request)
    {
        $r = User::where('id', $request->input('id_usu'))
            ->update([
                'usu_area' => $request->input('accModSisUp'),
                'usu_acceso' => $request->input('accesoSisUp')
            ]);
        $r1 = usuContrato::where('id', $request->input('id_contrato'))
            ->update([
                'uc_fechaInicio' => $request->input('fechaContratacionUp'),
                'uc_tipoContrato' => $request->input('contratoUp'),
                'uc_area' => $request->input('areaDesignadaUP'),
                'uc_cargoDesignado' => $request->input('cargoUP'),

            ]);
        $r2 = userDatosInst::where('id', $request->input('id_datosIns'))
            ->update([
                'di_titulo' => $request->input('tituloObUp'),
                'di_profecion' => $request->input('profecionObUP'),
                'di_seguroNombreCP' => $request->input('seguroNombreInstitucionCPUp'),
                'di_codSeguroCP' => $request->input('codSeguroCPUp'),
                'di_seguroNombreLP' => $request->input('seguroNombreInstitucionLPUp'),
                'di_seguroNua' => $request->input('numNuaUp'),
                'di_seguroCua' => $request->input('numCuaUp'),
            ]);
        if ($r && $r1 && $r2) {
            return "success";
        } else {
            return "fail";
        }
    }

    function segun()
    {
        //    return User::join('atencion','atencion.usu_ci','users.usu_ci')->paginate(25);
        return User::Usuarios()->paginate(50);
    }
    function revCiEmail(Request $request)
    {
        $revCI = User::where('usu_ci', $request->input('ci'))->first();
        $revEmail = User::where('email', $request->input('email'))->first();
        if ($request->input('email') == null) {
            $revEmail = null;
        }
        if ($revCI != null) {
            return "ciYaExistente";
        }
        if ($revEmail != null) {
            return "emailYaExistente";
        }
        return "true";
    }
    function createUser(Request $request)
    {
        // return $request;
        $revCI = User::where('usu_ci', $request->input('ci'))->first();
        if ($revCI != null) {
            return "ciYaExistente";
        }
        $revEmail = User::where('email', $request->input('email'))->first();
        if ($request->input('email') == null) {
            $revEmail = null;
        }
        if ($revEmail != null) {
            return "emailYaExistente";
        }
        //    se registrara al usuario
        $newUser = new User;

        $newUser->usu_ci = $request->input('ci');
        $newUser->email = $request->input('email');
        $newUser->password = bcrypt('12345');
        $newUser->usu_nombre = $request->input('nombre');
        $newUser->usu_appaterno = $request->input('apellido1');
        $newUser->usu_apmaterno = $request->input('apellido2');
        $newUser->usu_sexo = $request->input('sexo');
        $newUser->usu_fechnac = $request->input('fechaNacimiento');
        $newUser->usu_paisnac = $request->input('paisNacimiento');
        $newUser->usu_depnac = $request->input('depNacimiento');
        $newUser->usu_estadocivil = $request->input('estadoCivil');
        $newUser->usu_telf = $request->input('telf');
        $newUser->usu_telfref = $request->input('telfRef');
        $newUser->usu_zona = $request->input('zona');
        $newUser->usu_domicilio = $request->input('domicilio');
        $newUser->usu_zonaSufragio = $request->input('zonaSufragio');
        $newUser->usu_tipoSangre = $request->input('tipoSangre');
        /*datos2 */
        $newUser->usu_cod = Auth::user()->usu_ci;
        $newUser->usu_acceso = $request->input('accesoSistema');
        $newUser->usu_area = $request->input('accModSis');
        $resp = $newUser->save();
        $idNewuser = $newUser->id;
        if ($resp) {
            $nub = new userDatosInst();
            $nub->cod_usu = $idNewuser;
            $nub->di_titulo = $request->input('tituloOB');
            $nub->di_profecion = $request->input('profecionOB');
            $nub->di_especialidad = "";
            $nub->di_seguroNombreCP = $request->input('seguroNombreInstitucionCP');
            $nub->di_codSeguroCP = $request->input('codSeguroCP');
            $nub->di_seguroNombreLP = $request->input('seguroNombreInstitucionLP');
            $nub->di_seguroNua = $request->input('numNua');
            $nub->di_seguroCua = $request->input('numCua');


            $nub->ca_usu_cod = Auth::user()->usu_ci;
            $nub->ca_tipo = "create";
            $nub->ca_fecha = Carbon::now()->format('Y-m-d');
            $nub->ca_estado = 1;
            $resp1 = $nub->save();
            if ($resp1) {
                $nuC = new usuContrato();
                $nuC->cod_usu = $idNewuser;
                $nuC->uc_fechaInicio = $request->input('fechaContratacion');
                $nuC->uc_tipoContrato = $request->input('contrato');
                $nuC->uc_nroContrato = 1;
                $nuC->uc_estado = 1;
                $nuC->uc_area = $request->input('areaDesignada');
                $nuC->uc_cargoDesignado = $request->input('cargo');
                $nuC->ca_usu_cod = Auth::user()->usu_ci;
                $nuC->ca_tipo = 'create';
                $nuC->ca_fecha = Carbon::now()->format('Y-m-d');
                $nuC->ca_estado = 1;
                $resp2 = $nuC->save();
                if ($resp2) {
                    return "succes";
                }
            }
        } else {
            return "false";
        }
    }
    // function FunctionName(Request $request)
    // {
    //     $nuC = usuContrato::where('cod_usu',)->update([
    //         'uc_fechaInicio' => $request->input('fechaContratacion'),
    //         'uc_tipoContrato' => $request->input('contrato'),
    //         'uc_nroContrato' => 1,
    //         'uc_estado' => 1,
    //         'uc_area' => $request->input('areaDesignada'),
    //         'uc_cargoDesignado' => $request->input('cargo'),
    //         'ca_usu_cod' => Auth::user()->usu_ci,
    //         'ca_tipo' => 'create',
    //         'ca_fecha' => Carbon::now()->format('Y-m-d'),
    //         'ca_estado' => 1
    //     ]);
    //     if ($nuC) {
    //         return "succes";
    //     }
    // }
    function destroy(Request $request)
    {
        $res1 = userDatosInst::where('cod_usu', $request->input('id'))->delete();
        if ($res1) {
            $res2 = usuContrato::where('cod_usu', $request->input('id'));
            if ($res2) {
                $res3 = User::where('id', $request->input('id'))->delete();
                if ($res3) {
                    return 'success';
                } else {
                    return 'fail3';
                }
            } else {
                return 'fail2';
            }
        } else {
            return 'fail1';
        }
    }
    function datos1User(Request $request)
    {
        return User::where('id', $request->input('id'))->first();
    }
    function dayVacacion()
    {
    }
}
