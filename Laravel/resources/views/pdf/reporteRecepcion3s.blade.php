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
			<section class="panel corner-flip">
				<div class="panel-body">
					<div class="invoice">
						<div class="row">
							<div class="col-sm-6">
								<a href="#"><img src="{{ asset('assets/img/logo_reporte.png')}}"></a>
							</div>
							<div class="col-sm-6 align-lg-right">
									<h3>REPORTE AREA - Recepcion</h3>
									<span>Usuario: {{ Auth::user()->usu_ci }} //  Fecha: {{ $fecha_actual}}</span>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-12">
									<h4>Detalles sss:</h4>
									Reporte : Informe diario de actividad en "AFILIACION Y ATENCION DE PACIENTES"<br>
									Total paceintes Afiliados : {{$to_afi}} <br>
									Total pacientes atendidos : {{$to_ate}} <br>
									En fecha : {{$fecha}} </div>
							</div>
						</div>
						<hr>
						<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped" id="">
                          
                          <thead>
                                    <tr>
                                            <th class="text-center"> # HCL</th>
                                            <th class="text-center"> CI</th>
                                            <th class="text-center">NOMBRE APELLIDO</th>
                                            <th class="text-center">MEDICO</th>
                                            <th class="text-center">ESPECIALIDAD</th>
                                            <th class="text-center"># TICKED</th>
                                            <th class="text-center">PAGO EN CAJA</th>
                                    </tr>
                            </thead>
                            <tbody align="center">
                                    
                                    @foreach ($atencion as $atencion)
                                    <tr>
                                        <td ><span class="label label-success">{{ $atencion->pa_hcl }}</span></td>
                                        <td>{{ $atencion->pa_ci}} </td>
                                        <td>{{ $atencion->pa_nombre}} {{ $atencion->pa_appaterno }} {{ $atencion->pa_apmaterno }} </td>
                                        <td >{{ $atencion->ps_appaterno }} {{ $atencion->ps_apmaterno }} {{ $atencion->ps_nombre }}</td>
                                        <td >{{ $atencion->nombre }}</td>
                                        <td>{{ $atencion->ate_num_ticked}} </td>
                                        @if($atencion->ate_pago == "pendiente" )
                                        <td>{{ $atencion->ate_pago}} </td>
                                        @else
                                        <td><span class="label label-sm label-info">{{ $atencion->ate_pago}} </td>
                                        @endif                                   
                                   	@endforeach
                                        

                                   
                                   

                                    </tr>
                                    
                                    
                            </tbody>
                        
                         

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