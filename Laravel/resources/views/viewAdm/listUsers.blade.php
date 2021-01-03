@extends('layouts.admLay1')
@section('refUbi')
<ol class="breadcrumb">
    <li><a href="#">Administracion</a></li>
    <li class="active">Lista de usuarios </li>
</ol>

@endsection
@section('content')
<div class="col-lg-12">
<section class="panel">
    <div class="panel-body">  
    
    <div class="panel-body">
        <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th >C.I.</th>
                        <th >NOMBRE</th>
                        <th >SEXO</th>
                        <th >AREA</th>
                        <th >CORREO</th>
                        <th >ACCESO AL SISTEMA</th>
                        <th >ACCION</th>
                    </tr>
                </thead>
                <tbody align="center">
                     @foreach ($datos as $dato)
                    <tr>
                        <td >{{ $dato->usu_ci }}</td>
                        <td >{{ $dato->usu_nombre }} {{ $dato->usu_appaterno }}{{ $dato->usu_apmaterno }}</td>
                        <td >{{ $dato->usu_sexo}} </td>
                        <td >{{ $dato->usu_area}}:: {{ $dato->usu_cargo }}</td>
                        <td >{{ $dato->email }}</td>
                        @if( $dato->usu_acceso == 1)
                        <td ><span class="label label-success">Permitido</span></td>
                        @else
                        <td ><span class="label label-danger">Denegado</span></td>
                        @endif
                        <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-theme-inverse">Action</button>
                            <button type="button" class="btn btn-theme-inverse dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button>
                                <ul class="dropdown-menu align-xs-left " role="menu">
                                    <li><a href="{{route('showuser',$dato->id)}} ">Editar</a></li>
                                    <li><a href="{{route('destroy_users',$dato->id)}} ">Eliminar</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{route('acceso_user',$dato->id)}} ">Acceso ON/OFF</a></li>
                                </ul>
                        </div>
                        </td>

                        
                    </tr>
                    @endforeach
                </tbody>
        </table>
        </div>
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
    


     //$('input:radio[name="usu_sexo"][value="{{ old('usu_sexo') }}"]').prop('checked', true);
     //$("form input:[name=usu_sexo]").filter('[value={{ old('usu_sexo') }}]').attr('checked', true);
      
   
});
</script>

@endsection

