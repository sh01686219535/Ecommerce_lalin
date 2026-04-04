@extends('admin.home.master')
@section('title', 'Order')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid my-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="text-center">Order Details</h2>
                            </div>
                            <div class="card-body">
                                <table id="example" class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Si</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Product</th>
                                            <th>Approve</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1; @endphp
                                        @foreach ($order as $data)
                                            <tr>
                                                <td>#{{ $i++ }}</td>
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $data->phone }}</td>
                                                <td>
                                                    <a href="{{ route('admin.order.product', $data->id) }}"
                                                        class="btn btn-info">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    @if ($data->status === 'approved')
                                                        <span class="badge bg-success px-3 py-2">
                                                            <i class="fas fa-check-circle"></i> Approved
                                                        </span>
                                                    @elseif ($data->status === 'cancel')
                                                        <span class="badge bg-danger px-3 py-2">
                                                            <i class="fas fa-times-circle"></i> Canceled
                                                        </span>
                                                    @else
                                                        <a href="{{ route('admin.order.approve', $data->id) }}"
                                                            class="btn btn-success btn-sm me-2">
                                                            <i class="fas fa-check-circle"></i> Approve
                                                        </a>
                                                        <a href="{{ route('admin.order.cancel', $data->id) }}"
                                                            class="btn btn-danger btn-sm">
                                                            <i class="fas fa-times-circle"></i> Cancel
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="d-flex">
                                                    <a href="{{ route('admin.order.edit', $data->id) }}"
                                                        class="btn btn-info me-2">
                                                        <i class="fa-solid fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('admin.order.pdf', $data->id) }}"
                                                        class="btn btn-success me-2" target="_blank">
                                                        <i class="fa-solid fa-download"></i>
                                                    </a>
                                                    <form action="{{ route('admin.order.delete', $data->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <button class="btn btn-danger" type="submit"
                                                            onclick="return confirm('Are you sure you want to delete this?')">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- card-body -->
                        </div> <!-- card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
