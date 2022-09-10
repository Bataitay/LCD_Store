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
            <form method="post" action="{{ route('user.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <legend>Basic information</legend>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Full name</label>
                                    <input name="name" type="text" value="{{ old('name') }}"
                                        id="example-text-input" class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phone</label>
                                    <input name="phone" type="text" value="{{ old('phone') }}" id="example-text-input"
                                        class="form-control @error('phone') is-invalid @enderror">
                                    @error('phone')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">E-mail</label>
                                    <input name="email" type="text" value="{{ old('email') }}" id="example-text-input"
                                        class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Provice/City</label>
                                    <select name="province_id" id="province_id" class="form-control province_id"
                                        aria-label="Default select example" data-toggle="select2">
                                        <option selected="" value="">Open this select menu</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('province_id')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">District</label>
                                    <select name="district_id" id="district_id" class="form-control district_id"
                                        aria-label="Default select example">
                                        <option selected="" value="">Open this select menu</option>
                                    </select>
                                    @error('district_id')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Commune/Ward</label>
                                    <select name="ward_id" class="form-control ward_id" aria-label="Default select example"
                                        id="ward_id">
                                        <option selected="" value="">Open this select menu</option>
                                    </select>
                                    @error('ward_id')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
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
                                    <input name="address" type="text" id="" placeholder="Enter address"
                                        value="{{ old('address') }}"
                                        class="form-control @error('address') is-invalid @enderror">
                                    @error('address')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <br>
                                <div class="form-group">
                                    <label class="d-block">Gender</label>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input type="radio" class="custom-control-input" name="gender" id="rd1"
                                            checked value="1"> Male <br>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input type="radio" class="custom-control-input" name="gender" id="rd2"
                                            value="0">
                                        Female
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Password<noscript></noscript></label>
                                    <input name="password" type="password" id="" placeholder="Enter Password"
                                        value="{{ old('password') }}"
                                        class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input name="confirm_password" type="password" id=""
                                        placeholder="Nhập Confirm Password" value="{{ old('confirm_password') }}"
                                        class="form-control @error('password') is-invalid @enderror">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group md-3">
                                    <label>Avatar Employee</label>
                                    <input type="file" name="avatar" id="filepond" class="img-fluid filepond "
                                        multiple>
                                    <input type="hidden" name="file" id="avatar" value="">
                                </div>
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                            </div>
                            <div class="row d-flex">
                                @foreach ($roles as $role)
                                    <div class="form-check col-3">
                                        <input name="roles_id[]" value="{{ $role->id }}" type="checkbox"
                                            class="form-check-input checkbox_childrent checkbox_all_childrent"
                                            id="roles{{ $role->id }}">
                                        <label for="roles{{ $role->id }}"
                                            class="form-label">{{ $role->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="form-actions">
                                <a class="btn btn-secondary float-right"
                                   href="{{ route('user.index')}}" >Close</a>
                                <input type="submit" class="btn btn-info waves-effect waves-light add_user"
                                    value="Add Profile...">

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {
            $(document).on('change', '.province_id, .add_user', function() {
                var province_id = $(this).val();
                var district_name = $('.district_id').find('option:selected').text();
                $.ajax({
                    url: "{{ route('user.GetDistricts') }}",
                    type: "GET",
                    data: {
                        province_id: province_id
                    },
                    success: function(data) {
                        console.log(data);
                        var html = '<option value="">Open this select menu</option>';
                        $.each(data, function(key, v) {
                            console.log(v);
                            html += '<option value=" ' + v.id + ' "> ' + v
                                .name + '</option>';
                        });
                        $('.district_id').html(html);
                    }
                })
            });
        });

        $(function() {
            $(document).on('change', '#district_id, .add_user', function() {
                var district_id = $(this).val();
                var ward_id = $(this).val();
                $.ajax({
                    url: "{{ route('user.getWards') }}",
                    type: "GET",
                    data: {
                        district_id: district_id
                    },
                    success: function(data) {
                        console.log(data);
                        var html = '<option value="">Open this select menu</option>';
                        $.each(data, function(key, v) {
                            html += '<option value =" ' + v.id + ' "> ' + v.name +
                                '</option>';
                        });
                        $('#ward_id').html(html);
                    }
                })
            });
        });
    </script>
@endsection
