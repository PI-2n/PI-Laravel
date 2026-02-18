<script setup>
import { onMounted } from 'vue'
import { createChat } from '@n8n/chat'

onMounted(() => {
    createChat({
        webhookUrl: 'http://localhost:5678/webhook/1cac85f5-c84f-4a32-a4cc-dc79da54b413/chat',
        target: '#n8n-chat',
        mode: 'window',
        initialMessages: [
            '¡Hola! 👋',
            'Soy el asistente virtual de BitKeys. ¿En qué puedo ayudarte?'
        ],

        i18n: {
            en: {
                title: 'BitKeys Asistente Virtual',
                subtitle: '',
                inputPlaceholder: 'Escribe tu mensaje aquí...',
                getStarted: 'Comenzar conversación'
            }
        }
    })
})
</script>

<template>
    <div id="n8n-chat"></div>
</template>
