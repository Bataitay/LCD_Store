
<?php $__env->startSection('content'); ?>
    <style>
        .title_cate {
            margin-left: 20px;
        }
        .image_photo{
            width: 45px;
            height: 45px;
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
                                    <h2 for="example-text-input" class="form-label">Trashed</h2>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h2></h2>
                            </div><br><br><br>
                            <div class="col-md-4 d-flex">
                                <div class="md-3 title_cate">
                                    <a href="<?php echo e(route('user.index')); ?>"
                                        class="btn btn-danger btn-rounded waves-effect waves-light ">
                                        <i class=" fas fa-reply-all"></i>
                                        All Employee</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <table
                                class="table table-bordered dt-responsive nowrap text-center align-middle dataTable no-footer dtr-inline"
                                style="border-color: #ddd; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th width="5%">Id</th>
                                        <th width="15%">Name</th>
                                        <th width="15%">Phone</th>
                                        <th width="20%">E-mail </th>
                                        <th width="25%">Address</th>
                                        <th width="20%">Action</th>
                                    </tr>
                                </thead>

                                <tbody id="addRow" class="addRow">

                                </tbody>

                                <tbody id="myTable">
                                    <?php if(!$users->count()): ?>
                                        <tr>
                                            <td colspan="6">No data yet...</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="item-<?php echo e($user->id); ?>">
                                                <td><?php echo e($user->id); ?></td>
                                                <td class="d-flex align-items-center ">
                                                    <div class="rounded-circle ">
                                                        <img class=" image_photo rounded-circle " src="<?php echo e(asset('assets/images/auth-bg.jpg')); ?>">
                                                    </div>
                                                    &nbsp;
                                                    <div>
                                                        <span><?php echo e($user->name); ?></span>
                                                    </div>
                                                </td>
                                                <td><?php echo e($user->phone); ?></td>
                                                <td><?php echo e($user->email); ?></td>
                                                <td><?php echo e($user->address); ?></td>
                                                <td>
                                                    <a href="<?php echo e(route('user.restore', $user->id)); ?>"
                                                        onclick="return confirm('Do you want restore?')"
                                                        class="btn btn-info sm">
                                                        <i class="fas fa-redo"></i>
                                                    </a>
                                                    <a data-href="<?php echo e(route('user.force_destroy', $user->id)); ?>"
                                                        id="<?php echo e($user->id); ?>" class="btn btn-danger sm deleteIcon">
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
                                    Show <?php echo e($users->perPage()); ?> - <?php echo e($users->currentPage()); ?> of
                                    <?php echo e($users->lastPage()); ?>

                                </div>
                                <div class="col-5">
                                    <div class="btn-group float-end">
                                        <?php echo e($users->links()); ?>

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
    <?php if(isset($user)): ?>
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
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('back-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\LCD-Store\resources\views/back-end/employee/sorfDelete.blade.php ENDPATH**/ ?>