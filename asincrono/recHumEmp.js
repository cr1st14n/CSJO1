//?Funciones de auto inicio
setTimeout(() => {
	listTodosEmp();
}, 800);




$('input').attr('autocomplete', 'off');

//?----------- onclick de formularios
var formCreatuser1 = document.getElementById('formuladio1');
formCreatuser1.addEventListener('submit', function(event) {
	event.preventDefault();
	createUser(1);
});
$('#formulario2').on('submit', function(event) {
	event.preventDefault();
	createUser(2);
});
$('#formCreatePermiso').on('submit', function(e) {
	e.preventDefault();
	permisoCreate();
});
$('#formEditPermiso').on('submit', function(e) {
	e.preventDefault();
	permisoUpdate();
});
$('#formCreateFalta').on('submit', function(e) {
	e.preventDefault();
	createFalta();
});
$('#formEditFalta').on('submit', function(e) {
	e.preventDefault();
	updateFalta();
});
$('#formCreateCambioTurno').on('submit', function(e) {
	e.preventDefault();
	CamTurnCreate();
});
$('#formEditCambioTurno').on('submit', function(e) {
	e.preventDefault();
	updateCambTurno();
});
$('#formulario1Up').on('submit', function(e) {
	e.preventDefault();
	updateUser();
});
$('#formulario2Up').on('submit', function(e) {
	e.preventDefault();
	updateUser2();
});
$('#formCreateVacacion').on('submit', function(e) {
	e.preventDefault();
	vacacionCreate();
});
$('#formEditVacacion').on('submit', function(e) {
	e.preventDefault();
	UpdateVacaUser();
});
//! -----------------------------------------------------------------------

function showListEmp() {}
// ? func create usuario
function showModalCreateUser() {
	$('#formuladio1').trigger('reset');
	$('#md-createUser').modal('show');
}

function createUser(tip) {
	switch (tip) {
		case 1:
			var form = document.getElementById('formuladio1');
			if (form.checkValidity()) {
				var data = {
					_token: $('meta[name=csrf-token]').attr('content'),
					ci: $('#createUserCi').val(),
					email: $('#email').val()
				};
				$.post('/C.S.J.O.bo/RRHH/personal/revCiEmail', data)
					.done(function(data) {
						switch (data) {
							case 'ciYaExistente':
								notif('2', 'CI ya registrado!');
								break;
							case 'emailYaExistente':
								notif('2', 'Email ya registrado!');
								break;
							case 'true':
								showModalCreateUser2();
								break;
						}
					})
					.fail();
			} else {
				notif('2', 'Complete los datos con * !');
			}
			break;
		case 2:
			var form2 = document.getElementById('formulario2');
			if (form2.checkValidity()) {
				var data = createUser2();
				$.post('/C.S.J.O.bo/RRHH/personal/createUser', data)
					.done(function(rest) {
						if (rest == 'succes') {
							notif('1', 'Usuario registrado!');
							limpiarFomrUserCreate();
							listTodosEmp();
						} else if (rest == 'emailYaExistente') {
							notif('2', 'Error. registro de correo electronico!');
							notif('4', 'Correo electronico ya registrado !');
						} else {
							notif('2', 'Error. Vuelva a intentarlo!');
						}
					})
					.fail(function() {
						notif(2, 'Error. Reinicie actividad');
					});
			} else {
				notif('2', 'Completa los campos con *');
			}
			break;
	}
}
function showModalCreateUser2() {
	$.get("personal/listAreasDisponibles",
		function (data) {
			console.log(data);
			var htmlList=data.map(function (e) {
				return `
				<option value="${e.nombre}">${e.nombre}</option>
				`;
			  }).join(' ');
			  $('#areaDesignada').html(htmlList);
		}
	);
	$('#formulario2').trigger('reset');
	$('#md-createUser2').modal('show');
}

function createUser2() {
	var data = {
		_token: $('meta[name=csrf-token]').attr('content'),
		ci: $('#createUserCi').val(),
		nombre: $('#nombre').val(),
		apellido1: $('#apellido1').val(),
		apellido2: $('#apellido2').val(),
		// sexo: document.querySelector('input[name=sexo]:documentchecked').value,
		sexo: $('input[name=sexo').filter(":checked").val(),
		fechaNacimiento: $('#fechaNacimiento').val(),
		paisNacimiento: $('#paisNacimiento').val(),
		depNacimiento: $('#depNacimiento').val(),
		tipoSangre: $('#tipoSangre').val(),
		estadoCivil: $('#estadoCivil').val(),
		telf: $('#telf').val(),
		telfRef: $('#telfRef').val(),
		zona: $('#zona').val(),
		domicilio: $('#domicilio').val(),
		zonaSufragio: $('#zonaSufragio').val(),
		email: $('#email').val(),
		/*datos2*/
		fechaContratacion: $('#fechaContratacion').val(),
		contrato: $('#contrato').val(),
		tituloOB: $('#tituloOb').val(),
		profecionOB: $('#profecionOb').val(),
		areaDesignada: $('#areaDesignada').val(),
		cargo: $('#cargo').val(),
		accModSis: $('#accModSis').val(),
		accesoSistema: document.querySelector('input[name=accesoSis]:checked').value,
		seguroNombreInstitucionCP: $('#seguroNombreInstitucionCP').val(),
		codSeguroCP: $('#codSeguroCP').val(),
		seguroNombreInstitucionLP: $('#seguroNombreInstitucionLP').val(),
		numNua: $('#numNua').val(),
		numCua: $('#numCua').val()
	};
	return data;
}

