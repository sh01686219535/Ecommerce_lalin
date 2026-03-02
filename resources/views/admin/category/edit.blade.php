@extends('admin.home.master')
@section('title')
    Category
@endsection
@section('content')
    <div class="content-wrapper ">
        <section class="content ">
            <div class="container-fluid my-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="float-left font-weight-bold inline-block">Category Update Form</h3>
                                <a href="{{ route('category.index') }}" class="float-right btn btn-primary">Category</a>
                            </div>
                            <div class="col-md-8 m-auto">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <form action="{{ route('category.update',$category->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="category">Category Title</label>
                                            <input type="text" id="category" class="form-control @error('category') is-invalid  @enderror"
                                                placeholder="Enter category Title" name="category"  value="{{ old('category', $category->category) }}">
                                                @error('category')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                        </div>
                                         <div class="form-group">
                                            <label for="image">Category Image</label>
                                            <input type="file" id="image"
                                                class="form-control @error('image') is-invalid  @enderror" name="image"
                                                value="{{ old('image') }}">
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select id="status"
                                                class="form-control @error('status') is-invalid  @enderror" name="status"
                                                value="{{ old('status') }}">
                                                <option value="">Select Status</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
