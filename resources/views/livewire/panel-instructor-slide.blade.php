<div class="splide single-slider slider-no-arrows slider-no-dots homepage-slider" id="single-slider-1">
    <div class="splide__track">
        <div class="splide__list">
            @foreach($data as $key => $value)
            <div class="splide__slide">
                @include('PanelCouch.component.Slide')
            </div>
            @endforeach
        </div>
    </div>
</div>