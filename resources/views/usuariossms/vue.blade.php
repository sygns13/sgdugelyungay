<script type="text/javascript">
 let app = new Vue({
    el: '#app',
    data:{
        tipouserPerfil:'{{ $tipouser->nombre }}',
        userPerfil:'{{ Auth::user()->name }}',
        mailPerfil:'{{ Auth::user()->email }}',


        titulo:"Usuarios",
        subtitulo:"Envio de SMS",
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

        divusuario:true,
        div1:true,
        div2:false,
        div3:false,

        usuarios: [],
        usuarios2: [],
        tipousers: [],
        persona:[],
        user:[],
        users:[],
        provincias:[],
        errors:[],
        fillPersona:{'id':'', 'dni':'', 'nombres':'', 'apellidos':'', 'genero':'', 'telf':'', 'direccion':'', 'imagen':'', 'tipodocu':'1'},

        filluser:{'id':'', 'name':'', 'email':'', 'password':'', 'tipouser_id':'', 'activo':'', 'token2':'','provincia_id':''},

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
        newSms:'',

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



    },
    created:function () {
        this.getUsuarios(this.thispage);
    },
    mounted: function () {
        this.divloader0=false;

        this.mostrarPalenIni=true;

        console.log(this.mostrarPalenIni);

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
            var urlUsuarios = 'usuariosms?page='+page+'&busca='+busca;

            axios.get(urlUsuarios).then(response=>{

                this.usuarios= response.data.usuarios.data;
                this.tipousers= response.data.tipousers;
                this.pagination= response.data.pagination;
                this.provincias= response.data.provincias;
                this.mostrarPalenIni=true;

                this.usuarios2= response.data.usuarios2;

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
        cargarTelefonos:function () {

      this.div1=false;
      this.div2=false;
      this.div3=true;
             this.users=[];
             this.$nextTick(function () {
                $.each(app.usuarios2, function( index, value ) {
                  //alert( index + ": " + value );
                 //console.log(value.email);
                 var telefono=value.telefono;
                 // app.users.push({value.email});
                 app.users.push({telefono});
                });
                
            })

             $("#btnCargarMail").blur();
         },
           
     seleccionarUser:function (telefono) {
      $(".btn").blur();

        const resultado = app.users.find( user => user.telefono === telefono );

        if (typeof resultado === "undefined") {
            this.users.push({telefono});
        }
      
      this.div1=false;
      this.div2=false;
      this.div3=true;
  },
  cancelFormUsuario: function () {

    this.newSms='';

    this.div1=false;
    this.div2=false;
    this.div3=false;



    this.$nextTick(() => {

        })

    for (var i = this.users.length - 1; i >= 0; i--) 
    {
       this.users.pop();
   }
},
tipouser:function () {
    if(String(this.newTipoUser)=="1"){
        this.newProvincia='';
    }
},

    enviarSMS:function () {
            var url='enviarSMS';
            $("#btnGuardar").attr('disabled', true);
            $("#btnCancel").attr('disabled', true);
            $("#btnCargarMail").attr('disabled', true);
            this.divloaderNuevo=true;

            var telefonos= [];

            var cont=0;

            $.each(app.users, function( index, value ) {
                  //alert( index + ": " + value.email );

                  telefonos[cont]='+51'+value.telefono;
                  cont++;

                });

            console.log(telefonos);
            var data = new  FormData();


            data.append('mensaje', this.newSms);
            data.append('telefonos', JSON.stringify(telefonos));


            /*var formData = new FormData($("#formulario")[0]);
            console.log(formData);*/
    
            axios.post(url,data).then(response=>{
                //console.log(response.data);

                $("#btnGuardar").removeAttr("disabled");
                $("#btnCancel").removeAttr("disabled");
                $("#btnCargarMail").removeAttr("disabled");
                this.divloaderNuevo=false;

                if(response.data.result=='1'){
                    toastr.success(response.data.msj);
                    this.cancelFormUsuario();

                }
                 if(response.data.result=='0'){
                    toastr.error(response.data.msj);  
                    $("#0"+response.data.selector).focus();
                    //this.cancelFormUsuario();

                }
            }).catch(error=>{
                this.errors=error.data;
               toastr.error("No se pudo enviar el mensaje");
               $("#btnGuardar").removeAttr("disabled");
                $("#btnCancel").removeAttr("disabled");
                $("#btnCargarMail").removeAttr("disabled");
                this.divloaderNuevo=false;
              // toastr.error(response.data.msj);   
              /*  $("#btnGuardar").removeAttr("disabled");
                $("#btnCancel").removeAttr("disabled");
                $("#btnCargarMail").removeAttr("disabled");
                this.divloaderNuevo=false;*/
               // console.log('error: '+this.errors)
            })
        },

}
});
</script>