<?php $__env->startSection('htmlheader_title'); ?>
	Ventana Principal - Solicitud de Trámite
<?php $__env->stopSection(); ?>

<style type="text/css">         

	#modaltamanio{
		width: 70% !important;
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
	
<?php echo $__env->make('vendor.adminlte.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>