@extends('layouts.admLay2')
@section('head')
@endsection
@section('refUbi')
<ol class="breadcrumb">
    <li><a href="#">Administracion</a></li>
    <li class="active">Estado Recepcion</li>
</ol>

@endsection
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="well bg-inverse">
            <div class="widget-tile">
                <section>
                    <h5><strong>Clientes </strong> Registrados </h5>
                    <h2>{{$total}}</h2>
                    <div class="progress progress-xs progress-white progress-over-tile">
                        <div class="progress-bar  progress-bar-white" aria-valuetransitiongoal="8590" aria-valuemax="10000"></div>
                    </div>
                </section>
                <div class="hold-icon"><i class="fa fa-bar-chart-o"></i></div>
                <div class=" ">
                    <button class="btn btn-transparent btn-theme-inverse " data-toggle="modal" data-target="#md-informePacientes" onclick="informe1()"><i class="glyphicon glyphicon-signal"></i></button>
                    <button class="btn btn-transparent btn-theme-inverse " data-toggle="modal" data-target="#md-full-width"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="well bg-inverse">
            <div class="widget-tile">
                <section>
                    <h5><strong>citas </strong>medicas </h5>
                    <h2>478</h2>
                    <div class="progress progress-xs progress-white progress-over-tile">
                        <div class="progress-bar  progress-bar-white" aria-valuetransitiongoal="478" aria-valuemax="1000"></div>
                    </div>
                    <button class="btn btn-transparent btn-theme-inverse " data-toggle="modal" data-target="#md-infoCaja"><i class="fa fa-plus-square"></i></button>
                    <button class="btn btn-transparent btn-theme-inverse " onclick="showDetMed()"><i class="fa fa-user-md"></i></button>
                </section>
                <div class="hold-icon"><i class="fa fa-user-md"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="well bg-inverse">
            <div class="widget-tile">
                <section>
                    <h5><strong>Usuarios </strong>en el area </h5>
                    @foreach($usuarios as $usu)
                    <h5>
                        - {{$usu->usu_nombre}} {{$usu->usu_appaterno}} {{$usu->usu_apMaterno}}
                    </h5>
                    @endforeach
                </section>
                <div class="hold-icon"><i class="fa fa-users"></i></div>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-lg-9">
        <section class="panel corner-flip">
            <div class="widget-chart bg-lightseagreen bg-gradient-green" onclick="cuadroEstadistico()">
                <h2>Estado anual registro de pacientes</h2>
                <table class="flot-chart" data-type="lines" data-tick-color="rgba(255,255,255,0.2)" data-width="100%" data-height="220px">
                    <thead>
                        <tr>
                            <th></th>
                            <th style="color : #FFF;">Test</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>ENE</th>
                            <td>{{$enero}}</td>
                        </tr>
                        <tr>
                            <th>FEB</th>
                            <td>{{$febrero}}</td>
                        </tr>
                        <tr>
                            <th>MAR</th>
                            <td>{{$marzo}}</td>
                        </tr>
                        <tr>
                            <th>ABR</th>
                            <td>{{$abril}}</td>
                        </tr>
                        <tr>
                            <th>MAY</th>
                            <td>{{$mayo}}</td>
                        </tr>
                        <tr>
                            <th>JUN</th>
                            <td>{{$junio}}</td>
                        </tr>
                        <tr>
                            <th>JUL</th>
                            <td>{{$julio}}</td>
                        </tr>
                        <tr>
                            <th>AGO</th>
                            <td>{{$agosto}}</td>
                        </tr>
                        <tr>
                            <th>SEP</th>
                            <td>{{$septiembre}}</td>
                        </tr>
                        <tr>
                            <th>OCT</th>
                            <td>{{$octubre}}</td>
                        </tr>
                        <tr>
                            <th>NOV</th>
                            <td>{{$noviembre}}</td>
                        </tr>
                        <tr>
                            <th>DIC</th>
                            <td>{{$diciembre}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="panel-body">

            </div>
        </section>
    </div>
    <div class="col-lg-3">
        <section class="panel">
            <h4 align="center"><strong>Pacientes registrados Jornada actual</strong></h4>
            <div id="estado1" style="height:280px "></div>
            <button class="btn btn-block btn-sm btn-theme-inverse" onclick="actEstado1()">Actualizar</button>
        </section>
    </div>
</div>

<!-- Seccin modals -->
<div id="md-informePacientes" class="modal fade md-stickTop">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h4 class="modal-title">Informe de registro de pacientes</h4>
    </div>
    <!-- //modal-header-->
    <div class="modal-body">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-7" id="porcentajeRegistro">

                </div>

                <div class="col-md-5" id="totalRegistros">

                </div>
            </div>
        </div>
    </div>
    <!-- //modal-body-->
</div>
<div id="md-HclHistorial" class="modal fade container md-stickTop">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h4 class="modal-title">Historial de atencion del paciente: <strong id="nombreDelPaciente"></strong></h4>
        <label id="IdDeEspecialidadDC" hidden></label>
    </div>
    <!-- //modal-header-->
    <div class="modal-body">
        <div class="table-responsive">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Procedimiento</th>
                        <th>Especialidad</th>
                        <th>Medico</th>
                    </tr>
                </thead>
                <tbody align="center" id="tabPaciHistMed">
                </tbody>
            </table>
        </div>
    </div>
    <!-- //modal-body-->
</div>
<div id="md-full-width" class="modal fade md-stickTop">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h4 class="modal-title">Pacientes registrados</h4>
    </div>
    <!-- //modal-header-->
    <div class="modal-body">

        <div class="col-lg-4">
            <input type="number" class="form-control" placeholder="CI / HCL" id="buscNumHCL" oninput="buscarCiHCL(this.value,1)" onkeyup="validar('buscNumHCL')" pattern="[0-9]+">
        </div>
        <div class="col-lg-8">
            <input type="text" class="form-control" placeholder="Nombre apellico" oninput="buscarCiHCL(this.value,2)">
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th># HCL</th>
                        <th>CI</th>
                        <th>Nombre </th>
                        <th>apellico</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody align="center" id="listPacientes">
                    <tr>
                        <td>
                            Ingrese datos para buscar!
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- //modal-body-->
</div>
<div id="md-infoCaja" class="modal fade md-stickTop">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h4 class="modal-title">Informe de caja</h4>
    </div>
    <!-- //modal-header-->
    <div class="modal-body">
        <div class="panel-body">
            <div class="row">
                <div class="row">
                    <div class="col-lg-12">
                        <button class="btn btn-theme-inverse btn-sm btn-block" onclick="InfoCajaList()">filtrar</button>
                    </div>
                    <div class="col-lg-6">
                        <div class="align-lg-center ">
                            <select name="" id="infCajaMez" class="form-control">
                                <option value="Anual">Anual</option>
                                <option value="01">enero</option>
                                <option value="02">Febrero</option>
                                <option value="03">Marzo</option>
                                <option value="04">Abril</option>
                                <option value="05">Mayo</option>
                                <option value="06">Junio</option>
                                <option value="07">Julio</option>
                                <option value="08">Agosto</option>
                                <option value="09">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="align-lg-center ">
                            <input class="form-control" type="number" name="" id="infoCajaAño" placeholder="Año" value="2020">
                        </div>
                    </div>
                </div>


                <div class="col-md-12">
                    <h3><strong>Total</strong>.- </h3>
                    <br>
                    <ol class="rectangle-list" id="listReporteCaja">
                        <li><a href="#"> ** ** <span class="pull-right">## ##</span></a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- //modal-body-->
</div>
<div id="md-DetalleCajaEsp" class="modal fade container md-stickTop">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h4 class="modal-title">Estado anual de atencion de: <strong id="nombreDeEspecialidadDC"></strong></h4>
        <input type="text" id="IdDeEspecialidadDC" hidden>
    </div>
    <!-- //modal-header-->
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-4">
                <input type="number" class="form-control" placeholder="Año" id="infoCajaAñoDetalle">
            </div>
            <div class="col-sm-8">
                <button class="btn  btn-theme-inverse btn-block" onclick="showDataEstEsp()">Filtrar</button>
            </div>
        </div>
        <div id="estadoAnualEst">

        </div>
    </div>
    <!-- //modal-body-->
</div>
<div id="md-infoCaja2" class="modal fade md-stickTop">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h4 class="modal-title">Detalle de atencion Personal Medico</h4>
    </div>
    <!-- //modal-header-->
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-4">
                <select class="selectpicker form-control" style="display: none;" id="IdDetMedCajaDate">
                    <option value="anual">Anual </option>
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>

            </div>
            <div class="col-lg-4">
                <input class="form-control" type="number" name="" id="IdDetMedCajaAño" placeholder="Gestion" value="2020">

            </div>
            <div class="col-sm-4">
                <button class="btn btn-block  btn-theme-inverse" onclick="actEstado2()"> Filtrar </button>

            </div>
        </div>
        <div class="col-md-12">
            <ol class="rectangle-list" id="listReporteCaja2">
                <li><a href="#"> ** ** <span class="pull-right">## ##</span></a></li>
            </ol>
        </div>

    </div>
    <!-- //modal-body-->
</div>
<div id="md-DetalleCajaMed" class="modal fade container md-stickTop">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h4 class="modal-title">Estado anual de atencion de: <strong id="nombreDeMedicoDC"></strong></h4>
        <input type="text" id="idNombreDeMedicoDC" hidden>
    </div>
    <!-- //modal-header-->
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-4">
                <input type="number" class="form-control" placeholder="Año" id="infoCajaAñoDetalleMed">
            </div>
            <div class="col-sm-8">
                <button class="btn  btn-theme-inverse btn-block" onclick="ShowModalDetalleCajaMed2()">Filtrar</button>
            </div>
        </div>
        <div id="estadoAnualEst11">
        </div>
    </div>
    <!-- //modal-body-->
</div>

@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('asincrono/admRecepHome.js') }}"></script>
<script type="text/javascript" src="{{ asset('asincrono/homejs.js') }}"></script>

@endsection