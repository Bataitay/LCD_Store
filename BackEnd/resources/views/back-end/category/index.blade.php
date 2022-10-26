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
                                    <h3 for="example-text-input" class="form-label"> Categories Management </h3>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h2></h2>
                            </div><br><br><br>
                            <div class="col-md-12 d-flex">
                                @can('Add_Category', 'Add_Category')
                                    <div class="md-3 title_cate">
                                        <a href="{{ route('category.create') }}"
                                            class="btn btn-secondary btn-rounded waves-effect waves-light ">
                                            <i class="mdi mdi-plus-circle addeventmore "></i>
                                            Add Category</a>
                                    </div>
                                @endcan
                                <div class="md-3 title_cate">
                                    <a href="{{ route('category.getTrashed') }}"
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
                                        <th>The number of products</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="addRow" class="addRow">

                                </tbody>

                                <tbody id="myTable">
                                    @if (!$categories->count())
                                        <tr>
                                            <td colspan="4">No data yet...</td>
                                        </tr>
                                    @else
                                        @foreach ($categories as $category)
                                            <tr class="item-{{ $category->id }}">
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->products->count() }}</td>
                                                <td>
                                                    @can('Edit_Category', 'Edit_Category')
                                                        <a href="{{ route('category.edit', $category->id) }}"
                                                            class="btn btn-info sm">
                                                            <i class="fas fa-edit "></i>
                                                        </a>
                                                    @endcan
                                                    @can('Delete_Category', 'Delete_Category')
                                                        <a data-href="{{ route('category.delete', $category->id) }}"
                                                            id="{{ $category->id }}" class="btn btn-danger sm deleteIcon"><i
                                                                class=" fas fa-trash-alt "></i></a>
                                                    @endcan
                                                    @can('Show_Category', 'Show_Category')
                                                        <a href="" class="btn btn-primary sm ">
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
                                    Show {{ $categories->perPage() }} - {{ $categories->currentPage() }} of
                                    {{ $categories->lastPage() }}
                                </div>
                                <div class="col-5">
                                    <div class="btn-group float-end">
                                        {{ $categories->appends(request()->all())->links() }}
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
    @isset($category)
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
