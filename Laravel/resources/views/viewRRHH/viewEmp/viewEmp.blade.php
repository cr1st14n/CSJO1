@extends('layouts.admLay2')
@section('head1')
@endsection
@section('refUbi')
<ol class="breadcrumb">
    <li><a href="#">RRHH</a></li>
    <li class="active">Personal</li>
</ol>
@endsection
@section('content')
<section class="panel">
    <header class="panel-heading">
        <h2><strong>Registro</strong> Personal </h2>
    </header>
    <div class="panel-body">
        <div class="panel-tools fully color" align="left" data-toolscolor="#6CC3A0">
            <button class="btn btn-theme-inverse btn-transparent btn-sm" onclick="showModalCreateUser()"><i class="fa fa-user"></i> Agregar</button>
            <button class="btn btn-theme-inverse btn-transparent btn-sm" onclick="listTodosEmp()"><i class="fa fa-users"></i> listar todos </button>
            <!-- <button class="btn btn-theme-inverse btn-transparent btn-sm">listar activos </button>
            <button class="btn btn-theme-inverse btn-transparent btn-sm">listar inactivos </button> -->
        </div>
        <div class="table-responsive">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped" >
                <thead>
                    <tr>
                        <th>CI</th>
                        <th>Nombre</th>
                        <th>Profesión</th>
                        <th>Area </th>
                        <th>Modulo sistema</th>
                        <th width="22%">Action</th>
                    </tr>
                </thead>
                <tbody align="center" id="tableUser">
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- modal crud User -->
<div id="md-createUser" class="modal fade md-stickTop " tabindex="-1" data-width="800">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h3>Datos Personales</h3>
        <h6>(Los campos con * son obligatorios)</h6>
    </div>
    <div class="modal-body">
        <div class="row">
            <form class="form-horizontal" data-collabel="6" data-alignlabel="rigth" id="formuladio1">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label">CI*:</label>
                        <div>
                            <input type="number" min="0" class="form-control rounded" placeholder="# de C.I." id="createUserCi" onkeyup="validar('createUserCi')" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Nombre*:</label>
                        <div>
                            <input type="text" class="form-control rounded" id="nombre" placeholder="Nombre completo" pattern="[A-ZñÑa-z ]+" onkeyup="validar('nombre')" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Apellidos*:</label>
                        <div>
                            <input type="text" class="form-control rounded" id="apellido1" placeholder="Apellido paterno" pattern="[A-ZñÑa-z ]+" onkeyup="validar('apellido1')" required autocomplete="off"><br>
                            <input type="text" class="form-control rounded" id="apellido2" placeholder="Apellido materno" pattern="[A-ZñÑa-z ]+" onkeyup="validar('apellido2')" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="inputTwo">Fecha Nacimiento*:</label>
                        <div>
                            <input type="date" class="form-control rounded" id="fechaNacimiento" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Pais de nacimiento*:</label>
                        <div>
                            <input type="text" class="form-control rounded" id="paisNacimiento" pattern="[A-ZñÑa-z ]+" onkeyup="validar('paisNacimiento')" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Departamento nacimiento*:</label>
                        <div>
                            <input type="text" class="form-control rounded" id="depNacimiento" pattern="[A-ZñÑa-z ]+" onkeyup="validar('depNacimiento')" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tipo de Sangre:</label>
                        <div>
                            <input type="text" class="form-control rounded" id="tipoSangre" onkeyup="validar('tipoSangre')" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Sexo</label>
                        <div>
                            <label class="radio-inline">
                                <input type="radio" name="sexo" value="masculino" checked>
                                Masculino </label>
                            <label class="radio-inline">
                                <input type="radio" name="sexo" value="femenino">
                                Femenino </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label">Correo electronico*</label>
                        <div>
                            <input class="form-control" type="email" id="email" placeholder="nombre@gmail.com" onkeyup="validar('email')" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Estado Civil</label>
                        <div>
                            <select class="form-control" id="estadoCivil" required>
                                <option value="soltero">Soltero</option>
                                <option value="casado">Casado</option>
                                <option value="viudo">Viudo</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Telf / Cel*</label>
                        <div>
                            <div class="input-icon"> <i class="fa fa-map-marker ico"></i>
                                <input class="form-control " type="text" pattern="[0-9]+" id="telf" maxlength="10" required onkeyup="validar('telf')" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Telf / Cel Referencia</label>
                        <div>
                            <div class="input-icon"> <i class="fa fa-user ico"></i>
                                <input class="form-control " type="text" id="telfRef" pattern="[0-9]+" maxlength="10" onkeyup="validar('telfRef')" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Zona donde sufragia*:</label>
                        <div>
                            <div class="input-icon right"> <i class="fa fa-keyboard-o ico "></i>
                                <input class="form-control " type="text" placeholder="Zona Especifica donde sufragia" pattern="[A-ZñÑa-z0-9 ]+" id="zonaSufragio" onkeyup="validar('zonaSufragio')" required autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Zona donde recide*:</label>
                        <div>
                            <div class="input-icon right"> <i class="fa fa-keyboard-o ico "></i>
                                <input class="form-control " type="text" placeholder="Zona Especifica donde recide" pattern="[A-ZñÑa-z0-9# ]+" id="zona" onkeyup="validar('zona')" required autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Domicilio</label>
                        <div>
                            <input class="form-control" type="text" placeholder="Direccion del domicilio" pattern="[A-ZÑña-z0-9# ]+" id="domicilio" onkeyup="validar('domicilio')" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group offset">
                        <div>
                            <button type="submit" class="btn btn-theme-inverse">Continuar registro</button>
                            <!-- <button type="button" class="btn btn-theme-inverse" onclick="createUser(1)" >Continuar registro</button> -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="md-createUser2" class="modal fade md-stickTop" tabindex="-1" data-width="800">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h3>Datos Profecion / institucionales</h3>
    </div>
    <div class="modal-body">
        <div class="row">
            <form class="form-horizontal" data-collabel="6" data-alignlabel="right" id="formulario2">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label">Fecha de Contratacion*</label>
                        <div>
                            <input type="date" class="form-control rounded" id="fechaContratacion" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tipo de Contrato:</label>
                        <div>
                            <select class="form-control" name="" id="contrato">
                                <option value="indefinido">Indefinido</option>
                                <option value="eventual">Eventual</option>
                                <option value="verbal">Verbal</option>
                                <option value="estudiante">Estudiante (Segun Convenio)</option>
                                <option value="voluntario">Voluntario</option>
                                <option value="otro">Otros</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Titulo y Profecion*:</label>
                        <div>
                            <input type="text" class="form-control rounded" id="tituloOb" placeholder="Titulo obtenido" pattern="[A-ZñÑa-z ]+" required><br>
                            <input type="text" class="form-control rounded" id="profecionOb" placeholder="Profecion obtenida" pattern="[A-ZñÑa-z ]+">
                        </div>
                    </div>
                    <hr>
                    <h5 align="center"><span>Area y cargo designado dentro la institucion</span></h5><br>
                    <div class="form-group">
                        <label class="control-label">Area Designada:</label>
                        <div>
                            <select class="form-control" name="" id="areaDesignada">
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="inputTwo">Cargo a designar:</label>
                        <div>
                            <select class="form-control" name="" id="cargo">
                                <option value="encargado">Encargado</option>
                                <option value="operador" selected>Operador</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <h5 align="center"><span>Detalle de acceso al sistema WEB CSJO</span></h5><br>
                        <label class="control-label">Modulo del sistema Web</label>
                        <div>
                            <select id="accModSis" class="form-control">
                                <option value="Administracion">Administracion</option>
                                <option value="Recepcion">Recepcion</option>
                                <option value="Caja">Caja</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Acceso al sistema:</label>
                        <div>
                            <label class="radio-inline">
                                <input type="radio" name="accesoSis" value="1" checked>
                                Si </label>
                            <label class="radio-inline">
                                <input type="radio" name="accesoSis" value="0">
                                No </label>
                        </div>
                    </div>
                    <hr>
                    <h4>Informacion de la entidad de seguro a corto plazo </h4><br>
                    <div class="form-group">
                        <label class="control-label">Nombre de la institucion:</label>
                        <div>
                            <input type="text" class="form-control rounded" id="seguroNombreInstitucionCP" pattern="[A-ZÑña-z0-9 ]+" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Codigo de asegurado:</label>
                        <div>
                            <input type="number" class="form-control rounded" id="codSeguroCP" pattern="[A-ZÑña-z0-9 ]+" autocapitalize="off">
                        </div>
                    </div>
                    <h4>Informacion de la entidad de seguro de largo plazo </h4><br>
                    <div class="form-group">
                        <label class="control-label">Nombre de la institucion:</label>
                        <div>
                            <input type="text" class="form-control rounded" id="seguroNombreInstitucionLP" pattern="[A-ZÑña-z0-9 ]+" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label"># NUA:</label>
                        <div>
                            <input type="number" class="form-control rounded" id="numNua" pattern="[A-ZÑña-z0-9 ]+" autocapitalize="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label"># CUA:</label>
                        <div>
                            <input type="number" class="form-control rounded" id="numCua" pattern="[A-ZÑña-z0-9 ]+" autocapitalize="off">
                        </div>
                    </div>
                </div>
                <button class="btn btn-block btn-sm btn-theme-inverse" type="submit">Concluir Registro</button>
            </form>
        </div>
    </div>
