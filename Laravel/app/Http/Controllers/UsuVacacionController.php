<?php

namespace App\Http\Controllers;

use App\User;
use App\usuContrato;
use App\usuVacacion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UsuVacacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->input('id');
        $dato = array();
        $diasV = 0;
        $diasVaUsados = 0;

        $fechaCotrato = usuContrato::where('cod_usu', $id)
            ->where('uc_nroContrato', usuContrato::where('cod_usu', $id)->max('uc_nroContrato'))->value('uc_fechaInicio');
        $fechaCon = Carbon::parse($fechaCotrato);
        $fechaCon = $fechaCon->format('d-m-Y');
        $fechaCotrato = Carbon::parse($fechaCotrato);
        $añoContrato = $fechaCotrato->format('Y');
        $fechaActual = Carbon::now();
        $AñosTrabajados = $fechaCotrato->diffInYears($fechaActual);

        for ($i = 1; $i <= $AñosTrabajados + 1; $i++) {
            $a = ["a" => $fechaCon, "b" => $diasV, "c" => $diasVaUsados];
            $añoContrato += 1;
            array_push($dato, $a);
            $fechaCon = Carbon::parse($fechaCon)->addYear()->format('d-m-Y');
            if ($i == 1) {
                $diasV = 15;
            }
            if ($i == 5) {
                $diasV = 20;
            } else if ($i == 12) {
                $diasV = 30;
            }
        }
        $diasVaUsados = usuVacacion::where('cod_usu', $id)->sum('uv_diasVac');
        $fecha1 = Carbon::parse($fechaCotrato)->format('Y-m-d');
        $fecha2 = Carbon::parse($fechaCon)->subYear(1)->format('Y-m-d');



        $dat = array([
            'años' => $dato,
            'dias' => $diasV,
            'date1' => $fecha1,
            'date2' => $fecha2,
            'DVU' => $diasVaUsados,
            'fechContrato' => Carbon::parse($fechaCotrato)->format('d-m-Y'),
        ]);

        return $dat;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $uv = new usuVacacion;
        $uv->cod_usu = $request->input('id');
        $uv->uv_fecha1 = $request->input('d1');
        $uv->uv_fecha2 = $request->input('d2');
        $uv->uv_diasVac = $request->input('dv');
        $uv->uv_obs = $request->input('ob');
        $uv->uv_codDocResp = $request->input('dr');
        $res = $uv->save();
        if ($res) {
            return "success";
        } else {
            return "fail";
        }
    }
    public function list(Request $request)
    {
        return usuVacacion::where('cod_usu', $request->input('id'))->orderBy('created_at', 'desc')->get();
    }

    public function show(usuVacacion $usuVacacion)
    {
        //
    }

    public function edit(Request $request)
    {
        return usuVacacion::where('id',$request->input('id'))->first();
    }

    public function update(Request $request)
    {
        return usuVacacion::where('id',$request->input('id'))->update([
            'uv_obs'=>$request->input('vacOb_Up'),
            'uv_fecha1'=>$request->input('date1'),
            'uv_fecha2'=>$request->input('date2'),
            'uv_diasVac'=>$request->input('vacDayU'),
            'uv_obs'=>$request->input('vacObs'),
        ]);       
    }

    public function destroy(Request $request)
    {
        $res = usuVacacion::where('id', $request->input('id'))->delete();
        if ($res) {
            return "success";
        } else {
            return "fail";
        }
    }
    public function dayVacacion(Request $request)
    {
        $id = $request->input('id');
        $dato = array();
        $diasV = 0;
        $diasV1 = 0;
        $diasVaUsados = 0;

        $fechaCotrato = usuContrato::where('cod_usu', $id)
            ->where('uc_nroContrato', usuContrato::where('cod_usu', $id)->max('uc_nroContrato'))->value('uc_fechaInicio');
        $fechaCon = Carbon::parse($fechaCotrato);
        $fechaCon = $fechaCon->format('d-m-Y');
        $fechaCotrato = Carbon::parse($fechaCotrato);
        $añoContrato = $fechaCotrato->format('Y');
        $fechaActual = Carbon::now();
        $AñosTrabajados = $fechaCotrato->diffInYears($fechaActual);

        for ($i = 1; $i <= $AñosTrabajados + 1; $i++) {
            $a = ["a" => $fechaCon, "b" => $diasV, "c" => $diasVaUsados];
            $añoContrato += 1;
            array_push($dato, $a);
            $fechaCon = Carbon::parse($fechaCon)->addYear()->format('d-m-Y');
            $diasV1 +=$diasV;
            if ($i == 1) {
                $diasV = 15;
            }
            if ($i == 5) {
                $diasV = 20;
            } else if ($i == 12) {
                $diasV = 30;
            }
        }
        $diasVaUsados = usuVacacion::where('cod_usu', $id)->sum('uv_diasVac');
        $dat = array([
            'dias' => $diasV1,
            'DVU' => $diasVaUsados,
        ]);
        return $dat;
    }
}
