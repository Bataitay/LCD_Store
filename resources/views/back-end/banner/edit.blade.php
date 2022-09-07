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
                                    <h2 for="example-text-input" class="form-label">Edit Role</h2>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('role.update', $role->id) }} " method="POST" class="form"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="name" class="form-label">Role Name</label>
                                    <input name="name" value="{{ old('name') ?? $role->name }}" type="input"
                                        class="form-control @error('name') is-invalid @enderror" id="name">
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Permissions</label>
                                </div>
                                <div class="form-check">
                                    <input name="Permissions" type="checkbox" class="form-check-input checkbox_all"
                                        id="Permissions">
                                    <label for="Permissions" class="form-label">Full Permissions</label>
                                </div>
                                <div class="custom-control custom-checkbox row d-flex mb-4">
                                    @foreach ($parentPermissions as $parentPermission)
                                        <div class="single-card col-md-12">
                                            <div class="card-header">
                                                <input name="Permissions" type="checkbox"
                                                    class="form-check-input checkbox_parent checkbox_all_childrent"
                                                    id="Permissions{{ $parentPermission->id }}">
                                                <label for="Permissions{{ $parentPermission->id }}"
                                                    class="form-label">{{ $parentPermission->name }}</label>
                                            </div>
                                            <div class="card-body row d-flex">
                                                @foreach ($parentPermission->childrentPermissions as $childrentPermission)
                                                    <div class="form-check col-2">
                                                        <input name="permissions_id[]"
                                                            @if (old('permissions_id')) 
                                                                {{ in_array($childrentPermission->id, old('permissions_id')) ? 'checked' : '' }}
                                                            @else
                                                                {{ $permissionChecked->contains('id', $childrentPermission->id) ? 'checked' : '' }} 
                                                            @endif
                                                            value="{{ $childrentPermission->id }}" type="checkbox"
                                                            class="form-check-input checkbox_childrent checkbox_all_childrent"
                                                            id="Permissions{{ $childrentPermission->id }}">
                                                        <label for="Permissions{{ $childrentPermission->id }}"
                                                            class="form-label">{{ $childrentPermission->name }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <a href="{{ route('role.index') }}" class="btn btn-danger">Back</a>
                                <button type="submit" class="btn btn-primary">Edit Role</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.checkbox_parent').on('click', function() {
            $(this).parents('.single-card').find('.checkbox_childrent').prop('checked', $(this).prop('checked'))
        });
        $('.checkbox_all').on('click', function() {
            $(this).parents('.form').find('.checkbox_all_childrent').prop('checked', $(this).prop('checked'))
        });
    </script>
@endsection
