<?php
namespace App\Http\Controllers;
use App\pacientes;
use App\prestHCL;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class PrestHCLController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
    }
    public function create(Request $request)
    {
        //return $request;
        $prest = new prestHCL();
        $prest->cod_hcl=$request->input('id');
        $prest->prest_usuEntrega = $request->input('usuEntrega');
        $prest->prest_area=$request->input('areaPrestamo');
        $prest->prest_dias="1";
        $prest->prest_estado="1";
        $prest->ca_cod_usu=Auth::user()->usu_ci;
        $prest->ca_tipo="create";
        $prest->ca_fecha=Carbon::now();
        $prest->ca_estado="1";
        $res=$prest->save();
        $paci= pacientes::where('pa_id',($request->input('id')))->update(['hclEst'=>$prest->id]);

        if ($res){
            return "1";
        }else{
            return "0";
        }
        return "0";
    }
    public function list()
    {
        $list = prestHCL::join('pacientes','presthcl.cod_hcl','=','pacientes.pa_id')
            ->select('prestHCL.*','pacientes.pa_hcl','pacientes.pa_nombre','pacientes.pa_appaterno','pacientes.pa_apmaterno')
            ->where('prest_estado',1)->latest('created_at')
            ->get();
        return $list;
    }
    public function listFiltrado(Request $request)
    {
        //return $request;
        $estado = $request->input("estado");
        $area = $request->input("area");
        $fecha= $request->input("fecha");
        $personal = $request->input("personal");
        $var =  prestHCL::join('pacientes','presthcl.cod_hcl','=','pacientes.pa_id')
            ->select('prestHCL.*','pacientes.pa_hcl','pacientes.pa_nombre','pacientes.pa_appaterno','pacientes.pa_apmaterno')->where('prest_estado',$estado);
        if ($area != null){$var = $var->where('prest_area','=',$area);}
        if ($fecha != null){$var = $var->whereDate('created_at',$fecha);}
        if ($personal != null){$var = $var->where('prest_usuEntrega','like','%'.$personal.'%');}
        $var= $var->latest('created_at')->get();
        return $var;
    }
    public function show($id)
    {
        $list = prestHCL::join('pacientes','presthcl.cod_hcl','=','pacientes.pa_id')
            ->select('prestHCL.*','pacientes.pa_hcl','pacientes.pa_nombre','pacientes.pa_appaterno','pacientes.pa_apmaterno')
            ->where('prestHCL.id',$id)->first();
        return $list;
    }
    public function edit(prestHCL $prestHCL)
    {
        //
    }
    public function update(Request $request)
    {
        $fechaActual = Carbon::now();
        $id = $request->input("id");
        $newUsuEntrega = $request->input("usuentrega");
        $newArea = $request->input("area");
        $res = prestHCL::where('id',$id)->update([  'prest_area'=>$newArea,
                                                    'prest_usuEntrega'=>$newUsuEntrega,
                                                    'ca_tipo'=>"update",
                                                    'ca_fecha'=>$fechaActual]);
        if ($res){
            return 1;
        }else{
            return 0;
        }
        return "error";
    }
    public function destroy(prestHCL $prestHCL)
    {
        //
    }
    public function cerrarPrestamo($id)
    {
        $fechaActual= Carbon::now();
        $fechaInicio=prestHCL::where('id',$id)->value('created_at');
        $fechaInicio= Carbon::parse($fechaInicio);
        $totalDias=$fechaActual->diffInDays($fechaInicio);
        $res = prestHCL::where('id',$id)->update([  'prest_estado'=>0,
                                                    'prest_fechaEntrega'=>$fechaActual,
                                                    'prest_dias'=>$totalDias]);
        $codhcl=prestHCL::where('id',$id)->value('cod_hcl');
        $paci=pacientes::where('pa_id',$codhcl)->update(['hclEst'=>null]);
        if ($res){
            return "1";
        }else{
            return "0";
        }
        return "error";
    }
}
