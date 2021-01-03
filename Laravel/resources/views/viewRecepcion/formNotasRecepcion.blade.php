@extends('layouts.RecepLay')
@section('refUbi')
<ol class="breadcrumb">
	<li><a href="#">Administracion</a></li>
	<li class="active">Estado del dia</li>
</ol>
@endsection
@section('content')
<div class="col-lg-7">
    <section class="panel">
            <header class="panel-heading sm" data-color="#F0C449">
                    <h2><strong>Prestamos pendientes </strong>Historias clinicas</h2>
            </header>
           <div class="panel-body">
               <button type="button" class="btn btn-success btn-transparent" onclick="showModalFiltrarPresatamos()"><i class="fa fa-search"></i></button>
               <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>HCL</th>
                            <th>Paciente</th>
                            <th>Entregado a </th>
                            <th>Fecha / Hora</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody align="center" id="tablaPrestamos">
                        <tr hidden>
                            <td>1</td>
                            <td valign="middle">140</td>
                            <td>pedro jonas</td>
                            <td>dr carlos alca pone jejej</td>
                            <td><span class="label label-success">Devuelto</span></td>
                            <td>
                                <span class="tooltip-area">
                                <a href="" class="btn btn-default btn-sm" title="Estado"><i class="fa fa-pencil"></i></a>
                                <a href=""  class="btn btn-default btn-sm" title="Eliminar"><i class="fa fa-trash-o"></i></a>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </section>
    <!-- //panel color-heading -->
</div>
<div class="col-lg-5">
    <section class="panel">
            <header class="panel-heading sm" data-color="#F0C449">
                    <h2><strong>Registro </strong>Notas diarias - recepcion</h2>
            </header>
            <div class="panel-tools  color " align="right" data-toolscolor="#F4AD41">
                    <ul class="tooltip-area">
                            <li><a href="javascript:void(0)" class="btn btn-inverse btn-collapse" title="Collapse"><i class="fa fa-sort-amount-asc"></i></a></li>
                            <li><a href="javascript:void(0)" class="btn btn-inverse btn-close" title="Close"><i class="fa fa-times"></i></a></li>
                    </ul>
            </div>
           <div class="panel-body">
            <div class="form-group">
                    <meta name="csrf-token" content="{!! Session::token() !!}">
                    <label>Nota</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="nota" id="notaText" autocomplete="off">
                        <div class="input-group-btn">
                            <button type="button" id="btnNota" class="btn btn-success btn-transparent " >Guardar</button>
                            <button type="button" id="btnNotaFiltrar" class="btn btn-primary btn-transparent " ><i class="fa fa-search"></i></button>
                        </div>
                    </div>
            </div>
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Descripcion</th>
                            <th>fecha</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody align="center" id="tableNotas">
                        <tr hidden>
                            <td>1</td>
                            <td valign="middle">Sander</td>
                            <td>dd-mm-yyyy</td>
                            <td>
                                <span class="tooltip-area">
                                <a href="javascript:void(0)" class="btn btn-default btn-sm" title="Editar"><i class="fa fa-pencil"></i></a>
                                <a href="javascript:void(0)"  class="btn btn-default btn-sm" title="Eliminar"><i class="fa fa-trash-o"></i></a>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </section>
    <!-- //panel color-heading -->
