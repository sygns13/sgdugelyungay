<?php $__env->startSection('htmlheader_title'); ?>
Gestión de envio de Email de Usuarios
<?php $__env->stopSection(); ?>

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
<?php $__env->startSection('main-content'); ?>
<div class="container-fluid spark-screen" id="contenidoItem">

	<div class="row">

		<?php echo $__env->make('adminlte::layouts.partials.loaders', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php if(accesoUser([1])): ?>

		<template v-if="divusuario" id="divusuario">
			<?php echo $__env->make('usuariosmail.usuario', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</template>
		<?php endif; ?>

	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>