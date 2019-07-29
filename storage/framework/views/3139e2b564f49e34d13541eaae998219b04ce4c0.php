<?php $__env->startSection('htmlheader_title'); ?>
	Mi Perfil
<?php $__env->stopSection(); ?>

<style type="text/css">         
          
#modaltamanio{
  width: 70% !important;
}

.swal2-popup{
	font-size: 1.175em !important;
}

</style>
<?php $__env->startSection('main-content'); ?>
	<div class="container-fluid spark-screen" id="contenidoItem">



		<div class="row">

                <?php echo $__env->make('adminlte::layouts.partials.loaders', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php if(accesoUser([1,2,3,4,5])): ?>

<template v-if="divprincipal" id="divprincipal">
	<?php echo $__env->make('miperfil.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</template>
			<?php endif; ?>


		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>