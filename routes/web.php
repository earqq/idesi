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
        Route::get('clientes/datos/prestamo/{id}', 'PrestamosController@show');
        Route::get('clientes/search/{state}/{text?}','ClientesController@listar');
        Route::get('clientes/aceptar/solicitud/{id}', 'ClientesController@aceptarSolicitud');
        Route::get('clientes/rechazar/solicitud/{id}', 'ClientesController@rechazarSolicitud');
        //Ubigeo
        Route::get('ubigeo', 'UbigeoController@listar');
        //Prestamos
        Route::resource('prestamos','PrestamosController');
        Route::get('prestamos/search/{state}/{text?}','PrestamosController@search');
        Route::get('prestamos/enviarEvaluacion/{prestamoID}', 'PrestamosController@enviarEvaluacion');
        Route::post('prestamos/evaluar', 'PrestamosController@evaluar');
        Route::post('prestamos/foto', 'PrestamosController@guardarFoto');    
        Route::post('prestamos/archivos', 'PrestamosController@subirArchivo');
        Route::put('prestamos/archivos/{fileID}', 'PrestamosController@eliminarArchivo');
        //Herramientas
        Route::get('extras/giro', 'ExtrasController@giro');
        Route::get('extras/colegio', 'ExtrasController@colegios');
        Route::get('extras/entidades', 'ExtrasController@entidades');
        Route::get('extras/colegio/costo', 'ExtrasController@colegioCosto');
        Route::post('consulta/doc','ExtrasController@doc');
        // Analisis
        Route::get('analisis/datosCualitativas/{prestamoID}', 'AnalisisController@obtenerCualitativa'); 
        Route::post('analisis/cualitativa','AnalisisController@saveCualitativa'); 
        Route::post('analisis/cuantitativa','AnalisisController@saveCuantitativa');
        //PDF
        Route::get('/pdf/prestamo/expediente/{prestamoID}','PDFController@expediente')->name('adjuntar_pdf');
        Route::get('/pdf/prestamo/{prestamoID}','PDFController@solicitudCredito')->name('solicitud_credito');
        Route::get('/pdf/evaluacion/cualitativa/{prestamoID}','PDFController@cualitativa')->name('cualitativa_pdf');
        Route::get('/pdf/evaluacion/cuantitativa/{prestamoID}','PDFController@cuantitativa')->name('cuantitativa_pdf');




        // Route::get('{path}',"HomeController@index")->where('path','([A-z\d-\/_.]+)?');
        // evaluaciones cuantitativas y cualitativas
       
    });


});





