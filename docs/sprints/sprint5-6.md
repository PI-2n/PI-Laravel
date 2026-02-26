# ☁️ Sprint 5-6 — Integración Avanzada, Cloud y Documentación Final

## 🔗 Integración con servicios externos y gestión segura de tokens

Durante este sprint se ha implementado la **integración con APIs externas**, destacando específicamente la integración de **OAuth2** para el inicio de sesión.

### 1️⃣ Inicio de sesión con Google (OAuth2)
Se ha implementado el "Login con Google" utilizando OpenID Connect sobre OAuth2. Para ello se ha utilizado la librería estándar de Laravel, **Laravel Socialite**.

El flujo implementado es el de *Authorization Code*:  

**1.** El usuario hace clic en "Inicia sesión con Google" desde el frontend en Vue.  
**2.** El backend (API REST en Laravel) redirige a Google enviando los parámetros  necesarios (`client_id`, `redirect_uri`, `scope`, `state`).  
**3.** Una vez que el usuario autoriza la aplicación, Google retorna un código (`code`) a la ruta de redirección del backend (`redirect_uri`).  
**4.** El backend intercambia este código por el `access_token` de Google.  
**5.** Se crea o actualiza el usuario local en la base de datos de nuestro sistema usando la información proporcionada.  
**6.** Finalmente, Laravel genera un token propio (utilizando Laravel Sanctum) para que el frontend (SPA) trabaje de forma autenticada con la API interna.  

### 2️⃣ Gestión segura de tokens y credenciales
Se han aplicado estrictas buenas prácticas de seguridad y configuración, incluyendo:

- **Protección de credenciales**: El `client_secret` de Google nunca se expone en el frontend; se gestiona exclusivamente desde el backend.  
- **Variables de entorno**: Todas las claves como `GOOGLE_CLIENT_ID`, `GOOGLE_CLIENT_SECRET` y `GOOGLE_REDIRECT_URI` están protegidas y configuradas en el archivo `.env`.  
- **Validación CSRF y Errores**: Se valida el parámetro `state` para evitar ataques y se previenen problemas como `invalid_grant` o tokens caducados.  
- **Permisos mínimos**: Solo se solicitan los *scopes* estrictamente necesarios al usuario (perfil básico y correo).  
- **Control de Logs**: Los tokens obtenidos o generados no se insertan en los archivos de trazabilidad (logs) de la plataforma.  

Esta integración no solo proporciona una mejor experiencia de usuario (UX) al facilitar el inicio de sesión, sino que cumple con los requerimientos sobre la integración con servicios existentes y la gestión segura de accesos.

---

## 📚 Documentación de la API propia con Scribe (OpenAPI)

Se ha generado una **documentación completa e interactiva de la API REST del proyecto**, optando por la herramienta **Scribe** debido a su comodidad para generar la documentación de forma automática a partir del código, rutas y comentarios.

La documentación cumple con todos los requisitos necesarios para facilitar integraciones y transparencia para terceros:

- **Endpoints documentados**: Todos los endpoints principales, incluyendo las operaciones CRUD y el endpoint de autenticación, están descritos en la plataforma.  
- **Detalle exhaustivo**: Cada endpoint detalla sus parámetros, respuestas esperadas (ejemplos JSON), posibles códigos de estado HTTP (200, 201, 400, 401, 403, 404, 422, 500) y esquemas de los modelos implicados.  
- **Autenticación Bearer Token**: La UI especifica cómo se autentican las llamadas (mediante Sanctum Bearer Tokens). Está habilitada la posibilidad de introducir el token directamente en la interfaz proporcionada por Scribe para autorizar las solicitudes y probar los endpoints en vivo de forma interactiva.  
- **Regeneración de la documentación**: La documentación se actualiza fácilmente y de manera automática a través del comando Artisan integrado en Laravel:  
  ```bash
  php artisan scribe:generate
  ```

