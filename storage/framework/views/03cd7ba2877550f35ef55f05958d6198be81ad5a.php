<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('libs/select2/dist/css/select2.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('libs/sweetalert2/dist/sweetalert2.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('libs/bootstrap-duallistbox/dist/bootstrap-duallistbox.min.css')); ?>">

<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #272b34!important;
        border: 1px solid #272b34!important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
        color: #FFF!important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #fff!important;
    }

    .select2-container--classic .select2-selection--multiple .select2-selection__choice, .select2-container--default .select2-selection--multiple .select2-selection__choice, .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        background-color: #272b34!important;
        border-color: #272b34!important;
    }

    .box1 select, .box2 select {
        background-color: #272b34!important;
        color: #fff!important;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php if($errors->any()): ?>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <input type="hidden" class="error-message" value="<?php echo e($error); ?>">
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Create New Survey</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('user.dashboard')); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create New Survey</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex no-block justify-content-end align-items-center">
                <div class="ml-auto">
                    <div class="btn-group">
                        <a href="<?php echo e(route('user.survey.list')); ?>" class="btn waves-effect waves-light btn-outline-light"><i class="fa fa-reply"></i>Go to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12">
            <div class="card">
                <form id="survey_form" name="survey_form" action="<?php echo e(route('user.survey.save')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="action-form m-b-0 text-right">
                                    <button type="button" class="btn btn-info waves-effect waves-light" id="save_btn">Save</button>
                                    <button type="button" class="btn btn-dark waves-effect waves-light">Cancel</button>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="name" class="control-label col-form-label">Name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="mdi mdi-stackexchange"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Survey Name" id="name" name="name" require>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="control-label col-form-label">Branch</label>
                                    <div class="input-group">
                                        <select class="select2 form-control custom-select" id="branch" name="branch" style="width: 100%; height:36px;">
                                            <option value="">All Branches</option>
                                            <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($branch->id); ?>"><?php echo e($branch->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="control-label col-form-label">Description</label>
                                    <div class="input-group">
                                        <textarea class="form-control" id="description" name="description" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="languages" class="control-label col-form-label">Language</label>
                                    <select class="select2-with-menu-bg form-control" requrie id="languages" name="languages[]" multiple="multiple" data-text-color="text-white"  data-text-variation="white" data-bgcolor="black" data-bgcolor-variation="darken-3">
                                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($lg->id); ?>" data-flag="<?php echo e($lg->code); ?>"> <?php echo e($lg->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div id="questions_wrapper" class="col-md-12">
                                <div id="questiondiv_0" class="row">
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label for="question_description_0" class="control-label col-form-label">Question</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="question_description_0" name="question_description[]" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="question_class_0" class="control-label col-form-label">Class</label>
                                            <select class="form-control" id="question_class_0" name="question_class[]" required>
                                                <option value="1"> About our employee</option>
                                                <option value="2"> About our service</option>
                                                <option value="3"> About our environment</option>
                                                <option value="4"> None of the above</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="question_cat_0" class="control-label col-form-label">Answer Kind</label>
                                            <select class="form-control" id="question_cat_0" name="question_cat[]" required>
                                                <?php $__currentLoopData = $ratingcats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <div class="action-form m-b-0 text-left" style="margin-top: 35px;">
                                                <button type="button" key="0" id="create_new_answer_0" class="btn btn-success" style="margin-right:20px;" onclick="create_new_answer(0)">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="answer_wrapper_0"></div>
                                </div>
                                <hr />
                            </div>
                    
                            <div class="col-md-12">
                                <div class="action-form m-b-0 text-left">
                                    <button type="button" id="create_new_question" class="btn btn-primary waves-effect waves-light"><i class="fa fa-plus"></i>Create New Questions</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Column -->
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('libs/select2/dist/js/select2.full.min.js')); ?>"></script>
<script src="<?php echo e(asset('libs/select2/dist/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('libs/bootstrap-duallistbox/dist/jquery.bootstrap-duallistbox.min.js')); ?>"></script>
<script src="<?php echo e(asset('libs/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>

<script>
    var smiles = <?php print_r(json_encode($ratings)); ?>;
    var base_url = "<?php echo e(url('/')); ?>";
</script>
<script src="<?php echo e(asset('js/pages/user/survey.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Projects\Laravel\Survey systems\survey_laravel\resources\views/user/survey/create.blade.php ENDPATH**/ ?>