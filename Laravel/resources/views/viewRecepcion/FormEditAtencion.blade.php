@extends('layouts.RecepLay')
@section('refUbi')
<ol class="breadcrumb">
	<li><a href="#">Recepcion</a></li>
	<li class="active">Registrar Atencion</li>
</ol>

@endsection
@section('content')

<div class="col-lg-6">
<form  class="" method="POST" action="{{ route('print_HCl') }}">
  {{ csrf_field() }}
<section class="panel corner-flip" style="text-transform: capitalize; ">
    <header class="panel-heading sm" data-color="theme-inverse">
            <h2><strong></strong> Datos del Paciente</h2>
            
    </header>
    <div class="panel-tools color" align="right" data-toolscolor="#4EA582">        
    </div>
    <div class="panel-body">                       
        <div   class="form-horizontal" data-collabel="12" data-alignlabel="center">          
            <input type="text" name="pa_id" id="pa_id" value="{{$dato->pa_id}}" hidden="">
            @if ($errors->has('pa_hcl'))
                <span class="help-block">
                    <strong>! No se puede registrar una atencion sin codigo de historia del paciente ¡</strong>
                </span>
            @endif
            <div class="form-group{{ $errors->has('pa_hcl') ? ' has-error' : '' }}">

                <label for="nombre" class="col-md-4 control-label"># Historia Clinica:</label>
                
                <h3>{{$dato->pa_hcl}} </h3>
              
            </div>
            <div class="form-group{{ $errors->has('pa_hcl') ? ' has-error' : '' }}">
                <label for="nombre" class="col-md-4 control-label">Carnet de Identidad:</label><span></span>
                <h3>{{$dato->pa_ci}}</h3>
               
            </div>

            <div class="form-group{{ $errors->has('pa_hcl') ? ' has-error' : '' }}">
                <label for="nombre" class="col-md-4 control-label">Nombre:</label>
                <h3>{{$dato->pa_nombre}}</h3>
                
            </div>
            <div class="form-group{{ $errors->has('pa_hcl') ? ' has-error' : '' }}">
                <label for="nombre" class="col-md-4 control-label">Apellidos:</label>
                <h3>{{$dato->pa_appaterno}} {{$dato->pa_apmaterno}} </h3>
                
            </div>
            <div class="form-group{{ $errors->has('pa_hcl') ? ' has-error' : '' }}">
                <label for="nombre" class="col-md-4 control-label">Sexo:</label>
                <h3>{{$dato->pa_sexo}}</h3>
              
            </div>
            <div class="form-group{{ $errors->has('pa_hcl') ? ' has-error' : '' }}">
                <label for="nombre" class="col-md-4 control-label">Fecha de nacimiento:</label>
                <h3>{{$FecNac}} </h3>
              
            </div>
            <div class="form-group{{ $errors->has('pa_hcl') ? ' has-error' : '' }}">
                <label for="nombre" class="col-md-4 control-label">Edad:</label>
                <h3>{{$edad}} </h3>
              
            </div>
            <footer class="panel-footer">
                <button type="submit" class="btn" formtarget="_blank" >Generar Hoja "Historial Clinico" </button>
            </footer>   
              
        </div>

    </div>   
</section>
</form>
</div>

<!-- seguada columna -->
<div class="col-lg-6">
<form  class="" method="POST" action="{{ route('update_antencion') }}">
  {{ csrf_field() }}