function listTodosEmp() {
	$.get('/C.S.J.O.bo/RRHH/personal/showEmpTodos')
		.done(function(data) {
			var html = data
				.map(function(elem) {
					return `<tr>
                    <td>${elem.usu_ci}</td>
                    <td align="left">${elem.usu_appaterno} ${elem.usu_apmaterno}, ${elem.usu_nombre}</td>
                    <td>${veriNull(elem.di_profecion)}</td>
                    <td>${elem.uc_area}</td>
                    <td>${elem.usu_area}</td>
                    <td>
                        <span class="tooltip-area">
                        <a class="btn btn-default btn-sm" title="Datos Registrados" onclick="showDatosEmp(${elem.id})"><i class="fa fa-user"></i></a>
                        <a class="btn btn-default btn-sm" title="Vacaciones" onclick="showUserVacaciones(${elem.id})"><i class="fa fa-tag"></i></a>
                        <a class="btn btn-default btn-sm" title="Faltas Permisos" onclick="showUserFalPerm(${elem.id})"><i class="fa fa-exclamation"></i></a>
                        <a class="btn btn-default btn-sm" title="Delete" onClick="deleteUser(${elem.id})"><i class="fa fa-trash-o"></i></a>
                        </span>
                    </td>
                    </tr>`;
				})
				.join(' ');
			document.getElementById('tableUser').innerHTML = html;
		})
		.fail(function() {
			notif('1', 'ERROR SERVER LTE');
		});
}

function showDatosEmp(id) {
	$.get('/C.S.J.O.bo/RRHH/personal/showDatosEmp/' + id + '')
		.done(function(elem) {
			console.log(elem);
			console.log(elem[0]);
			console.log(elem[1]);
			$('#usu_id').val('');
			$('#usu_id_Contrato').val('');
			$('#usu_id_datIns').val('');
			$('#usu_id').val(elem[0].id);
			$('#usu_id_Contrato').val(elem[0].id_datIns);
			$('#usu_id_datIns').val(elem[1].id);
			if (elem[0].usu_acceso == 1) {
				var usu_acceso = 'Si';
			} else {
				var usu_acceso = 'No';
			}
			var datosEMP = `CI: <strong>${elem[0].usu_ci}</strong><br>
                  Nombre: <strong>${elem[0].usu_nombre} </strong><br>
                  Apellidos: <strong>${elem[0].usu_appaterno} ${elem[0].usu_apmaterno}</strong> <br>
                  Sexo: <strong>${elem[0].usu_sexo}</strong><br>
                  Fecha de nacimiento: <strong>${moment(elem[0].usu_fechnac).format('D/MM/YYYY')}</strong><br>
                  Lugar de Nacimiento: <strong>${elem[0].usu_depnac}</strong><br>
                  Tipo de sangre: <strong>${elem[0].usu_tipoSangre}</strong><br><hr>
                  Lugar de trabajo: <strong>CENTRO DE SALUD JESUS OBRERO</strong><br><hr>
                  Email: <strong>${elem[0].email}</strong><br>
                  Estado Civil: <strong>${elem[0].usu_estadocivil}</strong><br>
                  Telf/Cel: <strong>${elem[0].usu_telf}</strong><br>
                  Telf/Cel referencia: <strong>${elem[0].usu_telfref}</strong> <br>
                  Zona de sufragio: <strong>${elem[0].usu_zonaSufragio}</strong><br>
                  Zona: <strong>${elem[0].usu_zona}</strong><br>
                  Domicilio: <strong>${elem[0].usu_domicilio}</strong><br><hr>
                  Lugar donde Sufragia: <strong>${elem[0].usu_zonaSufragio}</strong>
                  `;
			document.getElementById('datosEmp').innerHTML = datosEMP;
			var html2 = `
                Fecha de contratacion: <strong>${moment(elem[1].uc_fechaInicio).format('DD-MM-YYYY')}</strong><br>
                Titulo: <strong>${elem[0].di_titulo}</strong><br>
                Profecion: <strong>${elem[0].di_profecion}</strong><br><hr>
                Area : <strong>${elem[0].usu_area}</strong><br>
                Cargo: <strong>${elem[1].uc_cargoDesignado} </strong><br>
                Tipo de Contrato: <strong>${elem[1].uc_tipoContrato}</strong><br><hr>
                Acceso al sistema: <strong>${usu_acceso}</strong><br><hr>
                <h4>Seguro a corto plazo </h4> <br>
                Nombre de la institucion: <strong>${elem[0].di_seguroNombreCP}</strong> <br>
                Codigo de asegurado: <strong>${elem[0].di_codSeguroCP}</strong> <br><hr>
                <h4>Seguro a largo plazo </h4> <br>
                Nombre de la institucion: <strong>${elem[0].di_seguroNombreLP}</strong> <br>
                # NUA: <strong>${elem[0].di_seguroNua}</strong> <br>
                # CUA: <strong>${elem[0].di_seguroCua}</strong> <br>
                `;
			document.getElementById('datosInst').innerHTML = html2;
			var boton = `<button type="button" class="btn btn-theme" onclick="showEditDat1User(${elem[0]
				.id})">Actualizar Datos</button>`;
			document.getElementById('datosEditButon').innerHTML = boton;
			var boton1 = `<button type="button" class="btn btn-theme" onclick="showEditDat2User(${elem[0]
				.id})">Actualizar Datos</button>`;
			document.getElementById('datosInstEditButon').innerHTML = boton1;
			$('#md-stack1').modal('show');
		})
		.fail(function() {
			notif('2', 'ERROR SERVER');
		});
}

