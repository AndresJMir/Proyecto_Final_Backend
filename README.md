# Proyecto_Final_Backend
Instrucciones para el despliegue del lado backend Laravel 11:

## Desplegar:
Primero, obtenemos composer con permiso de ejecucion.

Instalacion de dependencias del proyecto:

    ./composer/laravel install

Vamos a la carpeta de laravel

    cd laravel

Preparar el .env

    cp .env.example .env
    nano .env

Si la base de datos es un sqlite:
_En caso de no usar sqlite, poner los datos de conexion en el .env_
    touch database/database.sqlite

Generacion de llaves:

    php artisan key:generate 

Permisos para permitir la visualizacion de las imagenes

    php artisan storage:link

Migracion y seeders:

    php artisan migrate:fresh
    php artisan db:seed
**O hazlo con un comnado:** _php artisan migrate:fresh --seed_

**Recuerda** configurar el modo de desarrollo en .env

Preprarar Vite

    npm install

Activar el servidor usado en debug (recuerda tener el modo debug en .env), recuerda tenerlo en dos terminales separadas simultaneamente:

    npm run dev
    php artisan serve

Preparar lo necesario para pasar a produccion:

    npm run build
