<div class="product_item">

    <div class="product_item_inner">

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

    </div>

    {{-- Button --}}
    <div class="pro_btn">
        <a href="{{ route('order', $data->id) }}"
           data-id="{{ $data->id }}"
           class="add-to-cart">
           অর্ডার করুন
        </a>
    </div>

</div>