<div class="modal-header bg-danger" >
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
    <h4 class="modal-title">Editar datos De precotizacion</h4>
</div>
<!-- //modal-header-->

<div class="modal-body">
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <p>
                Numero de historia clinica:
                <strong>
                    # {{$data->pa_hcl}}
                </strong>
                <br>
                Nombre del paciente:
                <strong>
                    {{$data->pa_nombre}} {{$data->pa_appaterno }} {{$data->ap_materno }}
                </strong>
            </p>
            <hr>
            <ul class="list-item angle">
                <li>-Especialidad Medica: <strong>{{ $data->cot_EspecialidadCirugia}}</strong></li>
                <li>-Nombre del Procedimiento: <strong> {{ $data->cot_tipoCirugia}}</strong> </li>
                <li>-Tiempo aproximado: <strong>{{ $data->cot_tiempoAproximado }} Horas</strong></li>
                <li>-Cirujano - Honorarios solicitados: <strong>{{ $data->cot_cirujanoHonorarios }}</strong></li>


            </ul>
            <hr>
            <h3>Precio y observacion</h3> <br>
            <div class=" content">
                <form id="form_registerCotizacion2">
                    <input name="_token" value="{{ csrf_token() }}" hidden>
                    <input id="id_paciente_cotizacion_create" type="number" name="id_cotizacion_create" value="{{$data->id}}" hidden>
                    <div class="col-md-12">
                        <div class="form-group">
                            <!-- <label class="control-label">Observaciones de cotizacion: </label> -->
                            <div>
                                <textarea class="form-control" name="observacion" placeholder="Observacion ..." rows="3" >{{$data->cot_costoObservacion}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <!-- <label class="control-label">Precio a cotizar: </label> -->
                            <div class="input-group"> <span class="input-group-addon">Bs.- </span>
                                <input type="number" name="precio" class="form-control" placeholder="Precio" autocomplete="off" value="{{ $data->cot_costoProcedimiento}}" required>
                            </div>
                        </div>
                        <div class="form-group offset">
                            <div>
                                <button type="submit" class="btn btn-theme">Actualizar</button>
                                <button id="123123" class="btn ">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- //col-md-3 -->
        <div class="col-md-6 col-sm-6">
            <ul class="list-item arrow">
                <div class="col-md-12">
                    <li>- Grado del Procedimiento:
                        <strong>
                            @if($data->cot_procedimiento == 1)
                            <strong>Mayor</strong>
                            @endif
                            @if($data->cot_procedimiento == 2)
                            <strong>Mediana</strong>
                            @endif
                            @if($data->cot_procedimiento == 3)
                            <strong>Menor</strong>
                            @endif
                        </strong>
                    </li>
                    <hr>
                    <strong>Servicios requeridos: </strong>
                    @if($data->cot_espAneesteseologo == 1)
                    <li>-Especialista anesteseologo.</li>
                    @endif
                    @if($data->cot_quirofanoMayor == 1)
                    <li>- Quirofano mayor.</li>
                    @endif
                    @if($data->cot_salaEndoscopia == 1)
                    <li>- Sala de Endoscopia.</li>
                    @endif
                    @if($data->cot_salaPartos == 1)
                    <li>- Sala de partos.</li>
                    @endif
                    @if($data->cot_equipoLaparosopica == 1)
                    <li>- Equipo de Laparoscopia.</li>
                    @endif
                    @if($data->cot_ayudante1 == 1)
                    <li>- 1 Ayudante.</li>
                    @endif
                    @if($data->cot_ayudante2 == 1)
                    <li>- 2 Ayudante.</li>
                    @endif
                    @if($data->cot_instrumentador == 1)
                    <li>- Instrumentador.</li>
                    @endif
                    @if($data->cot_circulante == 1)
                    <li>- Circulante.</li>
                    @endif
                    @if($data->cot_oxigeno == 1)
                    <li>- Oxigeno.</li>
                    @endif
                    @if($data->cot_agujaK == 1)
                    <li>- Aguja K.</li>
                    @endif

                    @if($data->cot_insumoQuirofano == 1)
                    <li>- Insumos en quirofano.</li>
                    @endif
                    @if($data->cot_medicamentosQuirofano == 1)
                    <li>- Medicamentos en quirafano.</li>
                    @endif
                    <hr>
                    <li>- Otros: <strong>{{ $data->cot_otros }}</strong></li>

                </div>

            </ul>
        </div>
        <!-- //col-md-3 -->
    </div>
</div>
</div>
<script type="text/javascript" src="{{ asset('/asincrono/cotizaciones.js') }}"></script>