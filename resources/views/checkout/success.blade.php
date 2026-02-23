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
            </div>
        </div>
    </div>
@endsection
