<form  class="" method="POST" action="{{ route('updatePS') }}">
  {{ csrf_field() }}
  <input type="text" name="ps_id" value="{{$ps->id}} " hidden="">
<section class="panel corner-flip">
    <header class="panel-heading sm" data-color="theme-inverse">
            <h2><strong>Editar </strong>Personal de salud </h2>
    </header>
    <div class="panel-tools color" align="right" data-toolscolor="#4EA582">        
    </div>
    <div class="panel-body">                       
        <div   class="form-horizontal" data-collabel="4" data-alignlabel="center">          
            <div class="form-group{{ $errors->has('ps_ci') ? ' has-error' : '' }}">
                <label for="ps_ci" class="col-md-4 control-label">CI</label>
                <div class="col-md-6">
                    <input id="ps_ci" type="text" class="form-control rounded" name="ps_ci" value="{{ $ps->ps_ci }}"  maxlength="10" data-always-show="true" onkeypress="return soloNu(event)" onblur="limpia()">
                    @if ($errors->has('ps_ci'))
                        <span class="help-block">
                            <strong>{{ $errors->first('ps_ci') }}</strong>
                        </span>
                    @endif

                </div>
            </div>
            <div class="form-group{{ $errors->has('ps_nombre') ? ' has-error' : '' }}">
                    <label class="control-label">Nombre </label>
                    <div >
                            <input id="ps_nombre" name="ps_nombre" value="{{ $ps->ps_nombre }}" type="text" class="form-control rounded" maxlength="30" data-always-show="false" onkeypress="return soloLe(event)" onblur="limpia()" > 
                         @if ($errors->has('ps_nombre'))
                            <span class="help-block">
                                <strong>{{ $errors->first('ps_nombre') }}</strong>
                            </span>
                        @endif
                    </div>
            </div>
            <div class="form-group{{ $errors->has('ps_appaterno') ? ' has-error' : '' }}">
                    <label  class="control-label">Apellido paterno</label>
                    <div>
                            <input id="ps_appaterno" name="ps_appaterno" type="text" value="{{ $ps->ps_appaterno }}" class="form-control rounded" maxlength="30" data-always-show="false" onkeypress="return soloLe(event)" onblur="limpia()">
                         @if ($errors->has('ps_appaterno'))
                            <span class="help-block">
                                <strong>{{ $errors->first('ps_appaterno') }}</strong>
                            </span>
                        @endif
                    </div>
            </div>
            <div class="form-group{{ $errors->has('ps_apmaterno') ? ' has-error' : '' }}">
                    <label class="control-label">Apellido materno</label>
                    <div>
                            <input id="ps_apmaterno" name="ps_apmaterno" value="{{ $ps->ps_apmaterno }}" type="text" class="form-control rounded"  maxlength="30" data-always-show="false" onkeypress="return soloLe(event)" onblur="limpia()">
                        @if ($errors->has('ps_apmaterno'))
                            <span class="help-block">
                                <strong>{{ $errors->first('ps_apmaterno') }}</strong>
                            </span>
                        @endif
                    </div>
            </div>
            <div class="form-group{{ $errors->has('ps_sexo') ? ' has-error' : '' }}">
                    <label class="control-label">Sexo</label>
                    <div>
                            <ul class="iCheck"  data-color="red">
                        @if($ps->ps_sexo ==null)
                                    <li><input type="radio" name="ps_sexo" id="ps_sexo" value="masculino" required="" >
                                        <label>masculino</label>
                                    </li>
                                    <li><input  type="radio" name="ps_sexo" id="ps_sexo" value="femenino" required="">
                                        <label >femenino</label>
                                    </li>                            
                        @else
                            @if($ps->ps_sexo == "masculino")
                                    <li><input type="radio" name="ps_sexo" id="ps_sexo" value="masculino" checked="" required="" >
                                        <label>masculino</label>
                                    </li>
                                    <li><input  type="radio" name="ps_sexo" id="ps_sexo" value="femenino" required="">
                                        <label >femenino</label>
                                    </li>
                            @else
                                    <li><input type="radio" name="ps_sexo" id="ps_sexo" value="masculino"  required="" >
                                        <label>masculino</label>
                                    </li>
                                    <li><input  type="radio" name="ps_sexo" id="ps_sexo" value="femenino" checked="" required="">
                                        <label >femenino</label>
                                    </li>
                            @endif
                        @endif
                            </ul>
                    </div>
                        @if ($errors->has('ps_sexo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('ps_sexo') }}</strong>
                            </span>
                        @endif
            </div> 
            
            <div class="form-group{{ $errors->has('ps_telf') ? ' has-error' : '' }}">
                    <label class="control-label">Telf/cel</label>
                    <div class="col-md-6">
                            <input id="ps_telf" name="ps_telf" type="text" value="{{ $ps->ps_telf}}" class="form-control rounded" maxlength="10" data-always-show="true" onkeypress="return soloNu(event)" onblur="limpia()">
                        @if ($errors->has('ps_telf'))
                            <span class="help-block">
                                <strong>{{ $errors->first('ps_telf') }}</strong>
                            </span>
                        @endif
                    </div>
            </div>
            <div class="form-group{{ $errors->has('ps_tipo') ? ' has-error' : '' }}">
                <label class="control-label">Tipo de P.S.</label>
                <div class="row">
                    <div class="col-md-9">
                        <select id="ps_tipo"  name="ps_tipo"  class=" form-control show-menu-arrow" data-style="btn-theme-inverse">
                                <option selected="true" disabled="disabled">Seleccionar</option>

                                <option value="Medico">Medico</option>
                                <option value="Enfermeria" >Enfermeria</option>
                        </select>
                        @if ($errors->has('ps_tipo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('ps_tipo') }}</strong>
                            </span>
                        @endif 
                                            
                    </div>
                </div>
                
            </div>
            <div class="form-group{{ $errors->has('ps_area') ? ' has-error' : '' }}">
                <label class="control-label">Area medica</label>
                <div class="row">
                    <div class="col-md-9">
                        <select id="ps_area"  name="ps_area"  class=" form-control show-menu-arrow" data-style="btn-theme-inverse">
                                <option selected="true" disabled="disabled">Seleccionar</option>
                                @foreach($areas as $area)
                                <option value="{{$area->id}} ">{{$area->nombre}} </option>
                                @endforeach
                        </select>
                        @if ($errors->has('ps_area'))
                            <span class="help-block">
                                <strong>El area es un campo requeridow</strong>
                            </span>
                        @endif 
                    </div>
                </div>
            </div>      
            <div class="form-group{{ $errors->has('ps_especialidad') ? ' has-error' : '' }}">
                <label class="control-label">Especialidad medica</label>
                <div>
                    <input id="ps_especialidad" name="ps_especialidad" type="text" value="{{ $ps->ps_especialidad }}" class="form-control rounded"  maxlength="20" data-always-show="false" onkeypress="return soloLe(event)" onblur="limpia()">
                    @if ($errors->has('ps_especialidad'))
                        <span class="help-block">
                            <strong>La especialidad medica es requerida</strong>
                        </span>
                    @endif
                </div>
            </div>
            <footer class="panel-footer">
                <button type="submit" class="btn btn-theme">Editar</button>
                <button type="button" class="btn" ><a href="{{route('formPS')}} ">cancelar</a> </button>
            </footer>
                      
        </div>                   
    </div>   
</section>
</form>
