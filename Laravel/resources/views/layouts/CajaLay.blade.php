<!DOCTYPE html>
<html lang="en">
<head>
 <meta name="csrf-token" content="{{ csrf_token() }}">
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
<link type="text/css" rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}" />
<link type="text/css" rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap-themes.css') }}" />
<link type="text/css" rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

<!-- Styleswitch if  you don't chang theme , you can delete -->
<link type="text/css" rel="alternate stylesheet" media="screen" title="style1" href="{{ asset('assets/css/styleTheme1.css') }}" />
<link type="text/css" rel="alternate stylesheet" media="screen" title="style2" href="{{ asset('assets/css/styleTheme2.css') }}" />
<link type="text/css" rel="alternate stylesheet" media="screen" title="style3" href="{{ asset('assets/css/styleTheme3.css') }}" />
<link type="text/css" rel="alternate stylesheet" media="screen" title="style4" href="{{ asset('assets/css/styleTheme4.css') }}" />
@yield('head')



</head>
<body class="leftMenu nav-collapse">
<div id="wrapper">
		<!--
		/////////////////////////////////////////////////////////////////////////
		//////////     HEADER  CONTENT     ///////////////
		//////////////////////////////////////////////////////////////////////
		-->
		<div id="header">
		
				<div class="logo-area clearfix">
						<a href="#" class="logo"></a>
				</div>
				<!-- //logo-area-->
				
				<div class="tools-bar">
						<ul class="nav navbar-nav nav-main-xs">
								<li><a href="#" class="icon-toolsbar nav-mini"><i class="fa fa-bars"></i></a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right tooltip-area">
								<li><a href="#menu-right" data-toggle="tooltip" title="Right Menu" data-container="body" data-placement="left"><i class="fa fa-align-right"></i></a></li>
								<li class="hidden-xs hidden-sm"><a  class="h-seperate">AREA : CAJA</a></li>
								
								<li><a href="#" ><img alt="" src=""  class="circle"></a>
								</li>
								<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
											<em><strong>Usuario Activo </strong>,  {{ Auth::user()->usu_nombre }} - CI: {{ Auth::user()->usu_ci}} </em> <i class="dropdown-icon fa fa-angle-down"></i>
										</a>
										<ul class="dropdown-menu pull-right icon-right arrow">
												<li><a href="{{route('store_user_caja')}} "><i class="fa fa-user"></i> Perfil</a></li>
												<li class="divider"></li>
												<li><a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            salir
                                        </a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
										</ul>
										<!-- //dropdown-menu-->
								</li>
								<li class="visible-lg">
									<a href="#" class="h-seperate fullscreen" data-toggle="tooltip" title="Full Screen" data-container="body"  data-placement="left">
										<i class="fa fa-expand"></i>
									</a>
								</li>
						</ul>
				</div>
				<!-- //tools-bar-->
				
		</div>
		<!-- //header-->
		
		
		<!--
		/////////////////////////////////////////////////////////////////////////
		//////////     SLIDE LEFT CONTENT     //////////
		//////////////////////////////////////////////////////////////////////
		-->
		<!-- //seccion eliminada-->
		<!-- //nav-->
		
		
		<!--
		/////////////////////////////////////////////////////////////////////////
		//////////     TOP SEARCH CONTENT     ///////
		//////////////////////////////////////////////////////////////////////
		-->
		<!-- seccion eliminada-->
		<!-- //widget-top-search-->
		<!--
		/////////////////////////////////////////////////////////////////////////
		//////////     MAIN SHOW CONTENT     //////////
		//////////////////////////////////////////////////////////////////////
		-->
		<div id="main">
		@yield('refUbi')
@if(Session::has('flash_message_correcto'))
	    <div class="col-lg-8"></div>
	    <div class="col-lg-4">
            <div class="alert bg-success">
                    <strong>Exelente! </strong>{{ Session::get('flash_message_correcto')}}
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;</button>
            </div>
	    </div>      
@endif
@if(Session::has('flash_message_rechazado'))
        <div class="col-lg-8"></div>
	    <div class="col-lg-4">
         	<div class="alert bg-danger">
            	<strong>Alerta! </strong>{{ Session::get('flash_message_rechazado')}}
            	<button type="button" class="close" data-dismiss="alert" aria-hidden="true" >&times;</button>
        	</div>
        </div>
@endif
		<!-- //breadcrumb-->
				
			<div id="content">
					<div class="row">
    						@yield('content')
					</div>
					<!-- //content > row-->
			</div>
		</div>
		<!-- //main-->
		
<!--
		//////////////////////////////////////////////////////////////
		//////////     LEFT NAV MENU     //////////
		///////////////////////////////////////////////////////////
		-->
		<nav id="menu"  data-search="close">
			<ul>
				<li><a href="{{route('cajaHome')}} "><i class="icon  fa fa-home"></i> Inicio  </a></li>
				<li><a href="{{route('pacientes_cola') }} "><i class="icon  fa fa-male"></i> Pacientes en cola  </a></li>
				<li><a href="{{action('cajaController@store_pagos')}} "><i class="icon  fa fa-building-o"></i> Historial de caja   </a></li>
				<li><a href="{{route('caja_reporte')}} "><i class="icon  fa  fa-bar-chart-o"></i> Informes y Reportes </a></li>

					
							
			</ul>
		</nav>
		<!-- //nav left menu-->
		
		
		
		<!--
		/////////////////////////////////////////////////////////////////
		//////////     RIGHT NAV MENU     //////////
		/////////////////////////////////////////////////////////////
		-->
		<nav id="menu-right">
				<ul>
						<li class="Label label-lg">Color de Thema</li>
						<li>
							<span class="text-center">
								<div id="style1" class="color-themes col1"></div>
								<div id="style2" class="color-themes col2" ></div>
								<div id="style3" class="color-themes col3" ></div>
								<div id="style4" class="color-themes col4" ></div>
								<div id="none" class="color-themes col5" ></div>
							</span>
						</li>
						
						
				</ul>
		</nav>
		<!-- //nav right menu-->
		
		
</div>
<!-- //wrapper-->


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




<!-- scripts propios del sistema-->
@yield('scripts')
 
 <script type="text/javascript">
 	$('div.alert').delay(4000).slideUp(300);
 </script>
 <script>
function soloLe(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = [8, 37, 39, 46];

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}

function limpia() {
    var val = document.getElementById("miInput").value;
    var tam = val.length;
    for(i = 0; i < tam; i++) {
        if(!isNaN(val[i]))
            document.getElementById("miInput").value = '';
    }
}
</script>
<script>
function soloNu(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "0123456789";
    especiales = [8, 37, 39, 46];

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}

function limpia() {
    var val = document.getElementById("miInput").value;
    var tam = val.length;
    for(i = 0; i < tam; i++) {
        if(!isNaN(val[i]))
            document.getElementById("miInput").value = '';
    }
}
</script>
<script>
function soloLeNu(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz0123456789/-#";
    especiales = [8, 37, 39, 46];

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}

function limpia() {
    var val = document.getElementById("miInput").value;
    var tam = val.length;
    for(i = 0; i < tam; i++) {
        if(!isNaN(val[i]))
            document.getElementById("miInput").value = '';
    }
}
</script>

</body>
</html>

