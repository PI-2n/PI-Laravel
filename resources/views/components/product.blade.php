@props(['product', 'showVideo' => true])

@if($product->active)
    <div class="product">
        <a href="{{ route('products.show', $product->id) }}">

            <div class="media-container">
                <img src="{{ asset('images/products/' . $product->image_url) }}" alt="{{ $product->name }}"
                    class="product-image" />

                @if($showVideo && $product->video_url)
                    <video src="{{ asset('video/' . $product->video_url) }}" muted preload="none" class="product-video"></video>
                @endif

                @if($product->offer_percentage && $product->offer_percentage > 0)
                    <div class="discount-badge">
                        -{{ intval($product->offer_percentage) }}%
                    </div>
                @endif

            </div>

            <div class="product-text">
                <p class="title">{{ $product->name }}</p>

                @if($product->offer_percentage && $product->offer_percentage > 0)
                    @php
                        $discounted = $product->price * (1 - $product->offer_percentage / 100);
                    @endphp
                    <p class="price">
                        <span class="old-price">{{ number_format($product->price, 2) }}€</span>
                        {{ number_format($discounted, 2) }}€
                    </p>
                @else
                    <p class="price">{{ number_format($product->price, 2) }}€</p>
                @endif
            </div>

        </a>
    </div>
@endif