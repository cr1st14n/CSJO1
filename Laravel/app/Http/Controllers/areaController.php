<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\area;
use App\User;
use App\usuContrato;

class areaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('viewAdm.FormRegistroArea');
    }
    public function listUsuarios()
    {
        return User::join('user_datos_insts as ud', 'ud.cod_usu', 'users.id')
            ->select('users.id', 'usu_nombre', 'usu_appaterno', 'usu_apmaterno', 'di_profecion')
            ->get();
    }
    public function listUsuAreaAgregar(Request $request)
    {
        $nomArea = area::where('id', $request->input('id'))->value('nombre');
        return User::join('usu_contratos as uc', 'uc.cod_usu', 'users.id')
            ->where('uc.uc_estado', 1)
            ->where('uc.uc_area', '!=', $nomArea)
            ->get();
    }
    public function usuAreaCambio(Request $request)
    {
        return usuContrato::where([['cod_usu', $request->input('id')], ['uc_estado', '1']])->update(
            ['uc_area' => (area::where('id', $request->input('area'))->value('nombre'))]
        );
    }
    public function listUsuAreaCambUsu(Request $request)
    {
        $usuarios = user::select('usu_nombre', 'usu_appaterno', 'users.id')
            ->join('usu_contratos as uc', 'uc.cod_usu', 'users.id')->where('uc.uc_estado', 1)
            ->addSelect('uc.uc_tipoContrato')
            ->get();
        $datos = ['usu' => $usuarios, 'area' => $request->input('id')];
        return $datos;
    }
    public function create(Request $request)
    {
        // return 'hola';
        $ar = new area;
        $ar->nombre = $request->input('nombre');
        $ar->descripcion = $request->input('descripcion');
        $ar->tipo = $request->input('area_tipo');
        $ar->ar_id_encargado = $request->input('usuEncargado');
        $area = $ar->save();
        // return $area;
        if ($area) {
            return 1;
        } else {
            return 0;
        }
    }

    public function edit(Request $request)
    {
        return area::where('id', $request->input('id'))->first();
    }

    public function update(Request $request)
    {
        if ($request->input('nombre') == area::where('id', ($request->input('id')))->value('nombre') ||
        $request->input('nombre') != area::where('nombre', ($request->input('nombre')))->value('nombre')) {
            usuContrato::where('uc_estado',1)
            ->where('uc_area',area::where('id', ($request->input('id')))->value('nombre'))
            ->update(['uc_area'=>$request->input('nombre')]);
            return area::where('id', $request->input('id'))->update([
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'tipo' => $request->input('tipoArea'),
            ]);
        }
        if ($request->input('nombre') == area::where('nombre', ($request->input('nombre')))->value('nombre')) {
            // * nombre registrado
            return "fail1";
        }
    }

    public function homeArea()
    {
        return view('viewRRHH.viewAreas.homeAreas');
    }

    public function list()
    {
        $list = area::join('users as us', 'us.id', 'area.ar_id_encargado')
            ->select('area.*')
            ->addSelect('us.usu_appaterno', 'us.usu_nombre')
            ->orderBy('id', 'asc')
            ->get();
        foreach ($list as $l) {
            $cont = usuContrato::where('uc_area', $l->nombre)->where('uc_estado', 1)->count();
            array_add($l, 'cant_usuarios', $cont);
        }
        return $list;
    }
    public function show(Request $request)
    {
        $area = area::where('id', $request->input('id'))->first();
        $user = User::where('id', $area->ar_id_encargado)->first();
        $cantPersonal = usuContrato::where('uc_area', $area->nombre)->where('uc_estado', 1)->count();
        $personal = usuContrato::where('uc_estado', 1)->where('uc_area', $area->nombre)
            ->select('uc_tipoContrato', 'cod_usu')
            ->join('users as u', 'u.id', 'usu_Contratos.cod_usu')
            ->addSelect('u.usu_nombre', 'u.usu_appaterno')
            ->get();
        $per = usuContrato::where('uc_estado', 1)->where('uc_area', $area->nombre)->groupBy('uc_tipoContrato')->select('uc_tipoContrato', \DB::raw('count(*) as total'))->get();
        array_add($area, 'area_encargado', "$user->usu_appaterno  $user->usu_nombre");
        array_add($area, 'cantidaPersonal', $cantPersonal);
        array_add($area, 'contratos', $per);
        array_add($area, 'personal', $personal);
        return $area;
    }

    // * listar areas disponibles
    public function listAreas()
    {
        return area::get();
    }

    //* actualizar encargado de area
    public function updateUsuEncargado(Request $request)
    {
        if ($request->input('id_usu') > 0 && $request->input('id_area') > 0) {
            return area::where('id', $request->input('id_area'))->update(['ar_id_encargado' => $request->input('id_usu')]);
        } else {
            return 'fail';
        }
    }
    public function delete(Request $request)
    {
        if ($request->input('id') > 0) {
            return area::where('id', $request->input('id'))->first();
        } else {
            return "fail";
        }
    }
    public function destroy(Request $request)
    {
        if ($request->input('id') > 1) {
            usuContrato::where('uc_area', area::where('id', $request->input('id'))->value('nombre'))
                ->where('uc_estado', 1)
                ->update(['uc_area' => 'sin asignar']);
            return area::where('id', $request->input('id'))->delete();
        }
        return 'fail';
    }
    public function removeUsuArea(Request $request)
    {
        return usuContrato::where('cod_usu',$request->input('id'))->where('uc_estado',1)
        ->update(['uc_area'=>'sin asignar']);
    }
}
