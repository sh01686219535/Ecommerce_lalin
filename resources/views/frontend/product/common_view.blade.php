@extends('frontend.home.master')

@section('content')

<section class="product-section">
    <div class="container">

        <div class="section-header mb-4">
            <h2>{{ $title }}</h2>
        </div>

        <div class="row">

            @forelse ($products as $data)
                <div class="col-lg-3 col-md-4 col-6 mb-4">

                    <div class="product_item">

                        {{-- Discount --}}
                        @if ($data->discount_price_percentage)
                            <div class="sale-badge">
                                {{ $data->discount_price_percentage }}%
                            </div>
                        @endif

                        {{-- Image --}}
                        <div class="pro_img">
                            <a href="{{ route('product.details', $data->id) }}">
                                <img src="{{ asset($data->image) }}" alt="{{ $data->name }}">
                            </a>
                        </div>

                        {{-- Name --}}
                        <div class="pro_name">
                            {{ $data->name }}
                        </div>

                        {{-- Price --}}
                        <div class="pro_price">
                            @if ($data->discount_price && $data->discount_price < $data->price)
                                <del>৳ {{ number_format($data->price, 2) }}</del>
                                <span>৳ {{ number_format($data->discount_price, 2) }}</span>
                            @else
                                <span>৳ {{ number_format($data->price, 2) }}</span>
                            @endif
                        </div>

                        {{-- Button --}}
                        <div class="pro_btn">
                            <a href="{{ route('order', $data->id) }}">
                                অর্ডার করুন
                            </a>
                        </div>

                    </div>

                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No Product Found</p>
                </div>
            @endforelse

        </div>

    </div>
</section>

@endsection