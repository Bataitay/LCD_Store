<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Edit category</h4><br>
                            <form method="post" action="<?php echo e(route('category.update', $category->id)); ?>" id="myForm">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label ">Name</label>
                                    <div class="form-group col-sm-10">
                                        <input name="name" class="form-control" type="text"
                                            value="<?php echo e($category->name); ?>">
                                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text text-danger"><i class=" ri-spam-2-line"></i></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <br><br>
                                        <a class="btn btn-danger waves-effect waves-light"
                                            href="<?php echo e(route('category.index')); ?>">Close</a>
                                        <input type="submit" class="btn btn-info waves-effect waves-light" value="Edit...">
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('back-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\LCD-Store\resources\views/back-end/category/edit.blade.php ENDPATH**/ ?>