@extends('back-end.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Edit Brand {{$brand->name}}</h4><br>
                            <form method="post" action="{{ route('brand.update',$brand->id) }}" id="myForm" enctype="multipart/form-data" >
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label ">Name</label>
                                    <div class="form-group col-sm-10">
                                        <input name="name" value="{{ $brand->name }}" type="input"
                                        class="form-control @error('name') is-invalid @enderror" id="
                                        ">
                                    <span class="text-danger">{{ $errors->first('name') }}</span>

                                        <br><br>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label ">Logo</label>
                                    <div class="form-group col-sm-10">
                                        <input name="logo" value="{{ $brand->logo }}" type="file"
                                        class="form-control @error('logo') is-invalid @enderror" id="
                                        ">
                                    <span class="text-danger">{{ $errors->first('logo') }}</span>
                                        <br><br>
                                        <a class="btn btn-danger waves-effect waves-light"
                                            href="{{ route('brand.index') }}">Close</a>
                                        <input type="submit" class="btn btn-info waves-effect waves-light" value="Update...">
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
