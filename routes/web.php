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



Route::group(['middleware' => 'auth'], function () {


    Route::get('salir', function () {
        //return view('welcome');
        Auth::logout();
        return redirect('loginn');
    });
    
    
        Route::get('send','mailController@send');
    
        Route::get('sendSMS','SmsController@sendSms');



 
});
