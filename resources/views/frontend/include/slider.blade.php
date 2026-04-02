<section class="main-slider">
    <div class="main-slider-track">
        @foreach ($productSlider as $slider)
            <div class="main-slide">
                <a href="{{route('product.slider.details',$slider->id)}}">
                    <img src="{{ asset($slider->image) }}">
                </a>
            </div>
        @endforeach
    </div>
    <div class="dots">
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
    </div>
</section>
