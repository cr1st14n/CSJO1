<?php

use App\Http\Controllers\DescargosMedController;
use Illuminate\Routing\RouteAction;

Route::get('/', function () {
	return redirect('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/time', 'HomeController@time');
Route::get('print', 'pdfController@make1');

Route::post('searchredirect', 'PacienteController@buscar');




// -------pantalla de informaciones-----------//
Route::get('pantallaInformacion','pantInf@index');

//--------------administracion---------//


Route::group(['middleware' => ['administracion'], 'prefix' => '/adm'], function () {
	Route::get('/home', 'HomeController@admHome')->name('adm.Home');
	Route::get('/perfil', 'HomeController@store_perfil')->name('store_user_adm');
	Route::get('/datosAdmHome', 'HomeController@datosAdmHome');
	Route::post('perfil_update_datos', 'HomeController@update_perfil_datos')->name('store_user_adm_update_date');
	Route::post('perfil_update_email', 'HomeController@update_perfil_email')->name('store_user_adm_update_email');

	Route::group(['prefix' => '/users'], function () {

		Route::get('indexA', 'UsersController@index')->name('formNewuserA');
		Route::get('store', 'UsersController@store')->name('storeUsers');
		Route::get('show/{id} ', 'UsersController@show')->name('showuser');
		Route::get('showAll', 'UsersController@showAll');
		Route::get('edit', 'UsersController@edit');
		Route::post('update_date', 'UsersController@update_date')->name('updateUser_date');
		Route::post('update_acceso', 'UsersController@update_acceso')->name('updateUser_acceso');
		Route::get('destroy/{id} ', 'UsersController@destroy')->name('destroy_users');
		Route::get('acceso/{id} ', 'UsersController@accesoOnOff')->name('acceso_user');
	});
	Route::group(['prefix' => '/personal_salud'], function () {
		Route::get('index', 'PersonalSaludController@index')->name('formPS');
		Route::post('create', 'PersonalSaludController@create')->name('registerPS');
		Route::get('edit/{ps_id} ', 'PersonalSaludController@edit')->name('showPS');
		Route::post('update', 'PersonalSaludController@update')->name('updatePS');
		Route::get('destroy/{id}', 'PersonalSaludController@destroy')->name('destroyPS');
	});
	Route::group(['prefix' => '/especialidad'], function () {

		Route::get('index', 'especialidadController@index')->name('formNewEspecialidad');
		Route::post('create', 'especialidadController@register')->name('createEspecialidad');
		Route::get('store', 'especialidadController@store');
		Route::get('show/{id} ', 'especialidadController@show')->name('form_edit_especialidad');
		Route::get('showAll', 'especialidadController@showAll');
		Route::get('edit', 'especialidadController@edit');
		Route::post('update', 'especialidadController@update')->name('update_especialidad');
		Route::get('delete/{id}', 'especialidadController@destroy')->name('destroy_especialidad');
	});
	Route::group(['prefix' => '/area'], function () {

		Route::get('index', 'areaController@index')->name('formNewArea');
		Route::post('create', 'areaController@create')->name('createArea');
		Route::get('store', 'areaController@store');
		Route::get('showAll', 'areaController@showAll');
		Route::get('edit', 'areaController@edit');
		Route::get('update', 'areaController@update');
		Route::get('destroy', 'areaController@destroy');
		
		// ?-- new app
		Route::get('show', 'areaController@show');
		Route::get('list','areaController@list');
	});
	Route::group(['prefix' => '/reporte'], function () {
		Route::get('home', 'HomeController@admReportHome')->name('admReportHome');
		Route::any('reporteDiario_Imprimir', 'cajaController@reporteDiario')->name('reporteDiario_adm');
		Route::any('reporteMensual', 'cajaController@reporteMensual')->name('reporteMensual_adm');
	});
	Route::group(['prefix' => '/admRecepHome'], function () {
		Route::get('/', 'admRecepController@index')->name('home-admRecep');
		Route::get('1', 'admRecepController@uno');
		Route::get('BuscHCL', 'admRecepController@buscasrHCL');
		Route::get('InfoCajaList', 'admRecepController@InfoCajaList');
		Route::get('detalleCajaEspecialidad', 'admRecepController@detalleCajaEspecialidad');
		Route::get('historiaHCLAte/{id}', 'admRecepController@historiaHCLAte');
		Route::get('actRegistroPaci', 'admRecepController@actRegistroPaci');
		Route::get('actRegistroEsp', 'admRecepController@actRegistroEsp');
		Route::get('actRegistroMed', 'admRecepController@actRegistroMed');
		Route::get('DatosEstAnualesMedico', 'admRecepController@DatosEstAnualesMedico');
	});
	Route::group(['prefix' => '/cotizaciones'],function ()
	{
		route::get('home','cotizacionController@index');
		route::get('list1','cotizacionController@list1');
		route::get('list2','cotizacionController@list2');
		route::get('store1','cotizacionController@store1');
		route::post('create','cotizacionController@create');
		route::post('update','cotizacionController@update');
		route::get('createPdf','cotizacionController@createPdf');
	});
	Route::group(['prefix'=>'descargosMedicos'],function ()
	{
		route::get('home','DescargosMedController@home');
		Route::get('index1','DescargosMedController@list1');
		route::resource('desMed','DescargosMedController');
		route::get('showDetalleDescargo1','DescargosMedController@showDetalleDescargo1');
	});
});

//--------------RECEPCION---------//
Route::group(['middleware' => ['recepcion'], 'prefix' => '/Recepcion'], function () {
	Route::get('home', 'HomeController@recepHome')->name('recepcion.home');
	Route::get('/perfil', 'UsersController@store_perfil')->name('store_user_recepcion');
	Route::post('perfil_update_datos', 'HomeController@update_perfil_datos')->name('store_user_recepcion_update_date');
	Route::post('perfil_update_email', 'HomeController@update_perfil_email')->name('store_user_recepcion_update_email');
	//crud pacientes
	Route::group(['prefix' => '/paciente'], function () {
		Route::get('index', 'PacienteController@index')->name('index_paciente');
		Route::post('register', 'PacienteController@create')->name('register_paciente');
		Route::get('buscar', 'PacienteController@formBuscarPaciente')->name('form_buscar_paciente');
		Route::any('search', 'PacienteController@buscar')->name('buscar_paciente');
		Route::post('PrintHCL', 'PacienteController@print_HCl')->name('print_HCl');
		Route::get('PrintHCL1/{pa_hcl}', 'PacienteController@print_HCl_1')->name('printHcl');
		Route::get('edit/{pa_hcl}', 'PacienteController@edit')->name('edit_paciente');
		Route::post('update', 'PacienteController@update')->name('update_paciente');
		Route::get('delete/{pa_hcl}', 'PacienteController@destroy')->name('destroy_pa_hcl');
	});
	Route::group(['prefix' => '/atencion'], function () {
		Route::get('index/{pa_hcl} ', 'AtencionController@index')->name('form_atencion');
		Route::post('register', 'AtencionController@create')->name('create_atencion');
		Route::any('edit_a/{ate_id}', 'AtencionController@edit')->name('edit_atencion');
		Route::post('update', 'AtencionController@update')->name('update_antencion');
		Route::get('showAll', 'AtencionController@showAll')->name('showAll_atencion');
		Route::post('show', 'AtencionController@show')->name('show');
		Route::get('delete/{id}', 'AtencionController@destroy')->name('delete_atencion');
		Route::get('pagar_ate/{id} ', 'AtencionController@pago')->name('recep_pago');
	});
	Route::group(['prefix'=>'citaPrevia'],function (){
		Route::get('infoPaci','CitPrevController@infoPaci');
		Route::post('create','CitPrevController@create');
		Route::get('index','CitPrevController@indexCitasPrevias')->name('citasPrecias_Index');
		Route::get('listCitasPrevias','CitPrevController@listCitasPrevias');
		Route::get('agendarCitPrev','CitPrevController@agendarCitPrev');
		Route::post('createCitPrevAgendar','CitPrevController@createCitPrevAgendar');
		Route::post('destroy','CitPrevController@destroy');
		Route::get('listagenda1','CitPrevController@listagenda1');
	});
	Route::group(['prefix' => '/reporte'], function () {

		Route::get('inf_atencion', 'AtencionController@showPa_Ate1')->name('inf_atencion');
		Route::post('inf_atencion_list', 'AtencionController@showPa_Ate_list')->name('inf_atencion_list');
		Route::get('index', 'AtencionController@reporte_index')->name('reporte_index');
		Route::get('RD', 'AtencionController@reporte_diario')->name('reporte_diario_p');
	});
	Route::group(['prefix' => '/Notas'], function () {
		Route::get('/', 'RecepNotasController@index')->name('notas-index');
		Route::get('/listNotas', 'RecepNotasController@show')->name('notas-showNotas');
		Route::post('/create', 'RecepNotasController@create')->name('notas-create');
		Route::post('/update', 'RecepNotasController@update')->name('notas-update');
		Route::get('/destroy/{id}', 'RecepNotasController@destroy')->name('notas-destroy');
		Route::post('/filtrarPrestamos/', 'RecepNotasController@filtrarPrestamos');
	});
	Route::group(['prefix' => '/PresHCL'], function () {
		Route::post('/create', 'PrestHCLController@create');
		Route::any('/list', 'PrestHCLController@list');
		Route::post('/listFiltrado', 'PrestHCLController@listFiltrado');
		Route::get('/show/{id}', 'PrestHCLController@show');
		Route::post('/update/', 'PrestHCLController@update');
		Route::get('/cerrarPrestamo/{id}', 'PrestHCLController@cerrarPrestamo');
	});
});

//---------------CAJA------//
Route::group(['middleware' => ['caja'], 'prefix' => '/caja'], function () {
	Route::get('/perfil', 'UsersController@store_perfil')->name('store_user_caja');
	Route::post('/perfil/update_datos', 'HomeController@update_perfil_datos')->name('store_user_caja_update_date');
	Route::post('/perfil/update_email', 'HomeController@update_perfil_email')->name('store_user_caja_update_email');
	Route::get('home', 'cajaController@index')->name('cajaHome');
	Route::get('cola_pacientes', 'cajaController@pacientes_cola')->name('pacientes_cola');
	Route::get('pagar/{id} ', 'cajaController@pago')->name('ate_pago');
	Route::get('fila_pacientes', 'cajaController@store_pagos')->name('store_pagos');
	Route::post('filter_pagos', 'cajaController@store_filter_pagos')->name('filter_pagos');
	Route::get('reportes', 'cajaController@reportes')->name('caja_reporte');
	Route::any('reporteDiario_Imprimir', 'cajaController@reporteDiario')->name('reporteDiario');
	Route::any('reporteMensual', 'cajaController@reporteMensual')->name('reporteMensual');
});

//---------------RRHH------//
Route::group([/*'middleware'=>['caja'],*/'prefix' => '/RRHH'], function () {
	Route::get('/home', 'RecHumanController@index')->name('rrhh_home');
	Route::get('/1', 'RecHumanController@create');
	Route::group(['prefix' => 'tablero'], function () {
		Route::get('/', 'rhTableroController@index')->name('rrhh_tablero');
	});
	Route::group(['prefix' => 'personal'], function () {
		Route::get('/', 'empleadoController@index')->name('empleado_home');
		Route::get('showEmpTodos', 'empleadoController@showEmpTodos');
		Route::get('showDatosEmp/{id}', 'empleadoController@showDatosEmp');
		Route::get('editDatos1Emp', 'empleadoController@editDatos1Emp');
		Route::post('updateDatos1Emp', 'empleadoController@updateDatos1Emp');
		Route::get('editDatos2Emp', 'empleadoController@editDatos2Emp');
		Route::post('updateDatos2Emp', 'empleadoController@updateDatos2Emp');
		Route::get('datos1User', 'empleadoController@datos1User');
		Route::post('createUser', 'empleadoController@createUser');
		Route::post('revCiEmail', 'empleadoController@revCiEmail');
		Route::post('destroy', 'empleadoController@destroy');
		Route::get('listAreasDisponibles','areaController@listAreas');
		//* rutas permisos de personal
		Route::group(['prefix' => 'permiso'], function () {
			Route::post('create', 'PermisosController@create');
			Route::get('show', 'PermisosController@show');
			Route::get('edit', 'PermisosController@edit');
			Route::post('update', 'PermisosController@update');
			Route::get('destroy', 'PermisosController@destroy');
		});
		// *rutas faltas del personal
		Route::group(['prefix' => 'faltas'], function () {
			Route::get('list', 'usuFaltaController@list');
			Route::post('create', 'usuFaltaController@create');
			Route::get('edit', 'usuFaltaController@edit');
			Route::post('update', 'usuFaltaController@update');
			Route::get('update', 'usuFaltaController@update');
			Route::post('delete', 'usuFaltaController@delete');
		});
		//* rutas cambio de turno 
		Route::group(['prefix' => 'cambioTurno'], function () {
			Route::get('list', 'UsuCambioTurnoController@list');
			Route::post('create', 'UsuCambioTurnoController@create');
			Route::get('edit', 'UsuCambioTurnoController@edit');
			Route::post('update', 'UsuCambioTurnoController@update');
			Route::post('delete', 'UsuCambioTurnoController@delete');
		});
		// * rutas vacaciones
		Route::group(['prefix' => 'vacacion'], function () {
			Route::get('index', 'UsuVacacionController@index');
			Route::post('create', 'UsuVacacionController@create');
			Route::get('list1', 'UsuVacacionController@list');
			Route::post('destroy', 'UsuVacacionController@destroy');
			Route::get('showDayV', 'UsuVacacionController@dayVacacion');
			Route::get('edit', 'UsuVacacionController@edit');
			Route::post('update', 'UsuVacacionController@update');
		});
	});
	Route::group(['prefix' => 'Areas'], function () {
		Route::get('/', 'areaController@homeArea')->name('home_area');
		Route::get('listUsuarios', 'areaController@listUsuarios');
		Route::get('listUsuAreaAgregar', 'areaController@listUsuAreaAgregar');
		Route::get('listUsuAreaCambUsu', 'areaController@listUsuAreaCambUsu');
		Route::post('usuAreaCambio', 'areaController@usuAreaCambio');
		Route::post('create', 'areaController@create');
		Route::post('updateUsuEncargado', 'areaController@updateUsuEncargado');
		Route::get('edit','areaController@edit');
		Route::post('update','areaController@update');
		Route::post('delete', 'areaController@delete');
		Route::post('destroy', 'areaController@destroy');
		Route::post('removeUsuArea', 'areaController@removeUsuArea');
	});
});
