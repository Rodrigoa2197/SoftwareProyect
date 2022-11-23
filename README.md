Pasos para instalar el proyecto
*Obviamente clonar el proyecto
* Tener instalado composer (de preferencia globalmente --agregar el path al enviroment)
* tener instalado mysql

* modificar el archivo .env y modificar los accesos a la base de datos (deben crear una antes de ejecutar los siguientes proyectos)

1- abrir una terminal/consola dentro de la carpeta raiz del proyecto y ejecutar:
# composer update
al finalizar
# composer install

2- crear las migraciones

# php artisan migrate

3- crear la semilla

# php artisan db:seed

4- correr el proyecto

# php artisan serve