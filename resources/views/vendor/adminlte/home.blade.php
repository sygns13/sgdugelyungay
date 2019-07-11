@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

<style type="text/css">         
          
#modaltamanio{
  width: 70% !important;
}

</style>
@section('main-content')
	<div class="container-fluid spark-screen">



		<div class="row">

@include('adminlte::layouts.partials.loaders')

			@if(accesoUser([1,2,3]))

<template v-if="divhome" id="divhome" v-show="divhome">
	@include('inicio.menuAdmin')		
</template>

			@elseif(accesoUser([4]))

<template v-if="divhome" id="divhome" v-show="divhome">
	@include('inicio.menuAlumno')		
</template>		
			@endif


		</div>
	</div>
@endsection
