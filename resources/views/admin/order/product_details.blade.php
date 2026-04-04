@extends('admin.home.master')

@section('title', 'product Details')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container my-5">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="row g-0">
                        {{-- product Image --}}
                        <div class="col-md-5">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                class="img-fluid w-100 h-100 object-fit-cover">
                        </div>

                        {{-- product Details --}}
                        <div class="col-md-7 bg-light">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h3 class="fw-bold text-primary mb-0"></h3>
                                    <a href="{{ route('admin.order') }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-arrow-left"></i> Back to Orders
                                    </a>
                                </div>

                                <p class="text-muted mb-1">
                                    <strong>Category:</strong>
                                    {{ $categories->where('id', $product->category_id)->first()->category ?? 'N/A' }}
                                </p>

                                <hr>

                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <p><strong>Name:</strong> {{ $product->name }}</p>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <p><strong>Brand:</strong> {{ $product->brand->name ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <p><strong>Price:</strong> {{ number_format($product->price) }} Taka</p>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <p><strong>Discount Price:</strong> {{ number_format($product->discount_price) }}
                                            Taka</p>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <p><strong>Color:</strong>
                                            @if (!empty($product->color) && is_array($product->color))
                                                {{ collect($product->color)->pluck('value')->implode(', ') }}
                                            @else
                                                N/A
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <p><strong>Size:</strong>
                                            @if (!empty($product->size) && is_array($product->size))
                                                @php
                                                    $sizes = collect($product->size)
                                                        ->pluck('value') // get 'value' fields
                                                        ->filter(fn($v) => $v && $v !== 'null') // remove empty or "null" strings
                                                        ->implode(', ');
                                                @endphp
                                                {{ $sizes ?: 'N/A' }}
                                            @else
                                                N/A
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <hr>

                                <div>
                                    <h5 class="fw-bold text-secondary mb-2">Description</h5>
                                    <p class="text-dark">
                                        {!! $product->description !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('styles')
    <style>
        .object-fit-cover {
            object-fit: cover;
            height: 100%;
        }

        .card-body p {
            font-size: 15px;
        }
    </style>
@endpush
