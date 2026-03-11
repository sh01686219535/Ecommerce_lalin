@extends('frontend.home.master')
@section('content')
    @include('frontend.include.slider')
    <section class="properties">
        {{-- Top Categroy --}}
        @if ($categories->isNotEmpty())
            <div class="col-md-12 col-lg-12 col-sm-6 col-xl-12">
                <div class="row">
                    <div class="top-category-header ">
                        <h2>Top Categories</h2>
                    </div>
                    {{-- Top Ctegory Start --}}
                    <div class="swiper categorySwiper topcategory">
                        <div class="swiper-wrapper">
                            @foreach ($categories as $data)
                                <div class="swiper-slide">
                                    <div class="cat_item">
                                        <div class="cat_img">
                                            <a href="{{ route('product.details', $data->id) }}">
                                                <img src="{{ asset($data->image) }}" alt="{{ $data->category }}">
                                            </a>
                                        </div>
                                        <div class="cat_name">
                                            <a href="{route('product.details',$data->id)}}">{{ $data->category }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Navigation -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        @endif
        {{-- featured_product --}}
        @if ($featured_product->isNotEmpty())
            <div class="col-md-12 col-lg-12 col-sm-6 col-xl-12">
                <div class="row">
                    <div class="top-category-header ">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="">
                        <div class="swiper categorySwiper">
                            <div class="swiper-wrapper ">
                                <div class="swiper-slide">
                                    <div class="product_item wist_item">
                                        @foreach ($featured_product as $data)
                                            <div class="product_item_inner">
                                                <div class="sale-badge">
                                                    <div class="sale-badge-inner">
                                                        <div class="sale-badge-box">
                                                            <span class="sale-badge-text">
                                                                @if ($data->discount_price_percentage)
                                                                    <p>{{ $data->discount_price_percentage }}%</p>
                                                                    ছাড়
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="pro_img">
                                                    <a href="{{ route('product.details', $data->id) }}">
                                                        <img src="{{ asset($data->image) }}" alt="Symphony A30">
                                                    </a>
                                                </div>

                                                <div class="pro_des">
                                                    <div class="pro_name">
                                                        <a
                                                            href="{{ route('product.details', $data->id) }}">{{ $data->name }}</a>
                                                    </div>
                                                    <div class="pro_price">
                                                        <p>
                                                            @if ($data->discount_price && $data->discount_price < $data->price)
                                                                <del>৳ {{ number_format($data->price, 2) }}</del>
                                                                ৳ {{ number_format($data->discount_price, 2) }}
                                                            @elseif($data->price)
                                                                ৳ {{ number_format($data->price, 2) }}
                                                            @else
                                                                <del>৳ 00</del>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="pro_btn">
                                                <div class="cart_btn order_button">
                                                    <a href="{{ route('order', $data->id) }}"
                                                        data-id="{{ $data->id }}"
                                                        class="addcartbutton add-to-cart">অর্ডার
                                                        করুন</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="view-more">
                                <a href="">View More</a>
                            </div>
                        </div>
                        <!-- Navigation -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        @endif
        {{-- top Selling Product --}}
        @if ($top_selling_Product->isNotEmpty())
            <div class="col-md-12 col-lg-12 col-sm-6 col-xl-12">
                <div class="row">
                    <div class="top-category-header ">
                        <h2>Top Selling Product</h2>
                    </div>
                    <div class="row product-grid">
                        <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                            <div class="product_item">
                                <div class="product_item wist_item">
                                    @foreach ($top_selling_Product as $data)
                                        <div class="product_item_inner">
                                            <div class="sale-badge">
                                                <div class="sale-badge-inner">
                                                    <div class="sale-badge-box">
                                                        <span class="sale-badge-text">
                                                            @if ($data->discount_price_percentage)
                                                                <p>{{ $data->discount_price_percentage }}%</p>
                                                                ছাড়
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="pro_img">
                                                <a href="{{ route('product.details', $data->id) }}">
                                                    <img src="{{ asset($data->image) }}" alt="Symphony A30">
                                                </a>
                                            </div>

                                            <div class="pro_des">
                                                <div class="pro_name">
                                                    <a
                                                        href="{{ route('product.details', $data->id) }}">{{ $data->name }}</a>
                                                </div>
                                                <div class="pro_price">
                                                    <p>
                                                        @if ($data->discount_price && $data->discount_price < $data->price)
                                                            <del>৳ {{ number_format($data->price, 2) }}</del>
                                                            ৳ {{ number_format($data->discount_price, 2) }}
                                                        @elseif($data->price)
                                                            ৳ {{ number_format($data->price, 2) }}
                                                        @else
                                                            <del>৳ 00</del>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="pro_btn">
                                            <div class="cart_btn order_button">
                                                <a href="{{ route('order', $data->id) }}" data-id="{{ $data->id }}"
                                                    class="addcartbutton add-to-cart">অর্ডার
                                                    করুন</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <a href="#" class="view-more-btn">View More</a>
                    </div>
                </div>
            </div>
        @endif
        {{-- new_launch_product --}}
        @if ($new_launch_product->isNotEmpty())
            <div class="col-md-12 col-lg-12 col-sm-6 col-xl-12">
                <div class="row">
                    <div class="top-category-header ">
                        <h2>New Launch Product</h2>
                    </div>
                    <div class="row product-grid">
                        <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                            <div class="product_item">
                                <div class="product_item wist_item">
                                    @foreach ($new_launch_product as $data)
                                        <div class="product_item_inner">
                                            <div class="sale-badge">
                                                <div class="sale-badge-inner">
                                                    <div class="sale-badge-box">
                                                        <span class="sale-badge-text">
                                                            @if ($data->discount_price_percentage)
                                                                <p>{{ $data->discount_price_percentage }}%</p>
                                                                ছাড়
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="pro_img">
                                                <a href="{{ route('product.details', $data->id) }}">
                                                    <img src="{{ asset($data->image) }}" alt="Symphony A30">
                                                </a>
                                            </div>

                                            <div class="pro_des">
                                                <div class="pro_name">
                                                    <a
                                                        href="{{ route('product.details', $data->id) }}">{{ $data->name }}</a>
                                                </div>
                                                <div class="pro_price">
                                                    <p>
                                                        @if ($data->discount_price && $data->discount_price < $data->price)
                                                            <del>৳ {{ number_format($data->price, 2) }}</del>
                                                            ৳ {{ number_format($data->discount_price, 2) }}
                                                        @elseif($data->price)
                                                            ৳ {{ number_format($data->price, 2) }}
                                                        @else
                                                            <del>৳ 00</del>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="pro_btn">
                                            <div class="cart_btn order_button">
                                                <a href="{{ route('order', $data->id) }}" data-id="{{ $data->id }}"
                                                    class="addcartbutton add-to-cart">অর্ডার
                                                    করুন</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <a href="#" class="view-more-btn">View More</a>
                    </div>
                </div>
            </div>
        @endif
        {{-- most_popular_product --}}
        @if ($most_popular_product->isNotEmpty())
            <div class="col-md-12 col-lg-12 col-sm-6 col-xl-12">
                <div class="row">
                    <div class="top-category-header">
                        <h2>Most Popular Product</h2>
                    </div>
                    <div class="row product-grid">
                        <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                            <div class="product_item">
                                <div class="product_item">
                                    <div class="product_item wist_item">
                                        @foreach ($most_popular_product as $data)
                                            <div class="product_item_inner">
                                                <div class="sale-badge">
                                                    <div class="sale-badge-inner">
                                                        <div class="sale-badge-box">
                                                            <span class="sale-badge-text">
                                                                @if ($data->discount_price_percentage)
                                                                    <p>{{ $data->discount_price_percentage }}%</p>
                                                                    ছাড়
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="pro_img">
                                                    <a href="{{ route('product.details', $data->id) }}">
                                                        <img src="{{ asset($data->image) }}" alt="Symphony A30">
                                                    </a>
                                                </div>

                                                <div class="pro_des">
                                                    <div class="pro_name">
                                                        <a
                                                            href="{{ route('product.details', $data->id) }}">{{ $data->name }}</a>
                                                    </div>
                                                    <div class="pro_price">
                                                        <p>
                                                            @if ($data->discount_price && $data->discount_price < $data->price)
                                                                <del>৳ {{ number_format($data->price, 2) }}</del>
                                                                ৳ {{ number_format($data->discount_price, 2) }}
                                                            @elseif($data->price)
                                                                ৳ {{ number_format($data->price, 2) }}
                                                            @else
                                                                <del>৳ 00</del>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="pro_btn">
                                                <div class="cart_btn order_button">
                                                    <a href="{{ route('order', $data->id) }}"
                                                        data-id="{{ $data->id }}"
                                                        class="addcartbutton add-to-cart">অর্ডার
                                                        করুন</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <a href="#" class="view-more-btn">View More</a>
                    </div>
                </div>
            </div>
        @endif
        {{-- Regular Product --}}
        @if ($regular_product->isNotEmpty())
            <div class="col-md-12 col-lg-12 col-sm-6 col-xl-12">
                <div class="row">
                    <div class="top-category-header ">
                        <h2>Regular Product</h2>
                    </div>

                    <div class="row product-grid">
                        <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                            <div class="product_item">
                                <div class="product_item">
                                    <div class="product_item wist_item">

                                        @foreach ($regular_product as $data)
                                            <div class="product_item_inner">
                                                <div class="sale-badge">
                                                    <div class="sale-badge-inner">
                                                        <div class="sale-badge-box">
                                                            <span class="sale-badge-text">
                                                                @if (!empty($data->discount_price_percentage))
                                                                    <p>{{ $data->discount_price_percentage }}%</p>
                                                                    ছাড়
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="pro_img">
                                                    <a href="{{ route('product.details', $data->id) }}">
                                                        <img src="{{ asset($data->image) }}" alt="Symphony A30">
                                                    </a>
                                                </div>

                                                <div class="pro_des">
                                                    <div class="pro_name">
                                                        <a
                                                            href="{{ route('product.details', $data->id) }}">{{ $data->name }}</a>
                                                    </div>
                                                    <div class="pro_price">
                                                        <p>
                                                            @if ($data->discount_price && $data->discount_price < $data->price)
                                                                <del>৳ {{ number_format($data->price, 2) }}</del>
                                                                ৳ {{ number_format($data->discount_price, 2) }}
                                                            @elseif($data->price)
                                                                ৳ {{ number_format($data->price, 2) }}
                                                            @else
                                                                <del>৳ 00</del>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="pro_btn">
                                                <div class="cart_btn order_button">
                                                    <a href="{{ route('order', $data->id) }}"
                                                        data-id="{{ $data->id }}"
                                                        class="addcartbutton add-to-cart">অর্ডার
                                                        করুন</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <a href="#" class="view-more-btn">View More</a>
                    </div>
                </div>
            </div>
        @endif
        </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        document.querySelectorAll('.add-to-cart').forEach(btn => {
            btn.addEventListener('click', function() {
                let productId = btn.getAttribute('data-id');

                fetch(`/cart/add/${productId}`)
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('cartCount').textContent = data.cartCount;
                        
                    });
            });
        });

        function addToCart(productId) {
            fetch(`/cart/add/${productId}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('cartCount').textContent = data.cartCount;
                    
                });
        }
    </script>
@endpush
