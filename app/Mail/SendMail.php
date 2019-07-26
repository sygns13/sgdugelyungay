<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use DB;
use Auth;
use Storage;
use Validator;

use App\Tipodocumento;
use App\Formarecepcion;
use App\Prioridad;
use App\Unidadorganica;
use App\Entidad;
use App\Expediente;
use App\Tramite;
use App\Detalletramite;

use App\Persona;
use App\Alumno;
use App\Tipouser;
use App\User;

ini_set('memory_limit','256M');
ini_set('max_execution_time', '300');

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $data)
    {
        ini_set('memory_limit','256M');


        if(strval($data->tipomail)=="1"){

            $nombres=$data->txtnombres;
            $apellidos=$data->txtapellidos;
            $dni=$data->txtdni;
            $genero=$data->cbugenero;
            $direccion=$data->txtdir;

            $name=$data->txtuser;
            $password=$data->txtclave;
            $email=$data->txtemail;

            $asunto="Plataforma SGD UGEL YUNGAY Confirmación de Creación de Usuario";

            $mensaje="Estimado (a): ".$apellidos.", ".$nombres;

            $mensaje.="<br><br>";
            $mensaje.="Mediante el presente mensaje de correo electrónico reciba la confirmación de Creación de su cuenta de usuario de la Plataforma Virtual del Sistema de Gestión Documental de la UGEL YUNGAY. Desde este sistema usted podrá realizar sus trámites documentarios mediante esta plataforma.<br><br>";

            $mensaje.="<b>Credenciales de Acceso:<b><br><br>";
            $mensaje.="Usuario: ".$name."<br>";
            $mensaje.="Password: ".$password."<br>";

            $mensaje.="<br><br>";

            $mensaje.="Este es un mensaje automático del sistema, por favor no responda este mensaje, si tuviera alguna dificultad para ingresar a la plataforma del Sistema de Gestión Documental, acérquese a la UGEL Yungay y reporte su problema.";


            return $this->view('mail1',['msg'=>$mensaje])->to($email)->subject($asunto)->from("sgdugelyungay@gmail.com");

        }

        elseif(strval($data->tipomail)=="2"){

            $nombres=$data->nombres;
            $apellidos=$data->apellidos;
            $dni=$data->dni;


            $name=$data->name;
            $password=$data->password;
            $email=$data->txtemailE;

            $asunto="Plataforma SGD UGEL YUNGAY Reset de Password";

            $mensaje="Estimado (a): ".$apellidos.", ".$nombres;

            $mensaje.="<br><br>";
            $mensaje.="Mediante el presente mensaje de correo electrónico se le envía el Password Reseteado de su cuenta de usuario de la Plataforma Virtual del Sistema de Gestión Documental de la UGEL YUNGAY:<br><br>";

            $mensaje.="<b>Credenciales de Acceso:<b><br><br>";
            $mensaje.="Usuario: ".$name."<br>";
            $mensaje.="Password: ".$password."<br>";

            $mensaje.="<br><br>";

            $mensaje.="Este es un mensaje automático del sistema, por favor no responda este mensaje, si tuviera alguna dificultad para ingresar a la plataforma del Sistema de Gestión Documental, acérquese a la UGEL Yungay y reporte su problema.";


            return $this->view('mail1',['msg'=>$mensaje])->to($email)->subject($asunto)->from("sgdugelyungay@gmail.com");

        }


        elseif(strval($data->tipomail)=="3"){

            $prioridad_id=$data->prioridad_id;
            $entidad_id=$data->entidad_id;
            $detalle=$data->detalle;
            $firma=$data->firma;
            $cargo=$data->cargo;
            $fechadoc=$data->fechadoc;
            $tipodocumento_id=$data->tipodocumento_id;
            $numero=$data->numero;
            $siglas=$data->siglas;
    
    
            $folios=$data->folios;
            $asunto=$data->asunto;
            $formacopia=$data->formacopia;
            $unidadorganica_id=$data->unidadorganica_id;
            $detalledestino=$data->detalledestino;

            $fecha=Date("Y-m-d");

        $iduser=Auth::user()->id;

        $Persona=DB::select("select p.id, p.nombres, p.apellidos, p.dni FROM personas p
        inner join users u on p.id=u.persona_id
        where u.id='".$iduser."';");

        $idPersona="";

        $apellidos="";
        $nombres="";
        $dni="";
        foreach ($Persona as $key => $dato) {
            $idPersona=$dato->id;
            $apellidos=$dato->apellidos;
            $nombres=$dato->nombres;
            $dni=$dato->dni;
        }

        $entidad=Entidad::find($entidad_id);
        
        $prioridad=Prioridad::find($prioridad_id);

        $unidadorg=Unidadorganica::find($unidadorganica_id);


            $asunt="Plataforma SGD UGEL YUNGAY INICIO DE TRÁMIE";

            $mensaje="Estimado (a): ".$apellidos.", ".$nombres;

            $mensaje.="<br><br>";
            $mensaje.="Mediante el presente mensaje de correo electrónico se le remite la confirmación de registro del siguiente trámite<br><br>";

            $mensaje.="<b>DOCUMENTO:".$numero." - ".$siglas."</b><br><br>";
            $mensaje.="Fecha del Documento: ".pasFechaVista($fechadoc)."<br>";
            $mensaje.='N° de Expediente: "Pendiente"<br>';
            $mensaje.="N° de Folios: ".$folios."<br>";
            $mensaje.="Asunto: ".$asunto."<br>";
            $mensaje.="Estado: Ingresado<br>";

            $mensaje.="<br><br>";

            $mensaje.="<b>Datos de Origen</b><br>";
            $mensaje.="Entidad : ".$entidad->nombre."<br>";
            $mensaje.="Firma : ".$firma."<br>";
            $mensaje.="Cargo : ".$cargo."<br>";
            $mensaje.="Detalle : ".$detalle."<br>";

            $mensaje.="<br><br>";

            $mensaje.="<b>Datos de Destino - UGEL YUNGAY</b><br>";
            $mensaje.="Unidad Orgánica : ".$unidadorg->nombre."<br>";

            if($formacopia==1)
            {
                $mensaje.="Forma : Copia<br>";
            }
            
            $mensaje.="Detalle : ".$detalledestino."<br>";


            $mensaje.="<br><br>";
            $mensaje.="<b>Nota: Se adjunta en el presente correo el archivo adjunto ingresado en el trámite</b>";
            $mensaje.="<br><br>";
            $mensaje.="<br><br>";
            $mensaje.="<br><br>";

            $mensaje.="Este es un mensaje automático del sistema, por favor no responda este mensaje, si tuviera alguna dificultad para ingresar a la plataforma del Sistema de Gestión Documental, acérquese a la UGEL Yungay y reporte su problema.";


            $user=User::find(Auth::user()->id);


            if(strlen($data->rutafile)>0)
                {
                    $adjunto=public_path('archivosadjuntos')."/".$data->rutafile;
                    return $this->view('mail1',['msg'=>$mensaje])->attach($adjunto)->to($user->email)->subject($asunt)->from("sgdugelyungay@gmail.com");
                }

                else{

                    return $this->view('mail1',['msg'=>$mensaje])->to($user->email)->subject($asunt)->from("sgdugelyungay@gmail.com");
                }


            

        }

        else{

        

        $file = $data->archivo;


        if($data->hasFile('archivo')){
            $nombre2=$file->getClientOriginalName();


            $iduser=Auth::user()->id;
            $user=User::find($iduser);

            $admin=DB::select("select p.apellidos, p.nombres from personas p
inner join users u on u.persona_id=p.id
where u.id='".$iduser."';");


            $adminName="";

            foreach ($admin as  $dato) {
                $adminName=$dato->apellidos.', '.$dato->nombres;
            }

           $adjunto=public_path('emails')."/".$nombre2;

        return $this->view('mail',['name'=>$user->name,'msg'=>$data->mensaje,'admin'=>$adminName])->attach($adjunto)->to(json_decode(stripslashes($data->mails)))->subject($data->asunto)->from("rediescsjan@gmail.com");
        

        }else{
            $iduser=Auth::user()->id;
            $user=User::find($iduser);

            $admin=DB::select("select p.apellidos, p.nombres from personas p
inner join users u on u.persona_id=p.id
where u.id='".$iduser."';");


            $adminName="";

            foreach ($admin as  $dato) {
                $adminName=$dato->apellidos.', '.$dato->nombres;
            }

        return $this->view('mail',['name'=>$user->name,'msg'=>$data->mensaje,'admin'=>$adminName])->to(json_decode(stripslashes($data->mails)))->subject($data->asunto)->from("rediescsjan@gmail.com");
        }

    }
    }
}
