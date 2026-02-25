@extends('admin.home.master')
@section('title')
    Product
@endsection
@section('content')
<div class="content-wrapper ">
        <section class="content ">
            <div class="container-fluid my-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('product.create') }}" class="btn btn-primary">Create</a>
                            </div>
                            <div class="card-body">
                                <table id="example" class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Si</th>
                                            <th>Price</th>
                                            <th>Bedroom</th>
                                            <th>Bathroom</th>
                                            <th>Location</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        {{-- @foreach ($property as $data)
                                            <tr>
                                                <td>#{{ $i++ }}</td>
                                                <td>{{ $data->price }}</td>
                                                <td>{{ $data->bedroom }}</td>
                                                <td>{{ $data->bathroom }}</td>
                                                <td>{{ $data->location }}</td>
                                                <td>{{ Str::limit($data->description, 20) }}</td>
                                                <td>
                                                    <img src="{{ asset($data->image) }}" width="50" height="50"
                                                        alt="">
                                                </td>
                                                <td class="d-flex">
                                                    <a href="{{route('admin_property.edit',$data->id)}}" class="btn btn-info"><i
                                                            class="fa-solid fa-pen-to-square"></i></a>
                                                    <form class="badge" action="{{ route('admin_property.destroy', $data->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger " type="submit"
                                                            onclick="return confirm('Are you sure you want to delete this?')">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach --}}

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

    
