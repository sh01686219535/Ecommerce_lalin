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
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a href="{{ route('category.create') }}" class="btn btn-primary">Create</a>
                                        </div>
                                        <div class="col-md-8">
                                            <h2>Category Deatils</h2>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                <table id="example" class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Si</th>
                                            <th>Cateogry title</th>
                                            <th>Cateogry Image</th>
                                            <th>Cateogry Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1; @endphp
                                        @foreach ($categories as $data)
                                            <tr>
                                                <td>#{{ $i++ }}</td>
                                                <td>{{ $data->category }}</td>
                                                <td>
                                                    <img src="{{asset($data->image)}}" width="50" height="50" alt="">
                                                </td>
                                                <td>
                                                    @if ($data->status == 1)
                                                        <span class="badge  bg-success">Active</span>
                                                    @else
                                                        <span class="badge  bg-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="d-flex">
                                                    <a href="{{ route('category.edit', $data->id) }}"
                                                        class="btn btn-info me-2">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <form action="{{ route('category.destroy', $data->id) }}" method="POST"
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
