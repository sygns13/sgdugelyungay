<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Prioridad;
use Validator;
use Auth;
use DB;

use App\Persona;
use App\Alumno;
use App\Tipouser;
use App\User;

class PrioridadController extends Controller
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


            $modulo="prioridads";
            return view('prioridads.index',compact('tipouser','modulo'));
        }
        else
        {
            return view('adminlte::home');           
        }
    }



    public function index(Request $request)
    {
        $buscar=$request->busca;
        $prioridads = Prioridad::where('borrado','0')
        ->where(function($query) use ($buscar){
            $query->where('prioridad', 'like', '%'.$buscar.'%');
            $query->orWhere('dias', 'like', '%'.$buscar.'%');
        })
        ->orderBy('id')->paginate(50);

        return [
            'pagination'=>[
                'total'=> $prioridads->total(),
                'current_page'=> $prioridads->currentPage(),
                'per_page'=> $prioridads->perPage(),
                'last_page'=> $prioridads->lastPage(),
                'from'=> $prioridads->firstItem(),
                'to'=> $prioridads->lastItem(),
            ],
            'prioridads'=>$prioridads
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
        $prioridad=$request->prioridad;
        $dias=$request->dias;
        $activo=$request->activo;

        $input1  = array('prioridad' => $prioridad);
        $reglas1 = array('prioridad' => 'required');

        $input2  = array('prioridad' => $prioridad);
        $reglas2 = array('prioridad' => 'unique:prioridads,prioridad'.',1,borrado');

        $input3  = array('dias' => $dias);
        $reglas3 = array('dias' => 'required');

        $input4  = array('activo' => $activo);
        $reglas4 = array('activo' => 'required');

        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);
        $validator3 = Validator::make($input3, $reglas3);
        $validator4 = Validator::make($input4, $reglas4);
  
        $result='1';
        $msj='';
        $selector='';

        if ($validator1->fails())
        {
            $result='0';
            $msj='Debe ingresar la Descripción de la Prioridad';
            $selector='txtprioridad';

        }elseif ($validator2->fails()) {
            $result='0';
            $msj='La descripción de la Prioridad ingresada ya se encuentra registrada';
            $selector='txtprioridad';
            
        }
        elseif ($validator3->fails())
            {
                $result='0';
                $msj='Debe ingresar el Número de Días de Atención';
                $selector='txtdias';
    
            }
        elseif ($validator4->fails()) {
            $result='0';
            $msj='Debe de ingresar el estado de la Unidad Orgánica';
            $selector='cbuestado';
        }
        else{
            $newPrioridad = new Prioridad();
            $newPrioridad->prioridad=$prioridad;
            $newPrioridad->activo=$activo;
            $newPrioridad->dias=$dias;
            $newPrioridad->borrado='0';

            $newPrioridad->save();

            $msj='Nuevo Registro de Prioridad Registrado con Éxito';
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
        $prioridad=$request->prioridad;
        $dias=$request->dias;
        $activo=$request->activo;

        $input1  = array('prioridad' => $prioridad);
        $reglas1 = array('prioridad' => 'required');

        $input2  = array('prioridad' => $prioridad);
        //$reglas2 = array('prioridad' => 'unique:prioridads,nombre'.',1,borrado');
        $reglas2 = array('prioridad' => 'unique:prioridads,prioridad,'.$id.',id,borrado,0');

        $input3  = array('dias' => $dias);
        $reglas3 = array('dias' => 'required');

        $input4  = array('activo' => $activo);
        $reglas4 = array('activo' => 'required');

        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);
        $validator3 = Validator::make($input3, $reglas3);
        $validator4 = Validator::make($input4, $reglas4);
  
        $result='1';
        $msj='';
        $selector='';

        if ($validator1->fails())
        {
            $result='0';
            $msj='Debe ingresar la Descripción de la Prioridad';
            $selector='txtprioridadE';

        }elseif ($validator2->fails()) {
            $result='0';
            $msj='La descripción de la Prioridad ingresada ya se encuentra registrada';
            $selector='txtprioridadE';
            
        }
        elseif ($validator3->fails())
            {
                $result='0';
                $msj='Debe ingresar el Número de Días de Atención';
                $selector='txtdiasE';
    
            }
        elseif ($validator4->fails()) {
            $result='0';
            $msj='Debe de ingresar el estado de la Unidad Orgánica';
            $selector='cbuestadoE';
        }
        else{
            $editPrioridad =Prioridad::findOrFail($id);
            $editPrioridad->prioridad=$prioridad;
            $editPrioridad->dias=$dias;
            $editPrioridad->activo=$activo;
            $editPrioridad->save();

            $msj='Registro de Prioridad modificado exitosamente';
        }

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
    }

    public function altabaja($id,$estado)
    {
        $result='1';
        $msj='';
        $selector='';

        $update = Prioridad::findOrFail($id);
        $update->activo=$estado;
        $update->save();

        if(strval($estado)=="0"){
            $msj='La Prioridad fue Desactivada exitosamente';
        }elseif(strval($estado)=="1"){
            $msj='La Prioridad fue Activada exitosamente';
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
            $borrar = Prioridad::findOrFail($id);
        //$task->delete();

            $borrar->borrado='1';

            $borrar->save();

            $msj='Registro de Prioridad eliminado exitosamente';
      /*   } */

        return response()->json(["result"=>$result,'msj'=>$msj]);
    }
}
