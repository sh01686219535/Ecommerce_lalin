@extends('admin.home.master')
@section('title')
    SubCategory
@endsection
@section('content')
    <div class="content-wrapper ">
        <section class="content ">
            <div class="container-fluid my-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="float-left font-weight-bold inline-block">Sub Category Update Form</h3>
                                <a href="{{ route('subCategory.index') }}" class="float-right btn btn-primary">Sub
                                    Category</a>
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
                                    <form action="{{ route('subCategory.update', $subCategory->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label for="sub_category">Sub Category Title</label>
                                            <input type="text" id="sub_category" name="sub_category"
                                                class="form-control @error('sub_category') is-invalid @enderror"
                                                placeholder="Enter category Title"
                                                value="{{ old('sub_category', $subCategory->sub_category) }}">

                                            @error('sub_category')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="category_id">Category</label>

                                            <select id="category_id" name="category_id"
                                                class="form-control @error('category_id') is-invalid @enderror">

                                                <option value="">-- Select Category --</option>

                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id', $subCategory->category_id) == $category->id ? 'selected' : '' }}>
                                                        {{ $category->category }}
                                                    </option>
                                                @endforeach

                                            </select>

                                            @error('category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-success">Update</button>
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
