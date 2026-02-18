<script setup>
import { onMounted } from 'vue';

onMounted(() => {
    const link = document.createElement('link');
    link.href = 'https://cdn.jsdelivr.net/npm/@n8n/chat/dist/style.css';
    link.rel = 'stylesheet';
    document.head.appendChild(link);

    const script = document.createElement('script');
    script.type = 'module';
    script.innerHTML = `
        import { createChat } from 'https://cdn.jsdelivr.net/npm/@n8n/chat/dist/chat.bundle.es.js';

        createChat({
            webhookUrl: 'http://localhost:5678/webhook/1cac85f5-c84f-4a32-a4cc-dc79da54b413/chat'
        });
    `;
    document.body.appendChild(script);
});
</script>

<template>
    <div id="n8n-chat"></div>
</template>
