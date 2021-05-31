## Tecnologías

- Laravel 6 como Framework de desarrollo PHP
- JavaScript
- MySql
- JSON
- XML

## Requerimientos para correr la aplicación

- Tener instalado PHP >= 7.2.5.
- Tener instalado el gestor de paquetes para PHP composer.
- Tener instalado MySql.

## Instalación de la aplicación

- Ingresar a la carpeta del proyecto.
- Revisar si existe la carpeta vendor dentro de la raiz del proyecto.
- En caso de no existir vendor, ejecutar el comando 'composer install' para instalar
  las depencias del proyecto y los archivos de configuración.

## Configuración de la base de datos

- Importar la base de datos usando el archivo backup.sql, el cual se encuentra en la carpeta raiz del proyecto
- Modificar el archivo .env, el cual se encuentra en la carpeta raiz del proyecto:

    DB_CONNECTION=mysql
    DB_HOST=ip-servidor-db
    DB_PORT=3306
    DB_DATABASE=nombre de la base
    DB_USERNAME=usuario
    DB_PASSWORD=contraseña
- Los usuarios deberan ser ingresados directamente en la base de datos, en la tabla usuarios.

## Ejecución de la app

Existen dos maneras de ejecutar la app:

- Ejecutar el comando php artisan serve –host=ip-servidor, al ejecutar este comando, se levantara la simulación de un servidor web y se generara una URL como la siguiente: http://192.168.0.27:8000, esta URL lo llevará a la página de inicio.
- Ingresar a la carpeta desde el navegador de internet: http://ip-servidor/reto-multiplica/public/ .

## Otros

## GIT

- Puede clonar el proyecto desde el siguiente repositorio de GIT HUB: https://github.com/JAlonsoER96/multiplica.git.
- Una vez clonado el proyecto deberá seguir los pasos anteriores a esta sección.

