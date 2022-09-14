@extends('back-end.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p>Brand Name :</p>
                        <h4>{{ $brand->name }}</h4>
                        <p>Brand Logo: </p>
                        <img src="{{ asset($brand->logo) }}" alt="" width="250px">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
