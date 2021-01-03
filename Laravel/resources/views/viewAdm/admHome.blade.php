@extends('layouts.admLay2')
@section('refUbi')
<ol class="breadcrumb">
        <li><a href="#">Administracion</a></li>
        <li class="active">Estado del dia</li>
</ol>
@endsection
@section('content')
<div class="col-lg-12">
        <section class="panel">
                <header class="panel-heading  align-lg-center">
                        <h2><strong>C.S.J.O.</strong>Bienvenido Administracion</h2>
                </header>
        </section>
</div>
<div class="row pricing">
        <div class="col-lg-3 col-md-3 col-xs-6">
                <ul class="plan corner-flip flip-gray">
                        <li class="plan-name"> Recepcion </li>
                        <li class="plan-price" id="pacientesRegistrados"> --- <span>Pancientes registrados</span> </li>
                        <li> <strong>--</strong> -- </li>
                        <li> <strong>--</strong> -- </li>
                </ul>
        </div>
        <div class="col-lg-3 col-md-3 col-xs-6">
                <ul class="plan corner-flip flip-gray">
                        <li class="plan-name"> RRHH </li>
                        <li class="plan-price" id="usuariosRegistrados"> --- <span>Usuarios registrados</span> </li>
                        <li> <strong>// </strong> -- </li>

                </ul>
        </div>
        <div class="clearfix"></div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('/asincrono/administracionHome.js') }}"></script>
<script>
        $(document).ready(function() {
                $("#formID").submit(function(e) {
                        e.preventDefault();
                        if ($(this).parsley('validate')) {
                                alert("send");
                        }
                });
                //iCheck[components] validate
                $('input').on('ifChanged', function(event) {
                        $(event.target).parsley('validate');
                });
        });
</script>
@endsection