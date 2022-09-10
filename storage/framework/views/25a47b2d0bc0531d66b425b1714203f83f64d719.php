<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Dashboard | Upcube - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset('assets/images/favicon.ico')); ?>">

    <!-- jquery.vectormap css -->
    

    <!-- DataTables -->
    <link href="<?php echo e(asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="<?php echo e(asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')); ?>"
        rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Bootstrap Css -->
    <link href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo e(asset('assets/css/icons.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/css/genaral.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo e(asset('assets/css/app.min.css')); ?>" id="app-style" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.10/jquery.autocomplete.min.js">
    </script>

    <!-- Bootstrap Css -->
    <link href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/css/genaral.css')); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo e(asset('assets/css/icons.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo e(asset('assets/css/app.min.css')); ?>" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.10/jquery.autocomplete.min.js">
    </script>
    <?php echo $__env->yieldContent('css'); ?>
</head>

<body data-topbar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">



        <?php echo $__env->make('back-end.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- ========== Left Sidebar Start ========== -->

        <?php echo $__env->make('back-end.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">

                
                <?php echo $__env->yieldContent('content'); ?>


            </div>
            <!-- End Page-content -->
            <?php echo $__env->make('back-end.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



        </div>
        <!-- end main content-->

    </div>

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="<?php echo e(asset('assets/libs/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/libs/metismenu/metisMenu.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/libs/simplebar/simplebar.min.js')); ?>"></script>
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet">
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.min.js"></script>
    <script src="<?php echo e(asset('assets/libs/node-waves/waves.min.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.10/jquery.autocomplete.min.js">
    </script>
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        <?php if(Session::has('message')): ?>
            var type = "<?php echo e(Session::get('alert-type', 'info')); ?>"
            switch (type) {
                case 'info':
                    toastr.info(" <?php echo e(Session::get('message')); ?> ");
                    break;
                case 'success':
                    toastr.success(" <?php echo e(Session::get('message')); ?> ");
                    break;
                case 'warning':
                    toastr.warning(" <?php echo e(Session::get('message')); ?> ");
                    break;
                case 'error':
                    toastr.error(" <?php echo e(Session::get('message')); ?> ");
                    break;
            }
        <?php endif; ?>
    </script>
    <script>
        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginImageResize,
            FilePondPluginImageTransform
        );
        const inputElement = document.getElementById('filepond');
        const pond = FilePond.create(inputElement);
        FilePond.setOptions({
            server: {
                url: '<?php echo e(route('user.addAvatar')); ?>',
                process: {
                    onload: (res) => {
                        var obj = JSON.parse(res);
                        $('#avatar').val(obj.file);
                    }
                },
                revert: '/',
                type: 'json',
                patch: "?patch=",
                headers: {
                    'pond': pond,
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
            }
        });
    </script>
    <script>
        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginImageResize,
            FilePondPluginImageTransform
        );
        const inputElement = document.getElementById('filepond');
        const pond = FilePond.create(inputElement);
        FilePond.setOptions({
            server: {
                url: '<?php echo e(route('user.updateAvatar')); ?>',
                process: {
                    onload: (res) => {
                        var obj = JSON.parse(res);
                        console.log(obj);
                        $('#avatar').val(obj.file);
                    }
                },
                revert: '/',
                type: 'json',
                patch: "?patch=",
                headers: {
                    'pond': pond,
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
            }
        });
    </script>
    <!-- apexcharts -->
    

    <!-- jquery.vectormap map -->
    
    

    <!-- Required datatable js -->
    
    

    <!-- Responsive examples -->
    <script src="<?php echo e(asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')); ?>"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
    <!--tinymce js-->
    <script src="<?php echo e(asset('assets/libs/tinymce/tinymce.min.js')); ?>"></script>

    <!-- init js -->
    <script src="<?php echo e(asset('assets/js/pages/form-editor.init.js')); ?>"></script>

    <script src="<?php echo e(asset('assets/js/pages/dashboard.init.js')); ?>"></script>

    <script src="<?php echo e(asset('assets/js/uploadFile.js')); ?>"></script>
    <!-- App js -->
    <script src="<?php echo e(asset('assets/js/app.js')); ?>"></script>
    <?php echo $__env->yieldContent('js'); ?>
</body>

</html>
<?php /**PATH C:\laragon\www\LCD-Store\resources\views/back-end/master.blade.php ENDPATH**/ ?>