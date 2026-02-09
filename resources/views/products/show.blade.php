@extends('layouts.app')

@section('title', $product->name)

@section('content')

    <main class="product-page-main">
        <div class="product-page-container">

            <div class="product-detail">

                <div class="product-image">
                    <img src="{{ asset('images/products/' . $product->image_url) }}" alt="{{ $product->name }}">

                    @auth
                        @if(Auth::user()->role_id === 1)
                            <div class="edit-container">
                                <a href="{{ route('products.edit', $product) }}"
                                    class="btn-secondary">{{ __('Editar Producto') }}</a>
                            </div>
                        @endif
                    @endauth
                </div>

                <div class="product-info">
                    <h1>{{ $product->name }}</h1>

                    @if($product->is_offer && $product->offer_percentage)
                        @php
                            $discounted = $product->price * (1 - $product->offer_percentage / 100);
                        @endphp
                        <p class="price">
                            {{ number_format($discounted, 2) }}€
                        </p>
                    @else
                        <p class="price">{{ number_format($product->price, 2) }}€</p>
                    @endif

                    <p class="description">{{ $product->description }}</p>

                    @if($product->platforms->count() > 0)
                        <div class="platform-selector">
                            <p class="selector-label">Plataforma:</p>
                            <div class="platforms-grid">
                                @foreach($product->platforms as $platform)
                                    @php
                                        $iconName = 'pc';
                                        $name = strtolower($platform->name);
                                        if (Str::contains($name, 'xbox'))
                                            $iconName = 'xbox';
                                        elseif (Str::contains($name, ['ps', 'playstation']))
                                            $iconName = 'ps';
                                        elseif (Str::contains($name, ['switch', 'nintendo']))
                                            $iconName = 'switch';
                                        elseif (Str::contains($name, 'steam'))
                                            $iconName = 'steam';
                                    @endphp
                                    <label class="platform-option">
                                        <input type="radio" name="platform_id" value="{{ $platform->id }}" {{ $loop->first ? 'checked' : '' }} form="add-to-cart-form">
                                        <span class="platform-badge">
                                            <img src="{{ asset('images/icons/' . $iconName . '.png') }}"
                                                alt="{{ $platform->name }}">
                                            {{ $platform->name }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="product-actions">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" id="add-to-cart-form">
                            @csrf
                            <button type="submit" class="btn-add-cart">Añadir al carrito <img
                                    src="{{ asset('images/icons/carrito.png') }}" alt="carrito"></button>
                        </form>

                        <button class="btn-fast-buy"><img src="{{ asset('images/icons/fast-buy.png') }}"
                                title="Comprar ahora" alt="carrito"></button>
                    </div>
                </div>

            </div>



            {{-- COMENTARIOS --}}
            <hr>

            <div class="comments-section">
                <h2>Opiniones de los usuarios</h2>

                @forelse($product->comments as $comment)
                    <div class="comment-item">
                        <div class="comment-header">
                            <span>{{ $comment->user->name ?? 'Usuario anónimo' }}</span>
                            <span class="rating">{{ $comment->rating }}/5</span>
                        </div>
                        <p>{{ $comment->message }}</p>
                        <span class="comment-date">{{ $comment->created_at->format('d/m/Y') }}</span>
                    </div>
                @empty
                    <p>No hay comentarios todavía.</p>
                @endforelse
            </div>

        </div>
    </main>

@endsection