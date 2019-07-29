@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Mi Perfil
@endsection

<style type="text/css">         
          
#modaltamanio{
  width: 70% !important;
}

.swal2-popup{
	font-size: 1.175em !important;
}

</style>
@section('main-content')
	<div class="container-fluid spark-screen" id="contenidoItem">



		<div class="row">

                @include('adminlte::layouts.partials.loaders')

			@if(accesoUser([1,2,3,4,5]))

<template v-if="divprincipal" id="divprincipal">
	@include('miperfil.principal')
</template>
			@endif


		</div>
	</div>
@endsection
