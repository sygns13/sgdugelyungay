@extends('vendor.adminlte.layouts.app')

@section('htmlheader_title')
	Ventana Principal
@endsection


@if(accesoUser([2]))

<style type="text/css">
  html,body{
  height:100%;
  width:100%;
}
</style>
@endif

{{-- --}}
@section('main-content')
	<div class="container-fluid spark-screen" id="contenidoItem">
				<div class="row" style="">

@include('vendor.adminlte.layouts.partials.loaders')

			@if(accesoUser([1]))

<template v-if="divhome" id="divhome" v-show="divhome">
	@include('inicio.menuAdmin')		
</template>

@elseif(accesoUser([3]))

<template v-if="divhome" id="divhome" v-show="divhome">
  @include('inicio.menuAdmin')    
</template>

			@elseif(accesoUser([2]))

<template v-if="divhome" id="divhome" v-show="divhome">


    <div class="modal fade" id="modalAlerta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document" style="width: 70%;-webkit-box-shadow: 0px 2px 10px 0px rgba(0, 0, 0, 0.2);
    box-shadow: 0px 2px 10px 0px rgba(0, 0, 0, 0.2);
    border-radius: 20px;">
    <div class="modal-content" style="    border-top-left-radius: 20px;   border-top-right-radius: 20px;    border-bottom-left-radius: 20px;">
      <div class="modal-header" style="border-top-left-radius: 20px;   border-top-right-radius: 20px;background: #2196f3;  color: white;">
        <h2 class="modal-title" id="exampleModalLongTitle">Titulo</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        {{--    <span aria-hidden="true">&times;</span>--}}
        </button>
      </div>
      <div class="modal-body" style="font-size: 20px;">
        Mensaje
      </div>
      <div class="modal-footer">
       {{--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
        <button type="button" class="btn btn-primary" @click="cerrarModal" id="btncerrar">Aceptar y Cerrar el Mensaje</button>

        <div class="sk-circle" v-show="divloaderEdit">
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
      </div>
    </div>
  </div>
</div>


	@if($contAlert>0)


	@foreach($alerta as $key => $dato)

	<div class="modal fade" id="modalAlerta{{ $dato->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document" style="width: 70%;-webkit-box-shadow: 0px 2px 10px 0px rgba(0, 0, 0, 0.2);
    box-shadow: 0px 2px 10px 0px rgba(0, 0, 0, 0.2);
    border-radius: 20px;">
    <div class="modal-content" style="    border-top-left-radius: 20px;   border-top-right-radius: 20px;    border-bottom-left-radius: 20px;">
      <div class="modal-header" style="border-top-left-radius: 20px;   border-top-right-radius: 20px;background: #2196f3;  color: white;">
        <h2 class="modal-title" id="exampleModalLongTitle">{{ $dato->titulo }}</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        {{--    <span aria-hidden="true">&times;</span>--}}
        </button>
      </div>
      <div class="modal-body" style="font-size: 20px;">
        {!! $dato->mensaje !!}
      </div>
      <div class="modal-footer">
       {{--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
        <button type="button" class="btn btn-primary" @click="leerMensaje('{{ $dato->id  }}')">Aceptar y Cerrar el Mensaje</button>
      </div>
    </div>
  </div>
</div>






	@endforeach

	@endif
	@include('inicio.menuUser')		
</template>		
			@endif

		</div>
	</div>
@endsection