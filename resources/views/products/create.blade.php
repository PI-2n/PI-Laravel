{{-- resources/views/products/create.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="product-form-container">
        <div class="form-header">
            <h1 class="form-title">Crear Nuevo Producto</h1>
            <p class="form-subtitle">Completa la información del producto</p>
        </div>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="product-form">
            @csrf

            <div class="form-section">
                <h2 class="section-title">Información Básica</h2>

                <div class="form-group">
                    <label for="name" class="form-label">Nombre del Producto *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                        class="form-input" placeholder="Ej: Smartphone Pro Max">
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price" class="form-label">Precio (€) *</label>
                    <input type="number" id="price" name="price" step="0.01" value="{{ old('price') }}" required
                        class="form-input" placeholder="Ej: 999.99">
                    @error('price')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea id="description" name="description" rows="4" class="form-input"
                        placeholder="Describe las características del producto...">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-section">
                <h2 class="section-title">Multimedia</h2>

                <div class="form-group">
                    <label for="image_url" class="form-label">Imagen del Producto *</label>
                    <input type="file" id="image_url" name="image_url" accept="image/*" required class="form-input-file">
                    <p class="form-hint">Formatos aceptados: JPG, PNG, GIF (máx. 2MB)</p>
                    @error('image_url')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="video_url" class="form-label">Video del Producto (Opcional)</label>
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
                    <input type="checkbox" id="is_offer" name="is_offer" value="1"
                        {{ old('is_offer') ? 'checked' : '' }} class="form-checkbox">
                    <label for="is_offer" class="form-checkbox-label">¿Este producto está en oferta?</label>
                </div>

                <div class="form-group" id="offer_percentage_group" style="display: none;">
                    <label for="offer_percentage" class="form-label">Porcentaje de Descuento (%)</label>
                    <input type="number" id="offer_percentage" name="offer_percentage" min="1" max="100"
                        value="{{ old('offer_percentage') }}" class="form-input" placeholder="Ej: 20">
                    <p class="form-hint">El precio final será calculado automáticamente</p>
                    @error('offer_percentage')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-section">
                <h2 class="section-title">Estado y Visibilidad</h2>

                <div class="form-group form-checkbox-group">
                    <input type="checkbox" id="active" name="active" value="1" checked class="form-checkbox">
                    <label for="active" class="form-checkbox-label">Producto activo (visible en la tienda)</label>
                </div>

                <div class="form-group form-checkbox-group">
                    <input type="checkbox" id="featured" name="featured" value="1" class="form-checkbox">
                    <label for="featured" class="form-checkbox-label">Destacar como producto principal</label>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Crear Producto</button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            // Mostrar/Ocultar campo de porcentaje de oferta
            document.getElementById('is_offer').addEventListener('change', function() {
                const offerGroup = document.getElementById('offer_percentage_group');
                offerGroup.style.display = this.checked ? 'block' : 'none';
            });

            // Validación adicional
            document.querySelector('.product-form').addEventListener('submit', function(e) {
                const isOffer = document.getElementById('is_offer').checked;
                const offerPercentage = document.getElementById('offer_percentage').value;

                if (isOffer && (!offerPercentage || offerPercentage <= 0 || offerPercentage > 100)) {
                    e.preventDefault();
                    alert('Por favor, ingresa un porcentaje de descuento válido (1-100%)');
                }
            });
        </script>
    @endpush
@endsection
