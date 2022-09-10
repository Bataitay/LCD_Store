

<div class="modal fade" id="searchModal" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <form method="get">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">On-demand search</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label" for="nameVi">Categories</label>
                                <select class=" form-control" name="category_id" id="category_id" style="width: 470px">
                                    <option value="">Open this select menu</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>">
                                            <?php echo e($category->name); ?> </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="name">Price range
                                </label>
                                <input type="number" value="<?php echo e(request()->startPrice); ?>" class="form-control"
                                    name="startPrice" id="startPrice" placeholder="$ From">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label class="form-label" for="name">.</label>
                                <input type="text" value="<?php echo e(request()->endPrice); ?>" class="form-control" name="endPrice"
                                    id="endPrice" placeholder="$ To">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label class="form-label" for="quantity">Time range
                                </label>
                                <input type="date" name="start_date" placeholder="dd/mm/yyyy"
                                    class="form-control start_date" value="<?php echo e(request()->start_date); ?>"
                                    min="<?php echo e(Carbon\Carbon::now()->firstOfYear()->format('d-m-Y')); ?>"
                                    max="<?php echo e(Carbon\Carbon::now()->lastOfYear()->format('d-m-Y')); ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label class="form-label" for="quantity">.</label>
                                <input type="date" class="form-control" name="end_date" placeholder="dd/mm/yyyy"
                                    class="form-control end_date" value="<?php echo e(request()->end_date); ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <p><b>Status:</b></p>
                                <input type="radio" id="html" checked name="status" value="0">
                                <label for="html">Hide </label><br>
                                <input type="radio" id="css" checked name="status" value="1">
                                <label for="css">Show</label><br>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

    </div>
</div>

<?php /**PATH C:\laragon\www\LCD-Store\resources\views/back-end/product/advanceSearch.blade.php ENDPATH**/ ?>