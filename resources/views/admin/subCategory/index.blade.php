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
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a href="{{ route('subCategory.create') }}" class="btn btn-primary">Create</a>
                                        </div>
                                        <div class="col-md-8">
                                            <h2>Sub Category Deatils</h2>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                <table id="example" class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Si</th>
                                            <th>Sub Cateogry title</th>
                                            <th>Cateogry</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1; @endphp
                                        @foreach ($subCategories as $data)
                                            <tr>
                                                <td>#{{ $i++ }}</td>
                                                <td>{{ $data->sub_category }}</td>
                                                <td>{{ $data->category->category ?? 'No Category' }}</td>
                                                <td class="d-flex">
                                                    <a href="{{ route('subCategory.edit', $data->id) }}"
                                                        class="btn btn-info me-2">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <form action="{{ route('subCategory.destroy', $data->id) }}" method="POST"
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
