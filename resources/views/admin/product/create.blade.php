@extends('admin.home.master')
@section('title')
    Prodict Create
@endsection
@section('content')
    <div class="content-wrapper ">
        <section class="content ">
            <div class="container-fluid my-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="float-left font-weight-bold inline-block">Product Create Form</h3>
                                <a href="{{ route('product.index') }}" class="float-right btn btn-primary">Product</a>
                            </div>
                            <div class="col-md-11 m-auto">
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
                                    <form action="{{ route('product.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="group-top">
                                            <div class="form-group">
                                                <label for="name">Product Name</label>
                                                <input type="text" id="name"
                                                    class="form-control @error('name') is-invalid  @enderror"
                                                    placeholder="Enter Product Name" name="name"
                                                    value="{{ old('name') }}">
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="tag">Product Tag</label>
                                                <input type="text" id="tag"
                                                    class="form-control @error('tag') is-invalid  @enderror"
                                                    placeholder="Enter Product tag" name="tag"
                                                    value="{{ old('tag') }}">
                                                @error('tag')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="price">Product Price</label>
                                                <input type="number" id="price"
                                                    class="form-control @error('price') is-invalid  @enderror"
                                                    placeholder="Enter Product Price" name="price"
                                                    value="{{ old('price') }}">
                                                @error('price')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <!-- Left Side -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="discount_price_percentage">
                                                            Product Discount Price Percentage
                                                        </label>
                                                        <input type="number" id="discount_price_percentage"
                                                            class="form-control @error('discount_price_percentage') is-invalid @enderror"
                                                            placeholder="Enter Discount Product Price Percentage"
                                                            name="discount_price_percentage"
                                                            value="{{ old('discount_price_percentage') }}">
                                                        @error('discount_price_percentage')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- Right Side -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="discount_price">
                                                            Product Discount Price
                                                        </label>
                                                        <input type="number" id="discount_price"
                                                            class="form-control @error('discount_price') is-invalid @enderror"
                                                            placeholder="Enter Discount Product Price" name="discount_price"
                                                            value="{{ old('discount_price') }}">
                                                        @error('discount_price')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="group-bottom">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="color">Product Color</label>
                                                        <input type="text" id="color"
                                                            class="form-control @error('color') is-invalid  @enderror"
                                                            placeholder="Enter Color" name="color"
                                                            value="{{ old('color') }}">
                                                        @error('color')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="size">Product Size</label>
                                                        <input type="text" id="size"
                                                            class="form-control @error('size') is-invalid  @enderror"
                                                            placeholder="Enter Size" name="size"
                                                            value="{{ old('size') }}">
                                                        @error('size')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="brand_id">Property Brand</label>
                                                        <select id="brand_id" name="brand_id" class="form-control">
                                                            <option value="">-- Select Brand --</option>
                                                            @foreach ($brand as $data)
                                                                <option value="{{ $data->id }}">{{ $data->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="category_id">Property Category</label>
                                                        <select id="category_id" name="category_id" class="form-control">
                                                            <option value="">-- Select Category --</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">
                                                                    {{ $category->category }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="sub_category_id">Property Sub Category</label>
                                                        <select id="sub_category_id" name="sub_category_id"
                                                            class="form-control">
                                                            <option value="">-- Select Sub Category --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="child_category_id">Property Child Category</label>
                                                        <select id="child_category_id" name="child_category_id"
                                                            class="form-control">
                                                            <option value="">-- Select Child Category --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="group-bottom">
                                            <div class="form-group">
                                                <label for="short_description">Short Description</label>
                                                <textarea name="short_description" placeholder="Enter Short Description" id="short_description"
                                                    class="form-control">
                                                </textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">
                                                    {{ old('description') }}
                                                </textarea>
                                                @error('description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="image">image</label>
                                                        <input type="file" id="image" class="form-control"
                                                            name="image">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="multi_image">Multiple Image</label>
                                                        <input type="file" id="multi_image" class="form-control"
                                                            name="multi_image[]" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select id="status"
                                                    class="form-control @error('status') is-invalid  @enderror"
                                                    name="status" value="{{ old('status') }}">
                                                    <option value="">Select Status</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="video_url">Youtube Video URL</label>
                                                        <input type="text" id="video_url"
                                                            class="form-control @error('video_url') is-invalid  @enderror"
                                                            placeholder="Enter Youtube Video URL" name="video_url"
                                                            value="{{ old('video_url') }}">
                                                        @error('video_url')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-check form-switch mb-3">
                                                        <input class="form-check-input" type="checkbox" id="is_featured"
                                                            name="is_featured" value="1"
                                                            {{ old('is_featured') ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="is_featured">Featured
                                                            Product</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
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
@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            // Category → Subcategory
            $('#category_id').on('change', function() {

                let category_id = $(this).val();

                $('#sub_category_id').html('<option value="">Loading...</option>');
                $('#child_category_id').html('<option value="">-- Select Child Category --</option>');

                if (category_id) {
                    $.ajax({
                        url: '/get-subcategories/' + category_id,
                        type: 'GET',
                        success: function(data) {

                            let subcategoryOptions =
                                '<option value="">-- Select Sub Category --</option>';

                            $.each(data, function(key, value) {
                                subcategoryOptions += '<option value="' + value.id +
                                    '">' + value.sub_category + '</option>';
                            });

                            $('#sub_category_id').html(subcategoryOptions);
                        }
                    });
                }
            });


            // Subcategory → Child Category
            $('#sub_category_id').on('change', function() {

                let subcategory_id = $(this).val();

                $('#child_category_id').html('<option value="">Loading...</option>');

                if (subcategory_id) {
                    $.ajax({
                        url: '/get-childcategories/' + subcategory_id,
                        type: 'GET',
                        success: function(data) {

                            let childOptions =
                                '<option value="">-- Select Child Category --</option>';

                            $.each(data, function(key, value) {
                                childOptions += '<option value="' + value.id + '">' +
                                    value.child_category + '</option>';
                            });

                            $('#child_category_id').html(childOptions);
                        }
                    });
                }
            });

        });
    </script>
    {{-- Editor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
    {{-- multipule tag --}}
    <script>
        var input = document.querySelector('#tag');
        new Tagify(input);
    </script>
    {{-- multipule color --}}
    <script>
        var input = document.querySelector('#color');
        new Tagify(input);
    </script>
    {{-- multipule size --}}
    <script>
        var input = document.querySelector('#size');
        new Tagify(input);
    </script>
@endpush
