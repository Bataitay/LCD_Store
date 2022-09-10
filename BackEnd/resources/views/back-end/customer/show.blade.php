@extends('back-end.master')
@section('content')

    <div class="container-fluid">
        <p>Customer Name :</p>
        <h4><strong>{{$customer->name}}</strong></h4>
        <p>Customer phone: </p>
        <h4><strong>{{$customer->phone}}</strong></h4>
        <p>Customer address: </p>
        <h4><strong>{{$customer->address}}</strong></h4>
        <p>Customer email: </p>
        <h4><strong>{{$customer->email}}</strong></h4>

    </div>
@endsection
