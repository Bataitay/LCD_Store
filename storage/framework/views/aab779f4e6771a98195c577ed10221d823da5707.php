
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
                                    <h2 for="example-text-input" class="form-label">Add Role</h2>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo e(route('role.store')); ?> " method="POST" enctype="multipart/form-data"
                                class="form">
                                <?php echo csrf_field(); ?>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Role Name</label>
                                    <input name="name" value="<?php echo e(old('name')); ?>" type="input" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        id="name">
                                    <span class="text-danger"><?php echo e($errors->first('name')); ?></span>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Permissions</label>
                                </div>
                                <div class="form-check">
                                    <input name="Permissions" type="checkbox" class="form-check-input checkbox_all"
                                        id="Permissions">
                                    <label for="Permissions" class="form-label">Full Permissions</label>
                                </div>
                                <div class="custom-control custom-checkbox row d-flex mb-4">
                                    <?php $__currentLoopData = $parentPermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parentPermission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="single-card col-md-12">
                                            <div class="card-header">
                                                <input name="Permissions" type="checkbox"
                                                    class="form-check-input checkbox_parent checkbox_all_childrent"
                                                    id="Permissions<?php echo e($parentPermission->id); ?>">
                                                <label for="Permissions<?php echo e($parentPermission->id); ?>"
                                                    class="form-label"><?php echo e($parentPermission->name); ?></label>
                                            </div>
                                            <div class="card-body row d-flex">
                                                <?php $__currentLoopData = $parentPermission->childrentPermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childrentPermission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="form-check col-2">
                                                        <input name="permissions_id[]"
                                                            <?php if(old('permissions_id')): ?>
                                                                <?php echo e(in_array($childrentPermission->id, old('permissions_id')) ? 'checked' : ''); ?>

                                                            <?php endif; ?>
                                                            value="<?php echo e($childrentPermission->id); ?>" type="checkbox"
                                                            class="form-check-input checkbox_childrent checkbox_all_childrent"
                                                            id="Permissions<?php echo e($childrentPermission->id); ?>">
                                                        <label for="Permissions<?php echo e($childrentPermission->id); ?>"
                                                            class="form-label"><?php echo e($childrentPermission->name); ?></label>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <a href="<?php echo e(route('role.index')); ?>" class="btn btn-danger">Back</a>
                                <button type="submit" class="btn btn-primary">Add Role</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.checkbox_parent').on('click', function() {
            $(this).parents('.single-card').find('.checkbox_childrent').prop('checked', $(this).prop('checked'))
        });
        $('.checkbox_all').on('click', function() {
            $(this).parents('.form').find('.checkbox_all_childrent').prop('checked', $(this).prop('checked'))
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('back-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\LCD-Store\resources\views/back-end/role/add.blade.php ENDPATH**/ ?>