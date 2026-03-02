@extends('admin.home.master')

@section('title')
    Product Edit
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid my-5">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="float-left font-weight-bold">Product Update Form</h3>
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
                                    <form action="{{ route('product.update', $product->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        {{-- TOP SECTION --}}
                                        <div class="group-top">
                                            <div class="form-group">
                                                <label>Product Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ old('name', $product->name) }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Product Tag</label>
                                                <input type="text" id="tag" name="tag" class="form-control"
                                                    value="{{ old('tag', json_encode($product->tag)) }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Product Price</label>
                                                <input type="number" name="price" class="form-control"
                                                    value="{{ old('price', $product->price) }}">
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Discount Percentage</label>
                                                        <input type="number" name="discount_price_percentage"
                                                            class="form-control"
                                                            value="{{ old('discount_price_percentage', $product->discount_price_percentage) }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Discount Price</label>
                                                        <input type="number" name="discount_price" class="form-control"
                                                            value="{{ old('discount_price', $product->discount_price) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        {{-- MIDDLE SECTION --}}
                                        <div class="group-bottom">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Color</label>
                                                        <input type="text" id="color" name="color"
                                                            class="form-control"
                                                            value="{{ old('color', json_encode($product->color)) }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Size</label>
                                                        <input type="text" id="size" name="size"
                                                            class="form-control"
                                                            value="{{ old('size', json_encode($product->size)) }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Brand</label>
                                                        <select name="brand_id" class="form-control">
                                                            <option value="">-- Select Brand --</option>
                                                            @foreach ($brand as $data)
                                                                <option value="{{ $data->id }}"
                                                                    {{ old('brand_id', $product->brand_id) == $data->id ? 'selected' : '' }}>
                                                                    {{ $data->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Category</label>
                                                        <select id="category_id" name="category_id" class="form-control">
                                                            <option value="">-- Select Category --</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}"
                                                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                                    {{ $category->category }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Sub Category</label>
                                                        <select id="sub_category_id" name="sub_category_id"
                                                            class="form-control">
                                                            <option value="">-- Select Sub Category --</option>
                                                            @foreach ($sunCategories->where('category_id', $product->category_id) as $sub)
                                                                <option value="{{ $sub->id }}"
                                                                    {{ old('sub_category_id', $product->sub_category_id) == $sub->id ? 'selected' : '' }}>
                                                                    {{ $sub->sub_category }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Child Category</label>
                                                        <select id="child_category_id" name="child_category_id"
                                                            class="form-control">
                                                            <option value="">-- Select Child Category --</option>
                                                            @foreach ($childCategories->where('sub_category_id', $product->sub_category_id) as $child)
                                                                <option value="{{ $child->id }}"
                                                                    {{ old('child_category_id', $product->child_category_id) == $child->id ? 'selected' : '' }}>
                                                                    {{ $child->child_category }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        {{-- DESCRIPTION SECTION --}}
                                        <div class="group-bottom">
                                            <div class="form-group">
                                                <label>Short Description</label>
                                                <textarea name="short_description" class="form-control">{{ old('short_description', $product->short_description) }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea id="description" name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
                                            </div>

                                            <div class="row">
                                                {{-- Single Image --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Current Image</label>
                                                        @if ($product->image && file_exists(public_path($product->image)))
                                                            <div class="mb-2">
                                                                <img src="{{ asset($product->image) }}"
                                                                    alt="Current Image" class="img-thumbnail"
                                                                    width="100">
                                                            </div>
                                                        @endif
                                                        <input type="file" name="image" class="form-control"
                                                            id="image">
                                                        <div id="imagePreview" class="mt-2"></div>
                                                    </div>
                                                </div>

                                                {{-- Multiple Images --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Current Multiple Images</label>
                                                        <div class="mb-2 d-flex flex-wrap gap-2">
                                                            @php
                                                                $multiImages = is_array($product->multi_image)
                                                                    ? $product->multi_image
                                                                    : json_decode($product->multi_image);
                                                            @endphp

                                                            @if ($multiImages)
                                                                @foreach ($multiImages as $multi)
                                                                    @if (file_exists(public_path($multi)))
                                                                        <img src="{{ asset($multi) }}"
                                                                            class="img-thumbnail" width="100">
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <input type="file" name="multi_image[]" id="multi_image"
                                                            multiple class="form-control">
                                                        <div id="multiImagePreview" class="mt-2 d-flex flex-wrap gap-2">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="">Select Status</option>
                                                    <option value="1"
                                                        {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Active
                                                    </option>
                                                    <option value="0"
                                                        {{ old('status', $product->status) == 0 ? 'selected' : '' }}>
                                                        Inactive</option>
                                                </select>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>Youtube Video URL</label>
                                                        <input type="text" name="video_url" class="form-control"
                                                            value="{{ old('video_url', $product->video_url) }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-check form-switch mt-4">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="is_featured" value="1"
                                                            {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                                                        <label class="form-check-label">Featured Product</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <br>
                                        <button type="submit" class="btn btn-success">Update Product</button>

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

    {{-- CKEditor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>

    {{-- Tagify for tag, color, size --}}
    <script src="https://unpkg.com/@yaireo/tagify"></script>
    <script>
        new Tagify(document.querySelector('#tag'));
        new Tagify(document.querySelector('#color'));
        new Tagify(document.querySelector('#size'));
    </script>

    {{-- Category → Subcategory & ChildCategory --}}
    <script>
        $(document).ready(function() {
            $('#category_id').on('change', function() {
                let category_id = $(this).val();
                $('#sub_category_id').html('<option>Loading...</option>');
                $('#child_category_id').html('<option>-- Select Child Category --</option>');

                if (category_id) {
                    $.get('/get-subcategories/' + category_id, function(data) {
                        let html = '<option value="">-- Select Sub Category --</option>';
                        $.each(data, function(key, sub) {
                            html += '<option value="' + sub.id + '">' + sub.sub_category +
                                '</option>';
                        });
                        $('#sub_category_id').html(html);
                    });
                }
            });

            $('#sub_category_id').on('change', function() {
                let sub_id = $(this).val();
                $('#child_category_id').html('<option>Loading...</option>');

                if (sub_id) {
                    $.get('/get-childcategories/' + sub_id, function(data) {
                        let html = '<option value="">-- Select Child Category --</option>';
                        $.each(data, function(key, child) {
                            html += '<option value="' + child.id + '">' + child
                                .child_category + '</option>';
                        });
                        $('#child_category_id').html(html);
                    });
                }
            });
        });
    </script>
    <script>
        // Single Image Preview
        document.getElementById('image').addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = '';
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.width = 120;
                    img.classList.add('img-thumbnail');
                    preview.appendChild(img);
                }
                reader.readAsDataURL(file);
            }
        });

        // Multiple Images Preview
        document.getElementById('multi_image').addEventListener('change', function(e) {
            const preview = document.getElementById('multiImagePreview');
            preview.innerHTML = '';
            const files = e.target.files;
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.width = 80;
                    img.classList.add('img-thumbnail');
                    preview.appendChild(img);
                }
                reader.readAsDataURL(file);
            });
        });
    </script>
@endpush
