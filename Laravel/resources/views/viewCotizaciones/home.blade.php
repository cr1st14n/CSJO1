<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <h2><strong>Pre</strong> Cotizaciones </h2>
            </header>
            <div class="panel-body">

                <form id="form_list_cotizaciones">
                    <div class="col-lg-2">
                        <select name="estado_cotizacion" id="estado_cotizacion" class="form-control" required>
                            <option value="0">Sin cotizar</option>
                            <option value="1">Cotizado</option>
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <input type="date" class="form-control" name="date_list_cotizaciones" value="<?php echo date("Y-m-d"); ?>" required>
                    </div>
                    <div class="col-lg-3">
                        <button type="submit" class="btn btn-theme-inverse"><i class="fa fa-search"></i></button>
                        <button type="button" class="btn btn-theme-inverse" id="btn_showMdSearchPaciente"><i class="fa fa-plus-square "></i></button>
                        <button type="button" class="btn btn-theme-inverse" id="btn_pdf"><i class="fa fa-plus-square "></i></button>
                    </div>
                </form>
                <div class="table-responsive">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th># Cod</th>
                                <th>Nombre</th>
                                <th>Procedimento medico</th>
                                <th>Medico</th>
                                <th>Monto Cotizado </th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody align="center" id="table-list_precotizaciones">
                            <tr>
                                <td>--</td>
                                <td>--</td>
                                <td>--</td>
                                <td>--</td>
                                <td>--</td>
                                <td>--</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>

<div id="md-showPDF" class="modal fade md-slideDown" data-width="50%" data-header-color="#736086">
    <embed src="http://localhost/C.S.J.O.bo/adm/cotizaciones/createPdf" type="application/pdf" width="100%" height="800px">
</div>
<div id="md-optionCotizacion" class="modal fade md-slideDown" data-width="50%" data-header-color="#736086">
</div>
<div id="md-searchPacientePrecoti" class="modal fade md-slideDown" data-width="50%" data-header-color="#736086">
    <div id="content">

        <div class="row">

            <div class="col-lg-12">

                <section class="panel">
                    <header class="panel-heading">
                        <h4><strong>Buscar</strong> Paciente afiliado </h4>
                    </header>
                    <div class="panel-body">
                        <form class="navbar-form navbar-left">
                            <div class="form-group">
                                <label>Buscar :</label>
                                <input type="text" size="3" class="form-control" name='num'   placeholder="CI/HCL" id="HCLpaciente_preCot" autocomplete="off" />

                                <input type="text" size="17" class="form-control" name='dato1' placeholder="NOMBRE APELLIDOS"   id="NOMBRESpaciente_preCot" autocomplete="off" />
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>HCL</th>
                                        <th>CI</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th width="30%">Action</th>
                                    </tr>
                                </thead>
                                <tbody align="center" id="resulBusqPacientes_proCot">
                                    <tr>
                                        <td>--</td>
                                        <td valign="middle">--</td>
                                        <td>--</td>
                                        <td>--</td>
                                        <td>--</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>

        </div>
        <!-- //content > row-->

    </div>
</div>
<!-- //modal-->

<script type="text/javascript" src="{{ asset('/asincrono/cotizaciones.js') }}"></script>