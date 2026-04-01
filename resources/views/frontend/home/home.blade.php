@extends('frontend.home.master')

@section('content')
    @include('frontend.include.slider')
    @push('css')
        <style>
            .product_item {
                background: #fff;
                border-radius: 8px;
                padding: 10px;
                text-align: center;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            }

            .product_item img {
                width: 100%;
                height: 150px;
                object-fit: cover;
            }

            .pro_name {
                font-size: 14px;
                margin: 8px 0;
            }

            .pro_price del {
                color: red;
                font-size: 13px;
            }

            .pro_price span {
                color: green;
                font-weight: bold;
            }

            .sale-badge {
                background: red;
                color: #fff;
                font-size: 12px;
                padding: 2px 6px;
                position: absolute;
            }

            .pro_btn a {
                display: block;
                background: green;
                color: #fff;
                padding: 6px;
                margin-top: 10px;
                border-radius: 4px;
                text-decoration: none;
            }

            .section-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            /* Product Card */
            .product_item {
                background: #fff;
                padding: 12px;
                border-radius: 10px;
                text-align: center;
                transition: 0.3s;
                position: relative;
            }

            .product_item:hover {
                transform: translateY(-5px);
            }

            /* Image */
            .pro_img img {
                width: 100%;
                height: 160px;
                object-fit: cover;
            }

            /* Name */
            .pro_name {
                font-size: 14px;
                margin: 10px 0;
            }

            /* Price */
            .pro_price del {
                color: red;
                font-size: 12px;
            }

            .pro_price span {
                color: green;
                font-weight: bold;
            }

            /* Button */
            .pro_btn a {
                display: block;
                background: #0a9e0a;
                color: #fff;
                padding: 6px;
                border-radius: 5px;
                text-decoration: none;
            }

            /* Discount */
            .sale-badge {
                position: absolute;
                top: 5px;
                left: 5px;
                background: red;
                color: #fff;
                font-size: 12px;
                padding: 3px 6px;
                border-radius: 3px;
            }

            /* View More */
            .view-btn {
                background: #ff6600;
                color: #fff;
                padding: 8px 20px;
                border-radius: 20px;
                text-decoration: none;
            }

            /* Swiper fix */
            .swiper {
                padding-bottom: 30px;
            }
        </style>
    @endpush


    {{-- ================= TOP CATEGORY ================= --}}
    {{-- @if ($categories->isNotEmpty())
    <div class="container">
        <div class="top-category-header">
            <h2>Top Categories</h2>
        </div>

        <div class="swiper topcategory">
            <div class="swiper-wrapper">
                @foreach ($categories as $data)
                <div class="swiper-slide">
                    <div class="cat_item">
                        <a href="{{ route('product.details', $data->id) }}">
                            <img src="{{ asset($data->image) }}">
                            <p>{{ $data->category }}</p>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="swiper-button-next top-next"></div>
            <div class="swiper-button-prev top-prev"></div>
        </div>
    </div>
    @endif --}}


    {{-- ================= FEATURED PRODUCT ================= --}}
    {{-- @if ($featured_product->isNotEmpty())
    <div class="container mt-4">
        <h2>Featured Product</h2>

        <div class="swiper featuredSwiper">
            <div class="swiper-wrapper">
                @foreach ($featured_product as $data)
                <div class="swiper-slide">
                    @include('frontend.include.product-card', ['data' => $data])
                </div>
                @endforeach
            </div>

            <div class="swiper-button-next featured-next"></div>
            <div class="swiper-button-prev featured-prev"></div>
        </div>
    </div>
    @endif --}}


    {{-- ================= GRID PRODUCTS (ALL SAME STRUCTURE) ================= --}}
    {{-- @php
        $sections = [
            'Top Selling Product' => $top_selling_Product,
            'New Launch Product' => $new_launch_product,
            'Most Popular Product' => $most_popular_product,
            'Regular Product' => $regular_product,
        ];
    @endphp --}}
    {{-- 
    @foreach ($sections as $title => $products)
        @if ($products->isNotEmpty())
        <div class="container mt-4">
            <h2>{{ $title }}</h2>

            <div class="row">
                @foreach ($products as $data)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    @include('frontend.include.product-card', ['data' => $data])
                </div>
                @endforeach
            </div>
        </div>
        @endif
    @endforeach --}}


    <section class="properties">

        @php
            $sections = [
                [
                    'title' => 'Featured Product',
                    'products' => $featured_product,
                    'route' => route('featured.product.view'),
                ],
                [
                    'title' => 'Top Selling Product',
                    'products' => $top_selling_Product,
                    'route' => route('topSelling.product.view'),
                ],
                [
                    'title' => 'New Launch Product',
                    'products' => $new_launch_product,
                    'route' => route('newLaunch.product.view'),
                ],
                [
                    'title' => 'Most Popular Product',
                    'products' => $most_popular_product,
                    'route' => route('popular.product.view'),
                ],
                [
                    'title' => 'Regular Product',
                    'products' => $regular_product,
                    'route' => route('regular.product.view'),
                ],
            ];
        @endphp

        @foreach ($sections as $sec)
            @if ($sec['products']->isNotEmpty())
                <div class="container mt-4">

                    {{-- Header --}}
                    <div class="section-header">
                        <h2>{{ $sec['title'] }}</h2>
                    </div>

                    {{-- Slider --}}
                    <div class="swiper productSwiper">
                        <div class="swiper-wrapper">

                            @foreach ($sec['products'] as $data)
                                <div class="swiper-slide">
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
                                                <img src="{{ asset($data->image) }}">
                                            </a>
                                        </div>

                                        {{-- Name --}}
                                        <div class="pro_name">
                                            {{ $data->name }}
                                        </div>

                                        {{-- Price --}}
                                        <div class="pro_price">
                                            @if ($data->discount_price && $data->discount_price < $data->price)
                                                <del>৳ {{ $data->price }}</del>
                                                <span>৳ {{ $data->discount_price }}</span>
                                            @else
                                                <span>৳ {{ $data->price }}</span>
                                            @endif
                                        </div>

                                        {{-- Button --}}
                                        <div class="pro_btn">
                                            <a href="{{ route('order', $data->id) }}" data-id="{{ $data->id }}"
                                                class="add-to-cart">
                                                অর্ডার করুন
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            @endforeach

                        </div>

                        {{-- Navigation --}}
                        <div class="swiper-button-next custom-next"></div>
                        <div class="swiper-button-prev custom-prev"></div>
                    </div>

                    {{-- View More --}}
                    <div class="text-center mt-3">
                        <a href="{{ $sec['route'] }}" class="view-btn">View More</a>
                    </div>

                </div>
            @endif
        @endforeach

    </section>
