@extends('back-end.master')
@section('content')
    <style>
        .title_cate {
            margin-left: 30px;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('review.update', $review->id) }} " method="POST">
                            @csrf
                            @method('PUT')
                            <h6>Customer ID: </h6>
                            <strong>{{ $review->customer_id }}</strong>
                            <h6>Customer Name: </h6>
                            <p><strong>{{ $review->customer->name }}</strong></p>
                            <h6>Product ID</h6>
                            <strong>{{ $review->product_id }}</strong>
                            <h6>Product Name: </h6>
                            <p><strong>{{ $review->product->name }}</strong></p>
                            <h6>Status</h6>
                            @if (Route::currentRouteName() == 'review.edit')
                                <div class="col-8">
                                    <input type="number" value="{{ $review->status }}" class="form-control" name="status"
                                        min="0" max="1">
                                </div>
                            @else
                                <strong>{{ $review->status }}</strong>
                            @endif
                            <h6>Vote: </h6>
                            <strong>{{ $review->vote }}
                                <i class="fas fa-star text-warning"></i>
                            </strong>
                            <h6>Content: </h6>
                            <div class="form-floating col-8 mb-5">
                                <textarea disabled class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                <label for="floatingTextarea2"> <strong>{{ $review->content }}</strong></label>
                            </div>
                            @if (Route::currentRouteName() == 'review.edit')
                                <input type="submit" value="Update" class="btn btn-primary">
                            @else
                                <a href="{{ route('review.edit', $review->id) }}" class="btn btn-info">Edit</a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
