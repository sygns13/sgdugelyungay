<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\User;
use App\Tipouser;
use App\Provincias;
use App\Magistrado;

use Validator;
use Auth;
use DB;
use Storage;


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
       $user=Persona::where('doc',$dni)->where('activo','2')->where('borrado','0')->get();
       $persona=Persona::where('doc',$dni)->get();

       $id="0";
       $idUser="0";

       foreach ($persona as $key => $dato) {
          $id=$dato->id;
       }

       foreach ($user as $key => $dato) {
          $idUser=$dato->id;
       }

       return response()->json(["persona"=>$persona, "id"=>$id,"user"=>$user, "idUser"=>$idUser]);

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
