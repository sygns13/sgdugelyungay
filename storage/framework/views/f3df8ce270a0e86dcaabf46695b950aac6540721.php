<script type="text/javascript">
    let app = new Vue({
el: '#app',
data:{
       titulo:"Procesamiento de Trámites",
       subtitulo: "Gestión",
       subtitulo2: "Principal",

   subtitle2:false,
   subtitulo2:"",

   tipouserPerfil:'<?php echo e($tipouser->nombre); ?>',
   userPerfil:'<?php echo e(Auth::user()->name); ?>',
   mailPerfil:'<?php echo e(Auth::user()->email); ?>',

   
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
   classTitle:'fa fa-cogs',
   classMenu0:'',
   classMenu1:'',
   classMenu2:'active',
   classMenu3:'',
   classMenu4:'',
   classMenu5:'',
   classMenu6:'',
   classMenu7:'',
   classMenu8:'',
   classMenu9:'',
   classMenu10:'',
   classMenu11:'',
   classMenu12:'',


   divprincipal:true,

   tramites: [],
   errors:[],

   /* fillformarecepcion:{'id':'', 'forma':'', 'activo':''}, */

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
   divNuevo:false,

   
   divloaderEdit:false,

   thispage:'1',


   newEstado:1,



   divloaderNuevo:false,

   tipodocumento:'',
   numero:'',
   siglas:'',
   estado:'',

   expediente:'',

   fecha:'',
   modelPrioridad:1,
   prioridad:'',

   origen:2,
   codigoEntidad:'',
   modelEntidad:1,
   entidad:'',
   detalle:'',
   firma:'',
   cargo:'',

   fechadoc:'',
   modelTipo:1,
   tipodoc:'',
   modelForma:1,
   formarecep:'',
   archivoExsite:false,
   urlAdjunto:'',
   folios:'',
   asunto:'',

   clasificacion:4,
   diasAtencion:'',
   forma:false,

   codUndOrg:'',
   modelUnidadOrg:1,
   unidadOrganica:'',
   detalleUnidadOrg:'',




   tramiteid:'',
   numExpediente:'',
   tramipersona_id:'',

   divloaderEdit2:false,

   nombresusu:'',
   apellidosusu:'',
   dniusu:'',
   usernameusu:'',
 

},
created:function () {
   this.getTramites(this.thispage);
},
mounted: function () {
   this.divloader0=false;

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

filters: {
  fecha: function (value) {
    if (!value) return ''
    value = value.toString()
    return value.slice(8)+"/"+value.slice(5,7)+"/"+value.slice(0,4)
  },

  mescotejar:function (value) {
    if (!value) return ''
    value = parseInt(value.toString());
    switch (value) {
        case 1:
                return "ENERO";
            break;
        case 2:
                return "FEBRERO";
            break;
        case 3:
                return "MARZO";
            break;
        case 4:
                return "ABRIL";
            break;
        case 5:
                return "MAYO";
            break;
        case 6:
                return "JUNIO";
            break;
        case 7:
                return "JULIO";
            break;
        case 8:
                return "AGOSTO";
            break;
        case 8:
                return "AGOSTO";
            break;
        case 9:
                return "SETIEMBRE";
            break;
        case 10:
                return "OCTUBRE";
            break;
        case 11:
                return "NOVIEMBRE";
            break;
    
        case 12:
                return "DICIEMBRE";
            break;
    
        default:
                return "";
            break;
    }

    return value
  },
},

methods: {


    fechaMetodo: function (value) {
    if (!value) return ''
    value = value.toString()
    return value.slice(8)+"/"+value.slice(5,7)+"/"+value.slice(0,4)
  },

  cambiarestado:function(){
    this.getTramites(this.thispage);
  },


   getTramites: function (page) {
       var busca=this.buscar;
       var url = 'procetramite?page='+page+'&busca='+busca+'&estado='+this.newEstado;

       axios.get(url).then(response=>{
           this.tramites= response.data.tramites.data;
           this.pagination= response.data.pagination;

           if(this.tramites.length==0 && this.thispage!='1'){
               var a = parseInt(this.thispage) ;
               a--;
               this.thispage=a.toString();
               this.changePage(this.thispage);
           }
       })
   },
   changePage:function (page) {
       this.pagination.current_page=page;
       this.getTramites(page);
       this.thispage=page;
   },
   buscarBtn: function () {
       this.getTramites();
       this.thispage='1';
   },

   LimpiarBtn:function() {

       this.buscar='';

       this.$nextTick(function () {
       this.buscarBtn();
     })
       
   },

  
 

   archivar:function (tramite) {
         swal({
             title: '¿Estás seguro?',
             text: "Desea Archivar el trámite seleccionado, Nota: Podrá seguir viendo este trámite en la opción de Registros Históricos de Trámites",
             type: 'info',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Si, Archivar'
           }).then(function () {

                       var url = 'mitramite/altabaja/'+tramite.id+'/2';
                       axios.get(url).then(response=>{//eliminamos

                       if(response.data.result=='1'){
                           app.getTramites(app.thispage);//listamos
                           toastr.success(response.data.msj);//mostramos mensaje
                       }else{
                          // $('#'+response.data.selector).focus();
                           toastr.error(response.data.msj);
                       }
                       });
                   
               }).catch(swal.noop);
   },

   verTramite:function(tramite){


       this.tramiteid=tramite.id;
       this.tramipersona_id=tramite.persona_id;

    this.tipodocumento=tramite.tipodocumento;
   this.numero=tramite.numero;
   this.siglas=tramite.siglas;
   this.estado=tramite.estado;

   this.expediente=tramite.expediente;

   if(this.expediente==null)
   {
    this.expediente="Pendiente";
   }

   this.fecha=this.fechaMetodo(tramite.fecha);
   this.modelPrioridad=1;
   this.prioridad=tramite.prioridad;

   this.origen=2;
   this.codigoEntidad=tramite.codentidad;
   this.modelEntidad=1;
   this.entidad=tramite.entidad;
   this.detalle=tramite.detalle;
   this.firma=tramite.firma;
   this.cargo=tramite.cargo;

   this.fechadoc=this.fechaMetodo(tramite.fechadoc);
   this.modelTipo=1;
   this.modelForma=1;
   this.formarecep=tramite.forma;
  
   this.urlAdjunto=tramite.rutafile;

   this.nombresusu=tramite.nombres;
   this.apellidosusu=tramite.apellidos;
   this.dniusu=tramite.dni;
   this.usernameusu=tramite.name;
   
   if(String(this.urlAdjunto.length)>0)
   {
    this.archivoExsite=true;
   }



   this.folios=tramite.folios;
   this.asunto=tramite.asunto;

   this.clasificacion=4;
   this.diasAtencion=tramite.dias;

   if(tramite.formacopia=="1")
   {
    this.forma=true;
   }
   else{
       this.forma=false;
   }
   

   this.codUndOrg=tramite.codunidad;
   this.modelUnidadOrg=1;
   this.unidadOrganica=tramite.unidadorganica;
   this.detalleUnidadOrg=tramite.detalledestino;



   if(this.estado=='1'){

    var url = 'procetramites/procesar';
                       axios.post(url,{id:tramite.id, estado:'2', persona_id:tramite.persona_id }).then(response=>{//eliminamos

                       if(response.data.result=='1'){
                           app.getTramites(app.thispage);//listamos
                           toastr.success(response.data.msj);//mostramos mensaje
                           app.estado=2;
                       }else{
                          // $('#'+response.data.selector).focus();
                           toastr.error(response.data.msj);
                       }
                       });

   }


   this.$nextTick(function () {
       $("#divparte1").hide();
       $("#divparte2").hide();
       $("#divparte3").show('slow');
     })

   },

   volverAtras:function(){

       $("#divparte3").hide();
       $("#divparte1").show('slow');
       $("#divparte2").show('slow');

   },

   registrarSISGEDO:function(){

    this.numExpediente='',
    $("#modalProcesar").modal('show');

    this.$nextTick(function () {
       $("#txtexpediente").focus();
     })

   },

   ingresoSisgedo:function(id){

       $("#btnSaveE").attr('disabled', true);
       $("#btnCancelE").attr('disabled', true);
       this.divloaderEdit=true;

    var url = 'procetramites/procesar';
    
    axios.post(url,{id:id, estado:'3', persona_id:this.tramipersona_id, expediente:this.numExpediente }).then(response=>{//ingreso

            $("#btnSaveE").removeAttr("disabled");
           $("#btnCancelE").removeAttr("disabled");
           this.divloaderEdit=false;

                       if(response.data.result=='1'){
                           app.getTramites(app.thispage);//listamos
                           toastr.success(response.data.msj);//mostramos mensaje
                           $("#modalProcesar").modal('hide');
                           app.estado=3;
                       }else{
                          // $('#'+response.data.selector).focus();
                           toastr.error(response.data.msj);
                       }
                       });

   },

   atender:function(id,perso_id){

       swal({
             title: '¿Estás seguro?',
             text: "Desea dar por atendido el Trámite Seleccionado",
             type: 'info',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Si, Aceptar'
           }).then(function () {

        $("#btnSaveA").attr('disabled', true);
        $("#btnatent").attr('disabled', true);
       this.divloaderEdit2=true;

                       var url = 'procetramites/procesar';;
                       axios.post(url,{id:id, estado:'4', persona_id:perso_id }).then(response=>{//ingreso

        
        $("#btnSaveA").removeAttr("disabled");
        $("#btnatent").removeAttr("disabled");
           this.divloaderEdit2=false;

                       if(response.data.result=='1'){
                           app.getTramites(app.thispage);//listamos
                           toastr.success(response.data.msj);//mostramos mensaje
                           app.estado=4;
                       }else{
                          // $('#'+response.data.selector).focus();
                           toastr.error(response.data.msj);
                       }
                       });
                   
               }).catch(swal.noop);

   },

   imprimir:function () {

//console.log("aqui");

      $("#divparteImp").printArea();


},

notificar:function(){
    swal({
             title: '¿Estás seguro?',
             text: "Desea Notificar el Estado del Trámite vía correo electrónico al Usuario Tramitador",
             type: 'info',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Si, Enviar Notificación'
           }).then(function () {

            console.log("que chuchas");
                       var url = 'procetramites/notificar';
                       axios.post(url,{id:app.tramiteid, persona_id:app.tramipersona_id }).then(response=>{//ingreso

                       if(response.data.result=='1'){
                           
                           toastr.success(response.data.msj);//mostramos mensaje
  
                       }else{
                          // $('#'+response.data.selector).focus();
                           toastr.error(response.data.msj);
                       }
                       });
                   
               }).catch(swal.noop);
}

}
});
</script>