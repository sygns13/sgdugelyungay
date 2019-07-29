<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\User;
use App\Tipouser;


use Validator;
use Auth;
use DB;
use Storage;

class UsermailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index1()
    {
        if(accesoUser([1,2])){

            $iduser=Auth::user()->id;
            $idtipouser=Auth::user()->tipouser_id;
            $tipouser=Tipouser::find($idtipouser);

            $modulo="usuariosmail";

            return view('usuariosmail.index',compact('modulo','tipouser'));

        }
        else
        {
            return view('adminlte::home');           
        }
    }



    public function index(Request $request)
    {
        $buscar=$request->busca;

        $usuarios=DB::table('users')
        ->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
        ->join('personas', 'users.persona_id', '=', 'personas.id')
        ->where('users.borrado','0')
        ->where('tipousers.activo','1')
            ->where(function($query) use ($buscar){
        $query->where('personas.dni','like','%'.$buscar.'%');
        $query->orWhere('personas.apellidos','like','%'.$buscar.'%');
        $query->orWhere('personas.nombres','like','%'.$buscar.'%');
        $query->orWhere('users.name','like','%'.$buscar.'%');
        $query->orWhere('users.email','like','%'.$buscar.'%');
    })
        ->orderBy('tipousers.id')
        ->orderBy('personas.apellidos')
        ->orderBy('users.id')
        ->select('users.id as iduser','users.name as username','users.email','users.activo','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.dni', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.direccion')->paginate(20);


        $usuarios2=DB::table('users')
        ->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
        ->join('personas', 'users.persona_id', '=', 'personas.id')
        ->where('users.borrado','0')
        ->where('tipousers.activo','1')
            ->where(function($query) use ($buscar){
        $query->where('personas.dni','like','%'.$buscar.'%');
        $query->orWhere('personas.apellidos','like','%'.$buscar.'%');
        $query->orWhere('personas.nombres','like','%'.$buscar.'%');
        $query->orWhere('users.name','like','%'.$buscar.'%');
        $query->orWhere('users.email','like','%'.$buscar.'%');
    })
        ->orderBy('tipousers.id')
        ->orderBy('personas.apellidos')
        ->orderBy('users.id')
        ->select('users.id as iduser','users.name as username','users.email','users.activo','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.dni', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.direccion')->get();

        $tipousers=Tipouser::where('borrado','0')->where('activo','1')->where('id','<','4')->orderBy('id')->get();



        return [
            'pagination'=>[
                'total'=> $usuarios->total(),
                'current_page'=> $usuarios->currentPage(),
                'per_page'=> $usuarios->perPage(),
                'last_page'=> $usuarios->lastPage(),
                'from'=> $usuarios->firstItem(),
                'to'=> $usuarios->lastItem(),
            ],
            'usuarios'=>$usuarios,
            'tipousers'=>$tipousers,
            'usuarios2'=>$usuarios2,
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
