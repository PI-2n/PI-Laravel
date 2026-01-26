<div class="profile-section">
    <h3>{{ __('Información del perfil') }}</h3>
    <p class="section-description">{{ __("Actualiza la información de tu cuenta y dirección de correo.") }}</p>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <label for="name">{{ __('Nombre') }} *</label>
        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        @error('name')
        <span class="text-danger">{{ $message }}</span>
        @enderror

        <label for="last_name">{{ __('Apellidos') }} *</label>
        <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
        @error('last_name')
        <span class="text-danger">{{ $message }}</span>
        @enderror

        <label for="username">{{ __('Nombre de usuario') }} *</label>
        <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" required>
        @error('username')
        <span class="text-danger">{{ $message }}</span>
        @enderror

        <label for="email">{{ __('Email') }} *</label>
        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        @error('email')
        <span class="text-danger">{{ $message }}</span>
        @enderror

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <p class="unverified-email">
            {{ __('Tu correo no está verificado.') }}
        <form method="post" action="{{ route('verification.send') }}" style="display: inline;">
            @csrf
            <button type="submit" class="resend-link">{{ __('Reenviar correo de verificación') }}</button>
        </form>
        </p>

        @if (session('status') === 'verification-link-sent')
        <p class="success-message">{{ __('Se ha enviado un nuevo enlace de verificación.') }}</p>
        @endif
        @endif

        <button type="submit" class="btn-primary">{{ __('Guardar') }}</button>

        @if (session('status') === 'profile-updated')
        <p class="success-message">{{ __('Guardado.') }}</p>
        @endif
    </form>
</div>