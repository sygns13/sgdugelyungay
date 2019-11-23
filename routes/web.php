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


Route::post('crearusuario','PersonaController@store');
Route::post('resetclave','PersonaController@resetclave');
Route::post('principal/consultadni','PrincipalController@consultadni');



Route::group(['middleware' => 'auth'], function () {


    Route::get('salir', function () {
        //return view('welcome');
        Auth::logout();
        return redirect('loginn');
    });
    
    
        Route::get('tipodocumento','TipodocumentoController@index1');
       /*  Route::get('formarecepcion','FormarecepcionController@index1'); */
        Route::get('unidadorganica','UnidadorganicaController@index1');
        Route::get('entidad','EntidadController@index1');
        Route::get('prioridad','PrioridadController@index1');
        Route::get('procetramites','TramiteController@index3');
        Route::get('usuarios','UserController@index1');
        Route::get('usuariosmail','UsermailController@index1');
        Route::get('miperfil','UserController@index2');
        


        Route::resource('tipodocumentos','TipodocumentoController');
        Route::resource('formarecepcions','FormarecepcionController');
        Route::resource('unidadorganicas','UnidadorganicaController');
        Route::resource('entidads','EntidadController');
        Route::resource('prioridads','PrioridadController');
        Route::resource('enviarMail','MailController');
        Route::resource('enviarSMS','SmsController');
        Route::resource('usuariomail','UsermailController');
/*         Route::resource('usuariosms','UsersmsController'); */
        Route::resource('principal','PrincipalController');
        Route::resource('usuario','UserController');
     
        Route::get('tipodocumentos/altabaja/{id}/{var}','TipodocumentoController@altabaja');
        Route::get('formarecepcions/altabaja/{id}/{var}','FormarecepcionController@altabaja');
        Route::get('unidadorganicas/altabaja/{id}/{var}','UnidadorganicaController@altabaja');
        Route::get('entidads/altabaja/{id}/{var}','EntidadController@altabaja');
        Route::get('prioridads/altabaja/{id}/{var}','PrioridadController@altabaja');
        Route::get('procetramite','TramiteController@indexpt');
        Route::get('usuario/verpersona/{dni}','UserController@verpersona');
        Route::get('usuario/altabaja/{id}/{var}','UserController@altabaja');

        Route::post('procetramites/procesar','TramiteController@procesar');
        Route::post('procetramites/notificar','TramiteController@notificar');
        Route::post('usuario/miperfil','UserController@miperfil');
        Route::post('usuario/modificarclave','UserController@modificarclave');
        
        Route::post('procetramites/anular','TramiteController@anular');
        
        
        //Rutas Usuarios
        Route::get('mistramites','TramiteController@index1');
        Route::resource('mitramite','TramiteController');
                Route::get('mitramite/altabaja/{id}/{var}','TramiteController@altabaja');
                
                Route::get('reghistoricos','TramiteController@index2');
                Route::get('reghistorico','TramiteController@indexh');
                



                //Rutas envio mail sms
                Route::get('send','mailController@send');
                Route::get('sendSMS','SmsController@sendSms');

        


        






 
});
