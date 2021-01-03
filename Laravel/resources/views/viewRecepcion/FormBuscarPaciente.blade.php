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
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <label>Buscar :</label>
                    <input type="text" size="3" class="form-control" name='num' onkeypress="return soloNu(event)" onblur="limpia()" placeholder="CI/HCL" id="HCLpaciente" autocomplete="off" />

                    <input type="text" size="17" class="form-control" name='dato1' placeholder="NOMBRE APELLIDOS" onkeypress="return soloNuLe(event)" onblur="limpia()" id="NOMBRESpaciente" autocomplete="off" />
                </div>
            </form>
            <div class="row">
                <div class="table-responsive col-lg-12">
                    <table cellpadding="0" cellspacing="0" border="0" class=" table-bordered table-striped" id="tableBuscarPaciente" style="width: 100%">
                        <thead>
                            <tr>
                                <th width="15%" class="text-center"> # HISTORIAL</th>
                                <th width="15%" class="text-center">C.I.</th>
                                <th class="text-center">NOMBRE</th>
                                <th class="text-center">APELLIDO</th>
                                <th class="text-center"><i class="fa fa-bars"></i></th>
                                <th width="25%" class="text-center">ACCION</th>
                            </tr>
                        </thead>
                        <tbody align="center" id="resulBusqPacientes">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

</div>
<div id="md-HCLprestamo" class="modal fade" tabindex="-1" data-width="450">
    <div class="modal-header bg-inverse bd-inverse-darken">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h4 class="modal-title">Formulario: prestamo de HCL: <strong id="codHCL">...</strong> </h4>
    </div>
    <!-- //modal-header-->
    <div class="modal-body">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-12">
                    <label class="control-label col-md-6">Personal a entregar</label>
                    <div class="col-md-6">
                        <label id="presIDHCL" hidden></label>
                        <input id="usuEntrega" class="form-control" type="text" name="userInteresado" autocomplete="off">
                    </div>
                </div>
                <div class="col-sm-12">
                    <label class="control-label col-md-6">Area de destino</label>
                    <div class="col-md-6">
                        <select id="areaEntrega" class="selectpicker form-control" data-size="10" data-live-search="true" style="display: none;" name="area">
                            <option value="" selected>Seleccionar </option>
                            <option value="Direccion">Direccion </option>
                            <option value="Administracion">Administracion</option>
                            <option value="Contabilidad">Contabilidad</option>
                            <option value="Consultorios">Consultorios</option>
                            <option value="Internaciones">Internaciones</option>
                            <option value="Quirofano">Quirofano</option>
                            <option value="Farmacia">Farmacia</option>
                            <option value="NULO">NULO</option>
                        </select>
                    </div>
                </div>
                <button id="regisPrest" onclick="registrarPrestamo()" type="button" class="btn btn-theme-inverse btn-block btn-sm">Registrar</button>
            </div>
        </div>
    </div>
    <!-- //modal-body-->
</div>
<!-- //modal-->
<!-- //modal-->
<div id="md-editPres" class="modal fade" tabindex="-1" data-width="450">
    <div class="modal-header bg-inverse bd-inverse-darken">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h4 class="modal-title">Gestionar prestamo - fecha de prestamo: <p id="fechaPrestamo"></p>
        </h4>
    </div>
    <!-- //modal-header-->
    <div class="modal-body">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    <select class=" form-control" data-size="5" id="area_pres_update">
                        <option value="Direccion">Direccion </option>
                        <option value="Administracion">Administracion</option>
                        <option value="Contabilidad">Contabilidad</option>
                        <option value="Consultorios">Consultorios</option>
                        <option value="Internaciones">Internaciones</option>
                        <option value="Quirofano">Quirofano</option>
                        <option value="Farmacia">Farmacia</option>
                    </select>
                    <input type="text" class="form-control" placeholder="Personal " id="personal_pres_update">
                    <lavel hidden id="idPresCerrar"></lavel>
                </div>
                <div class="col-sm-6">
                    <button type="button" onclick="cerrarPrestamo()" class="btn btn-theme-inverse btn-block">Concluir Prestamo</button>
                    <button type="button" onclick="updatePrestamo()" class="btn btn-theme btn-block">Actualizar</button>

                </div>

            </div>
        </div>
    </div>
