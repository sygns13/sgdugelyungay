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


Route::get('login', function () {
    //return view('welcome');
    return redirect('loginn');
});

Route::get('/login', function () {
    //return view('welcome');
    return redirect('loginn');
});


Route::get('/', function () {
    //return view('welcome');
    return redirect('loginn');
});

Route::get('loginn','Auth\LoginController@showLoginForm');
Route::post('loginn','Auth\LoginController@login');

// ---------------------------------- DE VALE----------------------------------------
// ----------------------------------------------------------------------------------

Route::get('mensajeInicial-inicio','PresentacionInicioController@inicio');
Route::get('funciones-inicio','FuncionesController@inicio');
Route::get('ralbum-inicio','AlbumController@inicio');
Route::get('videoPresentacion-inicio','VideoPresentacionController@inicio');
Route::get('documentosGestioninicio','DocumentoGestionController@inicio');

Route::get('rgaleria-inicio','GaleriaController@inicio');

// -----------------------------------------------------------------------------------
// ---------------------------------- DE VALE ----------------------------------------

Route::group(['middleware' => 'auth'], function () {



    /******************* parte web ******************************************/


Route::get('nosotros','HomeController@nosotros');
Route::get('galeriaFotos','HomeController@galeria');
Route::get('calendar','HomeController@calendar');
Route::get('violencia','HomeController@violencia');
Route::get('indicador1','HomeController@indicador1');
Route::get('indicador2','HomeController@indicador2');
Route::get('indicador3','HomeController@indicador3');

Route::get('myaccount','HomeController@myaccount');
Route::post('usuario/cambiarclave','UserController@cambiarclave');
//Route::get('indicador4','HomeController@indicador4');

Route::get('home2','HomeController@home2');
Route::get('home3','HomeController@home3');

    /******************* cierro web *******************************************/


    /******Parte Usuario Consulta ************ */

    Route::get('consultahome2','HomeController@consultahome2');
    Route::get('consultahome3','HomeController@consultahome3');
    Route::get('consultagaleriaFotos','HomeController@consultagaleriaFotos');
    Route::get('consultacalendar','HomeController@consultacalendar');

    Route::get('reportesAdmin','HomeController@reportesAdmin');
    Route::get('consultaindicador2','HomeController@consultaindicador2');
    Route::get('consultaindicador1/{idUserConsulta}','HomeController@consultaindicador1');
    Route::get('consultaindicador3','HomeController@consultaindicador3');

    /********Cierro User Consulta*************/


Route::get('salir', function () {
    //return view('welcome');
    Auth::logout();
    return redirect('loginn');
});


	Route::get('send','mailController@send');

    Route::get('sendSMS','SmsController@sendSms');


    Route::get('especialidad','EspecialidadController@index1');
    Route::get('subespecialidad','SubespecialidadController@index1');
    Route::get('organojudicial','OrganojudicialController@index1');
    Route::get('asignarprovincia','ProvinciaDistritojudicialController@index1');
    Route::get('funcion','FuncionController@index1');
    Route::get('dependencias','DependenciaController@index1');
    Route::get('expedientes','ExpedientesController@index1');
    Route::get('usuarios','UserController@index1');
    Route::get('magistrados','PersonaController@index1');
    Route::get('analisisgeneral','RepGeneralController@index1');
    Route::get('analisisdetallado','RepDetalladoController@index1');
    Route::get('ingresados','RepIngresosController@index1');
    Route::get('resueltos','RepResueltosController@index1');
    Route::get('userreporte','repUserController@index1');
    Route::get('magistradoreporte','repMagistradoController@index1');
    Route::get('magistradoreporte','repMagistradoController@index1');
    Route::get('foro','ForoController@index1');
    Route::get('usuariosmail','UsermailController@index1');
    Route::get('usuariossms','UsersmsController@index1');
    Route::get('usuariosalert','UseralertController@index1');
    Route::get('magistradosmail','MagistradomailController@index1');
    Route::get('magistradossms','MagistradosmsController@index1');
    Route::get('ingresoprocesos','ProcesosController@index1');
    Route::get('reporteprocesos','RepProcesosController@index1');

    Route::get('analisisgeneral2','RepGeneral2Controller@index1');
    Route::get('analisisgeneral3','RepGeneral3Controller@index1');
    Route::get('porcentajes','PorcentajeController@index1');
    
    Route::get('analisisanual','RepAnualController@index1');

    Route::get('repGeneral/changeDep/{idProv}/{anio}','RepGeneralController@changeDep');

    Route::get('procesosviolencia','ProcesosviolenciaController@index1');



    Route::resource('especialidades','EspecialidadController');
    Route::resource('subespecialidades','SubespecialidadController');
    Route::resource('organojudicials','OrganojudicialController');
    Route::resource('asignarprovincias','ProvinciaDistritojudicialController');
    Route::resource('funciones','FuncionController');
    Route::resource('dependencia','DependenciaController');
    Route::resource('expediente','ExpedientesController');
    Route::resource('usuario','UserController');
    Route::resource('persona','PersonaController');
    Route::resource('magistrado','MagistradoController');
    Route::resource('repmagistrado','repMagistradoController');
    Route::resource('magistradomail','MagistradomailController');
    Route::resource('magistradosms','MagistradosmsController');
    Route::resource('foros','ForoController');
    Route::resource('respuestaforo','RespuestaForoController');
    Route::resource('usuariomail','UsermailController');
    Route::resource('usuariosms','UsersmsController');
    Route::resource('usuarioalert','UseralertController');
    Route::resource('repusuarios','repUserController');
    Route::resource('repGeneral','RepGeneralController');
    
    Route::resource('repDetallado','RepDetalladoController');
    Route::resource('repIngresado','RepIngresosController');
    Route::resource('repResuelto','RepResueltosController');
    Route::resource('estandar','EstandarController');
    Route::resource('meta','MetasController');
    Route::resource('enviarMail','MailController');
    Route::resource('enviarSMS','SmsController');
    Route::resource('procesos','ProcesosController');

    Route::resource('repGeneral2','RepGeneral2Controller');
    Route::resource('repGeneral3','RepGeneral3Controller');
    Route::resource('pocernt','PorcentajeController');
    Route::resource('activoanio','ActivoanioController');
    Route::resource('repanual','RepAnualController');

    Route::resource('procesosviolenciafamiliar','ProcesosviolenciaController');




    Route::get('especialidades/altabaja/{id}/{var}','EspecialidadController@altabaja');
    Route::get('subespecialidades/altabaja/{id}/{var}','SubespecialidadController@altabaja');
    Route::get('organojudicials/altabaja/{id}/{var}','OrganojudicialController@altabaja');
    Route::get('asignarprovincias/altabaja/{id}/{var}','ProvinciaDistritojudicialController@altabaja');
    Route::get('funciones/altabaja/{id}/{var}','FuncionController@altabaja');
    Route::get('asignarprovincias/changeDep/{id}/','ProvinciaDistritojudicialController@changeDep');
    Route::get('dependencia/altabaja/{id}/{var}','DependenciaController@altabaja');
    Route::get('dependencia/changeProv/{id}/','DependenciaController@changeProv');    
    Route::get('usuario/verpersona/{dni}','UserController@verpersona');
    Route::get('usuario/altabaja/{id}/{var}','UserController@altabaja');
    Route::get('persona/verpersona/{dni}','PersonaController@verpersona');
    Route::get('persona/altabaja/{id}/{var}','PersonaController@altabaja');
    Route::get('magistrado/changeProv/{id}/','MagistradoController@changeProv'); 
    Route::get('organojudicials/changeProv/{id}/{anio}','OrganojudicialController@changeProv'); 
    Route::get('organojudicials/changeDis/{id}/{anio}','OrganojudicialController@changeDis'); 
    Route::get('organojudicials/changeOrgano/{id}/','OrganojudicialController@changeOrgano'); 
    Route::get('foros/altabaja/{id}/{var}','ForoController@altabaja');
    Route::get('dependencia/altabajaPro/{id}/{var}','DependenciaController@altabajaPro');

    Route::get('documentosGestionbuscar/{tipo}','DocumentoGestionController@buscartipo');


        Route::get('organojudicials/changeProv2/{id}','OrganojudicialController@changeProv2'); 
    Route::get('organojudicials/changeDis2/{id}','OrganojudicialController@changeDis2'); 

    //Route::resource('prueba','PruebaController');


    Route::post('asignarprovincias/asignar','ProvinciaDistritojudicialController@Asignarprovincia');
    Route::post('repGeneral/buscarDatos','RepGeneralController@buscarDatos');
    Route::post('repGeneral/buscarDatosCompa','RepGeneralController@buscarDatosCompa');
    Route::post('repGeneral/buscarDatosCompa2','RepGeneralController@buscarDatosCompa2');
    Route::post('repDetallado/buscarDatos','RepDetalladoController@buscarDatos');
    Route::post('repDetallado/buscarDatos2','RepDetalladoController@buscarDatos2');
    Route::post('repIngresado/buscarDatos','RepIngresosController@buscarDatos');
    Route::post('repResuelto/buscarDatos','RepResueltosController@buscarDatos');
    Route::post('repmagistrado/buscarDatos','repMagistradoController@buscarDatos');
    Route::post('repProcesos/buscarDatos','RepProcesosController@buscarDatos');

    Route::post('Alertas/buscar','HomeController@revisarAlert');
    Route::get('exportartxt','UseralertController@exportartxt');


    Route::post('repGeneral2/buscarDatos','RepGeneral2Controller@buscarDatos');
    Route::post('repGeneral3/buscarDatos','RepGeneral3Controller@buscarDatos');

    Route::post('repanual/buscarDatos','RepAnualController@buscarDatos');

    Route::post('subreportdetallado','RepDetalladoController@reportemensual');


	  // -------------------------------------- PARTE VALE --------------------------------------------------
    // ----------------------------------------------------------------------------------------------------

    Route::resource('mensajeInicial','PresentacionInicioController');
    Route::POST('mensajeInicial-modificar','PresentacionInicioController@update');
    Route::resource('videoPresentacion','VideoPresentacionController');
    Route::resource('documentosGestion','DocumentoGestionController');
    Route::resource('rcalendario','CalendarioController');
    Route::POST('rcalendario-modificar','CalendarioController@update');
    Route::resource('rgaleria','GaleriaController');
    Route::resource('rfuncion','FuncionesController');
    Route::POST('rfuncion-modificar','FuncionesController@update');

    Route::resource('ralbum','AlbumController');
    Route::post('ralbum/editar','AlbumController@editar');
    Route::POST('ralbum-modificar','AlbumController@update');


    // --------------------------------------- PARTE VALE -------------------------------------------------
    // ----------------------------------------------------------------------------------------------------


    Route::POST('rgaleria/crear','GaleriaController@crear');
    Route::POST('documentosGestion/crear','DocumentoGestionController@crear');








    //Routes Usuarios Standar


     Route::get('msjleido/{idAlert}','HomeController@leerAlerta');


     Route::get('msjleido/{idAlert}','HomeController@leerAlerta');
     Route::get('foroconsulta/{idForo}','ForoController@consulta');


});
