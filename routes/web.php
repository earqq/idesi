<?php
/**
 *  MIDDLEWARE DE INVITADOS
 */
Route::group(['middleware'=>['guest']],function(){

    Route::get('/','Auth\LoginController@showLoginForm');
    Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
    Route::post('/access', 'Auth\LoginController@login')->name('access');

});

/**
 *  MIDDLEWARE DE INVITADOS
 */
Route::group(['middleware'=>['auth']],function(){

    Route::group(['middleware'=>['Administrador']],function(){

        Route::get('/inicio', function () {
            return view('index');
        })->name('inicio');
        
        Route::get('/', function () {
            return view('index');
        });
        

        Route::get('user/tipo','UserController@tipo');

        Route::get('/user', 'UserController@index');
        Route::post('/user/registrar', 'UserController@store');
        Route::put('/user/actualizar', 'UserController@update');
        Route::put('/user/desactivar', 'UserController@desactivar');
        Route::put('/user/activar', 'UserController@activar');


        Route::get('/rol/selectRol', 'RolController@selectRol');

        Route::get('clientes/listado','ClienteController@index');
        Route::post('clientes/nuevo', 'ClienteController@store');
        Route::post('clientes/nuevo/natural', 'ClienteController@storeNatural');
        Route::post('clientes/nuevo/juridico', 'ClienteController@storeJuridico');
        Route::get('clientes/datos', 'ClienteController@datos');
        Route::get('clientes/datos/prestamo/{documento}', 'ClienteController@general');
        Route::get('clientes/perfil/cliente/{documento}', 'ClienteController@showCliente'); 
        Route::get('clientes/perfil/{documento}', 'ClienteController@show');
        Route::post('clientes/prestamo', 'ClienteController@prestamo');
        Route::post('clientes/visita/nuevo', 'ClienteController@visitaStore');
        Route::get('clientes/visitas/{prestamo}', 'ClienteController@visitas');

        Route::get('/clientes/solicitudPdf/{prestamo}','ClienteController@SolicitudPdf')->name('solicitud_pdf');

        Route::get('clientes/prestamo/ver/{prestamo}', 'ClienteController@prestamoVer');
        Route::get('evaluaciones/prestamos', 'EvaluacionController@prestamos');
        Route::get('evaluaciones/prestamos/detalle/{prestamo}', 'EvaluacionController@show');
        Route::get('evaluaciones/prestamos/detalleF/{prestamo}', 'EvaluacionController@showF');
        Route::post('evaluaciones/prestamos/evaluar', 'EvaluacionController@evaluar');

        Route::post('/consulta/dni','ConsultaController@dni');

        /**
         * RUTAS ARCHIVOS
         */
        Route::get('/files/{id}', 'FileController@index');
        Route::post('files/add', 'FileController@store');
        Route::get('files/delete/{id}/{prestamo}', 'FileController@destroy');
 

        Route::get('{path}',"HomeController@index")->where('path','([A-z\d-\/_.]+)?'); 


    });

    



});





