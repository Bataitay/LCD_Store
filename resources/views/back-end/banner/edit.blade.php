@extends('back-end.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-4">
                                <div class="md-3">
                                    <h2 for="example-text-input" class="form-label">Edit Banner #{{ $banner->id }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data"
                                class="form">
                                @csrf
                                @method('put')
                                <div class="mb-3">
                                    <label for="path" class="form-label">Navigation path</label>
                                    <input name="path" value="{{ old('path') ?? $banner->url }}" type="input" class="form-control @error('path') is-invalid @enderror"
                                        id="path">
                                    <span class="text-danger">{{ $errors->first('path') }}</span>
                                </div>
                                <div class="mb-3">
                                    <label for="banner" class="form-label">Choose banner</label>
                                    <input name="banner" value="{{ old('banner') ?? $banner->image }}" type="file" class="form-control @error('banner') is-invalid @enderror"
                                        id="banner">
                                    <span class="text-danger">{{ $errors->first('banner') }}</span>
                                </div>
                                <a href="{{ route('banner.index') }}" class="btn btn-danger">Back</a>
                                <button type="submit" class="btn btn-primary">Update Banner</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
