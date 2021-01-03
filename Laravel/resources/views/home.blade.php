@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">AREAS </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    ELIJA EL AREA A ACCEDER
                <div id ="opciones">
                    <table>
                        <tr>
                            <th>RECEPCION</th>
                            <th>INTERNACIONES</th>
                            <th>ADMINISTRACION</th>
                            <th>DIRECCION</th></tr>
                        <tr>
                            <td><img src="imagenes/ima/recepcion.png" /></td>
                            <td><img src="imagenes/ima/cajera.png" /></td>
                            <td><img src="imagenes/ima/enfermera.png" /></td>
                            <td><img src="imagenes/ima/administrador.png" /></td>
                        </tr>
                        <tr>
                            <td><div class="btn-sign"><a href="{{ route('recepcion.home')}} " class="login-window">INGRESAR</a>
                            <td><div class="btn-sign"><a href="" class="login-window">INGRESAR</a></div></td>
                            <td><div class="btn-sign"><a href="{{ route('adm.Home') }}" class="login-window">INGRESAR</a></div></td>
                            <td><div class="btn-sign"><a href="" class="login-window">INGRESAR</a></div></td>                   
                        </tr>
                    </table>
                </DIV>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
