@extends('back-end.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Add category</h4><br>
                            <form method="post" action="{{ route('category.store') }}" id="myForm">
                                @csrf
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label ">Name</label>
                                    <div class="form-group col-sm-10">
                                        <input name="name" class="form-control @error('name') is-invalid @enderror" type="text"
                                            value="{{ old('name') }}">
                                            @error('name')
                                            <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                        <br><br>
                                        <a class="btn btn-danger waves-effect waves-light"
                                            href="{{ route('category.index') }}">Close</a>
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
