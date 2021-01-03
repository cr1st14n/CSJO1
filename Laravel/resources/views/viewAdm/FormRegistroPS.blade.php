@extends('layouts.admLay1')
@section('refUbi')
<ol class="breadcrumb">
    <li><a href="#">Administracion</a></li>
    <li><a href="#">Usuarios</a></li>
    <li class="active">Registrar usuarios</li>
</ol>

@endsection
@section('content')


<div class="col-lg-5">

@if($form == 'create')
@include('formularios.FormRegisterPS')
@endif
@if($form == 'edit')
@include('formularios.FormEditPS')
@endif


</div>

<!-- seguada columna -->
<div class="col-lg-7">
<section class="panel">
            <header class="panel-heading sm" data-color="theme-inverse">
            <h2><strong>Personal</strong>de salud registrado.</h2>
    </header>
           
            <div class="panel-body">
                <div class="table-responsive">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped">
                        <thead>
                                <tr>
                                                <th>CI</th>
                                                <th>Nombre</th>
                                                <th>T.P.S.</th>
                                                <th>Area</th>

                                                <th width="20%">Action</th>
                                                
                                </tr>
                        </thead>
                        <tbody align="center">
                           @foreach($datos as $dato)
                           <tr>
                               <td>{{$dato-> ps_ci}}</td>
                               <td>{{$dato-> ps_nombre }} {{$dato->ps_appaterno }} {{$dato->ps_apmaterno }} </td>
                               <td>{{$dato-> ps_tipo}}</td>
                               <td>{{$dato-> nombre}}</td>

                               <td>
                                    <span class="">
                                    <a href="{{route('showPS',$dato->ps_id)}} " class="btn btn-default btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a href="{{route('destroyPS',$dato->ps_ci)}} " class="btn btn-default btn-sm" title="delete"><i class="fa fa-trash-o"></i></a>
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
<!-- //content > row > col-lg-12 -->
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
<script type="text/javascript">
$(document).ready(function(){
    //$('#ps_tipo > option[value=""]').attr('selected', 'selected');
    
     //$('input:radio[name="usu_sexo"][value="{{ old('usu_sexo') }}"]').prop('checked', true);
     //$("form input:[name=usu_sexo]").filter('[value={{ old('usu_sexo') }}]').attr('checked', true);
      
   
});
</script>



@endsection
