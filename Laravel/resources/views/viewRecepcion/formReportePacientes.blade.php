@extends('layouts.RecepLay')
@section('refUbi')
<ol class="breadcrumb">
	<li><a href="#">Administracion</a></li>
	<li class="active">Estado del dia</li>
</ol>

@endsection
@section('content')
<div class="col-lg-6">
    <section class="panel">
            <header class="panel-heading sm" data-color="#F0C449">
                    <h2><strong>Reporte de Afiliacion </strong>Diario - Pacientes</h2>
            </header>
            <div class="panel-tools  color " align="right" data-toolscolor="#F4AD41">
                    <ul class="tooltip-area">
                            <li><a href="javascript:void(0)" class="btn btn-inverse btn-collapse" title="Collapse"><i class="fa fa-sort-amount-asc"></i></a></li>
                            <li><a href="javascript:void(0)" class="btn btn-inverse btn-close" title="Close"><i class="fa fa-times"></i></a></li>
                    </ul>
            </div>
            <form class="form-horizontal" data-collabel="5" method="any" action="{{route('reporte_diario_p')}} ">
                <div class="panel-body">
                        <div class="form-group">
                                <label class="control-label">Tipo de reporte</label>
                                <div>
                                    <div class="row">
                                            <div class="col-sm-10">
                                                    <select id="tipo_reporte" name="tipo_reporte"  class="selectpicker form-control show-menu-arrow" data-style="btn-theme-inverse">
                                                            <option value="R">Afiliacion de pacientes</option>
                                                            <option value="C">Hoja de Corte afiliacion </option>
                                                            <option value="I_D_M">Informe diario Turno: Mañana</option>
                                                            <option value="I_D_T">Informe diario Turno: Tarde</option>
                                                    </select>
                                            </div>
                                            
                                    </div><!-- //row-->
                                </div>
                        </div><!-- //form-group-->
                        
                        <div class="form-group">
                                <label class="control-label">Fecha </label>
                                <div>
                                        <div class="row">
                                                <div class="col-sm-9">
                                                        <input id="p_fecha" name="p_fecha" type="date" class="form-control" value="{{ $fecha_actual }} " rounded required="">
                                                        
                                                </div>
                                        </div>
                                </div>
                        </div><!-- //form-group-->
                </div>
                <footer class="panel-footer  align-lg-right">
                        <button type="submit" class="btn" data-color="#F4AD41" formtarget="_blank" > Crear reporte</button>
                </footer>
            </form>
    </section>
<!-- //panel color-heading -->
</div>
<div class="col-lg-6">
    
                                        <!-- //panel color-heading -->
</div>

</div>

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

