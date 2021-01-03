@extends('layouts.RecepLay')
@section('refUbi')
<ol class="breadcrumb">
    <li><a href="#">Recepcion</a></li>
    <li class="active">Registrar Atencion</li>
</ol>

@endsection
@section('content')

<div class="col-lg-6">
    <form class="" method="POST" action="{{ route('print_HCl') }}">
        {{ csrf_field() }}
        <section class="panel corner-flip" style="text-transform: capitalize; ">
            <header class="panel-heading sm" data-color="theme-inverse">
                <h2><strong></strong> Datos del Paciente</h2>

            </header>
            <div class="panel-tools color" align="right" data-toolscolor="#4EA582">
            </div>
            <div class="panel-body">
                <div class="form-horizontal" data-collabel="12" data-alignlabel="center">
                    <input type="text" name="pa_id" id="pa_id" value="{{$dato->pa_id}}" hidden="">
                    @if ($errors->has('pa_hcl'))
                    <span class="help-block">
                        <strong>! No se puede registrar una atencion sin codigo de historia del paciente ¡</strong>
                    </span>
                    @endif
                    <div class="form-group{{ $errors->has('pa_hcl') ? ' has-error' : '' }}">

                        <label for="nombre" class="col-md-4 control-label"># Historia Clinica:</label>

                        <h3>{{$dato->pa_hcl}} </h3>

                    </div>
                    <div class="form-group{{ $errors->has('pa_hcl') ? ' has-error' : '' }}">
                        <label for="nombre" class="col-md-4 control-label">Carnet de Identidad:</label><span></span>
                        <h3>{{$dato->pa_ci}}</h3>

                    </div>

                    <div class="form-group{{ $errors->has('pa_hcl') ? ' has-error' : '' }}">
                        <label for="nombre" class="col-md-4 control-label">Nombre:</label>
                        <h3>{{$dato->pa_nombre}}</h3>

                    </div>
                    <div class="form-group{{ $errors->has('pa_hcl') ? ' has-error' : '' }}">
                        <label for="nombre" class="col-md-4 control-label">Apellidos:</label>
                        <h3>{{$dato->pa_appaterno}} {{$dato->pa_apmaterno}} </h3>

                    </div>
                    <div class="form-group{{ $errors->has('pa_hcl') ? ' has-error' : '' }}">
                        <label for="nombre" class="col-md-4 control-label">Sexo:</label>
                        <h3>{{$dato->pa_sexo}}</h3>

                    </div>
                    <div class="form-group{{ $errors->has('pa_hcl') ? ' has-error' : '' }}">
                        <label for="nombre" class="col-md-4 control-label">Fecha de nacimiento:</label>
                        <h3>{{$FecNac}} </h3>

                    </div>
                    <div class="form-group{{ $errors->has('pa_hcl') ? ' has-error' : '' }}">
                        <label for="nombre" class="col-md-4 control-label">Edad:</label>
                        <h3>{{$edad}} </h3>

                    </div>
                    <div class="form-group{{ $errors->has('pa_hcl') ? ' has-error' : '' }}">
                        <label for="nombre" class="col-md-4 control-label">Pais de nacimiento:</label>
                        <h3>{{$dato->pa_pais_nac}} </h3>

                    </div>
                    <div class="form-group{{ $errors->has('pa_hcl') ? ' has-error' : '' }}">
                        <label for="nombre" class="col-md-4 control-label">Ciudad de nacimiento:</label>
                        <h3>{{$dato->pa_ciudad_nac}} </h3>

                    </div>

                    <footer class="panel-footer">
                        <button type="submit" class="btn" formtarget="_blank">Generar Hoja "Historial Clinico" </button>
                    </footer>

                </div>

            </div>
        </section>
    </form>
</div>

