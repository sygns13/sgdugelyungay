<?php $__env->startSection('htmlheader_title'); ?>
Gestión de Nuevo Trámite
<?php $__env->stopSection(); ?>

<style type="text/css">         

#modaltamanio{
	width: 70% !important;
}

.backform {
    background-color: #4791C5!important;
	font-family: Tahoma, Arial, sans-serif;
}


.backform, td {
    font: 70%/126% verdana, arial, helvetica, sans-serif;
}

.frmline {
    background-color: #FFFFFF!important;
    border: 2px #006699 solid!important;
}


th {
    color: #FFA34F!important;
    font-size: 12px!important;
    font-weight: bold!important;
    background-color: #096EA1!important;
    height: 25px!important;
    background-image: url(<?php echo e(asset('/img/sisgedo/formpic3.gif')); ?>)!important;
}

.marco {
    background-color: #D1D7DC!important;
}

.seccion {
    background-color: #EFEFEF!important;
    font-weight: bold!important;
    font-size: 11px!important;
    color: #666666!important;
    text-decoration: none!important;
    height: 18px!important;
    background-image: url(<?php echo e(asset('/img/sisgedo/titulo2.jpg')); ?>  )!important;
}

.etiqueta {
    background-color: #D1D7DC!important;
    font-weight: bold!important;
    font-size: 10px!important;
    color: #006699!important;
    text-decoration: none!important;
}

.objeto {
    background-color: #EFEFEF!important;
}

.seccionblank {
    background-color: #EFEFEF!important;
    font-weight: bold!important;
    font-size: 11px!important;
    color: #666666!important;
    text-decoration: none!important;
}


td.spaceRow {
    background-color: #D1D7DC!important;
    border: #FFFFFF!important;
    border-style: solid!important;
    border-width: 0px 1px 0px 1px!important;
}

td.catBottom {
    background-image: url(<?php echo e(asset('/img/sisgedo/formpic1.gif')); ?>)!important;
    background-color: #D1D7DC!important;
    border: #FFFFFF!important;
    border-style: solid!important;
    height: 19px!important;
    border-width: 0px 1px 1px 1px!important;
    height: 20px!important;
    border-width: 0px 0px 0px 0px!important;
}

.boton {
    border-right: #cccccc 1px outset!important;
    border-top: #cccccc 1px outset!important;
    background-repeat: repeat-x!important;
    background-color: transparent!important;
	color: #000000!important;
    font: normal 11px Verdana, Arial, Helvetica, sans-serif!important;
    border-color: #000000!important;
	margin-left: 5px!important;
}


</style>
<?php $__env->startSection('main-content'); ?>
<div class="container-fluid spark-screen">



	<div class="row">

		<?php echo $__env->make('adminlte::layouts.partials.loaders', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php if(accesoUser([3])): ?>

		<template v-if="divprincipal" id="divprincipal">
			<?php echo $__env->make('iniciousuario.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</template>
		<?php endif; ?>


	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>