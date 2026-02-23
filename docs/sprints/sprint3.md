# 📈 Sprint 3 — Migración a Laravel y Arquitectura MVC

Durante este sprint se ha realizado una **migración completa del proyecto a Laravel**, adoptando una arquitectura **MVC (Modelo-Vista-Controlador)** y sustituyendo progresivamente la estructura anterior basada en PHP procedural y JSON Server.

El objetivo principal ha sido profesionalizar la aplicación, integrando base de datos MySQL, autenticación moderna y una API preparada para futuras ampliaciones.

---

## 🏗️ Creación del proyecto Laravel y configuración del entorno

Se ha creado la carpeta `laravel/` dentro del repositorio principal e inicializado el proyecto con Laravel.

Se ha configurado el archivo `.env` para conectar con la base de datos MySQL del entorno Docker ya existente, manteniendo la coherencia con el stack anterior.

El proyecto ahora funciona bajo una estructura MVC clara:

- **Modelos** → Gestión de datos con Eloquent  
- **Vistas** → Plantillas Blade  
- **Controladores** → Lógica de negocio  
- **Rutas** → Definición de endpoints web y API  

---

## 🗄️ Creación de base de datos y migraciones

Se ha trasladado la estructura anterior basada en `products.json` y `users.json` a una base de datos MySQL mediante **migraciones de Laravel**. Las tablas generadas son:

- **products**: Almacena la información de los productos
- **tags**: Almacena la información de las categorías de los productos
- **categories**: Almacena la información de las categorías de los productos
- **product_tag**: Tabla para la relacion N a N de productos con categorías
- **platform_product**: Tabla para la relacion N a N de productos con plataformas 
- **users**: Almacena la información de los usuarios
- **credit_cards**: Almacena la información de las tarjetas de crédito de los usuarios
- **roles**: Almacena la información de los roles definidos
- **comments**: Almacena la información de los comentarios de los productos
- **shopping_carts**: Almacena la información de los carritos de la compra generados
- **shopping_cart_items**: Almacena la información de cada linea del carrito de la compra
- **orders**: Almacena los pedidos realizados
- **order_items**: Almacena la información de cada linea de las órdenes de compra
- **order_payments**: Almacena la información del pago de cada orden de compra.

Para la mayoría de tablas se han generado seedes y factories para poder generar datos aleatorios y poder poblar la web para realizar pruebas sobre la integridad y las relaciones entre tablas.

A la base de datos se puede acceder desde las vistas blade por los controladores web tanto por la API por los controladores de api.

---

## 🔐 Gestión de login con Laravel Breeze

Se ha sustituido el sistema manual de autenticación del Sprint 2 por **Laravel Breeze**, utilizando la versión con vistas Blade.

Esto permite:

- Registro de usuarios
- Inicio y cierre de sesión
- Protección de rutas mediante middleware
- Hash automático de contraseñas
- Gestión segura de sesiones

La autenticación ahora se gestiona mediante:

- Middleware de Laravel
- Eloquent ORM
- Sistema de sesiones integrado

Este cambio mejora significativamente la seguridad y escalabilidad frente al sistema anterior basado en cookies manuales.

---

## 📥 Importación de productos desde Excel a MySQL

Se ha reutilizado la lógica de importación de Excel del Sprint 2, adaptándola al nuevo entorno Laravel.

En lugar de generar un archivo JSON, ahora los productos se insertan o actualizan directamente en la base de datos MySQL mediante:

- Command personalizado o controlador de importación
- Validación de campos obligatorios (`sku`, `name`, `price`, `stock`)
- Gestión de errores con mensajes claros
- Registro del número de productos importados y líneas inválidas

La importación permite actualizar productos existentes utilizando el `sku` como identificador único.

---

## 🌐 Creación de API básica de productos

Se ha implementado una API REST preparada para el Sprint 4.

### Endpoints creados:

#### 🔓 Públicos

- `POST /api/login`
- `POST /api/register`
- `GET /api/products`
- `GET /api/products/{product}`
- `GET /api/home`

#### 🔒 Protegidos (auth:sanctum)

- `POST /api/logout`
- `GET /api/user`

##### 📦 Productos (CRUD)

- `POST /api/products`
- `PUT /api/products/{product}`
- `DELETE /api/products/{product}`
- `POST /api/products/import`

##### 🏷️ Tags

- `GET /api/tags`

##### 🛒 Carrito

- `POST /api/cart/sync`

##### 🧾 Pedidos

- `GET /api/orders/{id}`

##### 💳 Checkout

- `GET /api/checkout`
- `POST /api/checkout`

##### 👤 Perfil

- `PATCH /api/profile`
- `PUT /api/password`
- `DELETE /api/profile`

##### 💬 Comentarios

- `POST /api/products/{product}/comments`
- `PUT /api/comments/{comment}`
- `DELETE /api/comments/{comment}`


Se han utilizado **Resources de Laravel** para normalizar la salida JSON y mantener una estructura consistente en las respuestas.

Esta API será consumida posteriormente por la SPA desarrollada en el siguiente sprint.

---

## 🛠️ CRUD de administración de productos

Se ha desarrollado una sección interna de administración que permite:

- Listar productos
- Editar productos importados
- Actualizar información (precio, stock, descripción, etc.)

El acceso está restringido a **usuarios autenticados con rol administrador**, utilizando middleware o políticas de acceso.

La gestión se realiza mediante vistas Blade sencillas, sin necesidad de JavaScript adicional.

---

## 🗂️ Estructura del proyecto (Directorios relevantes)

~~~text
PI-Laravel/
├── app/
│   ├── Helpers/
│   ├── Http/
│   │   ├── Controllers/
│   │   ├── Middleware/
│   │   ├── Requests/
│   │   └── Resources/
│   ├── Models/
│   ├── Policies/
│   ├── Providers/
│   ├── Services/
│   └── View/
│       └── Components/
│
├── bootstrap/
│
├── config/
│
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
│
├── docs/
│   ├── imagenes/
│   ├── recursos/
│   ├── riesgos/
│   ├── sostenibilidad/
│   └── sprints/
│
├── nginx/
│
├── public/
│   ├── build/
│   ├── images/
│   └── video/
│
├── resources/
│   ├── css/
│   ├── js/
│   ├── scss/
│   │   ├── base/
│   │   ├── components/
│   │   ├── pages/
│   │   └── utils/
│   └── views/
│       ├── auth/
│       ├── cart/
│       ├── checkout/
│       ├── components/
│       ├── layouts/
│       ├── partials/
│       ├── products/
│       └── profile/
│
├── routes/
│
├── site/
│   ├── assets/
│   ├── imagenes/
│   ├── recursos/
│   ├── riesgos/
│   ├── search/
│   ├── sostenibilidad/
│   └── sprints/
│
├── storage/
│   ├── app/
│   ├── framework/
│   └── logs/
│
├── tests/
│   ├── Feature/
│   └── Unit/
│
└── uploads/
~~~

---

## ✅ Conclusión del Sprint 3

Este sprint marca un **salto arquitectónico importante en el proyecto**.

Se ha pasado de una aplicación basada en PHP tradicional y JSON Server a un entorno profesional con:

- Arquitectura MVC
- Base de datos MySQL
- ORM Eloquent
- Autenticación integrada con Breeze
- API REST preparada para frontend desacoplado
- Panel de administración interno

Con esta base sólida, el proyecto queda preparado para evolucionar hacia una **SPA moderna en el Sprint 4**, manteniendo separación clara entre backend y frontend.
