<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tipodocumento;
use App\Formarecepcion;
use App\Prioridad;
use App\Unidadorganica;
use App\Entidad;
use App\Expediente;
use App\Tramite;
use App\Detalletramite;
use Validator;
use Auth;
use DB;
use Storage;

use App\Persona;
use App\Alumno;
use App\Tipouser;
use App\User;


use Mail;
use App\Mail\SendMail;

class TramiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index1()
    {
        if(accesoUser([3])){

            $iduser=Auth::user()->id;
        $idtipouser=Auth::user()->tipouser_id;
        $tipouser=Tipouser::find($idtipouser);

        $modulo="mistramites";

        return view('mistramites.index',compact('modulo','tipouser'));

        }
    else
        {
            return view('adminlte::home');           
        }
    }


    public function index2()
    {
        if(accesoUser([3])){

            $iduser=Auth::user()->id;
        $idtipouser=Auth::user()->tipouser_id;
        $tipouser=Tipouser::find($idtipouser);


        $modulo="reghistoricos";

        return view('reghistoricos.index',compact('modulo','tipouser'));

        }
    else
        {
            return view('adminlte::home');           
        }
    }



    public function index3()
    {
        if(accesoUser([1])){

        $iduser=Auth::user()->id;
        $idtipouser=Auth::user()->tipouser_id;
        $tipouser=Tipouser::find($idtipouser);


        $modulo="procetramites";

        return view('procetramites.index',compact('modulo','tipouser'));

        }
    else
        {
            return view('adminlte::home');           
        }
    }



    public function index(Request $request)
    {

        $buscar=$request->busca;


        $iduser=Auth::user()->id;

        $persona=DB::table('personas')
        ->join('users', 'users.persona_id', '=', 'personas.id')
        ->join('tipousers','tipousers.id','=','users.tipouser_id')
        ->where('users.borrado','0')
        ->where('users.id',$iduser)
        ->select('personas.id')->get();

        $idPersona="";
        foreach ($persona as $key => $dato) {
            $idPersona=$dato->id;
        }
        
        $tramites=DB::table('tramites')
        ->join('prioridads', 'tramites.prioridad_id', '=', 'prioridads.id')
        ->join('tipodocumentos', 'tramites.tipodocumento_id', '=', 'tipodocumentos.id')
        ->join('formarecepcions', 'tramites.formarecepcion_id', '=', 'formarecepcions.id')
        ->join('clasificacions', 'tramites.clasificacion_id', '=', 'clasificacions.id')
        ->join('unidadorganicas', 'tramites.unidadorganica_id', '=', 'unidadorganicas.id')
        ->join('entidads', 'tramites.entidad_id', '=', 'entidads.id')
        ->join('personas', 'tramites.persona_id', '=', 'personas.id')
        ->join('users', 'users.persona_id', '=', 'personas.id')

        ->where('tramites.activo','1')
        ->where('tramites.persona_id',$idPersona)

            ->where(function($query) use ($buscar){
        $query->where('tramites.expediente','like','%'.$buscar.'%');
        $query->orWhere('tramites.numero','like','%'.$buscar.'%');
        $query->orWhere('tramites.siglas','like','%'.$buscar.'%');
        $query->orWhere('tramites.asunto','like','%'.$buscar.'%');
        $query->orWhere('tramites.entidad','like','%'.$buscar.'%');
        $query->orWhere('tramites.detalle','like','%'.$buscar.'%');
        $query->orWhere('tramites.firma','like','%'.$buscar.'%');
        $query->orWhere('tramites.cargo','like','%'.$buscar.'%');
        $query->orWhere('tramites.unidadorganica','like','%'.$buscar.'%');
        $query->orWhere('tipodocumentos.tipo','like','%'.$buscar.'%');
        $query->orWhere('prioridads.prioridad','like','%'.$buscar.'%');
    })
        ->orderBy('tramites.id')
        ->select('tramites.id','tramites.expediente','tramites.fecha','tramites.prioridad_id','tramites.origen','tramites.entidad_id','tramites.fechadoc','tramites.tipodocumento_id','tramites.numero','tramites.siglas','tramites.formarecepcion_id','tramites.rutafile','tramites.folios','tramites.asunto','tramites.clasificacion_id','tramites.formacopia','tramites.unidadorganica_id','tramites.detalledestino','tramites.estado','tramites.activo','tramites.persona_id','tramites.user_id','tramites.entidad','tramites.detalle','tramites.firma','tramites.cargo','tramites.clasificacion','tramites.dias','tramites.unidadorganica','prioridads.prioridad','tipodocumentos.tipo as tipodocumento','formarecepcions.forma','unidadorganicas.siglas as siglasunidad','unidadorganicas.codigo as codunidad','unidadorganicas.abreviatura','entidads.codigo as codentidad','entidads.nombre as entidad','entidads.abrev as abreventidad','entidads.siglas as siglasentidad','users.name','personas.nombres','personas.apellidos','personas.dni')->paginate(20);



        return [
            'pagination'=>[
                'total'=> $tramites->total(),
                'current_page'=> $tramites->currentPage(),
                'per_page'=> $tramites->perPage(),
                'last_page'=> $tramites->lastPage(),
                'from'=> $tramites->firstItem(),
                'to'=> $tramites->lastItem(),
            ],
            'tramites'=>$tramites

        ];


    }



    public function indexh(Request $request)
    {

        $buscar=$request->busca;


        $iduser=Auth::user()->id;

        $persona=DB::table('personas')
        ->join('users', 'users.persona_id', '=', 'personas.id')
        ->join('tipousers','tipousers.id','=','users.tipouser_id')
        ->where('users.borrado','0')
        ->where('users.id',$iduser)
        ->select('personas.id')->get();

        $idPersona="";
        foreach ($persona as $key => $dato) {
            $idPersona=$dato->id;
        }
        
        $tramites=DB::table('tramites')
        ->join('prioridads', 'tramites.prioridad_id', '=', 'prioridads.id')
        ->join('tipodocumentos', 'tramites.tipodocumento_id', '=', 'tipodocumentos.id')
        ->join('formarecepcions', 'tramites.formarecepcion_id', '=', 'formarecepcions.id')
        ->join('clasificacions', 'tramites.clasificacion_id', '=', 'clasificacions.id')
        ->join('unidadorganicas', 'tramites.unidadorganica_id', '=', 'unidadorganicas.id')
        ->join('entidads', 'tramites.entidad_id', '=', 'entidads.id')
        ->join('personas', 'tramites.persona_id', '=', 'personas.id')
        ->join('users', 'tramites.user_id', '=', 'users.id')

        ->where('tramites.activo','2')
        ->where('tramites.persona_id',$idPersona)

            ->where(function($query) use ($buscar){
        $query->where('tramites.expediente','like','%'.$buscar.'%');
        $query->orWhere('tramites.numero','like','%'.$buscar.'%');
        $query->orWhere('tramites.siglas','like','%'.$buscar.'%');
        $query->orWhere('tramites.asunto','like','%'.$buscar.'%');
        $query->orWhere('tramites.entidad','like','%'.$buscar.'%');
        $query->orWhere('tramites.detalle','like','%'.$buscar.'%');
        $query->orWhere('tramites.firma','like','%'.$buscar.'%');
        $query->orWhere('tramites.cargo','like','%'.$buscar.'%');
        $query->orWhere('tramites.unidadorganica','like','%'.$buscar.'%');
        $query->orWhere('tipodocumentos.tipo','like','%'.$buscar.'%');
        $query->orWhere('prioridads.prioridad','like','%'.$buscar.'%');
    })
        ->orderBy('tramites.id')
        ->select('tramites.id','tramites.expediente','tramites.fecha','tramites.prioridad_id','tramites.origen','tramites.entidad_id','tramites.fechadoc','tramites.tipodocumento_id','tramites.numero','tramites.siglas','tramites.formarecepcion_id','tramites.rutafile','tramites.folios','tramites.asunto','tramites.clasificacion_id','tramites.formacopia','tramites.unidadorganica_id','tramites.detalledestino','tramites.estado','tramites.activo','tramites.persona_id','tramites.user_id','tramites.entidad','tramites.detalle','tramites.firma','tramites.cargo','tramites.clasificacion','tramites.dias','tramites.unidadorganica','prioridads.prioridad','tipodocumentos.tipo as tipodocumento','formarecepcions.forma','unidadorganicas.siglas as siglasunidad','unidadorganicas.codigo as codunidad','unidadorganicas.abreviatura','entidads.codigo as codentidad','entidads.nombre as entidad','entidads.abrev as abreventidad','entidads.siglas as siglasentidad','users.name','personas.nombres','personas.apellidos','personas.dni')->paginate(20);



        return [
            'pagination'=>[
                'total'=> $tramites->total(),
                'current_page'=> $tramites->currentPage(),
                'per_page'=> $tramites->perPage(),
                'last_page'=> $tramites->lastPage(),
                'from'=> $tramites->firstItem(),
                'to'=> $tramites->lastItem(),
            ],
            'tramites'=>$tramites

        ];


    }





    public function indexpt(Request $request)
    {

        $buscar=$request->busca;
        $estado=$request->estado;


        $iduser=Auth::user()->id;

        //tramites ->paginate(20);

        
        $query=DB::table('tramites')
        ->join('prioridads', 'tramites.prioridad_id', '=', 'prioridads.id')
        ->join('tipodocumentos', 'tramites.tipodocumento_id', '=', 'tipodocumentos.id')
        ->join('formarecepcions', 'tramites.formarecepcion_id', '=', 'formarecepcions.id')
        ->join('clasificacions', 'tramites.clasificacion_id', '=', 'clasificacions.id')
        ->join('unidadorganicas', 'tramites.unidadorganica_id', '=', 'unidadorganicas.id')
        ->join('entidads', 'tramites.entidad_id', '=', 'entidads.id')
        ->join('personas', 'tramites.persona_id', '=', 'personas.id')
        ->join('users', 'tramites.user_id', '=', 'users.id')

            ->where(function($query) use ($buscar){
        $query->where('tramites.expediente','like','%'.$buscar.'%');
        $query->orWhere('tramites.numero','like','%'.$buscar.'%');
        $query->orWhere('tramites.siglas','like','%'.$buscar.'%');
        $query->orWhere('tramites.asunto','like','%'.$buscar.'%');
        $query->orWhere('tramites.entidad','like','%'.$buscar.'%');
        $query->orWhere('tramites.detalle','like','%'.$buscar.'%');
        $query->orWhere('tramites.firma','like','%'.$buscar.'%');
        $query->orWhere('tramites.cargo','like','%'.$buscar.'%');
        $query->orWhere('tramites.unidadorganica','like','%'.$buscar.'%');
        $query->orWhere('tipodocumentos.tipo','like','%'.$buscar.'%');
        $query->orWhere('prioridads.prioridad','like','%'.$buscar.'%');
    })
        ->orderBy('tramites.id')
        ->select('tramites.id','tramites.expediente','tramites.fecha','tramites.prioridad_id','tramites.origen','tramites.entidad_id','tramites.fechadoc','tramites.tipodocumento_id','tramites.numero','tramites.siglas','tramites.formarecepcion_id','tramites.rutafile','tramites.folios','tramites.asunto','tramites.clasificacion_id','tramites.formacopia','tramites.unidadorganica_id','tramites.detalledestino','tramites.estado','tramites.activo','tramites.persona_id','tramites.user_id','tramites.entidad','tramites.detalle','tramites.firma','tramites.cargo','tramites.clasificacion','tramites.dias','tramites.unidadorganica','prioridads.prioridad','tipodocumentos.tipo as tipodocumento','formarecepcions.forma','unidadorganicas.siglas as siglasunidad','unidadorganicas.codigo as codunidad','unidadorganicas.abreviatura','entidads.codigo as codentidad','entidads.nombre as entidad','entidads.abrev as abreventidad','entidads.siglas as siglasentidad','users.name','personas.nombres','personas.apellidos','personas.dni');


        if(intval($estado)==1)
        {
            $query->where('tramites.estado','<','3');
        }
        elseif(intval($estado)==3 || intval($estado)==4)
        {
            $query->where('tramites.estado',$estado);
        }

        $tramites=$query->paginate(20);

        return [
            'pagination'=>[
                'total'=> $tramites->total(),
                'current_page'=> $tramites->currentPage(),
                'per_page'=> $tramites->perPage(),
                'last_page'=> $tramites->lastPage(),
                'from'=> $tramites->firstItem(),
                'to'=> $tramites->lastItem(),
            ],
            'tramites'=>$tramites

        ];


    }








    public function altabaja($id,$activo)
    {
        $result='1';
        $msj='';
        $selector='';

        $update = Tramite::findOrFail($id);
        $update->activo=$activo;
        $update->save();

        if(strval($activo)=="2"){
            $msj='El Trámite fue archivado exitosamente';
        }elseif(strval($activo)=="1"){
            $msj='El Trámite fue Activado exitosamente';
        }

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);

    }


    public function notificar(Request $request)
    {
        $id=$request->id;

        $result='1';
        $msj='';
        $selector='';

        $tramite=Tramite::find($id);
        $estado=$tramite->estado;

        $request->tipomail="0";

        if(intval($estado)==2){
            $request->tipomail="4";
        }
        elseif(intval($estado)==3){
            $request->tipomail="5";
        }
        elseif(intval($estado)==4){
            $request->tipomail="6";
        }

        Mail::send(new SendMail());

        $msj="El estado del trámite fue notificado exitosamente al correo electrónico del usuario que realizó el trámite virtual";

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);

    }


    public function procesar(Request $request)
    {


        $id=$request->id;
        $estado=$request->estado;

        $result='1';
        $msj='';
        $selector='';

        $fecha=Date("Y-m-d");


        $iduser=Auth::user()->id;

        $Persona=DB::select("select p.id, p.nombres, p.apellidos, p.dni FROM personas p
        inner join users u on p.id=u.persona_id
        where u.id='".$iduser."';");

        $apellidos="";
        $nombres="";

        foreach ($Persona as $key => $dato) {
            $apellidos=$dato->apellidos;
            $nombres=$dato->nombres;
        }

        

        if(strval($estado)=="2"){

            $update = Tramite::findOrFail($id);
            $update->estado=$estado;
            $update->save();

            $msj='El Trámite fue recepcionado exitosamente';


            $newDetalle=new Detalletramite();

            $newDetalle->estado="2";
            $newDetalle->detalleestado="Trámite Recepcionado";
            $newDetalle->observacion="Trámite Recepcionado por el Usuario ".$nombres." ".$apellidos;
            $newDetalle->fechadetalle=$fecha;
            $newDetalle->activo="1";
            $newDetalle->borrado="0"; 
            $newDetalle->tramite_id=$id; 
            $newDetalle->user_id=$iduser; 

            $newDetalle->save();



                $request->tipomail="4";
               // Mail::send(new SendMail());


        }elseif(strval($estado)=="3"){
            

            $expediente=$request->expediente;

            $input1  = array('expediente' => $expediente);
            $reglas1 = array('expediente' => 'required');

            $validator1 = Validator::make($input1, $reglas1);

            if ($validator1->fails())
        {
            $result='0';
            $msj='Debe ingresar el Número de Expediente Generado por el SISGEDO';
            $selector='txtexpediente';

        }
        else
        {
            $update = Tramite::findOrFail($id);
            $update->estado=$estado;
            $update->expediente=$expediente;
            $update->save();

            $newDetalle=new Detalletramite();

            $newDetalle->estado="3";
            $newDetalle->detalleestado="Trámite Ingresado al SISGEDO";
            $newDetalle->observacion="Trámite Ingresado al SISGEDO por el Usuario ".$nombres." ".$apellidos;
            $newDetalle->fechadetalle=$fecha;
            $newDetalle->activo="1";
            $newDetalle->borrado="0"; 
            $newDetalle->tramite_id=$id; 
            $newDetalle->user_id=$iduser; 

            $newDetalle->save();

            $request->tipomail="5";
            
            Mail::send(new SendMail());



            $msj='El Trámite fue Ingresado al SISGEDO exitosamente';
        }
            


        }elseif(strval($estado)=="4"){

            $update = Tramite::findOrFail($id);
            $update->estado=$estado;
            $update->save();

            $newDetalle=new Detalletramite();

            $newDetalle->estado="4";
            $newDetalle->detalleestado="Trámite Atendido";
            $newDetalle->observacion="Trámite Atendido por el Usuario ".$nombres." ".$apellidos;
            $newDetalle->fechadetalle=$fecha;
            $newDetalle->activo="1";
            $newDetalle->borrado="0"; 
            $newDetalle->tramite_id=$id; 
            $newDetalle->user_id=$iduser; 

            $newDetalle->save();

            $request->tipomail="6";
            Mail::send(new SendMail());

            $msj='El Trámite fue Atendido exitosamente';
        }

            



        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);

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