<!-- seguada columna -->
<div class="col-lg-6">
    <form class="" method="POST" action="{{ route('create_atencion') }}">
        {{ csrf_field() }}
        <section class="panel corner-flip">
            <header class="panel-heading sm" data-color="theme-inverse">
                <h2><strong></strong>Registrar Atencion</h2>
                <input type="text" name="pa_id" id="pa_id" value="{{$dato->pa_id}}" hidden="">
            </header>
            <div class="panel-tools color" align="right" data-toolscolor="#4EA582">
            </div>
            <div class="panel-body">
                <div class="form-horizontal" data-collabel="4" data-alignlabel="center">
                    <div class="row" style="text-transform: uppercase;">
                        <div class="col-lg-12" align="center">
                            <?php if ($ZD == 'descuento') : ?>
                                <label class="col-md-12 control-label">------Nota: Paciente con descuento-----------</label><br>
                            <?php endif ?>
                        </div>

                    </div>
                    <br>
                    <div class="form-group{{ $errors->has('ate_especialidad') ? ' has-error' : '' }}">
                        <label class="control-label">Especialidad:</label>
                        <div class="row">
                            <div class="col-md-8">
                                <select required="" id="ate_especialidad" name="ate_especialidad" class=" form-control show-menu-arrow" data-style="btn-theme-inverse">
                                    <option selected="true" disabled="disabled">Seleccionar</option>
                                    @foreach($especialidad as $especialidad)
                                    <option value="{{$especialidad->id}} ">{{$especialidad->nombre}} </option>
                                    @endforeach

                                </select>
                                @if ($errors->has('ate_especialidad'))
                                <span class="help-block">
                                    <strong> selccione un tipo de especialidad medica</strong>
                                </span>
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('ate_procedimiento') ? ' has-error' : '' }}">
                        <label class="control-label">Procedimiento</label>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <ul class="iCheck" data-color="blue">
                                            <li>
                                                @if(old('ate_procedimiento') == 'Consulta' )
                                                <input type="radio" checked="" name="ate_procedimiento" id="ate_procedimiento" value="Consulta">

                                                @endif
                                                <input type="radio" name="ate_procedimiento" id="ate_procedimiento" value="Consulta">
                                                <label class=""> Consulta</label>
                                            </li>
                                            <li>
                                                @if(old('ate_procedimiento') == 'Control')
                                                <input type="radio" checked="" name="ate_procedimiento" id="ate_procedimiento" value="Control">

                                                @endif
                                                <input type="radio" name="ate_procedimiento" id="ate_procedimiento" value="Control">
                                                <label class="">Control </label>
                                            </li>
                                            <li>
                                                @if(old('ate_procedimiento') == 'Emergencias' )
                                                <input type="radio" checked="" name="ate_procedimiento" id="ate_procedimiento" value="Emergencias">

                                                @endif
                                                <input type="radio" name="ate_procedimiento" id="ate_procedimiento" value="Emergencias">
                                                <label class="">Emergencias</label>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="col-lg-6">
                                        <ul class="iCheck" data-color="blue">
                                            <li>
                                                @if(old('ate_procedimiento') == 'Curacion Mayor' )
                                                <input type="radio" checked="" name="ate_procedimiento" id="ate_procedimiento" value="Curacion Mayor">

                                                @endif
                                                <input type="radio" name="ate_procedimiento" id="ate_procedimiento" value="Curacion Mayor">
                                                <label class="">CRN Mayor</label>
                                            </li>
                                            <li>
                                                @if(old('ate_procedimiento') == 'Curacion Menor' )
                                                <input type="radio" checked="" name="ate_procedimiento" id="ate_procedimiento" value="Curacion Menor">

                                                @endif
                                                <input type="radio" name="ate_procedimiento" id="ate_procedimiento" value="Curacion Menor">
                                                <label class="">CRN Menor</label>
                                            </li>
                                            <li>
                                                @if(old('ate_procedimiento') == 'Enfermeria')
                                                <input type="radio" name="ate_procedimiento" id="ate_procedimiento" value="Enfermeria" checked="">
                                                @endif
                                                <input type="radio" name="ate_procedimiento" id="ate_procedimiento" value="Enfermeria">
                                                <label class="">Enfermeria</label>
                                            </li>

                                        </ul>
                                    </div>
                                </div>

                                @if ($errors->has('ate_procedimiento'))
                                <span class="help-block">
                                    <strong> selccione un tipo de procedimiento medico</strong>
                                </span>
                                @endif

                            </div>
                        </div>

                    </div>
                    <div class="form-group{{ $errors->has('ate_med') ? ' has-error' : '' }}">
                        <label class="control-label">Medico Asignado</label>
                        <div class="row">
                            <div class="col-md-8">
                                <select id="ate_med" name="ate_med" class="selectpicker form-control" data-size="10" data-live-search="true" required="">
                                    <option selected="true" disabled="disabled">Buscar medico</option>
                                    @foreach($medico as $medico)
                                    <option value="{{$medico->id}} ">{{$medico->ps_appaterno}} {{$medico->ps_apmaterno}} {{$medico->ps_nombre}} </option>
                                    @endforeach

                                </select>
                                @if ($errors->has('ate_med'))
                                <span class="help-block">
                                    <strong>Selccione un medico Asignado al tipo de procedimiento</strong>
                                </span>
                                @endif

                            </div>
                        </div>

                    </div>
                    <div class="form-group{{ $errors->has('ticked') ? ' has-error' : '' }}">
                        <label for="ticked" class="col-md-4 control-label"> # de ticked</label>
                        <div class="col-md-3">
                            <input type="tex" class="form-control" placeholder="# ticked" id="ticked" name="ticked" value="{{ old('ticked') }}" onkeypress="return soloNu(event)" onblur="limpia()" max="2" maxlength="4" required=""></input>
                            @if ($errors->has('ticked'))
                            <span class="help-block">
                                <strong>Ingrese el numero del ticket</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('ate_turno') ? ' has-error' : '' }}">
                        <label class="control-label">Turno T/M</label>
                        <div class="row">
                            <div class="col-md-6">
                                <select id="ate_turno" name="ate_turno" class=" form-control show-menu-arrow" data-style="btn-theme-inverse">
                                    <option selected="true" disabled="disabled"></option>

                                    <option value="Mañana">Mañana</option>
                                    <option value="Tarde">Tarde</option>
                                </select>
                                @if ($errors->has('ate_turno'))
                                <span class="help-block">
                                    <strong>selccione el turno del procedimiento</strong>
                                </span>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Registrar como pagado</label>
                        <div class="row">
                            <div class="col-sm-4 ios-switch red">
                                <div class="switch">
                                    <input type="checkbox" name="R_P" id="R_P">
                                </div>
                            </div><!-- //col-sm-4-->

                        </div>

                    </div>
                    <footer class="panel-footer">
                        <button type="submit" class="btn btn-theme">Agendar Turno</button>
                        <button type="reset" class="btn" onclick="clearForm(this.form);"> Limpiar Formulario</button>
                    </footer>
                </div>
            </div>
        </section>
    </form>
