
<div class="col-md-12">
        <h3>Procesos Principales:</h3>
</div>


    <?php if(accesoUser([1])): ?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua" style="box-shadow: 0px 10px 30px 0px #8d8686;">
            <div class="inner">
              <h3 style="font-size: 30px">Trámites</h3>

              <p>Procesar Trámites</p>
            </div>
            <div class="icon" style="top: 7px;">
 			<i class="fa fa-cogs"></i> 
            </div>
            <a href="<?php echo e(URL::to('procetramites')); ?>" id="recibosH" class="small-box-footer" style="height: 37px"><i class="fa fa-arrow-circle-right" style="font-size: 30px"></i></a>
          </div>
        </div>

<?php endif; ?>
        <!-- ./col -->

        <?php if(accesoUser([1])): ?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green" style="box-shadow: 0px 10px 30px 0px #8d8686;">
            <div class="inner">
              <h3 style="font-size: 30px">Usuarios</h3>

              <p>Gestión de Usuarios</p>
            </div>
            <div class="icon" style="top: 7px;">
              <i class="fa fa-users"></i>
            </div>
		  <a href="<?php echo e(URL::to('usuarios')); ?>" class="small-box-footer" style="height: 37px"><i class="fa fa-arrow-circle-right" style="font-size: 30px"></i></a>
		   </div>
        </div>
<?php endif; ?>



<?php if(accesoUser([1,2,4])): ?>
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-purple" style="box-shadow: 0px 10px 30px 0px #8d8686;">
    <div class="inner">
      <h3 style="font-size: 30px">Envío de Email</h3>

      <p>Envíos de Emails a Usuarios</p>
    </div>
    <div class="icon" style="top: 7px;">
<i class="fa fa-envelope    "></i> 
    </div>
    <a href="<?php echo e(URL::to('usuariosmail')); ?>" id="recibosP" class="small-box-footer" style="height: 37px"><i class="fa fa-arrow-circle-right" style="font-size: 30px"></i></a>
  </div>
</div>

<?php endif; ?>


<div class="col-md-12">
    <br>
    <h3>Tablas Maestras</h3>

</div>

<?php if(accesoUser([1])): ?>
<div class="col-lg-3 col-xs-6">
  <!-- small box -->
  <div class="small-box bg-teal" style="box-shadow: 0px 10px 30px 0px #8d8686;">
    <div class="inner">
      <h3 style="font-size: 30px">Tipos de Docs</h3>

      <p>Tipos de Documentos</p>
    </div>
    <div class="icon" style="top: 7px;">
<i class="fa fa-list-alt"></i> 
    </div>
    <a href="<?php echo e(URL::to('tipodocumento')); ?>" id="recibosP" class="small-box-footer" style="height: 37px"><i class="fa fa-arrow-circle-right" style="font-size: 30px"></i></a>
  </div>
</div>

<?php endif; ?>



<?php if(accesoUser([1])): ?>

        <div class="col-lg-3 col-xs-6">

          <div class="small-box bg-yellow" style="box-shadow: 0px 10px 30px 0px #8d8686;">
            <div class="inner">
              <h3 style="font-size: 30px">Unidades Org</h3>

              <p>Unidades Orgánicas</p>
            </div>
            <div class="icon" style="top: 7px;">
              <i class="fa fa-list-alt"></i>
            </div>
			<a href="<?php echo e(URL::to('unidadorganica')); ?>" class="small-box-footer" style="height: 37px"><i class="fa fa-arrow-circle-right" style="font-size: 30px"></i></a>
          </div>
        </div>

<?php endif; ?>
        <!-- ./col -->

<?php if(accesoUser([1])): ?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red" style="box-shadow: 0px 10px 30px 0px #8d8686;">
            <div class="inner">
              <h3 style="font-size: 30px">Entidades</h3>

              <p>Gestión de Entidades</p>
            </div>
            <div class="icon" style="top: 7px;">
              <i class="fa fa-list-alt"></i>
            </div>
			<a href="<?php echo e(URL::to('entidad')); ?>" class="small-box-footer" style="height: 37px"><i class="fa fa-arrow-circle-right" style="font-size: 30px"></i></a>
          </div>
        </div>
<?php endif; ?>

<?php if(accesoUser([1])): ?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue" style="box-shadow: 0px 10px 30px 0px #8d8686;">
            <div class="inner">
              <h3 style="font-size: 30px">Prioridades</h3>

              <p>Gestión de Prioridades</p>
            </div>
            <div class="icon" style="top: 7px;">
              <i class="fa fa-list-alt"></i>
            </div>
			<a href="<?php echo e(URL::to('prioridad')); ?>" class="small-box-footer" style="height: 37px"><i class="fa fa-arrow-circle-right" style="font-size: 30px"></i></a>
          </div>
        </div>

<?php endif; ?>
        <!-- ./col -->
 
