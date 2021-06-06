<?php $__env->startSection('styles'); ?>
<link href="<?php echo e(asset('libs/datatables.net-bs4/css/dataTables.bootstrap4.css')); ?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('libs/sweetalert2/dist/sweetalert2.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Alert with content -->
<?php if($message = Session::get('message')): ?>
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong><?php echo e($message); ?></strong>
</div>
<?php endif; ?>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">All Ratings</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('user.dashboard')); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Rating</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex no-block justify-content-end align-items-center">
                <div class="ml-auto">
                    <div class="btn-group">
                        <a href="<?php echo e(route('user.rating.create')); ?>" class="btn waves-effect waves-light btn-outline-light"><i class="fa fa-plus"></i>Create New Rating </a>
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
                <div class="card-body">
                    <div class="table-responsive m-t-20">
                        <table class="table table-bordered m-b-20" id="rating_list" data-page-length='10'>
                            <thead>
                                <tr class="border-0">
                                    <th class="border-0">Title</th>
                                    <th class="border-0">Smiles</th>
                                    <th class="border-0">Score</th>
                                    <th class="border-0">Date</th>
                                    <th class="border-0">Status</th>
                                    <th class="border-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $ratings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td style="vertical-align: middle;"><?php echo e($rating->name); ?></td>
                                    <td style="vertical-align: middle;">
                                        <div class="d-flex no-block align-items-center">
                                            <div class="mr-3">
                                                <?php if($rating->content): ?>
                                                <img src="<?php echo e(asset('storage/' . $rating->content)); ?>" alt="user" class="rounded-circle" width="45" />
                                                <?php else: ?>
                                                <img src="<?php echo e(asset('images/smiles.png')); ?>" alt="user" class="rounded-circle" width="50" height="50" style="background-color: #fff;"/>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <?php echo e($rating->score); ?>

                                    </td>
                                    <td style="vertical-align: middle;"><?php echo e($rating->created_at); ?></td>
                                    <td style="vertical-align: middle;">
                                        <?php if($rating->active == 0): ?>
                                        <i class="fa fa-circle text-danger" data-toggle="tooltip" data-placement="top" title="In Active"></i>
                                        <?php else: ?>
                                        <i class="fa fa-circle text-success" data-toggle="tooltip" data-placement="top" title="Active"></i>
                                        <?php endif; ?>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <div class="popover-icon">
                                            <a class="btn btn-success btn-circle" href="<?php echo e(route('user.rating.edit', ['rating_id' => $rating->id ])); ?>"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-danger btn-circle" href="javascript:void(0)" onclick="delete_rating(<?php echo e($rating->id); ?>)"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('extra-libs/DataTables/datatables.min.js')); ?>"></script>
<script src="<?php echo e(asset('libs/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>

<script>
    var base_url = "<?php echo e(url('/')); ?>";
</script>
<script src="<?php echo e(asset('js/pages/user/rating.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Projects\Laravel\Survey systems\survey_laravel\resources\views/user/rating/list.blade.php ENDPATH**/ ?>