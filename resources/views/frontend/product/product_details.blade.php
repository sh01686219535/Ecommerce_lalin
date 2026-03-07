@extends('frontend.home.master')
@section('content')
    @push('css')
        <style>

        </style>
    @endpush

    <section class="contact-section">
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
                        <h2
                            style="margin-top: 0px; padding: 0px; font-size: 18px; line-height: 26px; color: rgb(0, 0, 0); font-family: &quot;Trebuchet MS&quot;, sans-serif;">
                            <b>Key Features</b>
                        </h2>
                        <ul
                            style="margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-family: &quot;Trebuchet MS&quot;, sans-serif; font-size: 15px;">
                            <li style="margin: 0px; padding: 0px 0px 10px; display: block; line-height: 20px;">Model:
                                onetouch 4021</li>
                            <li style="margin: 0px; padding: 0px 0px 10px; display: block; line-height: 20px;">Display:
                                1.77” QQVGA Display</li>
                            <li style="margin: 0px; padding: 0px 0px 10px; display: block; line-height: 20px;">Camera:
                                0.08MP Digital Camera</li>
                            <li style="margin: 0px; padding: 0px 0px 10px; display: block; line-height: 20px;">Battery:
                                Li-Ion 1030mAh</li>
                            <li style="margin: 0px; padding: 0px 0px 10px; display: block; line-height: 20px;">Features:
                                Torch Light, QVGA Video Playback</li>
                            <li style="margin: 0px; padding: 0px 0px 10px; display: block; line-height: 20px;"><br></li>
                        </ul>
                        <p
                            style="margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-size: 15px; color: rgb(1, 19, 45); line-height: 26px; font-family: &quot;Trebuchet MS&quot;, sans-serif;">
                            The&nbsp;<strong style="margin: 0px; padding: 0px;">TCL onetouch 4021</strong>&nbsp;is a Compact
                            Feature Phone designed for simplicity and reliability. With a compact 1.8-inch TFT display with
                            128 x 160 pixels resolution&nbsp;for clear and easy-to-read visuals. Powered by the MediaTek
                            MT6261D processor, this Feature&nbsp; Phone ensures smooth performance for basic tasks. With 4
                            MB of RAM and 4 MB of internal storage, expandable via microSD up to 32 GB, it provides adequate
                            space for essential contacts and messages. This TCL onetouch 4021 Compact Feature Phone supports
                            dual SIM functionality, allowing you to manage two numbers simultaneously, and operates on GSM
                            networks. The 1030 mAh Li-Ion battery offers long-lasting power, with up to 6.5 hours of talk
                            time and up to 13.5 days of standby time. It also includes a 0.08 MP rear camera for capturing
                            basic photos and videos. Additional features such as Bluetooth 2.1, a 3.5 mm audio jack, and a
                            built-in FM radio enhance its functionality. Weighing just 76 grams and measuring 114.8 x 47.28
                            x 12.7 mm, this TCL onetouch 4021 Phone is lightweight and portable, making it an ideal choice
                            for those seeking a straightforward and dependable button phone. Its sleek design in Dark Night
                            Grey adds a touch of style, while its durable build ensures it can withstand everyday use.
                            Whether you need a reliable backup phone or a simple device for everyday communication, the TCL
                            onetouch 4021 offers a perfect blend of practicality and convenience, making it a standout among
                            TCL Mobile Phones.</p>
                        <p></p>
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
                    <div class="pro_vide">
                        <h2>ভিডিও</h2>
                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen=""></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="related-product-section">
        <div class="container">
            <div class="row">
                <div class="related-title">
                    <h5>Related Product</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="product-inner owl-carousel related_slider owl-loaded owl-drag">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                                <div class="owl-item" style="width: 197.878px; margin-right: 10px;">
                                    <div class="product_item wist_item wow fadeInDown" data-wow-duration="1.5s"
                                        data-wow-delay="0.1s">
                                        <div class="product_item_inner">
                                            {{-- Sale Badge --}}
                                            @if ($productDeatils->discount_price)
                                                <div class="sale-badge">
                                                    <div class="sale-badge-inner">
                                                        <div class="sale-badge-box">
                                                            <span class="sale-badge-text">
                                                                <p>
                                                                    {{ round((($productDeatils->price - $productDeatils->discount_price) / $productDeatils->price) * 100) }}%
                                                                </p>
                                                                ছাড়
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            {{-- Product Image --}}
                                            <div class="pro_img">
                                                <a href="{{ route('product.details', $productDeatils->id) }}">
                                                    <img src="{{ asset($productDeatils->image) }}"
                                                        alt="{{ $productDeatils->name }}">
                                                </a>
                                            </div>

                                            {{-- Product Name & Price --}}
                                            <div class="pro_des">
                                                <div class="pro_name">
                                                    <a
                                                        href="{{ route('product.details', $productDeatils->id) }}">{{ $productDeatils->name }}</a>
                                                </div>
                                                <div class="pro_price">
                                                    <p>
                                                        @if ($productDeatils->discount_price)
                                                            <del>৳ {{ $productDeatils->price }}</del>
                                                            ৳ {{ $productDeatils->discount_price }}
                                                        @else
                                                            ৳ {{ $productDeatils->price }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Order Button --}}
                                        <div class="pro_btn">
                                            <div class="cart_btn order_button">
                                                <a href="{{ route('product.details', $productDeatils->id) }}"
                                                    class="addcartbutton">অর্ডার</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span
                                    aria-label="Previous">‹</span></button><button type="button" role="presentation"
                                class="owl-next"><span aria-label="Next">›</span></button></div>
                        <div class="owl-dots"><button role="button" class="owl-dot active"><span></span></button><button
                                role="button" class="owl-dot"><span></span></button></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
@endpush
