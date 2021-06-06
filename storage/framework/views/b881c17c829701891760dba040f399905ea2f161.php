<?php $__env->startSection('styles'); ?>
    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div>
    <div class="logo">
        <span class="db"><img src="<?php echo e(asset('images/logo-icon.png')); ?>" alt="logo" /></span>
        <h5 class="font-medium m-b-20">Sign Up to Admin</h5>
    </div>
    <!-- Form -->
    <div class="row">
        <div class="col-12">
            <form class="form-horizontal m-t-20" method="POST" action="<?php echo e(route('register')); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-group row ">
                    <div class="col-12 ">
                        <input class="form-control form-control-lg" type="text" required="" name="firstName" id="firstName" placeholder="First Name">
                        <?php $__errorArgs = ['firstName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div id="firstname_alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <?php echo e($message); ?>

                            </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="form-group row ">
                    <div class="col-12 ">
                        <input class="form-control form-control-lg" type="text" required="" name="lastName" id="lastName" placeholder="Last Name">
                        <?php $__errorArgs = ['lastName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div id="lastname_alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <?php echo e($message); ?>

                            </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12 ">
                        <input class="form-control form-control-lg" type="text" required="" name="email" id="email" placeholder="Email">
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
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12 ">
                        <input class="form-control form-control-lg" type="password" required="" name="password" id="password" placeholder="Password">
                        <?php $__errorArgs = ['password'];
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
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12 ">
                        <input class="form-control form-control-lg" type="password" required="" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 ">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">I agree to all <a href="javascript:void(0)">Terms</a></label>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center ">
                    <div class="col-xs-12 p-b-20 ">
                        <button href="dashboard-classic.html" class="btn btn-block btn-lg btn-info " type="submit ">SIGN UP</button>
                    </div>
                </div>
                <div class="form-group m-b-0 m-t-10 ">
                    <div class="col-sm-12 text-center ">
                        Already have an account? <a href="<?php echo e(route('login')); ?>" class="text-info m-l-5 "><b>Sign In</b></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>            
<script>
    $('[data-toggle="tooltip "]').tooltip();
    $(".preloader ").fadeOut();

    $("#firstName").on('focus', function() {
        if($("#firstname_alert")) {
            $("#firstname_alert").remove();
        }
    })

    $("#lastName").on('focus', function() {
        if($("#lastname_alert")) {
            $("#lastname_alert").remove();
        }
    })

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

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Projects\Laravel\Survey systems\survey_laravel\resources\views/auth/register.blade.php ENDPATH**/ ?>