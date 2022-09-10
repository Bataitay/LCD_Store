
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
                                    <h2 for="example-text-input" class="form-label">Manage Brand</h2>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h2></h2>
                            </div><br><br><br>
                            <div class="col-md-4 ">
                                <div class="md-3 title_cate">
                                    <a href="<?php echo e(route('brand.create')); ?>"
                                        class="btn btn-secondary btn-rounded waves-effect waves-light ">
                                        <i class="mdi mdi-plus-circle addeventmore "></i>
                                        Add Brand</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <table
                                class="table table-bordered dt-responsive nowrap text-center align-middle dataTable no-footer dtr-inline"
                                style="border-color: #ddd; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th width="17%">Id</th>
                                        <th>Name</th>
                                        <th>Logo</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="addRow" class="addRow">

                                </tbody>

                                <tbody>
                                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($brand->id); ?></td>
                                            <td><?php echo e($brand->name); ?></td>
                                            <td> <?php if(empty($brand->logo)): ?>
                                                    <p>not yet update logo</p>
                                                <?php endif; ?>
                                                <img src="<?php echo e(asset($brand->logo)); ?>" alt="">

                                            </td>
                                            <td>
                                                <a data-url="<?php echo e(route('brand.restore', $brand->id)); ?>"
                                                    data-id="<?php echo e($brand->id); ?>" class="btn btn-info sm restoreBrand">
                                                    <i class="fas fa-redo"></i>
                                                </a>
                                                <a data-url="<?php echo e(route('brand.forceDelete', $brand->id)); ?>"
                                                    data-id="<?php echo e($brand->id); ?>"
                                                    class="btn btn-danger sm forceDeleteBrand">
                                                    <i class=" fas fa-trash-alt "></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(function() {
            $('.forceDeleteBrand').on('click', forceDeleteBrand);
            $('.restoreBrand').on('click', restoreBrand);
        })

        function restoreBrand(event) {
            event.preventDefault();
            let url = $(this).data('url');
            let id = $(this).data('id');
            swal({
                    title: "Are you sure restore?",
                    text: "If restore,You can view in list brand!",
                    icon: "success",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        jQuery.ajax({
                            type: "post",
                            'url': url,
                            'data': {
                                id: id,
                                _token: "<?php echo e(csrf_token()); ?>",
                            },
                            dataType: 'json',
                            success: function(data, ) {
                                if (data.status === 1) {
                                    swal("Successfully!!!", {
                                        icon: "success",
                                    })
                                    window.location.reload();
                                }
                                if (data.status === 0) {
                                    console.log(data);
                                    alert(data.messages)
                                }
                            }
                        });
                    } else {
                        swal("Cancel the process!!");
                    }
                })
        }



        function forceDeleteBrand(event) {
            event.preventDefault();
            let url = $(this).data('url');
            let id = $(this).data('id');
            swal({
                    title: "Are you sure delete?",
                    text: "If deleted,You cannot recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        jQuery.ajax({
                            type: "delete",
                            'url': url,
                            'data': {
                                id: id,
                                _token: "<?php echo e(csrf_token()); ?>",
                            },
                            dataType: 'json',
                            success: function(data, ) {
                                if (data.status === 1) {
                                    swal("Poof! Your imaginary file has been deleted!", {
                                        icon: "success",
                                    })
                                    window.location.reload();
                                }
                                if (data.status === 0) {
                                    console.log(data);
                                    alert(data.messages)
                                }
                            }
                        });
                    } else {
                        swal("Cancel the process!!");
                    }
                })
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('back-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\LCD-Store\resources\views/back-end/brand/softDelete.blade.php ENDPATH**/ ?>