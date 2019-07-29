<script type="text/javascript">
    let app = new Vue({
       el: '#app',
       data:{
           titulo:"Mi perfil",
           subtitulo: "Módulo Principal",
           subtitulo2: "Principal",
   
           subtitle2:false,
           subtitulo2:"",
   
           tipouserPerfil:'{{ $tipouser->nombre }}',
           userPerfil:'{{ Auth::user()->name }}',
           mailPerfil:'{{ Auth::user()->email }}',
   
   
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
           classMenu5:'',
           classMenu6:'',
           classMenu7:'',
           classMenu8:'',
   
   
           usuarios: [],
           tipousers: [],
           persona:[],
           user:[],
           errors:[],
           fillPersona:{'id':'', 'dni':'', 'nombres':'', 'apellidos':'', 'genero':'', 'direccion':'', 'imagen':''},

            filluser:{'id':'', 'name':'', 'email':'', 'password':'', 'tipouser_id':'', 'activo':''},
   
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
           newDireccion:'',
   
           newTipoUser:'',
           newTipoPersona:'',
           newEstado:'1',
   
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
   
           divprincipal:false,
   
           modifpassword:1,


           pswa:'',
           pswn1:'',
           pswn2:'',
   
   
       },
       created:function () {
           this.getUsuarios(this.thispage);
       },
       mounted: function () {
           $("#divtitulo").show('slow');
           this.divloader0=false;
           this.divprincipal=true;
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
               //var busca=this.buscar;
               var url = 'usuario/miperfil'
   
               axios.post(url).then(response=>{
   
               this.fillPersona.id=response.data.usuario.idper;
               this.fillPersona.dni=response.data.usuario.dni;
               this.fillPersona.nombres=response.data.usuario.nombresPer;
               this.fillPersona.apellidos=response.data.usuario.apePer;
               this.fillPersona.direccion=response.data.usuario.direccion;
               this.fillPersona.genero=response.data.usuario.genero;

               if(this.fillPersona.genero=='1'){
                this.fillPersona.genero='Masculino';
               }
               if(this.fillPersona.genero=='2'){
                this.fillPersona.genero='Femenino';
               }
               if(this.fillPersona.genero=='0'){
                this.fillPersona.genero='No Registró Datos';
               }

   
               this.filluser.id=response.data.usuario.idUser;
               this.filluser.name=response.data.usuario.username;
               this.filluser.email=response.data.usuario.email;
   
               this.filluser.tipouser=response.data.usuario.tipouser;
               this.filluser.activo=response.data.usuario.activo;
               this.filluser.idtipouser=response.data.usuario.idtipo;
               })
           },
           

           modifclave:function () {

            this.pswa='';
            this.pswn1='';
            this.pswn2='';
   

$("#boxTitulo").text('Usuario: '+this.filluser.name);
$("#modalEditar").modal('show');

$("#txtdato2").focus();
},

  
          
updatepsw:function (usuario) {

    swal({
                  title: '¿Estás seguro?',
                  text: "Desea modificar su Password",
                  type: 'info',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si, Modificar!'
                }).then(function () {

                    app.update();
                        
                    }).catch(swal.noop);

         },

         update:function (id) {
       var url="usuario/modificarclave";
       $("#btnSaveE").attr('disabled', true);
       $("#btnCancelE").attr('disabled', true);
       app.divloaderEdit=true;

       var data = new  FormData();
       
            data.append('pswa', app.pswa);
            data.append('pswn1', app.pswn1);
            data.append('pswn2', app.pswn2);


            const config = { headers: { 'Content-Type': 'multipart/form-data' } };

    
            axios.post(url,data, config).then(response=>{

           $("#btnSaveE").removeAttr("disabled");
           $("#btnCancelE").removeAttr("disabled");
           app.divloaderEdit=false;
           
           if(response.data.result=='1'){   
 
           $("#modalEditar").modal('hide');
           toastr.success(response.data.msj);

           }else{
               $('#'+response.data.selector).focus();
               toastr.error(response.data.msj);
           }

       }).catch(error=>{
          // this.errors=error.response.data
       })
   },


         impFicha:function (usuario) {
   
   
   
           this.fillPersona.id=usuario.idPer;
               this.fillPersona.dni_ruc=usuario.dni_ruc;
               this.fillPersona.nombre=usuario.nombre;
               this.fillPersona.direccion=usuario.direccion;
               this.fillPersona.tipopersona_id=usuario.idtipoPer;
   
               this.filluser.id=usuario.idUser;
               this.filluser.name=usuario.username;
               this.filluser.email=usuario.email;
   
               this.filluser.tipouser_id=usuario.idtipouser;
               this.filluser.activo=usuario.activo;
   
   
   
   
               this.filluser.password='';
               this.modifpassword=1;
   
   
               this.tipoUser=usuario.tipouser;
   
   
               $('#modalFicha').modal(); 
   
          /*  this.$nextTick(function () {
   
               if(usuario.imagen.length>0){
                   $("#divImgFIcha").attr("src","{{ asset('/img/perfil/')}}"+"/"+app.fillPersona.imagen);
               }
               this.$nextTick(function () {
   
                   $('#modalFicha').modal(); 
               })
           }) */
   
   
   
   
   
       },
       Imprimir:function (usuario) {
           $("#FichaUsuario").printArea();
       },
   }
   });
   </script>