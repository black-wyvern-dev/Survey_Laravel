<?php $__env->startSection('styles'); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div id="loginform">
    <div class="logo">
        <span class="db"><img src="<?php echo e(asset('images/logo-icon.png')); ?>" alt="logo" /></span>
        <h5 class="font-medium m-b-20">Sign In to Admin</h5>
    </div>
    <!-- Form -->
    <div class="row">
    <?php if(session()->has('message')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php echo e(session()->get('message')); ?>

        </div>
    <?php endif; ?>
        <div class="col-12">
            <form class="form-horizontal m-t-20" id="loginform" method="post" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ti-user"></i></span>
                    </div>
                    <input type="email" class="form-control form-control-lg" placeholder="Email" id="email" name="email">
                </div>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div id="email_alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php echo e($message); ?>

                </div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ti-pencil"></i></span>
                    </div>
                    <input type="password" class="form-control form-control-lg" placeholder="Password" id="password" name="password">
                </div>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div id="password_alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php echo e($message); ?>

                </div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="remember" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                            <label class="custom-control-label" for="remember">Remember me</label>
                            <a href="<?php echo e(route('password.request')); ?>" class="text-dark float-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center">
                    <div class="col-xs-12 p-b-20">
                        <button href="dashboard-classic.html" class="btn btn-block btn-lg btn-info" type="submit">Log In</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                        <div class="social">
                            <a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip" title="" data-original-title="Login with Facebook"> <i aria-hidden="true" class="fab  fa-facebook"></i> </a>
                            <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip" title="" data-original-title="Login with Google"> <i aria-hidden="true" class="fab  fa-google-plus"></i> </a>
                        </div>
                    </div>
                </div>
                <div class="form-group m-b-0 m-t-10">
                    <div class="col-sm-12 text-center">
                        Don't have an account? <a href="<?php echo e(route('register')); ?>" class="text-info m-l-5"><b>Sign Up</b></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();

    $("#email").on('focus', function() {
        if($("#email_alert")) {
            $("#email_alert").remove();
        }
        })

    $("#password").on('focus', function() {
        if($("#password_alert")) {
            $("#password_alert").remove();
        }
    })
</script>
<?php $__env->stopSection(); ?>
            
<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Projects\Laravel\Survey systems\survey_laravel\resources\views/auth/login.blade.php ENDPATH**/ ?>