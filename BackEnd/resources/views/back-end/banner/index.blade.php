@extends('back-end.master')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/custom/banner/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/custom/banner/css/style.css') }}">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-4">
                                <div class="md-3">
                                    <h2 for="example-text-input" class="form-label">Banner Management</h2>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h2></h2>
                            </div>
                            <div class="col-md-12 d-flex">
                                @can('Add_Banner', 'Add_Banner')
                                    <div class="md-3 title_cate">
                                        <a href="{{ route('banner.create') }}"
                                            class="btn btn-secondary btn-rounded waves-effect waves-light ">
                                            <i class="mdi mdi-plus-circle addeventmore "></i>
                                            Add Banner</a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="featured-carousel owl-carousel">
                                        @foreach ($banners as $banner)
                                            <div class="item item-{{ $banner->id }}">
                                                <div class="blog-entry">
                                                    <a href="" class="block-20 d-flex align-items-start"
                                                        style="background-image: url({{ asset($banner->image) }});">
                                                        <div class="meta-date text-center p-2">
                                                            <span class="day">#{{ $banner->id }}</span>
                                                        </div>
                                                    </a>
                                                    <div class="border border-top-0 p-4">
                                                        <div class="align-items-center mt-2 d-flex justify-content-center">
                                                            <div>
                                                                @can('Edit_Banner', 'Edit_Banner')
                                                                    <a data-href="{{ route('banner.updatestatus', $banner->id) }}"
                                                                        id="{{ $banner->id }}"
                                                                        data-status="{{ $banner->status }}"
                                                                        style="background-color: #0f9cf3;"
                                                                        class="btn ml-2 updateStatus">
                                                                        <i
                                                                            class="fas text-white iconStatus{{ $banner->id }} {{ $banner->status ? 'fa-eye' : 'fa-eye-slash' }}"></i>
                                                                    </a>
                                                                    <a href="{{ route('banner.edit', $banner->id) }}"
                                                                        style="background-color:#0097a7;"
                                                                        class="btn ml-2"><i
                                                                            class="fas text-white fa-edit "></i></a>
                                                                @endcan
                                                                @can('Delete_Banner', 'Delete_Banner')
                                                                    <a data-href="{{ route('banner.destroy', $banner->id) }}"
                                                                        id="{{ $banner->id }}"
                                                                        style="background-color:#f32f53;"
                                                                        class="btn ml-2 btn-danger sm deleteIcon"><i
                                                                            class=" fas text-white fa-trash-alt "></i></a>
                                                                @endcan
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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
@endsection
@section('js')
    <script src="{{ asset('assets/custom/banner/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/custom/banner/js/main.js') }}"></script>
    <script>
        $(document).on('click', '.updateStatus', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            let status = $(this).data('status');
            let href = $(this).data('href') + `/` + status;
            let csrf = '{{ csrf_token() }}';
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (status) {
                    $(this).data('status', 0);
                    $(`.iconStatus${id}`).removeClass('fa-eye');
                    $(`.iconStatus${id}`).addClass('fa-eye-slash');
                } else {
                    $(this).data('status', 1);
                    $(`.iconStatus${id}`).removeClass('fa-eye-slash');
                    $(`.iconStatus${id}`).addClass('fa-eye');
                }
                if (result.isConfirmed) {
                    $.ajax({
                        url: href,
                        method: 'post',
                        data: {
                            _token: csrf
                        },
                        success: function(res) {
                            Swal.fire(
                                'Updated!',
                                'Your file has been Updated.',
                                'success'
                            )
                        }
                    });
                }
            })
        });
        $(document).on('click', '.deleteIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            let href = $(this).data('href');
            let csrf = '{{ csrf_token() }}';
            console.log(href);
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
@endsection