</div>
</div>
<!--
        //////////////////////////////////////////////////////////////
        //////////     MODAL NORMAL    //////////
        //////////////////////////////////////////////////////////
        -->

        <div id="md-filtrarNotas" class="modal fade" tabindex="-1" data-width="250">
            <div class="modal-header bg-inverse bd-inverse-darken">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <h3>Seleccionar fecha</h3>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <input type="date" class="form-control" id="nota_fecha_filtro">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-inverse">Cerrar</button>
                <button type="button" onclick="filtrarNotas()" class="btn btn-theme-inverse" data-toggle="modal" data-target="#md-stack2">Filtrar</button>
            </div>
        </div>
        <div id="md-filtrarPrest" class="modal fade" tabindex="-1" data-width="450">
            <div class="modal-header bg-inverse bd-inverse-darken">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <h3>Filtrar Prestamos</h3>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <select  class="selectpicker form-control" data-size="5" id="area_pres">
                                <option value="">Seleccionar area</option>
                                <option data-divider="true"></option>
                                <option value="Direccion">Direccion </option>
                                <option value="Administracion">Administracion</option>
                                <option value="Contabilidad">Contabilidad</option>
                                <option value="Consultorios">Consultorios</option>
                                <option value="Internaciones">Internaciones</option>
                                <option value="Quirofano">Quirofano</option>
                                <option value="Farmacia">Farmacia</option>
                            </select>
                            <input type="text" class="form-control" placeholder="Personal " id="personal_pres">
                        </div>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" placeholder="Personal " id="fecha_pres">
                            <br>
                            <div>
                                <ul class="iCheck radio-inline"  data-color="green">
                                    <li class="radio-inline">
                                        <input type="radio" name="name-radio" id="pres_estadoP" value="1" checked="checked" class="radio-inline">
                                        <label>P.</label>
                                    </li>
                                    <li class="radio-inline">
                                        <input  type="radio" name="name-radio"  id="pres_estadoE" value="0" class="radio-inline">
                                        <label >E.</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-inverse">Cerrar</button>

                <button type="button" onclick="filtrarPrestamos()" class="btn btn-theme-inverse" data-toggle="modal" data-target="#md-stack2">Filtrar</button>
            </div>
        </div>
        <!-- //modal-->
        <div id="md-editPres" class="modal fade" tabindex="-1" data-width="450">
                <div class="modal-header bg-inverse bd-inverse-darken">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                        <h4 class="modal-title">Actualizar Prestamo</h4>
                </div>
                <!-- //modal-header-->
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <select  class=" form-control" data-size="5" id="area_pres_update">
                                <option value="Direccion">Direccion </option>
                                <option value="Administracion">Administracion</option>
                                <option value="Contabilidad">Contabilidad</option>
                                <option value="Consultorios">Consultorios</option>
                                <option value="Internaciones">Internaciones</option>
                                <option value="Quirofano">Quirofano</option>
                                <option value="Farmacia">Farmacia</option>
                            </select>
                            <input type="text" class="form-control" placeholder="Personal " id="personal_pres_update">
                            <lavel hidden id="idPresCerrar" ></lavel>
                        </div>
                        <div class="col-sm-6">
                            <button type="button" onclick="cerrarPrestamo()" class="btn btn-theme-inverse btn-block">Concluir Prestamo</button>
                            <button type="button" onclick="updatePrestamo()" class="btn btn-theme btn-block" >Actualizar</button>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- //modal-->
        <div id="md-editNota" class="modal fade" tabindex="-1" data-width="450">
            <div class="modal-header bg-inverse bd-inverse-darken">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <h4 class="modal-title">Actualizar nota</h4>
            </div>
            <!-- //modal-header-->
            <div class="modal-body">
                {{--<p>One fine body</p>--}}
                <div class="input-group">
                    <input type="text" class="form-control"  id="notaTextEdit" autocomplete="off">
                    <input type="text" id="nota_id" hidden>
                    <div class="input-group-btn">
                        <button type="button" id="btnNotaActualizar"  class="btn btn-success btn-transparent " >Actualizar</button>
                    </div>
                </div>
            </div>
            <!-- //modal-body-->
        </div>
        <!-- //modal-->


@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('/asincrono/notasPrestamos.js') }}"></script>

    <script type="text/javascript">
$(function() {
    $(".md-effect").click(function(event){
            event.preventDefault();
            var data=$(this).data();
            $("#md-effect").attr('class','modal fade').addClass(data.effect).modal('show')
    });
    
    $.ajaxSetup ({
        // Disable caching of AJAX responses
        cache: false
    });
    var $modal = $('#md-ajax');
    $('.md-ajax-load').on('click', function(){
          $('body').modalmanager('loading');
          setTimeout(function(){
             $modal.find(".modal-body").load('data/md-ajax-load.html', '', function(){
              $modal.modal();
            });
          }, 2000);
    });
    });
</script>
@endsection

