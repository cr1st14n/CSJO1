<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\pacientes;
use DB;
// use Barryvdh\DomPDF\PDF as PDF;
use PDF;
class PdfController extends Controller
{
	 public function __construct()
    {
        $this->middleware('auth');
    }
    public function createPDF($datos,$vistaurl)
    {
    	$data = $datos;
    	$now = new \Datetime();
    	$date = $now->format('d-m-Y');
    	$view = \View::make($vistaurl, compact('data','date'))->render();
    	$pdf = \App::make('dompdf.wrapper');
    	$pdf->loadHTML($view);
    	return $pdf->stream('reporte');
    }
    public function print_PaHcl($pa_hcl)
    {
    	$vistaurl = "pdf.pdf_pa_hcl";
    	$paciente =  DB::table('Pacientes')->where('pa_hcl',$pa_hcl)->first();

    	return $this->createPDF($paciente,$vistaurl);
	}
	public function make1()
	{

		return view('pdf.pdf1');
		$pdf=\PDF::loadView('pdf.pdf1');	
		return $pdf->stream('primerPDF');
	}

}
