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

@include('inicio.menuUser')		
</template>		
			@endif

		</div>
	</div>
@endsection