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
                                {{ ($savedCards->count() > 0 && old('payment_method', 'saved_card') === 'saved_card') ? 'checked' : 'disabled' }}>
                            <span class="radio-label">Tarjeta guardada</span>
                        </label>

                        <label>
                            <input type="radio" name="payment_method" value="new_card" 
                                {{ old('payment_method', 'new_card') === 'new_card' ? 'checked' : '' }}>
                            <span class="radio-label">Nueva tarjeta</span>
                        </label>
                    </div>

                    <!-- Tarjetas guardadas -->
                    @if ($savedCards->count() > 0)
                        <div class="saved-cards" id="savedCardsSection" 
                            style="{{ old('payment_method', 'new_card') === 'saved_card' ? 'display: block;' : 'display: none;' }}">
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
                        style="{{ old('payment_method', 'new_card') === 'new_card' ? 'display: block;' : 'display: none;' }}">
                        <div class="form-group">
                            <label for="card_number">Número de tarjeta *</label>
                            <input type="text" name="card_number" id="card_number" 
                                class="form-control @error('card_number') is-invalid @enderror" 
                                placeholder="1234 5678 9012 3456"
                                value="{{ old('card_number') }}" autocomplete="off" required>
                            @error('card_number')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="card_holder_name">Titular de la tarjeta *</label>
                            <input type="text" name="card_holder_name" id="card_holder_name" 
                                class="form-control @error('card_holder_name') is-invalid @enderror" 
                                placeholder="JUAN PÉREZ"
                                value="{{ old('card_holder_name') }}" autocomplete="off" required>
                            @error('card_holder_name')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="expiration_date">Fecha de expiración *</label>
                                <input type="text" name="expiration_date" id="expiration_date" 
                                    class="form-control @error('expiration_date') is-invalid @enderror" 
                                    placeholder="MM/AA"
                                    value="{{ old('expiration_date') }}" autocomplete="off" required>
                                @error('expiration_date')
                                    <span class="error-text">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cvv">CVV *</label>
                                <input type="text" name="cvv" id="cvv" 
                                    class="form-control @error('cvv') is-invalid @enderror" 
                                    placeholder="123"
                                    value="{{ old('cvv') }}" autocomplete="off" required>
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

<style>
.checkout-page {
    padding: 40px 20px;
    background: #f5f5f5;
    min-height: 100vh;
}

.checkout-container {
    max-width: 1200px;
    margin: 0 auto;
    background: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.1);
}

.checkout-container h1 {
    margin-bottom: 30px;
    color: #333;
}

.checkout-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    margin-top: 30px;
}

.order-summary {
    background: #f8f9fa;
    padding: 25px;
    border-radius: 10px;
    border: 1px solid #e9ecef;
}

.order-summary h2 {
    margin-bottom: 20px;
    color: #333;
    font-size: 1.3em;
}

.order-item {
    display: flex;
    justify-content: space-between;
    padding: 15px 0;
    border-bottom: 1px solid #dee2e6;
    align-items: flex-start;
}

.order-item:last-child {
    border-bottom: none;
}

.order-item .item-info h4 {
    margin: 0 0 5px 0;
    font-size: 1.1em;
    color: #333;
}

.order-item .item-info p {
    margin: 0 0 5px 0;
    color: #666;
    font-size: 0.95em;
}

.order-item .item-info small {
    color: #888;
    font-size: 0.85em;
}

.order-item .item-total {
    font-weight: bold;
    color: #007bff;
    min-width: 80px;
    text-align: right;
}

.order-total {
    display: flex;
    justify-content: space-between;
    font-size: 1.3em;
    font-weight: bold;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 2px solid #000;
    color: #000;
}

.payment-section {
    background: white;
    padding: 30px;
    border-radius: 10px;
    border: 1px solid #e9ecef;
}

.payment-section h2 {
    margin-bottom: 25px;
    color: #333;
    font-size: 1.3em;
}

