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
                                    <input name="name" class="form-control @error('name') is-invalid @enderror"
                                        type="text" value="{{ old('name') ?? $user->name }}" id="example-text-input">
                                    @error('name')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phone</label>
                                    <input name="phone" class="form-control @error('phone') is-invalid @enderror"
                                        type="text" value="{{ old('phone') ?? $user->phone }}" id="example-text-input">
                                    @error('phone')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">E-mail</label>
                                    <input name="email" class="form-control @error('email') is-invalid @enderror"
                                        type="text" value="{{ old('email') ?? $user->email }}" id="example-text-input">
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
                                    <select name="province_id"
                                        class="form-control @error('province_id') is-invalid @enderror">
                                        @foreach ($provinces as $province)
                                            <option value="{{ old('province_id') ?? $province->id }}"
                                                @selected($province->id == $user->province_id)>
                                                {{ $province->name }}</option>
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
                                    <select name="district_id" id="district_id"
                                        class="form-control @error('district_id') is-invalid @enderror"
                                        aria-label="Default select example">
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}" @selected($district->id == $user->district_id)>
                                                {{ old('district_id') ?? $district->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('district_id')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Commune/Ward</label>
                                    <select name="ward_id" class="form-control @error('ward_id') is-invalid @enderror"
                                        aria-label="Default select example" id="ward_id">
                                        @foreach ($wards as $ward)
                                            <option value="{{ $ward->id }}" @selected($ward->id == $user->ward_id)>
                                                {{ old('ward_id') ?? $ward->name }}</option>
                                        @endforeach
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
                                    <input name="address" type="text"
                                        class="form-control @error('address') is-invalid @enderror" id=""
                                        placeholder="Enter address" value="{{ old('address') ?? $user->address }}">
                                    @error('address')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <br>
                                <div class="form-group">
                                    <label class="d-block">Gender</label>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input type="radio" class="custom-control-input " name="gender" id="rd1"
                                            @if ($user->gender == 1) checked @endif value="1"> Male <br>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input type="radio" class="custom-control-input" name="gender" id="rd2"
                                            @if ($user->gender == 0) checked @endif value="0">
                                        Female
                                    </div>
                                </div>
                                <br>
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
                        @if ($user->id != 1)
                            <div class="row">
                                <div class="mb-3">
                                    <label class="form-label">Role</label>
                                </div>
                                <div class="row d-flex">
                                    @foreach ($roles as $role)
                                        <div class="form-check col-3">
                                            <input name="roles_id[]"
                                                @if (old('roles_id')) {{ in_array($role->id, old('roles_id')) ? 'checked' : '' }}
                                        @else
                                        {{ $rolesChecked->contains('id', $role->id) ? 'checked' : '' }} @endif
                                                value="{{ $role->id }}" type="checkbox"
                                                class="form-check-input checkbox_childrent checkbox_all_childrent"
                                                id="roles{{ $role->id }}">
                                            <label for="roles{{ $role->id }}"
                                                class="form-label">{{ $role->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <br>
                        <div class="form-group">
                            <div class="form-actions">
                                <a class="btn btn-secondary float-right" href="{{ route('user.index') }}">Close</a>
                                <input type="submit" class="btn btn-info waves-effect waves-light"
                                    value="Update Profile...">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(function() {
            $(document).on('change', '.province_id', function() {
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
    </script>
    <script type="text/javascript">
        $(function() {
            $(document).on('change', '#district_id, .payment', function() {
                var district_id = $(this).val();
                var ward_id = $(this).val();
                var ward_name = $('.ward_id').find('option:selected').text();
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