function showEditDat1User(id) {
	data = { id: id };
	$.get('/C.S.J.O.bo/RRHH/personal/editDatos1Emp/', data, function(data) {
		console.log(data);
		$('#idEdituser').val(data.id);
		$('#createUserCiUp').val(data.usu_ci);
		$('#nombreUp').val(data.usu_nombre);
		$('#apellido1Up').val(data.usu_appaterno);
		$('#apellido2Up').val(data.usu_apmaterno);
		 document.querySelector('input[name=sexo]:checked').value; 
		 if (data.usu_sexo == 'masculino') {
			document.getElementById('sexo1Up').checked = true;
			
		} else {
			document.getElementById('sexo2Up').checked = true;
		}
		$('#fechaNacimientoUp').val(data.usu_fechnac);
		$('#paisNacimientoUp').val(data.usu_paisnac);
		$('#depNacimientoUp').val(data.usu_depnac);
		$('#tipoSangreUp').val(data.usu_tipoSangre); 
		$('#estadoCivilUp').val(data.usu_estadocivil); 
		$('#telfUp').val(data.usu_telf), $('#telfRefUp').val(data.usu_telfref); 
		$('#zonaUp').val(data.usu_zona), $('#domicilioUp').val(data.usu_domicilio); 
		$('#zonaSufragioUp').val(data.usu_zonaSufragio);
		$('#emailUp').val(data.email);
	});
	$('#md-editDatUser').modal('show');
}

function updateUser() {
	var cons = $('#idEdituser').val();
	console.log(cons);
	if (cons != null) {
		// console.log("se peude actualizar");
		var datos = {
			_token: $('meta[name=csrf-token]').attr('content'),
			idEdituser: $('#usu_id').val(),
			createUserCiUp: $('#createUserCiUp').val(),
			nombreUp: $('#nombreUp').val(),
			apellido1Up: $('#apellido1Up').val(),
			apellido2Up: $('#apellido2Up').val(),
			sexoUp: document.querySelector('input[name="sexoUp"]:checked').value,
			fechaNacimientoUp: $('#fechaNacimientoUp').val(),
			paisNacimientoUp: $('#paisNacimientoUp').val(),
			depNacimientoUp: $('#depNacimientoUp').val(),
			tipoSangreUp: $('#tipoSangreUp').val(),
			estadoCivilUp: $('#estadoCivilUp').val(),
			telfUp: $('#telfUp').val(),
			telfRefUp: $('#telfRefUp').val(),
			zonaUp: $('#zonaUp').val(),
			domicilioUp: $('#domicilioUp').val(),
			zonaSufragioUp: $('#zonaSufragioUp').val(),
			emailUp: $('#emailUp').val()
		};
		$.post("/C.S.J.O.bo/RRHH/personal/updateDatos1Emp", datos,
			function (data) {
				console.log(data);
			 if (data==1) {
				document.getElementById('btn-editDatuser-close').click();
				notif('1', 'Actualizado correctamente');
				showDatosEmp($('#usu_id').val());
			 } else {
				notif('4', 'Error. Datos no Modicicados ');
				document.getElementById('btn-editDatuser-close').click();
			 }	
			}
		);
		/* $.post('/C.S.J.O.bo/RRHH/personal/updateDatos1Emp', dato, function(data) {
			console.log(data);
			switch (data) {
				case 'success':
					document.getElementById('btn-editDatuser-close').click();
					notif('1', 'Actualizado correctamente');
					showDatosEmp($('#usu_id').val());
					break;
				case 'fail':
					notif('2', 'Error. vuelva a intentarlo');
					break;
			}
		}); */
	} else {
		console.log('NO puede actualizar');
	}
}

function showEditDat2User(id) {
	console.log(id);
	$.get("personal/listAreasDisponibles",
		function (data) {
			console.log(data);
			var htmlList=data.map(function (e) {
				return `
				<option value="${e.nombre}">${e.nombre}</option>
				`;
			  }).join(' ');
			  $('#areaDesignadaUP').html(htmlList);
		}
	);
	var data = { id: id };
	$.get('/C.S.J.O.bo/RRHH/personal/editDatos2Emp', data, function(data) {
		console.log(data);
		$('#formulario2Up-id').val('');
		$('#formulario2Up-id').val('');
		$('#formulario2Up-id').val('');
		$('#formulario2Up_id_usu').val(id);
		$('#formulario2Up_id_contrato').val(data[0].id);
		$('#formulario2Up_id_datosIns').val(data[1].id);
		$('#fechaContratacionUp').val(data[0].uc_fechaInicio);
		$('#contratoUp').val(data[0].uc_tipoContrato);
		$('#tituloObUp').val(data[1].di_titulo);
		$('#profecionObUP').val(data[1].di_profecion);
		$('#areaDesignadaUP').val(data[0].uc_area);
		$('#cargoUP').val(data[0].uc_cargoDesignado);
		$('#accModSisUp').val(data[2].usu_area);
		$('#accesoSis').val(data[2].usu_acceso);
		if (data[2].usu_acceso == 1) {
			document.getElementById('accesoSiUp').checked = true;
		} else {
			document.getElementById('accesoNoUp').checked = true;
		}
		$('#seguroNombreInstitucionCPUp').val(data[1].di_seguroNombreCP);
		$('#codSeguroCPUp').val(data[1].di_codSeguroCP);
		$('#seguroNombreInstitucionLPUp').val(data[1].di_seguroNombreLP);
		$('#numNuaUp').val(data[1].di_seguroNua);
		$('#numCuaUp').val(data[1].di_seguroCua);
	});
	
	$('#md-editDatInstUser').modal('show');
}

