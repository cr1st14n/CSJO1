<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta information -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<!-- Title-->
<title>{{ config('app.name', 'Laravel') }}</title>
<!-- Favicons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}">
<link rel="apple-touch-icon-precomposed" href="{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}">
<link rel="shortcut icon" href="{{ asset('assets/ico/favicon.ico') }}">
<!-- CSS Stylesheet-->
<link type="text/css" rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap-I.min.css') }}" />
<link type="text/css" rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap-themes-o.css') }}" />
<link type="text/css" rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />



</head>
<body>
<div id="content">
	<div class="row">
		<section class="panel ">
			<div class="panel-body">
				<div class="invoice">
					<div class="row">
						<div class="col-sm-12">
							<div class="align-lg-right">
								<a href="javascript:window.print();" class="btn btn-theme hidden-print"><i class="fa fa-print"></i></a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<a href="#"><img src="{{ asset('assets/img/logo_reporte.png')}}"></a>
						</div>
						<div class="col-sm-6 align-lg-center" >
								<h4>HISTORIA  CLINICA <br>CONSULTA EXTERNA <br># HCL.:{{$paciente->pa_hcl}} </h4>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-12">
						
						<table width="100%" style="text-transform: uppercase;" >
							
							<tbody >
								<tr>
									<td ><h5 >NOMBRE : {{$paciente->pa_appaterno }} {{$paciente->pa_apmaterno }} {{$paciente->pa_nombre }}</h5></td>
									<td  ><h5>C.I.: {{$paciente->pa_ci}} </h5></td>
								</tr>
								<tr>
									<td ><h5>DIRECCION : {{$paciente->pa_zona}} - {{$paciente->pa_domicilio}} </h5></td>
									<td ><h5>TELF/CEL: {{$paciente->pa_telf}} </h5></td>
								</tr>
								<tr>
									<td ><h5>LUGAR DE NACIMIENTO: {{$paciente->pa_pais_nac}} / {{  $paciente->pa_ciudad_nac}}  </h5></td>
									<td ><h5>FECHA DE NACIMIENTO: {{$fechnac}} </h5></td>
								</tr>
							</tbody>
						</table>
						</div>
					</div>
					<hr>
					<table class="table table-bordered"  >
						<thead>
								<tr>
                            			<th class="text-center">ANTECEDENTES</th>

								</tr>
						</thead>
						<tbody>
								<tr>
										<td class="text-center"></td>
								</tr>
								<tr>
										<td class="text-center"></td>
								</tr>
								<tr>
										<td class="text-center"></td>
								</tr>
								<tr>
										<td class="text-center"></td>
								</tr>
								
						</tbody>
					</table>
					<table class="table table-bordered"  >
						<thead >
								<tr>
										<th width="20%" > FECHA</th>
                            			<th class="text-center">EVOLUCION</th>

								</tr>
						</thead>
						<tbody>
								<tr>
										<td class="text-center"></td>
										<td class="text-center"></td>
								</tr>
								<tr>
										<td class="text-center"></td>
										<td class="text-center"></td>
								</tr>
								
								<tr>
										<td class="text-center"></td>
								</tr>
								<tr>
										<td class="text-center"></td>
										<td class="text-center"></td>
								</tr>
								
								<tr>
										<td class="text-center"></td>
										<td class="text-center"></td>
								</tr>
								<tr>
										<td class="text-center"></td>
										<td class="text-center"></td>
								</tr>
								<tr>
										<td class="text-center"></td>
										<td class="text-center"></td>
								</tr>
								<tr>
										<td class="text-center"></td>
										<td class="text-center"></td>
								</tr>
								<tr>
										<td class="text-center"></td>
										<td class="text-center"></td>
								</tr>
								
								<tr>
										<td class="text-center"></td>
										<td class="text-center"></td>
								</tr>
								<tr>
										<td class="text-center"></td>
										<td class="text-center"></td>
								</tr>
								<tr>
										<td class="text-center"></td>
										<td class="text-center"></td>
								</tr>
								<tr>
										<td class="text-center"></td>
										<td class="text-center"></td>
								</tr>
								<tr>
										<td class="text-center"></td>
										<td class="text-center"></td>
								</tr>
								<tr>
										<td class="text-center"></td>
										<td class="text-center"></td>
								</tr>
								<tr>
										<td class="text-center"></td>
										<td class="text-center"></td>
								</tr>
						</tbody>
					</table>
				</div>
				<!-- //invoice -->
			</div>
		</section>
	</div>
	<!-- //content > row-->
</div>
<!-- //content-->



<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
		
<!-- Jquery Library -->
<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/bootstrap/bootstrap.min.js') }}"></script>
<!-- Modernizr Library For HTML5 And CSS3 -->
<script type="text/javascript" src="{{ asset('assets/js/modernizr/modernizr.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/mmenu/jquery.mmenu.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/styleswitch.js') }}"></script>
<!-- Library 10+ Form plugins-->
<script type="text/javascript" src="{{ asset('assets/plugins/form/form.js') }}"></script>
<!-- Datetime plugins -->
<script type="text/javascript" src="{{ asset('assets/plugins/datetime/datetime.js') }}"></script>
<!-- Library Chart-->
<script type="text/javascript" src="{{ asset('assets/plugins/chart/chart.js') }}"></script>
<!-- Library  5+ plugins for bootstrap -->
<script type="text/javascript" src="{{ asset('assets/plugins/pluginsForBS/pluginsForBS.js') }}"></script>
<!-- Library 10+ miscellaneous plugins -->
<script type="text/javascript" src="{{ asset('assets/plugins/miscellaneous/miscellaneous.js') }}"></script>
<!-- Library Themes Customize-->
<script type="text/javascript" src="{{ asset('assets/js/caplet.custom.js') }}"></script>
<!-- Library datable -->
<script type="text/javascript" src="{{ asset('assets/plugins/datable/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/datable/dataTables.bootstrap.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    window.print();
    window.close();
  });
</script>
</body>
</html>