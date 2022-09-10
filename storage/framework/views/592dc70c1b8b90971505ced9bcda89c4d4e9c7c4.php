<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-4">
                                <div class="md-3">
                                    <h2 for="example-text-input" class="form-label">Trashed</h2>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h2></h2>
                            </div><br><br><br>
                            <div class="col-md-4 d-flex">
                                <div class="md-3 title_cate">
                                    <a href="<?php echo e(route('product.index')); ?>"
                                        class="btn btn-danger btn-rounded waves-effect waves-light ">
                                        <i class=" fas fa-reply-all"></i>
                                        All Prodcuts</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <table
                                class="table table-bordered dt-responsive nowrap text-center align-middle dataTable no-footer dtr-inline"
                                style="border-color: #ddd; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th width="7%">Id</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Sale_Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="addRow" class="addRow">

                                </tbody>

                                <tbody id="myTable">
                                    <?php if(!$products->count()): ?>
                                        <tr>
                                            <td colspan="7">No data yet...</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="item-<?php echo e($product->id); ?>">
                                                <td><?php echo e($product->id); ?></td>
                                                <td><?php echo e($product->name); ?></td>
                                                <td><?php echo e(number_format($product->price)); ?></td>
                                                <td><?php echo e($product->quantity); ?></td>
                                                <td><?php echo e(number_format($product->price - ($product->sale_price / 100) * $product->price)); ?>

                                                </td>
                                                <td><?php echo e($product->status); ?></td>
                                                <td>
                                                    <a href="<?php echo e(route('product.restore', $product->id)); ?>"
                                                        onclick="return confirm('Do you want restore?')"
                                                        class="btn btn-info sm">
                                                        <i class="fas fa-redo"></i>
                                                    </a>
                                                    <a data-href="<?php echo e(route('product.force_destroy', $product->id)); ?>"
                                                        id="<?php echo e($product->id); ?>" class="btn btn-danger sm deleteIcon">
                                                        <i class=" fas fa-trash-alt "></i>
                                                    </a>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-7">
                                    Show <?php echo e($products->perPage()); ?> - <?php echo e($products->currentPage()); ?> of
                                    <?php echo e($products->lastPage()); ?>

                                </div>
                                <div class="col-5">
                                    <div class="btn-group float-end">
                                        <?php echo e($products->links()); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).on('click', '.deleteIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let href = $(this).data('href');
                let csrf = '<?php echo e(csrf_token()); ?>';
                console.log(id);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: href,
                            method: 'delete',
                            data: {
                                _token: csrf
                            },
                            success: function(res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                                $('.item-' + id).remove();
                            }
                        });
                    }
                })
            });
        </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('back-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\LCD-Store\resources\views/back-end/product/softDelete.blade.php ENDPATH**/ ?>