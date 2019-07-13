<?php $__env->startSection('htmlheader_title'); ?>
	Ventana Principal
<?php $__env->stopSection(); ?>


<?php if(accesoUser([2])): ?>

<style type="text/css">
  html,body{
  height:100%;
  width:100%;
}
</style>
<?php endif; ?>


<?php $__env->startSection('main-content'); ?>
	<div class="container-fluid spark-screen" id="contenidoItem">
				<div class="row" style="">

<?php echo $__env->make('vendor.adminlte.layouts.partials.loaders', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			<?php if(accesoUser([1])): ?>

<template v-if="divhome" id="divhome" v-show="divhome">
	<?php echo $__env->make('inicio.menuAdmin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>		
</template>

<?php elseif(accesoUser([3])): ?>

<template v-if="divhome" id="divhome" v-show="divhome">
  <?php echo $__env->make('inicio.menuAdmin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>    
</template>

			<?php elseif(accesoUser([2])): ?>

<template v-if="divhome" id="divhome" v-show="divhome">

<?php echo $__env->make('inicio.menuUser', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>		
</template>		
			<?php endif; ?>

		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('vendor.adminlte.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>