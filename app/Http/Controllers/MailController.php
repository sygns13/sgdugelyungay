<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Storage;
use Validator;
use App\Mail\SendMail;

 ini_set('memory_limit','256M');

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function send()
    {
        Mail::send(new SendMail());
    
    }
    public function index()
    {
        //
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
    public function store(Request $data)
    {

    ini_set('memory_limit','256M');

        $newAsunto=$data->asunto;
        $mensaje=$data->mensaje;
        $mails=json_decode(stripslashes($data->mails));



        $archivo="";
        $file = $data->archivo;

        $segureFile=0;


         $result='1';
         $msj='';
         $selector='';




        if($data->hasFile('archivo')){



            //$nombreArchivo=$data->nombreArchivo;

           // $aux2=date('d-m-Y').'-'.date('H-i-s').'-'. $personal_id;
            $input2  = array('archivo' => $file) ;
            $reglas2 = array('archivo' => 'required|file:1,20480');
            $validatorF = Validator::make($input2, $reglas2);

            /*$inputNA  = array('archivonombre' => $nombreArchivo);
            $reglasNA = array('archivonombre' => 'required');
            $validatorNA = Validator::make($inputNA, $reglasNA);*/

          

            if ($validatorF->fails())
            {

            $segureFile=1;
            $msj="El archivo adjunto ingresado tiene una extensión no válida, ingrese otro archivo o limpie el formulario";
            $result='0';
            $selector='archivo2';
            }
            elseif(1==2){
                $segureFile=1;
                $msj="Si va a registrar un archivo adjunto, debe de ingresar un nombre válido con el que se verá en el sistema";
                $result='0';
                $selector='txtArchivoAdjunto';
            }
            else
            {
                $nombre2=$file->getClientOriginalName();
                $extension2=$file->getClientOriginalExtension();
                $nuevoNombre2=$nombre2.".".$extension2;
                $subir2=Storage::disk('infoMsj')->put($nombre2, \File::get($file));

                if($extension2=="pdf" || $extension2=="doc" || $extension2=="docx" || $extension2=="xls" || $extension2=="xlsx" || $extension2=="ppt" || $extension2=="pptx" || $extension2=="PDF" || $extension2=="DOC" || $extension2=="DOCX" || $extension2=="XLS" || $extension2=="XLSX" || $extension2=="PPT" || $extension2=="PTTX")
                {

                if($subir2){
                    $archivo=$nombre2;
                    $segureFile=2;
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
                    $selector='archivo2';
                }
            }

        }

        if($segureFile==1){
     
            Storage::disk('infoMsj')->delete($archivo);
        }

        if(count($mails)==0 || count($mails)=="" || count($mails)==null){
             $result='0';
             $msj='Ingrese un correo electrónico válido';
             $selector='tabla';
        }elseif(strlen(strval($newAsunto))==0){
            $result='0';
             $msj='Ingrese un Asunto del Mensaje ';
             $selector='txtasunto';
        }

        elseif($segureFile==0){

          Mail::send(new SendMail());

            $msj='Mensaje Remitido Exitosamente';


        }elseif($segureFile==2){

           Mail::send(new SendMail());

            $msj='Mensaje Remitido Exitosamente';
            Storage::disk('infoMsj')->delete($archivo);
            
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
