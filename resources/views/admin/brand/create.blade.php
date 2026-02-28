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
                                <h3 class="float-left font-weight-bold inline-block">Brand Create Form</h3>
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
                                    <form action="{{ route('brand.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" id="name"
                                                class="form-control @error('name') is-invalid  @enderror"
                                                placeholder="Enter Brand Name" name="name" value="{{ old('name') }}">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="logo">Logo</label>
                                            <input type="file" id="logo"
                                                class="form-control @error('logo') is-invalid  @enderror" name="logo"
                                                value="{{ old('logo') }}">
                                            @error('logo')
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
