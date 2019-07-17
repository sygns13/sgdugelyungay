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
use Validator;
use Auth;
use DB;
use Storage;

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

     


         $result='1';
         $msj='';
         $selector='';


        if($request->hasFile('archivo')){



            $nombreArchivo=$request->nombreArchivo;

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
                $nuevoNombre2=$nombre2.'-'.$aux2.".".$extension2;
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

        
        $input1  = array('titulo' => $titulo);
        $reglas1 = array('titulo' => 'required');


         $validator1 = Validator::make($input1, $reglas1);


        

        if ($validator1->fails())
        {
            $result='0';
            $msj='Debe ingresar el título del Contenido Informativo';
            $selector='txttitulo';

        }
        else{
                $newinformacion = new Informacion();
                $newinformacion->titulo=$titulo;
                $newinformacion->descripcion=$desc;
                $newinformacion->orden=$orden;
                $newinformacion->urlimagen=$imagen;
                
   
                $newinformacion->activo=$estado;
                $newinformacion->borrado='0';

                $newinformacion->urldocumento=$archivo;
                $newinformacion->carrerasunasam_id=$cargo;

                $newinformacion->user_id=Auth::user()->id;
                $newinformacion->archivonombre=$nombreArchivo;


            $newinformacion->save();

            $msj='Nuevo Contenido Informativo Registrado con Éxito';
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
