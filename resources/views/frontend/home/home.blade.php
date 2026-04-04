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

            .pro_price del {
                color: red;
                font-size: 13px;
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
                    'type' => 'featured',
                ],
                [
                    'title' => 'Top Selling Product',
                    'products' => $top_selling_Product,
                    'type' => 'top_selling',
                ],
                [
                    'title' => 'New Launch Product',
                    'products' => $new_launch_product,
                    'type' => 'new_launch',
                ],
                [
                    'title' => 'Most Popular Product',
                    'products' => $most_popular_product,
                    'type' => 'most_popular',
                ],
                [
                    'title' => 'Regular Product',
                    'products' => $regular_product,
                    'type' => 'regular',
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
                        {{-- <p>No product found</p> --}}
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
                    {{-- <div class="text-center mt-3">
                        <a href="{{ $sec['route'] }}" class="view-btn">View More</a>
                    </div> --}}
                    <div class="text-center mt-3">
                        <a href="{{ route('product.type', $sec['type']) }}" class="view-btn">
                            View More
                        </a>
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