function updateUser2() {
	var id = $('#formulario2Up_id_usu').val();
	var id1 = $('#formulario2Up_id_contrato').val();
	var id2 = $('#formulario2Up_id_datosIns').val();
	if (id > 0 && id1 > 0 && id2 > 0) {
		var data = {
			_token: $('meta[name=csrf-token]').attr('content'),
			id_usu:$('#formulario2Up_id_usu').val(),
			id_contrato:$('#formulario2Up_id_contrato').val(),
			id_datosIns:$('#formulario2Up_id_datosIns').val(),
			fechaContratacionUp: $('#fechaContratacionUp').val(),
			tituloObUp: $('#tituloObUp').val(),
			contratoUp: $('#contratoUp').val(),
			profecionObUP: $('#profecionObUP').val(),
			areaDesignadaUP: $('#areaDesignadaUP').val(),
			cargoUP: $('#cargoUP').val(),
			accModSisUp: $('#accModSisUp').val(),
			accesoSisUp: document.querySelector('input[name=accesoSisUp]:checked').value,
			seguroNombreInstitucionCPUp: $('#seguroNombreInstitucionCPUp').val(),
			codSeguroCPUp: $('#codSeguroCPUp').val(),
			seguroNombreInstitucionLPUp: $('#seguroNombreInstitucionLPUp').val(),
			numNuaUp: $('#numNuaUp').val(),
			numCuaUp: $('#numCuaUp').val(),
		};
		$.post("/C.S.J.O.bo/RRHH/personal/updateDatos2Emp", data,
			function (data) {
				if (data=='success') {
					notif('1','Registro Actualizado');
					$('#md-editDatInstUser_btn_close').click();
					showDatosEmp(id);
					listTodosEmp();
				} else {
					notif('3','Advertencia. Actualizacion no completada. Verifique Datos')
				}
			}
		);

	} else {
		console.log('Error! falla de actualizacion');
	}
}

function showDocUser() {
	$('#md-DocUser').addClass('md-flipHor').modal('show');
}

function showUserVacaciones(id) {
	$('#md-UserVacaciones').addClass('md-flipHor').modal('show');
	$('#usuVacacId').val(id);
	var data = { id: id };
	$.get('/C.S.J.O.bo/RRHH/personal/vacacion/index', data, function(data) {
		console.log(data[0].date1);
		console.log(data[0].date2);
		$('#date1UsuVac').attr({ min: data[0].date1, max: data[0].date2 });
		$('#date2UsuVac').attr({ max: data[0].date2, min: data[0].date1 });
		var html = data[0].años
			.map(function(e) {
				return `<tr>
                <td>${e.a}</td>
                <td>${e.b}</td>
              </tr>`;
			})
			.join(' ');
		var diasVaPen = 0;
		data[0].años.forEach(element => {
			diasVaPen += element.b;
		});
		console.log(diasVaPen);
		console.log(data[0].DVU);
		console.log(diasVaPen - data[0].DVU);

		$('#listAñosVacaUser').html(html);
		$('#usVaContrato').text(data[0].fechContrato);

		$('#userVacacinesDisponibles').text(diasVaPen - data[0].DVU);
		console.log(data[0].fechContrato);
	});
	listVacacUser(id);
}

function showUserFalPerm(codUsu1) {
	document.getElementById('listFaltasPermisos').innerHTML = '';
	document.getElementById('sectorBottonFaltasPermisos').innerHTML = '';
	document.getElementById('codUsu1').value = '';
	document.getElementById('codUsu1').value = codUsu1;
	$('#md-UserFalPer')
		// .addClass("md-flipHor")
		.modal('show');
}

function listFaltas() {
	var boton = `<button class="btn btn-theme" id="" onClick="SMNfalta()">Registrar Falta</button>`;
	var headHtml = `<tr>
  <th>Cod Doc</th>
  <th>Motivo</th>
  <th>Fecha</th>
  <th>Horario</th>
  <th>*</th>
  </tr>`;
	document.getElementById('sectorBottonFaltasPermisos').innerHTML = boton;
	document.getElementById('head-listFaltasPermisos').innerHTML = headHtml;
	var data = { userId: $('#codUsu1').val() };
	$.get('/C.S.J.O.bo/RRHH/personal/faltas/list', data, function(data, textStatus, jqXHR) {
		var html = data
			.map(function(e) {
				return `<tr>
       <td>${e.uf_codDoc}</td>
       <td>${e.uf_motivo}</td>
       <td>${moment(e.uf_fecha).format('DD/MM/YYYY')}</td>
       <td>${e.uf_horario}</td>
       <td>
       <span class="tooltip-area">
       <a class="btn btn-default btn-sm" title="Editar" onclick="ShowModalEditFalta(${e.id})"><i class="fa fa-pencil"></i></a>
       <a class="btn btn-default btn-sm" title="Eliminar" onclick="deleteFalta(${e.id})"><i class="fa fa-trash-o"></i></a>
       </span>
     </td>
   </tr>`;
			})
			.join(' ');
		document.getElementById('listFaltasPermisos').innerHTML = html;
	});
}

function listPermisos() {
	var boton = `<button class="btn btn-theme" onClick="SMRPermisos()">Registrar Permiso</button>`;
	document.getElementById('sectorBottonFaltasPermisos').innerHTML = boton;
	var headhtml = `<tr>
  <th>Cod Doc</th>
  <th>Motivo</th>
  <th>Remplazo</th>
  <th>Fecha de Solicitud</th>
  <th>Fecha a Solicitar</th>
  <th>Tiempo</th>
  <th>*</th>
  </tr>`;
	document.getElementById('head-listFaltasPermisos').innerHTML = headhtml;
	var data = { userId: $('#codUsu1').val() };
	$.get('/C.S.J.O.bo/RRHH/personal/permiso/show', data, function(data, textStatus, jqXHR) {
		var html = data
			.map(function(e) {
				return `<tr>
                  <td>${e.up_codRespaldoDoc}</td>
                  <td>${e.up_motivo}</td>
                  <td>${e.up_remplazo}</td>
                  <td>${moment(e.up_fechaSolicitud).format('DD/MM/YYYY')}</td>
                  <td>${moment(e.up_fechaPermiso).format('DD/MM/YYYY')}</td>
                  <td>${e.up_horaInicio} - ${e.up_horaFinal}</td>
                  <td>
                    <span class="tooltip-area">
                    <a class="btn btn-default btn-sm" title="Editar" onclick="ShowModalEditPermiso(${e.id})"><i class="fa fa-pencil"></i></a>
                    <a class="btn btn-default btn-sm" title="Eliminar" onclick="permisoDestroy(${e.id})"><i class="fa fa-trash-o"></i></a>
                    </span>
                  </td>
                </tr>`;
			})
			.join(' ');
		document.getElementById('listFaltasPermisos').innerHTML = html;
	});
}

