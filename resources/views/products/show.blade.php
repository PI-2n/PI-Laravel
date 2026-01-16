@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="product-detail">
    <a href="{{ route('products.index') }}" class="text-orange-500 hover:underline mb-4 inline-block">← Volver al catálogo</a>

    <div class="md:flex gap-8">
        <div class="md:w-1/3">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full rounded-lg shadow-lg">
        </div>
        <div class="md:w-2/3">
            <h1 class="text-4xl font-bold mb-2">{{ $product->name }}</h1>
            <p class="text-2xl text-orange-500 font-bold mb-4">{{ number_format($product->price, 2) }}€</p>
            
            <h3 class="font-bold text-gray-400 uppercase text-sm mb-2">Descripción</h3>
            <p class="text-gray-200 mb-6 leading-relaxed">{{ $product->description }}</p>
            
            <button class="bg-orange-600 px-6 py-2 rounded font-bold hover:bg-orange-500 transition">Comprar ahora</button>
        </div>
    </div>

    {{-- SECCIÓN DE COMENTARIOS --}}
    <div class="comments-section mt-12">
        <hr class="border-gray-700 mb-8">
        <h2 class="text-2xl font-bold mb-6 text-orange-500">Opiniones de los usuarios</h2>

        @if (session('success'))
            <div class="bg-green-800 p-3 rounded mb-4 text-white">{{ session('success') }}</div>
        @endif

        <div class="space-y-4 mb-10">
            @forelse($product->comments as $comment)
                <div class="comment-item p-4 bg-gray-800 rounded border-l-4 border-orange-500">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-bold text-white">{{ $comment->user->name ?? 'Usuario Anónimo' }}</span>
                        <span class="text-orange-400">Puntuación: {{ $comment->rating }}/5</span>
                    </div>
                    <p class="text-gray-300">"{{ $comment->message }}"</p>
                </div>
            @empty
                <p class="text-gray-500 italic">No hay comentarios todavía. ¡Sé el primero en opinar!</p>
            @endforelse
        </div>

        {{-- FORMULARIO DE COMENTARIO --}}
        <div class="comment-form-container p-6 rounded-lg">
            <h3 class="text-lg font-bold mb-4 text-white">Deja tu comentario</h3>
            <form action="{{ route('comments.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                
                <div>
                    <label class="block text-sm mb-1">Puntuación:</label>
                    <select name="rating" class="w-full p-2 rounded outline-none focus:ring-2 focus:ring-orange-500">
                        <option value="5">5 - Excelente</option>
                        <option value="4">4 - Muy bueno</option>
                        <option value="3">3 - Bueno</option>
                        <option value="2">2 - Regular</option>
                        <option value="1">1 - Malo</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm mb-1">Tu opinión:</label>
                    <textarea name="message" rows="3" class="w-full p-3 rounded outline-none focus:ring-2 focus:ring-orange-500" placeholder="Escribe aquí tu comentario..."></textarea>
                </div>

                <button type="submit" class="bg-orange-600 px-6 py-2 rounded font-bold hover:bg-orange-500 transition">Publicar</button>
            </form>
        </div>
    </div>
</div>
@endsection