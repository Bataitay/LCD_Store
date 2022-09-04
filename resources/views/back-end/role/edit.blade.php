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
                                    <h2 for="example-text-input" class="form-label">Edit Role</h2>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('role.update', $role->id) }} " method="POST" enctype="multipart/form-data" >
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="name" class="form-label">Role Name</label>
                                    <input name="name" value="{{ $role->name }}" type="input" class="form-control" id="name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Permissions</label>
                                </div>
                                <div class="form-check">
                                    <input name="Permissions" type="checkbox" class="form-check-input" id="Permissions">
                                    <label for="Permissions" class="form-label">Full Permissions</label>
                                </div>
                                <div class="custom-control custom-checkbox row d-flex mb-4">
                                    @foreach ($parentPermissions as $parentPermission)
                                        <div class="card col-md-12">
                                            <div class="card-header">
                                                <input name="Permissions" type="checkbox" class="form-check-input" id="Permissions{{ $parentPermission->id }}">
                                                <label for="Permissions{{ $parentPermission->id }}" class="form-label">{{ $parentPermission->name }}</label>
                                            </div>
                                            <div class="card-body row d-flex">
                                                @foreach($parentPermission->childrentPermissions as $childrentPermission)
                                                <div class="form-check col-2">
                                                    <input name="permissions_id[]" {{ $permissionChecked->contains('id', $childrentPermission->id) ? 'checked' : '' }} value="{{ $childrentPermission->id }}" type="checkbox" class="form-check-input" id="Permissions{{ $childrentPermission->id }}">
                                                    <label for="Permissions{{ $childrentPermission->id }}" class="form-label">{{ $childrentPermission->name }}</label>
                                                </div>
                                                @endforeach
                                            </div> 
                                        </div>
                                    @endforeach
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
