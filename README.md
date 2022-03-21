API CUSTOMERS

Requisitos para ejecución tener instalado: 

    PHP 7.4
    Composer y
    Mysql

1. Clonar el repositorio

2. Ubicarse en el directorio del repositorio clonado y ejecutar el siguiente comando 
    composer install

3. Duplicar el archivo de configuracion .env.example y renombrar la copia con el nombre a .env

4. Buscar y colocar el valor de false en la siguiente variable
    APP_DEBUG=false

5. Para la base de datos colocar la siguiente informacion al archivo .env

        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=mydb
        DB_USERNAME=root
        DB_PASSWORD=

6. Crear la base de datos con el nombre de mydb
7. Ejecutar los siguientes comandos en orden

        php artisan key:generate
        php artisan jwt:secret
        php artisan cache:clear
        php artisan config:clear
        php artisan migrate
        php artisan db:seed
        php artisan serve



Antes de realizar peticiones en POSTMAN generar un token con la siguiente información

    Dirección: http://127.0.0.1:<port>/api/login
    Método: POST

    Body > raw > json

    {
        "email": "prueba@gmail.com",
        "password": 321123
    }



Con la ayuda del token y POSTMAN iniciar las peticiones GET POST Y DELETE, (colocar el token como se indica)
	
	Headers
		KEY							VALUE
		Authorization				Bearer <token>
		Accept						application/json





==== GENERANDO PETICIONES ====


En una nueva pestaña de POSTMAN (diferente a donde se solicito el token)
Crear un customer 

    URL: http://127.0.0.1:<port>/api/customer/
    Método: POST

        Params
            KEY							VALUE
            dni							RSGGDE2500
            id_reg						4
            id_com						6
            email						emailtesting@gmail.com
            name						Juan
            last_name					Perez
            address						Avenida Heroica #100



Solicitar todos los customers

    URL: http://127.0.0.1:<port>/api/customer/
    Método: GET

Solicitar un customer en especifico

    URL: http://127.0.0.1:<port>/api/customer/<dni> ó <email>
    Método: GET

Eliminar un customer
    
    URL: http://127.0.0.1:<port>/api/customer/<dni>
    Método: DELETE
