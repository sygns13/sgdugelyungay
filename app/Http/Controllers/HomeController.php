<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Tipouser;
use App\User;

use App\Iniciosesion;
use stdClass;
use DB;


use Auth;
/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */

 

    public function index(Request $request)
    {

        $iduser=Auth::user()->id;

        $numuser=User::where('id',$iduser)->where('activo','1')->where('borrado','0')->count();
        if($numuser==1){

            $idtipouser=Auth::user()->tipouser_id;
            $tipouser=Tipouser::find($idtipouser);
            


            $fec=date("Y-m-d");
            $hra=date("H:i:s");



            if(accesoUser([1]) ){

                $modulo="inicioAdmin";
                return view('inicio.home',compact('tipouser','modulo','iduser'));

            }
            


            

         }
        else{
            Auth::logout();

          return redirect()->back()
            ->withErrors([
                'email' => 'usuarioActiv'
            ]);
        }
    }



        

       





}
