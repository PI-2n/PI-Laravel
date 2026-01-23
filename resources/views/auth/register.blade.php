@include('partials.header')

<div class="register-page">
    @if ($errors->any())
    <p style="color: red;">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ route('register') }}" novalidate>
        @csrf
        <label>Nombre*:
            <input type="text" name="name" required>
        </label><br>

        <label>Email*:
            <input type="email" name="email" required>
        </label><br>

        <label>Contraseña*:
            <input type="password" name="password" required>
        </label><br>

        <label>Repetir contraseña*:
            <input type="password" name="password_confirmation" required>
        </label><br>

        <button type="submit">Registrarse</button>
    </form>

    <p>¿Ya tienes cuenta? <a href="{{ route('login') }}"><b>Inicia sesión</b></a></p>
</div>

@include('partials.footer')

@vite([
'resources/scss/components/header.scss',
'resources/scss/components/footer.scss',
'resources/scss/pages/register.scss'])