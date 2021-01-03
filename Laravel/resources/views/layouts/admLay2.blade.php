<!DOCTYPE html>
<html lang="es">

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
                    <li class="hidden-xs hidden-sm"><a class="h-seperate">AREA : ADMINISTRACION</a></li>

                    <li><a href="#"><img alt="" src="" class="circle"></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                            <em><strong>Usuario Activo </strong>, {{ Auth::user()->usu_nombre }} - CI:
                                {{ Auth::user()->usu_ci}} </em> <i class="dropdown-icon fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right icon-right arrow">
                            <li><a href="{{route('store_user_adm')}} "><i class="fa fa-user"></i> Perfil</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    salir
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                        <!-- //dropdown-menu-->
                    </li>
                    <li class="visible-lg">
                        <a href="#" class="h-seperate fullscreen" data-toggle="tooltip" title="Full Screen" data-container="body" data-placement="left">
                            <i class="fa fa-expand"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- //tools-bar-->

        </div>
        <div id="main">
            @yield('refUbi')
            <!-- //breadcrumb-->
            <div id="content">
                @yield('content')
                <!-- //content > row-->
            </div>
        </div>
        <!-- //main-->
        <nav id="menu">
            <ul>
                <li><a href="{{route('adm.Home')}}"><i class="icon  fa fa-user "></i> Inicio</a></li>
                <li><a href="{{route('home-admRecep')}}"><i class="icon  fa fa-plus-square"></i> Recepcion</a></li>
                <li><span><i class="icon  fa fa-briefcase"></i>RRHH</span>
                    <ul>
                        <li><a href="{{route('empleado_home')}}"> Personal </a></li>
                        <li><a href=""> Subcidios </a></li>
                    </ul>
                <li><a href="{{route('home_area')}}"><i class="icon  fa fa-building-o"></i> Areas </a></li>
                </li>
                <li><a href="#" id="btn_index_pre_cotizaciones"><i class="icon fa fa-file"></i>Pre-Cotizaciones</a></li>
                <li><a href="#" id="btn_index_descargosQuiEndo"><i class="icon fa fa-file"></i>Descargos Medicos</a></li>
            </ul>
        </nav>

    </div>
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
    <!-- Library Morris Chart-->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>3
    <script type="text/javascript" src="{{ asset('assets/plugins/morris/morris.js') }}"></script>
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}" />

    <!-- Library  5+ plugins for bootstrap -->
    <script type="text/javascript" src="{{asset('assets/plugins/pluginsForBS/pluginsForBS.js')}}"></script>



    <!-- scripts propios del sistema-->
    <script type="text/javascript" src="{{ asset('/asincrono/cotizaciones.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/asincrono/homeJs.js') }}"></script>


    <!--  -->
    <script>
        $('nav#menu').mmenu({
            searchfield: false,
            slidingSubmenus: false,
        });
    </script>
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
            for (var i in especiales) {
                if (key == especiales[i]) {
                    tecla_especial = true;
                    break;
                }
            }

            if (letras.indexOf(tecla) == -1 && !tecla_especial)
                return false;
        }

        function limpia() {
            var val = document.getElementById("miInput").value;
            var tam = val.length;
            for (i = 0; i < tam; i++) {
                if (!isNaN(val[i]))
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
            for (var i in especiales) {
                if (key == especiales[i]) {
                    tecla_especial = true;
                    break;
                }
            }

            if (letras.indexOf(tecla) == -1 && !tecla_especial)
                return false;
        }

        function limpia() {
            var val = document.getElementById("miInput").value;
            var tam = val.length;
            for (i = 0; i < tam; i++) {
                if (!isNaN(val[i]))
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
            for (var i in especiales) {
                if (key == especiales[i]) {
                    tecla_especial = true;
                    break;
                }
            }

            if (letras.indexOf(tecla) == -1 && !tecla_especial)
                return false;
        }

        function limpia() {
            var val = document.getElementById("miInput").value;
            var tam = val.length;
            for (i = 0; i < tam; i++) {
                if (!isNaN(val[i]))
                    document.getElementById("miInput").value = '';
            }
        }
    </script>

</body>

</html>