Esta herramienta genera un resultado navegable, ofreciendo una documentación de la API intuitiva y fácil de consumir.  
Para acceder a la documentación, se puede entrar desde el perfil de la página en la parte inferior o directamente haciendo clic en el siguiente enlace:  
[Documentación de la API](http://localhost:8000/docs)


---

# ⚛️ Mejoras avanzadas de Vue

Se han ampliado las capacidades del entorno SPA (Single Page Application) desarrollado en Vue.js incorporando funcionalidades avanzadas y reactivas. Estas mejoras aseguran una interfaz fluida, interactiva y validada en tiempo real.

### 1️⃣ Filtros dinámicos y Paginación

Se han implementado y sincronizado sistemas de filtrado utilizando **Pinia** (store) junto con vistas interactivas.

- **Filtrado Avanzado:** Los listados (por ejemplo, el catálogo de productos) contienen controles UI completos como barras de búsqueda, selectores de categorías o casillas de verificación para ordenar u ocultar resultados.
- **Paginación Eficiente:** Para evitar sobrecargas, la recarga de datos utiliza parámetros dinámicos hacia la API (`?q=...&platform=...&tags=...&page=...`), re-dibujando los componentes de Vue eficientemente sin necesidad de recargar la página gracias a la respuesta paginada del *backend* de Laravel.

### 2️⃣ Uso eficiente de Watchers y Ciclos de vida

La reactividad de **Vue 3 (Composition API)** permite responder de manera inmediata a cambios globales de la aplicación o a la navegación sin requerir una recarga completa.

- **Reacción a cambios en parámetros de la URL:** En los listados de productos y las vistas de detalle se utilizan observadores (`watch`) sobre la URL (`route.query` y `route.params.id`). De esta manera, cuando los filtros de búsqueda son alterados por el usuario, el sistema responde solicitando los nuevos datos de inmediato.
- **Sincronización del estado global:** Pinia se encarga de reaccionar centralmente a los cambios de autenticación del usuario o a modificaciones en el carrito de compras, comunicándolo reactivamente al resto de vistas para su repintado instantáneo.

### 3️⃣ Validación de Formularios en Tiempo Real (Vee-Validate + Yup)

Para mejorar la **Experiencia de Usuario (UX)** y anticipar envíos fallidos al backend, la capa de presentación ha incorporado el sistema estructurado de validaciones *Vee-Validate*.

- **Feedback en tiempo real:** Formularios críticos de la plataforma, como el inicio de sesión (`Login`) y el alta de usuario (`Register`), comprueban automáticamente requisitos previos (formatos de correo electrónico, contraseñas mínimas, etc.).
- **Esquemas Yup:** La integración hace uso de la herramienta `Yup` para extraer la lógica estricta de validación y mostrar estados visuales alterados (como alertas o contornos de advertencia) devolviendo mensajes intuitivos al usuario en el mismo instante en el que inserta el texto.

---

# 🎨 Presentación estética, consistencia y accesibilidad

Se ha aplicado una capa final de pulido visual para garantizar una experiencia profesional, un buen rendimiento CSS y el cumplimiento de las bases del diseño accesible.

### 1️⃣ Arquitectura CSS y Diseño Fluido

El proyecto ha sido estilizado apoyándose fuertemente en arquitectura SCSS limpia, componentes modulares y técnicas de diseño moderno adaptativo para resoluciones que van desde móviles hasta 4K.

- **Variables y Custom Properties:** Se ha centralizado la paleta de colores, márgenes y tipografía principal. Así mismo, el diseño utiliza Mixins para mantener la homogeneidad visual.
- **Microinteracciones y espaciado:** Uso sistemático de **Flexbox** y **CSS Grid** para la alineación del contenido.
- **Tipografía y tamaño fluido (`clamp`):** A lo largo del proyecto se aplica la función `clamp()` en CSS asegurando que el diseño escala independientemente sin añadir _Media Queries_ estáticos excesivos.

### 2️⃣ Accesibilidad web profesional

Nuestra interfaz ha sido pulida para ser navegrable y utilizable por la mayor cantidad de usuarios posibles:

- **Etiquetado de imágenes:** Aquellas que aportan contenido significativo tienen integrado su atributo alternativo (`alt`).
- **Contraste y visibilidad:** Se controlan los rangos de legibilidad entre tipografías y colores de fondo.
- **Jerarquía semántica:** El flujo del HTML sigue un árbol consistente en las vistas SPA utilizando las etiquetas nativas (`main`, `nav`, `h1`-`h3`) para orientar correctamente a los lectores de pantalla.

---

# 🤖 Mejora digital: IA y recomendaciones inteligentes

La plataforma integra tecnologías habilitadoras digitales para mejorar la conversión y ofrecer una navegación interactiva y adaptada a cada usuario:

### 1️⃣ Recomendador inteligente (Productos Relacionados)
Para fomentar las ventas, se ha integrado un motor de recomendación en el flujo de compra.

- **Carrito de la compra:** Cuando el usuario tiene artículos, la vista del carrito llama a un endpoint específico (`GET /api/cart/recommendations`) el cual cruza las **etiquetas (*tags*)** de los productos para mostrar un carrusel interactivo con juegos similares de la base de datos que el usuario probablemente quiera de manera rápida.
- **Detalle de producto:** Se exponen automáticamente los juegos relacionados del mismo género o etiquetas dentro de la página visible de cada videojuego.

### 2️⃣ Asistente IA (ChatBot)
La aplicación SPA cuenta con un widget que despliega un asistente basado en Inteligencia Artificial gestionado de forma nativa e impulsado a través de **n8n**.  
Este Chatbot tiene acceso contextual y en tiempo real a los modelos de la base de datos de Laravel, lo que le permite entender el inventario y resolver de forma natural y eficaz las consultas automatizadas de los clientes con información verídica y personalizada sobre productos, precios u ofertas.

---

# 🌱 E-commerce sostenible: criterios ASG y ecodiseño

Se ha revisado el proyecto bajo criterios de sostenibilidad y responsabilidad social:

- Cumplimiento de criterios ASG (Ambientales, Sociales y de Gobernanza).

Para poder obtener mas información acerca de la sostenibilidad del proyecto puedes consultar el siguiente documento:

--> [Documento sosteniblidad](../sostenibilidad/sostenibilidad.md)

---

# ☁️ Despliegue en cloud

Se ha completado el despliegue del proyecto en la nube, asegurando:

- Escalabilidad y disponibilidad de la plataforma.
- Integración con servicios de almacenamiento, bases de datos y APIs externas.

Se ha hecho el despliegue principal de la aplicación en la nube, y el despliegue de la base de datos en AWS RDS.

Se puede acceder a app desde la siguiente URL: [https://app.projectegrupg1.es/](https://app.projectegrupg1.es/)

Se puede acceder a test desde la siguiente URL: [https://test.projectegrupg1.es/](https://test.projectegrupg1.es/)

Para que los servicios de AWS funcionen correctamente, es necesario desplegar los servicios de AWS ec2 con la ip 3.213.82.57 y luego ir a **/home/app/ftp/www** para app y **/home/app/ftp/test** para test y realizar un `docker-compose up -d`.

Para mas información sobre el despliegue de la aplicación en la nube y los servicios de AWS utilizados puedes consultar el siguiente documento:

--> [Documento despliegue y AWS](../despliegue/despliegue.pdf)

---

# 🗂️ Documentación final, manual de usuario y validación

Se ha preparado la documentación final del proyecto, incluyendo:

- Manual de usuario completo y navegable.
- Guía de instalación y despliegue en entornos locales y cloud.
- Validación de todas las funcionalidades mediante pruebas unitarias y de integración.

Todo el material está disponible en el repositorio y vinculado a GitHub Pages para acceso público y actualizado.

## ✅ Conclusión del Sprint 5-6

Este sprint ha consolidado las funcionalidades avanzadas del proyecto, integrando servicios externos, mejorando la interfaz, incorporando inteligencia artificial y garantizando despliegue seguro en la nube.
La documentación final asegura que el proyecto esté listo para uso, mantenimiento y futuras ampliaciones, cumpliendo estándares profesionales y criterios de sostenibilidad.