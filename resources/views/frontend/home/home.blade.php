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

            /* ===== CATEGORY CARD ===== */
            /* ===== CATEGORY CARD MODERN ===== */
            .cat_item {
                position: relative;
                display: block;
                border-radius: 16px;
                overflow: hidden;
                height: 180px;
                text-decoration: none;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
                transition: all 0.4s ease;
            }

            /* Image */
            .cat_img {
                width: 100%;
                height: 100%;
            }

            .cat_img img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.6s ease;
            }

            /* Overlay Gradient */
            .cat_overlay {
                position: absolute;
                inset: 0;
                background: linear-gradient(to top, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.1));
            }

            /* Category Name */
            .cat_name {
                position: absolute;
                bottom: 15px;
                left: 15px;
                right: 15px;
                color: #fff;
                font-size: 16px;
                font-weight: 600;
                z-index: 2;
            }

            /* Hover Effect */
            .cat_item:hover {
                transform: translateY(-8px) scale(1.02);
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            }

            .cat_item:hover img {
                transform: scale(1.1);
            }

            /* ===== SWIPER BUTTON STYLE ===== */
            .top-next,
            .top-prev {
                background: #fff;
                width: 35px;
                height: 35px;
                border-radius: 50%;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }

            .top-next::after,
            .top-prev::after {
                font-size: 14px;
                color: #333;
            }

            /* ===== RESPONSIVE ===== */
            @media (max-width: 992px) {
                .cat_item {
                    height: 140px;
                }

                .cat_name {
                    font-size: 14px;
                }
            }

            @media (max-width: 576px) {
                .cat_item {
                    height: 120px;
                }

                .cat_name {
                    font-size: 13px;
                }
            }
        </style>
    @endpush


    {{-- ================= TOP CATEGORY ================= --}}
  <section class="properties">
    {{-- CATEGORY --}}
    @if ($categories->isNotEmpty())
        <div class="container mt-4">
            <div class="section-header mb-3">
                <h2>Top Categories</h2>
            </div>

            <div class="swiper topcategory">
                <div class="swiper-wrapper">
                    @foreach ($categories as $data)
                        <div class="swiper-slide">
                            <a href="{{ route('product.group.details', $data->id) }}" class="cat_item">
                                <div class="cat_img">
                                    <img src="{{ asset($data->image) }}" alt="{{ $data->category }}">
                                </div>
                                <div class="cat_overlay"></div>
                                <h4 class="cat_name">{{ $data->category }}</h4>
                            </a>
                        </div>
                    @endforeach
                </div>

                {{-- Navigation --}}
                <div class="swiper-button-next custom-next"></div>
                <div class="swiper-button-prev custom-prev"></div>
            </div>
        </div>
    @endif

    {{-- PRODUCT SECTIONS --}}
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
        <div class="container mt-4">
            <div class="section-header mb-3">
                <h2>{{ $sec['title'] }}</h2>
            </div>

            @if ($sec['products']->isEmpty())
                @if (request('search'))
                    <p>No product found</p>
                @endif
            @else
                <div class="swiper productSwiper">
                    <div class="swiper-wrapper">
                        @foreach ($sec['products'] as $data)
                            <div class="swiper-slide">
                                <div class="product_item">
                                    @if ($data->discount_price_percentage)
                                        <div class="sale-badge">
                                            {{ $data->discount_price_percentage }}%
                                        </div>
                                    @endif
                                    <div class="pro_img">
                                        <a href="{{ route('product.details', $data->id) }}">
                                            <img src="{{ asset($data->image) }}" alt="{{ $data->name }}">
                                        </a>
                                    </div>
                                    <div class="pro_name">{{ $data->name }}</div>
                                    <div class="pro_price">
                                        @if ($data->discount_price && $data->discount_price < $data->price)
                                            <del>৳ {{ number_format($data->price, 2) }}</del>
                                            <span>৳ {{ number_format($data->discount_price, 2) }}</span>
                                        @else
                                            <span>৳ {{ number_format($data->price, 2) }}</span>
                                        @endif
                                    </div>
                                    <div class="pro_btn">
                                        <a href="{{ route('order', $data->id) }}">অর্ডার করুন</a>
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
            @endif
        </div>
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
                     pauseOnMouseEnter: true,
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
