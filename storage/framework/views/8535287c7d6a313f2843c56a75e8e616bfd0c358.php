<!DOCTYPE html>
<html>

<?php echo $__env->make('adminlte::layouts.partials.htmlheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body>
    <div id="app">
        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            <?php echo $__env->yieldContent('main-content'); ?>
        </section>
    </div>
</body>
</html>