function listCambioTurno() {
	var boton = `<button class="btn btn-theme" onClick="SMCambioTurno()">Registrar Cambio de turno</button>`;
	document.getElementById('sectorBottonFaltasPermisos').innerHTML = boton;
	var headhtml = `<tr>
  <th>Cod Doc</th>
  <th>Motivo</th>
  <th>Remplazo</th>
  <th>Fecha de Solicitud</th>
  <th>Fecha a Solicitar</th>
  <th>Horario</th>
  <th>*</th>
  </tr>`;
	document.getElementById('head-listFaltasPermisos').innerHTML = headhtml;
	var dat = { id: $('#codUsu1').val() };
	$.get('/C.S.J.O.bo/RRHH/personal/cambioTurno/list', dat, function(data) {
		var html = data
			.map(function(e) {
				return `<tr>
        <td>${e.uct_codDoc}</td>
        <td>${e.uct_motivo}</td>
        <td>${e.cod_usu2}</td>
        <td>${moment(e.ca_fecha).format('DD/MM/YYYY')}</td>
        <td>${moment(e.uct_fecha).format('DD/MM/YYYY')}</td>
        <td>${e.uct_horario}</td>
        <td>
        <span class="tooltip-area">
        <a class="btn btn-default btn-sm" title="Editar" onclick="showModalCambioturno(${e.id})"><i class="fa fa-pencil"></i></a>
        <a class="btn btn-default btn-sm" title="Eliminar" onclick="deleteCambTurn(${e.id})"><i class="fa fa-trash-o"></i></a>
        </span>
      </td>
    </tr>`;
			})
			.join(' ');
		document.getElementById('listFaltasPermisos').innerHTML = html;
	});
}

function limpiarFomrUserCreate() {
	$('#md-createUser2').modal('hide');
	$('#md-createUser').modal('hide');
}


function jose(params) {
	notif('1', 'hola');

	if (condition) {
		var a = 1 + 1;
	}
}

function marww(data) {
	return data;
}

// ? funciones para permisos de personal
function SMRPermisos() {
	$('#md-permisos1').modal('show');
	$('#formCreatePermiso').trigger('reset');
}

function permisoCreate() {
	var data = {
		_token: $('meta[name=csrf-token]').attr('content'),
		codUsu1: $('#codUsu1').val(),
		motivo: $('#motivo').val(),
		remplazo: $('#remplazo').val(),
		fechaSolicitud: $('#fechaSolicitud').val(),
		fechaPermiso: $('#fechaPermiso').val(),
		horaInicio: $('#horaInicio').val(),
		horaFinal: $('#horaFinal').val(),
		codRespaldoDoc: $('#codRespaldoDoc').val()
	};
	$.post('/C.S.J.O.bo/RRHH/personal/permiso/create', data, function(data, textStatus, jqXHR) {
		if (data == 'success') {
			$('#md-permisos1').modal('toggle');
			notif('1', 'Permiso registrado Exitosamente.');
			listPermisos();
		} else {
			notif('2', 'Error!, Vuelva a intentarlo');
		}
	}).fail(function() {
		console.log('error de server 987');
	});
}
function ShowModalEditPermiso(idPermiso) {
	var data = { id: idPermiso };
	$.get('/C.S.J.O.bo/RRHH/personal/permiso/edit', data, function(data, textStatus, jqXHR) {
		$('#CodPermisoUp').val(data.id);
		$('#motivoUp').val(data.up_motivo);
		$('#remplazoUp').val(data.up_remplazo);
		$('#fechaSolicitudUp').val(data.up_fechaSolicitud);
		$('#fechaPermisoUp').val(data.up_fechaPermiso);
		$('#horaInicioUp').val(data.up_horaInicio);
		$('#horaFinalUp').val(data.up_horaFinal);
		$('#codRespaldoDocUp').val(data.up_codRespaldoDoc);
	}).fail(function() {});
	$('#md-permisos2').modal('show');
}
function permisoUpdate(param) {
	data = {
		_token: $('meta[name=csrf-token]').attr('content'),
		id: $('#CodPermisoUp').val(),
		up_motivo: $('#motivoUp').val(),
		up_remplazo: $('#remplazoUp').val(),
		up_fechaSolicitud: $('#fechaSolicitudUp').val(),
		up_fechaPermiso: $('#fechaPermisoUp').val(),
		up_horaInicio: $('#horaInicioUp').val(),
		up_horaFinal: $('#horaFinalUp').val(),
		up_codRespaldoDoc: $('#codRespaldoDocUp').val()
	};
	$.post('/C.S.J.O.bo/RRHH/personal/permiso/update', data, function(dat, textStatus, jqXHR) {
		listPermisos();
		document.getElementById('btn-md-permisos1-close').click();
	}).fail(function() {
		notif('2', 'error server ACP');
	});
}

