@extends('admin.home.master')
@section('title')
    ChildCategory
@endsection
@section('content')
    <div class="content-wrapper ">
        <section class="content ">
            <div class="container-fluid my-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="float-left font-weight-bold inline-block">Child Category Create Form</h3>
                                <a href="{{ route('childCategory.index') }}" class="float-right btn btn-primary">Child
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
                                    <form action="{{ route('childCategory.update', $childCategory->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="child_category">Child Category Title</label>
                                            <input type="text" id="child_category"
                                                class="form-control @error('child_category') is-invalid  @enderror"
                                                placeholder="Enter Child Category Title" name="child_category"
                                                value="{{ old('child_category', $childCategory->child_category) }}">
                                            @error('child_category')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="category_id">Category</label>
                                            <select id="category_id" name="category_id" class="form-control">
                                                <option value="">-- Select Category --</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id', $childCategory->category_id) == $category->id ? 'selected' : '' }}>
                                                        {{ $category->category }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="subCategory_id">Sub Category</label>
                                            <select id="subCategory_id" name="subCategory_id" class="form-control">
                                                <option value="">-- Select Sub Category --</option>
                                                @foreach ($subCategories as $subCategory)
                                                    <option value="{{ $subCategory->id }}"
                                                        {{ old('subCategory_id', $childCategory->subCategory_id) == $subCategory->id ? 'selected' : '' }}>
                                                        {{ $subCategory->sub_category }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('subCategory_id')
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
@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {

    $('#category_id').on('change', function() {

        var category_id = $(this).val();

        if (category_id) {

            $.ajax({
                url: "{{ url('get-subcategories') }}/" + category_id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#subCategory_id').empty();
                    $('#subCategory_id').append('<option value="">-- Select Sub Category --</option>');

                    $.each(data, function(key, value) {
                        $('#subCategory_id').append(
                            '<option value="' + value.id + '">' + value.sub_category + '</option>'
                        );
                    });
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });

        } else {
            // If no category is selected, clear subcategory
            $('#subCategory_id').empty();
            $('#subCategory_id').append('<option value="">-- Select Sub Category --</option>');
        }

    });

});
</script>
@endpush
