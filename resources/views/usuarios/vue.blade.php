<script type="text/javascript">
         let app = new Vue({
    el: '#app',
    data:{
        tipouserPerfil:'{{ $tipouser->nombre }}',
        userPerfil:'{{ Auth::user()->name }}',
        mailPerfil:'{{ Auth::user()->email }}',


        titulo:"Usuarios",
        subtitulo:"Gestión",
        subtitle2:false,
        subtitulo2:"",
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
        divtitulo:true,
        classTitle:'fa fa-user-secret',
        classMenu0:'',
        classMenu1:'',
        classMenu2:'',
        classMenu3:'',
        classMenu4:'',
        classMenu5:'active',
        classMenu6:'',
        classMenu7:'',
        classMenu8:'',
        classMenu9:'',
        classMenu10:'',
        classMenu11:'',
        classMenu12:'',

        divusuario:false,

        usuarios: [],
        tipousers: [],
        persona:[],
        user:[],
        errors:[],
        fillPersona:{'id':'', 'dni':'', 'nombres':'', 'apellidos':'', 'genero':'', 'telf':'', 'direccion':'', 'imagen':'', 'tipodocu':'1'},

        filluser:{'id':'', 'name':'', 'email':'', 'password':'', 'tipouser_id':'', 'activo':'', 'token2':'','dependencia_id':''},

        pagination: {
        'total': 0,
                'current_page': 0,
                'per_page': 0,
                'last_page': 0,
                'from': 0,
                'to': 0
                },
                offset: 9,

        buscar:'',
        divNuevoUsuario:false,
        divEditUsuario:false,

        newDNI:'',
        newNombres:'',
        newApellidos:'',
        newGenero:'1',
        newTelefono:'',
        newDireccion:'',

        newTipoDocu:'1',

        newTipoUser:'',
        newEstado:'1',
        oldImagen:'',

        newUsername:'',
        newEmail:'',
        newPassword:'',


        divloaderNuevo:false,

        divloaderEdit:false,

        divloaderEditUsuario:false,
 

        formularioCrear:false,
        mostrarPalenIni:false,

        validated:'0',
        imagen : null,

        idPersona:'0',
        idUser:'0',
        tipoUser:'',

        thispage:'1',


        newProvincia:'',

        prov:'',
        dist:'',
        dept:'',


        dependencias: [],
        provincias: [],
        distritos: [],

        dependenciasE: [],
        provinciasE: [],
        distritosE: [],

         idProv1:'',
        idDis1:'',
        newDependencia:'',

        idProv1E:'',
        idDis1E:'',

        idProv1Backup:'',



    },
    created:function () {
        this.getUsuarios(this.thispage);
    },
    mounted: function () {
        //this.divloader0=false;

        this.mostrarPalenIni=true;
 
    },
    computed:{
        isActived: function(){
            return this.pagination.current_page;
        },
        pagesNumber: function () {
            if(!this.pagination.to){
                return [];
            }

            var from=this.pagination.current_page - this.offset 
            var from2=this.pagination.current_page - this.offset 
            if(from<1){
                from=1;
            }

            var to= from2 + (this.offset*2); 
            if(to>=this.pagination.last_page){
                to=this.pagination.last_page;
            }

            var pagesArray = [];
            while(from<=to){
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },

    methods: {
        getUsuarios: function (page) {
            var busca=this.buscar;
            var urlUsuarios = 'usuario?page='+page+'&busca='+busca;

            axios.get(urlUsuarios).then(response=>{

                this.usuarios= response.data.usuarios.data;
                this.tipousers= response.data.tipousers;
                this.pagination= response.data.pagination;
                this.mostrarPalenIni=true;


                this.dependencias= response.data.dependencias;
                this.provincias= response.data.provincias;
                this.distritos= response.data.distritos;

                this.dependenciasE= response.data.dependencias;
                this.provinciasE= response.data.provincias;
                this.distritosE= response.data.distritos;

                this.idProv1=response.data.idP1;
                this.idProv1Backup=response.data.idP1;
                this.idDis1=response.data.idD1;
                this.newDependencia='';

                this.idProv1E=response.data.idP1;
                this.idDis1E=response.data.idD1;


                this.$nextTick(function () { 
                        this.changeDis2(response.data.idP1,response.data.idD1,'1');
                        this.idProv1E=response.data.idP1;
                        this.idDis1E=response.data.idD1;
                        this.divusuario=true;
                        this.divloader0=false;

                    });





                if(this.usuarios.length==0 && this.thispage!='1'){
                    var a = parseInt(this.thispage) ;
                    a--;
                    this.thispage=a.toString();
                    this.changePage(this.thispage);
                }
            })
        },
        changePage:function (page) {
            this.pagination.current_page=page;
            this.getUsuarios(page);
            this.thispage=page;
        },
        buscarBtn: function () {
            this.getUsuarios();
            this.thispage='1';
        },
        nuevoUsuario:function () {
            this.divNuevoUsuario=true;
            this.divloaderEditUsuario=false;

            this.$nextTick(function () {
            this.cancelFormUsuario();
          })
            
        },
        cerrarFormUsuario: function () {
            this.divNuevoUsuario=false;
            this.cancelFormUsuario();
        },
        cancelFormUsuario: function () {
            this.validated='0';
            this.$nextTick(function () {
            $('#txtDNI').focus();
            })
            this.newDNI='';
            this.newNombres='';
            this.newApellidos='';
            this.newGenero='1';
            this.newTelefono='';
            this.newDireccion='';
            this.newTipoDocu='1';

            this.newUsername='';
            this.newEmail='';
            this.newPassword='';
            this.formularioCrear=false;
            this.imagen=null;
            this.idPersona='0';
            this.persona=[];
            this.idUser='0';
            this.user=[];

            this.oldImagen='';

            this.newTipoUser='';
            this.newEstado='1';
            this.divEditUsuario=false;

            this.newProvincia='';

            this.idProv1=this.idProv1Backup;
            this.$nextTick(function () {
                this.changeDis();
            })


        },
        pressNuevoDNI: function (dni) {

            if(dni.length!=8){
                alertify.error('Complete los 08 dígitos correspondientes del DNI');
            }
            else{



                var url = 'usuario/verpersona/'+dni;
                var auximg="";
                axios.get(url).then(response=>{

                this.idUser=response.data.idUser;
                
                if(this.idUser=="0")
                    {

                this.idPersona=response.data.id;
                this.persona=response.data.persona;



                if(this.idPersona!='0'){
                    //toastr.success("te encontre");
                    //console.log(this.persona);
                    $.each(this.persona, function( index, dato ) {
                     //console.log(dato.nombres);

                        app.newDNI=dato.dni;
                        app.newNombres=dato.nombres;
                        app.newApellidos=dato.apellidos;
                        app.newGenero=dato.genero;
                        app.newTelefono=dato.telefono;
                        app.newDireccion=dato.direccion;

                   // console.log(dato.imagen);

                    

    

                        if(dato.imagen!=null && dato.imagen.length>0)
                        {
                            auximg=dato.imagen;
                            app.oldImagen=dato.imagen;
                            
                        }
                        


                    });


                  this.$nextTick(function () {
                        this.formularioCrear=true;
                        this.$nextTick(function () {

                           /* if(auximg.length>0){
                                $("#ImgPerfilNuevo").attr("src","{{ asset('/img/perfil/')}}"+"/"+auximg);
                            }*/
        
                             this.validated='1';
                             $('#txtnombres').focus();

                            })
                            })

                }else{


                    this.formularioCrear=true;
                this.$nextTick(function () {
                     this.validated='1';
                     $('#txtnombres').focus();

                })
                }


                }
                else{
                     swal({
                      title: 'Usuario Registrado',
                      text: 'Ya se encuentra registrado el usuario con el DNI: '+dni,
                      type: 'info',
                      confirmButtonText: 'Aceptar'
                    });

                     this.cancelFormUsuario();
                }

                });

            
                
               
            }
            

        },
       /* getImage(event){
                //Asignamos la imagen a  nuestra data

                if (!event.target.files.length)
                {
                  this.imagen=null;
                }
                else{
                this.imagen = event.target.files[0];
                }
            },*/
        createUsuario:function () {
            var url='usuario';

            $("#btnGuardar").attr('disabled', true);
            $("#btnCancel").attr('disabled', true);
            $("#btnClose").attr('disabled', true);

            this.divloaderNuevo=true;


            var data = new  FormData();

            data.append('idPersona', this.idPersona);
            data.append('idUser', this.idUser);
            data.append('newDNI', this.newDNI);
            data.append('newNombres', this.newNombres);
            data.append('newApellidos', this.newApellidos);
            data.append('newGenero', this.newGenero);
            data.append('newTelefono', this.newTelefono);
            data.append('newDireccion', this.newDireccion);
            data.append('imagen', this.imagen);
            data.append('newTipoDocu', this.newTipoDocu);

            data.append('newUsername', this.newUsername);
            data.append('newEmail', this.newEmail);
            data.append('newPassword', this.newPassword);
            data.append('oldImagen', this.oldImagen);

            data.append('newEstado', this.newEstado);
            data.append('newTipoUser', this.newTipoUser);
            data.append('newDependencia', this.newDependencia);

            
            const config = { headers: { 'Content-Type': 'multipart/form-data' } };


            axios.post(url,data,config).then(response=>{

                $("#btnGuardar").removeAttr("disabled");
                $("#btnCancel").removeAttr("disabled");
                $("#btnClose").removeAttr("disabled");
                this.divloaderNuevo=false;

                if(response.data.result=='1'){
                    this.getUsuarios(this.thispage);
                    this.errors=[];
                    this.cerrarFormUsuario();
                    toastr.success(response.data.msj);
                }else{
                    $('#'+response.data.selector).focus();
                    toastr.error(response.data.msj);
                }
            }).catch(error=>{
                this.errors=error.response.data
            })
        },
        borrarUsuario:function (usuario) {
              swal({
                  title: '¿Estás seguro?',
                  text: "¿Desea eliminar el usuario seleccionado? -- Nota: Este proceso no se podrá revertir",
                  type: 'info',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si, eliminar'
                }).then(function () {

                            var url = 'usuario/'+usuario.iduser;
                            axios.delete(url).then(response=>{//eliminamos

                            if(response.data.result=='1'){
                                app.getUsuarios(app.thispage);//listamos
                                toastr.success(response.data.msj);//mostramos mensaje
                            }else{
                               // $('#'+response.data.selector).focus();
                                toastr.error(response.data.msj);
                            }
                            });
                        
                    }).catch(swal.noop);
        },
       /* getImageE(event){
                //Asignamos la imagen a  nuestra data

                if (!event.target.files.length)
                {
                  this.imagen=null;
                }
                else{
                this.imagen = event.target.files[0];
                }
            },*/
        editUsuario:function (usuario) {


if(String(usuario.dependencia_id)!='null'){
            this.changeDis2(usuario.idProv,usuario.idDis,usuario.idDep);

                    this.$nextTick(function () {

            this.fillPersona.id=usuario.idper;
            this.fillPersona.dni=usuario.doc;
            this.fillPersona.nombres=usuario.nombresPer;
            this.fillPersona.apellidos=usuario.apePer;
            this.fillPersona.telf=usuario.telefono;
            this.fillPersona.direccion=usuario.direccion;
            //this.fillPersona.imagen=usuario.imagen;
            this.fillPersona.tipodocu=usuario.tipodoc;
            this.fillPersona.genero=usuario.genero;


            this.filluser.id=usuario.iduser;
            this.filluser.name=usuario.username;
            this.filluser.email=usuario.email;
            this.filluser.token2=usuario.token2;

            this.filluser.tipouser_id=usuario.idtipo;
            this.filluser.activo=usuario.activo;

            this.divNuevoUsuario=false;
            this.divEditUsuario=true;
            this.divloaderEdit=false;

            this.$nextTick(function () {
                     this.validated='1';
                     $('#txtnombresE').focus();


            });

               /* if(usuario.imagen.length>0){
                    $("#ImgPerfilNuevoE").attr("src","{{ asset('/img/perfil/')}}"+"/"+usuario.imagen);
                }*/

                });
        }
        else{

            this.fillPersona.id=usuario.idper;
            this.fillPersona.dni=usuario.doc;
            this.fillPersona.nombres=usuario.nombresPer;
            this.fillPersona.apellidos=usuario.apePer;
            this.fillPersona.telf=usuario.telefono;
            this.fillPersona.direccion=usuario.direccion;
            //this.fillPersona.imagen=usuario.imagen;
            this.fillPersona.tipodocu=usuario.tipodoc;
            this.fillPersona.genero=usuario.genero;


            this.filluser.id=usuario.iduser;
            this.filluser.name=usuario.username;
            this.filluser.email=usuario.email;
            this.filluser.token2=usuario.token2;

            this.filluser.tipouser_id=usuario.idtipo;
            this.filluser.activo=usuario.activo;

            this.divNuevoUsuario=false;
            this.divEditUsuario=true;
            this.divloaderEdit=false;

            this.$nextTick(function () {
                     this.validated='1';
                     $('#txtnombresE').focus();


            });
        }


        },
        cerrarFormUsuarioE: function(){

            this.divEditUsuario=false;

            this.$nextTick(function () {
            this.fillPersona={'id':'', 'dni':'', 'nombres':'', 'apellidos':'', 'genero':'', 'telf':'', 'direccion':'', 'imagen':'', 'tipodocu':'1'};
            this.filluser={'id':'', 'name':'', 'email':'', 'password':'', 'tipouser_id':'', 'activo':'', 'token2':'','dependencia_id':''};
          })

        },
        updateUsuario:function (idPer,idUser) {


        var data = new  FormData();

        data.append('idPersona', this.fillPersona.id);
        data.append('idUser', this.filluser.id);

        data.append('editDNI', this.fillPersona.dni);
        data.append('editNombres', this.fillPersona.nombres);
        data.append('editApellidos', this.fillPersona.apellidos);
        data.append('editGenero',  this.fillPersona.genero);
        data.append('editTelefono', this.fillPersona.telf);
        data.append('editDireccion', this.fillPersona.direccion);
        data.append('imagen', this.imagen);
        data.append('editTipoDocu', this.fillPersona.tipodocu);


        data.append('editUsername', this.filluser.name);
        data.append('editEmail', this.filluser.email);
        data.append('editPassword',  this.filluser.token2);
        data.append('oldImagen', this.fillPersona.imagen);

        data.append('idtipo', this.filluser.tipouser_id);
        data.append('dependencia_id', this.filluser.dependencia_id);
        data.append('activo', this.filluser.activo);

        data.append('_method', 'PUT');

        const config = { headers: { 'Content-Type': 'multipart/form-data' } };

           var url="usuario/"+idUser;
            $("#btnSaveE").attr('disabled', true);
            $("#btnCloseE").attr('disabled', true);
            this.divloaderEdit=true;

            axios.post(url, data, config).then(response=>{

                $("#btnSaveE").removeAttr("disabled");
                $("#btnCloseE").removeAttr("disabled");
                this.divloaderEdit=false;
                
                if(response.data.result=='1'){   
                this.getUsuarios(this.thispage);
                this.cerrarFormUsuarioE();
                toastr.success(response.data.msj);

                }else{
                    $('#'+response.data.selector).focus();
                    toastr.error(response.data.msj);
                }

            }).catch(error=>{
                this.errors=error.response.data
            })
        },
        bajaUsuario:function (usuario) {
              swal({
                  title: '¿Estás seguro?',
                  text: "Nota: Si se desactiva el usuario, No podrá acceder al sistema, hasta que sea activado nuevamente",
                  type: 'info',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si, desactivar'
                }).then(function () {

                            var url = 'usuario/altabaja/'+usuario.iduser+'/0';
                            axios.get(url).then(response=>{//eliminamos

                            if(response.data.result=='1'){
                                app.getUsuarios(app.thispage);//listamos
                                toastr.success(response.data.msj);//mostramos mensaje
                            }else{
                               // $('#'+response.data.selector).focus();
                                toastr.error(response.data.msj);
                            }
                            });
                        
                    }).catch(swal.noop);
        },
        altaUsuario:function (usuario) {
              swal({
                  title: '¿Estás seguro?',
                  text: "Nota: Si activa el usuario, podrá acceder al sistema nuevamente",
                  type: 'info',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si, Activar'
                }).then(function () {

                            var url = 'usuario/altabaja/'+usuario.iduser+'/1';
                            axios.get(url).then(response=>{//eliminamos

                            if(response.data.result=='1'){
                                app.getUsuarios(app.thispage);//listamos
                                toastr.success(response.data.msj);//mostramos mensaje
                            }else{
                               // $('#'+response.data.selector).focus();
                                toastr.error(response.data.msj);
                            }
                            });
                        
                    }).catch(swal.noop);
        },
        impFicha:function (usuario) {

            

            this.fillPersona.dni=usuario.doc;
            this.fillPersona.nombres=usuario.nombresPer;
            this.fillPersona.apellidos=usuario.apePer;
            this.fillPersona.telf=usuario.telefono;
            this.fillPersona.direccion=usuario.direccion;

            this.fillPersona.tipodocu=usuario.tipodocu;
            this.fillPersona.genero=usuario.genero;



            this.filluser.id=usuario.iduser;
            this.filluser.name=usuario.username;
            this.filluser.email=usuario.email;
            this.filluser.token2=usuario.token2;

            this.tipoUser=usuario.tipouser;
            
            if(String(usuario.dependencia_id)!='null'){
                 this.prov=usuario.provincia;
                 this.dist=usuario.distrito;
                 this.dept=usuario.dependencia;
            }

            //this.fillPersona.imagen=usuario.imagen;

            this.$nextTick(function () {

                /*if(usuario.imagen.length>0){
            $("#divImgFIcha").attr("src","{{ asset('/img/perfil/')}}"+"/"+app.fillPersona.imagen);
            }*/
            this.$nextTick(function () {

            $('#modalFicha').modal(); 
          })
          })

            
            

              
        },
        Imprimir:function (usuario) {
            $("#FichaUsuario").printArea();
        },
        tipouser:function () {
            if(String(this.newTipoUser)=="1"){
                this.newProvincia='';
            }
        },
        tipouserE:function () {
            if(String(this.filluser.tipouser_id)=="1"){
                this.filluser.provincia_id='';
            }
        },

                      changeDis:function () {
          var idProv=this.idProv1;

          var url = 'organojudicials/changeProv2/'+idProv+'';
                            axios.get(url).then(response=>{
                                this.distritos=response.data.distritos;
                                this.dependencias=response.data.dependencias;
                                this.idDis1=response.data.idD1;
                                this.newDependencia='';
                       });


        },
      changeDep:function () {
          var idDis=this.idDis1;

          var url = 'organojudicials/changeDis2/'+idDis+'';
                            axios.get(url).then(response=>{
                                this.dependencias=response.data.dependencias;
                                this.newDependencia='';
                       });


      },


      changeDisE:function () {
          var idProv=this.idProv1E;

          var url = 'organojudicials/changeProv2/'+idProv+'';
                            axios.get(url).then(response=>{
                                this.distritosE=response.data.distritos;
                                this.dependenciasE=response.data.dependencias;
                                this.idDis1E=response.data.idD1;
                                this.filluser.dependencia_id='';
                       });


        },
      changeDepE:function () {
          var idDis=this.idDis1E;

          var url = 'organojudicials/changeDis2/'+idDis+'';
                            axios.get(url).then(response=>{
                                this.dependenciasE=response.data.dependencias;
                                this.filluser.dependencia_id='';
                       });


      },


      changeDis2:function (idProv,idDis,idDep) {

            this.idProv1E=idProv;
          var url = 'organojudicials/changeProv2/'+idProv+'';
                            axios.get(url).then(response=>{
                                this.distritosE=response.data.distritos;
                                this.changeDep2(idDis,idDep);

                       });


        },

        changeDep2:function (idDis,idDep) {

            this.idDis1E=idDis;
          var url = 'organojudicials/changeDis2/'+idDis+'';
                            axios.get(url).then(response=>{
                                this.dependenciasE=response.data.dependencias;
                                this.filluser.dependencia_id=idDep;
                       });


      },
    }
});
</script>