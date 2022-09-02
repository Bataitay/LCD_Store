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
                                    <h2 for="example-text-input" class="form-label">Roles</h2>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h2></h2>
                            </div>
                            <div class="col-md-4 ">
                                <div class="md-3 title_cate">
                                    <a href="{{ route('role.create') }}"
                                        class="btn btn-secondary btn-rounded waves-effect waves-light ">
                                        <i class="mdi mdi-plus-circle addeventmore "></i>
                                        Add Role</a>
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
                                        <th>Name</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>

                                <tbody id="addRow" class="addRow">

                                </tbody>

                                <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>{{ $role->id }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                <a href="{{ route('role.edit', $role->id) }}" class="btn btn-primary">Edit</a> | 
                                                <form action="{{ route('role.destroy', $role->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger">Delete</button>
                                                </form>
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
@endsection
