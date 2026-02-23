@extends('layouts.app')

@section('title', 'Checkout - BitKeys')

@section('content')
    <div class="checkout-page">
        <div class="checkout-container">
            <h1>Finalizar Compra</h1>

            <div class="checkout-grid">
                <!-- Resumen del pedido -->
                <div class="order-summary">
                    <h2>Resumen del Pedido</h2>

                    @foreach ($cart->items as $item)
                        <div class="order-item">
                            <div class="item-info">
                                <h4>{{ $item->product->name }}</h4>
                                <p>{{ $item->quantity }} x {{ number_format($item->unit_price, 2) }} €</p>
                                @if ($item->platform)
                                    <small>Plataforma: {{ $item->platform->name }}</small>
                                @endif
                            </div>
                            <span class="item-total">{{ number_format($item->line_total, 2) }} €</span>
                        </div>
                    @endforeach

                    <div class="order-total">
                        <strong>Total:</strong>
                        <span>{{ number_format($total, 2) }} €</span>
                    </div>
                </div>

                <!-- Formulario de pago -->
                <div class="payment-section">
                    <h2>Método de Pago</h2>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('checkout.process') }}" method="POST" id="paymentForm">
                        @csrf

                        <!-- Selección de tarjeta -->
                        <div class="payment-methods">
                            <label>
                                <input type="radio" name="payment_method" value="saved_card"
                                    {{ $savedCards->count() > 0 && old('payment_method', 'saved_card') === 'saved_card' ? 'checked' : 'disabled' }}>
                                <span class="radio-label">Tarjeta guardada</span>
                            </label>

                            <label>
                                <input type="radio" name="payment_method" value="new_card"
                                    {{ old('payment_method', $savedCards->count() > 0 ? 'saved_card' : 'new_card') === 'new_card' ? 'checked' : '' }}>
                                <span class="radio-label">Nueva tarjeta</span>
                            </label>
                        </div>

                        <!-- Tarjetas guardadas -->
                        @if ($savedCards->count() > 0)
                            <div class="saved-cards" id="savedCardsSection"
                                style="{{ old('payment_method', 'saved_card') === 'saved_card' ? 'display: block;' : 'display: none;' }}">
                                <div class="form-group">
                                    <label for="card_id">Selecciona tu tarjeta</label>
                                    <select name="card_id" id="card_id" class="form-select" required>
                                        <option value="">-- Elige una tarjeta --</option>
                                        @foreach ($savedCards as $card)
                                            <option value="{{ $card->id }}"
                                                {{ old('card_id') == $card->id ? 'selected' : '' }}>
                                                {{ $card->masked_card_number }} - {{ $card->card_holder_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('card_id')
                                        <span class="error-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endif

                        <!-- Nueva tarjeta -->
                        <div class="new-card-form" id="newCardSection"
                            style="{{ old('payment_method', $savedCards->count() > 0 ? 'saved_card' : 'new_card') === 'new_card' ? 'display: block;' : 'display: none;' }}">
                            <div class="form-group">
                                <label for="card_number">Número de tarjeta *</label>
                                <input type="text" name="card_number" id="card_number"
                                    class="form-control @error('card_number') is-invalid @enderror"
                                    placeholder="1234 5678 9012 3456" value="{{ old('card_number') }}" autocomplete="off">
                                @error('card_number')
                                    <span class="error-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="card_holder_name">Titular de la tarjeta *</label>
                                <input type="text" name="card_holder_name" id="card_holder_name"
                                    class="form-control @error('card_holder_name') is-invalid @enderror"
                                    placeholder="JUAN PÉREZ" value="{{ old('card_holder_name') }}" autocomplete="off">
                                @error('card_holder_name')
                                    <span class="error-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="expiration_date">Fecha de expiración *</label>
                                    <input type="text" name="expiration_date" id="expiration_date"
                                        class="form-control @error('expiration_date') is-invalid @enderror"
                                        placeholder="MM/AA" value="{{ old('expiration_date') }}" autocomplete="off">
                                    @error('expiration_date')
                                        <span class="error-text">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cvv">CVV *</label>
                                    <input type="text" name="cvv" id="cvv"
                                        class="form-control @error('cvv') is-invalid @enderror" placeholder="123"
                                        value="{{ old('cvv') }}" autocomplete="off">
                                    @error('cvv')
                                        <span class="error-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="save_card" value="1"
                                        {{ old('save_card') ? 'checked' : '' }}>
                                    <span>Guardar tarjeta para futuras compras</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-actions">
                            <a href="{{ route('cart.index') }}" class="btn-secondary">Volver al carrito</a>
                            <button type="submit" class="btn-primary">Pagar {{ number_format($total, 2) }} €</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/checkout.js')
@endpush
