<section class="slider">
    <div class="slider-track">
        @foreach ($productSlider as $slider)
            <div class="slide">
                <a href="{{ route('property.details', $slider->id) }}">
                    <img src="{{ asset($slider->image) }}">
                    <div class="text">
                        <h5 style="font-size: 28px">{{ $slider->name }}</h4>
                        <p style="font-size: 24px">Price : {{ $slider->price }} Taka</p>
                    </div>
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
