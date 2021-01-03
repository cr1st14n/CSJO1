@extends('layouts.RecepLay')
@section('refUbi')
<ol class="breadcrumb">
    <li><a href="#">Administracion</a></li>
    <li class="active">Mis datos</li>
</ol>

@endsection

@section('content')



<div class="col-lg-6">
<form  class="" method="POST" action="{{ route('store_user_recepcion_update_date') }}">
  {{ csrf_field() }}
<section class="panel corner-flip">
    <header class="panel-heading sm" data-color="theme-inverse">
            <h2>Mis datos personales </h2>
    </header>
    <div class="panel-tools color" align="right" data-toolscolor="#4EA582">        
    </div>
    <div class="panel-body">                       
        <div   class="form-horizontal" data-collabel="3" data-alignlabel="center">          
            <div class="form-group{{ $errors->has('usu_ci') ? ' has-error' : '' }}">
                <label for="usu_ci" class="col-md-4 control-label">CI</label>
                <div class="col-md-6">
                    <input id="usu_ci" type="text" class="form-control rounded" name="usu_ci" value=" {{ Auth::user()->usu_ci }}"  maxlength="10" data-always-show="true" onkeypress="return soloNu(event)" onblur="limpia()">
                    @if ($errors->has('usu_ci'))
                        <span class="help-block">
                            <strong>{{ $errors->first('usu_ci') }}</strong>
                        </span>
                    @endif

                </div>
            </div>
            <div class="form-group{{ $errors->has('usu_nombre') ? ' has-error' : '' }}">
                    <label class="control-label">Nombre </label>
                    <div >
                            <input id="usu_nombre" name="usu_nombre" value=" {{ Auth::user()->usu_nombre }}" type="text" class="form-control rounded" maxlength="30" data-always-show="false" onkeypress="return soloLe(event)" onblur="limpia()"  > 
                         @if ($errors->has('usu_nombre'))
                            <span class="help-block">
                                <strong>{{ $errors->first('usu_nombre') }}</strong>
                            </span>
                        @endif
                    </div>
            </div>
            <div class="form-group{{ $errors->has('usu_appaterno') ? ' has-error' : '' }}">
                    <label  class="control-label">Apellido paterno</label>
                    <div>
                            <input id="usu_appaterno" name="usu_appaterno" type="text" value=" {{ Auth::user()->usu_appaterno }}" class="form-control rounded" maxlength="30" data-always-show="false" onkeypress="return soloLe(event)" onblur="limpia()">
                         @if ($errors->has('usu_appaterno'))
                            <span class="help-block">
                                <strong>{{ $errors->first('usu_appaterno') }}</strong>
                            </span>
                        @endif
                    </div>
            </div>
            <div class="form-group{{ $errors->has('usu_apmaterno') ? ' has-error' : '' }}">
                    <label class="control-label">Apellido materno</label>
                    <div>
                            <input id="usu_apmaterno" name="usu_apmaterno" value=" {{ Auth::user()->usu_apmaterno }}" type="text" class="form-control rounded"  maxlength="30" data-always-show="false" onkeypress="return soloLe(event)" onblur="limpia()">
                        @if ($errors->has('usu_apmaterno'))
                            <span class="help-block">
                                <strong>{{ $errors->first('usu_apmaterno') }}</strong>
                            </span>
                        @endif
                    </div>
            </div>
            <div class="form-group{{ $errors->has('usu_fechnac') ? ' has-error' : '' }}">
                    <label class="control-label">Fecha de nacimiento</label>
                    <div>
                            <input id="usu_fechnac" name="usu_fechnac" value="{{Auth::user()->usu_fechnac}}" type="date" class="form-control rounded"  maxlength="30" data-always-show="false" >
                        @if ($errors->has('usu_fechnac'))
                            <span class="help-block">
                                <strong>Error de sintaxis(dd-mm-YYYY) o exede a fecha actual</strong>
                            </span>
                        @endif

                    </div>
            </div>
            <div class="form-group{{ $errors->has('usu_sexo') ? ' has-error' : '' }}">
                    <label class="control-label">Sexo</label>
                    <div>
                            <ul class="iCheck"  data-color="green">
                        @if( Auth::user()->usu_sexo ==null)
                                    <li><input type="radio" name="usu_sexo" id="usu_sexo" value="masculino" required="" >
                                        <label>masculino</label>
                                    </li>
                                    <li><input  type="radio" name="usu_sexo" id="usu_sexo" value="femenino" required="">
                                        <label >femenino</label>
                                    </li>                            
                        @else
                            @if( Auth::user()->usu_sexo == "masculino")
                                    <li><input type="radio" name="usu_sexo" id="usu_sexo" value="masculino" checked="" required="" >
                                        <label>masculino</label>
                                    </li>
                                    <li><input  type="radio" name="usu_sexo" id="usu_sexo" value="femenino" required="">
                                        <label >femenino</label>
                                    </li>
                            @else
                                    <li><input type="radio" name="usu_sexo" id="usu_sexo" value="masculino"  required="" >
                                        <label>masculino</label>
                                    </li>
                                    <li><input  type="radio" name="usu_sexo" id="usu_sexo" value="femenino" checked="" required="">
                                        <label >femenino</label>
                                    </li>
                            @endif
                        @endif
                            </ul>
                    </div>
                        @if ($errors->has('usu_sexo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('usu_sexo') }}</strong>
                            </span>
                        @endif
            </div> 
            <div class="form-group{{ $errors->has('usu_zona') ? ' has-error' : '' }}">
                    <label class="control-label">Zona</label>
                    <div class="col-md-6">
                            <input id="usu_zona" name="usu_zona" value=" {{ Auth::user()->usu_zona }}"  type="text" class="form-control rounded" maxlength="30" onkeypress="return soloLeNu(event)" onblur="limpia()" >
                        @if ($errors->has('usu_zona'))
                            <span class="help-block">
                                <strong>{{ $errors->first('usu_zona') }}</strong>
                            </span>
                        @endif
                    </div>
            </div>
            <div class="form-group{{ $errors->has('usu_domicilio') ? ' has-error' : '' }}">
                    <label class="control-label">Domicilio</label>
                    <div>
                            <input id="usu_domicilio" name="usu_domicilio" value=" {{ Auth::user()->usu_domicilio }}" type="text" class="form-control rounded" maxlength="200" onkeypress="return soloLeNu(event)" onblur="limpia()">
                            @if ($errors->has('usu_domicilio'))
                            <span class="help-block">
                                <strong>{{ $errors->first('usu_domicilio') }}</strong>
                            </span>
                        @endif
                    </div>
            </div>
            <div class="form-group{{ $errors->has('usu_telf') ? ' has-error' : '' }}">
                    <label class="control-label">Telf/cel</label>
                    <div class="col-md-6">
                            <input id="usu_telf" name="usu_telf" type="text" value=" {{ Auth::user()->usu_telf }}" class="form-control rounded" maxlength="10" data-always-show="true" onkeypress="return soloNu(event)" onblur="limpia()">
                        @if ($errors->has('usu_telf'))
                            <span class="help-block">
                                <strong>{{ $errors->first('usu_telf') }}</strong>
                            </span>
                        @endif
                    </div>
            </div>
            <div class="form-group{{ $errors->has('usu_telfref') ? ' has-error' : '' }}">
                    <label class="control-label">Telf/cel <br> (Referencia)</label>
                    <div class="col-md-6">
                            <input id="usu_telfref" name="usu_telfref" value=" {{ Auth::user()->usu_telfref}}" type="text" class="form-control rounded" maxlength="10" data-always-show="true" onkeypress="return soloNu(event)" onblur="limpia()">
                        @if ($errors->has('usu_telfref'))
                            <span class="help-block">
                                <strong>{{ $errors->first('usu_telfref') }}</strong>
                            </span>
                        @endif
                    </div>
            </div>
            <footer class="panel-footer">
                <button type="submit" class="btn btn-theme">Actualizar mis datos</button>
            </footer>            
        </div>                   
    </div>   
</section>
</form>

</div>

<!-- seguada columna -->
<div class="col-lg-6">
<form  class="" method="POST" action="{{ route('store_user_recepcion_update_email') }}">
  {{ csrf_field() }}

<section class="panel corner-flip">
    <header class="panel-heading sm" data-color="theme-inverse">
            <h2>Cambiar correo o contraseña </h2>          
    </header>
    <div class="panel-tools color" align="right" data-toolscolor="#4EA582">        
    </div>
    <div class="panel-body">
        <div  class="form-horizontal" data-collabel="3" data-alignlabel="center">
            
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">Correo Electronico</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control rounded" name="email" value=" {{ Auth::user()->email }} " maxlength="100" data-always-show="false">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Contraseña</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control rounded" name="password" data-always-show="true" maxlength="15" onkeypress="return soloLeNu(event)" onblur="limpia()">

                        
                    </div>
             </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password-confirm" class="col-md-4 control-label">Confirmar Contraseña</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control rounded" name="password_confirmation" data-always-show="true" maxlength="15" onkeypress="return soloLeNu(event)" onblur="limpia()">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>               
            <footer class="panel-footer">
                <button type="submit" class="btn btn-theme">Actualizar correo/contraseña</button>
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
    $('#usu_area > option[value=""]').attr('selected', 'selected');
     //$('input:radio[name="usu_sexo"][value="{{ old('usu_sexo') }}"]').prop('checked', true);
     //$("form input:[name=usu_sexo]").filter('[value={{ old('usu_sexo') }}]').attr('checked', true);
      
   
});
</script>



@endsection