</div>
<!-- show modal datos del usuario -->
<div id="md-stack1" class="modal fade md-stickTop" tabindex="-1" data-width="800">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h3>Datos del Empleado</h3>
    </div>
    <input type="number" id="usu_id" hidden>
    <input type="number" id="usu_id_Contrato" hidden>
    <input type="number" id="usu_id_datIns" hidden>
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-6">
                <h3>Datos Personales</h3><br>
                <p id="datosEmp"></p>
                <div id="datosEditButon"></div>
                <!-- <button type="button" class="btn btn-theme" onclick="showEditDat1User()">Actualizar</button> -->
            </div>
            <div class="col-lg-6">
                <h3>Datos Institucionales</h3><br>
                <p id="datosInst"></p>
                <id id="datosInstEditButon"></id>
                <!-- <button type="button" class="btn btn-theme" onclick="showEditDat2User()">Actualizar</button> -->
            </div>
        </div>
    </div>
</div>
<div id="md-editDatUser" class="modal fade md-stickTop" tabindex="-1" data-width="800">
    <div class="modal-header">
        <button type="button" id="btn-editDatuser-close" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h3>Actualizar datos</h3>
    </div>
    <div class="modal-body">
        <div class="row">
            <form class="form-horizontal" data-collabel="6" data-alignlabel="rigth" id="formulario1Up">
                <input type="text" id="idEdituser" hidden>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label">CI*:</label>
                        <div>
                            <input type="number" min="0" class="form-control rounded" placeholder="# de C.I." id="createUserCiUp" onkeyup="validar('createUserCi')" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Nombre*:</label>
                        <div>
                            <input type="text" class="form-control rounded" id="nombreUp" placeholder="Nombre completo" pattern="[A-ZñÑa-z ]+" onkeyup="validar('nombre')" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Apellidos*:</label>
                        <div>
                            <input type="text" class="form-control rounded" id="apellido1Up" placeholder="Apellido paterno" pattern="[A-ZñÑa-z ]+" onkeyup="validar('apellido1')" required autocomplete="off"><br>
                            <input type="text" class="form-control rounded" id="apellido2Up" placeholder="Apellido materno" pattern="[A-ZñÑa-z ]+" onkeyup="validar('apellido2')" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="inputTwo">Fecha Nacimiento*:</label>
                        <div>
                            <input type="date" class="form-control rounded" id="fechaNacimientoUp" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Pais de nacimiento*:</label>
                        <div>
                            <input type="text" class="form-control rounded" id="paisNacimientoUp" pattern="[A-ZñÑa-z ]+" onkeyup="validar('paisNacimiento')" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Departamento nacimiento*:</label>
                        <div>
                            <input type="text" class="form-control rounded" id="depNacimientoUp" pattern="[A-ZñÑa-z ]+" onkeyup="validar('depNacimiento')" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tipo de Sangre:</label>
                        <div>
                            <input type="text" class="form-control rounded" id="tipoSangreUp" onkeyup="validar('tipoSangre')" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Sexo</label>
                        <div>
                            <label class="radio-inline">
                                <input type="radio" name="sexoUp" id="sexo1Up" value="masculino" checked>
                                Masculino </label>
                            <label class="radio-inline">
                                <input type="radio" name="sexoUp" id="sexo2Up" value="femenino">
                                Femenino </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label">Correo electronico*</label>
                        <div>
                            <input class="form-control" type="email" id="emailUp" placeholder="nombre@gmail.com" onkeyup="validar('email')" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Estado Civil</label>
                        <div>
                            <select class="form-control" id="estadoCivilUp" required>
                                <option value="soltero">Soltero</option>
                                <option value="casado">Casado</option>
                                <option value="viudo">Viudo</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Telf / Cel*</label>
                        <div>
                            <div class="input-icon"> <i class="fa fa-map-marker ico"></i>
                                <input class="form-control " type="text" pattern="[0-9]+" id="telfUp" maxlength="10" required onkeyup="validar('telf')" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Telf / Cel Referencia</label>
                        <div>
                            <div class="input-icon"> <i class="fa fa-user ico"></i>
                                <input class="form-control " type="text" id="telfRefUp" pattern="[0-9]+" maxlength="10" onkeyup="validar('telfRef')" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Zona donde sufragia*:</label>
                        <div>
                            <div class="input-icon right"> <i class="fa fa-keyboard-o ico "></i>
                                <input class="form-control " type="text" placeholder="Zona Especifica donde sufragia" pattern="[A-ZñÑa-z0-9 ]+" id="zonaSufragioUp" onkeyup="validar('zonaSufragio')" required autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Zona donde recide*:</label>
                        <div>
                            <div class="input-icon right"> <i class="fa fa-keyboard-o ico "></i>
                                <input class="form-control " type="text" placeholder="Zona Especifica donde recide" pattern="[A-ZñÑa-z0-9# ]+" id="zonaUp" onkeyup="validar('zona')" required autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Domicilio</label>
                        <div>
                            <input class="form-control" type="text" placeholder="Direccion del domicilio" pattern="[A-ZÑña-z0-9# ]+" id="domicilioUp" onkeyup="validar('domicilio')" autocomplete="off">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger btn-block">Actualizar </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="md-editDatInstUser" class="modal fade md-stickTop" tabindex="-1" data-width="800">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="md-editDatInstUser_btn_close" ><i class="fa fa-times"></i></button>
        <h3> Actualizar Datos profecionales / institucionales</h3>
    </div>
    <div class="modal-body">
        <div class="row">
            <form class="form-horizontal" data-collabel="6" data-alignlabel="right" id="formulario2Up">
                <input type="text" id="formulario2Up_id_usu" hidden>
                <input type="text" id="formulario2Up_id_contrato" hidden>
                <input type="text" id="formulario2Up_id_datosIns" hidden>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label">Fecha de Contratacion*</label>
                        <div>
                            <input type="date" class="form-control rounded" id="fechaContratacionUp" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tipo de Contrato:</label>
                        <div>
                            <select class="form-control"  id="contratoUp">
                                <option value="indefinido">Indefinido</option>
                                <option value="eventual">Eventual</option>
                                <option value="verbal">Verbal</option>
                                <option value="estudiante">Estudiante (Segun Convenio)</option>
                                <option value="voluntario">Voluntario</option>
                                <option value="otro">Otros</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Titulo y Profecion*:</label>
                        <div>
                            <input type="text" class="form-control rounded" id="tituloObUp" placeholder="Titulo obtenido" pattern="[A-ZñÑa-z ]+" required><br>
                            <input type="text" class="form-control rounded" id="profecionObUP" placeholder="Profecion obtenida" pattern="[A-ZñÑa-z ]+">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="control-label">Area Designada:</label>
                        <div>
                            <select class="form-control" name="" id="areaDesignadaUP">
                                <option value="administracion">Administracion</option>
                                <option value="contabilidad">Contabilidad</option>
                                <option value="recepcion">Recepcion</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="inputTwo">Cargo a designar:</label>
                        <div>
                            <select class="form-control"   id="cargoUP">
                                <option value="encargado">Encargado</option>
                                <option value="operador">Operador</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="control-label">Modulo del sistema Web</label>
                        <div>
                            <select id="accModSisUp" class="form-control">
                                <option value="Administracion">Administracion</option>
                                <option value="Recepcion">Recepcion</option>
                                <option value="Caja">Caja</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Acceso al sistema:</label>
                        <div>
                            <label class="radio-inline">
                                <input type="radio" name="accesoSisUp" id="accesoSiUp" value="1">
                                Si </label>
                            <label class="radio-inline">
                                <input type="radio" name="accesoSisUp" id="accesoNoUp" value="0">
                                No </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">

                    <h4>Informacion de la entidad de seguro a corto plazo </h4><br>
                    <div class="form-group">
                        <label class="control-label">Nombre de la institucion:</label>
                        <div>
                            <input type="text" class="form-control rounded" id="seguroNombreInstitucionCPUp" pattern="[A-ZÑña-z0-9 ]+" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Codigo de asegurado:</label>
                        <div>
                            <input type="number" class="form-control rounded" id="codSeguroCPUp" pattern="[A-ZÑña-z0-9 ]+" autocapitalize="off">
                        </div>
                    </div>
                    <hr>
                    <h4>Informacion de la entidad de seguro de largo plazo </h4><br>
                    <div class="form-group">
                        <label class="control-label">Nombre de la institucion:</label>
                        <div>
                            <input type="text" class="form-control rounded" id="seguroNombreInstitucionLPUp" pattern="[A-ZÑña-z0-9 ]+" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label"># NUA:</label>
                        <div>
                            <input type="number" class="form-control rounded" id="numNuaUp" pattern="[A-ZÑña-z0-9 ]+" autocapitalize="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label"># CUA:</label>
                        <div>
                            <input type="number" class="form-control rounded" id="numCuaUp" pattern="[A-ZÑña-z0-9 ]+" autocapitalize="off">
                        </div>
                    </div>
                </div>
                <div id="btn-submit-formulario2Up">

                </div>
                <button class="btn btn-block btn-sm btn-danger" type="submit">Actualizar</button>
            </form>
        </div>
    </div>