function permisoDestroy(id) {
	var data = { id: id };
	$.get('/C.S.J.O.bo/RRHH/personal/permiso/destroy', data, function(data, textStatus, jqXHR) {
		if (data == 'success') {
			notif('1', 'Permiso eliminado, Exitosamente');
			listPermisos();
		} else {
			notif('2', 'Error. Server 401');
		}
	});
}

//?------
function SMNfalta(id) {
	$('#md-faltaCreate').modal('show');
	$('#formCreateFalta').trigger('reset');
}
function createFalta() {
	var data = {
		_token: $('meta[name=csrf-token]').attr('content'),
		codUsu1: $('#codUsu1').val(),
		uf_motivo: $('#FaltaMotivo').val(),
		uf_fecha: $('#FaltaFecha').val(),
		uf_horario: $('#FaltaHorario').val(),
		uf_codDoc: $('#FaltaCodDoc').val()
	};
	$.post('/C.S.J.O.bo/RRHH/personal/faltas/create', data, function(data, textStatus, jqXHR) {
		console.log(data);
		if (data == 'success') {
			notif('1', 'Falta registrada');
			listFaltas();
			document.getElementById('btn-md-falta1-close').click();
		} else {
			notif('2', 'Error. vuelva a intentarlo');
		}
	});
}
function ShowModalEditFalta(idFalta) {
	var data = { id: idFalta };
	$.get('/C.S.J.O.bo/RRHH/personal/faltas/edit', data, function(data, textStatus, jqXHR) {
		console.log(data);
		document.getElementById('CodfaltaUp').value = data.id;
		document.getElementById('FaltaMotivoUp').value = data.uf_motivo;
		document.getElementById('FaltaFechaUp').value = data.uf_fecha;
		document.getElementById('FaltaHorarioUp').value = data.uf_horario;
		document.getElementById('FaltaCodDocUp').value = data.uf_codDoc;
		$('#md-faltaEdit').modal('show');
	});
}
function updateFalta() {
	var data = {
		_token: $('meta[name=csrf-token]').attr('content'),
		id: $('#CodfaltaUp').val(),
		uf_codDoc: $('#FaltaCodDocUp').val(),
		uf_motivo: $('#FaltaMotivoUp').val(),
		uf_fecha: $('#FaltaFechaUp').val(),
		uf_horario: $('#FaltaHorarioUp').val()
	};
	$.post('/C.S.J.O.bo/RRHH/personal/faltas/update', data, function(data, textStatus, jqXHR) {
		if (data == 'success') {
			notif('1', 'Falta actulizada');
			listFaltas();
			document.getElementById('btn-md-falta2-close').click();
		} else {
			notif('2', 'Error Vuelva al intentarlo');
		}
	});
}
function deleteFalta(id) {
	var data = {
		_token: $('meta[name=csrf-token]').attr('content'),
		id: id
	};
	var r = confirm('Confirma eliminar El registro de falta?');
	if (r == true) {
		console.log(data);
		$.post('/C.S.J.O.bo/RRHH/personal/faltas/delete', data, function(data, textStatus, jqXHR) {
			if (data == 'success') {
				notif('1', 'Falta, eliminada');
				listFaltas();
			} else {
				notif('2', 'Error. Vuelva a intentarlo');
			}
		});
	}
}
// *......... JS CAMBIO DE TURNO
function SMCambioTurno(param) {
	$('#md-cambioTurno1').modal('show');
	$('#formCreateCambioTurno').trigger('reset');
}
function CamTurnCreate() {
	console.log('hola');
	var data = {
		_token: $('meta[name=csrf-token]').attr('content'),
		cod_usu: $('#codUsu1').val(),
		cod_usu2: $('#CTremplazo').val(),
		uct_codDoc: $('#CTcodRespaldoDoc').val(),
		uct_motivo: $('#CTmotivo').val(),
		uct_fecha: $('#CTfechaPermiso').val(),
		uct_horario: $('#CThorario').val()
	};
	$.post('/C.S.J.O.bo/RRHH/personal/cambioTurno/create', data, function(data, textStatus, jqXHR) {
		console.log(data);
		if (data == 'success') {
			listCambioTurno();
			document.getElementById('btn-md-cambturno1').click();
			notif('1', 'Registrado exitosamente');
		} else {
			notif('2', 'Error, Vuela a intentarlo');
		}
	});
}

function showModalCambioturno(id) {
	var dat = { id: id };
	$.get('/C.S.J.O.bo/RRHH/personal/cambioTurno/edit', dat, function(data, textStatus, jqXHR) {
		$('#CodCambTurnUp').val(data.id);
		$('#ctmotivoUp').val(data.uct_motivo);
		$('#ctremplazoUp').val(data.cod_usu2);
		$('#ctfechaPermisoUp').val(data.uct_fecha);
		$('#ctcodRespaldoDocUp').val(data.uct_codDoc);
		$('#CThorarioUp').val(data.uct_horario);
		$('#md-cambioTurno2').modal('show');
	});
}

function updateCambTurno(param) {
	var data = {
		_token: $('meta[name=csrf-token]').attr('content'),
		id: $('#CodCambTurnUp').val(),
		uct_motivo: $('#ctmotivoUp').val(),
		cod_usu2: $('#ctremplazoUp').val(),
		uct_fecha: $('#ctfechaPermisoUp').val(),
		uct_codDoc: $('#ctcodRespaldoDocUp').val(),
		uct_horario: $('#CThorarioUp').val()
	};
	$.post('/C.S.J.O.bo/RRHH/personal/cambioTurno/update', data, function(data, textStatus, jqXHR) {
		if (data) {
			notif('1', 'Actualizado');
			listCambioTurno();
			document.getElementById('btn-md-cambturno2').click();
		} else {
			notif('2', 'Error!, vuelva a intentarlo');
		}
	});
}
function deleteCambTurn(id) {
	var r = confirm('Eliminar registro?');
	if (r == true) {
		var data = {
			_token: $('meta[name=csrf-token]').attr('content'),
			id: id
		};
		$.post('/C.S.J.O.bo/RRHH/personal/cambioTurno/delete', data, function(data, textStatus, jqXHR) {
			if (data == 'success') {
				notif('1', 'Registro, eliminado');
				listCambioTurno();
			} else {
				notif('2', 'Error. Vuelva a intentarlo');
			}
		});
	}
}
// ? --------delete user

