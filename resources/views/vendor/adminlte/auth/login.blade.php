@extends('adminlte::layouts.auth')

@section('htmlheader_title')
   Iniciar Sesión
@endsection

@section('content')

<body id="headerwrap" class="withAnimation">



    <div class="container" >
    <div class="d-flex justify-content-center h-100">
        <div class="col-md-12">
            <div class="col-md-6" style="width: 400px;padding-left: 0px;padding-right: 0px;font-size: 13px;">
                
                @if (count($errors) > 0)

                    <div class="alert alert-danger" style="margin-bottom: 0px;margin-top: 30px;">
                        <div style="text-align: center;">
                            <p style="margin-bottom: 6px;">
                                
                            <strong>Error!</strong> Tenemos algunos Algunos Problemas<br>
                            </p>
                        </div>
                        <ul style="margin-bottom: 0px;">
                            @foreach ($errors->all() as $error)
                            {{-- <li>{{ $error }}</li>  --}}
                            @if($error=="The name field is required.")
                            <li>El campo Usuario es necesario. Debe completarlo</li>
                            @endif

                            @if($error=="The password field is required.")
                            <li>El campo Password es necesario. Debe completarlo</li>
                            @endif

                            @if($error=="These credentials do not match our records.")
                            <li>Usted ha ingresado un nombre de usuario o un password incorrecto. Si no recuerda el usuario y password correcto, resetee su cuenta.</li>
                            @endif

                            @if($error=="usuarioActiv")
                            <li>El usuario del sistema se encuentra desactivado, comuncarse con el administrador del sistema.</li>
                            @endif

                            @if($error=="alumnoSemestre")
                            <li>El semestre al que pertenece el alumno se encuentra cerrado, comuniquese con el administrador del sistema.</li>
                            @endif

                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>



            <div class="card2a" style="text-align: center;margin-top: 50px;border-radius: 3px">
                <img class="" src="{{ asset('/login/images/logofinal.png') }}" style="    padding-top: 7px; width: 398px;">

            </div>
            <hr style="border-top: 1px solid rgba(0, 0, 0, 0);">
            <!-- <br> -->
        <div class="card">

            <div class="card-header" style="padding-left: 25px;padding-right: 25px;border-bottom: 1px solid rgba(255, 255, 255, 0.54);">
                <h3 style="margin-top: 15px;"><font face="Arial">SGD</font></h3>
                <h5 style="margin-top: 15px; color: white;"><font face="Arial">Unidad de Gestión Educativa Local Yungay</font></h5>

                <div class="d-flex justify-content-end social_icon">
                    <!-- <span><i class="glyphicon glyphicon-stats"></i></span> -->
                  {{--   <img style="margin-top: 15px; height:100px;" src="{{ asset('/login/images/logo-yungay.png') }}"> --}}
                    <!-- <span><i class="glyphicon glyphicon-equalizer"></i></span> -->
                </div>
            </div>
            <div class="card-body" style="padding-left: 25px;padding-right: 25px;" id="app" v-cloak>

                <div id="applogin">
                <form action="{{ url('/loginn') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">


                    <div class="form-group row" style="display:none;" id="divmsjsuccess">

                            <span class="help-block text-sucess" role="alert" style="font-size: 15px; background:green;">
                            <label style="color:white;padding: 5px;">@{{msjusercreado}}</strong>
                            </span>
                    
                        </div>


                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Usuario">
                        
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" class="form-control" name="password" placeholder="password">
                    </div>
                    <div class="row align-items-center remember">
                        <input type="checkbox" name="remember">Recuérdame
                    </div>
                    <div class="form-group">

                        <button type="button" class="btn float-right login_btn" style="margin-left:10px;" @click.prevent="registrarse()">Registrarse</button>
                        <input type="submit" value="Ingresar" class="btn float-right login_btn">
                        
                    </div>

                    <div class="form-group" style="width: 100%; padding-top: 40px; float: right;">

                        <a href="#" @click.prevent="olvidoClave()">Olvidó su Contraseña</a>
                        </div>
                </form>
            </div>

                <div id="appregister" style="display:none;" >

                    <form v-on:submit.prevent="create" id="formulariocrear" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-edit"></i></span>
                                </div>
                                <input type="text" name="txtnombres" id="txtnombres" class="form-control" placeholder="Nombres" v-model="newnombres" required >
                        </div>
                

 
                        <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-edit"></i></span>
                                </div>
                                <input type="text" name="txtapellidos" id="txtapellidos" class="form-control" placeholder="Apellidos" v-model="newapellidos" required>
                        </div>
   
                        <div class="input-group form-group" style="width:200px;">
                                <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas     fa-credit-card"></i></span>
                                    </div>
                                    <input type="text" name="txtdni" id="txtdni" class="form-control" placeholder="DNI" v-model="newDNI" required>

                                    
                        </div>
                                
                    

                                <div class="form-group" >
                                        

                                        <select class="form-control" id="cbugenero" name="cbugenero" v-model="newGenero" style="width:200px;">
                                                <option value="0">Género</option>
                                                <option value="1">Masculino</option>
                                                <option value="2">Femenino</option>
                                              </select>
                                    </div>

                                    <div class="input-group form-group" >
                                            <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                                                </div>
                                                <input type="text" name="txtdir" id="txtdir" class="form-control" placeholder="Dirección" v-model="newDirección" >
            
                                                
                                    </div>


                                    <div class="input-group form-group" >
                                            <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                </div>
                                                <input type="text" name="txtuser" id="txtuser" class="form-control" placeholder="Usuario" v-model="newuser" required>
            
                                                
                                    </div>

                                    <div class="input-group form-group" >
                                            <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                                </div>
                      
                                                <input type="password" name="txtclave" id="txtclave" class="form-control" placeholder="Password" v-model="newclave" required>
            
                                                
                                    </div>

                                    <div class="input-group form-group" >
                                            <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                </div>
                                                <input type="email" name="txtemail" id="txtemail" class="form-control" placeholder="Email" v-model="newemail" required>
            
                                                
                                    </div>      

                                    <div class="form-group row">
                                        <div class="col-md-6 col-md-6 offset-md-4">
                                            {!! NoCaptcha::display() !!}
                                        </div>

         
                                        <span class="help-block text-danger" role="alert" style="font-size: 15px;">
                                        <strong style="color:red;">@{{errorcaptcha}}</strong>
                                        </span>
                                
                                    </div>


                                    <div class="form-group">
                                            <button type="button" id="btniniciar" class="btn float-right login_btn" style="margin-left:10px;" @click.prevent="iniciarSesion()">Iniciar Sesión</button>

                                            <button type="submit" id="btncrear" class="btn float-right login_btn" style="margin-left:10px;" >Registrar Datos</button>

                                            
                                            
                                            
                                        </div>


                        <div class="sk-circle" v-show="divloaderNuevo">
                                <div class="sk-circle1 sk-child"></div>
                                <div class="sk-circle2 sk-child"></div>
                                <div class="sk-circle3 sk-child"></div>
                                <div class="sk-circle4 sk-child"></div>
                                <div class="sk-circle5 sk-child"></div>
                                <div class="sk-circle6 sk-child"></div>
                                <div class="sk-circle7 sk-child"></div>
                                <div class="sk-circle8 sk-child"></div>
                                <div class="sk-circle9 sk-child"></div>
                                <div class="sk-circle10 sk-child"></div>
                                <div class="sk-circle11 sk-child"></div>
                                <div class="sk-circle12 sk-child"></div>
                              </div>

                    </form>

                </div>



















                <div id="appnoclave" style="display:none;" >

                        <form v-on:submit.prevent="resetclave" id="formularioresetclave" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

  
                                <div class="form-group row">
         
                                        <span class="help-block text-danger" role="alert" style="font-size: 15px;">
                                        <strong style="color:red;">Complete su N° de DNI y el correo con el que registró su Cuenta para enviarle un Nuevo Password a su Email</strong>
                                        </span>
                                
                                    </div>


                            <div class="input-group form-group" style="width:200px;">
                                    <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas     fa-credit-card"></i></span>
                                        </div>
                                        <input type="text" name="txtdniE" id="txtdniE" class="form-control" placeholder="DNI" v-model="newDNI" required>
    
                                        
                            </div>

    
                                        <div class="input-group form-group" >
                                                <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                    </div>
                                                    <input type="email" name="txtemailE" id="txtemailE" class="form-control" placeholder="Email" v-model="newemail" required>
                
                                                    
                                        </div>      
    
                                        <div class="form-group row">
                                            <div class="col-md-6 col-md-6 offset-md-4">
                                                {!! NoCaptcha::display() !!}
                                            </div>
    
             
                                            <span class="help-block text-danger" role="alert" style="font-size: 15px;">
                                            <strong style="color:red;">@{{errorcaptcha}}</strong>
                                            </span>
                                    
                                        </div>
    
    
                                        <div class="form-group">
                                                <button type="button" id="btniniciarE" class="btn float-right login_btn" style="margin-left:10px;" @click.prevent="iniciarSesion()">Volver</button>
    
                                                <button type="submit" id="btncrearE" class="btn float-right login_btn" style="margin-left:10px;" >Resetear Password</button>
    
                                                
                                                
                                                
                                            </div>
    
    
                            <div class="sk-circle" v-show="divloaderNuevo">
                                    <div class="sk-circle1 sk-child"></div>
                                    <div class="sk-circle2 sk-child"></div>
                                    <div class="sk-circle3 sk-child"></div>
                                    <div class="sk-circle4 sk-child"></div>
                                    <div class="sk-circle5 sk-child"></div>
                                    <div class="sk-circle6 sk-child"></div>
                                    <div class="sk-circle7 sk-child"></div>
                                    <div class="sk-circle8 sk-child"></div>
                                    <div class="sk-circle9 sk-child"></div>
                                    <div class="sk-circle10 sk-child"></div>
                                    <div class="sk-circle11 sk-child"></div>
                                    <div class="sk-circle12 sk-child"></div>
                                  </div>
    
                        </form>
    
                    </div>

                

            </div>
            <div class="card-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.54);">
                <div class="d-flex center-content-center links" style="text-align: center;font-style: oblique;">
                    <font size="5" face="Monotype Corsiva" style="color: #eee">"Sistema de Gestión Documental -SGD Ugel Yungay"</font>
                </div>
                
            </div>
        </div>
        
        </div>

    </div>
    </div>

    @include('vendor.adminlte.layouts.partials.scripts_auth2')





