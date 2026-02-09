@extends('layouts.app')

@section('title', 'Cesta - BitKeys')

@section('content')
    <div class="cart-page-main">
        <div class="cart-page-container">
            <h1>Cesta</h1>

            @if($cart && $cart->items->count() > 0)
                <div class="cart-grid">

                    {{-- ITEMS LIST --}}
                    <div class="cart-items">
                        @foreach($cart->items as $item)
                            <div class="cart-item-card">
                                <div class="item-image">
                                    <img src="{{ asset('images/products/' . $item->product->image_url) }}"
                                        alt="{{ $item->product->name }}">
                                </div>

                                <div class="item-details">
                                    <h3 class="item-title">{{ $item->product->name }}</h3>
                                    <div class="item-platform">
                                        {{-- Platform logic would go here, hardcoded example based on mockup or platform
                                        relationship if exists --}}
                                        {{-- Assuming product has platforms, otherwise static for now or generic icon --}}
                                        @foreach($item->product->platforms as $platform)
                                            <img src="{{ asset('images/icons/' . strtolower($platform->name) . '.png') }}"
                                                alt="{{ $platform->name }}">
                                            <span>{{ $platform->name }}</span>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="item-pricing">
                                    <span class="item-price">{{ number_format($item->product->price, 2) }} €</span>

                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" title="Eliminar producto">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- SUMMARY SIDEBAR --}}
                    <div class="cart-summary">
                        <h2>Resumen</h2>

                        <div class="summary-row">
                            <span>Artículos</span>
                            <span>{{ $cart->items->sum('quantity') }}</span>
                        </div>

                        <div class="summary-row total">
                            <span>Total</span>
                            <span>{{ number_format($cart->items->sum(function ($item) {
                return $item->quantity * $item->product->price; }), 2) }}
                                €</span>
                        </div>

                        <button class="btn-checkout">Comprar</button>
                    </div>

                </div>

                {{-- HEADER RECOMENDADOS (Placeholder) --}}
                <div class="cart-recommendations">
                    <h2>Recomendados</h2>
                    {{-- To be implemented with product component potentially --}}
                </div>

            @else
                <div style="text-align: center; padding: 4rem;">
                    <h2>Tu carrito está vacío</h2>
                    <p>¿Por qué no echas un vistazo a nuestras ofertas?</p>
                    <a href="{{ route('home') }}" class="btn-checkout"
                        style="display: inline-block; width: auto; background-color: #dd7710ec; margin-top: 1rem;">Ver
                        tienda</a>
                </div>
            @endif
        </div>
    </div>
@endsection