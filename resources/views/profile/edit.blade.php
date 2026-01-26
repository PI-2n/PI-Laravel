@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<div class="profile-page">
    <div class="profile-main">
        <div class="profile-container">
            <h2>{{ __('Editar Perfil') }}</h2>

            @include('profile.partials.update-profile-information-form')

            <div class="section-divider"></div>

            @include('profile.partials.update-password-form')

            <div class="section-divider"></div>

            @include('profile.partials.delete-user-form')
        </div>
    </div>

    {{-- Panel de cierre de sesión (a la derecha en desktop) --}}
    <div class="profile-sidebar">
        <div class="profile-container">
            <h3>{{ __('Cerrar Sesión') }}</h3>
            <p class="section-description">{{ __('Cierra tu sesión en este dispositivo.') }}</p>
            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit" class="btn-secondary">{{ __('Cerrar sesión') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection