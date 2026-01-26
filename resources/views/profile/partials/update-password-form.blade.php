<div class="profile-section">
    <h3>{{ __('Cambiar contraseña') }}</h3>
    <p class="section-description">{{ __('Asegúrate de usar una contraseña segura.') }}</p>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <label for="current_password">{{ __('Contraseña actual') }} *</label>
        <input type="password" id="current_password" name="current_password" required>
        @error('current_password')
        <span class="text-danger">{{ $message }}</span>
        @enderror

        <label for="password">{{ __('Nueva contraseña') }} *</label>
        <input type="password" id="password" name="password" required>
        @error('password')
        <span class="text-danger">{{ $message }}</span>
        @enderror

        <label for="password_confirmation">{{ __('Confirmar nueva contraseña') }} *</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
        @error('password_confirmation')
        <span class="text-danger">{{ $message }}</span>
        @enderror

        <button type="submit" class="btn-primary">{{ __('Guardar') }}</button>

        @if (session('status') === 'password-updated')
        <p class="success-message">{{ __('Guardado.') }}</p>
        @endif
    </form>
</div>