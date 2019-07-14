<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\User;


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

            $persona=DB::table('personas')
            ->join('users', 'users.persona_id', '=', 'personas.id')
            ->join('tipousers','tipousers.id','=','users.tipouser_id')
            ->where('users.borrado','0')
            ->where('users.id',$iduser)
            ->select('personas.id as idper', 'personas.doc as dni', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc', 'users.id as idUsser', 'users.name as username', 'users.email','users.activo as activouser','tipousers.nombre as tipouser')->get();

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
        ->leftJoin('dependencias', 'users.dependencia_id', '=', 'dependencias.id')
        ->leftJoin('distritos', 'dependencias.distrito_id', '=', 'distritos.id')
        ->leftJoin('provincias', 'distritos.provincia_id', '=', 'provincias.id')
        ->where('users.borrado','0')
        ->where('tipousers.activo','1')
            ->where(function($query) use ($buscar){
        $query->where('personas.doc','like','%'.$buscar.'%');
        $query->orWhere('personas.apellidos','like','%'.$buscar.'%');
        $query->orWhere('personas.nombres','like','%'.$buscar.'%');
        $query->orWhere('users.name','like','%'.$buscar.'%');
        $query->orWhere('distritos.nombre','like','%'.$buscar.'%');
        $query->orWhere('provincias.nombre','like','%'.$buscar.'%');
    })
        ->orderBy('tipousers.id')
        ->orderBy('users.id')
        ->orderBy('personas.apellidos')
        ->select('users.id as iduser','users.name as username','users.email','users.token2','users.activo','users.dependencia_id','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.doc', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc','dependencias.id as idDep','dependencias.nombre as dependencia','distritos.id as idDis', 'distritos.nombre as distrito', 'provincias.id as idProv','provincias.nombre as provincia')->paginate(10);


        $usuarios2=DB::table('users')
        ->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
        ->join('personas', 'users.persona_id', '=', 'personas.id')
        ->leftJoin('dependencias', 'users.dependencia_id', '=', 'dependencias.id')
        ->leftJoin('distritos', 'dependencias.distrito_id', '=', 'distritos.id')
        ->leftJoin('provincias', 'distritos.provincia_id', '=', 'provincias.id')
        ->where('users.borrado','0')
        ->where('tipousers.activo','1')
            ->where(function($query) use ($buscar){
        $query->where('personas.doc','like','%'.$buscar.'%');
        $query->orWhere('personas.apellidos','like','%'.$buscar.'%');
        $query->orWhere('personas.nombres','like','%'.$buscar.'%');
        $query->orWhere('users.name','like','%'.$buscar.'%');
        $query->orWhere('distritos.nombre','like','%'.$buscar.'%');
        $query->orWhere('provincias.nombre','like','%'.$buscar.'%');
    })
        ->orderBy('tipousers.id')
        ->orderBy('users.id')
        ->orderBy('personas.apellidos')
        ->select('users.id as iduser','users.name as username','users.email','users.token2','users.activo','users.dependencia_id','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.doc', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc','dependencias.id as idDep','dependencias.nombre as dependencia','distritos.id as idDis', 'distritos.nombre as distrito', 'provincias.id as idProv','provincias.nombre as provincia')->get();

        $tipousers=Tipouser::where('borrado','0')->where('activo','1')->where('id','<','4')->orderBy('id')->get();

        $provincias=Provincias::where('distritojudicial_id','1')->get();

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
            'provincias'=>$provincias,
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
