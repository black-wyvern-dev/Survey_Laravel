<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <title><?php echo e(config('app.name', 'Survey')); ?></title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('images/favicon.png')); ?>">
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">

    <?php echo $__env->yieldContent('styles'); ?>
</head>

<body>
    <div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(<?php echo e(asset('images/big/auth-bg.jpg')); ?>) no-repeat center center;">
            <div class="auth-box">

            <?php echo $__env->yieldContent('content'); ?>

            </div>
        </div>
    </div>
    <script src="<?php echo e(asset('libs/jquery/dist/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('libs/popper.js/dist/umd/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('libs/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>

    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html><?php /**PATH E:\Projects\Laravel\Survey systems\survey_laravel\resources\views/layouts/auth.blade.php ENDPATH**/ ?>