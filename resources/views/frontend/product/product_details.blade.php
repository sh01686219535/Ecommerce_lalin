@extends('frontend.home.master')
@section('content')
    @push('css')
        <style>

        </style>
    @endpush

    <section class="product-details-section">
        <div class="container-property">
            <div class="row">
                {{-- Left Section: Product Images --}}
                <div class="col-md-6 zoom-left">
                    @php
                        $images = $productDeatils->multi_image ?? [];
                    @endphp
                    @if (count($images) > 0)
                        <div class="text-center mb-3">
                            <img id="mainImage" src="{{ asset($images[0]) }}" class="img-fluid">
                        </div>
                        <div class="d-flex justify-content-center flex-wrap gap-2">
                            @foreach ($images as $index => $image)
                                <img src="{{ asset($image) }}"
                                    class="img-thumbnail thumb-img {{ $index == 0 ? 'active' : '' }}"
                                    style="width:115px;height:100px;object-fit:cover;"
                                    onclick="changeMainImage('{{ asset($image) }}', this)">
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Right Section: Product Details --}}
                <div class="col-md-6">
                    <div class="product-details">
                        <div class="breadcrumb">
                            <a href="{{ route('home') }}">Home</a>
                            @if ($productDeatils->category)
                                / <a href="#">
                                    {{ $productDeatils->category->category }}
                                </a>
                            @endif
                            @if ($productDeatils->subCategory)
                                / <a href="#">
                                    {{ $productDeatils->subCategory->sub_category }}
                                </a>
                            @endif
                            @if ($productDeatils->childCategory)
                                / <a href="#">
                                    {{ $productDeatils->childCategory->child_category }}
                                </a>
                            @endif
                        </div>
                        <div class="product-card-details">
                            <div class="product-title">{{ $productDeatils->name ?? 'Product Name' }}</div>
                            <div class="price">
                                @if ($productDeatils->discount_price)
                                    <del>৳{{ $productDeatils->price }}</del> ৳{{ $productDeatils->discount_price }}
                                @else
                                    ৳{{ $productDeatils->price }}
                                @endif
                            </div>
                            <div class="rating">
                                <span>☆ ☆ ☆ ☆ ☆ 0.00/5</span> <a href="#">See Reviews</a>
                            </div>
                            <div class="product-code">প্রোডাক্ট কোড : {{ $productDeatils->product_code ?? 'P0000' }}</div>
                            <div class="brand">Brand : {{ $productDeatils->brand->name ?? 'Brand Name' }}</div>

                            <div class="quantity">
                                <button onclick="decreaseQty()">-</button>
                                <input type="number" id="qty" value="1" min="1">
                                <button onclick="increaseQty()">+</button>
                            </div>

                            <div class="buttons">
                                <button class="add-to-cart">কার্টে যোগ করুন</button>
                                <button class="order-now">অর্ডার করুন</button>
                            </div>

                            <div class="contact">
                                <i class="fa fa-phone"></i> +880 1886-600639
                            </div>

                            <div class="shipping-info">
                                <div>ঢাকায় ভাড়াঃ ৭০ টাকা</div>
                                <div>ঢাকার বাইরেঃ ১৩৫ টাকা</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> {{-- row --}}
        </div>
    </section>
    <section class="pro_details_area">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="description tab-content details-action-box" id="description">
                        <h2>বিস্তারিত</h2>
                        <p></p>
                        {!! $productDeatils->description !!}
                    </div>
                    <div class="tab-content details-action-box" id="writeReview">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="section-head">
                                        <div class="title">
                                            <h2>Reviews (0)</h2>
                                            <p>Get specific details about this product from customers who own it.</p>
                                        </div>
                                        <div class="action">
                                            <div>
                                                <button type="button" class="details-action-btn question-btn btn-overlay"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    Write a review
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="empty-content">
                                        <i class="fa fa-clipboard-list"></i>
                                        <p class="empty-text">This product has no reviews yet. Be the first one to write a
                                            review.</p>
                                    </div>
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Your review</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="insert-review">
                                                        <a class="customer-login-redirect"
                                                            href="https://ghuribd.com/customer/login">Login
                                                            to Post
                                                            Your Review</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="pro_vide sticky-video">
                        <h2>ভিডিও</h2>
                        <iframe width="100%" height="315" src="{{ $productDeatils->video_url }}"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if ($productRelated->isNotEmpty())
        <section class="related-product-section">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-12 col-xl-12 col-sm-12">
                        <div class="related-title mb-3">
                            <h5>Related Product</h5>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-12 col-xl-12 col-sm-12">
                        <div class="col-md-3">
                            <div class="product-inner owl-carousel related_slider">
                                @foreach ($productRelated as $product)
                                    <div class="product_item wist_item wow fadeInDown">
                                        <div class="product_item_inner">

                                            {{-- Sale Badge --}}
                                            @if ($product->discount_price)
                                                <div class="sale-badge">
                                                    <div class="sale-badge-inner">
                                                        <div class="sale-badge-box">
                                                            <span class="sale-badge-text">
                                                                <p>
                                                                    {{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%
                                                                </p>
                                                                ছাড়
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            {{-- Product Image --}}
                                            <div class="pro_img">
                                                <a href="{{ route('product.details', $product->id) }}">
                                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                                </a>
                                            </div>

                                            {{-- Product Name --}}
                                            <div class="pro_des">
                                                <div class="pro_name">
                                                    <a href="{{ route('product.details', $product->id) }}">
                                                        {{ $product->name }}
                                                    </a>
                                                </div>

                                                {{-- Price --}}
                                                <div class="pro_price">
                                                    <p>
                                                        @if ($product->discount_price)
                                                            <del>৳ {{ $product->price }}</del>
                                                            ৳ {{ $product->discount_price }}
                                                        @else
                                                            ৳ {{ $product->price }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>

                                        </div>

                                        {{-- Order Button --}}
                                        <div class="pro_btn">
                                            <div class="cart_btn order_button">
                                                <a href="{{ route('product.details', $product->id) }}"
                                                    class="addcartbutton">
                                                    অর্ডার
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    @endif

@endsection


@push('js')
    <script>
        function changeMainImage(src, element) {
            const mainImg = document.getElementById('mainImage');
            mainImg.src = src;
            document.querySelectorAll('.thumb-img').forEach(img => img.classList.remove('active'));
            element.classList.add('active');
        }

        function increaseQty() {
            let qty = document.getElementById('qty');
            qty.value = parseInt(qty.value) + 1;
        }

        function decreaseQty() {
            let qty = document.getElementById('qty');
            if (parseInt(qty.value) > 1) {
                qty.value = parseInt(qty.value) - 1;
            }
        }
    </script>

    <script>
        $('.related_slider').owlCarousel({
            loop: true,
            margin: 15,
            nav: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 3000,
            responsive: {
                0: {
                    items: 2
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                },
                1200: {
                    items: 5
                }
            }
        });
    </script>
@endpush
