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
<link rel="shortcut icon" href="{{ asset('assets/ico/CSJO.ico') }}">
<!-- CSS Stylesheet-->
<link type="text/css" rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap-I.min.css') }}" />
<link type="text/css" rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap-themes-o.css') }}" />
<link type="text/css" rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />



</head>
<body>
<div id="content">
		<div class="row">
			<section class="panel corner-flip">
				<div class="panel-body">
					<div class="invoice">
						<div class="row">
							<div class="col-sm-6">
								<a href="#"><img src="{{ asset('assets/img/logo_reporte.png')}}"></a>
							</div>
							<div class="col-sm-6 align-lg-right">
									<h3>REPORTE AREA - {{Auth::user()->usu_area}}</h3>

									<span>Usuario: {{ Auth::user()->usu_ci }} //  Fecha: {{ $fecha_actual}}</span>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-12">
									<h4>Detalles :</h4>
									Reporte de : {{$tipo_re}} <br>
									Tipo de pago : {{$ate_pago}} <br>
									Turno : {{$turno}} <br>
									En fecha : {{$fecha_re}} </div>
							</div>
						<hr>
						</div>
						<table class="table table-bordered">
							@if($tabla == '1')
							<thead>
									<tr>
											<th>HCL</th>
											<th>C.I.</th>
											<th>NOMBRE</th>
											<th>MEDICO</th>
											<th>ESPECIALIDAD</th>
											<th class="text-center">PROCEDIMIENTO</th>
											<th >TURNO</th>
											<th class="text-center">ESTADO DE PAGO</th>

									</tr>
							</thead>
							<tbody>
									@foreach($pago as $pago)
									<tr>
											<td>{{ $pago->pa_hcl }}</td>
											<td>{{ $pago->pa_ci}}</td>
											<td class="text-center">{{ $pago->pa_nombre }} {{ $pago->pa_appaterno }} {{ $pago->pa_apmaterno }}</td>
											<td class="text-center">{{ $pago->ps_appaterno }} {{ $pago->ps_apmaterno }} {{ $pago->ps_nombre }} </td>
											<td class="text-center">{{ $pago->nombre}}</td>
											<td class="text-center">{{ $pago->ate_procedimiento }}</td>
											<td class="text-center">{{ $pago->ate_turno }}</td>
											@if( $pago->ate_pago == 'pendiente')
			                                <th><span class="label label-warning">{{ $pago->ate_pago }}</th>
			                                @else
			                                <th><span class="label label-success">{{ $pago->ate_pago }}</th>
			                                @endif
											
									</tr>
									@endforeach
							</tbody>
							@endif
						
							@if($tabla == '2')
							<thead>
									<tr>
											<th width="60%" > ESPECIALIDAD</th>
                                			<th class="text-center"># DE PACIENTES QUE PAGARON</th>

									</tr>
							</thead>
							<tbody>
									@foreach($pago as $pago)
									<tr>
											<td class="text-center">{{ $pago->nombre }}</td>
											<td class="text-center">{{ $pago->count}}</td>
											
											
									</tr>
									@endforeach
							</tbody>
							@endif
							@if($tabla == '3')
							<thead>
									<tr>
											<th width="60%" > MEDICO</th>
                                			<th class="text-center">CANTIDAD DE PACIENTES ATENDIDOS </th>

									</tr>
							</thead>
							<tbody>
									@foreach($pago as $pago)
									<tr>
											<td class="text-center">{{ $pago->ps_appaterno }} {{ $pago->ps_apmaterno }} {{ $pago->ps_nombre }} </td>
											<td class="text-center">{{ $pago->count}} </td>
											
											
									</tr>
									@endforeach
							</tbody>
							@endif
							@if($tabla == '4')
							<thead>
									<tr>
											<th width="60%" > DESCRIPCION</th>
                                			<th class="text-center">CANTIDAD</th>

									</tr>
							</thead>
							<tbody>
									@if($ate_pago == 'pendiente')
				                            <tr>
				                                <th>CANTIDAD DE PACIENTES QUE NO PAGARON TURNO MAÑANA</th>
				                                <th>{{$pago_mañana}} </th>
				                            </tr>
				                            <tr>
				                                <th>CANTIDAD DE PACIENTES QUE NO PAGARON TURNO TARDE</th>
				                                <th>{{$pago_tarde}} </th>
				                            </tr>
				                            <tr>
				                                <th>CANTIDAD DE PACIENTES QUE NO PAGARON EN LA JORNADA</th>
				                                <th>{{$pago_jornada}} </th>
				                            </tr>
				                            @else
				                            
				                            <tr>
				                                <th>CANTIDAD DE PACIENTES QUE PAGARON TURNO MAÑANA</th>
				                                <th>{{$pago_mañana}} </th>
				                            </tr>
				                            <tr>
				                                <th>CANTIDAD DE PACIENTES QUE PAGARON TURNO TARDE</th>
				                                <th>{{$pago_tarde}} </th>
				                            </tr>
				                            <tr>
				                                <th>CANTIDAD DE PACIENTES QUE PAGARON EN LA JORNADA</th>
				                                <th>{{$pago_jornada}} </th>
				                            </tr>
									@endif
							</tbody>
							@endif
						</table>
						<br>
						<div class="row">
							<div class="col-sm-6">
								<div class="align-lg-left"> 
										
								</div>
							</div>
							<div class="col-sm-6">
								<div class="align-lg-right">
									<ul>
										
									</ul>
									<br>
									<a href="javascript:window.print();" class="btn btn-theme hidden-print"><i class="fa fa-print"></i> </a>
								</div>
							</div>
						</div>
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
</body>
</html>