</div>



<!-- modal crud Documentos de usuario -->
<div id="md-DocUser" class="modal fade md-stickTop" tabindex="-1" data-width="800">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h4 class="modal-title">Documentos presentados</h4>
    </div>
    <!-- //modal-header-->
    <div class="modal-body">
        <p></p>
        <div class="row">
            <form class="form-horizontal" data-collabel="4" data-label="color">
                <div class="form-group">
                    <label class="control-label">Documentos personales</label>
                    <div>
                        <div class="row">
                            <div class="col-sm-6">
                                <ul class="iCheck" data-color="green">
                                    <li>
                                        <input type="checkbox">
                                        <label>Documento 1</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" checked>
                                        <label>Documento 2</label>
                                    </li>
                                    <li>
                                        <input type="checkbox">
                                        <label>Documento 3</label>
                                    </li>
                                    <li>
                                        <input type="checkbox">
                                        <label>Documento 4</label>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul class="iCheck" data-color="green">
                                    <li>
                                        <input type="checkbox">
                                        <label>Documento 1</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" checked>
                                        <label>Documento 2</label>
                                    </li>
                                    <li>
                                        <input type="checkbox">
                                        <label>Documento 3</label>
                                    </li>
                                    <li>
                                        <input type="checkbox">
                                        <label>Documento 4</label>
                                    </li>
                                </ul>
                            </div><!-- //col-sm-6 -->
                        </div><!-- //row-->
                    </div>
                </div><!-- //form-group-->

                <div class="form-group">
                    <label class="control-label">Documentos academicos</label>
                    <div>
                        <div class="row">
                            <div class="col-sm-6">
                                <ul class="iCheck" data-style="square" data-color="green">
                                    <li>
                                        <input type="checkbox">
                                        <label>Documento 1</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" checked>
                                        <label>Documento 2</label>
                                    </li>
                                    <li>
                                        <input type="checkbox">
                                        <label>Documento 3</label>
                                    </li>
                                    <li>
                                        <input type="checkbox">
                                        <label>Documento 4</label>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul class="iCheck" data-style="square" data-color="green">
                                    <li>
                                        <input type="checkbox">
                                        <label>Documento 1</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" checked>
                                        <label>Documento 2</label>
                                    </li>
                                    <li>
                                        <input type="checkbox">
                                        <label>Documento 3</label>
                                    </li>
                                    <li>
                                        <input type="checkbox">
                                        <label>Documento 4</label>
                                    </li>
                                </ul>
                            </div><!-- //col-sm-6 -->
                        </div><!-- //row-->
                    </div>
                </div><!-- //form-group-->
            </form>
        </div>
    </div>
    <!-- //modal-body-->
