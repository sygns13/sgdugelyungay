@extends('adminlte::layouts.app')

@section('htmlheader_title')
Gestión de envio de Email de Usuarios
@endsection

<style type="text/css">         

#modaltamanio{
	width: 70% !important;
}

.vT {
    -webkit-align-items: center;
    align-items: center;
    background-color: #f0f0f0;
    border: 1px solid #dadce0;
    -webkit-border-radius: 10px;
    border-radius: 10px;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    display: -webkit-inline-box;
    display: -webkit-inline-flex;
    display: -ms-inline-flexbox;
    display: inline-flex;
    height: 30px;
    line-height: 20px;
    margin: 2px 0;
    padding-left: 8px;
    padding-right: 4px;
}

</style>
@section('main-content')
<div class="container-fluid spark-screen" id="contenidoItem">

	<div class="row">

		@include('adminlte::layouts.partials.loaders')

		@if(accesoUser([1]))

		<template v-if="divusuario" id="divusuario">
			@include('usuariosmail.usuario')
		</template>
		@endif

	</div>
</div>
@endsection
