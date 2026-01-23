@extends('layouts.app')

@section('title', 'Iniciar Sesión - BitKeys')

@section('content')
    <div class="login-page">
        @if ($errors->any())
            <p class="login-error" style="color: red; margin-bottom: 1rem;">
                {{ $errors->first() }}
            </p>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label>Email:
                <input type="email" name="email" required>
            </label><br>
            <label>Contraseña:
                <input type="password" name="password" required>
            </label><br>
            <button type="submit">Iniciar sesión</button>
        </form>

        <p>No tienes cuenta? <a href="{{ route('register') }}"><b>Regístrate</b></a></p>
    </div>
@endsection