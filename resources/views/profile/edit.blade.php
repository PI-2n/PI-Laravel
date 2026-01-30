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

    {{-- Panel de cierre de sesión y gestión de productos (a la derecha en desktop) --}}
    <div class="profile-sidebar">
        <div class="profile-container">
            <h3>{{ __('Gestión de Productos') }}</h3>
            <p class="section-description">{{ __('Administra tus productos.') }}</p>
            
            <div class="product-actions mt-4">
                <a href="{{ route('products.create') }}" class="btn-secondary">{{ __('Añadir Producto') }}</a>
            </div>
        </div>

        <div class="profile-container">
            <h3>{{ __('Cerrar Sesión') }}</h3>
            <p class="section-description">{{ __('Cierra tu sesión en este dispositivo.') }}</p>
            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit" class="btn-secondary">{{ __('Cerrar sesión') }}</button>
            </form>
        </div>

        <div class="profile-container">
            <h3>{{ __('Modificar Producto') }}</h3>
            <p class="section-description">{{ __('Edita un producto existente.') }}</p>
            
            <div class="product-actions mt-4">
                <a href="{{ route('products.index') }}" class="btn-secondary">{{ __('Ver Productos') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection