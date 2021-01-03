<!DOCTYPE html>
<html lang="es">
<head>
<!-- Meta information -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<!-- Title-->



<title>{{ config('app.name', 'Laravel') }}</title>
<link href="{{ asset('') }}" rel="stylesheet">




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

</head>
<body class="full-lg">
<div id="wrapper">



<div id="main">
 
<div class="container">
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
@endif   
    <div class="row">
        <div class="col-lg-12">
        
            <div class="account-wall">
                <section class="align-lg-center">
                <div class="site-logo"></div>
                <h1 class="login-title"><span>COREMEDIC </span><br> C.S.J.O. <small> Vercion 2.9</small></h1>
                </section>
                <form id="form-signin" class="form-signin"  method="POST" action="{{ route('login') }}">
                     {{ csrf_field() }}
                    <section>
                        <div class="input-group{{ $errors->has('usu_ci') ? ' has-error' : '' }}">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                <input autocomplete="off"   id="usu_ci" type="text" class="form-control" name="usu_ci" value="{{ old('usu_ci') }}" required autofocus placeholder="Codigo de Usuario">
                                        
                        </div>
                        <div class="input-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="input-group-addon"><i class="fa fa-key"></i></div>
                                <input id="password" type="password" class="form-control" name="password" required placeholder="Contraseña">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                        </div>
                        @if ($errors->has('usu_ci'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('usu_ci') }}</strong>
                                        </span>
                        @endif  

                        @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                        @endif
                        <button class="btn btn-lg btn-theme-inverse btn-block" type="submit" >INGRESAR</button>
                    </section>
                    <section class="clearfix">
                    </section>      
                        
                        
                </form>
            </div>  
            
            <!-- //account-wall-->
                
        </div>
        <!-- //col-sm-6 col-md-4 col-md-offset-4-->
    </div>
    <!-- //row-->
</div>
<!-- //container-->

</div>
<!-- //main-->

        
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
<script type="text/javascript">
$(function() {
           //Login animation to center 
            function toCenter(){
                    var mainH=$("#main").outerHeight();
                    var accountH=$(".account-wall").outerHeight();
                    var marginT=(mainH-accountH)/2;
                           if(marginT>30){
                               $(".account-wall").css("margin-top",marginT-15);
                            }else{
                                $(".account-wall").css("margin-top",30);
                            }
                }
                toCenter();
                var toResize;
                $(window).resize(function(e) {
                    clearTimeout(toResize);
                    toResize = setTimeout(toCenter(), 500);
                });
                
            //Canvas Loading
              var throbber = new Throbber({  size: 32, padding: 17,  strokewidth: 2.8,  lines: 12, rotationspeed: 0, fps: 15 });
              throbber.appendTo(document.getElementById('canvas_loading'));
              throbber.start();
                   
    });
</script>
<script type="text/javascript">
    $('div.alert').delay(4000).slideUp(300);
 </script>
</body>
</html>
