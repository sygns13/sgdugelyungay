<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Twilio\Jwt\ClientToken;

class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function sendSms()
    {
        $accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
        $authToken  = config('app.twilio')['TWILIO_AUTH_TOKEN'];
        $appSid     = config('app.twilio')['TWILIO_APP_SID'];
        $client = new Client($accountSid, $authToken);
        try
        {
            // Use the client to do fun stuff like send text messages!
            $client->messages->create(
            // the number you'd like to send the message to chuvis 51944129804 vale 962533891
                '+51944129804',
           array(
                 // A Twilio phone number you purchased at twilio.com/console
                 'from' => '+15592064045',
                 // the body of the text message you'd like to send
                 'body' => 'Hola Vale chupa rata, prueba SMS desde Twilio y laravel'
             )
         );
   }
        catch (Exception $e)
        {
            echo "Error: " . $e->getMessage();
        }
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
    public function store(Request $request)
    {

            ini_set('memory_limit','256M');

        $mensaje=$request->mensaje;

        $telefonos=json_decode(stripslashes($request->telefonos));



        $accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
        $authToken  = config('app.twilio')['TWILIO_AUTH_TOKEN'];
        $appSid     = config('app.twilio')['TWILIO_APP_SID'];
        $client = new Client($accountSid, $authToken);



        for ($i=0; $i <count($telefonos) ; $i++) { 

             try
                {
                    // Use the client to do fun stuff like send text messages!
                    $client->messages->create(
                    // the number you'd like to send the message to chuvis 51944129804 vale 962533891
                        $telefonos[$i],
                   array(
                         // A Twilio phone number you purchased at twilio.com/console
                         'from' => '+15592064045',
                         // the body of the text message you'd like to send
                         'body' => strval($mensaje)
                     )
                 );
           }
                catch (Exception $e)
                {
                    echo "Error: " . $e->getMessage();
                }
        
        }

        



      /*  foreach ($telefonos as $telefono) {

        $accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
        $authToken  = config('app.twilio')['TWILIO_AUTH_TOKEN'];
        $appSid     = config('app.twilio')['TWILIO_APP_SID'];
        $client = new Client($accountSid, $authToken);

        try
        {
            // Use the client to do fun stuff like send text messages!
            $client->messages->create(
            // the number you'd like to send the message to chuvis 51944129804 vale 962533891
                strval($telefono),
           array(
                 // A Twilio phone number you purchased at twilio.com/console
                 'from' => '+15592064045',
                 // the body of the text message you'd like to send
                 'body' => strval($mensaje)
             )
         );
   }
        catch (Exception $e)
        {
            echo "Error: " . $e->getMessage();
        }

        }*/

        




         
         $result='1';
         $msj='';
         $selector='';




         $msj='Mensaje Remitido Exitosamente';

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