@endsection
@push('js')
    <script>
        /* Add to Cart */
        document.querySelectorAll('.add-to-cart').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();

                let id = this.getAttribute('data-id');

                fetch(`/cart/add/${id}`)
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('cartCount').innerText = data.cartCount;
                    });
            });
        });
    </script>

    <script>
        /* Product Slider */
        document.querySelectorAll('.productSwiper').forEach((el) => {
            new Swiper(el, {
                slidesPerView: 5,
                spaceBetween: 20,
                loop: true,

                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },

                navigation: {
                    nextEl: el.querySelector('.custom-next'),
                    prevEl: el.querySelector('.custom-prev'),
                },

                breakpoints: {
                    320: {
                        slidesPerView: 2
                    },
                    576: {
                        slidesPerView: 3
                    },
                    768: {
                        slidesPerView: 4
                    },
                    992: {
                        slidesPerView: 5
                    }
                }
            });
        });
    </script>
    <script>
        /* Add to cart */
        document.querySelectorAll('.add-to-cart').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();

                let id = this.getAttribute('data-id');

                fetch(`/cart/add/${id}`)
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('cartCount').innerText = data.cartCount;
                    });
            });
        });
    </script>

    <script>
        /* Top Category */
        new Swiper(".topcategory", {
            slidesPerView: 4,
            spaceBetween: 20,
            loop: true,
            navigation: {
                nextEl: ".top-next",
                prevEl: ".top-prev",
            },
            breakpoints: {
                320: {
                    slidesPerView: 2
                },
                576: {
                    slidesPerView: 3
                },
                768: {
                    slidesPerView: 4
                },
                992: {
                    slidesPerView: 5
                }
            }
        });

        /* Featured */
        new Swiper(".featuredSwiper", {
            slidesPerView: 4,
            spaceBetween: 20,
            loop: true,
            navigation: {
                nextEl: ".featured-next",
                prevEl: ".featured-prev",
            },
        });
    </script>
@endpush