</div>
<!-- modal funciones de registro de vacaciones -->
<div id="md-UserVacaciones" class="modal fade md-stickTop" tabindex="-1" data-width="1000">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h3>Registro vacaciones</h3>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-4">
                <h4>Registrar vaciones:</h4><br>
                <h5> Fecha inicio Contrato: <span id="usVaContrato"></span><br>
                    Dias disponibles: <span id="userVacacinesDisponibles"></span>
                </h5>
                <br>
                <input type="text" name="" id="usuVacacId" required hidden>
                <form class="form-horizontal" data-collabel="4" data-alignlabel="left" id="formCreateVacacion">
                    <div class="form-group">
                        <label for="form" class="control-label col-md-4">Doc. respaldo</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" id="docRespaldo" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="form" class="control-label col-md-4">Inicio</label>
                        <div class="col-md-8">
                            <input type="date" class="form-control" id="date1UsuVac" onkeyup="validar('date1UsuVac')" oninput="calcuarDias(1)" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="form" class="control-label col-md-4">Fin</label>
                        <div class="col-md-8">
                            <input type="date" class="form-control" id="date2UsuVac" onkeyup="validar('date2UsuVac')" oninput="calcuarDias(1)" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-4">Dias </label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="text" class="form-control" id="vacDayUser" required>
                                <span class="input-group-btn">
                                    <button class="btn btn-theme-inverse btn-transparent" type="button" id="calculateVacacinUser">Calcular dias</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="form" class="control-label col-md-4">observacion</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="ObservacionVacacion" required>
                        </div>
                    </div>
                    <button class="btn btn-theme-inverse btn-transparent"><i class="glyphicon glyphicon-print"></i></button>
                    <button type="submit" class="btn btn-theme-inverse">Registrar Vacaciones</button>
                </form>
            </div>
            <div class="col-lg-5">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th># Doc</th>
                                <th>Fecha(s)</th>
                                <th>Dias</th>
                                <th>--//--</th>
                            </tr>
                        </thead>
                        <tbody id="listVacacionesUser" align="center">
                            <tr>
                                <td>-----//-----</td>
                                <td></td>
                                <td></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-3">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Año </th>
                            <th>Dias</th>
                        </tr>
                    </thead>
                    <tbody id="listAñosVacaUser">
                        <tr>
                            <td>2018-08-08</td>
                            <td>5</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="md-UserVacacionesEdit" class="modal fade md-stickTop" tabindex="-1" data-width="300">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id="btn-close-md-UserVacacionesEdit" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h3>Editar Vacacion</h3>
    </div>
    <!-- <input type="text" hidden id="usuVacacId" required hidden > -->
    <form class="form-horizontal" data-collabel="4" data-alignlabel="left" id="formEditVacacion">
        <input type="text" id="formEditVacacion_id" hidden>
        <div class="modal-body">
            <h4>Registrar vaciones:</h4>
            <div class="form-group">
                <label for="form" class="control-label col-md-4">Doc. respaldo</label>
                <div class="col-md-8">
                    <input type="number" class="form-control" id="docRespaldo_Up" required>
                </div>
            </div>
            <div class="form-group">
                <label for="form" class="control-label col-md-4">Inicio</label>
                <div class="col-md-8">
                    <input type="date" class="form-control" id="date1UsuVac_Up" onkeyup="validar('date1UsuVac_Up')" oninput="calcuarDias(2)" required>
                </div>
            </div>
            <div class="form-group">
                <label for="form" class="control-label col-md-4">Fin</label>
                <div class="col-md-8">
                    <input type="date" class="form-control" id="date2UsuVac_Up" onkeyup="validar('date2UsuVac')" oninput="calcuarDias(2)" required>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-4">Dias </label>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" class="form-control" id="vacDayUser_Up" required>
                        <span class="input-group-btn">
                            <button class="btn btn-theme-inverse btn-transparent" type="button" id="calculateVacacinUser1">Calcular dias</button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="form" class="control-label col-md-4">observacion</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="vacOb_Up" required>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-theme-inverse btn-transparent"><i class="glyphicon glyphicon-print"></i></button>
            <button type="submit" class="btn btn-danger">Actualizar</button>
        </div>
    </form>