.payment-methods {
    display: flex;
    gap: 20px;
    margin-bottom: 25px;
    flex-wrap: wrap;
}

.payment-methods label {
    display: flex;
    align-items: center;
    cursor: pointer;
    padding: 12px 20px;
    background: #f8f9fa;
    border: 2px solid #dee2e6;
    border-radius: 8px;
    transition: all 0.3s;
    min-width: 180px;
    justify-content: center;
}

.payment-methods label:hover {
    background: #e9ecef;
    border-color: #007bff;
}

.payment-methods input[type="radio"] {
    margin-right: 10px;
    transform: scale(1.2);
}

.payment-methods input[type="radio"]:checked + .radio-label {
    color: #007bff;
    font-weight: bold;
}

.payment-methods input[type="radio"]:checked {
    accent-color: #007bff;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #495057;
    font-size: 0.9em;
}

.form-control {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ced4da;
    border-radius: 6px;
    font-size: 14px;
    transition: border-color 0.3s;
    box-sizing: border-box;
}

.form-control:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
}

.form-control.is-invalid {
    border-color: #dc3545;
}

.error-text {
    display: block;
    color: #dc3545;
    font-size: 0.85em;
    margin-top: 5px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

.checkbox-label {
    display: flex;
    align-items: center;
    cursor: pointer;
    color: #495057;
    font-size: 0.9em;
}

.checkbox-label input[type="checkbox"] {
    margin-right: 8px;
    transform: scale(1.1);
}

.form-actions {
    display: flex;
    gap: 15px;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #dee2e6;
}

.btn-secondary, .btn-primary {
    padding: 12px 25px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: bold;
    display: inline-block;
    text-align: center;
    flex: 1;
    border: none;
    cursor: pointer;
    font-size: 1em;
    transition: all 0.3s;
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #5a6268;
    transform: translateY(-2px);
}

.btn-primary {
    background: #007bff;
    color: white;
}

.btn-primary:hover {
    background: #0056b3;
    transform: translateY(-2px);
}

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 6px;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

/* Responsive */
@media (max-width: 768px) {
    .checkout-grid {
        grid-template-columns: 1fr;
    }

    .payment-methods {
        flex-direction: column;
    }

    .payment-methods label {
        width: 100%;
    }

    .form-row {
        grid-template-columns: 1fr;
    }

    .form-actions {
        flex-direction: column;
    }

    .btn-secondary, .btn-primary {
        width: 100%;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const paymentForm = document.getElementById('paymentForm');
    const savedCardsSection = document.getElementById('savedCardsSection');
    const newCardSection = document.getElementById('newCardSection');
    const cardIdSelect = document.getElementById('card_id');

    // Mostrar/Ocultar secciones según método de pago
    paymentForm.addEventListener('change', function(e) {
        if (e.target.name === 'payment_method') {
            if (e.target.value === 'saved_card') {
                if (savedCardsSection) savedCardsSection.style.display = 'block';
                newCardSection.style.display = 'none';
                if (cardIdSelect) cardIdSelect.required = true;
            } else {
                if (savedCardsSection) savedCardsSection.style.display = 'none';
                newCardSection.style.display = 'block';
                if (cardIdSelect) cardIdSelect.required = false;
            }
        }
    });

    // Formato automático para fecha de expiración
    const expirationInput = document.getElementById('expiration_date');
    if (expirationInput) {
        expirationInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
            e.target.value = value;
        });
    }

    // Limitar CVV a 4 dígitos
    const cvvInput = document.getElementById('cvv');
    if (cvvInput) {
        cvvInput.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '').substring(0, 4);
        });
    }

    // Formato para número de tarjeta
    const cardNumberInput = document.getElementById('card_number');
    if (cardNumberInput) {
        cardNumberInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.replace(/(.{4})/g, '$1 ').trim();
            e.target.value = value;
        });
    }
});
</script>
@endsection