function deleteUser(id) {
	var data = { id: id };
	$.get('/C.S.J.O.bo/RRHH/personal/datos1User', data, function(data) {
		$('#message-delete').text(
			`Eliminar usuario Ci:${data.usu_ci}, Nombre: ${data.usu_nombre} ${data.usu_appaterno} `
		);
	});
	var btn = `
  <button type="button" data-dismiss="modal" class="btn btn-theme">Cancelar</button>
  <button type="button" class="btn btn-theme-inverse" onClick="DestroyUser(${id})">Aceptar</button>`;
	$('#btn-user-delete').html(btn);
	$('#md-user-delete').modal('show');
}
function DestroyUser(id) {
	var data = {
		_token: $('meta[name=csrf-token]').attr('content'),
		id: id
	};
	$.post('/C.S.J.O.bo/RRHH/personal/destroy', data, function(data) {
		if (data == 'success') {
			listTodosEmp();
			notif('1', 'Registro Eliminado');
			document.getElementById('btn-md-user-delete').click();
		} else if (data == 'fail1') {
			notif('2', 'Error vueva a intentarlo');
		} else if (data == 'fail2') {
			notif('2', 'Error 101 ! Consulte con sistemas...');
		} else if (data == 'fail3') {
			notif('2', 'Error 101 ! Consulte con sistemas...');
		} else {
		}
	});
}

// document.onkeypress=function (e) {
//   e = e || window.event;
//   var charCode = (typeof e.which == "number") ? e.which : e.keyCode;
//   alert("Character typed: " + String.fromCharCode(charCode));
//   if (charCode) {
//   }
//  }
//  $(window).on('keypress', function(e) {

//   var code = (e.keyCode ? e.keyCode : e.which);
//   var charCode = (typeof e.which == "number") ? e.which : e.keyCode;
// alert("Character typed: " + String.fromCharCode(charCode));
//   console.log(String.fromCharCode(charCode));
//   if(code == 13) {

// }

// });

//?  ----------Function crud register vacacion
function DayVacacionUser() {
 var id= $('#usuVacacId').val();
 var data={id:id};
  
$.get("/C.S.J.O.bo/RRHH/personal/vacacion/showDayV", data,
  function (data, textStatus, jqXHR) {
       if (data[0].dias -data[0].DVU>=0) {
     console.log('correcto');
     $('#userVacacinesDisponibles').attr({class: 'badge bg-theme-inverse'}).text(data[0].dias -data[0].DVU);
    } else {
      console.log('no correcto');
      $('#userVacacinesDisponibles').attr({class: 'badge  bg-danger'}).text(data[0].dias -data[0].DVU);
   }
   if (data[0].dias -data[0].DVU==0) {
    $('#userVacacinesDisponibles').attr({class: 'badge bg-warning'}).text(data[0].dias -data[0].DVU);
   }
     
  }
);

  }