</div>
<div id="md-vacacion-delete" class="modal fade md-stickTop" tabindex="-1" data-width="350">
    <div class="modal-header bg-inverse bd-inverse-darken">
        <button type="button" class="close" data-dismiss="modal" id="btn-md-vacacion-delete" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h4 class="modal-title">Confirmar Solicitud?</h4>
    </div>
    <!-- //modal-header-->
    <div class="modal-body">
        <label id="message-delete"></label>
        <div class="panel-body align-xs-center " id="btn-vacacion-delete">
        </div>
    </div>
    <!-- //modal-body-->
</div>
<!-- modal funciones para FALTAS Y PERMISOS -->
<div id="md-UserFalPer" class="modal fade md-stickTop" tabindex="-1" data-width="800">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h3>Registro de Faltas y permisos</h3>
    </div>
    <input type="text" id="codUsu1" hidden>
    <div class="modal-body">
        <div class="col-lg-6">
            <button class="btn btn-default" onclick="listPermisos()">Permisos</button>
            <button class="btn btn-default" onclick="listFaltas()">Faltas</button>
            <button class="btn btn-default" onclick="listCambioTurno()">Cambios de turno</button>
        </div>
        <div class="col-lg-6" id="sectorBottonFaltasPermisos">
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead id="head-listFaltasPermisos">
                    <tr>
                        <th>Fecha(s)</th>
                        <th>Dias</th>
                        <th>Tipo</th>
                        <th>Descripcion</th>
                        <th>--//--</th>
                    </tr>
                </thead>
                <tbody id="listFaltasPermisos">
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- modal delete user -->
<div id="md-user-delete" class="modal fade md-stickTop" tabindex="-1" data-width="350">
    <div class="modal-header bg-inverse bd-inverse-darken">
        <button type="button" class="close" data-dismiss="modal" id="btn-md-user-delete" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h4 class="modal-title">Confirmar Solicitud?</h4>
    </div>
    <!-- //modal-header-->
    <div class="modal-body">
        <label id="message-delete"></label>
        <div class="panel-body align-xs-center " id="btn-user-delete">
        </div>
    </div>
    <!-- //modal-body-->
