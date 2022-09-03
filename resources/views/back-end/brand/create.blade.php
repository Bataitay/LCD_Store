@extends('back-end.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Add Brand</h4><br>
                            <form method="post" action="{{ route('brand.store') }}" id="myForm" enctype="multipart/form-data" >
                                @csrf
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label ">Name</label>
                                    <div class="form-group col-sm-10">
                                        <input name="name" class="form-control" type="text"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <div class="text text-danger"><i class=" ri-spam-2-line"></i></div>
                                        @enderror
                                        <br><br>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label ">Logo</label>
                                    <div class="form-group col-sm-10">
                                        <input name="logo" class="form-control" type="file"
                                            value="{{ old('logo') }}">
                                        @error('logo')
                                            <div class="text text-danger"><i class=" ri-spam-2-line"></i></div>
                                        @enderror
                                        <br><br>
                                        <a class="btn btn-danger waves-effect waves-light"
                                            href="{{ route('brand.index') }}">Close</a>
                                        <input type="submit" class="btn btn-info waves-effect waves-light" value="Add...">
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