</div>
<!-- //content > row > col-lg-12 -->


@endsection

@section('scripts')
<script type="text/javascript">
    function fnShowHide(iCol, table) {
        var oTable = $(table).dataTable();
        var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
        oTable.fnSetColumnVis(iCol, bVis ? false : true);
    }

    $(function() {

        //////////     DATA TABLE  COLUMN TOGGLE    //////////
        $('[data-table="table-toggle-column"]').each(function(i) {
            var data = $(this).data(),
                table = $(this).data("table-target"),
                dropdown = $(this).parent().find(".dropdown-menu"),
                col = new Array;
            $(table).find("thead th").each(function(i) {
                $("<li><a  class='toggle-column' href='javascript:void(0)' onclick=fnShowHide(" + i + ",'" + table + "') ><i class='fa fa-check'></i> " + $(this).text() + "</a></li>").appendTo(dropdown);
            });
        });

        //////////     COLUMN  TOGGLE     //////////
        $("a.toggle-column").on('click', function() {
            $(this).toggleClass("toggle-column-hide");
            $(this).find('.fa').toggleClass("fa-times");
        });

        // Call dataTable in this page only
        $('#table-example').dataTable();
        $('table[data-provide="data-table"]').dataTable();
    });
</script>




<script>
    $(document).ready(function() {

        $("#formID").submit(function(e) {
            e.preventDefault();
            if ($(this).parsley('validate')) {
                alert("send");
            }
        });

        //iCheck[components] validate
        $('input').on('ifChanged', function(event) {
            $(event.target).parsley('validate');
        });

    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        // $('#ate_procedimiento > option[value="{{ old('ate_procedimiento') }}"]').attr('selected', 'selected');
        $('#ate_turno > option[value={{$turno}} ]').attr('selected', 'selected');


        //$('input:radio[name="usu_sexo"][value="{{ old('usu_sexo') }}"]').prop('checked', true);
        //$("form input:[name=usu_sexo]").filter('[value={{ old('usu_sexo') }}]').attr('checked', true);


    });
</script>





@endsection