@extends('layouts.app')

@section('title', $product->name)

@section('content')

    <main class="product-page-main">
        <div class="product-page-container">

            {{-- Mensajes de sesión --}}
            @if(session('success'))
                <p class="msg-alert success">{{ session('success') }}</p>
            @endif
            @if(session('error'))
                <p class="msg-alert error">{{ session('error') }}</p>
            @endif

            <div class="product-detail">
                <div class="product-image">
                    <img src="{{ asset('images/products/' . $product->image_url) }}" alt="{{ $product->name }}">
                    @auth
                        @if(Auth::user()->role_id === 1)
                            <div class="edit-container">
                                <a href="{{ route('products.edit', $product) }}" class="btn-secondary">{{ __('Editar Producto') }}</a>
                            </div>
                        @endif
                    @endauth
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

                    @if($product->platforms->count() > 0)
                        <div class="platform-selector">
                            <p class="selector-label">Plataforma:</p>
                            <div class="platforms-grid">
                                @foreach($product->platforms as $platform)
                                    @php
                                        $iconName = 'pc';
                                        $name = strtolower($platform->name);
                                        if (Str::contains($name, 'xbox'))
                                            $iconName = 'xbox';
                                        elseif (Str::contains($name, ['ps', 'playstation']))
                                            $iconName = 'ps';
                                        elseif (Str::contains($name, ['switch', 'nintendo']))
                                            $iconName = 'switch';
                                        elseif (Str::contains($name, 'steam'))
                                            $iconName = 'steam';
                                    @endphp
                                    <label class="platform-option">
                                        <input type="radio" name="platform_id" value="{{ $platform->id }}" {{ $loop->first ? 'checked' : '' }} form="add-to-cart-form">
                                        <span class="platform-badge">
                                            <img src="{{ asset('images/icons/' . $iconName . '.png') }}"
                                                alt="{{ $platform->name }}">
                                            {{ $platform->name }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="product-actions">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" id="add-to-cart-form">
                            @csrf
                            <button type="submit" class="btn-add-cart">Añadir al carrito <img
                                    src="{{ asset('images/icons/carrito.png') }}" alt="carrito"></button>
                        </form>

                        <button class="btn-fast-buy"><img src="{{ asset('images/icons/fast-buy.png') }}"
                                title="Comprar ahora" alt="comprar"></button>
                    </div>
                </div>
            </div>

            <hr>

            {{-- SECCIÓN DE COMENTARIOS --}}
            <section class="comments-section">
                <h2>Comentarios</h2>

                {{-- LISTADO DE COMENTARIOS --}}
                <div class="comments-list">
                    @forelse($product->comments as $comment)
                        <div class="comment-item">
                            <div class="comment-header">
                                <strong>{{ $comment->user->name ?? 'Usuario anónimo' }}</strong>
                                <span class="rating">⭐ {{ $comment->rating }}</span>
                            </div>
                            <p>{{ $comment->message }}</p>
                            <small class="comment-date">{{ $comment->created_at->format('d/m/Y') }}</small>

                            {{-- BOTONES DE ACCIÓN (Editar/Borrar) --}}
                            <div class="comment-actions">
                                @can('update', $comment)
                                    <button type="button" class="btn-edit-comment" onclick="editComment({{ $comment->id }}, '{{ $comment->rating }}', `{{ addslashes($comment->message) }}`)">
                                        Editar
                                    </button>
                                @endcan

                                @can('delete', $comment)
                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de eliminar este comentario?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete-comment">Eliminar</button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    @empty
                        <p>Todavía no hay comentarios de este producto.</p>
                    @endforelse
                </div>

                {{-- FORMULARIO PARA AÑADIR/EDITAR COMENTARIO --}}
                <div class="comment-form-container">
                    <h3>{{ $product->comments->where('user_id', Auth::id())->first() ? 'Edita tu comentario' : 'Deja tu comentario' }}</h3>

                    @auth
                        @php
                            $userComment = $product->comments->where('user_id', Auth::id())->first();
                        @endphp

                        <form action="{{ $userComment ? route('comments.update', $userComment) : route('comments.store', $product) }}" method="POST">
                            @csrf
                            @if($userComment)
                                @method('PUT')
                            @endif

                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="form-group">
                                <label for="rating">Puntuación:</label>
                                <select name="rating" id="rating" required>
                                    <option value="5">⭐ 5</option>
                                    <option value="4">⭐ 4</option>
                                    <option value="3">⭐ 3</option>
                                    <option value="2">⭐ 2</option>
                                    <option value="1">⭐ 1</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="message">Comentario:</label>
                                <textarea name="message" id="message" rows="4" placeholder="¿Qué te ha parecido este producto?" required>{{ $userComment->message ?? '' }}</textarea>
                            </div>

                            <button type="submit" class="btn-submit">
                                {{ $userComment ? 'Actualizar Comentario' : 'Publicar Comentario' }}
                            </button>
                        </form>
                    @else
                        <p>
                            <a href="{{ route('login') }}" style="color: #dd7710ec; text-decoration: underline;">Inicia sesión</a> 
                            para dejar un comentario.
                        </p>
                    @endauth
                </div>
            </section>

        </div>
    </main>

@endsection

@vite('resources/js/comments-form.js')