@extends('vendor.adminlte.layouts.app')

@section('htmlheader_title')
	Ventana Principal - Solicitud de Trámite
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
	
			@if(accesoUser([3]))
	
			<template v-if="divprincipal" id="divprincipal">
				@include('iniciousuario.principal')
			</template>
			@endif
	
	
		</div>
	</div>
	@endsection
	