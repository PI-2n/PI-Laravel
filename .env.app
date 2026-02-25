# ============================================
# APP - Configuración de Producción
# ============================================
APP_NAME=ProjecteGrupG1
APP_ENV=production
APP_KEY=base64:Y776kFynd6PFMSIWQwTzpB7nc8x9JteYYcy2E2rIc5w=
APP_DEBUG=false
APP_URL=https://app.projecteGrupG1.es

LOG_CHANNEL=stack
LOG_LEVEL=error

# ============================================
# BASE DE DATOS - Producción
# ============================================
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=pi_laravel
DB_USERNAME=pi
DB_PASSWORD=pi

# ============================================
# CACHE / COLAS / SESIONES - Producción
# ============================================
BROADCAST_DRIVER=log
CACHE_DRIVER=redis
FILESYSTEM_DISK=local
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis
SESSION_LIFETIME=120

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

# ============================================
# GOOGLE AUTH - Producción
# ============================================
GOOGLE_CLIENT_ID=782388634943-00eldr0npg8i37ndph980g76m4844oku.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=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
GOOGLE_REDIRECT_URI=https://app.projecteGrupG1.es/api/auth/google/callback

# ============================================
# FRONTEND (Vue/Vite) - Producción
# ============================================
FRONTEND_URL=https://app.projecteGrupG1.es

# ============================================
# PROXY / HEADERS - Importante detrás de Apache
# ============================================
TRUSTED_PROXIES=*
