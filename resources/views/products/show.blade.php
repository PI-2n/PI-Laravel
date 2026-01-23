@extends('layouts.app')

@section('title', $product->name)

@section('content')

    <main class="product-page-main">
        <div class="product-page-container">

            <div class="product-detail">

                <div class="product-image">
                    <img src="{{ asset('images/products/' . $product->image_url) }}" alt="{{ $product->name }}">
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

                    <div class="product-actions">
                        <button class="btn-add-cart">Añadir al carrito <img src="{{ asset('images/icons/carrito.png') }}"
                                alt="carrito"></button>

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