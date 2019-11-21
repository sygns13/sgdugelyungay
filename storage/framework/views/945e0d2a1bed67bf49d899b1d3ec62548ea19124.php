<?php $__env->startSection('htmlheader_title'); ?>
   Iniciar Sesión
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<body id="headerwrap" class="withAnimation">



    <div class="container" >
    <div class="d-flex justify-content-center h-100">
        <div class="col-md-12">
            <div class="col-md-6" style="width: 400px;padding-left: 0px;padding-right: 0px;font-size: 13px;">
                
                <?php if(count($errors) > 0): ?>

                    <div class="alert alert-danger" style="margin-bottom: 0px;margin-top: 30px;">
                        <div style="text-align: center;">
                            <p style="margin-bottom: 6px;">
                                
                            <strong>Error!</strong> Tenemos algunos Algunos Problemas<br>
                            </p>
                        </div>
                        <ul style="margin-bottom: 0px;">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                            <?php if($error=="The name field is required."): ?>
                            <li>El campo Usuario es necesario. Debe completarlo</li>
                            <?php endif; ?>

                            <?php if($error=="The password field is required."): ?>
                            <li>El campo Password es necesario. Debe completarlo</li>
                            <?php endif; ?>

                            <?php if($error=="These credentials do not match our records."): ?>
                            <li>Usted ha ingresado un nombre de usuario o un password incorrecto. Si no recuerda el usuario y password correcto, resetee su cuenta.</li>
                            <?php endif; ?>

                            <?php if($error=="usuarioActiv"): ?>
                            <li>El usuario del sistema se encuentra desactivado, comuncarse con el administrador del sistema.</li>
                            <?php endif; ?>

                            <?php if($error=="alumnoSemestre"): ?>
                            <li>El semestre al que pertenece el alumno se encuentra cerrado, comuniquese con el administrador del sistema.</li>
                            <?php endif; ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>



            <div class="card2a" style="text-align: center;margin-top: 50px;border-radius: 3px">
                <img class="" src="<?php echo e(asset('/login/images/logofinal.png')); ?>" style="    padding-top: 7px; width: 398px;">

            </div>
            <hr style="border-top: 1px solid rgba(0, 0, 0, 0);">
            <!-- <br> -->
        <div class="card">

            <div class="card-header" style="padding-left: 25px;padding-right: 25px;border-bottom: 1px solid rgba(255, 255, 255, 0.54);">
                <h3 style="margin-top: 15px;"><font face="Arial">SGD</font></h3>
                <h5 style="margin-top: 15px; color: white;"><font face="Arial">Unidad de Gestión Educativa Local Yungay</font></h5>

                <div class="d-flex justify-content-end social_icon">
                    <!-- <span><i class="glyphicon glyphicon-stats"></i></span> -->
                  
                    <!-- <span><i class="glyphicon glyphicon-equalizer"></i></span> -->
                </div>
            </div>
            <div class="card-body" style="padding-left: 25px;padding-right: 25px;" id="app" v-cloak>

                <div id="applogin">
                <form action="<?php echo e(url('/loginn')); ?>" method="post">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">


                    <div class="form-group row" style="display:none;" id="divmsjsuccess">

                            <span class="help-block text-sucess" role="alert" style="font-size: 15px; background:green;">
                            <label style="color:white;padding: 5px;">{{msjusercreado}}</strong>
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

                        <button type="button" class="btn float-right btn-warning" style="margin-left:10px; color:white;" @click.prevent="registrarse()">Registrarse</button>
                        <input type="submit" value="Ingresar" class="btn float-right login_btn">
                        
                    </div>

                    <div class="form-group" style="width: 100%; padding-top: 40px; float: right;">

                        <a href="#" @click.prevent="olvidoClave()">Olvidó su Contraseña</a>
                        </div>
                </form>
            </div>
























                <div id="appregister" style="display:none;" >


    

                    <form v-on:submit.prevent="create" id="formulariocrear" method="post">
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">






                        <div class="input-group form-group" >
                                <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                                    </div>
                        <input type="text" name="txtdni" id="txtdni" class="form-control" placeholder="DNI" v-model="newDNI" required maxlength="8" onkeypress="return soloNumeros(event);" @keyup="$event.keyCode === 13 ? ValidarDNI() : false">

                        <button type="button" id="btnValidar" class="btn float-right btn-info" style="margin-left:10px;" @click.prevent="ValidarDNI">Validar</button>        
                        </div>



        <div class="sk-circle" v-show="divloaderNuevo3">
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










                        <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-edit"></i></span>
                                </div>
                                <input type="text" name="txtnombres" id="txtnombres" class="form-control" placeholder="Nombres" v-model="newnombres"  readonly >
                        </div>
                

 
                        <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-edit"></i></span>
                                </div>
                                <input type="text" name="txtapellidos" id="txtapellidos" class="form-control" placeholder="Apellidos" v-model="newapellidos"  readonly>
                        </div>
   

                    

                                <div class="form-group" >
                                        

                                        <select class="form-control" id="cbugenero" name="cbugenero" v-model="newGenero" style="width:200px; display:none;">
                                                <option value="0">Género</option>
                                                <option value="1">Masculino</option>
                                                <option value="2">Femenino</option>
                                              </select>
                                    </div>

                                    <div class="input-group form-group" style="padding-top:50px;">
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
                                            <?php echo NoCaptcha::display(); ?>

                                        </div>

         
                                        <span class="help-block text-danger" role="alert" style="font-size: 15px;">
                                        <strong style="color:red;">{{errorcaptcha}}</strong>
                                        </span>
                                
                                    </div>


                                    <div class="form-group">
                                            <button type="button" id="btniniciar" class="btn float-right btn-danger" style="margin-left:10px; color:white;" @click.prevent="iniciarSesion()">Volver Atrás</button>

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
                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

  
                                <div class="form-group row">
         
                                        <span class="help-block text-danger" role="alert" style="font-size: 15px;">
                                        <strong style="color:#20a6f6;">Complete su N° de DNI y el correo con el que registró su Cuenta para enviarle un Nuevo Password a su Email</strong>
                                        </span>
                                
                                    </div>


                            <div class="input-group form-group" style="width:200px;">
                                    <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas     fa-credit-card"></i></span>
                                        </div>
                                        <input type="text" name="txtdniE" id="txtdniE" class="form-control" placeholder="DNI" v-model="newDNI" maxlength="8" required>
    
                                        
                            </div>

    
                                        <div class="input-group form-group" >
                                                <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                    </div>
                                                    <input type="email" name="txtemailE" id="txtemailE" class="form-control" placeholder="Email" v-model="newemail" required>
                
                                                    
                                        </div>      
    
                                        <div class="form-group row">
                                            <div class="col-md-6 col-md-6 offset-md-4">
                                                    <div id="example2"></div>
                                            </div>
    
             
                                            <span class="help-block text-danger" role="alert" style="font-size: 15px;">
                                            <strong style="color:red;">{{errorcaptcha}}</strong>
                                            </span>
                                    
                                        </div>
    
    
                                        <div class="form-group">
                                                <button type="button" id="btniniciarE" class="btn float-right btn-danger" style="margin-left:10px; color:white;" @click.prevent="iniciarSesion()">Volver Atrás</button>
    
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

    <?php echo $__env->make('vendor.adminlte.layouts.partials.scripts_auth2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>


</body>
<script type="text/javascript">

function soloNumeros(e){
  var key = window.Event ? e.which : e.keyCode
  return ((key >= 48 && key <= 57) || (key==8) || (key==35) || (key==34) || (key==46));
}


var verifyCallback = function(response) {
        alert(response);
      };

      var widgetId2;

var onloadCallback = function() {

    widgetId2 = grecaptcha.render(document.getElementById('example2'), {
          'sitekey' : '6Lc6iK0UAAAAAAleCv5QiRu23dfy5Ny1qEVYtvya'
        });

};


  </script>


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


            divloaderNuevo3:false,

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


            ValidarDNIPRUEBA:function(){
            let nombreCompleto="CHAVEZ TORRES CRISTIAN FERNANDO";

            console.log(nombreCompleto);
            let separador = " ";

            let arreglo=nombreCompleto.split(separador);

            let nombrePoner="";
            let apellidoPoner="";

            arreglo.forEach( function(valor, indice, array) {
                if(indice<2){
                    apellidoPoner+=valor+" ";
                }
                else{
                    nombrePoner+=valor+" ";
                }
            });

            this.newnombres=nombrePoner;
            this.newapellidos=apellidoPoner;
        },

            


            ValidarDNI:function(){

                this.newnombres='';
                this.newapellidos='';

                if(String(this.newDNI).length!=8)
                {
                    alertify
                    .alert('Error de DNI',"Complete adecuadamente su DNI: 08 Caracteres", function(){
                        //alertify.message('OK');
                        //$("#txtdni").focus();
                    });
                }
                else
                {
                    var url='principal/consultadni';
                   // var url='https://api.migoperu.pe/api/v1/dni';
                    //var url='https://dniruc.apisperu.com/api/v1/dni/'+this.newDNI+'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImNyaXN0aWFuXzdfNzBAaG90bWFpbC5jb20ifQ.tsIAAU8PPZNMnqf9uu79GF5kfERpoDhwLMpynkOVF-Y';
       $("#btncrearE").attr('disabled', true);
       $("#btniniciarE").attr('disabled', true);
       $("#txtdni").attr('disabled', true);
       $("#btnValidar").attr('disabled', true);
       
       this.divloaderNuevo3=true;
       axios.post(url,{ dni:this.newDNI }).then(response=>{
       //axios.get(url).then(response=>{
           //console.log(response.data);

           $("#btncrearE").removeAttr("disabled");
           $("#btniniciarE").removeAttr("disabled");
           $("#txtdni").removeAttr("disabled");
           $("#btnValidar").removeAttr("disabled");

           this.divloaderNuevo3=false;

          // this.newnombres=response.data.nombres;
           // this.newapellidos=response.data.apellidoPaterno+' '+response.data.apellidoMaterno;

           if(String(response.data.res)=="0"){

            alertify.success('DNI Válido, continúe ingresando los datos');

            /*  let nombreCompleto=response.data.nombre;

            let separador = " ";

            let arreglo=nombreCompleto.split(separador);

            let nombrePoner="";
            let apellidoPoner="";

            arreglo.forEach( function(valor, indice, array) {
                if(indice<2){
                    apellidoPoner+=valor+" ";
                }
                else{
                    nombrePoner+=valor+" ";
                }
            });  */

            this.newnombres=response.data.consulta.nombres;
            this.newapellidos=response.data.consulta.apellidoPaterno+' '+response.data.consulta.apellidoMaterno;

            $("#txtdir").focus();

           }
           else {

            alertify.error('DNI No válido, no correspodne a ninguna persona');
            $("#txtdni").focus();
           } 
       }).catch(error=>{
           console.log(error);

           $("#btncrearE").removeAttr("disabled");
           $("#btniniciarE").removeAttr("disabled");
           $("#txtdni").removeAttr("disabled");
           $("#btnValidar").removeAttr("disabled");

           this.divloaderNuevo3=false;

        alertify.error('DNI No válido, no correspodne a ninguna persona');
            $("#txtdni").focus();
           //this.errors=error.response.data
       })
                }

            },

            registrarse:function () {


            this.newnombres='';
            this.newapellidos='';
            this.newDNI='';
            this.newGenero=0;
            this.newDirección='';

            this.newuser='';
            this.newclave='';
            this.newemail='';

                this.errorcaptcha='';

            this.divolvidoclave=false,
            this.$nextTick(function () {
                    this.divregistrar=true;
                    this.$nextTick(function () {
                $("#applogin").hide('fast');
                $("#appnoclave").hide('fast');
                $("#appregister").show('slow');

                $("#txtdni").focus();
                 })
                 })
   
            },

            iniciarSesion:function () {


                this.msjusercreado='',
                
                $("#appregister").hide('fast');
                $("#appnoclave").hide('fast');
                $("#applogin").show('slow');

                $("#name").focus();
            },

            olvidoClave:function () {


                this.newnombres='';
            this.newapellidos='';
            this.newDNI='';
            this.newGenero=0;
            this.newDirección='';

            this.newuser='';
            this.newclave='';
            this.newemail='';

                this.errorcaptcha='';

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
              javascript:grecaptcha.reset(widgetId2);
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
              javascript:grecaptcha.reset(widgetId2);
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

<?php $__env->stopSection(); ?>



<?php echo $__env->make('adminlte::layouts.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>