</div>
<!-- MODAL PERMISOS -->

<div id="md-permisos1" class="modal fade md-flipHor" tabindex="-1" data-width="400">
    <div class="modal-header">
        <button type="button" class="close" id="btn-md-permisos1" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h3>Formulario de solicitud de permiso</h3>
    </div>
    <div class="modal-body">
        <section class="panel">
            <div class="panel-body">
                <form class="form-horizontal" data-collabel="3" data-alignlabel="left" id="formCreatePermiso">
                    <div class="form-group">
                        <label class="control-label">Motivo</label>
                        <div>
                            <input type="text" class="form-control rounded" required pattern="[A-ZñÑa-z ]+" id="motivo" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Remplazo</label>
                        <div>
                            <input type="text" class="form-control rounded" autocomplete="off" required pattern="[A-ZñÑa-z ]+" id="remplazo" autocomplete="off">
                            <!-- <span class="help-block">A block of <a href="#">help text.</a> <i class="fa fa-info"></i></span> -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="inputTwo">Fecha de Solicitud</label>
                        <div>
                            <input type="date" class="form-control rounded" autocomplete="off" required id="fechaSolicitud">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Fecha a solicitar Permiso</label>
                        <div>
                            <input type="date" class="form-control rounded" autocomplete="off" required id="fechaPermiso">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Hora inicio</label>
                        <div class="input-icon"> <i class="fa fa-clock-o ico"></i>
                            <input type="time" class="form-control rounded" autocomplete="off" id="horaInicio">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Hora final</label>
                        <div>
                            <div class="input-icon"> <i class="fa fa-clock-o ico"></i>
                                <input type="time" class="form-control rounded" autocomplete="off" id="horaFinal">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Cod Documento Respaldo</label>
                        <div>
                            <div class="input-icon right"> <i class="fa fa-keyboard-o ico "></i>
                                <input type="number" class="form-control rounded" autocomplete="off" required pattern="[0-9 ]+" id="codRespaldoDoc">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger">Registrar</button>
                </form>
            </div>
        </section>
    </div>
