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

        $tipodocumentos = Tipodocumento::where('borrado','0')->where('activo','1')->orderBy('id')->get();
        $formarecepcions = Formarecepcion::where('borrado','0')->where('activo','1')->orderBy('id')->get();
        $prioridads = Prioridad::where('borrado','0')->where('activo','1')->orderBy('id')->get();
        $unidadorganicas = Unidadorganica::where('borrado','0')->where('activo','1')->orderBy('id')->get();
        $entidads = Entidad::where('borrado','0')->where('activo','1')->orderBy('nombre')->get();

        return [

            'tipodocumentos'=>$tipodocumentos,
            'formarecepcions'=>$formarecepcions,
            'prioridads'=>$prioridads,
            'unidadorganicas'=>$unidadorganicas,
            'entidads'=>$entidads,

        ];
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function consultadni(Request $request)
    {
        $dni=$request->dni;

        $res=1;

        error_reporting(E_ALL ^ E_NOTICE);

        $consulta = file_get_contents('http://aplicaciones007.jne.gob.pe/srop_publico/Consulta/Afiliado/GetNombresCiudadano?DNI='.$dni);

        $partes = explode("|", $consulta);


        $datos = array(
                0 => $dni, 
                1 => $partes[0], 
                2 => $partes[1],
                3 => $partes[2],
        );


if(strlen($datos[1])==0 && strlen($datos[2])==0 && strlen($datos[3])==0){
    $res=0;
}


return response()->json(["datos"=>$datos,"res"=>$res]);
    }

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
        ini_set('memory_limit','256M');
     
        $prioridad_id=$request->prioridad_id;
        $entidad_id=$request->entidad_id;
        $detalle=$request->detalle;
        $firma=$request->firma;
        $cargo=$request->cargo;
        $fechadoc=$request->fechadoc;
        $tipodocumento_id=$request->tipodocumento_id;
        $numero=$request->numero;
        $siglas=$request->siglas;


        $file = $request->archivo;
        $segureFile=0;

        $folios=$request->folios;
        $asunto=$request->asunto;
        $formacopia=$request->formacopia;
        $unidadorganica_id=$request->unidadorganica_id;
        $detalledestino=$request->detalledestino;


        if( $formacopia==true ||  strval($formacopia)=="true")
        {
            $formacopia=1;
        }
        else{
            $formacopia=0;
        }


        $request->formacopia=$formacopia;

     


         $result='1';
         $msj='';
         $selector='';


         $archivo="";


        if($request->hasFile('archivo')){



            //$nombreArchivo=$request->nombreArchivo;

            $aux2=date('d-m-Y').'-'.date('H-i-s');
            $input2  = array('archivo' => $file) ;
            $reglas2 = array('archivo' => 'required|file:1,20480');
            $validatorF = Validator::make($input2, $reglas2);

 
          

            if ($validatorF->fails())
            {

            $segureFile=1;
            $msj="El archivo adjunto ingresado tiene un taaño de extensión no válida, ingrese otro archivo o limpie el formulario";
            $result='0';
            $selector='archivo';
            }

            else
            {
                $nombre2=$file->getClientOriginalName();
                $extension2=$file->getClientOriginalExtension();
                $nuevoNombre2=$aux2."-".$nombre2;
                $subir2=Storage::disk('infoFile')->put($nuevoNombre2, \File::get($file));

                if($extension2=="pdf" || $extension2=="doc" || $extension2=="docx" || $extension2=="xls" || $extension2=="xlsx" || $extension2=="ppt" || $extension2=="pptx" || $extension2=="PDF" || $extension2=="DOC" || $extension2=="DOCX" || $extension2=="XLS" || $extension2=="XLSX" || $extension2=="PPT" || $extension2=="PTTX")
                {

                if($subir2){
                    $archivo=$nuevoNombre2;
                }
                else{
                    $msj="Error al subir el archivo adjunto, intentelo nuevamente luego";
                    $segureFile=1;
                    $result='0';
                    $selector='archivo';
                }
                }
                else {
                    $segureFile=1;
                    $msj="El archivo adjunto ingresado tiene una extensión no válida, ingrese otro archivo o limpie el formulario";
                    $result='0';
                    $selector='archivo';
                }
            }

        }

        if($segureFile==1){
            Storage::disk('infoFile')->delete($archivo);
        }
        else
        {

        
        $input1  = array('firma' => $firma);
        $reglas1 = array('firma' => 'required');


        $input2  = array('fechadoc' => $fechadoc);
        $reglas2 = array('fechadoc' => 'required');

        $input3  = array('numero' => $numero);
        $reglas3 = array('numero' => 'required');

        $input4  = array('asunto' => $asunto);
        $reglas4 = array('asunto' => 'required');
        

        $input5  = array('siglas' => $siglas);
        $reglas5 = array('siglas' => 'required');

         $validator1 = Validator::make($input1, $reglas1);
         $validator2 = Validator::make($input2, $reglas2);
         $validator3 = Validator::make($input3, $reglas3);
         $validator4 = Validator::make($input4, $reglas4);
         $validator5 = Validator::make($input5, $reglas5);


        
         if(intval($prioridad_id)<1)
         {
            $result='0';
            $msj='Debe seleccionar la prioridad del documento';
            $selector='cbuprioridad';
         }
         elseif(intval($entidad_id)<1)
         {
            $result='0';
            $msj='Debe seleccionar la entidad de la que proviene';
            $selector='cbuentidad';
         }
        elseif ($validator1->fails())
        {
            $result='0';
            $msj='Debe ingresar quien firma el documento';
            $selector='txtfirma';
        }
        elseif ($validator2->fails())
        {
            $result='0';
            $msj='Debe ingresar la fecha del documento';
            $selector='txtfecha';
        }
        elseif(intval($tipodocumento_id)<1)
         {
            $result='0';
            $msj='Debe seleccionar el tipo de documento';
            $selector='cbuTipoDoc';
         }
         elseif ($validator3->fails())
        {
            $result='0';
            $msj='Debe ingresar el número del documento';
            $selector='txtnumero';
        }
        elseif ($validator5->fails())
        {
            $result='0';
            $msj='Debe ingresar las siglas del documento';
            $selector='txtsiglas';
        }
        elseif(intval($folios)<1)
         {
            $result='0';
            $msj='Debe indicar la cantidad de número de folios adecuadamente';
            $selector='txtfolios';
         }
         elseif ($validator4->fails())
        {
            $result='0';
            $msj='Debe ingresar el asunto del documento';
            $selector='txtasunto';
        }
        elseif(intval($unidadorganica_id)<1)
         {
            $result='0';
            $msj='Debe seleccionar la Unidad Orgánica a la que va dirigida el documento';
            $selector='cbuUnidadOrganica';
         }
        else{

                        /*

             $prioridad_id=$request->prioridad_id;
        $entidad_id=$request->entidad_id;
        $detalle=$request->detalle;
        $firma=$request->firma;
        $cargo=$request->cargo;
        $fechadoc=$request->fechadoc;
        $tipodocumento_id=$request->tipodocumento_id;
        $numero=$request->numero;
        $siglas=$request->siglas;


        $file = $request->archivo;
        $segureFile=0;

        $folios=$request->folios;
        $asunto=$request->asunto;
        $formacopia=$request->formacopia;
        $unidadorganica_id=$request->unidadorganica_id;
        $detalledestino=$request->detalledestino;*/

        $fecha=Date("Y-m-d");

        $iduser=Auth::user()->id;

        $Persona=DB::select("select p.id,p.nombres,p.apellidos FROM personas p
        inner join users u on p.id=u.persona_id
        where u.id='".$iduser."';");

        $idPersona="";
        $nombres="";
        $apellidos="";

        foreach ($Persona as $key => $dato) {
            $idPersona=$dato->id;
            $nombres=$dato->nombres;
            $apellidos=$dato->apellidos;
        }

        $entidad=Entidad::find($entidad_id);
        
        $prioridad=Prioridad::find($prioridad_id);

        $unidadorg=Unidadorganica::find($unidadorganica_id);


                $newTramite = new Tramite();
                $newTramite->fecha=$fecha;
                $newTramite->prioridad_id=$prioridad_id;
                $newTramite->origen='2';
                $newTramite->entidad_id=$entidad_id;
                
                $newTramite->fechadoc=$fechadoc;
                $newTramite->tipodocumento_id=$tipodocumento_id;
                $newTramite->numero=$numero;
                $newTramite->siglas=$siglas;
                $newTramite->formarecepcion_id='5';
                $newTramite->rutafile=$archivo;
                $newTramite->folios=$folios;
                $newTramite->asunto=$asunto;

                $newTramite->clasificacion_id='4';
                $newTramite->formacopia=$formacopia;
                $newTramite->unidadorganica_id=$unidadorganica_id;
                $newTramite->detalledestino=$detalledestino;

                $newTramite->estado='1';
                $newTramite->activo='1';
                $newTramite->borrado='0';

                $newTramite->persona_id=$idPersona;
                $newTramite->user_id=$iduser;

                $newTramite->entidad=$entidad->nombre;
                $newTramite->detalle=$detalle;
                $newTramite->firma=$cargo;
                $newTramite->cargo=$cargo;
                $newTramite->clasificacion='Ninguna';
                $newTramite->dias=$prioridad->dias;
                $newTramite->unidadorganica=$unidadorg->nombre;


            $newTramite->save();



            $newDetalle=new Detalletramite();

            $newDetalle->estado="1";
            $newDetalle->detalleestado="Trámite Inicializado";
            $newDetalle->observacion="Trámite Inicializado por el Usuario".$nombres." ".$apellidos;
            $newDetalle->fechadetalle=$fecha;
            $newDetalle->activo="1";
            $newDetalle->borrado="0"; 
            $newDetalle->tramite_id=$newTramite->id; 
            $newDetalle->user_id=$iduser; 

            $newDetalle->save();


            $request->tipomail="3";

            $request->rutafile=$archivo;


            Mail::send(new SendMail());


            

            $msj='Nuevo Trámite Registrado con Éxito';
        }

        }


       //Areaunasam::create($request->all());




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
