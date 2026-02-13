@extends('layouts.app')

@section('title', 'Pago Exitoso - BitKeys')

@section('content')
<div class="success-page">
    <div class="success-container">
        <div class="success-icon">✓</div>
        <h1>¡Pago Realizado con Éxito!</h1>
        
        <div class="order-details">
            <div class="detail-row">
                <span class="label">Número de pedido:</span>
                <span class="value">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Fecha:</span>
                <span class="value">{{ $order->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Total pagado:</span>
                <span class="value">{{ number_format($order->total, 2) }} €</span>
            </div>
            @if ($order->payment)
                <div class="detail-row">
                    <span class="label">Transacción:</span>
                    <span class="value">{{ $order->payment->transaction_id }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Estado:</span>
                    <span class="value success">Completado</span>
                </div>
            @endif
        </div>

        <h2>Productos comprados:</h2>
        <div class="products-list">
            @foreach ($order->items as $item)
                <div class="product-item">
                    <div class="product-info">
                        <h4>{{ $item->product->name }}</h4>
                        <p class="quantity">Cantidad: {{ $item->quantity }}</p>
                        <p class="price">Precio unitario: {{ number_format($item->price, 2) }} €</p>
                    </div>
                    <div class="product-total">
                        <span>{{ number_format($item->quantity * $item->price, 2) }} €</span>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="actions">
            <a href="{{ route('home') }}" class="btn-primary">Seguir comprando</a>
            <a href="{{ route('orders.show', $order->id) }}" class="btn-secondary">Ver detalles del pedido</a>
        </div>
    </div>
</div>

<style>
.success-page {
    padding: 60px 20px;
    text-align: center;
    background: #f5f5f5;
    min-height: 100vh;
}

.success-container {
    max-width: 700px;
    margin: 0 auto;
    background: white;
    padding: 50px 40px;
    border-radius: 15px;
    box-shadow: 0 5px 30px rgba(0,0,0,0.15);
}

.success-icon {
    font-size: 100px;
    color: #28a745;
    margin-bottom: 20px;
    font-weight: bold;
}

.success-container h1 {
    color: #28a745;
    margin-bottom: 30px;
    font-size: 2.2em;
}

.order-details {
    background: #f8f9fa;
    padding: 25px;
    border-radius: 10px;
    margin-bottom: 30px;
    text-align: left;
    border: 1px solid #e9ecef;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid #dee2e6;
}

.detail-row:last-child {
    border-bottom: none;
}

.detail-row .label {
    font-weight: 500;
    color: #495057;
}

.detail-row .value {
    font-weight: bold;
    color: #333;
}

.detail-row .value.success {
    color: #28a745;
}

.products-list {
    text-align: left;
    margin-bottom: 40px;
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    border: 1px solid #e9ecef;
}

.product-item {
    display: flex;
    justify-content: space-between;
    padding: 15px;
    border-bottom: 1px solid #dee2e6;
    align-items: center;
}

.product-item:last-child {
    border-bottom: none;
}

.product-item h4 {
    margin: 0 0 8px 0;
    color: #333;
    font-size: 1.1em;
}

.product-item .quantity,
.product-item .price {
    margin: 4px 0;
    color: #666;
    font-size: 0.9em;
}

.product-total {
    font-weight: bold;
    color: #007bff;
    min-width: 80px;
    text-align: right;
}

.actions {
    display: flex;
    gap: 20px;
    justify-content: center;
    margin-top: 20px;
}

.btn-primary, .btn-secondary {
    padding: 14px 35px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    display: inline-block;
    text-align: center;
    border: none;
    cursor: pointer;
    font-size: 1.05em;
    transition: all 0.3s;
}

.btn-primary {
    background: #007bff;
    color: white;
    box-shadow: 0 4px 10px rgba(0,123,255,0.3);
}

.btn-primary:hover {
    background: #0056b3;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(0,123,255,0.4);
}

.btn-secondary {
    background: #6c757d;
    color: white;
    box-shadow: 0 4px 10px rgba(108,117,125,0.3);
}

.btn-secondary:hover {
    background: #5a6268;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(108,117,125,0.4);
}

@media (max-width: 768px) {
    .success-container {
        padding: 30px 20px;
    }

    .actions {
        flex-direction: column;
    }

    .btn-primary, .btn-secondary {
        width: 100%;
    }
}
</style>
@endsection