</div>
<div id="md-permisos2" class="modal fade md-flipHor" tabindex="-1" data-width="400">
    <div class="modal-header">
        <button type="button" class="close" id="btn-md-permisos1-close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h3>Actualizar solicitud de permiso</h3>
    </div>
    <div class="modal-body">
        <section class="panel">
            <div class="panel-body">
                <form class="form-horizontal" data-collabel="4" data-alignlabel="left" id="formEditPermiso">
                    <input type="text" id="CodPermisoUp" hidden>
                    <div class="form-group">
                        <label class="control-label">Motivo</label>
                        <div>
                            <input type="text" class="form-control rounded" required pattern="[A-ZñÑa-z ]+" id="motivoUp" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Remplazo</label>
                        <div>
                            <input type="text" class="form-control rounded" autocomplete="off" required pattern="[A-ZñÑa-z ]+" id="remplazoUp" autocomplete="off">
                            <!-- <span class="help-block">A block of <a href="#">help text.</a> <i class="fa fa-info"></i></span> -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="inputTwo">Fecha de Solicitud</label>
                        <div>
                            <input type="date" class="form-control rounded" autocomplete="off" required id="fechaSolicitudUp">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Fecha a solicitar Permiso</label>
                        <div>
                            <input type="date" class="form-control rounded" autocomplete="off" required id="fechaPermisoUp">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Hora inicio</label>
                        <div class="input-icon"> <i class="fa fa-clock-o ico"></i>
                            <input type="time" class="form-control rounded" autocomplete="off" id="horaInicioUp">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Hora final</label>
                        <div>
                            <div class="input-icon"> <i class="fa fa-clock-o ico"></i>
                                <input type="time" class="form-control rounded" autocomplete="off" id="horaFinalUp">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Cod Documento Respaldo</label>
                        <div>
                            <div class="input-icon right"> <i class="fa fa-keyboard-o ico "></i>
                                <input type="number" class="form-control rounded" autocomplete="off" required pattern="[0-9 ]+" id="codRespaldoDocUp">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger">Actualizar</button>
                </form>
            </div>
        </section>
    </div>
</div>
<div id="md-faltaCreate" class="modal fade md-flipHor" tabindex="-1" data-width="400">
    <div class="modal-header">
        <button type="button" class="close" id="btn-md-falta1-close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h3>Registrar Falta</h3>
    </div>
    <div class="modal-body">
        <section class="panel">
            <div class="panel-body">
                <form class="form-horizontal" data-collabel="4" data-alignlabel="left" id="formCreateFalta">
                    <input type="text" id="CodPermiso" hidden>
                    <div class="form-group">
                        <label class="control-label">Motivo</label>
                        <div>
                            <input type="text" class="form-control rounded" required pattern="[A-ZñÑa-z ]+" id="FaltaMotivo" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Fecha</label>
                        <div>
                            <input type="date" class="form-control rounded" autocomplete="off" required id="FaltaFecha" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Horario</label>
                        <div>
                            <select name="" id="FaltaHorario" class="form-control rounded">
                                <option value="mañana">mañana</option>
                                <option value="tarde">Tarde</option>
                                <option value="noche">Noche</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Cod documento respaldo</label>
                        <div>
                            <input type="text" class="form-control rounded" required pattern="[0-9 ]+" id="FaltaCodDoc" autocomplete="off">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger">Registrar</button>
                </form>
            </div>
        </section>
    </div>
