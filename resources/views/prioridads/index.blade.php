@extends('adminlte::layouts.app')

@section('htmlheader_title')
Gestión de Prioridades
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

		@if(accesoUser([1]))

		<template v-if="divprincipal" id="divprincipal">
			@include('prioridads.principal')
		</template>
		@endif


	</div>
</div>
@endsection
