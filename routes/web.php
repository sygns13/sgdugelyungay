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
    
    
        Route::get('send','mailController@send');
    
        Route::get('sendSMS','SmsController@sendSms');



        Route::get('tipodocumento','TipodocumentoController@index1');
        Route::get('formarecepcion','FormarecepcionController@index1');
        Route::get('unidadorganica','UnidadorganicaController@index1');



        //Rutas Usuarios
        Route::get('mistramites','TramiteController@index1');
        Route::resource('mitramite','TramiteController');





        Route::resource('tipodocumentos','TipodocumentoController');
        Route::resource('formarecepcions','FormarecepcionController');
        Route::resource('unidadorganicas','UnidadorganicaController');
        Route::resource('enviarMail','MailController');
        Route::resource('enviarSMS','SmsController');
        Route::resource('usuariomail','UsermailController');
        Route::resource('usuariosms','UsersmsController');

        Route::resource('principal','PrincipalController');

        










        Route::get('tipodocumentos/altabaja/{id}/{var}','TipodocumentoController@altabaja');
        Route::get('formarecepcions/altabaja/{id}/{var}','FormarecepcionController@altabaja');
        Route::get('unidadorganicas/altabaja/{id}/{var}','UnidadorganicaController@altabaja');


        


        






 
});
