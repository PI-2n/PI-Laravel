<div class="profile-section delete-section">
    <h3>{{ __('Eliminar cuenta') }}</h3>
    <p class="section-description">
        {{ __('Una vez eliminada, toda tu información se perderá permanentemente. Descarga cualquier dato que desees conservar antes de continuar.') }}
    </p>

    <form method="post" action="{{ route('profile.destroy') }}" class="mt-4" onsubmit="return confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción es irreversible.');">
        @csrf
        @method('delete')

        <label for="delete_password">{{ __('Confirma tu contraseña para eliminar la cuenta') }} *</label>
        <input type="password" id="delete_password" name="password" required>
        @error('password')
        <span class="text-danger">{{ $message }}</span>
        @enderror

        <button type="submit" class="btn-danger">{{ __('Eliminar cuenta') }}</button>
    </form>
</div>