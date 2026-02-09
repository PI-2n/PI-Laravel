<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BitKeys')</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/@n8n/chat/dist/style.css" rel="stylesheet" />
    <script type="module">
        import { createChat } from 'https://cdn.jsdelivr.net/npm/@n8n/chat/dist/chat.bundle.es.js';

        createChat({
            webhookUrl: 'http://localhost:5678/webhook/1cac85f5-c84f-4a32-a4cc-dc79da54b413/chat'
        });
    </script>
</head>

<body class="body">
    <header class="header">
        @include('partials.header')
    </header>

    <main class="main">
        @yield('content')
    </main>

    <footer class="footer">
        @include('partials.footer')
    </footer>

    {{-- Toast Notification --}}
    @if(session('success'))
        <div id="toast-notification" class="toast-notification success show">
            <span>✅</span> {{ session('success') }}
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const toast = document.getElementById('toast-notification');
                if (toast) {
                    setTimeout(() => {
                        toast.classList.remove('show');
                    }, 3000);

                    const badge = document.querySelector('.cart-badge');
                    if (badge) {
                        badge.classList.add('pulse');
                        setTimeout(() => {
                            badge.classList.remove('pulse');
                        }, 500);
                    }
                }
            });
        </script>
    @endif

    @stack('scripts')
</body>

</html>