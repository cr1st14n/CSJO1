@extends('layouts.RecepLay')
@section('refUbi')
<ol class="breadcrumb">
	<li><a href="#">Recepcion</a></li>
	<li class="active">Estado del dia</li>
</ol>

@endsection
@section('content')
                        <div class="row pricing">
                                
                                <br>
                                <div class="col-lg-3 col-md-3 col-xs-6">
                                        <ul class="plan corner-flip flip-gray">
                                                <li class="plan-name"> Pacientes </li>
                                                <li class="plan-price"> {{$paciente}}<span>Pacientes registrados </span> </li>
                                                
                                        </ul>
                                </div>
                                
                                <div class="col-lg-3 col-md-3 col-xs-6">
                                        <ul class="plan corner-flip flip-gray">
                                                <li class="plan-name"> Servicios </li>
                                                <li class="plan-price">{{$especialidades}} <span>Servicios registrados </span> </li>
                                                
                                        </ul>
                                </div>
                                <div class="col-lg-6 col-md-3 col-xs-6">
                                    <div class="row">
                                        <ul class="plan corner-flip flip-gray">
                                                <li class="plan-name " > Pacientes atendidos </li>
                                                <li class="plan-price col-md-6">{{$Turno_mañana}} <span>Turno mañana</span> </li>
                                                <li class="plan-price">{{$Turno_tarde}} <span>Turno tarde </span> </li>
                                                
                                        </ul>
                                    </div>

                                </div>
                                
                                <div class="clearfix"></div>
        
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

