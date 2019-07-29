<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entidad;
use Validator;
use Auth;
use DB;

use App\Persona;
use App\Alumno;
use App\Tipouser;
use App\User;

class EntidadController extends Controller
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


            $modulo="entidades";
            return view('entidades.index',compact('tipouser','modulo'));
        }
        else
        {
            return view('adminlte::home');           
        }
    }


    public function index(Request $request)
    {
        $buscar=$request->busca;
        $entidads = Entidad::where('borrado','0')
        ->where(function($query) use ($buscar){
            $query->where('nombre', 'like', '%'.$buscar.'%');
            $query->orWhere('codigo', 'like', '%'.$buscar.'%');
            $query->orWhere('siglas', 'like', '%'.$buscar.'%');
            $query->orWhere('abrev', 'like', '%'.$buscar.'%');
        })
        ->orderBy('id')->paginate(50);

        return [
            'pagination'=>[
                'total'=> $entidads->total(),
                'current_page'=> $entidads->currentPage(),
                'per_page'=> $entidads->perPage(),
                'last_page'=> $entidads->lastPage(),
                'from'=> $entidads->firstItem(),
                'to'=> $entidads->lastItem(),
            ],
            'entidads'=>$entidads
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
        $reglas2 = array('nombre' => 'unique:entidads,nombre'.',1,borrado');

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
            $msj='Debe ingresar en Nombre de la Entidad';
            $selector='txtnombre';

        }elseif ($validator2->fails()) {
            $result='0';
            $msj='La Entidad ingresada ya se encuentra registrada';
            $selector='txtnombre';
        }elseif ($validator3->fails()) {
            $result='0';
            $msj='Debe de ingresar el estado de la Entidad';
            $selector='cbuestado';
        }
        else{
            $newTipoDoc = new Entidad();
            $newTipoDoc->codigo=$codigo;
            $newTipoDoc->siglas=$siglas;
            $newTipoDoc->nombre=$nombre;
            $newTipoDoc->activo=$activo;
            $newTipoDoc->abrev=$abreviatura;
            $newTipoDoc->detalle='';
            $newTipoDoc->borrado='0';

            $newTipoDoc->save();

            $msj='Nueva Entidad Registrada con Éxito';
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
        $abrev=$request->abrev;
        $nombre=$request->nombre;
        $activo=$request->activo;

        $input1  = array('nombre' => $nombre);
        $reglas1 = array('nombre' => 'required');

        $input2  = array('nombre' => $nombre);
       // $reglas2 = array('nombre' => 'unique:unidadorganicas,nombre'.',1,borrado');
       $reglas2 = array('nombre' => 'unique:entidads,nombre,'.$id.',id,borrado,0');

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
            $msj='Debe ingresar el nombre de la Entidad';
            $selector='txtnombreE';

        }elseif ($validator2->fails()) {
            $result='0';
            $msj='La Entidad ingresada ya se encuentra registrada';
            $selector='txtnombreE';
        }elseif ($validator3->fails()) {
            $result='0';
            $msj='Debe de ingresar el estado de la Entidad';
            $selector='cbuestadoE';
        }
        else{
            $newTipoDoc =Entidad::findOrFail($id);
            $newTipoDoc->codigo=$codigo;
            $newTipoDoc->siglas=$siglas;
            $newTipoDoc->nombre=$nombre;
            $newTipoDoc->activo=$activo;
            $newTipoDoc->abrev=$abrev;

            $newTipoDoc->save();

            $msj='Entidad modificada exitosamente';
        }

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function altabaja($id,$estado)
    {
        $result='1';
        $msj='';
        $selector='';

        $update = Entidad::findOrFail($id);
        $update->activo=$estado;
        $update->save();

        if(strval($estado)=="0"){
            $msj='La Entidad fue Desactivada exitosamente';
        }elseif(strval($estado)=="1"){
            $msj='La Entidad fue Activada exitosamente';
        }

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);

    }


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
            $borrar = Entidad::findOrFail($id);
        //$task->delete();

            $borrar->borrado='1';

            $borrar->save();

            $msj='Entidad eliminada exitosamente';
      /*   } */

        return response()->json(["result"=>$result,'msj'=>$msj]);
    }
}
