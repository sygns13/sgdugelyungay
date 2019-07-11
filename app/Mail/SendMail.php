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