</div>
<div id="md-form_create_sitaPrev1" class="modal fade md-stickTop " tabindex="-1" data-width="1000">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times" id=""></i></button>
        <h2><strong>Registrar </strong>Cita Previa</h2>
    </div>
    <div class="modal-body">
        <embed src="" type="application/pdf" width=”100%” height=”100%” style="width: 940px; height: 809px;">
    </div>
</div>
<div id="md-form_create_sitaPrev" class="modal fade md-stickTop " tabindex="-1" data-width="1100">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times" id=""></i></button>
        <h2><strong>Registrar </strong>Cita Previa</h2>
    </div>
    <div class="row">
        <div class="col-lg-5">
            <div class=" panel-body">
                <div class="table-responsive">
                    <table class="table  ">
                        <thead>
                            <tr>
                                <th>HCL</th>
                                <th>Nombre</th>
                                <th>#</th>
                                <th>Hora</th>
                            </tr>
                        </thead>
                        <tbody id="listCitPrev">
                            <tr id="12">
                                <td align="right">#</td>
                                <td align="left">---</td>
                                <td align="right">---</td>
                                <td align="right">---</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <form id="form_create_CitPrev">
                <input type="number" id="id_paciente_create_citPrev" hidden>
                <div class="modal-body">
                    <div class="panel-body">
                        <div class="form-horizontal" data-collabel="3" data-alignlabel="center">
                            <div class="form-group">
                                <label class="control-label">Fecha</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="date" id="fecha_citPrev" class="form-control rounded" min="2000-01-01" max="2025-12-31" required>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="time" id="time_citPrev" class="form-control rounded" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Especialidad:</label>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <select required="" id="ate_especialidad_citPrev" name="ate_especialidad" class=" form-control show-menu-arrow" data-style="btn-theme-inverse">
                                                    <option selected="true" disabled="disabled">Seleccionar</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <button class="btn btn-theme-inverse" type="button" onclick="listCitasPreviasEspecialidad()"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Procedimiento</label>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <ul class="iCheck" data-color="blue">
                                            <li>
                                                <input type="radio" name="ateProcedimiento" value="Consulta" checked="true">
                                                <label class=""> Consulta</label>
                                            </li>
                                            <li>
                                                <input type="radio" name="ateProcedimiento" value="Control">
                                                <label class="">Control </label>
                                            </li>
                                            <li>
                                                <input type="radio" name="ateProcedimiento" value="Emergencias">
                                                <label class="">Emergencias</label>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="col-lg-6">
                                        <ul class="iCheck" data-color="blue">
                                            <li>
                                                <input type="radio" name="ateProcedimiento" value="Curacion Mayor">
                                                <label class="">CRN Mayor</label>
                                            </li>
                                            <li>
                                                <input type="radio" name="ateProcedimiento" value="Curacion Menor">
                                                <label class="">CRN Menor</label>
                                            </li>
                                            <li>
                                                <input type="radio" name="ateProcedimiento" value="Enfermeria">
                                                <label class="">Enfermeria</label>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Medico Asignado</label>
                                <div class="row">
                                    <div class="col-md-8">
                                        <select id="ate_med_citPrev" class="form-control" data-size="10" required="">
                                            <option selected="true" disabled="disabled">Buscar medico</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ticked" class="col-md-4 control-label"> # de ticked</label>
                                <div class="col-md-3">
                                    <input type="number" class="form-control" placeholder="# ticked" id="ticked_citPrev" required="" autocomplete="off"></input>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Turno T/M</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select id="ate_turno_citPrev" class=" form-control show-menu-arrow" data-style="btn-theme-inverse">
                                            <option value="Mañana">Mañana</option>
                                            <option value="Tarde">Tarde</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Observacion</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <textarea id="observacion_citPrev" cols="30" rows="2" require></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="panel-footer" align="right">
                    <button type="submit" class="btn btn-theme-inverse btn-block">Agendar Turno</button>
                    <!-- <button type="reset" class="btn" onclick="clearForm(this.form);"> Limpiar Formulario</button> -->
                </footer>
            </form>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('/asincrono/pacientes.js') }}"></script>
@endsection

@section('head1')
<script type="text/javascript">
    var int = self.setInterval("refresh()", 6000);

    function refresh() {
        location.reload(false);
    }
</script>
@endsection