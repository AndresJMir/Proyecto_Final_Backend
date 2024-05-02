# Proyecto_Final_Backend
Instrucciones para el despliegue del lado backend Laravel 11:

**Varias de los problemas y bugs que hay en Laravel 11 puedes encontrar posibles soluciones al final del README**

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

# Posibles soluciones a bugs presentes en Laravel 11

Me tope varios problemas en esta version de Laravel, por ejemplo, al hacer la instalacion via _php artisan install:api_ por algun motivo no se añade la dependencia en el composer.json del Sanctum y no da ningun mensaje de error, para poder solucionar el problema tuve que seguir los siguientes pasos:

Obligar la instalacion del Sanctum en Laravel 11

    composer require laravel/sanctum

Ver version instalada del mismo

    composer show laravel/sanctum

Si aun asi no se crea de ninguna manera la migracion correspondiente al Access Tockens, tendremos que obligarle.

Para obligar la instalacion del SanctumService y la migracion correspondiente, introduce el siguiente comando:

    php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

Ahora solo queda realizar la migracion con _php artisan migrate:fresh --seed_ y los tokens funcionaran

