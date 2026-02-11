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
                <h3>{{ __('Cerrar Sesión') }}</h3>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-secondary">{{ __('Cerrar sesión') }}</button>
                </form>
            </div>

            @if (Auth::user()->role_id === 1)
                <div class="profile-container">
                    <h3 class="add-product">{{ __('Añadir producto') }}</h3>

                    <div class="product-actions">
                        <a href="{{ route('products.create') }}" class="btn-secondary">
                            {{ __('Añadir Producto') }}
                        </a>
                    </div>
                </div>
                <div class="profile-container">
                    <h3>{{ __('Importar productos desde Excel') }}</h3>
                    <div class="product-actions" style="margin-top: 10px;">
                        <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="file" name="file" required class="file-input">

                            <button type="submit" class="btn-secondary" style="margin-top: 10px;">
                                {{ __('Importar') }}
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>

    </div>
    </div>
@endsection