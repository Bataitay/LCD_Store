
<?php $__env->startSection('content'); ?>
    <style>
        .title_cate {
            margin-left: 30px;
        }

        .autocomplete-suggestions {
            border: 1px solid #999;
            background: #FFF;
            overflow: auto;
        }

        .autocomplete-suggestion {
            padding: 2px 5px;
            white-space: nowrap;
            overflow: hidden;
        }

        .autocomplete-selected {
            background: #F0F0F0;
        }

        /*.autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }*/
        .autocomplete-group {
            padding: 2px 5px;
        }

        .autocomplete-group strong {
            display: block;
            border-bottom: 1px solid #000;
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
                            <div class="col-md-12 d-flex">
                                <div class="md-3 title_cate">
                                    <a href="<?php echo e(route('brand.create')); ?>"
                                        class="btn btn-secondary btn-rounded waves-effect waves-light ">
                                        <i class="mdi mdi-plus-circle addeventmore "></i>
                                        Add Category</a>
                                </div>
                                <div class="md-3 title_cate d-flex">
                                    <form action="<?php echo e(route('brand.search')); ?>" >

                                        <div class="form-outline">
                                            <div class="form-group">
                                                <input class="form-control" id="keyword" type="text" placeholder="Search"
                                                    aria-label="Search" name="keySearch">
                                            </div>

                                        </div>
                                        <button type="submit" class="btn btn-primary  waves-effect waves-light searchBrand">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="md-3 title_cate">
                                <a href="<?php echo e(route('brand.trash')); ?>"
                                    class="btn btn-danger btn-rounded waves-effect waves-light ">
                                    <i class=" fas fa-trash-alt"></i>
                                    Trash</a>
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
                                <tbody id="myTbody">
                                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="list-brand">
                                            <td><?php echo e($brand->id); ?></td>
                                            <td>
                                                <a href="<?php echo e(route('brand.show', $brand->id)); ?>"><?php echo e($brand->name); ?></a>
                                            </td>
                                            <td> <?php if(empty($brand->logo)): ?>
                                                    <p>not yet update logo</p>
                                                <?php endif; ?>
                                                <img src="<?php echo e(asset($brand->logo)); ?>" alt="" class="image_photo">

                                            </td>
                                            <td>
                                                <a href="<?php echo e(route('brand.show', $brand->id)); ?>" class="btn btn-primary sm ">
                                                    <i class="fas fa-eye-slash"></i>
                                                </a>
                                                <a href="<?php echo e(route('brand.edit', $brand->id)); ?>" class="btn btn-info sm">
                                                    <i class="fas fa-edit "></i>
                                                </a>
                                                <a data-url="<?php echo e(route('brand.destroy', $brand->id)); ?>"
                                                    data-id="<?php echo e($brand->id); ?>" class="btn btn-warning sm deleteBrand">
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


    <script>
        $(function() {
            $('.deleteBrand').on('click', deleteBrand)

        })

        function deleteBrand(event) {
            event.preventDefault();
            let url = $(this).data('url');
            let id = $(this).data('id');
            swal({
                    title: "Are you sure delete?",
                    text: "Once deleted,you can restore this file in recycle bin!",
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
    <script>
        $(function() {
            $("#keyword").autocomplete({
                serviceUrl: 'search',
                paramName: "keyword",
                onSelect: function(suggestion) {
                    $("#keyword").val(suggestion.value);
                },
                transformResult: function(response) {
                    return {
                        suggestions: $.map($.parseJSON(response), function(item) {
                            return {
                                value: item.name,
                            };
                        })
                    };
                },

            });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('back-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\LCD-Store\resources\views/back-end/brand/index.blade.php ENDPATH**/ ?>