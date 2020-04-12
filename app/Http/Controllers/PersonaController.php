<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\User;
use Mail;

use Validator;
use Auth;
use DB;
use Storage;
use Illuminate\Support\Facades\Input;

use App\Mail\SendMail;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

        public function index1()
    {
        if(accesoUser([1,2])){

            $iduser=Auth::user()->id;
        $idtipouser=Auth::user()->tipouser_id;
        $tipouser=Tipouser::find($idtipouser);

        $persona=DB::table('personas')
        ->join('users', 'users.persona_id', '=', 'personas.id')
        ->join('tipousers','tipousers.id','=','users.tipouser_id')
        ->where('users.borrado','0')
        ->where('users.id',$iduser)
        ->select('personas.id as idper', 'personas.doc as dni', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc', 'users.id as idUsser', 'users.name as username', 'users.email','users.activo as activouser','tipousers.nombre as tipouser')->get();



        $modulo="magistrados";

        return view('magistrados.index',compact('modulo','tipouser'));

        }
    else
        {
            return view('adminlte::home');           
        }
    }

        public function index(Request $request)
    {
        $buscar=$request->busca;

        $personas=Persona::where('borrado','0')->where('activo','2')
        ->where(function($query) use ($buscar){
        $query->where('doc','like','%'.$buscar.'%');
        $query->orWhere('apellidos','like','%'.$buscar.'%');
        $query->orWhere('nombres','like','%'.$buscar.'%');
    })
        ->orderBy('apellidos')->orderBy('nombres')->paginate(50);



        return [
            'pagination'=>[
                'total'=> $personas->total(),
                'current_page'=> $personas->currentPage(),
                'per_page'=> $personas->perPage(),
                'last_page'=> $personas->lastPage(),
                'from'=> $personas->firstItem(),
                'to'=> $personas->lastItem(),
            ],
            'personas'=>$personas,

        ];

    }

    public function verpersona($dni)
    {
       $persona=Persona::where('dni',$dni)->where('borrado','0')->get();

       $idPersona="0";
       $datos="";
       $res=1;


       foreach ($persona as $key => $dato) {
          $idPersona=$dato->id;
       }

       $nombres="";
       $apellidos="";

       if( $idPersona=="0")
       {
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
       }



       return response()->json(["datos"=>$datos,"res"=>$res, "idPersona"=>$idPersona]);

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

    public function resetclave(Request $request)
    {   
        $result='1';
        $msj='';
        $selector='';
        $errors="";

        $dni=$request->txtdniE;
        $email=$request->txtemailE;

        $request->tipomail="2";
        $request->archivo="";

        $request->nombres='';
        $request->apellidos='';
        $request->dni='';
        $request->name='';
        $request->password='';

        $input3  = array('dni' => $dni);
        $reglas3 = array('dni' => 'required');

        $input7  = array('email' => $email);
        $reglas7 = array('email' => 'required');

        $validator3 = Validator::make($input3, $reglas3);
        $validator7 = Validator::make($input7, $reglas7);

        $validate = Validator::make(Input::all(), [
            'g-recaptcha-response' => 'required|captcha'
        ]);

        
        if ($validate->fails())
        {
            $result='2';
            $msj='Captcha error! Debe de completar el Captcha requerido';
            $selector='captcha';

            $errors=$validate->errors();
        }

        elseif ($validator3->fails()) {
            $result='0';
            $msj='Debe de completar su Nª de DNI';
            $selector='txtdniE';
        }
        elseif ($validator7->fails()) {
            $result='0';
            $msj='Debe de completar su Email';
            $selector='txtemailE';
        }else{
            $usuario=DB::select("select u.id,u.name, u.email,p.nombres,p.apellidos,p.dni from personas p
            inner join users u on p.id=u.persona_id
            where p.dni='".$dni."' and u.email='".$email."';");

            $aux=0;
            $idU="";
            foreach ($usuario as $key => $dato) {
                $aux=1;

                $request->nombres=$dato->nombres;
                $request->apellidos=$dato->apellidos;
                $request->dni=$dato->dni;
                $request->name=$dato->name;

                $idU=$dato->id;

            }



            if($aux==0){
                $result='0';
                $msj='Los Datos Ingresados no corresponden a un Usuario Registrado en el Sistema';
                $selector='txtdniE';
            }else{

                $password="";

                $caracteres = '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                    for($x = 0; $x < 4; $x++){
                        $password = substr(str_shuffle($caracteres), 0, 4);
                    }

                $request->password=$password;

                $edutUser =User::findOrFail($idU);
                $edutUser->password=bcrypt($password);
                $edutUser->save();


                Mail::send(new SendMail());

                $msj='Password de Usuario reseteado y enviado al email ingresado, Proceda a Iniciar Sesión';


            }

        }
        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector,'errors'=>$errors]);
    }

    public function store(Request $request)
    {
        $result='1';
        $msj='';
        $selector='';
        $errors="";

        $nombres=$request->txtnombres;
        $apellidos=$request->txtapellidos;
        $dni=$request->txtdni;
        $genero=$request->cbugenero;
        $direccion=$request->txtdir;

        $name=$request->txtuser;
        $password=$request->txtclave;
        $email=$request->txtemail;

        $request->tipomail="1";
        $request->archivo="";


        $input1  = array('nombres' => $nombres);
        $reglas1 = array('nombres' => 'required');

        $input2  = array('apellidos' => $apellidos);
        $reglas2 = array('apellidos' => 'required');

        $input3  = array('dni' => $dni);
        $reglas3 = array('dni' => 'required');

        $input4  = array('dni' => $dni);
        $reglas4 = array('dni' => 'unique:personas,dni'.',1,borrado');

        $input5  = array('name' => $name);
        $reglas5 = array('name' => 'required');

        $input6  = array('password' => $password);
        $reglas6 = array('password' => 'required');

        $input7  = array('email' => $email);
        $reglas7 = array('email' => 'required');

        $input8  = array('name' => $name);
        $reglas8 = array('name' => 'unique:users,name');

        $input9  = array('email' => $email);
        $reglas9 = array('email' => 'unique:users,email');

        $input10  = array('email' => $email);
        $reglas10 = array('email' => 'regex:/^.+@.+$/i');

        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);
        $validator3 = Validator::make($input3, $reglas3);
        $validator4 = Validator::make($input4, $reglas4);
        $validator5 = Validator::make($input5, $reglas5);
        $validator6 = Validator::make($input6, $reglas6);
        $validator7 = Validator::make($input7, $reglas7);
        $validator8 = Validator::make($input8, $reglas8);
        $validator9 = Validator::make($input9, $reglas9);
        $validator10 = Validator::make($input10, $reglas10);
  



        $validate = Validator::make(Input::all(), [
            'g-recaptcha-response' => 'required|captcha'
        ]);

        
        if ($validate->fails())
        {
            $result='2';
            $msj='Captcha error! Debe de completar el Captcha requerido';
            $selector='captcha';

            $errors=$validate->errors();
        }
        elseif ($validator1->fails()) {
            $result='0';
            $msj='Debe de completar sus nombres';
            $selector='txtnombres';
        }
        elseif ($validator2->fails()) {
            $result='0';
            $msj='Debe de completar sus apellidos';
            $selector='txtapellidos';
        }
        elseif ($validator3->fails()) {
            $result='0';
            $msj='Debe de completar su Nª de DNI';
            $selector='txtdni';
        }
        elseif (strlen($dni)!=8) {
            $result='0';
            $msj='Su N° de DNI debe de tener 08 dígitos';
            $selector='txtdni';
        }
        elseif ($validator4->fails()) {
            $result='0';
            $msj='El N° de DNI ingresado ya se encuentra registrado';
            $selector='txtdni';
        }
        elseif ($validator5->fails()) {
            $result='0';
            $msj='Debe de completar su nombre de Usuario';
            $selector='txtuser';
        }
        elseif ($validator6->fails()) {
            $result='0';
            $msj='Debe de completar su Password';
            $selector='txtclave';
        }
        elseif ($validator7->fails()) {
            $result='0';
            $msj='Debe de completar su Email';
            $selector='txtemail';
        }
        elseif ($validator8->fails()) {
            $result='0';
            $msj='El nombre de Usuario ingresado ya se encuentra registrado';
            $selector='txtuser';
        }
        elseif ($validator9->fails()) {
            $result='0';
            $msj='El email ingresado ya se encuentra registrado';
            $selector='txtemail';
        }
        elseif ($validator10->fails()) {
            $result='0';
            $msj='El Email no cuenta con un formato correcto: example@dominio.com';
            $selector='txtemail';
        }

        else{

            $newPersona = new Persona();

            $newPersona->nombres=$nombres;
            $newPersona->apellidos=$apellidos;
            $newPersona->dni=$dni;
            $newPersona->genero=$genero;
            $newPersona->direccion=$direccion;
            $newPersona->imagen='';

            $newPersona->activo='1';
            $newPersona->borrado='0';

            $newPersona->save();


            $newUser = new User();

                $newUser->name=$name;
                $newUser->email=$email;
                $newUser->password=bcrypt($password);
                $newUser->persona_id=$newPersona->id;
                $newUser->tipouser_id='3';
                $newUser->activo='1';
                $newUser->borrado='0';                   

            $newUser->save();


            Mail::send(new SendMail());

            $msj='Nuevo Usuario Registrado con éxito, se envió un Correo Electrónico a su Email Registrado confirmando su registro, Proceda a Iniciar Sesión';


        }

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector,'errors'=>$errors]);
    }
    /* public function store(Request $request)
    {
        $result='1';
        $msj='';
        $selector='';

        $idPersona=$request->idPersona;
        $idUser=$request->idUser;

        $newDNI=$request->newDNI;
        $newNombres=$request->newNombres;
        $newApellidos=$request->newApellidos;
        $newGenero=$request->newGenero;
        $newTelefono=$request->newTelefono;
        $newDireccion=$request->newDireccion;
        $newEmail=$request->newEmail;
        
        $img=$request->imagen;
        $imagen="";
        $segureImg=0;
        $newTipoDocu=$request->newTipoDocu;

        $newUsername=$request->newUsername;
        $newPassword=$request->newPassword;

        $newEstado=$request->newEstado;
        $newTipoUser=$request->newTipoUser;
        $newProvincia=$request->newProvincia;



        $oldImagen=$request->oldImagen;



        if ($request->hasFile('imagen')) { 

            $aux=$newDNI;
            $input  = array('image' => $img) ;
            $reglas = array('image' => 'required|image|mimes:png,jpg,jpeg,gif,jpe,PNG,JPG,JPEG,GIF,JPE');
            $validator = Validator::make($input, $reglas);

            if ($validator->fails())
            {

            $segureImg=1;
            $msj="El archivo ingresado como imagen no es una imagen válida, ingrese otro archivo o limpie el formulario";
            $result='0';
            $selector='archivo';
            }

            else
            {

                if(strlen($oldImagen)>0){
                    Storage::disk('perfil')->delete($oldImagen);
                }

            $nombre=$img->getClientOriginalName();
            $extension=$img->getClientOriginalExtension();
            $nuevoNombre=$aux.".".$extension;
            $subir=Storage::disk('perfil')->put($nuevoNombre, \File::get($img));

            if($subir){
                $imagen=$nuevoNombre;

                



            }
            else{
                $msj="Error al subir la imagen, intentelo nuevamente luego";
                $segureImg=1;
                $result='0';
                $selector='archivo';
            }
        }

        }

        if($segureImg==1){ 
            Storage::disk('perfil')->delete($imagen);
        }
        else{

        $input1  = array('titulo' => $newDNI);
        $reglas1 = array('titulo' => 'required');

        $input2  = array('nombres' => $newNombres);
        $reglas2 = array('nombres' => 'required');

        $input3  = array('apellidos' => $newApellidos);
        $reglas3 = array('apellidos' => 'required');



        //$input6  = array('carrera' => $newCarrerasunasam);
       // $reglas6 = array('carrera' => 'required');

        // Segunda Carrera OP chekiar $newcarrera_id2

         $validator1 = Validator::make($input1, $reglas1);
         $validator2 = Validator::make($input2, $reglas2);
         $validator3 = Validator::make($input3, $reglas3);

         //$validator6 = Validator::make($input6, $reglas6);

         if ($validator1->fails())
        {
            $result='0';
            $msj='Debe ingresar el DNI del usuario';
            $selector='txtDNI';
        }elseif ($validator2->fails()) {
            $result='0';
            $msj='Debe ingresar el nombre del usuario';
            $selector='txtnombres';
        }elseif ($validator3->fails()) {
            $result='0';
            $msj='Debe ingresar los Apellidos del usuario';
            $selector='txtapellidos';
        }
        else{


                        //$idPersona
                         if($idPersona=="0"){

                            $newPersona = new Persona();

                                $newPersona->doc=$newDNI;
                                $newPersona->nombres=$newNombres;
                                $newPersona->apellidos=$newApellidos;
                                $newPersona->genero=$newGenero;
                                $newPersona->telefono=$newTelefono;
                                $newPersona->direccion=$newDireccion;
                                $newPersona->email=$newEmail;
                               // $newPersona->imagen=$imagen;
                   
                                $newPersona->activo='2';
                                $newPersona->borrado='0';
                                $newPersona->tipodoc='1';

                            $newPersona->save();

                            


                            $msj='Nuevo Magistrado registrado con éxito';

                        }
                        else{
                            //editar Persona



                            $editPersona = Persona::findOrFail($idPersona);

                                $editPersona->nombres=$newNombres;
                                $editPersona->apellidos=$newApellidos;
                                $editPersona->genero=$newGenero;
                                $editPersona->telefono=$newTelefono;
                                $editPersona->direccion=$newDireccion;
                                $editPersona->email=$newEmail;
                                $editPersona->activo='2';
                                $editPersona->borrado='0';


                            $editPersona->save();




                            $msj='Nuevo Magistrado del Sistema registrado con éxito';
                        }
                       
                    

            }
        }



        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
    }
 */
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
        $result='1';
        $msj='';
        $selector='';

        $idPersona=$request->idPersona;
        $idUser=$request->idUser;

        $editDNI=$request->editDNI;
        $editNombres=$request->editNombres;
        $editApellidos=$request->editApellidos;
        $editGenero=$request->editGenero;
        $editTelefono=$request->editTelefono;
        $editDireccion=$request->editDireccion;
        $editEmail=$request->editEmail;   


        $img=$request->imagen;
        $imagen="";
        $segureImg=0;
        $editTipoDocu=$request->editTipoDocu;


        $editUsername=$request->editUsername;

        $editPassword=$request->editPassword;

        $idtipo=$request->idtipo;
        $provincia_id=$request->provincia_id;
        $activo=$request->activo;



        $oldImagen=$request->oldImagen;

        if ($request->hasFile('imagen')) { 

            $aux=$editDNI;
            $input  = array('image' => $img) ;
            $reglas = array('image' => 'required|image|mimes:png,jpg,jpeg,gif,jpe,PNG,JPG,JPEG,GIF,JPE');
            $validator = Validator::make($input, $reglas);

            if ($validator->fails())
            {

            $segureImg=1;
            $msj="El archivo ingresado como imagen no es una imagen válida, ingrese otro archivo o limpie el formulario";
            $result='0';
            $selector='archivo';
            }

            else
            {

                if(strlen($oldImagen)>0){
                    Storage::disk('perfil')->delete($oldImagen);
                }

            $nombre=$img->getClientOriginalName();
            $extension=$img->getClientOriginalExtension();
            $nuevoNombre=$aux.".".$extension;
            $subir=Storage::disk('perfil')->put($nuevoNombre, \File::get($img));

            if($subir){
                $imagen=$nuevoNombre;

                



            }
            else{
                $msj="Error al subir la imagen, intentelo nuevamente luego";
                $segureImg=1;
                $result='0';
                $selector='archivo';
            }
        }

        }

        if($segureImg==1){ 
            Storage::disk('perfil')->delete($imagen);
        }
        else
        {

        $input1  = array('dni' => $editDNI);
        $reglas1 = array('dni' => 'required');

        $input0  = array('dni' => $editDNI);
        $reglas0 = array('dni' => 'unique:personas,doc,'.$id.',id,borrado,0');

        $input2  = array('nombres' => $editNombres);
        $reglas2 = array('nombres' => 'required');

        $input3  = array('apellidos' => $editApellidos);
        $reglas3 = array('apellidos' => 'required');

        //$input6  = array('carrera' => $newCarrerasunasam);
       // $reglas6 = array('carrera' => 'required');

        // Segunda Carrera OP chekiar $newcarrera_id2

         $validator1 = Validator::make($input1, $reglas1);
         $validator0 = Validator::make($input0, $reglas0);
         $validator2 = Validator::make($input2, $reglas2);
         $validator3 = Validator::make($input3, $reglas3);
         //$validator6 = Validator::make($input6, $reglas6);

         if ($validator1->fails())
        {
            $result='0';
            $msj='Debe ingresar el DNI del usuario';
            $selector='txtDNIE';
        }elseif ($validator2->fails()) {
            $result='0';
            $msj='Debe ingresar el nombre del usuario';
            $selector='txtnombresE';
        }elseif ($validator3->fails()) {
            $result='0';
            $msj='Debe ingresar los Apellidos del usuario';
            $selector='txtapellidosE';
        }
        else{



                         $editPersona = Persona::findOrFail($idPersona);


                                $editPersona->doc=$editDNI;
                                $editPersona->nombres=$editNombres;
                                $editPersona->apellidos=$editApellidos;
                                $editPersona->genero=$editGenero;
                                $editPersona->telefono=$editTelefono;
                                $editPersona->direccion=$editDireccion;
                                $editPersona->email=$editEmail;

                            $editPersona->save();
                            


                            $msj='Magistrado modificado con éxito';

                      

          }

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



        $borrarUsuario = Persona::findOrFail($id);
        //$task->delete();

        $borrarUsuario->borrado='1';

        $borrarUsuario->save();


        $magistrado=Magistrado::where('persona_id',$id)->get();

        foreach ($magistrado as $key => $dato) {
            $borrarMagistrado = Magistrado::findOrFail($dato->id);
            $borrarMagistrado->borrado='1';
            $borrarMagistrado->save();
        }


        $msj='Magistrado seleccionado eliminado exitosamente';


        return response()->json(["result"=>$result,'msj'=>$msj]);
    }
}
