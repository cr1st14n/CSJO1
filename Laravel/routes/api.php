<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

#Route::middleware('auth:api')->get('/user', function (Request $request) {
#   return $request->user();
#});

//Api ruta de pacientes 

Route::get('/buscarPacienteNombre/{nombre}','AjaxPacienteController@buscarPacientesText');
Route::get('/buscarPacienteHCL/{HCL}','AjaxPacienteController@buscarPacientesHCL');
Route::get('/listNotasDelDia/{user}','AjaxNotPreController@listNotasActual');
Route::get('/buscNota/{nota}','AjaxNotPreController@buscarNota');
