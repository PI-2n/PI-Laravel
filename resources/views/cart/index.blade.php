@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tu Carrito de Compra</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($cart && $cart->items->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart->items as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->product->price }} €</td>
                            <td>{{ $item->quantity * $item->product->price }} €</td>
                            <td>
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                <h3>Total del Carrito:
                    {{ $cart->items->sum(function ($item) {
                return $item->quantity * $item->product->price; }) }} €</h3>
                <button class="btn btn-primary">Proceder al Pago (Demo)</button>
            </div>
        @else
            <p>Tu carrito está vacío.</p>
        @endif
    </div>
@endsection