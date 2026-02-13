@extends('layouts.app')

@section('title', 'Cesta - BitKeys')

@section('content')
    <div class="cart-page-main">
        <div class="cart-page-container">
            <h1>Cesta</h1>

            @if ($cart && $cart->items->count() > 0)
                <div class="cart-grid">

                    {{-- ITEMS LIST --}}
                    <div class="cart-items">
                        @foreach ($cart->items as $item)
                            <div class="cart-item-card">
                                <div class="item-image">
                                    <img src="{{ asset('images/products/' . $item->product->image_url) }}"
                                        alt="{{ $item->product->name }}">
                                </div>

                                <div class="item-details">
                                    <h3 class="item-title">{{ $item->product->name }}</h3>
                                    <div class="item-platform">
                                        @if ($item->platform)
                                            @php
                                                $iconName = 'pc';
                                                $name = strtolower($item->platform->name);
                                                if (Str::contains($name, 'xbox')) {
                                                    $iconName = 'xbox';
                                                } elseif (Str::contains($name, ['ps', 'playstation'])) {
                                                    $iconName = 'ps';
                                                } elseif (Str::contains($name, ['switch', 'nintendo'])) {
                                                    $iconName = 'switch';
                                                } elseif (Str::contains($name, 'steam')) {
                                                    $iconName = 'steam';
                                                }
                                            @endphp
                                            <img src="{{ asset('images/icons/' . $iconName . '.png') }}"
                                                alt="{{ $item->platform->name }}">
                                            <span>{{ $item->platform->name }}</span>
                                        @else
                                            <span>Plataforma no especificada</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="item-pricing">
                                    @php
                                        // Usar final_price en lugar de price_with_discount
                                        $priceWithDiscount = $item->product->final_price;
                                        $hasDiscount =
                                            $item->product->hasDiscount() && $priceWithDiscount < $item->product->price;
                                    @endphp

                                    @if ($hasDiscount)
                                        {{-- Precio con descuento (arriba, en naranja) --}}
                                        <span class="item-price-discounted">{{ number_format($priceWithDiscount, 2) }}
                                            €</span>
                                        {{-- Precio original tachado (abajo, gris) --}}
                                        <span class="item-price-original">{{ number_format($item->product->price, 2) }}
                                            €</span>
                                    @else
                                        {{-- Precio normal (sin descuento) --}}
                                        <span class="item-price">{{ number_format($item->product->price, 2) }} €</span>
                                    @endif

                                    <div class="actions-container">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                            class="update-form">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                min="1" max="10" class="quantity-input"
                                                onchange="this.form.submit()">
                                        </form>

                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete" title="Eliminar producto">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                    </path>
                                                    <line x1="10" y1="11" x2="10" y2="17">
                                                    </line>
                                                    <line x1="14" y1="11" x2="14" y2="17">
                                                    </line>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
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
                            <span>{{ number_format(
                                $cart->items->sum(function ($item) {
                                    return $item->quantity * $item->product->final_price;
                                }),
                                2,
                            ) }}
                                €</span>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="btn-checkout">Comprar</a>
                    </div>

                </div>

                {{-- RECOMENDADOS (Placeholder) --}}
                <div class="cart-recommendations">
                    <h2>Recomendados</h2>
                    {{-- To be implemented --}}
                </div>
            @else
                <div class="cart-empty-state">
                    <h2>Tu carrito está vacío</h2>
                    <p>¿Por qué no echas un vistazo a nuestras ofertas?</p>
                    <a href="{{ route('home') }}" class="btn-view-store">Ver tienda</a>
                </div>
            @endif
        </div>
    </div>
@endsection
