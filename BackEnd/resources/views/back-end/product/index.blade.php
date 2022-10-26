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
                                    <h2 for="example-text-input" class="form-label"> Product Management</h2>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h2></h2>
                            </div><br><br><br>
                            <div class="col-md-12 d-flex">
                                <div class="md-3 title_cate">
                                    @can('Add_Product', 'Add_Product')
                                        <a href="{{ route('product.create') }}"
                                            class="btn btn-secondary btn-rounded waves-effect waves-light ">
                                            <i class="mdi mdi-plus-circle addeventmore "></i>
                                            Add product</a>
                                    @endcan
                                </div>
                                <div class="md-3 title_cate">
                                    <a href="{{ route('product.getTrashed') }}"
                                        class="btn btn-danger btn-rounded waves-effect waves-light ">
                                        <i class=" fas fa-trash-alt"></i>
                                        Trash</a>
                                </div>
                                <div class="md-3 title_cate d-flex">
                                    <div class="form-outline">
                                        <form action="">
                                            <input type="search" value="{{ request()->search }}" name="search"
                                                id="form1" class="form-control" />
                                    </div>
                                    <button type="submit" class="btn btn-primary  waves-effect waves-light ">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    </form>
                                </div>
                                <div class="md-3 title_cate">
                                    <button href="" class="btn btn-primary  waves-effect waves-light"
                                        data-bs-toggle="modal" data-bs-target="#searchModal"">
                                        Advanced search
                                    </button>
                                    @include('back-end.product.advanceSearch')
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <table
                                class="table table-bordered dt-responsive nowrap text-center align-middle dataTable no-footer dtr-inline"
                                style="border-color: #ddd; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th width="7%">Id</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Sale_Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="addRow" class="addRow">

                                </tbody>

                                <tbody id="myTable">
                                    @if (!$products->count())
                                        <tr>
                                            <td colspan="7">No data yet...</td>
                                        </tr>
                                    @else
                                        @foreach ($products as $product)
                                            <tr class="item-{{ $product->id }}">
                                                <td>{{ $product->id }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ number_format($product->price) }}</td>
                                                <td>{{ $product->quantity }}</td>
                                                <td>{{ number_format($product->price - ($product->sale_price / 100) * $product->price) }}
                                                </td>
                                                <td>
                                                    @can('Edit_Product', 'Edit_Product')
                                                        @if ($product->status == 1)
                                                            <a href="{{ route('product.hideStatus', $product->id) }}">
                                                                <i class=" fas fa-chevron-circle-down text-success"></i>
                                                            </a>
                                                        @else
                                                            <a href="{{ route('product.showStatus', $product->id) }}">
                                                                <i class=" far fa-times-circle text-danger"></i>
                                                            </a>
                                                        @endif
                                                    @endcan
                                                </td>
                                                <td>
                                                    @can('Edit_Product', 'Edit_Product')
                                                        <a href="{{ route('product.edit', $product->id) }}"
                                                            class="btn btn-info sm">
                                                            <i class="fas fa-edit "></i>
                                                        </a>
                                                    @endcan
                                                    @can('Delete_Product', 'Delete_Product')
                                                        <a data-href="{{ route('product.delete', $product->id) }}"
                                                            id="{{ $product->id }}" class="btn btn-danger sm deleteIcon"><i
                                                                class=" fas fa-trash-alt "></i></a>
                                                    @endcan
                                                    @can('Show_Product', 'Show_Product')
                                                        <a href="{{ route('product.show', $product->id) }}"
                                                            class="btn btn-primary sm ">
                                                            <i class="fas fa-eye-slash"></i>
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
                                    Show {{ $products->perPage() }} - {{ $products->currentPage() }} of
                                    {{ $products->lastPage() }}
                                </div>
                                <div class="col-5">
                                    <div class="btn-group float-end">
                                        {{ $products->appends(request()->all())->links() }}
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
    @isset($product)
        <script>
            $(document).on('click', '.deleteIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let href = $(this).data('href');
                let csrf = '{{ csrf_token() }}';
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
    @endisset
@endsection
