@extends('back-end.master')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-4">
                                <div class="md-3">
                                    <h2 for="example-text-input" class="form-label">Manage Customer</h2>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h2></h2>
                            </div><br><br><br>
                            <div class="col-md-12 d-flex">
                                <div class="md-3 title_cate">
                                    <a href="{{ route('customer.create') }}"
                                        class="btn btn-secondary btn-rounded waves-effect waves-light ">
                                        <i class="mdi mdi-plus-circle addeventmore "></i>
                                        Add Customer</a>
                                </div>
                                <div class="md-3 title_cate">
                                    <a href="{{ route('customer.trash') }}"
                                        class="btn btn-danger btn-rounded waves-effect waves-light ">
                                        <i class=" fas fa-trash-alt"></i>
                                        Trash</a>
                                </div>
                                <div class="md-3 title_cate d-flex">
                                    <div class="form-outline">
                                            <form action="">
                                            <input type="search" value="{{request()->search}}" name="search" id="form1" class="form-control" />
                                        </div>
                                        <button type="submit" class="btn btn-primary  waves-effect waves-light ">
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
                                        <th>Full Name</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="addRow" class="addRow">

                                </tbody>

                                <tbody id="myTable">
                                    @if (!$customers->count())
                                        <tr>
                                            <td colspan="4">Empty List...</td>
                                        </tr>
                                    @else
                                        @foreach ($customers as $customer)
                                            <tr class="item-{{ $customer->id }}">
                                                <td>{{ $customer->id }}</td>
                                                <td><a href="{{route('customer.show',$customer->id)}}">{{ $customer->name }}</a></td>
                                                <td>{{ $customer->phone }}</td>
                                                <td>{{ $customer->address }}</td>
                                                <td>{{ $customer->email }}</td>

                                                <td>
                                                    <a data-url="{{ route('customer.restore', $customer->id) }}"
                                                        data-id="{{ $customer->id }}" class="btn btn-info sm restoreCustomer">
                                                        <i class="fas fa-redo"></i>
                                                    </a>
                                                    <a data-url="{{ route('customer.forceDelete', $customer->id) }}"
                                                        data-id="{{ $customer->id }}"
                                                        class="btn btn-danger sm forceDeleteCustomer">
                                                        <i class=" fas fa-trash-alt "></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-7">
                                    Show {{ $customers->perPage() }} - {{ $customers->currentPage() }} of
                                    {{ $customers->lastPage() }}
                                </div>
                                <div class="col-5">
                                    <div class="btn-group float-end">
                                        {{ $customers->appends(request()->all())->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(function() {
            $('.forceDeleteCustomer').on('click', forceDeleteCustomer);
            $('.restoreCustomer').on('click', restoreCustomer);
        })

        function restoreCustomer(event) {
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
                                    $('.item-' + id).remove()
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



        function forceDeleteCustomer(event) {
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
                                    $('.item-' + id).remove()
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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection
