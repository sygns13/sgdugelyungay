<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">

@section('htmlheader')
    @include('adminlte::layouts.partials.htmlheader')
@show


@if(accesoUser([1]))
<body class="skin-purple sidebar-mini">
  @elseif(accesoUser([2]))
<body class="skin-purple sidebar-collapse">

   @elseif(accesoUser([3]))
   <body class="skin-red sidebar-mini">
  @endif

<div id="app" v-cloak>
    <div class="wrapper">

    @include('adminlte::layouts.partials.mainheader')

    @include('adminlte::layouts.partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        @include('adminlte::layouts.partials.contentheader')

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            @yield('main-content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    @include('adminlte::layouts.partials.controlsidebar')

    @include('adminlte::layouts.partials.footer')

</div><!-- ./wrapper -->
</div>
@section('scripts')
    @include('adminlte::layouts.partials.scripts')
@show

</body>
</html>
<script type="text/javascript">
    function bajar1(){
        //alert("prueba");
        $("#menuBajar1").toggle();
    }

</script>

  @if($modulo=="inicio")
    @include('inicio.vue')





<script type="text/javascript">
    
  /*  $( document ).ready(function() {

        @if($contAlert>0)
  @foreach($alerta as $key => $dato)

    $("#modalAlerta{{ $dato->id }}").modal('show');

      @endforeach

  @endif
});*/


</script>










  @elseif($modulo=="especialidad")
      @include('especialidades.vue')
   


    @elseif($modulo=="subespecialidad")
      @include('subespecialidades.vue')
 

    @elseif($modulo=="organojudicial")
      @include('organojudicial.vue')


    @elseif($modulo=="asignarprovincia")
      @include('asignarprovincia.vue')

    @elseif($modulo=="funcion")
      @include('funcion.vue')

    @elseif($modulo=="instancia")
      @include('instancia.vue')

    @elseif($modulo=="expediente")
      @include('expedientes.vue')    

    @elseif($modulo=="usuarios")
      @include('usuarios.vue')    

    @elseif($modulo=="magistrados")
      @include('magistrados.vue')

    @elseif($modulo=="repgeneral")
      @include('reportegeneral.vue')    

    @elseif($modulo=="repdetallado")
      @include('reportedetallado.vue')


    @elseif($modulo=="usuariosmail")
      @include('usuariosmail.vue') 

    @elseif($modulo=="usuariossms")
      @include('usuariossms.vue')

    @elseif($modulo=="magistradosmail")
      @include('magistradosmail.vue')

    @elseif($modulo=="magistradossms")
      @include('magistradossms.vue')

    @elseif($modulo=="usuariosalert")
      @include('usuariosalert.vue')
    
    @elseif($modulo=="foro")
      @include('foro.vue')

    @elseif($modulo=="respuestaforo")
      @include('respuestaforo.vue')    

    @elseif($modulo=="dependencia")
      @include('dependencia.vue')
  
    @elseif($modulo=="repingresos")
      @include('repingresados.vue')    

    @elseif($modulo=="represueltos")
      @include('represueltos.vue')    

    @elseif($modulo=="repuser")
      @include('repusers.vue')    

    @elseif($modulo=="magistradoreporte")
      @include('magistradoreporte.vue')    

    @elseif($modulo=="procesos")
      @include('procesos.vue')    

    @elseif($modulo=="repProcesos")
      @include('repProcesos.vue')    

    @elseif($modulo=="repgeneral2")
      @include('repgeneral2.vue')    

    @elseif($modulo=="repgeneral3")
      @include('repgeneral3.vue')

    @elseif($modulo=="porcentaje")
      @include('porcentajes.vue')

    @elseif($modulo=="repAnual")
      @include('repAnual.vue')

    @elseif($modulo=="procesosviolencia")
      @include('procesosviolencia.vue')
  @endif


    <script type="text/javascript">

        $(function(){

  
  // $("#inic").on("click", function(event){

  //  event.preventDefault();
  //  $.get("/home",function(response){
  //    $('#contenidoItem').html(response.view);
  //  });
  // });

  $("#arequeU").on("click", function(event){

    event.preventDefault();
    $.get("/prueba",function(response){
      $('#contenidoItem').html(response.view);
    });
  });

  


  // $.ajax({
 //        url: '/obtenerPrecios',
 //        type: 'GET',
 //        dataType: 'json',
 //    })
 //    .done(function(datos) {

 //        listaPrecios=datos.precios;
 //    })

 //    .fail(function() {

 //        swal("Error", "Ocurrió un error.", "error");
 //    });

});

        
        function redondear(num) {
    return +(Math.round(num + "e+2")  + "e-2");
}

function recorrertb(idtb){

    var cont=1;
        $("#"+idtb+" tbody tr").each(function (index)
        {

            $(this).children("td").each(function (index2)
            {
               //alert(index+'-'+index2);

               if(index2==0){
                  $(this).text(cont);
                  cont++;
               }


            })

        })
  }

  function isImage(extension)
{
    switch(extension.toLowerCase()) 
    {
        case 'jpg': case 'gif': case 'png': case 'jpeg': case 'JPG': case 'GIF': case 'PNG': case 'JPEG': case 'jpe': case 'JPE':
            return true;
        break;
        default:
            return false;
        break;
    }
}

function soloNumeros(e){
  var key = window.Event ? e.which : e.keyCode
  return ((key >= 48 && key <= 57) || (key==8) || (key==35) || (key==34) || (key==46));
}

function noEscribe(e){
  var key = window.Event ? e.which : e.keyCode
  return (key==null);
}

function EscribeLetras(e,ele){
  var text=$(ele).val();
  text=text.toUpperCase();
   var pos=posicionCursor(ele);
  $(ele).val(text);

  ponCursorEnPos(pos,ele);
}


function ponCursorEnPos(pos,laCaja){  
    if(typeof document.selection != 'undefined' && document.selection){        //método IE 
        var tex=laCaja.value; 
        laCaja.value='';  
        laCaja.focus(); 
        var str = document.selection.createRange();  
        laCaja.value=tex; 
        str.move("character", pos);  
        str.moveEnd("character", 0);  
        str.select(); 
    } 
    else if(typeof laCaja.selectionStart != 'undefined'){                    //método estándar 
        laCaja.setSelectionRange(pos,pos);  
        //forzar_focus();            //debería ser focus(), pero nos salta el evento y no queremos 
    } 
}  

function posicionCursor(element)
{
       var tb = element;
        var cursor = -1;

        // IE
        if (document.selection && (document.selection != 'undefined'))
        {
            var _range = document.selection.createRange();
            var contador = 0;
            while (_range.move('character', -1))
                contador++;
            cursor = contador;
        }
       // FF
        else if (tb.selectionStart >= 0)
            cursor = tb.selectionStart;

       return cursor;
}

function pad (n, length) {
    var  n = n.toString();
    while(n.length < length)
         n = "0" + n;
    return n;
}

    </script>