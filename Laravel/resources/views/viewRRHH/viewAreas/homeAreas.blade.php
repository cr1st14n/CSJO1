@extends('layouts.admLay2')
@section('head1')
@endsection
@section('refUbi')
<ol class="breadcrumb">
    <li><a href="#">RRHH</a></li>
    <li class="active">Personal</li>
</ol>
@endsection
@section('content')
<section class="panel">
    <header class="panel-heading">
        <h2><strong>Areas</strong>registradas</h2>
    </header>
    <div class="panel-body">
        <div class="panel-tools fully color" align="left" data-toolscolor="#6CC3A0">
            <button class="btn btn-theme-inverse btn-transparent" onclick="formCreateArea()">Agregar </button>
            <button class="btn btn-theme-inverse btn-transparent" onclick="listAreas()">listar </button>
        </div>
        <div class="table-responsive">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Cod</th>
                        <th>Nombre del area</th>
                        <th>Encargado</th>
                        <th width="15%">Empleados asignados al area</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody align="center" id="tableListAreas">
                </tbody>
            </table>
        </div>
    </div>
</section>
<div id="md-InfArea" class="modal fade md-stickTop" tabindex="-1" data-width="800">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h3>Informacion del area</h3>
        <input type="number" id="id_inf_area" hidden>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-6">
                <!-- <h3>Informacion del area</h3><br> -->
                <p id="datosEmp"></p>
            </div>
            <div class="col-lg-6">
                <h3>Personal en el area</h3><br>
                <p id="datosInst"></p>
                <div>
                    <button class="btn btn-block btn-theme-inverse btn-sm" onclick="showModalAreaAgreUsu()">Agregar Personal</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="md_area_argregarPersonal" class="modal fade md-stickTop" tabindex="-1" data-width="600">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h3>Lista de personal </h3>
    </div>
    <div class="modal-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="text-align:left">Nombre</th>
                    <th style="text-align:left">Area asignada</th>
                    <th style="text-align:left"></th>
                </tr>
            </thead>
            <tbody id="area_list_pers_agregar">
            </tbody>
        </table>
    </div>
</div>
<div id="md_area_asignarUsuEncargado" class="modal fade md-stickTop" tabindex="-1" data-width="500">
    <div class="modal-header">
        <button type="button" id="btn-close_md_area_asignarUsuEncargado" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h3>Sleccionar encargado de area</h3>
        <input type="number" id="id_area_actualizarEncargado" hidden>
    </div>
    <div class="modal-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="text-align:left">Nombre</th>
                    <th style="text-align:left">Tipo contrato</th>
                    <th style="text-align:left"></th>
                </tr>
            </thead>
            <tbody id="list_asignarUsuEncargado">
            </tbody>
        </table>
    </div>
</div>
<div id="md_area_edit" class="modal fade md-stickTop" tabindex="-1" data-width="500">
    <div class="modal-header">
        <button type="button" id="btn-close_md_area_edit" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h3>Editar Area</h3>
        <input type="number" id="id_area_actualizarEncargado" hidden>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-12">
                <form id="form-editArea">
                    <input type="text" id="form-editArea-id" hidden>
                    <section class="panel ">
                        <div class="panel-tools color" align="right" data-toolscolor="#4EA582">
                        </div>
                        <div class="panel-body">
                            <div class="form-horizontal" data-collabel="4" data-alignlabel="center">
                                <div class="form-group">
                                    <label for="nombre" class="col-md-4 control-label">Nombre</label>
                                    <div class="col-md-6">
                                        <input id="area_nombre_up" type="text" class="form-control rounded" autocomplete="off" maxlength="50" data-always-show="true" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Descripcion </label>
                                    <div>
                                        <input id="area_descripcion_up" type="text" class="form-control rounded" maxlength="200" data-always-show="false" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Tipo de area</label>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <select id="area_tipo_up" class=" form-control show-menu-arrow" data-style="btn-theme-inverse" required>
                                                <option value="Administrativa">Administrativa</option>
                                                <option value="Salud">Salud</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <footer class="panel-footer">
                        <button type="submit" class="btn btn-theme-inverse">Actualizar</button>
                    </footer>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="md-createArea" class="modal fade md-stickTop " tabindex="-1" data-width="400">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times" id="btn_formCreate_close"></i></button>
        <h2><strong>Registrar </strong>Area</h2>

    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-12">
                <form id="form-createArea">
                    <section class="panel ">

                        <div class="panel-tools color" align="right" data-toolscolor="#4EA582">
                        </div>
                        <div class="panel-body">
                            <div class="form-horizontal" data-collabel="4" data-alignlabel="center">
                                <div class="form-group">
                                    <label for="nombre" class="col-md-4 control-label">Nombre</label>
                                    <div class="col-md-6">
                                        <input id="area_nombre" type="text" class="form-control rounded" autocomplete="off" maxlength="50" data-always-show="true" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Descripcion </label>
                                    <div>
                                        <input id="area_descripcion" type="text" class="form-control rounded" maxlength="200" data-always-show="false" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Personal Encargado</label>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <select id="area_usuEncargado" class=" form-control show-menu-arrow" data-style="btn-theme-inverse" required>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Area medica</label>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <select id="area_tipo" class=" form-control show-menu-arrow" data-style="btn-theme-inverse" required>
                                                <option selected="true" disabled="disabled"></option>

                                                <option value="Administrativa">Administrativa</option>
                                                <option value="Salud">Salud</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <footer class="panel-footer">
                        <button type="submit" class="btn btn-theme-inverse">Registrar</button>
                        <button type="reset" class="btn" onclick="clearForm(this.form);"> Limpiar Formulario</button>
                    </footer>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- delete area -->
<div id="md-area-delete" class="modal fade md-stickTop" tabindex="-1" data-width="350">
    <div class="modal-header bg-inverse bd-inverse-darken">
        <button type="button" class="close" data-dismiss="modal" id="btn_close_md_area_delete" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h4 class="modal-title">Confirmar Solicitud Eliminar Area?</h4>
    </div>
    <!-- //modal-header-->
    <div class="modal-body">
        <label id="message-delete"></label>
        <div class="panel-body align-xs-center " id="btn-area-delete">
        </div>
    </div>
    <!-- //modal-body-->
</div>

@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('/asincrono/recHumAreas.js') }}"></script>
@endsection