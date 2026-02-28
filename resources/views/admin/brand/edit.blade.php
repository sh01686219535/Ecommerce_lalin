@extends('admin.home.master')
@section('title')
    Brand
@endsection
@section('content')
    <div class="content-wrapper ">
        <section class="content ">
            <div class="container-fluid my-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="float-left font-weight-bold inline-block">Brand Update Form</h3>
                                <a href="{{ route('brand.index') }}" class="float-right btn btn-primary">Brand</a>
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
                                    <form action="{{ route('brand.update', $brand->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group mb-3">
                                            <label for="name">Name</label>
                                            <input type="text" id="name"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name', $brand->name) }}" placeholder="Enter Brand Name">

                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="form-group mb-3">
                                            <label for="logo">Logo</label>

                                            <!-- Image Preview -->
                                            <div class="mb-2">
                                                <img id="logoPreview"
                                                    src="{{ $brand->logo ? asset($brand->logo) : 'https://via.placeholder.com/80' }}"
                                                    width="80" class="rounded border shadow-sm"
                                                    style="object-fit:cover;">
                                            </div>

                                            <input type="file" id="logo" name="logo"
                                                class="form-control @error('logo') is-invalid @enderror">

                                            @error('logo')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="status">Status</label>
                                            <select id="status"
                                                class="form-control @error('status') is-invalid @enderror" name="status">

                                                <option value="">Select Status</option>
                                                <option value="1"
                                                    {{ old('status', $brand->status) == 1 ? 'selected' : '' }}>
                                                    Active
                                                </option>
                                                <option value="0"
                                                    {{ old('status', $brand->status) == 0 ? 'selected' : '' }}>
                                                    Inactive
                                                </option>
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
@push('js')
    <script>
        document.getElementById('logo').addEventListener('change', function(event) {

            let reader = new FileReader();

            reader.onload = function() {
                document.getElementById('logoPreview').src = reader.result;
            }

            reader.readAsDataURL(event.target.files[0]);
        });
    </script>
@endpush
