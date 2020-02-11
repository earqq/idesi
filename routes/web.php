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
    
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::group(['middleware'=>['Administrador']],function(){

        Route::get('/main', function () {
            return view('index');
        })->name('main');
        
        Route::get('/', function () {
            return view('index');
        });
        
        Route::resource('user','UserController');
        Route::get('/currentUser', 'UserController@currentUser');

        
        //Personas
        Route::resource('personas','PersonasController');
        //Empresas
        Route::resource('empresas','EmpresasController');
        //Clientes
        Route::resource('clientes','ClientesController');
        Route::get('clientes/search/{state}/{text?}','ClientesController@listar');
        Route::get('clientes/aceptar/solicitud/{id}', 'ClientesController@aceptarSolicitud');
        Route::get('clientes/rechazar/solicitud/{id}', 'ClientesController@rechazarSolicitud');
        //Ubigeo
        Route::get('ubigeo', 'UbigeoController@listar');
        //Prestamos
        Route::resource('prestamos','PrestamosController');
        Route::get('prestamos/search/{state}/{text?}','PrestamosController@search');
        //Herramientas
        Route::get('extras/giro', 'ExtrasController@giro');
        Route::get('extras/colegio', 'ExtrasController@colegios');
        Route::get('extras/entidades', 'ExtrasController@entidades');
        Route::get('extras/colegio/costo', 'ExtrasController@colegioCosto');
        Route::post('/consulta/doc','ExtrasController@doc');
        // Analisis
        Route::post('analisis/cualitativa','AnalisisController@saveCualitativa'); 
        Route::post('analisis/cuantitativa','AnalisisController@saveCuantitativa');
        Route::get('analisis/datosCualitativas/{prestamoID}', 'AnalisisController@obtenerCualitativa');




        Route::get('clientes/datos/prestamo/{documento}', 'ClientesController@general');
        Route::get('clientes/enviarEvaluar/{prestamo}', 'ClientesController@enviarEvaluar');

        Route::get('clientes/entregarPrestamo/{prestamo}', 'ClientesController@entregarPrestamo');
        Route::get('clientes/datos/prestamo/juridico/{documento}', 'ClientesController@generalJuridico');
        Route::get('clientes/perfil/cliente/{documento}', 'ClientesController@showCliente');
        Route::get('clientes/perfil/juridico/cliente/{documento}', 'ClientesController@showClienteJuridico');
        Route::get('clientes2/perfil/{documento}', 'ClientesController@show');
        Route::post('clientes2/prestamo', 'ClientesController@prestamo');
        Route::post('clientes/prestamo/juridico', 'ClientesController@prestamoJuridico');
        Route::post('clientes/visita/nuevo', 'ClientesController@visitaStore');
        Route::get('clientes/visitas/{prestamo}', 'ClientesController@visitas');
        Route::get('/clientes/solicitudPdf/{prestamo}','ClientesController@SolicitudPdf')->name('solicitud_pdf');
        Route::get('/clientes/adjuntarPdf/{prestamo}','ClientesController@AdjuntarPdf')->name('adjuntar_pdf');
        Route::get('/evaluacion/cualitativaPdf/{prestamo}','EvaluacionesController@CualitativaPdf')->name('cualitativa_pdf');
        Route::get('/evaluacion/cuantitativaPdf/{prestamo}','EvaluacionesController@CuantitativaPdf')->name('cuantitativa_pdf');
        Route::get('clientes/prestamo/ver/{prestamo}', 'ClientesController@prestamoVer');
        Route::get('clientes/prestamo/ver/juridico/{prestamo}', 'ClientesController@prestamoVerJuridico');
        Route::get('evaluaciones/prestamos', 'EvaluacionController@prestamos');
        Route::get('evaluaciones/prestamosJuridicos', 'EvaluacionController@prestamosJuridico');
        Route::get('evaluaciones/veridicarEvaluacion/{prestamo}', 'EvaluacionController@verificarPrestamo');
        
        Route::post('evaluaciones/prestamos/evaluar', 'EvaluacionController@evaluar');
        Route::post('evaluaciones/prestamos/evaluarFinal', 'EvaluacionController@evaluarFinal');

    

        Route::get('/files/{id}', 'FileController@index');
        Route::post('files/add', 'FileController@store');
        Route::get('files/delete/{id}/{prestamo}', 'FileController@destroy');

        // Route::get('{path}',"HomeController@index")->where('path','([A-z\d-\/_.]+)?');
        // evaluaciones cuantitativas y cualitativas
       
    });


});