</div>
<div id="md-faltaEdit" class="modal fade md-flipHor" tabindex="-1" data-width="400">
    <div class="modal-header">
        <button type="button" class="close" id="btn-md-falta2-close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h3>Registrar Falta</h3>
    </div>
    <div class="modal-body">
        <section class="panel">
            <div class="panel-body">
                <form class="form-horizontal" data-collabel="4" data-alignlabel="left" id="formEditFalta">
                    <input type="text" id="CodfaltaUp" hidden>
                    <div class="form-group">
                        <label class="control-label">Motivo</label>
                        <div>
                            <input type="text" class="form-control rounded" required pattern="[A-ZñÑa-z ]+" id="FaltaMotivoUp" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Fecha</label>
                        <div>
                            <input type="date" class="form-control rounded" autocomplete="off" required id="FaltaFechaUp" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Horario</label>
                        <div>
                            <select name="" id="FaltaHorarioUp" class="form-control rounded">
                                <option value="mañana">mañana</option>
                                <option value="tarde">Tarde</option>
                                <option value="noche">Noche</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Cod documento respaldo</label>
                        <div>
                            <input type="text" class="form-control rounded" required pattern="[0-9 ]+" id="FaltaCodDocUp" autocomplete="off">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger">Registrar</button>
                </form>
            </div>
        </section>
    </div>
</div>
<div id="md-cambioTurno1" class="modal fade md-flipHor" tabindex="-1" data-width="400">
    <div class="modal-header">
        <button type="button" class="close" id="btn-md-cambturno1" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h3>Formulario de solicitud de Cambio de Turno</h3>
    </div>
    <div class="modal-body">
        <section class="panel">
            <div class="panel-body">
                <form class="form-horizontal" data-collabel="3" data-alignlabel="left" id="formCreateCambioTurno">
                    <div class="form-group">
                        <label class="control-label">Motivo</label>
                        <div>
                            <input type="text" class="form-control rounded" required pattern="[A-ZñÑa-z ]+" id="CTmotivo" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Remplazo</label>
                        <div>
                            <input type="text" class="form-control rounded" autocomplete="off" required pattern="[A-ZñÑa-z ]+" id="CTremplazo" autocomplete="off">
                            <!-- <span class="help-block">A block of <a href="#">help text.</a> <i class="fa fa-info"></i></span> -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Horario</label>
                        <div>
                            <select name="" id="CThorario" class="form-control">
                                <option value="mañana">Mañana</option>
                                <option value="tarde">Tarde</option>
                                <option value="noche">Noche</option>
                                <option value="tiempo completo">Tiempo Comleto</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Fecha a solicitar</label>
                        <div>
                            <input type="date" class="form-control rounded" autocomplete="off" required id="CTfechaPermiso">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Cod Documento Respaldo</label>
                        <div>
                            <div class="input-icon right"> <i class="fa fa-keyboard-o ico "></i>
                                <input type="number" class="form-control rounded" autocomplete="off" required pattern="[0-9 ]+" id="CTcodRespaldoDoc">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger">Registrar</button>
                </form>
            </div>
        </section>
    </div>
</div>
<div id="md-cambioTurno2" class="modal fade md-flipHor" tabindex="-1" data-width="400">
    <div class="modal-header">
        <button type="button" class="close" id="btn-md-cambturno2" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        <h3>Actualizar Cambio de turno</h3>
    </div>
    <div class="modal-body">
        <section class="panel">
            <div class="panel-body">
                <form class="form-horizontal" data-collabel="4" data-alignlabel="left" id="formEditCambioTurno">
                    <input type="text" id="CodCambTurnUp" hidden>
                    <div class="form-group">
                        <label class="control-label">Motivo</label>
                        <div>
                            <input type="text" class="form-control rounded" required pattern="[A-ZñÑa-z ]+" id="ctmotivoUp" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Remplazo</label>
                        <div>
                            <input type="text" class="form-control rounded" autocomplete="off" required pattern="[A-ZñÑa-z ]+" id="ctremplazoUp" autocomplete="off">
                            <!-- <span class="help-block">A block of <a href="#">help text.</a> <i class="fa fa-info"></i></span> -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Horario</label>
                        <div>
                            <select name="" id="CThorarioUp" class="form-control">
                                <option value="mañana">Mañana</option>
                                <option value="tarde">Tarde</option>
                                <option value="noche">Noche</option>
                                <option value="tiempo completo">Tiempo Comleto</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Fecha a solicitar Permiso</label>
                        <div>
                            <input type="date" class="form-control rounded" autocomplete="off" required id="ctfechaPermisoUp">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Cod Documento Respaldo</label>
                        <div>
                            <div class="input-icon right"> <i class="fa fa-keyboard-o ico "></i>
                                <input type="number" class="form-control rounded" autocomplete="off" required pattern="[0-9 ]+" id="ctcodRespaldoDocUp">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger">Actualizar</button>
                </form>
            </div>
        </section>
    </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('/asincrono/recHumEmp.js') }}"></script>
@endsection