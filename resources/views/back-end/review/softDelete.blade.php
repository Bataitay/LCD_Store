@extends('back-end.master')
@section('content')
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
                                    <h2 for="example-text-input" class="form-label">Manage Review</h2>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h2></h2>
                            </div><br><br><br>
                            <div class="col-md-4 ">
                                <div class="md-3 title_cate">
                                    <a href="{{ route('review.trash') }}"
                                        class="btn btn-secondary btn-rounded waves-effect waves-light ">
                                        <i class="fas fa-trash-alt"></i>
                                        Trash</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <table
                                class="table table-bordered dt-responsive nowrap text-center align-middle dataTable no-footer dtr-inline"
                                style="border-color: #ddd; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th width="17%">#</th>
                                        <th>Content </th>
                                        <th>Vote </th>
                                        <th>Status</th>
                                        <th>Product ID</th>
                                        <th>Customer ID</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reviews as $review)
                                    <tr class="review{{$review->id}}">
                                            <td>{{ $review->id }}</td>
                                            <td>{{ $review->content }}</td>
                                            <td>{{ $review->vote }}
                                                <i class="fas fa-star text-warning "></i>
                                            </td>
                                            <td>
                                                @if ($review->status == 0)
                                                    <a href="{{ route('review.changeStatus', $review->id) }}"
                                                        class="btn btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('review.changeStatus', $review->id) }}"
                                                        class="btn btn-warning">
                                                        <i class="fas fa-eye-slash"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{ $review->product_id }}</td>
                                            <td>{{ $review->customer_id }}</td>
                                            <td>
                                                <a data-url="{{ route('review.restore', $review->id) }}"
                                                    data-id="{{ $review->id }}" class="btn btn-info sm restoreReview">
                                                    <i class="fas fa-redo"></i>
                                                </a>
                                                <a data-url="{{ route('review.forceDelete', $review->id) }}"
                                                    data-id="{{ $review->id }}"
                                                    class="btn btn-danger sm forceDeleteReview">
                                                    <i class=" fas fa-trash-alt "></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
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
            $('.forceDeleteReview').on('click', forceDeleteReview);
            $('.restoreReview').on('click', restoreReview);
        })

        function restoreReview(event) {
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
                                _token: "{{ csrf_token() }}",
                            },
                            dataType: 'json',
                            success: function(data, ) {
                                if (data.status === 1) {
                                    swal("Successfully!!!", {
                                        icon: "success",
                                    })
                                    $('.review' + id).remove()
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

        function forceDeleteReview(event) {
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
                                _token: "{{ csrf_token() }}",
                            },
                            dataType: 'json',
                            success: function(data, ) {
                                if (data.status === 1) {
                                    swal("Poof! Your imaginary file has been deleted!", {
                                        icon: "success",
                                    })
                                    $('.review' + id).remove()
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
@endsection
