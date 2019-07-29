<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Unidadorganica;
use Validator;
use Auth;
use DB;

use App\Persona;
use App\Alumno;
use App\Tipouser;
use App\User;

class UnidadorganicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index1()
    {
        if(accesoUser([1])){


            $idtipouser=Auth::user()->tipouser_id;
            $tipouser=Tipouser::find($idtipouser);


            $modulo="unidadorganica";
            return view('unidadorganica.index',compact('tipouser','modulo'));
        }
        else
        {
            return view('adminlte::home');           
        }
    }


    public function index(Request $request)
    {
        $buscar=$request->busca;
        $unidadorganicas = Unidadorganica::where('borrado','0')
        ->where(function($query) use ($buscar){
            $query->where('nombre', 'like', '%'.$buscar.'%');
            $query->orWhere('codigo', 'like', '%'.$buscar.'%');
            $query->orWhere('siglas', 'like', '%'.$buscar.'%');
            $query->orWhere('abreviatura', 'like', '%'.$buscar.'%');
        })
        ->orderBy('id')->paginate(50);

        return [
            'pagination'=>[
                'total'=> $unidadorganicas->total(),
                'current_page'=> $unidadorganicas->currentPage(),
                'per_page'=> $unidadorganicas->perPage(),
                'last_page'=> $unidadorganicas->lastPage(),
                'from'=> $unidadorganicas->firstItem(),
                'to'=> $unidadorganicas->lastItem(),
            ],
            'unidadorganicas'=>$unidadorganicas
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
        $codigo=$request->codigo;
        $siglas=$request->siglas;
        $abreviatura=$request->abreviatura;
        $nombre=$request->nombre;
        $activo=$request->activo;

        $input1  = array('nombre' => $nombre);
        $reglas1 = array('nombre' => 'required');

        $input2  = array('nombre' => $nombre);
        $reglas2 = array('nombre' => 'unique:unidadorganicas,nombre'.',1,borrado');

        $input3  = array('activo' => $activo);
        $reglas3 = array('activo' => 'required');

        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);
        $validator3 = Validator::make($input3, $reglas3);
  
        $result='1';
        $msj='';
        $selector='';

        if ($validator1->fails())
        {
            $result='0';
            $msj='Debe ingresar la Unidad Orgánica';
            $selector='txtunidaorg';

        }elseif ($validator2->fails()) {
            $result='0';
            $msj='La Unidad Orgánica ingresada ya se encuentra registrada';
            $selector='txtunidaorg';
        }elseif ($validator3->fails()) {
            $result='0';
            $msj='Debe de ingresar el estado de la Unidad Orgánica';
            $selector='cbuestado';
        }
        else{
            $newTipoDoc = new Unidadorganica();
            $newTipoDoc->codigo=$codigo;
            $newTipoDoc->siglas=$siglas;
            $newTipoDoc->nombre=$nombre;
            $newTipoDoc->activo=$activo;
            $newTipoDoc->abreviatura=$abreviatura;
            $newTipoDoc->borrado='0';

            $newTipoDoc->save();

            $msj='Nueva Unidad Orgánica Registrada con Éxito';
        }

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
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
        $codigo=$request->codigo;
        $siglas=$request->siglas;
        $abreviatura=$request->abreviatura;
        $nombre=$request->nombre;
        $activo=$request->activo;

        $input1  = array('nombre' => $nombre);
        $reglas1 = array('nombre' => 'required');

        $input2  = array('nombre' => $nombre);
       // $reglas2 = array('nombre' => 'unique:unidadorganicas,nombre'.',1,borrado');
       $reglas2 = array('nombre' => 'unique:unidadorganicas,nombre,'.$id.',id,borrado,0');

        $input3  = array('activo' => $activo);
        $reglas3 = array('activo' => 'required');

        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);
        $validator3 = Validator::make($input3, $reglas3);
  
        $result='1';
        $msj='';
        $selector='';

        if ($validator1->fails())
        {
            $result='0';
            $msj='Debe ingresar la Unidad Orgánica';
            $selector='txtunidaorgE';

        }elseif ($validator2->fails()) {
            $result='0';
            $msj='La Unidad Orgánica ingresada ya se encuentra registrada';
            $selector='txtunidaorgE';
        }elseif ($validator3->fails()) {
            $result='0';
            $msj='Debe de ingresar el estado de la Unidad Orgánica';
            $selector='cbuestadoE';
        }
        else{
            $newTipoDoc =Unidadorganica::findOrFail($id);
            $newTipoDoc->codigo=$codigo;
            $newTipoDoc->siglas=$siglas;
            $newTipoDoc->nombre=$nombre;
            $newTipoDoc->activo=$activo;
            $newTipoDoc->abreviatura=$abreviatura;

            $newTipoDoc->save();

            $msj='Unidad Orgánica modificada exitosamente';
        }

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
    }

    public function altabaja($id,$estado)
    {
        $result='1';
        $msj='';
        $selector='';

        $update = Unidadorganica::findOrFail($id);
        $update->activo=$estado;
        $update->save();

        if(strval($estado)=="0"){
            $msj='La Unidad Orgánica fue Desactivada exitosamente';
        }elseif(strval($estado)=="1"){
            $msj='La Unidad Orgánica fue Activada exitosamente';
        }

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result='1';
        $msj='1';

      /*   $consulta=DB::table('facultads')
        ->join('escuelas', 'escuelas.facultad_id', '=', 'facultads.id')
        ->where('escuelas.borrado','0')
        ->where('facultads.id',$id)->count(); */

       /*  if ($consulta>0) {
            $result='0';
            $msj='La Facultad Seleccionada no puede ser eliminada, debido a que cuenta con registros de Escuelas Academicas dentro de ella';
        }else{
 */
            $borrar = Unidadorganica::findOrFail($id);
        //$task->delete();

            $borrar->borrado='1';

            $borrar->save();

            $msj='Unidad Orgánica eliminada exitosamente';
      /*   } */

        return response()->json(["result"=>$result,'msj'=>$msj]);
    }
}
