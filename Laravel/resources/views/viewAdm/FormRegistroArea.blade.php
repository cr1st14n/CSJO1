@extends('layouts.admLay1')

@section('content')
@if(Session::has('flash_message_correcto'))

<div class="alert bg-success">
    <strong>Exelente!</strong>{{Session::get('flash_message_correcto')}}
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
</div>
@endif
@if(Session::has('flash_message_rechazado'))

<div class="alert bg-danger">
    <strong>Alerta!</strong>{{Session::get('flash_message_rechazado')}}
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
</div>
@endif


<div class="col-lg-6">
    <form class="" method="POST" action="{{ route('createArea') }}">
        {{ csrf_field() }}
        <section class="panel corner-flip">
            <header class="panel-heading sm" data-color="theme-inverse">
                <h2><strong>Registrar </strong> Nueva Area</h2>

            </header>
            <div class="panel-tools color" align="right" data-toolscolor="#4EA582">
            </div>
            <div class="panel-body">
                <div class="form-horizontal" data-collabel="3" data-alignlabel="center">
                    <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                        <label for="nombre" class="col-md-4 control-label">Nombre</label>
                        <div class="col-md-6">
                            <input id="nombre" type="text" class="form-control rounded" name="nombre" value="{{ old('nombre') }}" maxlength="50" data-always-show="true">
                            @if ($errors->has('nombre'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nombre') }}</strong>
                            </span>
                            @endif

                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                        <label class="control-label">Descripcion </label>
                        <div>
                            <input id="descripcion" name="descripcion" value="{{ old('descripcion') }}" type="text" class="form-control rounded" maxlength="200" data-always-show="false">
                            @if ($errors->has('descripcion'))
                            <span class="help-block">
                                <strong>{{ $errors->first('descripcion') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('area') ? ' has-error' : '' }}">
                        <label class="control-label">Area medica</label>
                        <div class="row">
                            <div class="col-md-6">
                                <select id="area" name="area" class=" form-control show-menu-arrow" data-style="btn-theme-inverse">
                                    <option selected="true" disabled="disabled"></option>

                                    <option value="Administrativa">Administrativa</option>
                                    <option value="Salud">Salud</option>
                                </select>
                                @if ($errors->has('area'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('area') }} <br> selccione un tipo de area</strong>
                                </span>
                                @endif

                            </div>
                        </div>

                    </div>




                    <footer class="panel-footer">
                        <button type="submit" class="btn btn-theme">Registrar</button>
                        <button type="reset" class="btn" onclick="clearForm(this.form);"> Limpiar Formulario</button>
                    </footer>
                </div>
            </div>
        </section>
    </form>
</div>


@endsection

@section('scripts')
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
</script>



@endsection