</body>

<script type="text/javascript">
    const app = new Vue({
        el: '#app',
        data:{



            divloader0:true,
            divloader1:false,
            divloader2:false,
            divloader3:false,
            divloader4:false,
            divloader5:false,
            divloader6:false,
            divloader7:false,
            divloader8:false,
            divloader9:false,
            divloader10:false,

            newnombres:'',
            newapellidos:'',
            newDNI:'',
            newGenero:0,
            newDirección:'',

            newuser:'',
            newclave:'',
            newemail:'',

            errorcaptcha:'',
            msjusercreado:'',

            divloaderNuevo:false,

            divregistrar:true,
            divolvidoclave:false,

        },

        created:function () {
        //this.getFormaRecepcion(this.thispage);
        },
        mounted: function () {
        this.divloader0=false;
        },
        computed:{
        },

        methods: {
            registrarse:function () {

            this.divolvidoclave=false,
            this.$nextTick(function () {
                    this.divregistrar=true;
                    this.$nextTick(function () {
                $("#applogin").hide('fast');
                $("#appnoclave").hide('fast');
                $("#appregister").show('slow');

                $("#txtnombres").focus();
                 })
                 })
   
            },

            iniciarSesion:function () {
                
                $("#appregister").hide('fast');
                $("#appnoclave").hide('fast');
                $("#applogin").show('slow');

                $("#name").focus();
            },

            olvidoClave:function () {

                this.divregistrar=false,
                this.$nextTick(function () {
                    this.divolvidoclave=true;
                $("#applogin").hide('fast');
                $("#appregister").hide('fast');

                this.$nextTick(function () {
                $("#appnoclave").show('slow');

                $("#txtdniE").focus();
                 })
                 })


    
            },

            resetclave:function () {
                var url='resetclave';
       $("#btncrearE").attr('disabled', true);
       $("#btniniciarE").attr('disabled', true);
       
       this.divloaderNuevo=true;
       axios.post(url,$("#formularioresetclave").serialize()).then(response=>{
           //console.log(response.data);

           $("#btncrearE").removeAttr("disabled");
           $("#btniniciarE").removeAttr("disabled");

           this.divloaderNuevo=false;

           //console.log(response.data.result);

           if(String(response.data.result)=='1'){
             /*   this.getFormaRecepcion(this.thispage);
               this.errors=[];
               this.cerrarForm(); */
              // toastr.success(response.data.msj);

              $("#formularioresetclave").trigger("reset");
              $("#divmsjsuccess").show();
              grecaptcha.reset();
              app.errorcaptcha='';


              this.iniciarSesion();
              app.msjusercreado=response.data.msj;
           }else{

            $("#divmsjsuccess").hide();

            if(String(response.data.result)=='2'){

                app.errorcaptcha=response.data.msj;
                app.msjusercreado='';
              // toastr.success(response.data.msj);
           }
           else{

               $('#'+response.data.selector).focus();
              // toastr.error(response.data.msj);
              grecaptcha.reset();
              app.errorcaptcha=response.data.msj;
              app.msjusercreado='';
           }
           }
       }).catch(error=>{
           //this.errors=error.response.data
       })

            },

            create:function () {
       var url='crearusuario';
       $("#btncrear").attr('disabled', true);
       $("#btniniciar").attr('disabled', true);
       
       this.divloaderNuevo=true;
       axios.post(url,$("#formulariocrear").serialize()).then(response=>{
           //console.log(response.data);

           $("#btncrear").removeAttr("disabled");
           $("#btniniciar").removeAttr("disabled");

           this.divloaderNuevo=false;

           //console.log(response.data.result);

           if(String(response.data.result)=='1'){
             /*   this.getFormaRecepcion(this.thispage);
               this.errors=[];
               this.cerrarForm(); */
              // toastr.success(response.data.msj);

              $("#formulariocrear").trigger("reset");
              $("#divmsjsuccess").show();
              grecaptcha.reset();
              app.errorcaptcha='';


              this.iniciarSesion();
              app.msjusercreado=response.data.msj;
           }else{

            $("#divmsjsuccess").hide();

            if(String(response.data.result)=='2'){

                app.errorcaptcha=response.data.msj;
                app.msjusercreado='';
              // toastr.success(response.data.msj);
           }
           else{

               $('#'+response.data.selector).focus();
              // toastr.error(response.data.msj);
              grecaptcha.reset();
              app.errorcaptcha=response.data.msj;
              app.msjusercreado='';
           }
           }
       }).catch(error=>{
           //this.errors=error.response.data
       })
   },


        },
        
    });

</script>

@endsection


