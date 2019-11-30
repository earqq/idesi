<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('clientes','ClienteController@index');
Route::post('clientes/nuevo', 'ClienteController@store');
Route::get('clientes/datos', 'ClienteController@datos');
Route::get('clientes/datos/prestamo/{documento}', 'ClienteController@general');
Route::get('clientes/perfil/{documento}', 'ClienteController@show');
Route::post('clientes/prestamo', 'ClienteController@prestamo');
Route::post('clientes/visita/nuevo', 'ClienteController@visitaStore');
Route::get('clientes/visitas/{prestamo}', 'ClienteController@visitas');
Route::get('clientes/prestamo/ver/{prestamo}', 'ClienteController@prestamoVer');
 
Route::get('evaluaciones/prestamos', 'EvaluacionController@prestamos');
Route::get('evaluaciones/prestamos/detalle/{prestamo}', 'EvaluacionController@show');
Route::get('evaluaciones/prestamos/evaluar/{prestamo}', 'EvaluacionController@evaluar');

Route::post('/consulta/dni','ConsultaController@dni');
Route::get('{path}',"HomeController@index")->where('path','([A-z\d-\/_.]+)?'); 