# Coordinatics API

API de la prueba de Coordinatics.

# Instalación

  - Clonar repositorio.
  - Crear una BD y agregarla en el archivo .env (se hicieron las pruebas con MySQL).
  - Ejecutar los siguientes comandos:
    ```sh
    $ composer install
    $ php artisan key:generate
    $ php artisan migrate --seed
    ```
# Uso

  - Ejecutar el siguiente comando:
    ```sh
    $ php artisan serve
