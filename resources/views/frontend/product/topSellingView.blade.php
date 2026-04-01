@extends('frontend.home.master')
@section('content')
    @push('css')
        <style>

        </style>
    @endpush

    <section class="product-section">
        <div class="container">
            <div class="sorting-section">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="category-breadcrumb d-flex align-items-center">
                            <a href="https://ghuribd.com">Home</a>
                            <span>/</span>
                            <strong>Gadgets &amp; Electronics</strong>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="showing-data">
                                    <span>Showing 1-24 of
                                        35 Results</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="filter_sort">
                                    <div class="filter_btn">
                                        <i class="fa fa-list-ul"></i>
                                    </div>
                                    <div class="page-sort">
                                        <form action="" class="sort-form">
                                            <select name="sort" class="form-control form-select sort">
                                                <option value="1">Product: Latest</option>
                                                <option value="2">Product: Oldest</option>
                                                <option value="3">Price: High To Low</option>
                                                <option value="4">Price: Low To High</option>
                                                <option value="5">Name: A-Z</option>
                                                <option value="6" selected="">Name: Z-A</option>
                                            </select>
                                            <input type="hidden" name="min_price" value="">
                                            <input type="hidden" name="max_price" value="">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-sm-3 filter_sidebar">

                    <form action="" class="attribute-submit">
                        <div class="sidebar_item wraper__item">
                            <div class="accordion" id="category_sidebar">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseCat" aria-expanded="true" aria-controls="collapseOne">
                                            Gadgets &amp; Electronics
                                        </button>
                                    </h2>
                                    <div id="collapseCat" class="accordion-collapse collapse show"
                                        data-bs-parent="#category_sidebar">
                                        <div class="accordion-body cust_according_body">
                                            <ul>
                                                <li>
                                                    <a href="https://ghuribd.com/subcategory/audio-&amp;-music">Audio &amp;
                                                        Music</a>
                                                </li>
                                                <li>
                                                    <a href="https://ghuribd.com/subcategory/earbuds">Earbuds</a>
                                                </li>
                                                <li>
                                                    <a href="https://ghuribd.com/subcategory/powerbank">PowerBank</a>
                                                </li>
                                                <li>
                                                    <a href="https://ghuribd.com/subcategory/neckband">Neckband</a>
                                                </li>
                                                <li>
                                                    <a href="https://ghuribd.com/subcategory/usb-multi-port">USB
                                                        Multi-port</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--sidebar item end-->
                        <div class="sidebar_item wraper__item">
                            <div class="accordion" id="price_sidebar">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapsePrice" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            Price
                                        </button>
                                    </h2>
                                    <div id="collapsePrice" class="accordion-collapse collapse show"
                                        data-bs-parent="#price_sidebar">
                                        <div class="accordion-body cust_according_body">
                                            <div class="category-filter-box category__wraper" id="categoryFilterBox">
                                                <div class="category-filter-item">
                                                    <div class="filter-body">
                                                        <div class="slider-box">
                                                            <div class="filter-price-inputs">
                                                                <p class="min-price">৳
                                                                    <input type="text" id="min_price" readonly
                                                                        value="500">
                                                                </p>
                                                                <p class="max-price">৳
                                                                    <input type="text" id="max_price" readonly
                                                                        value="100000">
                                                                </p>
                                                            </div>

                                                            <div class="price-slider">
                                                                <div class="track"></div>
                                                                <div class="range" id="rangeFill"></div>

                                                                <input type="range" id="minRange" min="0"
                                                                    max="10000" value="500">
                                                                <input type="range" id="maxRange" min="0"
                                                                    max="10000" value="8000">
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

                        <!--sidebar item end-->
                        <div class="sidebar_item wraper__item">
                            <div class="accordion" id="filter_sidebar">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseFilter" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            Filter
                                        </button>
                                    </h2>
                                    <div id="collapseFilter" class="accordion-collapse collapse show"
                                        data-bs-parent="#filter_sidebar">
                                        <div class="accordion-body cust_according_body">
                                            <div class="filter-body">
                                                <ul class="space-y-3">
                                                    <li class="subcategory-filter-list">
                                                        <label for="audio-&amp;-music-2" class="subcategory-filter-label">
                                                            <input class="form-checkbox form-attribute"
                                                                id="audio-&amp;-music-2" name="subcategory[]"
                                                                value="2" type="checkbox">
                                                            <p class="subcategory-filter-name">
                                                                Audio &amp; Music</p>
                                                        </label>
                                                    </li>
                                                    <li class="subcategory-filter-list">
                                                        <label for="earbuds-8" class="subcategory-filter-label">
                                                            <input class="form-checkbox form-attribute" id="earbuds-8"
                                                                name="subcategory[]" value="8" type="checkbox">
                                                            <p class="subcategory-filter-name">
                                                                Earbuds</p>
                                                        </label>
                                                    </li>
                                                    <li class="subcategory-filter-list">
                                                        <label for="powerbank-9" class="subcategory-filter-label">
                                                            <input class="form-checkbox form-attribute" id="powerbank-9"
                                                                name="subcategory[]" value="9" type="checkbox">
                                                            <p class="subcategory-filter-name">
                                                                PowerBank</p>
                                                        </label>
                                                    </li>
                                                    <li class="subcategory-filter-list">
                                                        <label for="neckband-10" class="subcategory-filter-label">
                                                            <input class="form-checkbox form-attribute" id="neckband-10"
                                                                name="subcategory[]" value="10" type="checkbox">
                                                            <p class="subcategory-filter-name">
                                                                Neckband</p>
                                                        </label>
                                                    </li>
                                                    <li class="subcategory-filter-list">
                                                        <label for="usb-multi-port-12" class="subcategory-filter-label">
                                                            <input class="form-checkbox form-attribute"
                                                                id="usb-multi-port-12" name="subcategory[]"
                                                                value="12" type="checkbox">
                                                            <p class="subcategory-filter-name">
                                                                USB Multi-port</p>
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--sidebar item end-->
                    </form>
                </div>
                <div class="col-sm-9">
                    <div class="category-product main_product_inner">
                        @foreach ($topSellingProductView as $data)
                            <div class="product_item wist_item  wow fadeInDown" data-wow-duration="1.5s"
                                data-wow-delay="0.0s"
                                style="visibility: visible; animation-duration: 1.5s; animation-delay: 0s; animation-name: fadeInDown;">
                                <div class="product_item_inner">
                                    <div class="sale-badge-view">
                                        <div class="sale-badge-inner-view">
                                            <div class="sale-badge-box-view">
                                                <span class="sale-badge-text-view">
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
                                            <img src="{{ asset($data->image) }}" alt="WUF-W15 Portable Wireless Speaker">
                                        </a>
                                    </div>
                                    <div class="pro_des">
                                        <div class="pro_name">
                                            <a href="{{ route('product.details', $data->id) }}">{{ $data->name }}</a>
                                        </div>
                                        <div class="pro_price">
                                            <p>
                                                @if ($data->discount_price && $data->discount_price < $data->price)
                                                    <del class="old-price">৳
                                                        {{ number_format($data->price, 2) }}</del>
                                                    <span class="new-price">৳
                                                        {{ number_format($data->discount_price, 2) }}</span>
                                                @elseif($data->price)
                                                    <span class="new-price">৳
                                                        {{ number_format($data->price, 2) }}</span>
                                                @else
                                                    <del class="old-price">৳ 00</del>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro_btn">
                                    <div class="cart_btn order_button">
                                        <a href="{{ route('order', $data->id) }}" class="addcartbutton">অর্ডার</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="custom_paginate">
                        <nav>
                            <ul class="pagination">

                                <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                                    <span class="page-link" aria-hidden="true">‹</span>
                                </li>


                                <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                                <li class="page-item"><a class="page-link"
                                        href="https://ghuribd.com/category/gadgets-&amp;-electronics?page=2">2</a></li>


                                <li class="page-item">
                                    <a class="page-link"
                                        href="https://ghuribd.com/category/gadgets-&amp;-electronics?page=2"
                                        rel="next" aria-label="Next »">›</a>
                                </li>
                            </ul>
                        </nav>


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const minRange = document.getElementById("minRange");
            const maxRange = document.getElementById("maxRange");

            const minInput = document.getElementById("min_price");
            const maxInput = document.getElementById("max_price");

            const rangeFill = document.getElementById("rangeFill");

            const minGap = 100;

            function updatePriceSlider(e) {
                let minVal = parseInt(minRange.value);
                let maxVal = parseInt(maxRange.value);

                // prevent overlap
                if (maxVal - minVal < minGap) {
                    if (e && e.target.id === "minRange") {
                        minRange.value = maxVal - minGap;
                    } else {
                        maxRange.value = minVal + minGap;
                    }
                }

                // update values again
                minVal = parseInt(minRange.value);
                maxVal = parseInt(maxRange.value);

                // ✅ THIS LINE FIXES YOUR PROBLEM
                minInput.value = minVal;
                maxInput.value = maxVal;

                // update green bar
                let percentMin = (minVal / minRange.max) * 100;
                let percentMax = (maxVal / maxRange.max) * 100;

                rangeFill.style.left = percentMin + "%";
                rangeFill.style.width = (percentMax - percentMin) + "%";
            }

            // events
            minRange.addEventListener("input", updatePriceSlider);
            maxRange.addEventListener("input", updatePriceSlider);

            // init
            updatePriceSlider();
        });
    </script>
@endpush
