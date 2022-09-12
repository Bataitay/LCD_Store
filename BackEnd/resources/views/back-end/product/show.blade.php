@extends('back-end.master')
@section('content')
    <div class="card">
        <a href="{{ route('product.index') }}" class="btn btn-danger btn-rounded waves-effect waves-light ">
            <i class=" fas fa-reply-all"></i>
            Back</a>
        <div class="row g-0">
            <div class="col-md-6 border-end">
                <div class="d-flex flex-column justify-content-center">
                    <div class="main_image"> <img src="{{ asset($product->image) }}" id="main_product_image" width="350">
                    </div>
                    <div class="thumbnail_images">
                        <ul id="thumbnail">
                            <li>
                                @foreach ($product->file_names as $file_name)
                                    <img onclick="changeImage(this)" src="{{ asset($file_name->file_name) }}"
                                        width="110px">
                                @endforeach
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-3 right-side">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>{{ $product->name }}</h3> <span class="heart">
                            {{ $product->status == 0 ? 'hidden' : 'show' }}</span>
                    </div>
                    <div class="mt-2 pr-3 content">
                        <span> Created_by: {{ $product->user->name }} </span>
                    </div>
                    <div class="rate">
                        <input type="radio" id="star5" name="rate" value="5" checked />
                        <label for="star5" title="text">5 stars</label>
                        <input type="radio" id="star4" name="rate" value="4" checked />
                        <label for="star4" title="text">4 stars</label>
                        <input type="radio" id="star3" name="rate" value="3" checked />
                        <label for="star3" title="text">3 stars</label>
                        <input type="radio" id="star2" name="rate" value="2" />
                        <label for="star2" title="text">2 stars</label>
                        <input type="radio" id="star1" name="rate" value="1" />
                        <label for="star1" title="text">1 star</label>
                    </div>
                    <span>3 Reviews</span>
                    <div class="product-price-discount"><span>${{ number_format($product->price) }}</span>
                        <span
                            class="line-through">${{ number_format($product->price - ($product->sale_price / 100) * $product->price) }}</span>
                    </div>
                    <div class="ratings d-flex flex-row align-items-center">
                        <div class="d-flex flex-row">

                        </div>
                    </div>
                    <div class="mt-2"> <span class="fw-bold">Specifications: </span>
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Cpu</td>
                                    <td>{{ $product->specification->cpu ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>Ram</td>
                                    <td>{{ $product->specification->ram ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>Rom</td>
                                    <td>{{ $product->specification->rom ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>Color</td>
                                    <td>{{ $product->specification->color ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>Display</td>
                                    <td>{{ $product->specification->display ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>Battery</td>
                                    <td>{{ $product->specification->battery ?? ''}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="product-info-tabs">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab"
                            aria-controls="description" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab"
                            aria-controls="review" aria-selected="false">Reviews (0)</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel"
                        aria-labelledby="description-tab">
                        {!! $product->description !!}
                    </div>
                    <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                        <div class="review-heading">REVIEWS</div>
                        <p class="mb-20">There are no reviews yet.</p>
                        <div class="form-group">
                            <label>Your rating</label>
                            <div class="reviews-counter">
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" />
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="text">1 star</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