<section class="panel corner-flip">
    <header class="panel-heading sm" data-color="theme-inverse">
            <h2><strong></strong>Editar Atencion con # HCL:{{$dato->pa_hcl}}</h2>
            <input type="text" name="ate_id" id="ate_id" value="{{$atencion->id}}" hidden="">
    </header>
    <div class="panel-tools color" align="right" data-toolscolor="#4EA582">        
    </div>
    <div class="panel-body">                       
        <div   class="form-horizontal" data-collabel="4" data-alignlabel="center">          
             <div class="row" style="text-transform: uppercase;" >
                <div class="col-lg-12" align="center">
                    <?php if ($ZD == 'descuento'): ?>
                         <label class="col-md-12 control-label"  >------Nota: Paciente con descuento-----------</label><br>
                    <?php endif ?>
                </div>
                 
             </div>
             <br>
             <div class="form-group{{ $errors->has('ate_especialidad') ? ' has-error' : '' }}">
                <label class="control-label">Especialidad: </label>
                <div class="row">
                    <div class="col-md-6">
                        <select id="ate_especialidad"  name="ate_especialidad"  class=" form-control show-menu-arrow" data-style="btn-theme-inverse">
                                <option selected="" value="{{$atencion->ate_especialidad }}">{{$nom_especialidad}} </option>
                            @foreach($especialidad as $especialidad)
                                <option value="{{$especialidad->id}} ">{{$especialidad->nombre}} </option>
                            @endforeach
                         
                        </select>
                        @if ($errors->has('ate_especialidad'))
                            <span class="help-block">
                                <strong> selccione un tipo de especialidad medica</strong>
                            </span>
                        @endif 
                                    
                    </div>
                </div>
            </div> 
               
             <div class="form-group{{ $errors->has('ate_procedimiento') ? ' has-error' : '' }}">
                <label class="control-label">Procedimiento</label>
                <div class="row">
                    <div class="col-md-6">
                        <select id="ate_procedimiento"  name="ate_procedimiento"  class=" form-control show-menu-arrow" data-style="btn-theme-inverse">
                                <option selected="true" disabled="disabled">Seleccionar</option>

                                <option value="Consulta">Consulta</option>
                                <option value="Control" >Control</option>
                                <option value="Emergencias" >Emergencias</option>
                                <option value="Curacion Mayor" >Curacion Mayor</option>
                                <option value="Curacion Menor" >Curaciones Menor</option>
                                <option value="Enfermeria" >Enfermeria</option>
                        </select>
                        @if ($errors->has('ate_procedimiento'))
                            <span class="help-block">
                                <strong> selccione un tipo de procedimiento medico</strong>
                            </span>
                        @endif 
                                    
                    </div>
                </div>
                
            </div> 
             <div class="form-group{{ $errors->has('ate_med') ? ' has-error' : '' }}">
                <label class="control-label">Medico Asignado</label>
                <div class="row">
                    <div class="col-md-6">
                        <select id="ate_med"  name="ate_med"  class="selectpicker form-control" data-size="10" data-live-search="true"  >
                                <option selected="true" disabled="disabled">Buscar medico</option>
                            @foreach($medico as $medico)
                                <option value="{{$medico->id}} ">{{$medico->ps_appaterno}} {{$medico->ps_apmaterno}}  {{$medico->ps_nombre}} </option>
                            @endforeach
                                
                        </select>
                        @if ($errors->has('ate_med'))
                            <span class="help-block">
                                <strong>Selccione un medico Asignado al tipo de procedimiento</strong>
                            </span>
                        @endif 
                                    
                    </div>
                </div>
                
            </div>
            <div class="form-group{{ $errors->has('ticked') ? ' has-error' : '' }}">
                <label for="ticked" class="col-md-4 control-label"> # de ticked</label>
                <div class="col-md-3">
                    <input class="form-control"  placeholder="# ticked" id="ticked" name="ticked" value="{{$atencion->ate_num_ticked }}" onkeypress="return soloNu(event)" onblur="limpia()" required="">{{ old('ate_descripcion') }}</input>
                    @if ($errors->has('ticked'))
                        <span class="help-block">
                            <strong>Ingrese el numero del ticket</strong>
                        </span>
                    @endif
                </div>
            </div> 
            <div class="form-group{{ $errors->has('ate_descripcion') ? ' has-error' : '' }}">
                <label for="ate_descripcion" class="col-md-4 control-label">Descripcion</label>
                
                <div class="col-md-9">
                    <input class="form-control" rows="3" data-height="auto" placeholder="" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 30px;" id="ate_descripcion" name="ate_descripcion" value="{{$atencion->ate_descripcion}} " onkeypress="return soloLeNu(event)" onblur="limpia()">{{ old('ate_descripcion') }}</input>
                    @if ($errors->has('ate_descripcion'))
                        <span class="help-block">
                            <strong>Descripcion maxima de 200 caracteres</strong>
                        </span>
                    @endif
                </div>
            </div>
             <div class="form-group{{ $errors->has('ate_turno') ? ' has-error' : '' }}">
                <label class="control-label">Turno T/M</label>
                <div class="row">
                    <div class="col-md-6">
                        <select id="ate_turno"  name="ate_turno"  class=" form-control show-menu-arrow" data-style="btn-theme-inverse">
                                <option selected="true" disabled="disabled"></option>

                                <option value="Mañana">Mañana</option>
                                <option value="Tarde" >Tarde</option>
                        </select>
                        @if ($errors->has('ate_turno'))
                            <span class="help-block">
                                <strong>selccione el turno del procedimiento</strong>
                            </span>
                        @endif 
                                    
                    </div>
                </div>
                
            </div> 
            <footer class="panel-footer">
                <button type="submit" class="btn btn-theme">Editar solicitud de atencion medica</button>
                <button  class="btn" ><a href="{{route('form_buscar_paciente')}} "> Cancelar</a></button>
            </footer>          
        </div>                   
    </div>   
</section>
</form>
</div>
<!-- //content > row > col-lg-12 -->


@endsection

@section('scripts')
<script type="text/javascript">

    function fnShowHide( iCol , table){
        var oTable = $(table).dataTable(); 
        var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
        oTable.fnSetColumnVis( iCol, bVis ? false : true );
    }

    $(function() {
        
        //////////     DATA TABLE  COLUMN TOGGLE    //////////
        $('[data-table="table-toggle-column"]').each(function(i) {
                var data=$(this).data(), 
                table=$(this).data("table-target"), 
                dropdown=$(this).parent().find(".dropdown-menu"),
                col=new Array;
                $(table).find("thead th").each(function(i) {
                        $("<li><a  class='toggle-column' href='javascript:void(0)' onclick=fnShowHide("+i+",'"+table+"') ><i class='fa fa-check'></i> "+$(this).text()+"</a></li>").appendTo(dropdown);
                });
        });

        //////////     COLUMN  TOGGLE     //////////
         $("a.toggle-column").on('click',function(){
                $(this).toggleClass( "toggle-column-hide" );                
                $(this).find('.fa').toggleClass( "fa-times" );              
        });

        // Call dataTable in this page only
        $('#table-example').dataTable();
        $('table[data-provide="data-table"]').dataTable();
    });
</script>
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
<script type="text/javascript">
$(document).ready(function(){
    // $('#ate_procedimiento > option[value="{{ old('ate_procedimiento') }}"]').attr('selected', 'selected');
     $('#ate_turno > option[value="{{$atencion->ate_turno}}"]').attr('selected', 'selected');
     $('#ate_med > option[value={{$atencion->ate_med}} ]').attr('selected', 'selected');


     //$('input:radio[name="usu_sexo"][value="{{ old('usu_sexo') }}"]').prop('checked', true);
     //$("form input:[name=usu_sexo]").filter('[value={{ old('usu_sexo') }}]').attr('checked', true);
      
   
});
</script>





@endsection

