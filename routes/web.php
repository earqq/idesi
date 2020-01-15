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
Route::get('charge/data','EvaluacionesController@chargeData');
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
        Route::get('clientes/listado/juridico','ClienteController@indexJuridico');
        Route::post('clientes/nuevo', 'ClienteController@store');
        Route::post('clientes/nuevo/natural', 'ClienteController@storeNatural');
        Route::post('clientes/nuevo/juridico', 'ClienteController@storeJuridico');
        Route::get('clientes/datos', 'ClienteController@datos');
        Route::get('clientes/datos/prestamo/{documento}', 'ClienteController@general');
        Route::get('clientes/datos/prestamo/juridico/{documento}', 'ClienteController@generalJuridico');
        Route::get('clientes/perfil/cliente/{documento}', 'ClienteController@showCliente');
        Route::get('clientes/perfil/juridico/cliente/{documento}', 'ClienteController@showClienteJuridico');
        Route::get('clientes/perfil/{documento}', 'ClienteController@show');
        Route::post('clientes/prestamo', 'ClienteController@prestamo');
        Route::post('clientes/prestamo/juridico', 'ClienteController@prestamoJuridico');
        Route::post('clientes/visita/nuevo', 'ClienteController@visitaStore');
        Route::get('clientes/visitas/{prestamo}', 'ClienteController@visitas');

        Route::get('/clientes/solicitudPdf/{prestamo}','ClienteController@SolicitudPdf')->name('solicitud_pdf');


        Route::get('/evaluacion/cualitativaPdf/{prestamo}','EvaluacionesController@CualitativaPdf')->name('cualitativa_pdf');

        Route::get('clientes/prestamo/ver/{prestamo}', 'ClienteController@prestamoVer');
        Route::get('clientes/prestamo/ver/juridico/{prestamo}', 'ClienteController@prestamoVerJuridico');

        // Route::get('clientes/prestamo/ver/aval/{prestamo}', 'ClienteController@avalEditar');
        // Route::get('clientes/prestamo/ver/garantia/{prestamo}', 'ClienteController@garantiaEditar');

        Route::get('evaluaciones/prestamos', 'EvaluacionController@prestamos');
        Route::get('evaluaciones/prestamos/detalle/{prestamo}', 'EvaluacionController@show');
        Route::get('evaluaciones/prestamos/detalleF/{prestamo}', 'EvaluacionController@showF');


        Route::get('evaluaciones/propuestaAnalista/{prestamo}', 'EvaluacionController@propuestaAnalista');
        Route::get('evaluaciones/numerohijos/{prestamo}', 'EvaluacionController@numeroHijos');

        Route::get('evaluaciones/giro', 'EvaluacionController@giro');
        Route::get('evaluaciones/giro/search/{giro}', 'EvaluacionController@searchGiro');
        Route::get('/evaluaciones/datosCualitativas', 'EvaluacionController@datosCualitativas');
        Route::get('evaluaciones/colegio', 'EvaluacionController@colegio');
        Route::get('evaluaciones/colegio/costo', 'EvaluacionController@colegioCosto');

        
        Route::post('evaluaciones/prestamos/evaluar', 'EvaluacionController@evaluar');
        Route::post('evaluaciones/prestamos/evaluarFinal', 'EvaluacionController@evaluarFinal');

        Route::post('/consulta/dni','ConsultaController@dni');

        /**
         * RUTAS ARCHIVOS
         */
        Route::get('/files/{id}', 'FileController@index');
        Route::post('files/add', 'FileController@store');
        Route::get('files/delete/{id}/{prestamo}', 'FileController@destroy');
 

        Route::get('{path}',"HomeController@index")->where('path','([A-z\d-\/_.]+)?'); 

        // evaluaciones cuantitativas y cualitativas
        Route::post('evaluaciones/cuantitativa','EvaluacionesController@saveCuantitativa');
        Route::post('evaluaciones/cualitativa','EvaluacionesController@saveCualitativa');
        
    });

    



});





