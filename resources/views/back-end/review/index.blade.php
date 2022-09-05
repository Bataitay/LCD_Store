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
                            <div class="col-md-12 d-flex">
                                <div class="md-3 title_cate">
                                    {{-- <a href="{{ route('category.create') }}"
                                        class="btn btn-secondary btn-rounded waves-effect waves-light ">
                                        <i class="mdi mdi-plus-circle addeventmore "></i>
                                        Add Category</a> --}}
                                </div>
                                <div class="md-3 title_cate">
                                    <a href="{{ route('review.trash') }}"
                                        class="btn btn-danger btn-rounded waves-effect waves-light ">
                                        <i class=" fas fa-trash-alt"></i>
                                        Trash</a>
                                </div>
                                <div class="md-3 title_cate d-flex">
                                    <div class="form-outline">
                                            <form action="">
                                                <input class="form-control" id="keyword" type="text" placeholder="Search"
                                                aria-label="Search" name="keySearch">
                                        </div>
                                        <button type="submit" class="btn btn-primary  waves-effect waves-light searchReview">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </form>
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
                                        <tr>
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
                                                <a href="{{ route('review.show', $review->id) }}"
                                                    class="btn btn-primary sm ">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('review.edit', $review->id) }}" class="btn btn-info sm">
                                                    <i class="fas fa-edit "></i>
                                                </a>
                                                <a data-url="{{ route('review.destroy', $review->id) }}"
                                                    data-id="{{ $review->id }}" class="btn btn-warning sm deleteReview">
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
            $('.deleteReview').on('click', deleteReview)
        })

        function deleteReview(event) {
            event.preventDefault();
            let url = $(this).data('url');
            alert(url);
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
                                _token: "{{ csrf_token() }}",
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
                serviceUrl: 'review/search',
                paramName: "keyword",
                onSelect: function(suggestion) {
                    $("#keyword").val(suggestion.value);
                },
                transformResult: function(response) {
                    
                    return {
                        suggestions: $.map($.parseJSON(response), function(item) {
                            return {
                                value: item.content,
                            };
                        })
                    };
                },

            });
        })
    </script>
@endsection
