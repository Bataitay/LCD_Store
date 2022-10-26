@extends('back-end.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Change Password</h4><br>
                            <form method="post" action="{{ route('user.updatePassword') }}" id="myForm">
                                @csrf
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label ">Old Password</label>
                                    <div class="form-group col-sm-10">
                                        <input name="old_password" class="form-control @error('old_password') is-invalid @enderror"
                                            type="password" value="{{ old('old_password') }}">
                                        @error('old_password')
                                            <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                        <br>
                                    </div>
                                    <label for="example-text-input" class="col-sm-2 col-form-label ">New Password</label>
                                    <div class="form-group col-sm-10">

                                        <input name="new_password" class="form-control @error('new_password') is-invalid @enderror"
                                            type="password" value="{{ old('new_password') }}">
                                        @error('new_password')
                                            <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                    <br>

                                    </div>
                                    <label for="example-text-input" class="col-sm-2 col-form-label ">Confirm Password</label>
                                    <div class="form-group col-sm-10">

                                        <input name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror"
                                            type="password" value="{{ old('confirm_password') }}">
                                        @error('confirm_password')
                                            <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                        <br><br>
                                        <a class="btn btn-danger waves-effect waves-light"
                                            href="{{ route('user.index') }}">Close</a>
                                        <input type="submit" class="btn btn-info waves-effect waves-light" value="Change Password...">
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
