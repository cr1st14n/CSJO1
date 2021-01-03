@extends('layouts.CajaLay')
@section('refUbi')
<ol class="breadcrumb">
    <li><a href="#">Caja</a></li>
    <li class="active">Pagos</li>
</ol>

@endsection
@section('content')

<div class="col-lg-12">
	<section class="panel">
		<header class="panel-heading">
					<h2>Historial de pagos </h2>
		</header>
		<div class="panel-body">
				
        <form class="navbar-form navbar-left"  method="POST" action=" {{route('filter_pagos')}} ">
            {{ csrf_field() }}
            <label>Listar por :</label>
            <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
                    
                <div>
                        <input id="pago_fecha"  name="pago_fecha" value="{{ $fecha }}"  type="date" class="form-control rounded"   data-always-show="false" required="date" >
                    @if ($errors->has('fecha'))
                        <span class="help-block">
                            <strong>Error de sintaxis(dd-mm-YYYY) o exede a fecha actual</strong>
                        </span>
                    @endif

                </div>
            </div>
            <select id="ate_pago"  name="ate_pago"  class=" form-control show-menu-arrow" data-style="btn-theme-inverse">                           
                            <option value="cancelado">Pagado</option>
                            <option value="pendiente">Pendiente</option>
            </select>
            <select id="turno"  name="turno"  class=" form-control show-menu-arrow" data-style="btn-theme-inverse">                           
                            <option value="J">Jornada</option>
                            <option value="Mañana">Mañana</option>
                            <option value="Tarde" >Tarde</option>
            </select>
            <select id="tipo"  name="tipo"  class=" form-control show-menu-arrow" data-style="btn-theme-inverse">                           
                            <option value="P" >Pacientes</option>
                            <option value="E" >Especialidades</option>
                            <option value="M" >Medico</option>
                            <option value="T" >Total</option>>>
            </select>
            <button type="submit" class="btn btn-theme-inverse">Listar</button>
            <br>
        </form>    
       			
			<div class="table-responsive">
                <?php if ($tabla =='0'): ?>
                <?php endif ?>
                <?php if ($tabla =='1'): ?>
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>HCL</th>
                                <th>CI</th>
                                <th>NOMBRE</th>
                                <th>MEDICO</th>
                                <th>ESPECIALIDAD</th>
                                <th>PROCEDIMIENTO</th>
                                <th>TURNO</th>
                                <th>ESTADO DE PAGO</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            @foreach ($pago as $pago)
                            <tr>
                                <th>{{ $pago->pa_hcl }} </th>
                                <th>{{ $pago->pa_ci}} </th>
                                <th>{{ $pago->pa_nombre }} {{ $pago->pa_appaterno }} {{ $pago->pa_apmaterno }} </td>
                                <th>{{ $pago->ate_med}} </th>
                                <TH>{{ $pago->nombre}} </TH>
                                <th>{{ $pago->ate_procedimiento }}</th>
                                <th>{{ $pago->ate_turno }}</th>
                                @if( $pago->ate_pago == 'pendiente')
                                <th><span class="label label-warning">{{ $pago->ate_pago }}</th>
                                @else
                                <th><span class="label label-success">{{ $pago->ate_pago }}</th>
                                @endif
                                
                            </tr>
                            @endforeach
                        </tbody>
                </table>
                <?php endif ?>
                <?php if ($tabla =='2'): ?>
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ESPECIALIDAD</th>
                                <?php if ($ate_pago == 'cancelado'): ?>
                                <th># DE PACIENTES QUE PAGARON</th>
                                <?php else: ?>
                                <th># DE PACIENTES QUE NO PAGARON</th>
                                <?php endif ?>
                            </tr>
                        </thead>
                        <tbody align="center">
                            @foreach ($pago as $pago)
                            <tr>
                                <th>{{ $pago->nombre }} </th>
                                <th>{{ $pago->count}} </th>
                                
                            </tr>
                            @endforeach
                        </tbody>
                </table>
                <?php endif ?>
                <?php if ($tabla =='3'): ?>
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>MEDICO</th>
                                <th>CANTIDAD DE PACIENTES ATENDIDOS </th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            @foreach ($pago as $pago)
                            <tr>
                                <th>{{ $pago->ate_med }} </th>
                                <th>{{ $pago->count}} </th>
                                
                            </tr>
                            @endforeach
                        </tbody>
                </table>
                <?php endif ?>
                <?php if ($tabla =='4'): ?>
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>DESCRPCION</th>
                                <th>CANTIDAD</th>
                                
                            </tr>
                        </thead>
                        <tbody align="center">
                            @if($ate_pago == 'pendiente')
                            <tr>
                                <th>CANTIDAD DE PACIENTES QUE NO PAGARON TURNO MAÑANA</th>
                                <th>{{$pago_mañana}} </th>
                            </tr>
                            <tr>
                                <th>CANTIDAD DE PACIENTES QUE NO PAGARON TURNO TARDE</th>
                                <th>{{$pago_tarde}} </th>
                            </tr>
                            <tr>
                                <th>CANTIDAD DE PACIENTES QUE NO PAGARON EN LA JORNADA</th>
                                <th>{{$pago_jornada}} </th>
                            </tr>
                            @else
                            
                            <tr>
                                <th>CANTIDAD DE PACIENTES QUE PAGARON TURNO MAÑANA</th>
                                <th>{{$pago_mañana}} </th>
                            </tr>
                            <tr>
                                <th>CANTIDAD DE PACIENTES QUE PAGARON TURNO TARDE</th>
                                <th>{{$pago_tarde}} </th>
                            </tr>
                            <tr>
                                <th>CANTIDAD DE PACIENTES QUE PAGARON EN LA JORNADA</th>
                                <th>{{$pago_jornada}} </th>
                            </tr>
                            @endif
                        </tbody>
                </table>
                <?php endif ?>
			</div>
		</div>
	</section>
</div>




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
    $('#turno > option[value={{$turno}} ]').attr('selected', 'selected');
    $('#tipo > option[value= {{$tipo}} ]').attr('selected', 'selected'); 
    $('#ate_pago > option[value= {{$ate_pago}} ]').attr('selected', 'selected'); 


     //$('input:radio[name="usu_sexo"][value="{{ old('usu_sexo') }}"]').prop('checked', true);
     //$("form input:[name=usu_sexo]").filter('[value={{ old('usu_sexo') }}]').attr('checked', true);
      
   
});
</script>


@endsection





