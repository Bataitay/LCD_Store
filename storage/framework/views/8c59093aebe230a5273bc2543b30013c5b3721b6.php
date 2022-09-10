
<?php $__env->startSection('content'); ?>
    <style>
        .title_cate {
            margin-left: 30px;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-4">
                                <div class="md-3">
                                    <h2 for="example-text-input" class="form-label">Edit Role</h2>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo e(route('role.update', $role->id)); ?> " method="POST" enctype="multipart/form-data" >
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Role Name</label>
                                    <input name="name" value="<?php echo e($role->name); ?>" type="input" class="form-control" id="name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Permissions</label>
                                </div>
                                <div class="form-check">
                                    <input name="Permissions" type="checkbox" class="form-check-input" id="Permissions">
                                    <label for="Permissions" class="form-label">Full Permissions</label>
                                </div>
                                <div class="custom-control custom-checkbox row d-flex mb-4">
                                    <?php $__currentLoopData = $parentPermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parentPermission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="card col-md-12">
                                            <div class="card-header">
                                                <input name="Permissions" type="checkbox" class="form-check-input" id="Permissions<?php echo e($parentPermission->id); ?>">
                                                <label for="Permissions<?php echo e($parentPermission->id); ?>" class="form-label"><?php echo e($parentPermission->name); ?></label>
                                            </div>
                                            <div class="card-body row d-flex">
                                                <?php $__currentLoopData = $parentPermission->childrentPermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childrentPermission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="form-check col-2">
                                                    <input name="permissions_id[]" <?php echo e($permissionChecked->contains('id', $childrentPermission->id) ? 'checked' : ''); ?> value="<?php echo e($childrentPermission->id); ?>" type="checkbox" class="form-check-input" id="Permissions<?php echo e($childrentPermission->id); ?>">
                                                    <label for="Permissions<?php echo e($childrentPermission->id); ?>" class="form-label"><?php echo e($childrentPermission->name); ?></label>
                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div> 
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('back-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\LCD-Store\resources\views/back-end/role/edit.blade.php ENDPATH**/ ?>