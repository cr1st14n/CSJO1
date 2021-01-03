@extends('layouts.CajaLay')
@section('refUbi')
<ol class="breadcrumb">
    <li><a href="#">Caja</a></li>
    <li class="active">Pacientes en fila</li>
</ol>
@endsection
@section('content')
<div class="col-lg-12">
	<section class="panel">
		<header class="panel-heading">
					<h2>Pacientes en fila </h2>
		</header>
		<div class="panel-body">
				<form class="navbar-form navbar-left"   >
            		<button type="submit" class="btn btn-theme-inverse"  ><a href="{{route('pacientes_cola')}} "></a>Actualizar</button>  
            		{{--<button type="button" class="btn btn-theme-inverse" onclick="actListPaciCola()" >Actualizar</button>--}}
       			</form>
			<div class="table-responsive">
				<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>HCL</th>
								<th>CI</th>
								<th>NOMBRE</th>
								<th>ESPECIALIDAD</th>
                                <th>MEDICO</th>
								<th>PROCEDIMIENTO</th>
                                <th># DE FICHA</th>
                                <th>HORA</th>
								<th>TURNO</th>
								<th>ESTADO DE PAGO</th>
								<th width="">PAGO</th>
							</tr>
						</thead>
						<tbody align="center">
         					@foreach ($PC as $PC)
         					<tr>
             					<th>{{ $PC->pa_hcl }} </th>
             					<th>{{ $PC->pa_ci}} </th>
             					<th>{{ $PC->pa_nombre }} {{ $PC->pa_appaterno }} {{ $PC->pa_apmaterno }} </td>
             					<TH>{{ $PC->nombre}} </TH>
                                <th>{{ $PC->ps_nombre}} {{ $PC->ps_appaterno}} {{ $PC->ps_apmaterno}}</th>
             					<th>{{ $PC->ate_procedimiento }}</th>
                                <TH>{{ $PC->ate_num_ticked }} </TH>
                                <TH>{{ $PC->time_at }} </TH>
             					<th>{{ $PC->ate_turno }}</th>
             					@if( $PC->ate_pago == 'pendiente')
             					<th><span class="label label-warning">{{ $PC->ate_pago }}</span> </th>
             					@else
             					<th><span class="label label-success">{{ $PC->ate_pago }}</span></th>
             					@endif
             					<td>
									<span class="tooltip-area">
									<a href="{{route('ate_pago',$PC->id)}} " class="btn btn-default btn-sm" title="ON/OFF"><i class="fa  fa-thumb-tack"></i></a>
									</span>
								</td>
							</tr>
							@endforeach
						</tbody>
				</table>
			</div>
		</div>
	</section>
</div>
@endsection
@section('scripts')
	{{--<script type="text/javascript" src="{{ asset('/asincrono/cajaPC.js') }}"></script>--}}
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
    $('#turno > option[value=]').attr('selected', 'selected');
    $('#tipo > option[value=]').attr('selected', 'selected'); 


     //$('input:radio[name="usu_sexo"][value="{{ old('usu_sexo') }}"]').prop('checked', true);
     //$("form input:[name=usu_sexo]").filter('[value={{ old('usu_sexo') }}]').attr('checked', true);
      
   
});
</script>
@endsection