function showUserVacaciones(id) {
	$('#md-UserVacaciones').modal('show');
	$('#usuVacacId').trigger('reset');
	$('#usuVacacId').val(id);
	var data = { id: id };
	$.get('/C.S.J.O.bo/RRHH/personal/vacacion/index', data, function(data) {
		console.log(data[0].date1);
		console.log(data[0].date2);
		console.log(moment(data[0].date2, 'YYYY-MM-DD').add('years', 1).format('YYYY-MM-DD'));
		$('#date1UsuVac').attr({
			min: data[0].date1,
			max: moment(data[0].date2, 'YYYY-MM-DD').add('years', 1).format('YYYY-MM-DD')
		});
		$('#date2UsuVac').attr({
			min: data[0].date1,
			max: moment(data[0].date2, 'YYYY-MM-DD').add('years', 1).format('YYYY-MM-DD')
		});
		var html = data[0].años
			.map(function(e) {
				return `<tr>
                <td>${e.a}</td>
                <td>${e.b}</td>
              </tr>`;
			})
			.join(' ');
		var diasVaPen = 0;
		data[0].años.forEach(element => {
			diasVaPen += element.b;
		});
		console.log(diasVaPen);
		console.log(data[0].DVU);
		console.log(diasVaPen - data[0].DVU);

		$('#listAñosVacaUser').html(html);
		$('#usVaContrato').text(data[0].fechContrato);

		// $('#userVacacinesDisponibles').text(diasVaPen - data[0].DVU);
		console.log(data[0].fechContrato);
	});
  listVacacUser(id);
  setTimeout(() => {
    DayVacacionUser();
    
  }, 500);
}
$('#calculateVacacinUser').click(function(e) {
	calcuarDias();
});
$('#calculateVacacinUser1').click(function(e) {
	calcuarDias();
});
function calcuarDias(e) {
  if (e==1) {
    var date2 = $('#date2UsuVac').val();
    var date1 = $('#date1UsuVac').val();
    if (
      document.getElementById('date2UsuVac').checkValidity() &&
      document.getElementById('date1UsuVac').checkValidity()
    ) {
    } else {
      return;
    }
    if (moment(date1, 'YYYY-MM-DD').format('YYYY-MM-DD') <= moment(date2, 'YYYY-MM-DD').format('YYYY-MM-DD')) {
      var fecha1 = moment(date1);
      var fecha2 = moment(date2);
      $('#vacDayUser').val(fecha2.diff(fecha1, 'days') + 1);
    } else {
      console.log('E');
      notif('1', 'Error! Verifique fechas agregadas');
    }
  } else {
    var date2 = $('#date2UsuVac_Up').val();
    var date1 = $('#date1UsuVac_Up').val();
    if (
      document.getElementById('date2UsuVac_Up').checkValidity() &&
      document.getElementById('date1UsuVac_Up').checkValidity()
    ) {
    } else {
      return;
    }
    if (moment(date1, 'YYYY-MM-DD').format('YYYY-MM-DD') <= moment(date2, 'YYYY-MM-DD').format('YYYY-MM-DD')) {
      var fecha1 = moment(date1);
      var fecha2 = moment(date2);
      $('#vacDayUser_Up').val(fecha2.diff(fecha1, 'days') + 1);
    } else {
      console.log('E');
      notif('1', 'Error! Verifique fechas agregadas');
    }
  }
  
	
}
function vacacionCreate(param) {
	var id = $('#usuVacacId').val();
	var date2 = $('#date2UsuVac').val();
	var date1 = $('#date1UsuVac').val();
	var dV = $('#vacDayUser').val();
	var dr = $('#docRespaldo').val();
	var ob = $('#ObservacionVacacion').val();
	if (moment(date1, 'YYYY-MM-DD').format('YYYY-MM-DD') <= moment(date2, 'YYYY-MM-DD').format('YYYY-MM-DD')) {
		var data = {
			_token: $('meta[name=csrf-token]').attr('content'),
			d1: date1,
			d2: date2,
			id: id,
			dv: dV,
			dr: dr,
			ob: ob
		};
		$.post('/C.S.J.O.bo/RRHH/personal/vacacion/create', data, function(data) {
			if ((data = 'success')) {
        $('#formCreateVacacion').trigger('reset');
				notif('1', 'Registrado exitosamente');
				listVacacUser(id);
        DayVacacionUser();
			} else {
				notif('2', 'Error! Vuelva a intentarlo.');
			}
		});
	} else {
		notif('2', 'Error!. Verificar informacion');
	}
}
function listVacacUser(id) {
	
	data = { id: $('#usuVacacId').val() };
	$.get('/C.S.J.O.bo/RRHH/personal/vacacion/list1', data, function(data) {
    console.log(data);
    var html = data
			.map(function(e) {
				return `
        <tr>
        <td>${e.uv_codDocResp}</td>
        <td>${e.uv_fecha1} / ${e.uv_fecha2}</td>
        <td>${e.uv_diasVac}</td>
        <td>
          <span class="tooltip-area">
          <a onClick=editVacaUser(${e.id}) class="btn btn-default btn-sm" title="Editar" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
          <a onClick=deleteVacaUser(${e.id}) class="btn btn-default btn-sm" title="Borrar" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
          </span>
        </td>
    </tr>
        `;
			})
			.join(' ');
		$('#listVacacionesUser').html(html);
	});
}
function editVacaUser(id) {
$('#md-UserVacacionesEdit').modal('show');
var data={id:id};
$.get("/C.S.J.O.bo/RRHH/personal/vacacion/edit", data,
  function (data) {
    $('#formEditVacacion').trigger('reset');
    max=$('#date2UsuVac').attr('max');
    min=$('#date2UsuVac').attr('min');
    $('#date1UsuVac_Up').attr({min:min,max:max});
    $('#date2UsuVac_Up').attr({min:min,max:max});
    console.log(data);
    $('#formEditVacacion_id').val("");
    $('#formEditVacacion_id').val(data.id);
    $('#docRespaldo_Up').val(data.uv_codDocResp);
    $('#date1UsuVac_Up').val(data.uv_fecha1);
    $('#date2UsuVac_Up').val(data.uv_fecha2);
    $('#vacDayUser_Up').val(data.uv_diasVac);
    $('#vacOb_Up').val(data.uv_obs);
  }
);
}
function UpdateVacaUser() {
var data={
  _token: $('meta[name=csrf-token]').attr('content'),
  id:$('#formEditVacacion_id').val(),
  docRes:$('#docRespaldo_Up').val(),
  date1:$('#date1UsuVac_Up').val(),
  date2:$('#date2UsuVac_Up').val(),
  vacDayU:$('#vacDayUser_Up').val(),
  vacObs:$('#vacOb_Up').val(),
}
console.log(data);
$.post("/C.S.J.O.bo/RRHH/personal/vacacion/update", data,
  data => {
    console.log(data);
   if (data=='1') {
     notif('1','Registro actualizado');
     $('#btn-close-md-UserVacacionesEdit').click();
     $('#formEditVacacion').trigger('reset');
     listVacacUser(0);
     DayVacacionUser();
   } else {
     notif('2','Error Vuelva a intentarlo')
   } 
  }
);


}
function deleteVacaUser(id) {
	var btn = `
  <button type="button" data-dismiss="modal" class="btn btn-theme">Cancelar</button>
  <button type="button" class="btn btn-theme-inverse" onClick="DestroyVacacion(${id})">Aceptar</button>`;
	$('#btn-vacacion-delete').html(btn);
	$('#md-vacacion-delete').modal('show');
}
function DestroyVacacion(id) {
	data = {
		_token: $('meta[name=csrf-token]').attr('content'),
		id: id
	};
	$.post('/C.S.J.O.bo/RRHH/personal/vacacion/destroy', data, function(e) {
		if (e == 'success') {
			notif('1', 'Regsitro Eliminado');
			$('#btn-md-vacacion-delete').click();
      listVacacUser();
      DayVacacionUser();
		} else {
			notif('2', 'Error!. Vueva a intentarlo');
		}
	});
}



