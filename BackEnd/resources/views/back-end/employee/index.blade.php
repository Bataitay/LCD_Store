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
                                    <h2 for="example-text-input" class="form-label">HR Management</h2>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h2></h2>
                            </div><br><br><br>
                            <div class="col-md-12 d-flex">
                                <div class="md-3 title_cate">
                                    @can('Add_Employee', 'Add_Employee')
                                        <a href="{{ route('user.create') }}"
                                            class="btn btn-secondary btn-rounded waves-effect waves-light ">
                                            <i class="mdi mdi-plus-circle addeventmore "></i>
                                            Add Employee</a>
                                    @endcan
                                </div>
                                <div class="md-3 title_cate">
                                    <a href="{{ route('user.getTrashed') }}"
                                        class="btn btn-danger btn-rounded waves-effect waves-light ">
                                        <i class=" fas fa-trash-alt"></i>
                                        Trash</a>
                                </div>
                                <div class="md-3 title_cate d-flex">
                                    <div class="form-outline">
                                        <form action="">
                                            <input type="search" name="search" id="form1"
                                                value="{{ request()->search }}" class="form-control" />
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
                                        <th width="5%">Id</th>
                                        <th width="15%">Name</th>
                                        <th width="15%">Phone</th>
                                        <th width="20%"> Address </th>
                                        <th width="20%">Action</th>
                                    </tr>
                                </thead>

                                <tbody id="addRow" class="addRow">

                                </tbody>

                                <tbody id="myTable">
                                    @if (!$users->count())
                                        <tr>
                                            <td colspan="6">No data yet...</td>
                                        </tr>
                                    @else
                                        @foreach ($users as $user)
                                            <tr class="item-{{ $user->id }}">
                                                <td>{{ $user->id }}</td>
                                                <td class="d-flex align-items-center ">
                                                    <div class="rounded-circle ">
                                                        <img class=" image_photo rounded-circle "
                                                            src="{{ !empty($user->avatar) ? asset($user->avatar) : asset('assets/images/no_image.png') }}">
                                                    </div>
                                                    &nbsp;
                                                    <div>
                                                        <span>{{ $user->name }}</span><br>
                                                        <span id="email_user">{{ $user->email }}</span>
                                                    </div>
                                                </td>
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ $user->address }}</td>
                                                <td>
                                                    @can('Edit_Employee', 'Edit_Employee')
                                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-info sm">
                                                            <i class="fas fa-edit "></i>
                                                        </a>
                                                    @endcan
                                                    @can('Show_Employee', 'Show_Employee')
                                                        <a href="{{ route('user.show', $user->id) }}"
                                                            class="btn btn-primary sm ">
                                                            <i class="fas fa-eye-slash"></i>
                                                        </a>
                                                    @endcan
                                                    @php
                                                        if ($user->id == 1) {
                                                            continue;
                                                        }
                                                    @endphp
                                                    @can('Delete_Employee', 'Delete_Employee')
                                                        <a data-href="{{ route('user.delete', $user->id) }}"
                                                            id="{{ $user->id }}" class="btn btn-danger sm deleteIcon"><i
                                                                class=" fas fa-trash-alt "></i></a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-7">
                                    Show {{ $users->perPage() }} - {{ $users->currentPage() }} of
                                    {{ $users->lastPage() }}
                                </div>
                                <div class="col-5">
                                    <div class="btn-group float-end">
                                        {{ $users->appends(request()->all())->links() }}
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
    @isset($user)
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
