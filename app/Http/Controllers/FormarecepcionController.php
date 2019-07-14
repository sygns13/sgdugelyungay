<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Formarecepcion;
use Validator;
use Auth;
use DB;

use App\Persona;
use App\Alumno;
use App\Tipouser;
use App\User;


class FormarecepcionController extends Controller
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


            $modulo="formarecepcion";
            return view('formarecepcion.index',compact('tipouser','modulo'));
        }
        else
        {
            return view('adminlte::home');           
        }
    }


    public function index(Request $request)
    {
        $buscar=$request->busca;
        $formarecepcions = Formarecepcion::where('borrado','0')
        ->where(function($query) use ($buscar){
            $query->where('forma', 'like', '%'.$buscar.'%');
           /*  $query->orWhere('codigo', 'like', '%'.$buscar.'%'); */
        })
        ->orderBy('id')->paginate(20);

        return [
            'pagination'=>[
                'total'=> $formarecepcions->total(),
                'current_page'=> $formarecepcions->currentPage(),
                'per_page'=> $formarecepcions->perPage(),
                'last_page'=> $formarecepcions->lastPage(),
                'from'=> $formarecepcions->firstItem(),
                'to'=> $formarecepcions->lastItem(),
            ],
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
        $forma=$request->forma;
        $activo=$request->activo;

        $input1  = array('forma' => $forma);
        $reglas1 = array('forma' => 'required');

        $input2  = array('forma' => $forma);
        $reglas2 = array('forma' => 'unique:formarecepcions,forma'.',1,borrado');

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
            $msj='Debe ingresar la Forma de Recepción';
            $selector='txtformarecepcion';

        }elseif ($validator2->fails()) {
            $result='0';
            $msj='La Forma de Recepción ingresada ya se encuentra registrada';
            $selector='txtformarecepcion';
        }elseif ($validator3->fails()) {
            $result='0';
            $msj='Debe de ingresar el estado de la Forma de Recepción';
            $selector='cbuestado';
        }
        else{
            $newTipoDoc = new Formarecepcion();
            $newTipoDoc->forma=$forma;
            $newTipoDoc->activo=$activo;
            $newTipoDoc->borrado='0';

            $newTipoDoc->save();

            $msj='Nueva Forma de Recepción Registrada con Éxito';
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
        $forma=$request->forma;
        $activo=$request->activo;

        $input1  = array('forma' => $forma);
        $reglas1 = array('forma' => 'required');

        $input2  = array('forma' => $forma);
        //$reglas2 = array('forma' => 'unique:formarecepcions,forma'.',1,borrado');
        $reglas2 = array('forma' => 'unique:formarecepcions,forma,'.$id.',id,borrado,0');

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
            $msj='Debe ingresar la Forma de Recepción';
            $selector='txtformarecepcionE';

        }elseif ($validator2->fails()) {
            $result='0';
            $msj='La Forma de Recepción ingresada ya se encuentra registrada';
            $selector='txtformarecepcionE';
        }elseif ($validator3->fails()) {
            $result='0';
            $msj='Debe de ingresar el estado de la Forma de Recepción';
            $selector='cbuestadoE';
        }
        else{
            $newTipoDoc =Formarecepcion::findOrFail($id);
            $newTipoDoc->forma=$forma;
            $newTipoDoc->activo=$activo;

            $newTipoDoc->save();

            $msj='Forma de Recepción Modificada con Éxito';
        }

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
    }

    public function altabaja($id,$estado)
    {
        $result='1';
        $msj='';
        $selector='';

        $update = Formarecepcion::findOrFail($id);
        $update->activo=$estado;
        $update->save();

        if(strval($estado)=="0"){
            $msj='La Forma de Recepción fue Desactivada exitosamente';
        }elseif(strval($estado)=="1"){
            $msj='La Forma de Recepción fue Activada exitosamente';
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
            $borrar = Formarecepcion::findOrFail($id);
        //$task->delete();

            $borrar->borrado='1';

            $borrar->save();

            $msj='Forma de Recepción eliminada exitosamente';
      /*   } */

        return response()->json(["result"=>$result,'msj'=>$msj]);
    }
}
