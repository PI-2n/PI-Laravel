{{-- resources/views/products/edit.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="product-form-container">
        <div class="form-header">
            <h1 class="form-title">Editar Producto</h1>
            <p class="form-subtitle">Modifica la información del producto "{{ $product->name }}"</p>
        </div>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data"
            class="product-form">
            @csrf
            @method('PUT')

            <div class="form-section">
                <h2 class="section-title">Información Básica</h2>

                <div class="form-group">
                    <label for="sku" class="form-label">SKU (Código de Producto) *</label>
                    <input type="text" id="sku" name="sku" value="{{ old('sku', $product->sku) }}" required
                        class="form-input" placeholder="Ej: SMART-001" maxlength="50">
                    <p class="form-hint">Código único para identificar el producto</p>
                    @error('sku')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name" class="form-label">Nombre del Producto *</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required
                        class="form-input" placeholder="Ej: Smartphone Pro Max">
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price" class="form-label">Precio (€) *</label>
                    <input type="number" id="price" name="price" step="0.01" value="{{ old('price', $product->price) }}"
                        required class="form-input" placeholder="Ej: 999.99">
                    @error('price')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea id="description" name="description" rows="4" class="form-input"
                        placeholder="Describe las características del producto...">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-section">
                <h2 class="section-title">Multimedia Actual</h2>

                <div class="current-media">
                    @if ($product->image_url)
                        <div class="current-image">
                            <img src="{{ asset('images/products/' . $product->image_url) }}" alt="{{ $product->name }}"
                                class="current-media-preview">
                            <p class="current-media-label">Imagen actual</p>
                        </div>
                    @endif

                    @if ($product->video_url)
                        <div class="current-video">
                            <video src="{{ asset('video/' . $product->video_url) }}" controls
                                class="current-media-preview"></video>
                            <p class="current-media-label">Video actual</p>
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="image_url" class="form-label">Nueva Imagen (dejar vacío para mantener actual)</label>
                    <input type="file" id="image_url" name="image_url" accept="image/*" class="form-input-file">
                    <p class="form-hint">Formatos aceptados: JPG, PNG, GIF (máx. 2MB)</p>
                    @error('image_url')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="video_url" class="form-label">Nuevo Video (dejar vacío para mantener actual)</label>
                    <input type="file" id="video_url" name="video_url" accept="video/*" class="form-input-file">
                    <p class="form-hint">Formatos aceptados: MP4, WEBM (máx. 10MB)</p>
                    @error('video_url')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-section">
                <h2 class="section-title">Configuración de Oferta</h2>

                <div class="form-group form-checkbox-group">
                    <input type="checkbox" id="is_offer" name="is_offer" value="1" {{ old('is_offer', $product->is_offer) ? 'checked' : '' }} class="form-checkbox">
                    <label for="is_offer" class="form-checkbox-label">¿Este producto está en oferta?</label>
                </div>

                <div class="form-group" id="offer_percentage_group"
                    style="{{ old('is_offer', $product->is_offer) ? 'display: block;' : 'display: none;' }}">
                    <label for="offer_percentage" class="form-label">Porcentaje de Descuento (%)</label>
                    <input type="number" id="offer_percentage" name="offer_percentage" min="1" max="100"
                        value="{{ old('offer_percentage', $product->offer_percentage) }}" class="form-input"
                        placeholder="Ej: 20">
                    <p class="form-hint">El precio final será calculado automáticamente</p>
                    @if ($product->is_offer && $product->offer_percentage)
                        @php
                            $discounted = $product->price * (1 - $product->offer_percentage / 100);
                        @endphp
                        <p class="current-offer-info">
                            Precio actual con oferta: <strong>{{ number_format($discounted, 2) }}€</strong>
                            <br>
                            <span class="old-price">Precio original: {{ number_format($product->price, 2) }}€</span>
                        </p>
                    @endif
                    @error('offer_percentage')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-section">
                <h2 class="section-title">Estado y Visibilidad</h2>

                <div class="form-group form-checkbox-group">
                    <input type="checkbox" id="active" name="active" value="1" {{ old('active', $product->active) ? 'checked' : '' }} class="form-checkbox">
                    <label for="active" class="form-checkbox-label">Producto activo (visible en la tienda)</label>
                </div>

                <div class="form-group form-checkbox-group">
                    <input type="checkbox" id="featured" name="featured" value="1" {{ old('featured', $product->featured) ? 'checked' : '' }} class="form-checkbox">
                    <label for="featured" class="form-checkbox-label">Destacar como producto principal</label>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar Producto</button>
                <button type="button" class="btn btn-danger" onclick="confirmDelete()">Eliminar Producto</button>
            </div>
        </form>

        <form id="delete-form" action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>

    @push('scripts')
        <script>
            // Mostrar/Ocultar campo de porcentaje de oferta
            document.getElementById('is_offer').addEventListener('change', function () {
                const offerGroup = document.getElementById('offer_percentage_group');
                offerGroup.style.display = this.checked ? 'block' : 'none';
            });

            // Confirmación de eliminación
            function confirmDelete() {
                if (confirm('¿Estás seguro de que quieres eliminar este producto? Esta acción no se puede deshacer.')) {
                    document.getElementById('delete-form').submit();
                }
            }

            // Validación adicional
            document.querySelector('.product-form').addEventListener('submit', function (e) {
                const isOffer = document.getElementById('is_offer').checked;
                const offerPercentage = document.getElementById('offer_percentage').value;

                if (isOffer && offerPercentage && (offerPercentage <= 0 || offerPercentage > 100)) {
                    e.preventDefault();
                    alert('Por favor, ingresa un porcentaje de descuento válido (1-100%)');
                }
            });
        </script>
    @endpush
@endsection