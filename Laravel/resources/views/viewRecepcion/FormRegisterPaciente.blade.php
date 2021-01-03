    @extends('layouts.RecepLay')
@section('refUbi')
<ol class="breadcrumb">
    <li><a href="#">Recepcion</a></li>
    <li class="active">Afiliar paciente</li>
</ol>

@endsection
@section('content')



<div class="col-lg-6">
<form  class="" method="POST" action="{{ route('register_paciente') }}">
  {{ csrf_field() }}
<section class="panel corner-flip">
    <header class="panel-heading sm" data-color="theme-inverse">
            <h2> Afiliar Paciente con HCL:<strong>{{$dato}} </strong></h2>
            <h2>Datos personales</h2>
            <input type="text"  hidden="" name="pa_hcl" id="pa_" value="{{$dato}}">
    </header>
    <div class="panel-tools color" align="right" data-toolscolor="#4EA582">        
    </div>
    <div class="panel-body">                       
        <div   class="form-horizontal" data-collabel="3" data-alignlabel="center">          
            <div class="form-group{{ $errors->has('pa_ci') ? ' has-error' : '' }}">
                <label for="pa_ci" class="col-md-4 control-label">C.I./C.N.</label>
                <div class="col-md-6">
                    <input id="pa_ci" type="text" class="form-control rounded" placeholder="Carnet o Certificado de nacimiento" name="pa_ci" value="{{ old('pa_ci') }}"  maxlength="10" data-always-show="true" onkeypress="return soloNu(event)" onblur="limpia()">
                    @if ($errors->has('pa_ci'))
                        <span class="help-block">
                            <strong>{{ $errors->first('pa_ci') }}</strong>
                        </span>
                    @endif

                </div>
            </div>
            <div class="form-group{{ $errors->has('pa_nombre') ? ' has-error' : '' }}">
                    <label class="control-label">Nombre </label>
                    <div >
                            <input id="pa_nombre" name="pa_nombre" value="{{ old('pa_nombre') }}" type="text" class="form-control rounded" maxlength="30" data-always-show="false" onkeypress="return soloLe(event)" onblur="limpia()" > 
                         @if ($errors->has('pa_nombre'))
                            <span class="help-block">
                                <strong>{{ $errors->first('pa_nombre') }}</strong>
                            </span>
                        @endif
                    </div>
            </div>
            <div class="form-group{{ $errors->has('pa_appaterno') ? ' has-error' : '' }}">
                    <label  class="control-label">Apellido paterno</label>
                    <div>
                            <input id="pa_appaterno" name="pa_appaterno" type="text" value="{{ old('pa_appaterno') }}" class="form-control rounded" maxlength="30" data-always-show="false" onkeypress="return soloLe(event)" onblur="limpia()">
                         @if ($errors->has('pa_appaterno'))
                            <span class="help-block">
                                <strong>{{ $errors->first('pa_appaterno') }}</strong>
                            </span>
                        @endif
                    </div>
            </div>
            <div class="form-group{{ $errors->has('pa_apmaterno') ? ' has-error' : '' }}">
                    <label class="control-label">Apellido materno</label>
                    <div>
                            <input id="pa_apmaterno" name="pa_apmaterno" value="{{ old('pa_apmaterno') }}" type="text" class="form-control rounded"  maxlength="30" data-always-show="false" onkeypress="return soloLe(event)" onblur="limpia()">
                        @if ($errors->has('pa_apmaterno'))
                            <span class="help-block">
                                <strong>{{ $errors->first('pa_apmaterno') }}</strong>
                            </span>
                        @endif
                    </div>
            </div>
            <div class="form-group{{ $errors->has('pa_fechnac') ? ' has-error' : '' }}">
                    <label class="control-label">Fecha de nacimiento</label>
                    <div>
                            <input id="pa_fechnac" name="pa_fechnac" value="{{ old('pa_fechnac') }}" type="date" class="form-control rounded"  maxlength="30" data-always-show="false" required="date">
                        @if ($errors->has('pa_fechnac'))
                            <span class="help-block">
                                <strong>Error de sintaxis(dd-mm-YYYY) o exede a fecha actual</strong>
                            </span>
                        @endif

                    </div>
            </div>
            <div class="form-group{{ $errors->has('pa_sexo') ? ' has-error' : '' }}">
                    <label class="control-label">Sexo</label>
                    <div>
                            <ul class="iCheck"  data-color="red">
                        @if(old('pa_sexo') ==null)
                                    <li><input type="radio" name="pa_sexo" id="pa_sexo" value="M" required="" >
                                        <label>masculino</label>
                                    </li>
                                    <li><input  type="radio" name="pa_sexo" id="pa_sexo" value="F" required="">
                                        <label >femenino</label>
                                    </li>                            
                        @else
                            @if(old('pa_sexo') == "M")
                                    <li><input type="radio" name="pa_sexo" id="pa_sexo" value="M" checked="" required="" >
                                        <label>masculino</label>
                                    </li>
                                    <li><input  type="radio" name="pa_sexo" id="pa_sexo" value="F" required="">
                                        <label >femenino</label>
                                    </li>
                            @else
                                    <li><input type="radio" name="pa_sexo" id="pa_sexo" value="M"  required="" >
                                        <label>masculino</label>
                                    </li>
                                    <li><input  type="radio" name="pa_sexo" id="pa_sexo" value="F" checked="" required="">
                                        <label >femenino</label>
                                    </li>
                            @endif
                        @endif
                            </ul>
                    </div>
                        @if ($errors->has('pa_sexo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('pa_sexo') }}</strong>
                            </span>
                        @endif
            </div> 
            <div class="form-group{{ $errors->has('pa_pais_nac') ? ' has-error' : '' }}">
                    <label class="control-label">Pais de nacimiento</label>
                    <div class="col-md-6">
                            <?php if (old('pa_pais_nac') == null): ?>
                            <input id="pa_pais_nac" name="pa_pais_nac" value="Bolivia"  type="text" class="form-control rounded" maxlength="30" onkeypress="return soloLe(event)" onblur="limpia()" >
                            <?php else: ?>
                            <input id="pa_pais_nac" name="pa_pais_nac" value="{{old('pa_pais_nac')}} "  type="text" class="form-control rounded" maxlength="30" onkeypress="return soloLe(event)" onblur="limpia()" >

                            <?php endif ?>
                        @if ($errors->has('pa_pais_nac'))
                            <span class="help-block">
                                <strong>{{ $errors->first('pa_pais_nac') }}</strong>
                            </span>
                        @endif
                    </div>
            </div>
            <div class="form-group{{ $errors->has('pa_ciudad_nac') ? ' has-error' : '' }}">
                    <label class="control-label">Ciudad de nacimiento</label>
                    <div class="col-md-6">
                            <input id="pa_ciudad_nac" name="pa_ciudad_nac" value="{{ old('pa_ciudad_nac') }}"  type="text" class="form-control rounded" maxlength="30" onkeypress="return soloLe(event)" onblur="limpia()" >
                        @if ($errors->has('pa_ciudad_nac'))
                            <span class="help-block">
                                <strong>{{ $errors->first('pa_ciudad_nac') }}</strong>
                            </span>
                        @endif
                    </div>
            </div>
                        
        </div>                   
    </div>   
</section>
</div>

<!-- seguada columna -->
<div class="col-lg-6">
<section class="panel corner-flip">
    <header class="panel-heading sm" data-color="theme-inverse">
            <h2>Datos referenciales</h2>          
    </header>
    <div class="panel-tools color" align="right" data-toolscolor="#4EA582">        
    </div>
    <div class="panel-body">
        <div  class="form-horizontal" data-collabel="3" data-alignlabel="center">
            <div class="form-group{{ $errors->has('pa_estado_civil') ? ' has-error' : '' }}">
                    <label class="control-label">Estado Civil</label>
                    
                    <div class="col-md-6">
                        <select id="pa_estado_civil"  name="pa_estado_civil"  class=" form-control show-menu-arrow" data-style="btn-theme-inverse" required>
                                <option selected="true" value="Null">Seleccionar</option>

                                <option value="Soltero">Soltero</option>
                                <option value="Casado" >Casado</option>
                                <option value="Viudo" >Viudo</option>
                        </select>
                        
                        @if ($errors->has('pa_estado_civil'))
                            <span class="help-block">
                                <strong>{{ $errors->first('pa_estado_civil') }}</strong>
                            </span>
                        @endif
                                    
                    </div>
            </div>      
            <div class="form-group{{ $errors->has('pa_telf') ? ' has-error' : '' }}">
                <label class="control-label">Telf/Cel:</label>
                <div>
                    <input id="pa_telf" name="pa_telf" type="text" value="{{ old('pa_telf') }}" class="form-control rounded"  maxlength="11" data-always-show="false" onkeypress="return soloNu(event)" onblur="limpia()">
                    @if ($errors->has('pa_telf'))
                        <span class="help-block">
                            <strong>{{ $errors->first('pa_telf') }}</strong>
                        </span>
                    @endif
                    <br>
                    <input id="pa_telfref" name="pa_telfref" type="text" value="{{ old('pa_telfref') }}" class="form-control rounded"  maxlength="11" data-always-show="false" placeholder="Telf/Cel de referencia" onkeypress="return soloNu(event)" onblur="limpia()">
                    @if ($errors->has('pa_telfref'))
                        <span class="help-block">
                            <strong>{{ $errors->first('pa_telfref') }}</strong>
                        </span>
                    @endif
                </div>
                 
                
            </div>
            <div class="form-group{{ $errors->has('pa_zona') ? ' has-error' : '' }}">
                    <label class="control-label">Zona:</label>
                    <div class="col-md-6">
                            <input id="pa_zona" name="pa_zona" value="{{ old('pa_zona') }}"  type="text" class="form-control rounded" maxlength="30" onkeypress="return soloLeNu(event)" onblur="limpia()" >
                        @if ($errors->has('pa_zona'))
                            <span class="help-block">
                                <strong>{{ $errors->first('pa_zona') }}</strong>
                            </span>
                        @endif
                    </div>
            </div>
            <div class="form-group{{ $errors->has('pa_domicilio') ? ' has-error' : '' }}">
                    <label class="control-label">Domicilio:</label>
                    <div>
                            <input id="pa_domicilio" name="pa_domicilio" value="{{ old('pa_domicilio') }}" type="text" class="form-control rounded" maxlength="200" onkeypress="return soloLeNu(event)" onblur="limpia()" >
                            @if ($errors->has('pa_domicilio'))
                            <span class="help-block">
                                <strong>{{ $errors->first('pa_domicilio') }}</strong>
                            </span>
                        @endif
                    </div>
            </div>
                          
            <footer class="panel-footer">
                <button type="submit" class="btn btn-theme">Registrar</button>
                <button type="reset" class="btn" onclick="clearForm(this.form);"> Limpiar Formulario</button>
            </footer>
        </id>    
    </div>
</section>
</form>
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
    $('#pa_estado_civil > option[value="{{ old('pa_estado_civil') }}"]').attr('selected', 'selected');
     


     //$('input:radio[name="usu_sexo"][value="{{ old('usu_sexo') }}"]').prop('checked', true);
     //$("form input:[name=usu_sexo]").filter('[value={{ old('usu_sexo') }}]').attr('checked', true);
      
   
});
</script>



@endsection
