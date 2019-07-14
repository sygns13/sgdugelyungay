<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tipodocumento;
use App\Formarecepcion;
use App\Prioridad;
use App\Unidadorganica;
use Validator;
use Auth;
use DB;

use App\Persona;
use App\Alumno;
use App\Tipouser;
use App\User;

class PrincipalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        $buscar=$request->busca;

        $tipodocumentos = Tipodocumento::where('borrado','0')->where('activo','0')->orderBy('id')->get();
        $formarecepcions = Formarecepcion::where('borrado','0')->where('activo','0')->orderBy('id')->get();
        $prioridads = Prioridad::where('borrado','0')->where('activo','0')->orderBy('id')->get();
        $unidadorganicas = Unidadorganica::where('borrado','0')->where('activo','0')->orderBy('id')->get();

        return [

            'formarecepcions'=>$formarecepcions
        ];
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
