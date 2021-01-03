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

class AjaxPacienteController extends Controller
{
    public function listPacientes()
    {
    	#return "jeje";
    	return datatables()->query(DB::table('pacientes')->limit(100))->toJson();
    	#return datatables()->eloquent(Pacientes::where('pa_appaterno',"j"))->toJson();
    	#return Pacientes::count('pa_id');
    }
   
    public function buscarPacientesText($texto)
    {
    	#return $texto;
        $var_Busqueda='';
        $apep='';
        $apem=''; 
        $apem2='';
        $a = ''; 
        $b = ''; 
        $c = ''; 
	        //fragmentar input por estacio
	        $trozo = preg_split("/[-]+/", $texto);
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
	        $i="$a$b$c";
	        switch ($i) {
	          case 'vvv':
	            # code...
	          //echo "primera iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1'";
	            //$pacientes = pacientes::where(('pa_nombre','Like',$nom.'%') && 'pa_appaterno','Like',$apep.'%' && 'pa_apmaterno','Like',$apem.'%')->get();

	            return pacientes::Where(function($q) use ($nom,$apep,$apem){
	                              $q->where('pa_nombre','like','%'.$nom.'%')
	                                ->where('pa_appaterno','like',$apep.'%')
	                                ->Where('pa_apmaterno','like',$apem.'%'); })->limit(50)->get();
	            //$pacientes=pacientes::where([['pa_nombre','like','%'.$nom.'%'],['pa_appaterno','like',$apep.'%'],['pa_apmaterno','like',$apem.'%']])->get();
	            break;
	          case 'vvf':
	            # code...
	          //echo "segunda iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1' " ;
	            return pacientes::Where(function($q) use ($nom,$apep,$apem){
	                              $q->where('pa_nombre','like','%'.$nom.'%')
	                                ->where('pa_appaterno','like',$apep.'%'); })->limit(50)->get();
	            break;
	          case 'vfv':
	            # code...
	          //echo "tercera iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1' ";
	            return pacientes::Where(function($q) use ($nom,$apep,$apem){
	                              $q->where('pa_nombre','like','%'.$nom.'%')
	                                ->Where('pa_apmaterno','like',$apem.'%'); })->limit(50)->get();          
	            break;
	          case 'vff':
	            # code...
	          //echo "cuarta iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1' ";
	             return pacientes::Where(function($q) use ($nom,$apep,$apem){
	                              $q->where('pa_nombre','like','%'.$nom.'%'); })->limit(50)->get();
	                               

	            break;
	          case 'fvv':
	            # code...
	          //echo "quinta iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1' ";
	            return pacientes::Where(function($q) use ($nom,$apep,$apem){
	                              $q->where('pa_appaterno','like',$apep.'%')
	                                ->Where('pa_apmaterno','like',$apem.'%'); })->limit(50)->get();
	            break;
	          case 'fvf':
	            # code...
	          //echo "sexta iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1' ";
	            return pacientes::Where(function($q) use ($nom,$apep,$apem){
	                              $q->where('pa_appaterno','like',$apep.'%')
	                                ; })->limit(50)->get();
	            break;
	          case 'ffv':
	            # code...
	          //echo "septima iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1' ";
	            return pacientes::Where(function($q) use ($nom,$apep,$apem){
	                              $q->Where('pa_apmaterno','like',$apem.'%'); })->limit(50)->get();
	            break;
	          case 'fff':
	            # code...
	          //echo "octava iteracion N==> '$nom' AP==> '$apep' AM==> '$apem' '$dato1' ";
	            $tabla='0';
	        //   return view('viewRecepcion.formBuscarPaciente')->with("tabla",$tabla)->with("num",$var_num)->with("Busqueda",$var_Busqueda);

	            break;

	          default:
	            # code...
	            break;
	        }
		return "error revisar AjaxPacienteController";        
    }

    public function buscarPacientesHCL($hcl)
    {
      return pacientes::where('pa_ci', $hcl)->orwhere('pa_hcl',$hcl)->orderBy('pa_hcl','asc')->limit(10)->get();
    }

}
