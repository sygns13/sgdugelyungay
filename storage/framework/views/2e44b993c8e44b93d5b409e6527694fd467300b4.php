<?php $__env->startSection('htmlheader_title'); ?>
   Iniciar Sesión
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<body id="headerwrap" class="withAnimation">



    <div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="col-md-12">
            <div class="col-md-6" style="width: 400px;padding-left: 0px;padding-right: 0px;font-size: 13px;">
                
                <?php if(count($errors) > 0): ?>

                    <div class="alert alert-danger" style="margin-bottom: 0px;margin-top: 30px;">
                        <div style="text-align: center;">
                            <p style="margin-bottom: 6px;">
                                
                            <strong>Error!</strong> Tenemos algunos Algunos Problemas<br>
                            </p>
                        </div>
                        <ul style="margin-bottom: 0px;">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                            <?php if($error=="The name field is required."): ?>
                            <li>El campo Usuario es necesario. Debe completarlo</li>
                            <?php endif; ?>

                            <?php if($error=="The password field is required."): ?>
                            <li>El campo Password es necesario. Debe completarlo</li>
                            <?php endif; ?>

                            <?php if($error=="These credentials do not match our records."): ?>
                            <li>Usted ha ingresado un nombre de usuario o un password incorrecto. Si no recuerda el usuario y password correcto, resetee su cuenta.</li>
                            <?php endif; ?>

                            <?php if($error=="usuarioActiv"): ?>
                            <li>El usuario del sistema se encuentra desactivado, comuncarse con el administrador del sistema.</li>
                            <?php endif; ?>

                            <?php if($error=="alumnoSemestre"): ?>
                            <li>El semestre al que pertenece el alumno se encuentra cerrado, comuniquese con el administrador del sistema.</li>
                            <?php endif; ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>



            <div class="card2a" style="text-align: center;margin-top: 50px;border-radius: 3px">
                <img class="" src="<?php echo e(asset('/login/images/logofinal.png')); ?>" style="    padding-top: 7px; width: 398px;">

            </div>
            <hr style="border-top: 1px solid rgba(0, 0, 0, 0);">
            <!-- <br> -->
        <div class="card">

            <div class="card-header" style="padding-left: 25px;padding-right: 25px;border-bottom: 1px solid rgba(255, 255, 255, 0.54);">
                <h3 style="margin-top: 15px;"><font face="Arial">SGD</font></h3>
                <h5 style="margin-top: 15px; color: white;"><font face="Arial">Unidad de Gestión Educativa Local Yungay</font></h5>

                <div class="d-flex justify-content-end social_icon">
                    <!-- <span><i class="glyphicon glyphicon-stats"></i></span> -->
                  
                    <!-- <span><i class="glyphicon glyphicon-equalizer"></i></span> -->
                </div>
            </div>
            <div class="card-body" style="padding-left: 25px;padding-right: 25px;">
                <form action="<?php echo e(url('/loginn')); ?>" method="post">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Usuario">
                        
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" class="form-control" name="password" placeholder="password">
                    </div>
                    <div class="row align-items-center remember">
                        <input type="checkbox" name="remember">Recuérdame
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Ingresar" class="btn float-right login_btn">
                    </div>
                </form>
            </div>
            <div class="card-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.54);">
                <div class="d-flex center-content-center links" style="text-align: center;font-style: oblique;">
                    <font size="5" face="Monotype Corsiva" style="color: #eee">"Sistema de Gestión Documental -SGD Ugel Yungay"</font>
                </div>
                
            </div>
        </div>
        
        </div>

    </div>

    <?php echo $__env->make('vendor.adminlte.layouts.partials.scripts_auth2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::layouts.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>