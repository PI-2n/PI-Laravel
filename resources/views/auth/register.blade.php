@extends('layouts.app')

@section('title', 'Registro - BitKeys')

@section('content')
    <div class="register-page">
        @if ($errors->any())
            <p style="color: red;">{{ $errors->first() }}</p>
        @endif

        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf
            <label>Nombre*:
                <input type="text" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <span style="color: red; font-size: 0.9em;">{{ $message }}</span>
                @enderror
            </label><br>

            <label>Apellidos*:
                <input type="text" name="last_name" value="{{ old('last_name') }}" required>
                @error('last_name')
                    <span style="color: red; font-size: 0.9em;">{{ $message }}</span>
                @enderror
            </label><br>

            <label>Email*:
                <input type="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span style="color: red; font-size: 0.9em;">{{ $message }}</span>
                @enderror
            </label><br>

            <label>Nick*:
                <input type="text" name="username" value="{{ old('username') }}" required>
                @error('username')
                    <span style="color: red; font-size: 0.9em;">{{ $message }}</span>
                @enderror
            </label><br>

            <label>Contraseña*:
                <input type="password" name="password" required>
                @error('password')
                    <span style="color: red; font-size: 0.9em;">{{ $message }}</span>
                @enderror
            </label><br>

            <label>Repetir contraseña*:
                <input type="password" name="password_confirmation" required>
            </label><br>

            <button type="submit">Registrarse</button>
        </form>

        <p>¿Ya tienes cuenta? <a href="{{ route('login') }}"><b>Inicia sesión</b></a></p>
    </div>
@endsection