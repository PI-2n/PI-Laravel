# # PI-Laravel - BitKeys

> **Proyecto Intermodular de Desarrollo de Aplicaciones Web**

| | |
|---|---|
| **Grupo** | 1 |
| **Integrantes** | Adrián Gutiérrez Galvañ, Alejandro Rico Sánchez |
| **Fecha de presentación** | 31/03/2026 |

---

## 📋 Descripción

Este proyecto consiste en una aplicación web desarrollada con **Laravel** (backend) y **Vue** (frontend) para simular un funcionamiento moderno, desplegada mediante contenedores Docker. Incluye documentación de API, vistas Blade legacy y despliegue en GitHub Pages.

---

## 📅 Planificación del Proyecto

La gestión y planificación del proyecto se ha realizado mediante **GitHub Projects**.

- ✅ Creación y organización de tasks/tarjetas
- ✅ Asignación de tareas a los 2 integrantes del grupo
- ✅ Seguimiento del progreso mediante tableros Kanban
- ✅ Registro de actividades y milestones

🔗 **Tablero del proyecto:** https://github.com/orgs/PI-2n/projects/1

---

## 🔗 URLs Importantes

| Servicio | URL |
|---|---|
| **GitHub Pages** | https://pi-2n.github.io/PI-Laravel/ |
| **API Documentation** | http://localhost:8000/docs |
| **Vistas Blade (Legacy)** | http://localhost:8000/ |

> **Nota:** Para acceder a la documentación de la API, el contenedor debe estar levantado.

En GitHub Pages se encuentra un resumen del proyecto con todas las funcionalidades implementadas en el proyecto así como toda la documentación relacionada con prevención de riesgos, digitalización, sostenibilidad y el despliegue (que ya no está disponible) de la aplicación.

---

## 🚀 Instrucciones de Instalación

### 1. Clonar el repositorio
```bash
git clone https://github.com/pi-2n/PI-Laravel.git
cd PI-Laravel
```

### 2. Instalar dependencias

**En la raíz del proyecto:**
```bash
docker compose --build
npm install
```
**En el frontend:**
```bash
cd frontend
npm install
cd ..
```

### 3. Configurar base de datos

**Realizar migraciones:**
```bash
make migrate_fresh
```
**Poblar base de datos (seeders):**
```bash
make populate
```
**Atajo (migrar + poblar):**
```bash
make db
```
---

## ▶️ Levantar el Proyecto

### Opción A: API + Frontend juntos (Recomendado)
```bash
make up
```
### Opción B: Servicios por separado

**Solo API:**
```bash
docker compose up -d
```
**Solo Frontend:**
```bash
cd frontend
npm run dev
```
---

## ⏹️ Detener el Proyecto
```bash
make down
```
---

## 🛠️ Comandos Make Disponibles

| Comando | Descripción |
|---|---|
| make up | Levanta API + Frontend |
| make down | Detiene todos los contenedores |
| make db | Ejecuta migrate_fresh + populate |
| make migrate_fresh | Refresca la base de datos |
| make populate | Ejecuta los seeders |

---

## 📁 Estructura del Proyecto

PI-Laravel/
├── frontend/          # Aplicación frontend
├── docker-compose.yml # Configuración de contenedores
├── Makefile          # Comandos automatizados
└── README.md         # Este archivo

---

## 📄 Licencia

Este proyecto es parte de un trabajo académico.

---

<div align="center">
  <strong>Desarrollo de aplicaciones WEB CIPFP Batoi - G1</strong>
</div>
