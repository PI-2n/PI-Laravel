# 🚀 Sprint 2 — Importación de Productos y Gestión de Usuarios

Durante este segundo sprint se ha implementado la **carga automática de productos desde Excel** y el **sistema de autenticación de usuarios** utilizando JSON Server como simulación de API REST.

---

## 📦 Importación inicial de productos (Excel → JSON Server)

En esta fase se ha desarrollado un **script en PHP** que permite importar automáticamente un catálogo de productos desde un archivo Excel proporcionado por el cliente.

Para ello se ha utilizado la librería **PhpSpreadsheet**, instalada mediante Composer dentro del contenedor Docker de PHP. Esta herramienta permite leer archivos `.xlsx`, `.xls` o `.csv` y convertir su contenido en estructuras de datos manejables en PHP.

---

### ⚙️ Proceso implementado

El flujo general de funcionamiento es el siguiente:

1. **Subida del archivo Excel** mediante formulario HTML.  
2. Almacenamiento del archivo en la carpeta `/uploads/`.  
3. Lectura del contenido con PhpSpreadsheet.  
4. Validación de columnas obligatorias.  
5. Conversión de los datos a formato JSON.  
6. Generación automática del archivo `/data/products.json`.  
7. Publicación de los productos a través de JSON Server.  

---

Una vez generado, los productos pueden consultarse en:

```
http://localhost:3000/products
```

---

### 🧾 Ejemplo de estructura `db.json` para los productos

```json
{
  "products": [
    {
      "id": "9",
      "sku": "G005",
      "nom": "Borderlands 4",
      "descripcio": "Nuevo título de la saga shooter looter (Pre-order).",
      "img": "watermark/cover_borderlands4.jpg",
      "preu": "59.99",
      "estoc": 45
    }
  ]
}
```

---

### 🐳 Integración con Docker

Se ha añadido un servicio específico de **JSON Server** dentro del archivo `docker-compose.yml`, permitiendo simular una API REST sin necesidad de base de datos MySQL.

El entorno del sprint incluye:

- Contenedor PHP  
- Contenedor Nginx  
- Contenedor JSON Server  
- Carpetas `/uploads/` y `/data/`

---

## 👥 Sistema de registro e inicio de sesión (JSON Server)

En la segunda parte del sprint se ha implementado un **sistema completo de autenticación de usuarios en PHP**, utilizando JSON Server como almacenamiento en lugar de una base de datos tradicional.

---

### 🔐 Funcionalidades desarrolladas

El sistema permite:

- Registro de nuevos usuarios  
- Inicio de sesión seguro  
- Gestión de sesiones  
- Creación y eliminación de cookies  
- Página de perfil editable  
- Cierre de sesión  

---

### 🧾 Ejemplo de estructura `db.json` para los usuarios:

```json
{
  "users": [
    {
      "id": "2",
      "username": "Martita69",
      "contrasenya": "1234",
      "email": "marta@example.com",
      "nom": "Marta",
      "lastName": "Pérez",
      "data_registre": "2025-10-31T10:00:00Z",
    }
  ]
}
```

---

## 🔄 Flujo de autenticación

### 📝 Registro

1. Validación de campos obligatorios.  
2. Comprobación de usuario duplicado mediante petición `GET`.  
3. Encriptación de contraseña.  
4. Envío mediante `POST` al JSON Server.  

---

### 🔑 Login

1. Consulta del usuario en JSON Server.  
2. Verificación con `password_verify()`.  
3. Creación de sesión con `session_start()`.  
4. Generación de cookie identificativa.  

---

### 🚪 Logout

- Eliminación de cookie.  
- Destrucción de sesión.  
- Redirección a página principal.  

---

## ⭐ Comentarios y valoraciones

Se ha implementado un sistema que permite a los **usuarios registrados y autenticados** publicar comentarios y valoraciones sobre los productos.

Esta funcionalidad mejora la experiencia de usuario, ya que permite compartir opiniones, aportar información adicional sobre los productos y generar mayor confianza en la tienda.  
Además, las valoraciones facilitan que futuros clientes puedan tomar decisiones de compra basadas en la experiencia de otros usuarios.

---

## ✅ Conclusión del Sprint 2

Este sprint ha permitido dotar al proyecto de **funcionalidad real y dinámica**.

Por un lado, la tienda ya puede cargar automáticamente su catálogo desde un archivo Excel.  
Por otro, se ha implementado un sistema completo de gestión de usuarios con autenticación segura.

Con estas bases, el proyecto evoluciona desde una estructura inicial preparada (Sprint 1) hacia una **aplicación funcional con gestión de datos y control de acceso**, lista para seguir ampliando funcionalidades en el siguiente sprint.
