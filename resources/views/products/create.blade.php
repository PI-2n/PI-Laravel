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
                    <label for="sku" class="form-label">SKU (Código de Producto) *</label>
                    <input type="text" id="sku" name="sku" value="{{ old('sku') }}" required
                        class="form-input" placeholder="Ej: SMART-001" maxlength="50">
                    <p class="form-hint">Código único para identificar el producto</p>
                    @error('sku')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name" class="form-label">Nombre del Producto *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                        class="form-input" placeholder="Ej: Smartphone Pro Max">
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Categorías (Tags)</label>
                    <div class="tags-container">
                        @forelse($tags as $tag)
                            <div class="tag-checkbox-group">
                                <input type="checkbox" id="tag_{{ $tag->id }}" name="tag_ids[]" 
                                    value="{{ $tag->id }}" 
                                    {{ is_array(old('tag_ids')) && in_array($tag->id, old('tag_ids')) ? 'checked' : '' }}
                                    class="form-checkbox">
                                <label for="tag_{{ $tag->id }}" class="form-checkbox-label">
                                    {{ $tag->name }}
                                </label>
                            </div>
                        @empty
                            <p class="no-tags-message">No hay categorías disponibles. <a href="{{ route('tags.create') }}">Crear una nueva categoría</a></p>
                        @endforelse
                    </div>
                    <p class="form-hint">Selecciona todas las categorías que apliquen al producto</p>
                    @error('tag_ids')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price" class="form-label">Precio (€) *</label>
                    <input type="number" id="price" name="price" step="0.01" value="{{ old('price') }}" required
                        class="form-input" placeholder="Ej: 999.99" min="0">
                    @error('price')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Descripción *</label>
                    <textarea id="description" name="description" rows="4" class="form-input" required
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
                    <label for="is_offer" class="form-checkbox-label">¿Este producto está en oferta AHORA?</label>
                </div>

                <div id="offer-dates-section">
                    <div class="form-group">
                        <label for="offer_start_date" class="form-label">Fecha de Inicio de Oferta</label>
                        <input type="date" id="offer_start_date" name="offer_start_date" 
                            value="{{ old('offer_start_date') }}" class="form-input">
                        <p class="form-hint">Deja vacío si no quieres programar una oferta futura</p>
                        @error('offer_start_date')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="offer_end_date" class="form-label">Fecha de Fin de Oferta</label>
                        <input type="date" id="offer_end_date" name="offer_end_date" 
                            value="{{ old('offer_end_date') }}" class="form-input">
                        <p class="form-hint">Deja vacío si la oferta no tiene fecha de fin</p>
                        @error('offer_end_date')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
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
            const isOfferCheckbox = document.getElementById('is_offer');
            const offerDatesSection = document.getElementById('offer-dates-section');
            const offerPercentageGroup = document.getElementById('offer_percentage_group');
            const offerStartDateInput = document.getElementById('offer_start_date');
            const offerEndDateInput = document.getElementById('offer_end_date');
            const offerPercentageInput = document.getElementById('offer_percentage');

            // Función para actualizar la visibilidad de los campos
            function updateOfferFields() {
                if (isOfferCheckbox.checked) {
                    // En oferta ahora: ocultar fechas, mostrar porcentaje
                    offerDatesSection.style.display = 'none';
                    offerPercentageGroup.style.display = 'block';
                    
                    // Establecer fecha de hoy automáticamente
                    const today = new Date().toISOString().split('T')[0];
                    offerStartDateInput.value = today;
                    
                    // Hacer obligatorio el porcentaje cuando está en oferta
                    offerPercentageInput.setAttribute('required', 'required');
                } else {
                    // No en oferta ahora: mostrar fechas, ocultar porcentaje
                    offerDatesSection.style.display = 'block';
                    offerPercentageGroup.style.display = 'none';
                    
                    // Limpiar fecha de inicio para permitir programación
                    if (offerStartDateInput.value === new Date().toISOString().split('T')[0]) {
                        offerStartDateInput.value = '';
                    }
                    
                    // Remover requerido del porcentaje
                    offerPercentageInput.removeAttribute('required');
                }
            }

            // Inicializar al cargar
            updateOfferFields();

            // Escuchar cambios en el checkbox
            isOfferCheckbox.addEventListener('change', updateOfferFields);

            // Validación del formulario
            document.querySelector('.product-form').addEventListener('submit', function(e) {
                const isOffer = isOfferCheckbox.checked;
                const offerPercentage = offerPercentageInput.value;
                const offerStartDate = offerStartDateInput.value;
                const offerEndDate = offerEndDateInput.value;

                // Si está en oferta ahora, validar porcentaje
                if (isOffer && (!offerPercentage || offerPercentage <= 0 || offerPercentage > 100)) {
                    e.preventDefault();
                    alert('Por favor, ingresa un porcentaje de descuento válido (1-100%)');
                    return;
                }

                // Si no está en oferta ahora pero hay fechas programadas, validar
                if (!isOffer && offerStartDate && !offerEndDate) {
                    if (!confirm('Has establecido una fecha de inicio pero no una fecha de fin. ¿Continuar?')) {
                        e.preventDefault();
                    }
                }
            });
        </script>
    @endpush
@endsection