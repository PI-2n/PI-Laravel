## 🟢 Sprint 4 – Desarrollo del Frontend SPA con Vue.js

Durante este srint, se han instalado las dependencias necesarias en el proyecto para pdoer trabacar con vue.
Hemos decidido mantener las vistas blades que nos sirve el proyecto con nginx por el puerto 8000 (que ya no recibirán actualizaciones) y se ha creado el directorio de frontend que contiene todas las vistas que estaban contenidas en la carpeta de resources de laravel para poder tener una SPA de vue. Se han añadido además los archivos necesarios para la gestión de usuarios, roles y tokens.

El frontend hará uso de los controladores de api creados en el sprint anterior para poder realizar la carga de datos y envar las modificaciones de los productos, comentarios y usuarios.

---

# ⚡ C1. Interfaz de usuario avanzada con Vue.js

## 🎯 Objetivo

Durante este sprint se ha consolidado completamente la parte cliente del proyecto mediante el desarrollo de una SPA (Single Page Application) con Vue 3 y Vite.

La aplicación permite una navegación fluida sin recargas de página, con actualización reactiva de datos y una separación clara entre componentes, vistas y servicios.

---

## ✅ Funcionalidades implementadas

- Navegación SPA mediante Vue Router.
- Componentes reutilizables (Navbar, Footer, ToastNotification).
- Sistema completo de vistas: Inicio, Productos, Detalle de producto, Carrito, Checkout, Perfil, Login y Registro.
- Integración completa con la API REST de Laravel.
- Gestión reactiva del estado con Pinia.
- Sistema de comentarios asociado a los productos.
- Notificaciones visuales mediante sistema de toast.
- Compilación optimizada para producción con Vite.

---

## 📂 Estructura final del Frontend

```
frontend/
├── dist/
│   ├── assets/
│   ├── images/
│   ├── video/
│   └── index.html
│
├── public/
│   ├── images/
│   └── video/
│
├── src/
│   ├── assets/
│   │   └── scss/
│   │       ├── base/
│   │       ├── components/
│   │       ├── pages/
│   │       └── utils/
│   │
│   ├── components/
│   │   ├── comments/
│   │   ├── Navbar.vue
│   │   ├── Footer.vue
│   │   ├── RoleGuard.vue
│   │   └── ToastNotification.vue
│   │
│   ├── composables/
│   │
│   ├── router/
│   │
│   ├── services/
│   │
│   ├── stores/
│   │
│   ├── views/
│   │   ├── HomeView.vue
│   │   ├── ProductsView.vue
│   │   ├── ProductDetailView.vue
│   │   ├── CartView.vue
│   │   ├── CheckoutView.vue
│   │   ├── SuccessView.vue
│   │   ├── LoginView.vue
│   │   ├── RegisterView.vue
│   │   └── ProfileView.vue
│   │
│   ├── App.vue
│   └── main.js
│
├── package.json
├── vite.config.js
└── index.html
```

---

## 🎨 Experiencia de usuario

- Navegación sin recargas de página.
- Interfaz moderna y coherente.
- Feedback visual mediante notificaciones.
- Diseño responsive.
- Transiciones suaves entre vistas.
- Adaptación dinámica del contenido según autenticación y rol.

---

# 🔐 C2. Integración de autenticación mediante API

## ✅ Implementado

- Login y registro mediante API REST.
- Gestión de token de autenticación.
- Persistencia de sesión.
- Protección de rutas privadas.
- Logout con invalidación de sesión.
- Actualización automática de la interfaz según estado del usuario.

La interfaz reacciona dinámicamente al estado de autenticación (navbar, acceso al perfil, carrito, etc.).

---

# 👥 C3. Gestión de roles y permisos

## ✅ Implementado

- Control visual de acceso según rol.
- Componente `RoleGuard` para proteger funcionalidades.
- Composable `useRole` para verificar permisos.
- Restricción de acciones según tipo de usuario.
- Coordinación con políticas y middleware del backend Laravel.

Esto garantiza coherencia entre:

- 🔒 Seguridad en el backend  
- 🖥️ Control de acceso en el frontend  

---

# 📊 Estado del Sprint 4

## 🟩 Finalizado

- SPA completamente funcional.
- Integración con backend operativa.
- Autenticación y roles implementados.
- Sistema de comentarios activo.
- Build optimizado para producción.
- Estructura modular y escalable.

---

# 🎯 Resultado final

El frontend ha evolucionado hacia una aplicación SPA moderna, reactiva y segura, completamente integrada con la API Laravel y preparada para su despliegue en entorno Docker con Nginx.

Este sprint consolida la capa cliente del proyecto siguiendo criterios profesionales de modularidad, escalabilidad y buenas prácticas de desarrollo web.
