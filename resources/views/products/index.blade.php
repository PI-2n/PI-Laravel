{{-- resources/views/products/index.blade.php --}}

{{-- FEATURED --}}
@if($featured)
    <section class="featured">
        <video src="{{ asset('/video/' . $featured->video_url) }}" muted loop autoplay
            class="featured-background-video"></video>

        <a href="{{ route('products.show', $featured->id) }}" class="featured-link">
            <h1 class="featured-title">{{ $featured->name }}</h1>
            <p class="featured-subtitle">Ya disponible</p>
        </a>
    </section>
@endif


{{-- NEWS --}}
<section class="news">
    <h2>Últimas novedades</h2>

    <div class="carousel-container">
        <button class="carousel-btn carousel-btn--prev" aria-label="Anterior">&lt;</button>

        <div class="carousel-track" data-index="0">

            @foreach($news as $product)
                <div class="carousel-slide">
                    <x-product :product="$product" />
                </div>
            @endforeach
        </div>

        <button class="carousel-btn carousel-btn--next" aria-label="Siguiente">&gt;</button>
    </div>
</section>


{{-- OFFERS --}}
<section class="offers">
    <h2>Ofertas</h2>

    <div class="products">
        @foreach($offers as $product)
            <x-product :product="$product" />
        @endforeach
    </div>
</section>