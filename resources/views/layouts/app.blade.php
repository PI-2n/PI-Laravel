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
            webhookUrl: 'http://localhost:5678/webhook/1cac85f5-c84f-4a32-a4cc-dc79da54b413/chat',
        element: document.getElementById('chatbot-container'),
        i18n: {
            en: {
                title: 'Asistente BitKeys',
                subtitle: '¿En qué puedo ayudarte hoy?',
                inputPlaceholder: 'Escribe tu mensaje...',
                welcomeMessage: '¡Hola! Soy tu asistente virtual de BitKeys. ¿Cómo te puedo ayudar?',
                errorMessage: 'Lo siento, ocurrió un error. Por favor intenta nuevamente.',
                retryMessage: 'Reintentar',
                conversationStarted: 'Conversación iniciada',
                conversationEnded: 'Conversación finalizada',
                poweredBy: 'Powered by BitKeys'
            }
        }
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
    @stack('scripts')
</body>

</html>