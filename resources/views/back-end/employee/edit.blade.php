@extends('back-end.master')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="container-fluid">
        {{-- <header class="page-title-bar">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <a href=""><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Quản Lý Nhân
                        Viên</a>
                </li>
            </ol>
        </nav>
    </header> --}}

        <div class="page-section">
            <form method="post" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <legend>Basic information</legend>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Full name</label>
                                    <input name="name" class="form-control" type="text" value="{{ $user->name }}"
                                        id="example-text-input">

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phone</label>
                                    <input name="phone" class="form-control" type="text" value="{{ $user->phone }}"
                                        id="example-text-input">

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">E-mail</label>
                                    <input name="email" class="form-control" type="text" value="{{ $user->email }}"
                                        id="example-text-input">

                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Provice/City</label>
                                    <select name="province_id" class="form-control province_id">
                                        {{-- @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}" @selected($province->id == $user->province_id)>
                                                {{ $province->name }}</option>
                                        @endforeach --}}
                                    </select>

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">District</label>
                                    <select name="district_id" class="form-control district_id">

                                    </select>

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Commune/Ward</label>
                                    <select name="ward_id" class="form-control ward_id">

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-top">
                        <legend>Personal information</legend>

                        <div class="row">


                            <div class="col-lg-9">

                                <div class="form-group">
                                    <label>Address<noscript></noscript></label>
                                    <input name="address" type="text" class="form-control" id=""
                                        placeholder="Enter address" value="{{ $user->address }}">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label class="d-block">Gender</label>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input type="radio" class="custom-control-input" name="gender" id="rd1"
                                            @if ($user->gender == 1) checked @endif value="1"> Male <br>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input type="radio" class="custom-control-input" name="gender" id="rd2"
                                            @if ($user->gender == 0) checked @endif value="0">
                                        Female
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Password<noscript></noscript></label>
                                    <input name="password" type="password" class="form-control" id=""
                                        placeholder="Enter Password" value="{{ $user->address }}">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input name="confirm_password" type="password" class="form-control" id=""
                                        placeholder="Nhập Confirm Password" value="{{ $user->address }}">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group md-3">
                                    <label>Avatar Employee</label>
                                    <input type="file" name="avatar" id="filepond" class="img-fluid filepond "
                                        multiple>
                                </div>
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12 d-flex">
                                <div class="col-lg-3">
                                    <input type="checkbox" name="name_role" id="">
                                    <span>Name_role</span>
                                </div>
                                <div class="col-lg-3">
                                    <input type="checkbox" name="name_role" id="">
                                    <span>Name_role</span>
                                </div>
                                <div class="col-lg-3">
                                    <input type="checkbox" name="name_role" id="">
                                    <span>Name_role</span>
                                </div>
                                <div class="col-lg-3">
                                    <input type="checkbox" name="name_role" id="">
                                    <span>Name_role</span>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="form-actions">
                                <a class="btn btn-secondary float-right"
                                    onclick="window.history.go(-1); return false;">Close</a>
                                <input type="submit" class="btn btn-info waves-effect waves-light"
                                    value="Add Profile...">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
