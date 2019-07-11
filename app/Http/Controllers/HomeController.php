<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Tipouser;
use App\User;
use App\DocumentoGestion;
use App\PresentacionInicio;
use App\VideoPresentacion;
use App\Galeria;
use App\Calendario;
use App\Dependencia;
use App\Funciones;

use App\Foro;
use App\RespuestaForo;


use App\Iniciosesion;
use App\Alerta;
use stdClass;
use DB;


use Auth;
/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */

    public function revisarAlert(Request $request)
    {

        $iduser=Auth::user()->id;
        $alerta=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->get();
        $contAlert=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->count();


        $reporte=DB::select("select m.id, m.anio, m.mes, d.nombre,

ifnull(sum(e.tramite)+sum(e.Reserva),'0') as tramite, ifnull(sum(e.prodjudexpprincipal),'0') as resuelto, ifnull(sum(e.totalingtramite),'0') as ingresos,
                    ifnull(sum(e.totalingtramite),'0') as ingresos2,


                    ifnull(sum(e.sentencia),'0') as sentencia, ifnull(sum(e.totalautofinal),'0') as autofinal, ifnull(sum(e.conciliados),'0') as conciliados, ifnull(sum(e.inffinal),'0') as inffinal, ifnull(sum(e.autodemimprocedente),'0') as autoimpro,
ifnull(sum(e.apelconfirmado),'0') as apelconfirmado, ifnull(sum(e.apelrevocada),'0') as apelrevocada, ifnull(sum(e.apelanulada),'0') as apelanulada
FROM maindatos m
inner join expedientes e on m.id=e.maindato_id
inner join dependencias d on d.cod_sis=e.n_dependencia
where m.activo=1 and m.borrado=0 and d.id='".Auth::user()->dependencia_id."'
group by. m.id
order by m.fecharef desc limit 1;");

        return response()->json(['alerta'=>$alerta,'contAlert'=>$contAlert,'reporte'=>$reporte]);
    }


    public function reportesAdmin(){
        $iduser=Auth::user()->id;

        $docgestion = DocumentoGestion::where('activo','=','1')->get();
        // $docgestion->toarray();
        $preIni = PresentacionInicio::where('activo','=','1')->first();
        $videoP = VideoPresentacion::where('activo','=','1')->first();

        if($videoP==""){
            $videoP= new stdClass();

            $videoP->enlace="";
            $videoP->titulo="";

        }


        $fec=date("Y-m-d");
        $hra=date("H:i:s");

        $modulo="inicio";
        $idtipouser=Auth::user()->tipouser_id;
        $tipouser=Tipouser::find($idtipouser);

        $contAlert=0;

        $foros1=Foro::where('borrado','0')->where('activo','1')->orderby('id','desc')->limit(4)->get();

        return view('inicio.home',compact('tipouser','modulo','docgestion','videoP','preIni','iduser','alerta','contAlert','foros1'));
    }
    public function index(Request $request)
    {

         $iduser=Auth::user()->id;

        $numuser=User::where('id',$iduser)->where('activo','1')->where('borrado','0')->count();
        if($numuser==1){

            $idtipouser=Auth::user()->tipouser_id;
            $tipouser=Tipouser::find($idtipouser);
            $modulo="inicio";

             $docgestion = DocumentoGestion::where('activo','=','1')->get();
            // $docgestion->toarray();
            $preIni = PresentacionInicio::where('activo','=','1')->first();
            $videoP = VideoPresentacion::where('activo','=','1')->first();

            if($videoP==""){
                $videoP= new stdClass();

                $videoP->enlace="";
                $videoP->titulo="";

            }


            $fec=date("Y-m-d");
            $hra=date("H:i:s");


            $count2=Iniciosesion::where('activo','1')->where('borrado','0')->where('fecha',$fec)->count();


            if($count2==0){
                            $ip=$request->ip();
            $mac= '';
         $newinicio=new Iniciosesion();

             $newinicio->fecha=$fec;
             $newinicio->hora=$hra;
             $newinicio->recordar='0';
             $newinicio->ip=$ip;
             $newinicio->mac=$mac;
             $newinicio->activo='1';
             $newinicio->borrado='0';
             $newinicio->users_id=$iduser;

             $newinicio->save();
            }

            $alerta="";
            $contAlert=0;
            if(accesoUser([2])){
                $alerta=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->get();
                $contAlert=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->count();
            }

            if($idtipouser=="1" ){
                $foros1=Foro::where('borrado','0')->where('activo','1')->orderby('id','desc')->limit(4)->get();

                return view('inicio.home',compact('tipouser','modulo','docgestion','videoP','preIni','iduser','alerta','contAlert','foros1'));

            }elseif($idtipouser=="3"){

                $foros1=Foro::where('borrado','0')->where('activo','1')->orderby('id','desc')->limit(4)->get();
                $foros2=DB::select("select f.id, f.titulo, f.descripcion, f.fecha, f.hora, count(r.id) as msjs
        from foros f
        left join respforos r on f.id=r.foro_id
        order by count(r.id),f.id desc limit 4;");

        $foros3=DB::select("select f.id, f.titulo, f.descripcion, f.fecha, f.hora, count(r.id) as msjs
from foros f
left join respforos r on f.id=r.foro_id
where r.user_id='".Auth::user()->id."'
order by count(r.id),f.id desc limit 4;");

$persona=DB::table('users')
->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
->join('personas', 'users.persona_id', '=', 'personas.id')
->leftJoin('dependencias', 'users.dependencia_id', '=', 'dependencias.id')
->leftJoin('distritos', 'dependencias.distrito_id', '=', 'distritos.id')
->leftJoin('provincias', 'distritos.provincia_id', '=', 'provincias.id')
->where('users.id',$iduser)
->orderBy('tipousers.id')
->orderBy('users.id')
->orderBy('personas.apellidos')
->select('users.id as iduser','users.name as username','users.email','users.token2','users.activo','users.dependencia_id','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.doc', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc','dependencias.id as idDep','dependencias.nombre as dependencia','distritos.id as idDis', 'distritos.nombre as distrito', 'provincias.id as idProv','provincias.nombre as provincia')->get();

                return view('web2.index',compact('tipouser','preIni','iduser','foros1','foros2','foros3','docgestion','persona'));
            }
            
            else{


    $anio0=intval(date("Y"));
    $anion=intval(date("Y"));


                $sql = "select d.id as iddep , d.cod_sis as n_dependencia, d.nombre as dependencia, di.nombre as distrito, p.nombre as provincia, de.nombre as departamento ,
                ifnull(e.cant,'0') as cantEstandar, ifnull(m.cant,'0') as cantMetas, d.cod_comparar, d.activo_proc

    from dependencias d
inner join users u on u.dependencia_id=d.id
inner join distritos di on di.id=d.distrito_id
inner join provincias p on p.id=di.provincia_id
inner join departamentos de on de.id=p.departamento_id
left join estandars e on e.dependencia_id=d.id and e.anio='".$anio0."'
left join metas m on m.dependencia_id=d.id and m.anio='".$anion."'
where u.id='".$iduser."';";

$datos=DB::select($sql);




 $persona=DB::table('users')
        ->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
        ->join('personas', 'users.persona_id', '=', 'personas.id')
        ->leftJoin('dependencias', 'users.dependencia_id', '=', 'dependencias.id')
        ->leftJoin('distritos', 'dependencias.distrito_id', '=', 'distritos.id')
        ->leftJoin('provincias', 'distritos.provincia_id', '=', 'provincias.id')
        ->where('users.id',$iduser)
        ->orderBy('tipousers.id')
        ->orderBy('users.id')
        ->orderBy('personas.apellidos')
        ->select('users.id as iduser','users.name as username','users.email','users.token2','users.activo','users.dependencia_id','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.doc', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc','dependencias.id as idDep','dependencias.nombre as dependencia','distritos.id as idDis', 'distritos.nombre as distrito', 'provincias.id as idProv','provincias.nombre as provincia')->get();

        $foros1=Foro::where('borrado','0')->where('activo','1')->orderby('id','desc')->limit(4)->get();
        $foros2=DB::select("select f.id, f.titulo, f.descripcion, f.fecha, f.hora, count(r.id) as msjs
from foros f
left join respforos r on f.id=r.foro_id
order by count(r.id),f.id desc limit 4;");
        $foros3=DB::select("select f.id, f.titulo, f.descripcion, f.fecha, f.hora, count(r.id) as msjs
from foros f
left join respforos r on f.id=r.foro_id
where r.user_id='".Auth::user()->id."'
order by count(r.id),f.id desc limit 4;");
                
                return view('web.index2',compact('tipouser','docgestion','preIni','iduser','alerta','contAlert','datos','persona','foros1','foros2','foros3'));
            }


            

         }
        else{
            Auth::logout();

          return redirect()->back()
            ->withErrors([
                'email' => 'usuarioActiv'
            ]);
        }
    }



    public function consultahome2(Request $request)
    {

         $iduser=Auth::user()->id;

        $numuser=User::where('id',$iduser)->where('activo','1')->where('borrado','0')->count();
        if($numuser==1){

            $idtipouser=Auth::user()->tipouser_id;
            $tipouser=Tipouser::find($idtipouser);
            $modulo="inicio";

             $docgestion = DocumentoGestion::where('activo','=','1')->get();
            // $docgestion->toarray();
            $preIni = PresentacionInicio::where('activo','=','1')->first();
            $funciones = Funciones::where('activo','=','1')->first();
            $videoP = VideoPresentacion::where('activo','=','1')->first();

            if($videoP==""){
                $videoP= new stdClass();

                $videoP->enlace="";
                $videoP->titulo="";

            }


            $fec=date("Y-m-d");
            $hra=date("H:i:s");
/*
            use App\Foro;
use App\RespuestaForo;
*/

            $foros1=Foro::where('borrado','0')->where('activo','1')->orderby('id','desc')->limit(4)->get();


            $count2=Iniciosesion::where('activo','1')->where('borrado','0')->where('fecha',$fec)->count();


            if($count2==0){
                            $ip=$request->ip();
            $mac= '';
         $newinicio=new Iniciosesion();

             $newinicio->fecha=$fec;
             $newinicio->hora=$hra;
             $newinicio->recordar='0';
             $newinicio->ip=$ip;
             $newinicio->mac=$mac;
             $newinicio->activo='1';
             $newinicio->borrado='0';
             $newinicio->users_id=$iduser;

             $newinicio->save();
            }

            $alerta="";
            $contAlert=0;
            if(accesoUser([2])){
                $alerta=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->get();
                $contAlert=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->count();
            }

            if($idtipouser=="1"){
                return view('inicio.home',compact('tipouser','modulo','docgestion','videoP','preIni','iduser','alerta','contAlert','foros1'));

            }elseif($idtipouser=="3"){

                $foros1=Foro::where('borrado','0')->where('activo','1')->orderby('id','desc')->limit(4)->get();
                $foros2=DB::select("select f.id, f.titulo, f.descripcion, f.fecha, f.hora, count(r.id) as msjs
        from foros f
        left join respforos r on f.id=r.foro_id
        order by count(r.id),f.id desc limit 4;");

        $foros3=DB::select("select f.id, f.titulo, f.descripcion, f.fecha, f.hora, count(r.id) as msjs
from foros f
left join respforos r on f.id=r.foro_id
where r.user_id='".Auth::user()->id."'
order by count(r.id),f.id desc limit 4;");

$persona=DB::table('users')
->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
->join('personas', 'users.persona_id', '=', 'personas.id')
->leftJoin('dependencias', 'users.dependencia_id', '=', 'dependencias.id')
->leftJoin('distritos', 'dependencias.distrito_id', '=', 'distritos.id')
->leftJoin('provincias', 'distritos.provincia_id', '=', 'provincias.id')
->where('users.id',$iduser)
->orderBy('tipousers.id')
->orderBy('users.id')
->orderBy('personas.apellidos')
->select('users.id as iduser','users.name as username','users.email','users.token2','users.activo','users.dependencia_id','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.doc', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc','dependencias.id as idDep','dependencias.nombre as dependencia','distritos.id as idDis', 'distritos.nombre as distrito', 'provincias.id as idProv','provincias.nombre as provincia')->get();

                return view('web2.index3',compact('tipouser','preIni','iduser','foros1','foros2','foros3','docgestion','persona','funciones'));
            }else{


    $anio0=intval(date("Y"));
    $anion=intval(date("Y"));


                $sql = "select d.id as iddep , d.cod_sis as n_dependencia, d.nombre as dependencia, di.nombre as distrito, p.nombre as provincia, de.nombre as departamento ,
                ifnull(e.cant,'0') as cantEstandar, ifnull(m.cant,'0') as cantMetas, d.cod_comparar, d.activo_proc

    from dependencias d
inner join users u on u.dependencia_id=d.id
inner join distritos di on di.id=d.distrito_id
inner join provincias p on p.id=di.provincia_id
inner join departamentos de on de.id=p.departamento_id
left join estandars e on e.dependencia_id=d.id and e.anio='".$anio0."'
left join metas m on m.dependencia_id=d.id and m.anio='".$anion."'
where u.id='".$iduser."';";

$datos=DB::select($sql);




 $persona=DB::table('users')
        ->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
        ->join('personas', 'users.persona_id', '=', 'personas.id')
        ->leftJoin('dependencias', 'users.dependencia_id', '=', 'dependencias.id')
        ->leftJoin('distritos', 'dependencias.distrito_id', '=', 'distritos.id')
        ->leftJoin('provincias', 'distritos.provincia_id', '=', 'provincias.id')
        ->where('users.id',$iduser)
        ->orderBy('tipousers.id')
        ->orderBy('users.id')
        ->orderBy('personas.apellidos')
        ->select('users.id as iduser','users.name as username','users.email','users.token2','users.activo','users.dependencia_id','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.doc', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc','dependencias.id as idDep','dependencias.nombre as dependencia','distritos.id as idDis', 'distritos.nombre as distrito', 'provincias.id as idProv','provincias.nombre as provincia')->get();


        $foros1=Foro::where('borrado','0')->where('activo','1')->orderby('id','desc')->limit(4)->get();
        $foros2=DB::select("select f.id, f.titulo, f.descripcion, f.fecha, f.hora, count(r.id) as msjs
from foros f
left join respforos r on f.id=r.foro_id
order by count(r.id),f.id desc limit 4;");
        $foros3=DB::select("select f.id, f.titulo, f.descripcion, f.fecha, f.hora, count(r.id) as msjs
from foros f
left join respforos r on f.id=r.foro_id
where r.user_id='".Auth::user()->id."'
order by count(r.id),f.id desc limit 4;");
                
                return view('web.index3',compact('tipouser','docgestion','preIni','iduser','alerta','contAlert','datos','persona','foros1','foros2','foros3','funciones'));
            }


            

         }
        else{
            Auth::logout();

          return redirect()->back()
            ->withErrors([
                'email' => 'usuarioActiv'
            ]);
        }
    }


        public function home2(Request $request)
    {

         $iduser=Auth::user()->id;

        $numuser=User::where('id',$iduser)->where('activo','1')->where('borrado','0')->count();
        if($numuser==1){

            $idtipouser=Auth::user()->tipouser_id;
            $tipouser=Tipouser::find($idtipouser);
            $modulo="inicio";

             $docgestion = DocumentoGestion::where('activo','=','1')->get();
            // $docgestion->toarray();
            $preIni = PresentacionInicio::where('activo','=','1')->first();
            $funciones = Funciones::where('activo','=','1')->first();
            $videoP = VideoPresentacion::where('activo','=','1')->first();

            if($videoP==""){
                $videoP= new stdClass();

                $videoP->enlace="";
                $videoP->titulo="";

            }


            $fec=date("Y-m-d");
            $hra=date("H:i:s");
/*
            use App\Foro;
use App\RespuestaForo;
*/

            $foros1=Foro::where('borrado','0')->where('activo','1')->orderby('id','desc')->limit(4)->get();


            $count2=Iniciosesion::where('activo','1')->where('borrado','0')->where('fecha',$fec)->count();


            if($count2==0){
                            $ip=$request->ip();
            $mac= '';
         $newinicio=new Iniciosesion();

             $newinicio->fecha=$fec;
             $newinicio->hora=$hra;
             $newinicio->recordar='0';
             $newinicio->ip=$ip;
             $newinicio->mac=$mac;
             $newinicio->activo='1';
             $newinicio->borrado='0';
             $newinicio->users_id=$iduser;

             $newinicio->save();
            }

            $alerta="";
            $contAlert=0;
            if(accesoUser([2])){
                $alerta=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->get();
                $contAlert=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->count();
            }

            if($idtipouser=="1"){
                return view('inicio.home',compact('tipouser','modulo','docgestion','videoP','preIni','iduser','alerta','contAlert','foros1'));

            }else{


    $anio0=intval(date("Y"));
    $anion=intval(date("Y"));


                $sql = "select d.id as iddep , d.cod_sis as n_dependencia, d.nombre as dependencia, di.nombre as distrito, p.nombre as provincia, de.nombre as departamento ,
                ifnull(e.cant,'0') as cantEstandar, ifnull(m.cant,'0') as cantMetas, d.cod_comparar, d.activo_proc

    from dependencias d
inner join users u on u.dependencia_id=d.id
inner join distritos di on di.id=d.distrito_id
inner join provincias p on p.id=di.provincia_id
inner join departamentos de on de.id=p.departamento_id
left join estandars e on e.dependencia_id=d.id and e.anio='".$anio0."'
left join metas m on m.dependencia_id=d.id and m.anio='".$anion."'
where u.id='".$iduser."';";

$datos=DB::select($sql);




 $persona=DB::table('users')
        ->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
        ->join('personas', 'users.persona_id', '=', 'personas.id')
        ->leftJoin('dependencias', 'users.dependencia_id', '=', 'dependencias.id')
        ->leftJoin('distritos', 'dependencias.distrito_id', '=', 'distritos.id')
        ->leftJoin('provincias', 'distritos.provincia_id', '=', 'provincias.id')
        ->where('users.id',$iduser)
        ->orderBy('tipousers.id')
        ->orderBy('users.id')
        ->orderBy('personas.apellidos')
        ->select('users.id as iduser','users.name as username','users.email','users.token2','users.activo','users.dependencia_id','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.doc', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc','dependencias.id as idDep','dependencias.nombre as dependencia','distritos.id as idDis', 'distritos.nombre as distrito', 'provincias.id as idProv','provincias.nombre as provincia')->get();


        $foros1=Foro::where('borrado','0')->where('activo','1')->orderby('id','desc')->limit(4)->get();
        $foros2=DB::select("select f.id, f.titulo, f.descripcion, f.fecha, f.hora, count(r.id) as msjs
from foros f
left join respforos r on f.id=r.foro_id
order by count(r.id),f.id desc limit 4;");
        $foros3=DB::select("select f.id, f.titulo, f.descripcion, f.fecha, f.hora, count(r.id) as msjs
from foros f
left join respforos r on f.id=r.foro_id
where r.user_id='".Auth::user()->id."'
order by count(r.id),f.id desc limit 4;");
                
                return view('web.index3',compact('tipouser','docgestion','preIni','iduser','alerta','contAlert','datos','persona','foros1','foros2','foros3','funciones'));
            }


            

         }
        else{
            Auth::logout();

          return redirect()->back()
            ->withErrors([
                'email' => 'usuarioActiv'
            ]);
        }
    }


    public function consultahome3(Request $request)
    {

         $iduser=Auth::user()->id;

        $numuser=User::where('id',$iduser)->where('activo','1')->where('borrado','0')->count();
        if($numuser==1){

            $idtipouser=Auth::user()->tipouser_id;
            $tipouser=Tipouser::find($idtipouser);
            $modulo="inicio";

             $docgestion = DocumentoGestion::where('activo','=','1')->get();
            // $docgestion->toarray();
            $preIni = PresentacionInicio::where('activo','=','1')->first();
            $videoP = VideoPresentacion::where('activo','=','1')->first();

            if($videoP==""){
                $videoP= new stdClass();

                $videoP->enlace="";
                $videoP->titulo="";

            }


            $fec=date("Y-m-d");
            $hra=date("H:i:s");


            $count2=Iniciosesion::where('activo','1')->where('borrado','0')->where('fecha',$fec)->count();


            if($count2==0){
                            $ip=$request->ip();
            $mac= '';
         $newinicio=new Iniciosesion();

             $newinicio->fecha=$fec;
             $newinicio->hora=$hra;
             $newinicio->recordar='0';
             $newinicio->ip=$ip;
             $newinicio->mac=$mac;
             $newinicio->activo='1';
             $newinicio->borrado='0';
             $newinicio->users_id=$iduser;

             $newinicio->save();
            }

            $alerta="";
            $contAlert=0;
            if(accesoUser([2])){
                $alerta=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->get();
                $contAlert=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->count();
            }

            if($idtipouser=="1"){

                $foros1=Foro::where('borrado','0')->where('activo','1')->orderby('id','desc')->limit(4)->get();
                return view('inicio.home',compact('tipouser','modulo','docgestion','videoP','preIni','iduser','alerta','contAlert','foros1'));

            }elseif($idtipouser=="3"){

                $foros1=Foro::where('borrado','0')->where('activo','1')->orderby('id','desc')->limit(4)->get();
                $foros2=DB::select("select f.id, f.titulo, f.descripcion, f.fecha, f.hora, count(r.id) as msjs
        from foros f
        left join respforos r on f.id=r.foro_id
        order by count(r.id),f.id desc limit 4;");

        $foros3=DB::select("select f.id, f.titulo, f.descripcion, f.fecha, f.hora, count(r.id) as msjs
from foros f
left join respforos r on f.id=r.foro_id
where r.user_id='".Auth::user()->id."'
order by count(r.id),f.id desc limit 4;");

$persona=DB::table('users')
->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
->join('personas', 'users.persona_id', '=', 'personas.id')
->leftJoin('dependencias', 'users.dependencia_id', '=', 'dependencias.id')
->leftJoin('distritos', 'dependencias.distrito_id', '=', 'distritos.id')
->leftJoin('provincias', 'distritos.provincia_id', '=', 'provincias.id')
->where('users.id',$iduser)
->orderBy('tipousers.id')
->orderBy('users.id')
->orderBy('personas.apellidos')
->select('users.id as iduser','users.name as username','users.email','users.token2','users.activo','users.dependencia_id','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.doc', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc','dependencias.id as idDep','dependencias.nombre as dependencia','distritos.id as idDis', 'distritos.nombre as distrito', 'provincias.id as idProv','provincias.nombre as provincia')->get();

                return view('web2.index4',compact('tipouser','preIni','iduser','foros1','foros2','foros3','docgestion','persona'));
            }else{


    $anio0=intval(date("Y"));
    $anion=intval(date("Y"));


                $sql = "select d.id as iddep , d.cod_sis as n_dependencia, d.nombre as dependencia, di.nombre as distrito, p.nombre as provincia, de.nombre as departamento ,
                ifnull(e.cant,'0') as cantEstandar, ifnull(m.cant,'0') as cantMetas, d.cod_comparar, d.activo_proc

    from dependencias d
inner join users u on u.dependencia_id=d.id
inner join distritos di on di.id=d.distrito_id
inner join provincias p on p.id=di.provincia_id
inner join departamentos de on de.id=p.departamento_id
left join estandars e on e.dependencia_id=d.id and e.anio='".$anio0."'
left join metas m on m.dependencia_id=d.id and m.anio='".$anion."'
where u.id='".$iduser."';";

$datos=DB::select($sql);




 $persona=DB::table('users')
        ->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
        ->join('personas', 'users.persona_id', '=', 'personas.id')
        ->leftJoin('dependencias', 'users.dependencia_id', '=', 'dependencias.id')
        ->leftJoin('distritos', 'dependencias.distrito_id', '=', 'distritos.id')
        ->leftJoin('provincias', 'distritos.provincia_id', '=', 'provincias.id')
        ->where('users.id',$iduser)
        ->orderBy('tipousers.id')
        ->orderBy('users.id')
        ->orderBy('personas.apellidos')
        ->select('users.id as iduser','users.name as username','users.email','users.token2','users.activo','users.dependencia_id','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.doc', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc','dependencias.id as idDep','dependencias.nombre as dependencia','distritos.id as idDis', 'distritos.nombre as distrito', 'provincias.id as idProv','provincias.nombre as provincia')->get();

    $foros1=Foro::where('borrado','0')->where('activo','1')->orderby('id','desc')->limit(4)->get();
    $foros2=DB::select("select f.id, f.titulo, f.descripcion, f.fecha, f.hora, count(r.id) as msjs
from foros f
left join respforos r on f.id=r.foro_id
order by count(r.id),f.id desc limit 4;");
        $foros3=DB::select("select f.id, f.titulo, f.descripcion, f.fecha, f.hora, count(r.id) as msjs
from foros f
left join respforos r on f.id=r.foro_id
where r.user_id='".Auth::user()->id."'
order by count(r.id),f.id desc limit 4;");
                
                return view('web.index4',compact('tipouser','docgestion','preIni','iduser','alerta','contAlert','datos','persona','foros1','foros2','foros3'));
            }


            

         }
        else{
            Auth::logout();

          return redirect()->back()
            ->withErrors([
                'email' => 'usuarioActiv'
            ]);
        }
    }


        public function home3(Request $request)
    {

         $iduser=Auth::user()->id;

        $numuser=User::where('id',$iduser)->where('activo','1')->where('borrado','0')->count();
        if($numuser==1){

            $idtipouser=Auth::user()->tipouser_id;
            $tipouser=Tipouser::find($idtipouser);
            $modulo="inicio";

             $docgestion = DocumentoGestion::where('activo','=','1')->get();
            // $docgestion->toarray();
            $preIni = PresentacionInicio::where('activo','=','1')->first();
            $videoP = VideoPresentacion::where('activo','=','1')->first();

            if($videoP==""){
                $videoP= new stdClass();

                $videoP->enlace="";
                $videoP->titulo="";

            }


            $fec=date("Y-m-d");
            $hra=date("H:i:s");


            $count2=Iniciosesion::where('activo','1')->where('borrado','0')->where('fecha',$fec)->count();


            if($count2==0){
                            $ip=$request->ip();
            $mac= '';
         $newinicio=new Iniciosesion();

             $newinicio->fecha=$fec;
             $newinicio->hora=$hra;
             $newinicio->recordar='0';
             $newinicio->ip=$ip;
             $newinicio->mac=$mac;
             $newinicio->activo='1';
             $newinicio->borrado='0';
             $newinicio->users_id=$iduser;

             $newinicio->save();
            }

            $alerta="";
            $contAlert=0;
            if(accesoUser([2])){
                $alerta=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->get();
                $contAlert=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->count();
            }

            if($idtipouser=="1"){

                $foros1=Foro::where('borrado','0')->where('activo','1')->orderby('id','desc')->limit(4)->get();
                return view('inicio.home',compact('tipouser','modulo','docgestion','videoP','preIni','iduser','alerta','contAlert','foros1'));

            }else{


    $anio0=intval(date("Y"));
    $anion=intval(date("Y"));


                $sql = "select d.id as iddep , d.cod_sis as n_dependencia, d.nombre as dependencia, di.nombre as distrito, p.nombre as provincia, de.nombre as departamento ,
                ifnull(e.cant,'0') as cantEstandar, ifnull(m.cant,'0') as cantMetas, d.cod_comparar, d.activo_proc

    from dependencias d
inner join users u on u.dependencia_id=d.id
inner join distritos di on di.id=d.distrito_id
inner join provincias p on p.id=di.provincia_id
inner join departamentos de on de.id=p.departamento_id
left join estandars e on e.dependencia_id=d.id and e.anio='".$anio0."'
left join metas m on m.dependencia_id=d.id and m.anio='".$anion."'
where u.id='".$iduser."';";

$datos=DB::select($sql);




 $persona=DB::table('users')
        ->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
        ->join('personas', 'users.persona_id', '=', 'personas.id')
        ->leftJoin('dependencias', 'users.dependencia_id', '=', 'dependencias.id')
        ->leftJoin('distritos', 'dependencias.distrito_id', '=', 'distritos.id')
        ->leftJoin('provincias', 'distritos.provincia_id', '=', 'provincias.id')
        ->where('users.id',$iduser)
        ->orderBy('tipousers.id')
        ->orderBy('users.id')
        ->orderBy('personas.apellidos')
        ->select('users.id as iduser','users.name as username','users.email','users.token2','users.activo','users.dependencia_id','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.doc', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc','dependencias.id as idDep','dependencias.nombre as dependencia','distritos.id as idDis', 'distritos.nombre as distrito', 'provincias.id as idProv','provincias.nombre as provincia')->get();

    $foros1=Foro::where('borrado','0')->where('activo','1')->orderby('id','desc')->limit(4)->get();
    $foros2=DB::select("select f.id, f.titulo, f.descripcion, f.fecha, f.hora, count(r.id) as msjs
from foros f
left join respforos r on f.id=r.foro_id
order by count(r.id),f.id desc limit 4;");
        $foros3=DB::select("select f.id, f.titulo, f.descripcion, f.fecha, f.hora, count(r.id) as msjs
from foros f
left join respforos r on f.id=r.foro_id
where r.user_id='".Auth::user()->id."'
order by count(r.id),f.id desc limit 4;");
                
                return view('web.index4',compact('tipouser','docgestion','preIni','iduser','alerta','contAlert','datos','persona','foros1','foros2','foros3'));
            }


            

         }
        else{
            Auth::logout();

          return redirect()->back()
            ->withErrors([
                'email' => 'usuarioActiv'
            ]);
        }
    }

    public function leerAlerta($idAlert){

        $result='1';
        $msj='';
        $selector='';

        $fec=date("Y-m-d");

        $leerMensaje = Alerta::findOrFail($idAlert);
        $leerMensaje->fechaleido=$fec;
        $leerMensaje->estado='2';
        $leerMensaje->save();

        $msj='Alerta Leida y Archivada Exitosamente';

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);

    }



    public function nosotros(){

        $iduser=Auth::user()->id;

        $idtipouser=Auth::user()->tipouser_id;
        $tipouser=Tipouser::find($idtipouser);


        if(accesoUser([2])){

        $docgestion = DocumentoGestion::where('activo','=','1')->get();


    $anio0=intval(date("Y"));
    $anion=intval(date("Y"));


                $sql = "select d.id as iddep , d.cod_sis as n_dependencia, d.nombre as dependencia, di.nombre as distrito, p.nombre as provincia, de.nombre as departamento ,
                ifnull(e.cant,'0') as cantEstandar, ifnull(m.cant,'0') as cantMetas, d.cod_comparar, d.activo_proc

    from dependencias d
inner join users u on u.dependencia_id=d.id
inner join distritos di on di.id=d.distrito_id
inner join provincias p on p.id=di.provincia_id
inner join departamentos de on de.id=p.departamento_id
left join estandars e on e.dependencia_id=d.id and e.anio='".$anio0."'
left join metas m on m.dependencia_id=d.id and m.anio='".$anion."'
where u.id='".$iduser."';";

$datos=DB::select($sql);

 $alerta=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->get();
 $contAlert=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->count();


 $persona=DB::table('users')
        ->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
        ->join('personas', 'users.persona_id', '=', 'personas.id')
        ->leftJoin('dependencias', 'users.dependencia_id', '=', 'dependencias.id')
        ->leftJoin('distritos', 'dependencias.distrito_id', '=', 'distritos.id')
        ->leftJoin('provincias', 'distritos.provincia_id', '=', 'provincias.id')
        ->where('users.id',$iduser)
        ->orderBy('tipousers.id')
        ->orderBy('users.id')
        ->orderBy('personas.apellidos')
        ->select('users.id as iduser','users.name as username','users.email','users.token2','users.activo','users.dependencia_id','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.doc', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc','dependencias.id as idDep','dependencias.nombre as dependencia','distritos.id as idDis', 'distritos.nombre as distrito', 'provincias.id as idProv','provincias.nombre as provincia')->get();
                
                return view('web.nosotros',compact('tipouser','docgestion','iduser','alerta','contAlert','datos','persona'));
            }

    }


    public function consultagaleriaFotos(){

        $iduser=Auth::user()->id;

        $idtipouser=Auth::user()->tipouser_id;
        $tipouser=Tipouser::find($idtipouser);


        if(accesoUser([2])){

        $galeria = Galeria::orderBy('marcador')->get();


    $anio0=intval(date("Y"));
    $anion=intval(date("Y"));


                $sql = "select d.id as iddep , d.cod_sis as n_dependencia, d.nombre as dependencia, di.nombre as distrito, p.nombre as provincia, de.nombre as departamento ,
                ifnull(e.cant,'0') as cantEstandar, ifnull(m.cant,'0') as cantMetas, d.cod_comparar, d.activo_proc

    from dependencias d
inner join users u on u.dependencia_id=d.id
inner join distritos di on di.id=d.distrito_id
inner join provincias p on p.id=di.provincia_id
inner join departamentos de on de.id=p.departamento_id
left join estandars e on e.dependencia_id=d.id and e.anio='".$anio0."'
left join metas m on m.dependencia_id=d.id and m.anio='".$anion."'
where u.id='".$iduser."';";

$datos=DB::select($sql);

 $alerta=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->get();
 $contAlert=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->count();


 $persona=DB::table('users')
        ->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
        ->join('personas', 'users.persona_id', '=', 'personas.id')
        ->leftJoin('dependencias', 'users.dependencia_id', '=', 'dependencias.id')
        ->leftJoin('distritos', 'dependencias.distrito_id', '=', 'distritos.id')
        ->leftJoin('provincias', 'distritos.provincia_id', '=', 'provincias.id')
        ->where('users.id',$iduser)
        ->orderBy('tipousers.id')
        ->orderBy('users.id')
        ->orderBy('personas.apellidos')
        ->select('users.id as iduser','users.name as username','users.email','users.token2','users.activo','users.dependencia_id','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.doc', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc','dependencias.id as idDep','dependencias.nombre as dependencia','distritos.id as idDis', 'distritos.nombre as distrito', 'provincias.id as idProv','provincias.nombre as provincia')->get();
                
                return view('web.galeria',compact('tipouser','galeria','iduser','alerta','contAlert','datos','persona'));
            }

            elseif($idtipouser=="3"){

                $galeria = Galeria::orderBy('marcador')->get();

                $foros1=Foro::where('borrado','0')->where('activo','1')->orderby('id','desc')->limit(4)->get();
                $foros2=DB::select("select f.id, f.titulo, f.descripcion, f.fecha, f.hora, count(r.id) as msjs
        from foros f
        left join respforos r on f.id=r.foro_id
        order by count(r.id),f.id desc limit 4;");

        $foros3=DB::select("select f.id, f.titulo, f.descripcion, f.fecha, f.hora, count(r.id) as msjs
from foros f
left join respforos r on f.id=r.foro_id
where r.user_id='".Auth::user()->id."'
order by count(r.id),f.id desc limit 4;");

$persona=DB::table('users')
->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
->join('personas', 'users.persona_id', '=', 'personas.id')
->leftJoin('dependencias', 'users.dependencia_id', '=', 'dependencias.id')
->leftJoin('distritos', 'dependencias.distrito_id', '=', 'distritos.id')
->leftJoin('provincias', 'distritos.provincia_id', '=', 'provincias.id')
->where('users.id',$iduser)
->orderBy('tipousers.id')
->orderBy('users.id')
->orderBy('personas.apellidos')
->select('users.id as iduser','users.name as username','users.email','users.token2','users.activo','users.dependencia_id','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.doc', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc','dependencias.id as idDep','dependencias.nombre as dependencia','distritos.id as idDis', 'distritos.nombre as distrito', 'provincias.id as idProv','provincias.nombre as provincia')->get();

                return view('web2.galeria',compact('tipouser','preIni','iduser','foros1','foros2','foros3','docgestion','persona','galeria'));
            }


    }


    public function galeria(){

        $iduser=Auth::user()->id;

        $idtipouser=Auth::user()->tipouser_id;
        $tipouser=Tipouser::find($idtipouser);


        if(accesoUser([2])){

        $galeria = Galeria::orderBy('marcador')->get();


    $anio0=intval(date("Y"));
    $anion=intval(date("Y"));


                $sql = "select d.id as iddep , d.cod_sis as n_dependencia, d.nombre as dependencia, di.nombre as distrito, p.nombre as provincia, de.nombre as departamento ,
                ifnull(e.cant,'0') as cantEstandar, ifnull(m.cant,'0') as cantMetas, d.cod_comparar, d.activo_proc

    from dependencias d
inner join users u on u.dependencia_id=d.id
inner join distritos di on di.id=d.distrito_id
inner join provincias p on p.id=di.provincia_id
inner join departamentos de on de.id=p.departamento_id
left join estandars e on e.dependencia_id=d.id and e.anio='".$anio0."'
left join metas m on m.dependencia_id=d.id and m.anio='".$anion."'
where u.id='".$iduser."';";

$datos=DB::select($sql);

 $alerta=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->get();
 $contAlert=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->count();


 $persona=DB::table('users')
        ->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
        ->join('personas', 'users.persona_id', '=', 'personas.id')
        ->leftJoin('dependencias', 'users.dependencia_id', '=', 'dependencias.id')
        ->leftJoin('distritos', 'dependencias.distrito_id', '=', 'distritos.id')
        ->leftJoin('provincias', 'distritos.provincia_id', '=', 'provincias.id')
        ->where('users.id',$iduser)
        ->orderBy('tipousers.id')
        ->orderBy('users.id')
        ->orderBy('personas.apellidos')
        ->select('users.id as iduser','users.name as username','users.email','users.token2','users.activo','users.dependencia_id','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.doc', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc','dependencias.id as idDep','dependencias.nombre as dependencia','distritos.id as idDis', 'distritos.nombre as distrito', 'provincias.id as idProv','provincias.nombre as provincia')->get();
                
                return view('web.galeria',compact('tipouser','galeria','iduser','alerta','contAlert','datos','persona'));
            }

    }

    public function consultacalendar(){

        $iduser=Auth::user()->id;

        $idtipouser=Auth::user()->tipouser_id;
        $tipouser=Tipouser::find($idtipouser);


        if(accesoUser([2])){

        $calendar = Calendario::orderBy('fechaini','desc')->get();


    $anio0=intval(date("Y"));
    $anion=intval(date("Y"));


                $sql = "select d.id as iddep , d.cod_sis as n_dependencia, d.nombre as dependencia, di.nombre as distrito, p.nombre as provincia, de.nombre as departamento ,
                ifnull(e.cant,'0') as cantEstandar, ifnull(m.cant,'0') as cantMetas, d.cod_comparar, d.activo_proc

    from dependencias d
inner join users u on u.dependencia_id=d.id
inner join distritos di on di.id=d.distrito_id
inner join provincias p on p.id=di.provincia_id
inner join departamentos de on de.id=p.departamento_id
left join estandars e on e.dependencia_id=d.id and e.anio='".$anio0."'
left join metas m on m.dependencia_id=d.id and m.anio='".$anion."'
where u.id='".$iduser."';";

$datos=DB::select($sql);

 $alerta=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->get();
 $contAlert=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->count();


 $persona=DB::table('users')
        ->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
        ->join('personas', 'users.persona_id', '=', 'personas.id')
        ->leftJoin('dependencias', 'users.dependencia_id', '=', 'dependencias.id')
        ->leftJoin('distritos', 'dependencias.distrito_id', '=', 'distritos.id')
        ->leftJoin('provincias', 'distritos.provincia_id', '=', 'provincias.id')
        ->where('users.id',$iduser)
        ->orderBy('tipousers.id')
        ->orderBy('users.id')
        ->orderBy('personas.apellidos')
        ->select('users.id as iduser','users.name as username','users.email','users.token2','users.activo','users.dependencia_id','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.doc', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc','dependencias.id as idDep','dependencias.nombre as dependencia','distritos.id as idDis', 'distritos.nombre as distrito', 'provincias.id as idProv','provincias.nombre as provincia')->get();
                
                return view('web.calendario',compact('tipouser','calendar','iduser','alerta','contAlert','datos','persona'));
            }

            elseif($idtipouser=="3"){

                $calendar = Calendario::orderBy('fechaini','desc')->get();

                $foros1=Foro::where('borrado','0')->where('activo','1')->orderby('id','desc')->limit(4)->get();
                $foros2=DB::select("select f.id, f.titulo, f.descripcion, f.fecha, f.hora, count(r.id) as msjs
        from foros f
        left join respforos r on f.id=r.foro_id
        order by count(r.id),f.id desc limit 4;");

        $foros3=DB::select("select f.id, f.titulo, f.descripcion, f.fecha, f.hora, count(r.id) as msjs
from foros f
left join respforos r on f.id=r.foro_id
where r.user_id='".Auth::user()->id."'
order by count(r.id),f.id desc limit 4;");

$persona=DB::table('users')
->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
->join('personas', 'users.persona_id', '=', 'personas.id')
->leftJoin('dependencias', 'users.dependencia_id', '=', 'dependencias.id')
->leftJoin('distritos', 'dependencias.distrito_id', '=', 'distritos.id')
->leftJoin('provincias', 'distritos.provincia_id', '=', 'provincias.id')
->where('users.id',$iduser)
->orderBy('tipousers.id')
->orderBy('users.id')
->orderBy('personas.apellidos')
->select('users.id as iduser','users.name as username','users.email','users.token2','users.activo','users.dependencia_id','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.doc', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc','dependencias.id as idDep','dependencias.nombre as dependencia','distritos.id as idDis', 'distritos.nombre as distrito', 'provincias.id as idProv','provincias.nombre as provincia')->get();

                return view('web2.calendario',compact('tipouser','preIni','iduser','foros1','foros2','foros3','docgestion','persona','calendar'));
            }

    }

    public function calendar(){

        $iduser=Auth::user()->id;

        $idtipouser=Auth::user()->tipouser_id;
        $tipouser=Tipouser::find($idtipouser);


        if(accesoUser([2])){

        $calendar = Calendario::orderBy('fechaini','desc')->get();


    $anio0=intval(date("Y"));
    $anion=intval(date("Y"));


                $sql = "select d.id as iddep , d.cod_sis as n_dependencia, d.nombre as dependencia, di.nombre as distrito, p.nombre as provincia, de.nombre as departamento ,
                ifnull(e.cant,'0') as cantEstandar, ifnull(m.cant,'0') as cantMetas, d.cod_comparar, d.activo_proc

    from dependencias d
inner join users u on u.dependencia_id=d.id
inner join distritos di on di.id=d.distrito_id
inner join provincias p on p.id=di.provincia_id
inner join departamentos de on de.id=p.departamento_id
left join estandars e on e.dependencia_id=d.id and e.anio='".$anio0."'
left join metas m on m.dependencia_id=d.id and m.anio='".$anion."'
where u.id='".$iduser."';";

$datos=DB::select($sql);

 $alerta=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->get();
 $contAlert=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->count();


 $persona=DB::table('users')
        ->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
        ->join('personas', 'users.persona_id', '=', 'personas.id')
        ->leftJoin('dependencias', 'users.dependencia_id', '=', 'dependencias.id')
        ->leftJoin('distritos', 'dependencias.distrito_id', '=', 'distritos.id')
        ->leftJoin('provincias', 'distritos.provincia_id', '=', 'provincias.id')
        ->where('users.id',$iduser)
        ->orderBy('tipousers.id')
        ->orderBy('users.id')
        ->orderBy('personas.apellidos')
        ->select('users.id as iduser','users.name as username','users.email','users.token2','users.activo','users.dependencia_id','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.doc', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc','dependencias.id as idDep','dependencias.nombre as dependencia','distritos.id as idDis', 'distritos.nombre as distrito', 'provincias.id as idProv','provincias.nombre as provincia')->get();
                
                return view('web.calendario',compact('tipouser','calendar','iduser','alerta','contAlert','datos','persona'));
            }

    }


     public function violencia(){

        $iduser=Auth::user()->id;

        $idtipouser=Auth::user()->tipouser_id;
        $tipouser=Tipouser::find($idtipouser);


        if(accesoUser([2])){



    $anio0=intval(date("Y"));
    $anion=intval(date("Y"));


                $sql = "select d.id as iddep , d.cod_sis as n_dependencia, d.nombre as dependencia, di.nombre as distrito, p.nombre as provincia, de.nombre as departamento ,
                ifnull(e.cant,'0') as cantEstandar, ifnull(m.cant,'0') as cantMetas, d.cod_comparar, d.activo_proc

    from dependencias d
inner join users u on u.dependencia_id=d.id
inner join distritos di on di.id=d.distrito_id
inner join provincias p on p.id=di.provincia_id
inner join departamentos de on de.id=p.departamento_id
left join estandars e on e.dependencia_id=d.id and e.anio='".$anio0."'
left join metas m on m.dependencia_id=d.id and m.anio='".$anion."'
where u.id='".$iduser."';";

$datos=DB::select($sql);

 $alerta=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->get();
 $contAlert=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->count();


 $persona=DB::table('users')
        ->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
        ->join('personas', 'users.persona_id', '=', 'personas.id')
        ->leftJoin('dependencias', 'users.dependencia_id', '=', 'dependencias.id')
        ->leftJoin('distritos', 'dependencias.distrito_id', '=', 'distritos.id')
        ->leftJoin('provincias', 'distritos.provincia_id', '=', 'provincias.id')
        ->where('users.id',$iduser)
        ->orderBy('tipousers.id')
        ->orderBy('users.id')
        ->orderBy('personas.apellidos')
        ->select('users.id as iduser','users.name as username','users.email','users.token2','users.activo','users.dependencia_id','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.doc', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc','dependencias.id as idDep','dependencias.nombre as dependencia','distritos.id as idDis', 'distritos.nombre as distrito', 'provincias.id as idProv','provincias.nombre as provincia')->get();

         $anio=Date('Y');
            $mes=Date('m');

            $modulo="procesos";
                
                return view('web.violencia',compact('tipouser','iduser','alerta','contAlert','datos','persona','anio','mes','modulo'));
            }

    }



    public function myaccount(){

        $iduser=Auth::user()->id;

        $idtipouser=Auth::user()->tipouser_id;
        $tipouser=Tipouser::find($idtipouser);


        if(accesoUser([2])){

    $anio0=intval(date("Y"));
    $anion=intval(date("Y"));


$sql = "select d.id as iddep , d.cod_sis as n_dependencia, d.nombre as dependencia, di.nombre as distrito, p.nombre as provincia, de.nombre as departamento ,
                ifnull(e.cant,'0') as cantEstandar, ifnull(m.cant,'0') as cantMetas, d.cod_comparar, d.activo_proc

    from dependencias d
inner join users u on u.dependencia_id=d.id
inner join distritos di on di.id=d.distrito_id
inner join provincias p on p.id=di.provincia_id
inner join departamentos de on de.id=p.departamento_id
left join estandars e on e.dependencia_id=d.id and e.anio='".$anio0."'
left join metas m on m.dependencia_id=d.id and m.anio='".$anion."'
where u.id='".$iduser."';";

$datos=DB::select($sql);

 $alerta=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->get();
 $contAlert=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->count();


 $persona=DB::table('users')
        ->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
        ->join('personas', 'users.persona_id', '=', 'personas.id')
        ->leftJoin('dependencias', 'users.dependencia_id', '=', 'dependencias.id')
        ->leftJoin('distritos', 'dependencias.distrito_id', '=', 'distritos.id')
        ->leftJoin('provincias', 'distritos.provincia_id', '=', 'provincias.id')
        ->where('users.id',$iduser)
        ->orderBy('tipousers.id')
        ->orderBy('users.id')
        ->orderBy('personas.apellidos')
        ->select('users.id as iduser','users.name as username','users.email','users.token2','users.activo','users.dependencia_id','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.doc', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc','dependencias.id as idDep','dependencias.nombre as dependencia','distritos.id as idDis', 'distritos.nombre as distrito', 'provincias.id as idProv','provincias.nombre as provincia')->get();

         $anio=Date('Y');
            $mes=Date('m');

            $modulo="myaccount";
                
                return view('web.myaccount',compact('tipouser','iduser','alerta','contAlert','persona','anio','mes','modulo','datos'));
            }

            elseif($idtipouser=="3"){

                $calendar = Calendario::orderBy('fechaini','desc')->get();

                $foros1=Foro::where('borrado','0')->where('activo','1')->orderby('id','desc')->limit(4)->get();
                $foros2=DB::select("select f.id, f.titulo, f.descripcion, f.fecha, f.hora, count(r.id) as msjs
        from foros f
        left join respforos r on f.id=r.foro_id
        order by count(r.id),f.id desc limit 4;");

        $foros3=DB::select("select f.id, f.titulo, f.descripcion, f.fecha, f.hora, count(r.id) as msjs
from foros f
left join respforos r on f.id=r.foro_id
where r.user_id='".Auth::user()->id."'
order by count(r.id),f.id desc limit 4;");

$persona=DB::table('users')
->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
->join('personas', 'users.persona_id', '=', 'personas.id')
->leftJoin('dependencias', 'users.dependencia_id', '=', 'dependencias.id')
->leftJoin('distritos', 'dependencias.distrito_id', '=', 'distritos.id')
->leftJoin('provincias', 'distritos.provincia_id', '=', 'provincias.id')
->where('users.id',$iduser)
->orderBy('tipousers.id')
->orderBy('users.id')
->orderBy('personas.apellidos')
->select('users.id as iduser','users.name as username','users.email','users.token2','users.activo','users.dependencia_id','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.doc', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc','dependencias.id as idDep','dependencias.nombre as dependencia','distritos.id as idDis', 'distritos.nombre as distrito', 'provincias.id as idProv','provincias.nombre as provincia')->get();

$anio=Date('Y');
            $mes=Date('m');

                return view('web2.myaccount',compact('tipouser','iduser','foros1','foros2','foros3','docgestion','persona','calendar','anio','mes'));
            }

    }


    public function indicador1(){

        $iduser=Auth::user()->id;

        $idtipouser=Auth::user()->tipouser_id;
        $tipouser=Tipouser::find($idtipouser);


        if(accesoUser([2])){



    $anio0=intval(date("Y"));
    $anion=intval(date("Y"));


                $sql = "select d.id as iddep , d.cod_sis as n_dependencia, d.nombre as dependencia, di.nombre as distrito, p.nombre as provincia, de.nombre as departamento ,
                ifnull(e.cant,'0') as cantEstandar, ifnull(m.cant,'0') as cantMetas, d.cod_comparar, d.activo_proc

    from dependencias d
inner join users u on u.dependencia_id=d.id
inner join distritos di on di.id=d.distrito_id
inner join provincias p on p.id=di.provincia_id
inner join departamentos de on de.id=p.departamento_id
left join estandars e on e.dependencia_id=d.id and e.anio='".$anio0."'
left join metas m on m.dependencia_id=d.id and m.anio='".$anion."'
where u.id='".$iduser."';";

$datos=DB::select($sql);

 $alerta=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->get();
 $contAlert=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->count();


 $persona=DB::table('users')
        ->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
        ->join('personas', 'users.persona_id', '=', 'personas.id')
        ->leftJoin('dependencias', 'users.dependencia_id', '=', 'dependencias.id')
        ->leftJoin('distritos', 'dependencias.distrito_id', '=', 'distritos.id')
        ->leftJoin('provincias', 'distritos.provincia_id', '=', 'provincias.id')
        ->where('users.id',$iduser)
        ->orderBy('tipousers.id')
        ->orderBy('users.id')
        ->orderBy('personas.apellidos')
        ->select('users.id as iduser','users.name as username','users.email','users.token2','users.activo','users.dependencia_id','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.doc', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc','dependencias.id as idDep','dependencias.nombre as dependencia','distritos.id as idDis', 'distritos.nombre as distrito', 'provincias.id as idProv','provincias.nombre as provincia')->get();

         $anio=Date('Y');
            $mes=Date('m');

            
                
                return view('web.indicador1',compact('tipouser','iduser','alerta','contAlert','datos','persona','anio','mes','modulo'));
            }

    }

    public function consultaindicador1($iddep){

        $iduser=Auth::user()->id;



        $idtipouser=Auth::user()->tipouser_id;
        $tipouser=Tipouser::find($idtipouser);


        if(accesoUser([3])){



    $anio0=intval(date("Y"));
    $anion=intval(date("Y"));



 $alerta=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->get();
 $contAlert=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->count();


 $persona=DB::table('users')
        ->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
        ->join('personas', 'users.persona_id', '=', 'personas.id')
        ->leftJoin('dependencias', 'users.dependencia_id', '=', 'dependencias.id')
        ->leftJoin('distritos', 'dependencias.distrito_id', '=', 'distritos.id')
        ->leftJoin('provincias', 'distritos.provincia_id', '=', 'provincias.id')
        ->where('users.id',$iduser)
        ->orderBy('tipousers.id')
        ->orderBy('users.id')
        ->orderBy('personas.apellidos')
        ->select('users.id as iduser','users.name as username','users.email','users.token2','users.activo','users.dependencia_id','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.doc', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc','dependencias.id as idDep','dependencias.nombre as dependencia','distritos.id as idDis', 'distritos.nombre as distrito', 'provincias.id as idProv','provincias.nombre as provincia')->get();

         $anio=Date('Y');
            $mes=Date('m');

            
                
                return view('web2.indicador1',compact('tipouser','iduser','alerta','contAlert','iddep','persona','anio','mes','modulo'));
            }

    }

    public function consultaindicador2(){

        $iduser=Auth::user()->id;
        $idtipouser=Auth::user()->tipouser_id;
        $tipouser=Tipouser::find($idtipouser);

        if(accesoUser([3])){

            $anio0=intval(date("Y"));
            $anion=intval(date("Y"));

            $alerta=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->get();
            $contAlert=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->count();
           
           
            $persona=DB::table('users')
                   ->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
                   ->join('personas', 'users.persona_id', '=', 'personas.id')
                   ->leftJoin('dependencias', 'users.dependencia_id', '=', 'dependencias.id')
                   ->leftJoin('distritos', 'dependencias.distrito_id', '=', 'distritos.id')
                   ->leftJoin('provincias', 'distritos.provincia_id', '=', 'provincias.id')
                   ->where('users.id',$iduser)
                   ->orderBy('tipousers.id')
                   ->orderBy('users.id')
                   ->orderBy('personas.apellidos')
                   ->select('users.id as iduser','users.name as username','users.email','users.token2','users.activo','users.dependencia_id','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.doc', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc','dependencias.id as idDep','dependencias.nombre as dependencia','distritos.id as idDis', 'distritos.nombre as distrito', 'provincias.id as idProv','provincias.nombre as provincia')->get();
           
                    $anio=Date('Y');
                       $mes=Date('m');

            return view('web2.indicador2',compact('tipouser','iduser','alerta','contAlert','persona','anio','mes','modulo'));          
        }

    }
    public function indicador2(){

        $iduser=Auth::user()->id;

        $idtipouser=Auth::user()->tipouser_id;
        $tipouser=Tipouser::find($idtipouser);


        if(accesoUser([2])){



    $anio0=intval(date("Y"));
    $anion=intval(date("Y"));


                $sql = "select d.id as iddep , d.cod_sis as n_dependencia, d.nombre as dependencia, di.nombre as distrito, p.nombre as provincia, de.nombre as departamento ,
                ifnull(e.cant,'0') as cantEstandar, ifnull(m.cant,'0') as cantMetas, d.cod_comparar, d.activo_proc

    from dependencias d
inner join users u on u.dependencia_id=d.id
inner join distritos di on di.id=d.distrito_id
inner join provincias p on p.id=di.provincia_id
inner join departamentos de on de.id=p.departamento_id
left join estandars e on e.dependencia_id=d.id and e.anio='".$anio0."'
left join metas m on m.dependencia_id=d.id and m.anio='".$anion."'
where u.id='".$iduser."';";

$datos=DB::select($sql);

 $alerta=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->get();
 $contAlert=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->count();


 $persona=DB::table('users')
        ->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
        ->join('personas', 'users.persona_id', '=', 'personas.id')
        ->leftJoin('dependencias', 'users.dependencia_id', '=', 'dependencias.id')
        ->leftJoin('distritos', 'dependencias.distrito_id', '=', 'distritos.id')
        ->leftJoin('provincias', 'distritos.provincia_id', '=', 'provincias.id')
        ->where('users.id',$iduser)
        ->orderBy('tipousers.id')
        ->orderBy('users.id')
        ->orderBy('personas.apellidos')
        ->select('users.id as iduser','users.name as username','users.email','users.token2','users.activo','users.dependencia_id','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.doc', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc','dependencias.id as idDep','dependencias.nombre as dependencia','distritos.id as idDis', 'distritos.nombre as distrito', 'provincias.id as idProv','provincias.nombre as provincia')->get();

         $anio=Date('Y');
            $mes=Date('m');

            
                
                return view('web.indicador2',compact('tipouser','iduser','alerta','contAlert','datos','persona','anio','mes','modulo'));
            }

    }



    public function indicador3(){

        $iduser=Auth::user()->id;

        $idtipouser=Auth::user()->tipouser_id;
        $tipouser=Tipouser::find($idtipouser);


        if(accesoUser([2])){



    $anio0=intval(date("Y"));
    $anion=intval(date("Y"));


                $sql = "select d.id as iddep , d.cod_sis as n_dependencia, d.nombre as dependencia, di.nombre as distrito, p.nombre as provincia, de.nombre as departamento ,
                ifnull(e.cant,'0') as cantEstandar, ifnull(m.cant,'0') as cantMetas, d.cod_comparar, d.activo_proc

    from dependencias d
inner join users u on u.dependencia_id=d.id
inner join distritos di on di.id=d.distrito_id
inner join provincias p on p.id=di.provincia_id
inner join departamentos de on de.id=p.departamento_id
left join estandars e on e.dependencia_id=d.id and e.anio='".$anio0."'
left join metas m on m.dependencia_id=d.id and m.anio='".$anion."'
where u.id='".$iduser."';";

$datos=DB::select($sql);

 $alerta=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->get();
 $contAlert=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->count();


 $persona=DB::table('users')
        ->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
        ->join('personas', 'users.persona_id', '=', 'personas.id')
        ->leftJoin('dependencias', 'users.dependencia_id', '=', 'dependencias.id')
        ->leftJoin('distritos', 'dependencias.distrito_id', '=', 'distritos.id')
        ->leftJoin('provincias', 'distritos.provincia_id', '=', 'provincias.id')
        ->where('users.id',$iduser)
        ->orderBy('tipousers.id')
        ->orderBy('users.id')
        ->orderBy('personas.apellidos')
        ->select('users.id as iduser','users.name as username','users.email','users.token2','users.activo','users.dependencia_id','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.doc', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc','dependencias.id as idDep','dependencias.nombre as dependencia','distritos.id as idDis', 'distritos.nombre as distrito', 'provincias.id as idProv','provincias.nombre as provincia')->get();

         $anio=Date('Y');
            $mes=Date('m');

            
                
                return view('web.indicador3',compact('tipouser','iduser','alerta','contAlert','datos','persona','anio','mes','modulo'));
            }



            $iduser=Auth::user()->id;
        $idtipouser=Auth::user()->tipouser_id;
        $tipouser=Tipouser::find($idtipouser);

        

    }


    public function consultaindicador3(){

        $iduser=Auth::user()->id;

        $idtipouser=Auth::user()->tipouser_id;
        $tipouser=Tipouser::find($idtipouser);


        if(accesoUser([2])){



    $anio0=intval(date("Y"));
    $anion=intval(date("Y"));


                $sql = "select d.id as iddep , d.cod_sis as n_dependencia, d.nombre as dependencia, di.nombre as distrito, p.nombre as provincia, de.nombre as departamento ,
                ifnull(e.cant,'0') as cantEstandar, ifnull(m.cant,'0') as cantMetas, d.cod_comparar, d.activo_proc

    from dependencias d
inner join users u on u.dependencia_id=d.id
inner join distritos di on di.id=d.distrito_id
inner join provincias p on p.id=di.provincia_id
inner join departamentos de on de.id=p.departamento_id
left join estandars e on e.dependencia_id=d.id and e.anio='".$anio0."'
left join metas m on m.dependencia_id=d.id and m.anio='".$anion."'
where u.id='".$iduser."';";

$datos=DB::select($sql);

 $alerta=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->get();
 $contAlert=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->count();


 $persona=DB::table('users')
        ->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
        ->join('personas', 'users.persona_id', '=', 'personas.id')
        ->leftJoin('dependencias', 'users.dependencia_id', '=', 'dependencias.id')
        ->leftJoin('distritos', 'dependencias.distrito_id', '=', 'distritos.id')
        ->leftJoin('provincias', 'distritos.provincia_id', '=', 'provincias.id')
        ->where('users.id',$iduser)
        ->orderBy('tipousers.id')
        ->orderBy('users.id')
        ->orderBy('personas.apellidos')
        ->select('users.id as iduser','users.name as username','users.email','users.token2','users.activo','users.dependencia_id','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.doc', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc','dependencias.id as idDep','dependencias.nombre as dependencia','distritos.id as idDis', 'distritos.nombre as distrito', 'provincias.id as idProv','provincias.nombre as provincia')->get();

         $anio=Date('Y');
            $mes=Date('m');

            
                
                return view('web.indicador3',compact('tipouser','iduser','alerta','contAlert','datos','persona','anio','mes','modulo'));
            }

            if(accesoUser([3])){

            $anio0=intval(date("Y"));
            $anion=intval(date("Y"));

            $alerta=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->get();
            $contAlert=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->count();
           
           
            $persona=DB::table('users')
                   ->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
                   ->join('personas', 'users.persona_id', '=', 'personas.id')
                   ->leftJoin('dependencias', 'users.dependencia_id', '=', 'dependencias.id')
                   ->leftJoin('distritos', 'dependencias.distrito_id', '=', 'distritos.id')
                   ->leftJoin('provincias', 'distritos.provincia_id', '=', 'provincias.id')
                   ->where('users.id',$iduser)
                   ->orderBy('tipousers.id')
                   ->orderBy('users.id')
                   ->orderBy('personas.apellidos')
                   ->select('users.id as iduser','users.name as username','users.email','users.token2','users.activo','users.dependencia_id','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.doc', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc','dependencias.id as idDep','dependencias.nombre as dependencia','distritos.id as idDis', 'distritos.nombre as distrito', 'provincias.id as idProv','provincias.nombre as provincia')->get();
           
                    $anio=Date('Y');
                       $mes=Date('m');


            $codComparars=DB::select("select if(cod_comparar='','ninguno',cod_comparar) as cod_comparar from dependencias group by cod_comparar;");

            return view('web2.indicador3',compact('tipouser','iduser','alerta','contAlert','persona','anio','mes','modulo','codComparars'));          
        }

    }


    public function indicador4(){

        $iduser=Auth::user()->id;

        $idtipouser=Auth::user()->tipouser_id;
        $tipouser=Tipouser::find($idtipouser);


        if(accesoUser([2])){



    $anio0=intval(date("Y"));
    $anion=intval(date("Y"));


                $sql = "select d.id as iddep , d.cod_sis as n_dependencia, d.nombre as dependencia, di.nombre as distrito, p.nombre as provincia, de.nombre as departamento ,
                ifnull(e.cant,'0') as cantEstandar, ifnull(m.cant,'0') as cantMetas, d.cod_comparar, d.activo_proc

    from dependencias d
inner join users u on u.dependencia_id=d.id
inner join distritos di on di.id=d.distrito_id
inner join provincias p on p.id=di.provincia_id
inner join departamentos de on de.id=p.departamento_id
left join estandars e on e.dependencia_id=d.id and e.anio='".$anio0."'
left join metas m on m.dependencia_id=d.id and m.anio='".$anion."'
where u.id='".$iduser."';";

$datos=DB::select($sql);

 $alerta=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->get();
 $contAlert=Alerta::where('estado','<',2)->where('activo','1')->where('borrado','0')->where('user_id',$iduser)->count();


 $persona=DB::table('users')
        ->join('tipousers', 'users.tipouser_id', '=', 'tipousers.id')
        ->join('personas', 'users.persona_id', '=', 'personas.id')
        ->leftJoin('dependencias', 'users.dependencia_id', '=', 'dependencias.id')
        ->leftJoin('distritos', 'dependencias.distrito_id', '=', 'distritos.id')
        ->leftJoin('provincias', 'distritos.provincia_id', '=', 'provincias.id')
        ->where('users.id',$iduser)
        ->orderBy('tipousers.id')
        ->orderBy('users.id')
        ->orderBy('personas.apellidos')
        ->select('users.id as iduser','users.name as username','users.email','users.token2','users.activo','users.dependencia_id','tipousers.id as idtipo','tipousers.nombre as tipouser','tipousers.descripcion','personas.id as idper', 'personas.doc', 'personas.nombres as nombresPer', 'personas.apellidos as apePer', 'personas.genero', 'personas.telefono', 'personas.direccion', 'personas.tipodoc','dependencias.id as idDep','dependencias.nombre as dependencia','distritos.id as idDis', 'distritos.nombre as distrito', 'provincias.id as idProv','provincias.nombre as provincia')->get();

         $anio=Date('Y');
            $mes=Date('m');

            
                
                return view('web.indicador4',compact('tipouser','iduser','alerta','contAlert','datos','persona','anio','mes','modulo'));
            }

    }





}
