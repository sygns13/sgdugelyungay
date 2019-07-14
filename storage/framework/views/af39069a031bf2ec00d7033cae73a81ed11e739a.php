<head>
        <meta charset = "UTF-8" />
    <title> SGD UGEL YUNGAY - <?php echo $__env->yieldContent('htmlheader_title', ''); ?> </title>
    <link rel="icon" type="image/png" href="<?php echo e(asset('/img/logo-yungay.png')); ?>" />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <link href="<?php echo e(asset('login/css/bootstrapF.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('login/css/all.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('login/css/styles.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('/css/alertify.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('css/spinkit.min.css')); ?>" rel="stylesheet" type="text/css" />




    




    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;
    </script>
</head>
