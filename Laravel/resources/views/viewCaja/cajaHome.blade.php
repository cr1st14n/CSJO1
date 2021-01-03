@extends('layouts.CajaLay')
@section('refUbi')
<ol class="breadcrumb">
	<li><a href="#">Administracion</a></li>
	<li class="active">Estado del dia</li>
</ol>

@endsection
@section('content')
<div class="row pricing">
        <div class="col-lg-12">
            <section class="panel">
                    <header class="panel-heading  align-lg-center">
                            <h2><strong>C.S.J.O.</strong>Bienvenido a Caja</h2>
                    </header>
            </section>
        </div>
        <br>
        <div class="col-lg-3" ></div>
        <div class="col-lg-3 col-md-3 col-xs-6">
                <ul class="plan corner-flip flip-gray">
                        <li class="plan-name"> Pacientes en fila </li>
                        <li class="plan-price">{{$paci_fila}} <span>Pacientes </span> </li>
                        
                </ul>
        </div>
        <div class="col-lg-3 col-md-3 col-xs-6">
                <ul class="plan  corner-flip flip-gray">
                        <li class="plan-name"> Estado de pagos</li>
                        <li class="plan-price">{{$paci_pagaron}} <span>Pagos de Atencion medica</span> </li>
                        
                </ul>
        </div>
        

</div>
<!-- //content > row-->

@endsection

@section('scripts')
<script>

    $(document).ready(function(){

    $("#formID").submit(function(e){
            e.preventDefault();
            if($(this).parsley( 'validate' )){
                alert("send");
            }
        });
        
        //iCheck[components] validate
        $('input').on('ifChanged', function(event){
            $(event.target).parsley( 'validate' );
        });
        
    });
</script>



@endsection

