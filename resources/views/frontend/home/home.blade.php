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
                                        <a href="#">
                                            <img src="{{ asset($data->image) }}" alt="{{ $data->category }}">
                                        </a>
                                    </div>
                                    <div class="cat_name">
                                        <a href="#">{{ $data->category }}</a>
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
        {{-- Hot Deal --}}
        @if ($hotDeals->isNotEmpty())
        <div class="col-md-12 col-lg-12 col-sm-6 col-xl-12">
            <div class="row">
                <div class="top-category-header ">
                    <h2>Hot Deal</h2>
                </div>
                <div class="">
                    <div class="swiper categorySwiper">
                        <div class="swiper-wrapper ">
                            <div class="swiper-slide">
                                <div class="product_item wist_item">
                                    @foreach ($hotDeals as $data)
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
                                                <a href="#">
                                                    <img src="{{ asset($data->image) }}" alt="Symphony A30">
                                                </a>
                                            </div>

                                            <div class="pro_des">
                                                <div class="pro_name">
                                                    <a href="#">{{ $data->name }}</a>
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
                                                <a href="#" class="addcartbutton">অর্ডার করুন</a>
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
        {{-- Gadgets & Electronics --}}
        @if ($product_gadgets_electronics->isNotEmpty())
        <div class="col-md-12 col-lg-12 col-sm-6 col-xl-12">
            <div class="row">
                <div class="top-category-header ">
                    <h2>Gadgets & Electronics</h2>
                </div>
                <div class="row product-grid">
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="product_item">
                             <div class="product_item wist_item">
                                    @foreach ($product_gadgets_electronics as $data)
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
                                                <a href="#">
                                                    <img src="{{ asset($data->image) }}" alt="Symphony A30">
                                                </a>
                                            </div>

                                            <div class="pro_des">
                                                <div class="pro_name">
                                                    <a href="#">{{ $data->name }}</a>
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
                                                <a href="#" class="addcartbutton">অর্ডার করুন</a>
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
        {{-- Mobile --}}
        @if ($product_mobile_phone->isNotEmpty())
        <div class="col-md-12 col-lg-12 col-sm-6 col-xl-12">
            <div class="row">
                <div class="top-category-header ">
                    <h2>Mobile Phone</h2>
                </div>
                <div class="row product-grid">
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="product_item">
                             <div class="product_item wist_item">
                                         @foreach ($product_mobile_phone as $data)
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
                                                <a href="#">
                                                    <img src="{{ asset($data->image) }}" alt="Symphony A30">
                                                </a>
                                            </div>

                                            <div class="pro_des">
                                                <div class="pro_name">
                                                    <a href="#">{{ $data->name }}</a>
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
                                                <a href="#" class="addcartbutton">অর্ডার করুন</a>
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
        {{-- Watch --}}
        @if ($product_watch->isNotEmpty())
        <div class="col-md-12 col-lg-12 col-sm-6 col-xl-12">
            <div class="row">
                <div class="top-category-header">
                    <h2>Watch</h2>
                </div>
                <div class="row product-grid">
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="product_item">
                            <div class="product_item">
                             <div class="product_item wist_item">
                                    @foreach ($product_watch as $data)
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
                                                <a href="#">
                                                    <img src="{{ asset($data->image) }}" alt="Symphony A30">
                                                </a>
                                            </div>

                                            <div class="pro_des">
                                                <div class="pro_name">
                                                    <a href="#">{{ $data->name }}</a>
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
                                                <a href="#" class="addcartbutton">অর্ডার করুন</a>
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
        {{-- Winter Collection --}}
        @if ($product_winter_collection->isNotEmpty())
        <div class="col-md-12 col-lg-12 col-sm-6 col-xl-12">
            <div class="row">
                <div class="top-category-header ">
                    <h2>Winter Collection</h2>
                </div>

                <div class="row product-grid">
                      <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="product_item">
                            <div class="product_item">
                             <div class="product_item wist_item">
  
                                        @foreach ($winter_collection as $data)
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
                                                <a href="#">
                                                    <img src="{{ asset($data->image) }}" alt="Symphony A30">
                                                </a>
                                            </div>

                                            <div class="pro_des">
                                                <div class="pro_name">
                                                    <a href="#">{{ $data->name }}</a>
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
                                                <a href="#" class="addcartbutton">অর্ডার করুন</a>
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
