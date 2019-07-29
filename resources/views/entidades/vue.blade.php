<script type="text/javascript">
    let app = new Vue({
el: '#app',
data:{
       titulo:"Entidades",
       subtitulo: "Tablas Maestras",
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
   classTitle:'fa fa-list-alt',
   classMenu0:'',
   classMenu1:'active',
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

   entidads: [],
   errors:[],

   fillentidad:{'id':'', 'codigo':'', 'nombre':'', 'siglas':'', 'activo':'' , 'abrev':''},

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

   divloaderNuevo:false,
   divloaderEdit:false,

   thispage:'1',

   newcodigo:'',
   newnombre:'',
   newEstado:'1',
   newsiglas:'',
   newAbreviatura:'',



},
created:function () {
   this.getentidads(this.thispage);
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
   getentidads: function (page) {
       var busca=this.buscar;
       var url = 'entidads?page='+page+'&busca='+busca;

       axios.get(url).then(response=>{
           this.entidads= response.data.entidads.data;
           this.pagination= response.data.pagination;

           if(this.entidads.length==0 && this.thispage!='1'){
               var a = parseInt(this.thispage) ;
               a--;
               this.thispage=a.toString();
               this.changePage(this.thispage);
           }
       })
   },
   changePage:function (page) {
       this.pagination.current_page=page;
       this.getentidads(page);
       this.thispage=page;
   },
   buscarBtn: function () {
       this.getentidads();
       this.thispage='1';
   },
   nuevo:function () {
       this.divNuevo=true;

       this.$nextTick(function () {
       this.cancelForm();
     })
       
   },
   cerrarForm: function () {
       this.divNuevo=false;
       this.cancelForm();
   },
   cancelForm: function () {
       $('#txtunidaorg').focus();
       this.newnombre='';
       this.newsiglas='';
       this.newcodigo='';
       this.newAbreviatura='';
       this.newEstado='1';
   },
   create:function () {
       var url='entidads';
       $("#btnGuardar").attr('disabled', true);
       $("#btnCancel").attr('disabled', true);
       $("#btnClose").attr('disabled', true);
       this.divloaderNuevo=true;
       axios.post(url,{codigo:this.newcodigo, abreviatura:this.newAbreviatura, siglas:this.newsiglas, nombre:this.newnombre, activo:this.newEstado }).then(response=>{
           //console.log(response.data);

           $("#btnGuardar").removeAttr("disabled");
           $("#btnCancel").removeAttr("disabled");
           $("#btnClose").removeAttr("disabled");
           this.divloaderNuevo=false;

           console.log(response.data.result);

           if(String(response.data.result)=='1'){
               this.getentidads(this.thispage);
               this.errors=[];
               this.cerrarForm();
               toastr.success(response.data.msj);
           }else{
               $('#'+response.data.selector).focus();
               toastr.error(response.data.msj);
           }
       }).catch(error=>{
           //this.errors=error.response.data
       })
   },
   borrar:function (entidad) {
         swal({
             title: '¿Estás seguro?',
             text: "¿Desea eliminar la Entidad Seleccionada? -- Nota: este proceso no se podrá revertir.",
             type: 'info',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Si, eliminar'
           }).then(function () {

                       var url = 'entidads/'+entidad.id;
                       axios.delete(url).then(response=>{//eliminamos

                       if(response.data.result=='1'){
                           app.getentidads(app.thispage);//listamos
                           toastr.success(response.data.msj);//mostramos mensaje
                       }else{
                          // $('#'+response.data.selector).focus();
                           toastr.error(response.data.msj);
                       }
                       });
                   
               }).catch(swal.noop);
   },
   editar:function (entidad) {

       /*
               fillentidad:{'id':'', 'codigo':'', 'siglas':'', 'nombre':'', 'activo':''},

               */

       this.fillentidad.id=entidad.id;
       this.fillentidad.codigo=entidad.codigo;
       this.fillentidad.siglas=entidad.siglas;
       this.fillentidad.nombre=entidad.nombre;
       this.fillentidad.activo=entidad.activo;
       this.fillentidad.abrev=entidad.abrev;

       $("#boxTitulo").text('Entidad: '+entidad.nombre);
       $("#modalEditar").modal('show');

       this.$nextTick(function () {
       $("#txtunidaorgE").focus();
     })
   },
   update:function (id) {
       var url="entidads/"+id;
       $("#btnSaveE").attr('disabled', true);
       $("#btnCancelE").attr('disabled', true);
       this.divloaderEdit=true;

       axios.put(url, this.fillentidad).then(response=>{

           $("#btnSaveE").removeAttr("disabled");
           $("#btnCancelE").removeAttr("disabled");
           this.divloaderEdit=false;
           
           if(response.data.result=='1'){   
           this.getentidads(this.thispage);
           this.fillentidad={'id':'', 'codigo':'', 'siglas':'', 'nombre':'', 'activo':'' , 'abrev':''};
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
   baja:function (entidad) {
         swal({
             title: '¿Estás seguro?',
             text: "Desea desactivar la Entidad",
             type: 'info',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Si, desactivar'
           }).then(function () {

                       var url = 'entidads/altabaja/'+entidad.id+'/0';
                       axios.get(url).then(response=>{//eliminamos

                       if(response.data.result=='1'){
                           app.getentidads(app.thispage);//listamos
                           toastr.success(response.data.msj);//mostramos mensaje
                       }else{
                          // $('#'+response.data.selector).focus();
                           toastr.error(response.data.msj);
                       }
                       });
                   
               }).catch(swal.noop);
   },
   alta:function (entidad) {
         swal({
             title: '¿Estás seguro?',
             text: "Desea activar la Entidad",
             type: 'info',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Si, Activar'
           }).then(function () {

                       var url = 'entidads/altabaja/'+entidad.id+'/1';
                       axios.get(url).then(response=>{//eliminamos

                       if(response.data.result=='1'){
                           app.getentidads(app.thispage);//listamos
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