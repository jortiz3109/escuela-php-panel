<p align="center">
  <img src="public/img/escuela.jpg" alt="Logo" width="500" height="200">

  <h2 align="center">Escuela de Desarrolladores PHP</h2>

  <p align="center">Equipo 01 - Aplicación: Panel</p>
</p>



<!-- TABLE OF CONTENTS -->
## Tabla de contenido

* [Sobre el proyecto](#sobre-el-proyecto)
* [Construido con](#construido-con)
* [Prerequisitos](#prerequisitos)
* [Instalación](#instalación)
* [Servicios externos](#servicios-externos)



<!-- ABOUT THE PROJECT -->
## Sobre el proyecto

En este repositorio se encuentra el código fuente del proyecto correspondiente a la 
aplicación del Panel de la ESCUELA DE DESARROLLADORES PHP | 3° Edición.

### Construido con
* [Laravel](https://laravel.com)
* [Inertia](https://inertiajs.com/)
* [VueJS](https://vuejs.org/)   

### Prerequisitos

* [Apache2](https://httpd.apache.org/)
* [MySQL](https://www.mysql.com/)
* [PHP](https://www.php.net/)
* [phpMyAdmin](https://www.phpmyadmin.net/) (opcional)
* [Node.js](https://nodejs.org/es/)
* [Composer](https://getcomposer.org/)

### Instalación

1. Clonar el repositorio
```bash
git clone git@github.com:jortiz3109/escuela-php-panel.git
```

2. Instalar dependencias del backend:
```bash
$ composer install
```
3. Generar archivo .env para configuración de las variables de entorno:
```bash
$ cp .env.example .env
```

>Ahora debemos configurar la base de datos en phpMyAdmin y en las variables de entorno que se encuentran en el archivo .env generado anteriormente. En este archivo también debemos configurar las credenciales de Mailtrap para probar la funcionalidad de verificación dle email del usuario.

4. Generar la llave de la aplicación:
```bash
$ php artisan key:generate
```

5. Migraciones y alimentación de la base de datos:
```bash
$ php artisan migrate --seed
```
6. Dependencias del frontend y construcción de assets:
```bash
$ npm install
$ npm run dev
```
- Despliegue:  
```bash
$ php artisan serve
```
- Ahora puedes ver el despliegue en la url: http://localhost:8000/

Nota: Si no cuentas con [Supervisor](http://supervisord.org/) y su configuración necesaria, debes abrir una nueva terminal y ejecutar el siguiente comando para los jobs:
```bash
$ php artisan queue:work
```
### Servicios externos

1. ####Maps

Puedes definir entre Google Maps(google) y leaflet(leaflet) como servicio de geolocalización, por defecto estará 
configurado leaflet. Si usas google tendrás que agregar el api key que requiere este servicio
```bash
MIX_MAP_SERVICE=google
MIX_MAP_GOOGLE_API_KEY=TuApyKey
```
2. #### Localización

Para poder obtener la geolocalización de la transacción desde la IP del usuario es necesario consumir un servicio
que nos provea dicha información, para ello usamos [IP Stack](https://ipstack.com/). Para configurarlo debemos agregar las 
siguientes variables

```bash
IP_STACK_API_KEY=TuApiKey
IP_STACK_ROUTE=http://api.ipstack.com/
```
    
