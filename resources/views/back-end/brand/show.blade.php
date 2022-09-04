@extends('back-end.master')
@section('content')
    <style>
        .title_cate {
            margin-left: 30px;
        }
    </style>
    <div class="container-fluid">
        <p>Brand Name :</p>
        <h4>{{$brand->name}}</h4>
        <p>Brand Logo: </p>
        <img src="{{ asset($brand->logo) }}" alt="" width="250px">
    </div>
@endsection
