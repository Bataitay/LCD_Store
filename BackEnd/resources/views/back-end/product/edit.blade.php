@extends('back-end.master')
@section('content')
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
            <form method="post" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <legend>Basic information</legend>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name Category</label>
                                    <select name="category_id" id="category_id" class="form-control category_id"
                                        aria-label="Default select example" data-toggle="select2">
                                        <option selected disabled>Open this select menu</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if(old('category_id')  == $category->id)
                                                    selected
                                                @elseif($product->category_id == $category->id)
                                                    selected
                                                @endif
                                                >{{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name Brand</label>
                                    <select name="brand_id" id="brand" class="form-control brand"
                                        aria-label="Default select example" data-toggle="select2">
                                        <option selected disabled>Open this select menu</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                @if(old('brand_id')  == $brand->id)
                                                    selected
                                                @elseif($product->brand_id == $brand->id)
                                                    selected
                                                @endif
                                                >{{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('brand')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name Product</label>
                                    <input name="name" type="text" value="{{ old('name') ?? $product->name }}"
                                        id="example-text-input" class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Quantity</label>
                                    <input name="quantity" type="number"
                                        value="{{ old('quantity') ?? $product->quantity }}" id="example-text-input"
                                        class="form-control @error('quantity') is-invalid @enderror">
                                    @error('quantity')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sale_Price</label>
                                    <input name="sale_price" type="number"
                                        value="{{ old('sale_price') ?? $product->sale_price }}" id="example-text-input"
                                        class="form-control @error('sale_price') is-invalid @enderror">
                                    @error('sale_price')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Price</label>
                                    <input name="price" type="number" value="{{ old('price') ?? $product->price }}"
                                        id="example-text-input" class="form-control @error('price') is-invalid @enderror">
                                    @error('price')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-top">
                        <legend>Specifications Product</legend>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Cpu</label>
                                    <input name="cpu" type="text" id="" placeholder="Enter cpu"
                                        value="{{ $product->specification->cpu }}"
                                        class="form-control @error('cpu') is-invalid @enderror">
                                    @error('cpu')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ram</label>
                                    <input name="ram" type="text" id="" placeholder="Enter ram"
                                        value="{{ $product->specification->ram }}"
                                        class="form-control @error('ram') is-invalid @enderror">
                                    @error('ram')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Rom</label>
                                    <input name="rom" type="text" id="" placeholder="Enter rom"
                                        value="{{ $product->specification->rom }}"
                                        class="form-control @error('rom') is-invalid @enderror">
                                    @error('rom')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Display</label>
                                    <input name="display" type="text" id="" placeholder="Enter display"
                                        value="{{ $product->specification->display }}"
                                        class="form-control @error('display') is-invalid @enderror">
                                    @error('display')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Battery</label>
                                    <input name="battery" type="text" id="" placeholder="Enter battery"
                                        value="{{ $product->specification->battery }}"
                                        class="form-control @error('battery') is-invalid @enderror">
                                    @error('battery')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Color</label>
                                    <input name="color" type="text" id="" placeholder="Enter color"
                                        value="{{ $product->specification->color }}"
                                        class="form-control @error('color') is-invalid @enderror">
                                    @error('color')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="image">Main photo</label><br>
                                    <div class="card_file_name">
                                        <div class="form-group form_img">
                                            <span class="inner">
                                                Drag & drop image here or
                                                <label for="file" class="choose">Browse</label>
                                            </span>
                                            <input type="file" name="image" id="file"
                                                value="{{ $product->image }}"
                                                class="form-control file @error('image') is-invalid @enderror">
                                        </div>
                                        <div class="card-img">
                                            <img id="showImage" class="rounded image_show w-100"
                                                src=" {{ asset($product->image) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <label for="file_name">Detailed photos</label>
                                <div class="card_file_name">
                                    <div class="form-group form_input">
                                        <span class="inner">
                                            Drag & drop image here or
                                            <span class="select">Browse</span>
                                        </span>
                                        <input type="file" name="file_names[]" id="file_name" multiple value=""
                                            class="form-control files @error('file_name') is-invalid @enderror">
                                    </div>
                                    <div class="container_image">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-log-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">

                                            <h4 class="card-title">Description</h4>
                                            <textarea id="elm1" name="description"> {{ old('description') ?? $product->description }} </textarea>

                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->

                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-group">
                        <div class="form-actions">
                            <a class="btn btn-secondary float-right" href="{{ route('product.index') }}">Close</a>
                            <input type="submit" class="btn btn-info waves-effect waves-light add_product"
                                value="update Product...">

                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.file').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                    console.log(e);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
