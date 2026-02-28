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
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a href="{{ route('brand.create') }}" class="btn btn-primary">Create</a>
                                        </div>
                                        <div class="col-md-8">
                                            <h2>Brand Deatils</h2>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                <table id="example" class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Si</th>
                                            <th>Name</th>
                                            <th>Logo</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1; @endphp
                                        @foreach ($brand as $data)
                                            <tr>
                                                <td>#{{ $i++ }}</td>
                                                <td>{{ $data->name }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset($data->logo) }}" width="50" height="50"
                                                            class="rounded-circle border shadow-sm me-2"
                                                            style="object-fit: cover;">
                                                    </div>
                                                </td>

                                                <td>
                                                    @if ($data->status == 1)
                                                        <span class="badge bg-success px-3 py-2">
                                                            Active
                                                        </span>
                                                    @else
                                                        <span class="badge bg-danger px-3 py-2">
                                                            Inactive
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="d-flex">
                                                    <a href="{{ route('brand.edit', $data->id) }}"
                                                        class="btn btn-info me-2">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <form action="{{ route('brand.destroy', $data->id) }}" method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
