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
use App\User;

ini_set('memory_limit','256M');

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
