@extends('back-end.master')
@section('content')
    <style>
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-4">
                                <div class="md-3">
                                    <h2 for="example-text-input" class="form-label"> Customer Management</h2>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h2></h2>
                            </div><br><br><br>
                            <div class="col-md-12 d-flex">
                                <div class="md-3 title_cate">
                                    @can('Add_Customer', 'Add_Customer')
                                        {{-- <a href="{{ route('customer.create') }}"
                                            class="btn btn-secondary btn-rounded waves-effect waves-light ">
                                            <i class="mdi mdi-plus-circle addeventmore "></i>
                                            Add Customer</a> --}}
                                    @endcan
                                </div>
                                <div class="md-3 title_cate">
                                    <a href="{{ route('customer.trash') }}"
                                        class="btn btn-danger btn-rounded waves-effect waves-light ">
                                        <i class=" fas fa-trash-alt"></i>
                                        Trash</a>
                                </div>
                                <div class="md-3 title_cate d-flex">
                                    <div class="form-outline">
                                        <form action="{{ route('customer.search') }}">
                                            <input class="form-control" id="keyword" type="text" placeholder="Search"
                                                aria-label="Search" name="keySearch">
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
                                                <td><a
                                                        href="{{ route('customer.show', $customer->id) }}">{{ $customer->name }}</a>
                                                </td>
                                                <td>{{ $customer->phone }}</td>
                                                <td>{{ $customer->address }}</td>
                                                <td>{{ $customer->email }}</td>

                                                <td>
                                                    {{-- @can('Edit_Customer', 'Edit_Customer')
                                                        <a href="{{ route('customer.edit', $customer->id) }}"
                                                            class="btn btn-info sm">
                                                            <i class="fas fa-edit "></i>
                                                        </a>
                                                    @endcan --}}
                                                    @can('Delete_Customer', 'Delete_Customer')
                                                        <a data-url="{{ route('customer.destroy', $customer->id) }}"
                                                            data-id="{{ $customer->id }}"
                                                            class="btn btn-danger sm deleteCustomer"><i
                                                                class=" fas fa-trash-alt "></i></a>
                                                    @endcan
                                                    @can('Show_Customer', 'Show_Customer')
                                                        <a href="{{ route('customer.show', $customer->id) }}"
                                                            class="btn btn-primary sm ">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    @endcan
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
    <script>
        $(function() {
            $('.deleteCustomer').on('click', deleteCustomer)

        })

        function deleteCustomer(event) {
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
                serviceUrl: 'searchCustomers',
                paramName: "keyword",
                onSelect: function(suggestion) {
                    console.log(suggestion);
                    $("#keyword").val(suggestion.value);
                },
                transformResult: function(response) {
                    return {
                        suggestions: $.map($.parseJSON(response), function(item) {
                            console.log(item);
                            return {
                                value: item.name,
                            };
                        })
                    };
                },

            });
        })
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection
