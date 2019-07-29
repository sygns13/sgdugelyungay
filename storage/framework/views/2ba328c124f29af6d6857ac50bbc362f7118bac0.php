<script type="text/javascript">
    let app = new Vue({
el: '#app',
data:{
       titulo:"Solicitud de Tramite",
       subtitulo: "Principal",
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
   classTitle:'fa fa-file-text',
   classMenu0:'active',
   classMenu1:'',
   classMenu2:'',
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

   prioridads: [],
   formarecepcions: [],
   unidadorganicas: [],
   tipodocumentos: [],
   entidads: [],

   errors:[],


 /*   
    thispage:'1',
    
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
   divNuevo:false, */

   divloaderNuevo:false,
   divloaderEdit:false,



   newPrioridad:1,

   newOrigen:2,
   newTipo:false,
   codEntidad:'',
   newentidad:0,
   newDetalle:'',
   newfirma:'',
   newcargo:'',

   newfecha:'',
   newtipodoc:0,
   newNumero:'',
   newSiglas:'',

   uploadReady:true,
   archivo:null,
   newFolios:'',
   newAsunto:'',

   newClasificacion:4,
   newDias:'',


   newForma:false,
   codUndOrg:'',
   newUnidadOrganica:0,
   newDetalleDestino:'',
   
   newProveido:'',
   newUsuario:'',



},
created:function () {
   this.getFormaRecepcion(this.thispage);

   this.$nextTick(function () {
    $("#txtcodEntidad").focus();
                })
   
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

methods: {

    buscarEntidad:function(){

        $(".clsentidades").each(function( index ) {
            //console.log( index + ": " + $( this ).val() );

            var nent=$( this ).attr("id");

            var cant=nent.length;
            var finCad=nent.substring(5,cant);


            if(app.codEntidad==$( this ).val())
            {
                app.newentidad=finCad;

                $("#txtdetalle").focus();
                return false;
            }


    });

    },


    buscarUnidadOrganica:function(){

$(".clsunidadorges").each(function( index ) {
    //console.log( index + ": " + $( this ).val() );

    var nent=$( this ).attr("id");

    var cant=nent.length;
    var finCad=nent.substring(5,cant);


    if(app.codUndOrg==$( this ).val())
    {
        app.newUnidadOrganica=finCad;

        $("#txtDetalleUO").focus();
        return false;
    }


});

},
    

    getArchivo:function(event){
                //Asignamos la imagen a  nuestra data

                if (!event.target.files.length)
                {
                  this.archivo=null;
                }
                else{
                this.archivo = event.target.files[0];
                }
            },

   getFormaRecepcion: function (page) {
       var busca=this.buscar;
       var url = 'principal?page='+page+'&busca='+busca;

       axios.get(url).then(response=>{

           //console.log(response.data);
           this.prioridads= response.data.prioridads;
           this.formarecepcions= response.data.formarecepcions;
           this.unidadorganicas= response.data.unidadorganicas;
           this.tipodocumentos= response.data.tipodocumentos;
           this.entidads= response.data.entidads;


           this.$nextTick(function () {
                this.newPrioridad=1;
                this.newtipodoc=0;
                this.newForma=false;
                this.newUnidadOrganica=0;
                })

        })
   },

   cancelForm: function () {

    this.newPrioridad=1;

this.newOrigen=2;
this.newTipo=false;
this.codEntidad='';
this.newentidad=0;
this.newDetalle='';
this.newfirma='';
this.newcargo='';

this.newfecha='';
this.newtipodoc=0;
this.newNumero='';
this.newSiglas='';

this.uploadReady=false;
this.archivo=null;
this.newFolios='';
this.newAsunto='';

this.newClasificacion=4;
this.newDias='';


this.newForma=false;
this.codUndOrg='';
this.newUnidadOrganica=0;
this.newDetalleDestino='';

this.newProveido='';
this.newUsuario='';




this.$nextTick(function () {
    this.uploadReady=true;
    $('#cbuentidad').val('0').trigger('change');
$('#cbuTipoDoc').val('0').trigger('change');
$('#cbuUnidadOrganica').val('0').trigger('change');
     })


       $('#txtcodEntidad').focus();
       
   },
   create:function () {
       var url='principal';

       var data = new  FormData();

       data.append('prioridad_id', this.newPrioridad);
       data.append('entidad_id', this.newentidad);
       data.append('detalle', this.newDetalle);
       data.append('firma', this.newfirma);
       data.append('cargo', this.newcargo);
       data.append('fechadoc', this.newfecha);
       data.append('tipodocumento_id', this.newtipodoc);
       data.append('numero', this.newNumero);
       data.append('siglas', this.newSiglas);
       data.append('archivo', this.archivo);
       data.append('folios', this.newFolios);
       data.append('asunto', this.newAsunto);
       data.append('formacopia', this.newForma);
       data.append('unidadorganica_id', this.newUnidadOrganica);
       data.append('detalledestino', this.newDetalleDestino);


       const config = { headers: { 'Content-Type': 'multipart/form-data' } };

       $("#btnGuardar").attr('disabled', true);
       $("#btnCancel").attr('disabled', true);
       //$("#btnClose").attr('disabled', true);
       this.divloaderNuevo=true;
       axios.post(url,data, config).then(response=>{
           //console.log(response.data);

           $("#btnGuardar").removeAttr("disabled");
           $("#btnCancel").removeAttr("disabled");
           //$("#btnClose").removeAttr("disabled");
           this.divloaderNuevo=false;

           //console.log(response.data.result);

           if(String(response.data.result)=='1'){
               this.getFormaRecepcion(this.thispage);
               this.errors=[];
               this.cancelForm();
               toastr.success(response.data.msj);
           }else{
               $('#'+response.data.selector).focus();
               toastr.error(response.data.msj);
           }
       }).catch(error=>{
           //this.errors=error.response.data
       })
   },















   borrar:function (formarecepcion) {
         swal({
             title: '¿Estás seguro?',
             text: "¿Desea eliminar la Forma de Recepción Seleccionada? -- Nota: este proceso no se podrá revertir.",
             type: 'info',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Si, eliminar'
           }).then(function () {

                       var url = 'formarecepcions/'+formarecepcion.id;
                       axios.delete(url).then(response=>{//eliminamos

                       if(response.data.result=='1'){
                           app.getFormaRecepcion(app.thispage);//listamos
                           toastr.success(response.data.msj);//mostramos mensaje
                       }else{
                          // $('#'+response.data.selector).focus();
                           toastr.error(response.data.msj);
                       }
                       });
                   
               }).catch(swal.noop);
   },
   editar:function (formarecepcion) {

       /*
               fillformarecepcion:{'id':'', 'forma':'', 'activo':''},

               */

       this.fillformarecepcion.id=formarecepcion.id;
       this.fillformarecepcion.forma=formarecepcion.forma;
       this.fillformarecepcion.activo=formarecepcion.activo;

       $("#boxTitulo").text('Forma de Recepción: '+formarecepcion.forma);
       $("#modalEditar").modal('show');

       this.$nextTick(function () {
       $("#txtformadocE").focus();
     })
   },
   update:function (id) {
       var url="formarecepcions/"+id;
       $("#btnSaveE").attr('disabled', true);
       $("#btnCancelE").attr('disabled', true);
       this.divloaderEdit=true;

       axios.put(url, this.fillformarecepcion).then(response=>{

           $("#btnSaveE").removeAttr("disabled");
           $("#btnCancelE").removeAttr("disabled");
           this.divloaderEdit=false;
           
           if(response.data.result=='1'){   
           this.getFormaRecepcion(this.thispage);
           this.fillformarecepcion={'id':'', 'forma':'', 'activo':''};
           this.errors=[];
           $("#modalEditar").modal('hide');
           toastr.success(response.data.msj);

           }else{
               $('#'+response.data.selector).focus();
               toastr.error(response.data.msj);
           }

       }).catch(error=>{
           this.errors=error.response.data
       })
   },
   baja:function (formarecepcion) {
         swal({
             title: '¿Estás seguro?',
             text: "Desea desactivar la Forma de Recepción de Documento",
             type: 'info',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Si, desactivar'
           }).then(function () {

                       var url = 'formarecepcions/altabaja/'+formarecepcion.id+'/0';
                       axios.get(url).then(response=>{//eliminamos

                       if(response.data.result=='1'){
                           app.getFormaRecepcion(app.thispage);//listamos
                           toastr.success(response.data.msj);//mostramos mensaje
                       }else{
                          // $('#'+response.data.selector).focus();
                           toastr.error(response.data.msj);
                       }
                       });
                   
               }).catch(swal.noop);
   },
   alta:function (formarecepcion) {
         swal({
             title: '¿Estás seguro?',
             text: "Desea activar la Forma de Recepción de Documento",
             type: 'info',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Si, Activar'
           }).then(function () {

                       var url = 'formarecepcions/altabaja/'+formarecepcion.id+'/1';
                       axios.get(url).then(response=>{//eliminamos

                       if(response.data.result=='1'){
                           app.getFormaRecepcion(app.thispage);//listamos
                           toastr.success(response.data.msj);//mostramos mensaje
                       }else{
                          // $('#'+response.data.selector).focus();
                           toastr.error(response.data.msj);
                       }
                       });
                   
               }).catch(swal.noop);
   },
}
});
</script>