@extends('back-end.master')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons.min.css">
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
                                    <h2 for="example-text-input" class="form-label">Banner Manage</h2>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h2></h2>
                            </div>
                            <div class="col-md-12 d-flex">
                                <div class="md-3 title_cate">
                                    <a href="{{ route('banner.create') }}"
                                        class="btn btn-secondary btn-rounded waves-effect waves-light ">
                                        <i class="mdi mdi-plus-circle addeventmore "></i>
                                        Add Banner</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="featured-carousel owl-carousel">
                                        <div class="item">
                                            <div class="blog-entry">
                                                <a href="#" class="block-20 d-flex align-items-start">
                                                    <img src="{{ asset('assets\images\login-office.jpeg') }}" alt="">
                                                </a>
                                                <div class="text border border-top-0 p-4">
                                                    <div class="d-flex align-items-center mt-2">
                                                        <p class="mb-0"><a href="#" class="btn btn-primary">Read More <span
                                                                    class="ion-ios-arrow-round-forward"></span></a></p>
                                                        <p class="ml-auto meta2 mb-0">
                                                            <a href="#" class="mr-2">Admin</a>
                                                            <a href="#" class="meta-chat"><span class="ion-ios-chatboxes"></span> 3</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="blog-entry">
                                                <a href="#" class="block-20 d-flex align-items-start">
                                                    <img src="{{ asset('storage\uploads\TvaQdLB84l2V2ZSvG9J8pVQzyW5NFnmlzA82InHE.jpg') }}" alt="">
                                                </a>
                                                <div class="text border border-top-0 p-4">
                                                    <div class="d-flex align-items-center mt-2">
                                                        <p class="mb-0"><a href="#" class="btn btn-primary">Read More <span
                                                                    class="ion-ios-arrow-round-forward"></span></a></p>
                                                        <p class="ml-auto meta2 mb-0">
                                                            <a href="#" class="mr-2">Admin</a>
                                                            <a href="#" class="meta-chat"><span class="ion-ios-chatboxes"></span> 3</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="blog-entry">
                                                <a href="#" class="block-20 d-flex align-items-start">
                                                    <img src="{{ asset('storage\images\brand\1662215163.png') }}" alt="">
                                                </a>
                                                <div class="text border border-top-0 p-4">
                                                    <div class="d-flex align-items-center mt-2">
                                                        <p class="mb-0"><a href="#" class="btn btn-primary">Read More <span
                                                                    class="ion-ios-arrow-round-forward"></span></a></p>
                                                        <p class="ml-auto meta2 mb-0">
                                                            <a href="#" class="mr-2">Admin</a>
                                                            <a href="#" class="meta-chat"><span class="ion-ios-chatboxes"></span> 3</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
            // alert(href)
            let csrf = '{{ csrf_token() }}';
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
@section('js')
    <script src="{{ asset('assets/custom/banner/js/jquery.min.js')}}"></script>
	<script src="{{ asset('assets/custom/banner/js/owl.carousel.min.js')}}"></script>
	<script src="{{ asset('assets/custom/banner/js/main.js')}}"></script>
@endsection