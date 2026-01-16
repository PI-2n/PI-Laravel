@extends('layouts.app')

@section('title', 'Catálogo de Juegos')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-4xl font-extrabold text-orange-500">Catálogo de Juegos</h1>
    <a href="{{ route('products.create') }}" class="bg-orange-600 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded transition">
        + Nuevo Producto
    </a>
</div>

@if (session('success'))
    <div class="bg-green-900 border border-green-500 text-green-100 p-4 rounded mb-6">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach($products as $product)
        <div class="product">
            <a href="{{ route('products.show', $product->id) }}">
                <div class="media-container">
                    @if($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-image" />
                    @else
                        <div class="aspect-[3/4] bg-gray-700 flex items-center justify-center text-gray-500">Sin imagen</div>
                    @endif
                </div>
                <div class="product-text">
                    <p class="title truncate">{{ $product->name }}</p>
                    <p class="price">{{ number_format($product->price, 2) }}€</p>
                </div>
            </a>
        </div>
    @endforeach
</div>
@endsection