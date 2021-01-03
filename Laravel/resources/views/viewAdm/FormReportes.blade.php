@extends('layouts.admLay1')
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
                    <h2><strong>Reporte </strong>Diario </h2>
            </header>
            <div class="panel-tools  color " align="right" data-toolscolor="#F4AD41">
                    <ul class="tooltip-area">
                            <li><a href="javascript:void(0)" class="btn btn-inverse btn-collapse" title="Collapse"><i class="fa fa-sort-amount-asc"></i></a></li>
                            <li><a href="javascript:void(0)" class="btn btn-inverse btn-close" title="Close"><i class="fa fa-times"></i></a></li>
                    </ul>
            </div>
            <form class="form-horizontal" data-collabel="5" method="any" action="{{route('reporteDiario_adm')}} ">
                <div class="panel-body">
                        <div class="form-group">
                                <label class="control-label">Area del reporte</label>
                                <div>
                                    <div class="row">
                                            <div class="col-sm-8">
                                                    <select id="tipo" name="tipo"  class="selectpicker form-control show-menu-arrow" data-style="btn-theme-inverse">
                                                            <option value="P">Pacientes</option>
                                                            <option value="E">Especialidad</ion>
                                                            <option value="M">Medico</option>
                                                            <option value="T">Total</option>
                                                    </select>
                                            </div>
                                            
                                    </div><!-- //row-->
                                </div>
                        </div><!-- //form-group-->
                        <div class="form-group">
                                <label class="control-label">Turno del dia</label>
                                <div>
                                        
                                        <div class="row">
                                                <div class="col-sm-8">
                                                        <select id="turno" name="turno" class="selectpicker form-control show-menu-arrow" data-style="btn-theme-inverse">
                                                                <option value="Jornada">Jornada</option>
                                                                <option value="mañana">Mañana</option>
                                                                <option value="tarde">Tarde</option>
                                                                
                                                        </select>
                                                </div>
                                                
                                        </div><!-- //row-->
                                </div>
                        </div><!-- //form-group-->
                        <div class="form-group">
                               <label class="control-label">Tipo de Pago</label>

                                <div>
                                        
                                        <div class="row">
                                                <div class="col-sm-8">
                                                        <select id="pago" name="pago"  class="selectpicker form-control show-menu-arrow" data-style="btn-theme-inverse">
                                                                <option value="cancelado">Cancelado</option>
                                                                <option value="pendiente">Pendiente</option>
                                                                
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
                                                        <input id="p_fecha" name="p_fecha" type="date" class="form-control" value="{{ $fecha_actual }} " rounded>
                                                        
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
    <section class="panel">
            <header class="panel-heading sm" data-color="#F0C449">
                    <h2><strong>Reporte </strong>Mensual </h2>
            </header>
            <div class="panel-tools  color " align="right" data-toolscolor="#F4AD41">
                    <ul class="tooltip-area">
                            <li><a href="javascript:void(0)" class="btn btn-inverse btn-collapse" title="Collapse"><i class="fa fa-sort-amount-asc"></i></a></li>
                            <li><a href="javascript:void(0)" class="btn btn-inverse btn-close" title="Close"><i class="fa fa-times"></i></a></li>
                    </ul>
            </div>
            <form class="form-horizontal" data-collabel="5" method="any" action="{{route('reporteMensual_adm')}} ">
                <div class="panel-body">
                        <div class="form-group">
                                <label class="control-label">Area del reporte</label>
                                <div>
                                    <div class="row">
                                            <div class="col-sm-8">
                                                    <select id="tipo" name="tipo"  class="selectpicker form-control show-menu-arrow" data-style="btn-theme-inverse">
                                                            <option value="P">Pacientes</option>
                                                            <option value="E">Especialidad</ion>
                                                            <option value="M">Medico</option>
                                                            <option value="T">Total</option>
                                                    </select>
                                            </div>
                                            
                                    </div><!-- //row-->
                                </div>
                        </div><!-- //form-group-->
                        <div class="form-group">
                                <label class="control-label">Turno del dia</label>
                                <div>
                                        
                                        <div class="row">
                                                <div class="col-sm-8">
                                                        <select id="turno" name="turno" class="selectpicker form-control show-menu-arrow" data-style="btn-theme-inverse">
                                                                <option value="Jornada">Jornada</option>
                                                                <option value="mañana">Mañana</option>
                                                                <option value="tarde">Tarde</option>
                                                                
                                                        </select>
                                                </div>
                                                
                                        </div><!-- //row-->
                                </div>
                        </div><!-- //form-group-->
                        <div class="form-group">
                               <label class="control-label">Tipo de Pago</label>

                                <div>
                                        
                                        <div class="row">
                                                <div class="col-sm-8">
                                                        <select id="pago" name="pago"  class="selectpicker form-control show-menu-arrow" data-style="btn-theme-inverse">
                                                                <option value="cancelado">Cancelado</option>
                                                                <option value="pendiente">Pendiente</option>
                                                                
                                                        </select>
                                                </div>
                                                
                                        </div><!-- //row-->
                                </div>
                        </div><!-- //form-group-->
                        <div class="form-group{{ $errors->has('p_fecha_I') ? ' has-error' : '' }}">
                                <label class="control-label">Fecha Inicial </label>
                                <div>
                                        <div class="row">
                                                <div class="col-sm-9">
                                                        <input id="p_fecha_I" name="p_fecha_I" type="date" class="form-control" value="{{ $fecha_actual }} " rounded required="Ingrese fecha Inicial">
                                                        @if ($errors->has('p_fecha_I'))
                                                            <span class="help-block">
                                                                <strong>Error en la fecha inicial</strong>
                                                            </span>
                                                        @endif
                                                </div>
                                        </div>
                                </div>
                        </div><!-- //form-group-->
                        <div class="form-group{{ $errors->has('p_fecha_F') ? ' has-error' : '' }}">
                                <label class="control-label">Fecha Final </label>
                                <div>
                                        <div class="row">
                                                <div class="col-sm-9">
                                                        <input id="p_fecha_F" name="p_fecha_F" type="date" class="form-control" value="{{ $fecha_actual }} " rounded required="Ingrese fecha final">
                                                        @if ($errors->has('p_fecha_F'))
                                                            <span class="help-block">
                                                                <strong>Error en la fecha final</strong>
                                                            </span>
                                                        @endif
                                                </div>
                                        </div>
                                </div>
                        </div><!-- //form-group-->
                </div>
            <footer class="panel-footer  align-lg-right">
                    <button type="submit" class="btn" data-color="#F4AD41" formtarget="_blank">Crear reporte</button>
            </footer>
            </form>
    </section>
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

