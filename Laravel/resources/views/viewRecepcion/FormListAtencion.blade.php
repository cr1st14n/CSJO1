@extends('layouts.RecepLay')
@section('refUbi')
<ol class="breadcrumb">
    <li><a href="#">Recepcion</a></li>
    <li class="active">Buscar paciente</li>
</ol>

@endsection
@section('content')
<div class="col-lg-12">
<section class="panel">
    <div class="panel-body">  
    <form class="navbar-form navbar-left"  method="POST" action="{{route('show')}}">
            {{ csrf_field() }}
            <label>Listar por :</label>
            <div class="form-group" >
            <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
                    
                <div>
                        <input id="fecha"  name="fecha" value="{{ $time }}"  type="date" class="form-control rounded"   data-always-show="false" required="date" >
                    @if ($errors->has('fecha'))
                        <span class="help-block">
                            <strong>Error de sintaxis(dd-mm-YYYY) o exede a fecha actual</strong>
                        </span>
                    @endif

                </div>
            </div>
            </div>

            <select id="turno"  name="turno"  class=" form-control show-menu-arrow" data-style="btn-theme-inverse">                           
                            <option value="J">Jornada</option>
                            <option value="M">Mañana</option>
                            <option value="T" >Tarde</option>
            </select>
            <select id="tipo"  name="tipo"  class=" form-control show-menu-arrow" data-style="btn-theme-inverse">                           
                            <option value="P" >Pacientes</option>
                            <option value="E">Especialidades</option>
                            <option value="T" >Total por turno</option>
            </select>
            <button type="submit" class="btn btn-theme-inverse">Listar</button>
            <br>
    </form>  
            <div class="table-responsive">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped" id="">
                          @if($tipo == "P")
                          <thead>
                                    <tr>
                                            <th class="text-center"> # HCL</th>
                                            <th class="text-center">TURNO</th>
                                            <th class="text-center">MEDICO</th>
                                            <th class="text-center">ESPECIALIDAD</th>
                                            <th class="text-center"># TICKED</th>
                                            <th class="text-center">HORA </th>
                                            <th class="text-center">PAGO EN CAJA</th>
                                            <th class="text-center">ACCION</th>
                                    </tr>
                            </thead>
                            <tbody align="center">
                                    
                                    @foreach ($atencion as $atencion)
                                    <tr>
                                        <td ><span class="label label-success">{{ $atencion->pa_hcl }}</span></td>
                                        <td>{{ $atencion->ate_turno}} </td>
                                        <td >{{ $atencion->ps_appaterno }} {{ $atencion->ps_apmaterno }} {{ $atencion->ps_nombre }}</td>
                                        <td >{{ $atencion->nombre }}</td>
                                        <td>{{ $atencion->ate_num_ticked}} </td>
                                        <td>{{ $atencion->time_at }} </td>

                                        @if($atencion->ate_pago == "pendiente" )
                                        <td>{{ $atencion->ate_pago}} </td>
                                        @else
                                        <td><span class="label label-sm label-info">{{ $atencion->ate_pago}} </td>
                                        @endif                                   
                                   
                                        <td>
                                            <span class="tooltip-area">
                                            <a href="{{route('recep_pago',$atencion->ate_id)}} " class="btn btn-default btn-sm" title="ON/OFF"><i class="fa  fa-thumb-tack"></i></a>
                                            <a href="{{route('edit_atencion',$atencion->ate_id )}} " class="btn btn-default btn-sm" title="Editar"><i class="fa fa-pencil"></i></a>
                                            <a href="{{route('delete_atencion',$atencion->ate_id    )}} " class="btn btn-default btn-sm" title="Eliminar"><i class="fa fa-trash-o"></i></a>
                                            </span>
                                        </td>

                                   
                                   

                                    </tr>
                                    @endforeach
                                    
                            </tbody>
                        @endif
                          @if($tipo == 'E')
                          <thead>
                                    <tr>
                                            
                                            <th class="text-center" width="50%">NOMBRE  DE LA ESPECIALIDAD</th>
                                            <th class="text-center">CANTIDAD DE PACIENTES QUE SOLICITARON ATENCION MEDICA</th>
                                            

                                            
                                    </tr>
                            </thead>
                            <tbody align="center">
                                    
                                    @foreach ($atencion as $atencion)
                                    <tr> 
                                        <td>{{ $atencion->nombre }}{{$atencion->ate_turno}} </td>
                                        <td>{{ $atencion->agrupado }}</td>
                                         
                                    

                                    </tr>
                                    @endforeach
                                    
                            </tbody>
                          @endif
                          @if($tipo == 'T')
                          <thead>
                                    <tr>
                                            
                                            <th class="text-center" width="50%">TURNO</th>
                                            <th class="text-center">CANTIDAD DE PACIENTES QUE SOLICITARON ATENCION MEDICA</th>
                                            

                                            
                                    </tr>
                            </thead>
                            <tbody align="center">
                                    
                                    @foreach ($atencion as $atencion)
                                    <tr> 
                                        <td>{{ $atencion->nombre }}{{$atencion->ate_turno}} </td>
                                        <td>{{ $atencion->agrupado }}</td>
                                         
                                    

                                    </tr>
                                    @endforeach
                                    
                            </tbody>
                          @endif

                    </table>
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
    $('#turno > option[value={{$turno}}]').attr('selected', 'selected');
    $('#tipo > option[value={{$tipo }}]').attr('selected', 'selected'); 


     //$('input:radio[name="usu_sexo"][value="{{ old('usu_sexo') }}"]').prop('checked', true);
     //$("form input:[name=usu_sexo]").filter('[value={{ old('usu_sexo') }}]').attr('checked', true);
      
   
});
</script>
<script type="text/javascript">
    if ({{$actualizar=='1'}} ) {
    //var int=self.setInterval("refresh()",6000);
    function refresh()
    {
        location.reload(true);
    }
    }
</script>
@endsection

