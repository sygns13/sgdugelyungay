<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tipodocumento;
use Validator;
use Auth;
use DB;

use App\Persona;
use App\Alumno;
use App\Tipouser;
use App\User;


class TipodocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index1()
    {
        if(accesoUser([1,2])){


            $idtipouser=Auth::user()->tipouser_id;
            $tipouser=Tipouser::find($idtipouser);


            $modulo="tipodocumento";
            return view('tipodocumento.index',compact('tipouser','modulo'));
        }
        else
        {
            return view('adminlte::home');           
        }
    }


    public function index(Request $request)
    {
        $buscar=$request->busca;
        $tipodocumentos = Tipodocumento::where('borrado','0')
        ->where(function($query) use ($buscar){
            $query->where('tipo', 'like', '%'.$buscar.'%');
           /*  $query->orWhere('codigo', 'like', '%'.$buscar.'%'); */
        })
        ->orderBy('id')->paginate(20);

        return [
            'pagination'=>[
                'total'=> $tipodocumentos->total(),
                'current_page'=> $tipodocumentos->currentPage(),
                'per_page'=> $tipodocumentos->perPage(),
                'last_page'=> $tipodocumentos->lastPage(),
                'from'=> $tipodocumentos->firstItem(),
                'to'=> $tipodocumentos->lastItem(),
            ],
            'tipodocumentos'=>$tipodocumentos
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
        $tipo=$request->tipo;
        $activo=$request->activo;

        $input1  = array('tipo' => $tipo);
        $reglas1 = array('tipo' => 'required');

        $input2  = array('tipo' => $tipo);
        $reglas2 = array('tipo' => 'unique:tipodocumentos,tipo'.',1,borrado');

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
            $msj='Debe ingresar el Tipo de Documento';
            $selector='txttipodoc';

        }elseif ($validator2->fails()) {
            $result='0';
            $msj='El Tipo de Documento ingresado ya se encuentra registrado';
            $selector='txttipodoc';
        }elseif ($validator3->fails()) {
            $result='0';
            $msj='Debe de ingresar el estado del Tipo de Documento';
            $selector='cbuestado';
        }
        else{
            $newTipoDoc = new Tipodocumento();
            $newTipoDoc->tipo=$tipo;
            $newTipoDoc->activo=$activo;
            $newTipoDoc->borrado='0';

            $newTipoDoc->save();

            $msj='Nueva Tipo de Documento Registrado con Éxito';
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
        $tipo=$request->tipo;
        $activo=$request->activo;

        $input1  = array('tipo' => $tipo);
        $reglas1 = array('tipo' => 'required');

        $input2  = array('tipo' => $tipo);
        //$reglas2 = array('tipo' => 'unique:tipodocumentos,tipo'.',1,borrado');
        $reglas2 = array('tipo' => 'unique:tipodocumentos,tipo,'.$id.',id,borrado,0');

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
            $msj='Debe ingresar el Tipo de Documento';
            $selector='txttipodocE';

        }elseif ($validator2->fails()) {
            $result='0';
            $msj='El Tipo de Documento ingresado ya se encuentra registrado';
            $selector='txttipodocE';
        }elseif ($validator3->fails()) {
            $result='0';
            $msj='Debe de ingresar el estado del Tipo de Documento';
            $selector='cbuestadoE';
        }
        else{
            $newTipoDoc =Tipodocumento::findOrFail($id);
            $newTipoDoc->tipo=$tipo;
            $newTipoDoc->activo=$activo;

            $newTipoDoc->save();

            $msj='Tipo de Documento Modificado con éxito';
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

        $update = Tipodocumento::findOrFail($id);
        $update->activo=$estado;
        $update->save();

        if(strval($estado)=="0"){
            $msj='El Tipo de Documento fue Desactivado exitosamente';
        }elseif(strval($estado)=="1"){
            $msj='El Tipo de Documento fue Activado exitosamente';
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
            $borrarTIpo = Tipodocumento::findOrFail($id);
        //$task->delete();

            $borrarTIpo->borrado='1';

            $borrarTIpo->save();

            $msj='Tipo de Documento eliminado exitosamente';
      /*   } */

        return response()->json(["result"=>$result,'msj'=>$msj]);
    }
}
