# Proyecto_Final_Backend
Instrucciones para el despliegue del lado backend Laravel 11:

## Desplegar:
Primero, obtenemos composer con permiso de ejecucion.

Instalacion de dependencias del proyecto:

    ./composer/laravel install

Preparar el .env

    cp .env.example .env
    nano .env

Generacion de llaves:

    php artisan key:generate 

Permisos para permitir la visualizacion de las imagenes

    php artisan storage:link

Migracion y seeders:

    php artisan migrate:fresh
    php artisan db:seed

**Recuerda** configurar el modo de desarrollo en .env

Preprarar Vite

    npm install

Activar el servidor usado en debug (recuerda tener el modo debug en .env), recuerda tenerlo en dos terminales separadas simultaneamente:

    npm run dev
    php artisan serve

Preparar lo necesario para pasar a produccion:

    npm run build
