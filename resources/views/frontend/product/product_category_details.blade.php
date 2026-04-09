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
                            <a href="{{ url('/') }}">Home</a>
                            <span>/</span>
                            {{-- <strong>{{ $category->category ?? '' }}</strong> --}}
                            <strong>
                                @if ($type === 'category')
                                    <strong>{{ $category->category ?? '' }}</strong>
                                @elseif($type === 'sub_category')
                                    <strong>{{ $category->category->category ?? '' }}</strong>
                                @elseif($type === 'child_category')
                                    <strong>{{ $category->subCategory->category->category ?? '' }}</strong>
                                @endif
                            </strong>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="showing-data">
                                    {{-- <span>Showing 1-24 of
                                        35 Results</span> --}}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="filter_sort">
                                    <div class="filter_btn">
                                        <i class="fa fa-list-ul"></i>
                                    </div>
                                    <div class="page-sort">
                                        <form action="" method="GET" class="sort-form">
                                            <select name="sort" class="form-control form-select sort">
                                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>
                                                    Product: Latest</option>
                                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                                                    Product: Oldest</option>
                                                <option value="high" {{ request('sort') == 'high' ? 'selected' : '' }}>
                                                    Price: High To Low</option>
                                                <option value="low" {{ request('sort') == 'low' ? 'selected' : '' }}>
                                                    Price: Low To High</option>
                                                <option value="a-z" {{ request('sort') == 'a-z' ? 'selected' : '' }}>
                                                    Name: A-Z</option>
                                                <option value="z-a" {{ request('sort') == 'z-a' ? 'selected' : '' }}>
                                                    Name: Z-A</option>
                                            </select>

                                            <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                                            <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                                            @foreach (request('subcategory', []) as $subcat)
                                                <input type="hidden" name="subcategory[]" value="{{ $subcat }}">
                                            @endforeach
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
                                            {{-- {{ $category->category ?? '' }} --}}
                                            <strong>
                                                @if ($type === 'category')
                                                    <strong>{{ $category->category ?? '' }}</strong>
                                                @elseif($type === 'sub_category')
                                                    <strong>{{ $category->category->category ?? '' }}</strong>
                                                @elseif($type === 'child_category')
                                                    <strong>{{ $category->subCategory->category->category ?? '' }}</strong>
                                                @endif
                                            </strong>
                                        </button>
                                    </h2>
                                    <div id="collapseCat" class="accordion-collapse collapse show"
                                        data-bs-parent="#category_sidebar">
                                        <div class="accordion-body cust_according_body">
                                            <ul>
                                                {{-- @foreach ($category->subCategories as $sub)
                                                    <li>
                                                        <a href="#"
                                                            class="{{ request('subcategory') == $sub->id ? 'active' : '' }}">
                                                            {{ $sub->sub_category }}
                                                        </a>
                                                    </li>
                                                @endforeach --}}

                                                @if ($type === 'category' && $category->subCategories->count())
                                                    @foreach ($category->subCategories as $sub)
                                                        <li>
                                                            <a href="#"
                                                                class="{{ in_array($sub->id, (array) request('subcategory', [])) ? 'active' : '' }}">
                                                                {{ $sub->sub_category }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                @elseif($type === 'sub_category' && $category->childCategories->count())
                                                    @foreach ($category->childCategories as $child)
                                                        <li>
                                                            <a href="#"
                                                                class="{{ in_array($child->id, (array) request('child_category', [])) ? 'active' : '' }}">
                                                                {{ $child->child_category }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                @endif

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--sidebar item end-->

                    <form action="{{ url()->current() }}" method="GET" class="attribute-submit">

                        <!-- PRICE SLIDER -->

                        <div class="sidebar_item wraper__item">
                            <div class="accordion" id="price_sidebar">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapsePrice" aria-expanded="true">
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
                                                                    <input type="text" id="min_price" name="min_price"
                                                                        readonly value="{{ request('min_price', 500) }}">
                                                                </p>
                                                                <p class="max-price">৳
                                                                    <input type="text" id="max_price" name="max_price"
                                                                        readonly
                                                                        value="{{ request('max_price', 100000) }}">
                                                                </p>
                                                            </div>

                                                            <div class="price-slider">
                                                                <div class="track"></div>
                                                                <div class="range" id="rangeFill"></div>

                                                                <input type="range" id="minRange" min="0"
                                                                    max="10000"
                                                                    value="{{ request('min_price', 100) }}">
                                                                <input type="range" id="maxRange" min="0"
                                                                    max="10000"
                                                                    value="{{ request('max_price', 20000) }}">
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

                        <!-- SUBCATEGORY CHECKBOXES -->
                    </form>
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
                                                {{-- @foreach ($category->subCategories as $sub)
                                                    <li class="subcategory-filter-list">
                                                        <label for="subcategory-{{ $sub->id }}"
                                                            class="subcategory-filter-label">
                                                            <input class="form-checkbox form-attribute"
                                                                id="subcategory-{{ $sub->id }}" name="subcategory[]"
                                                                value="{{ $sub->id }}" type="checkbox"
                                                                onchange="this.form.submit()"
                                                                {{ in_array($sub->id, request('subcategory', [])) ? 'checked' : '' }}>
                                                            <p class="subcategory-filter-name">{{ $sub->sub_category }}
                                                            </p>
                                                        </label>
                                                    </li>
                                                @endforeach --}}
                                                @if ($type === 'category' && $category->subCategories && $category->subCategories->count())
                                                    @foreach ($category->subCategories as $sub)
                                                        <li class="subcategory-filter-list">
                                                            <label for="subcategory-{{ $sub->id }}"
                                                                class="subcategory-filter-label">

                                                                <input class="form-checkbox form-attribute"
                                                                    id="subcategory-{{ $sub->id }}"
                                                                    name="subcategory[]" value="{{ $sub->id }}"
                                                                    type="checkbox" onchange="this.form.submit()"
                                                                    {{ in_array($sub->id, (array) request('subcategory')) ? 'checked' : '' }}>

                                                                <p class="subcategory-filter-name">
                                                                    {{ $sub->sub_category }}
                                                                </p>

                                                            </label>
                                                        </li>
                                                    @endforeach
                                                @endif
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
                        @foreach ($products as $data)
                            <div class="product_item wist_item  wow fadeInDown" data-wow-duration="1.5s"
                                data-wow-delay="0.0s"
                                style="visibility: visible; animation-duration: 1.5s; animation-delay: 0s; animation-name: fadeInDown;">
                                <div class="product_item_inner">
                                    <div class="sale-badge-view">
                                        @if (!empty($data->discount_price_percentage))
                                            <div class="sale-badge-inner-view">
                                                <div class="sale-badge-box-view">
                                                    <span class="sale-badge-text-view">
                                                        <p>{{ $data->discount_price_percentage }}%</p>
                                                        ছাড়
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
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
                                         @if ($data->quantity)
                                                <a  class="addcartbutton" href=" {{ route('order', $data->id) }}">অর্ডার করুন</a> 
                                            @else
                                                 <a href="#" style="background:#008B8B;">Out Of Stock</a>
                                            @endif

                                        {{-- <a href="{{ route('order', $data->id) }}" class="addcartbutton">অর্ডার</a> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Pagination --}}
            @if ($products->hasPages())
                <div class="row">
                    <div class="col-12 d-flex justify-content-center mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Price slider
            const minRange = document.getElementById("minRange");
            const maxRange = document.getElementById("maxRange");
            const minInput = document.getElementById("min_price");
            const maxInput = document.getElementById("max_price");
            const rangeFill = document.getElementById("rangeFill");
            const minGap = 100;

            function updatePriceSlider(e) {
                let minVal = parseInt(minRange.value);
                let maxVal = parseInt(maxRange.value);

                if (maxVal - minVal < minGap) {
                    if (e && e.target.id === "minRange") minRange.value = maxVal - minGap;
                    else maxRange.value = minVal + minGap;
                }

                minVal = parseInt(minRange.value);
                maxVal = parseInt(maxRange.value);

                minInput.value = minVal;
                maxInput.value = maxVal;

                let percentMin = (minVal / minRange.max) * 100;
                let percentMax = (maxVal / maxRange.max) * 100;

                rangeFill.style.left = percentMin + "%";
                rangeFill.style.width = (percentMax - percentMin) + "%";
            }

            minRange.addEventListener("input", updatePriceSlider);
            maxRange.addEventListener("input", updatePriceSlider);
            minRange.addEventListener("change", () => minRange.closest('form').submit());
            maxRange.addEventListener("change", () => maxRange.closest('form').submit());

            updatePriceSlider();

            // Auto-submit on checkbox change
            document.querySelectorAll('.form-attribute').forEach(el => {
                el.addEventListener('change', function() {
                    this.closest('form').submit();
                });
            });

            // Sort select submit
            document.querySelectorAll('.sort').forEach(el => {
                el.addEventListener('change', function() {
                    this.form.submit();
                });
            });
        });
    </script>
@endpush
