<h3 align="center">Service Control</h3>

## Instalar las dependencias de Laravel y Javascript

Una vez descargado el proyecto se descargan las librerias que permiten el funcionamiento del mismo.

```
# Descargar Laravel
composer install

# Descargar paquetes de JavaScript
npm install

npm run dev
```

## Instalar las dependencias de Laravel y Javascript

Una vez descargado el proyecto se descargan las librerias que permiten el funcionamiento del mismo.

```
# Descargar Laravel
composer install

# Descargar paquetes de JavaScript
npm install

npm run dev
```

## Generar la llave del proyecto

```
# Generar llave
php artisan key:generate
```

## Crear el archivo .env

Para generar la conexion con la base de datos es necesario crear el archivo .env, se puede tomar como ejemplo el archivo .env.example. En caso de ser necesario, modificar el nombre de usuario y contraseña para la conexion de la base de datos.

## Configuración de la base de datos

Posteriormente se debe crear la base de datos, cuyo nombre es service_control, o puede ser modificado en el archivo .env. Una vez creada la base de datos, se corren las migraciones y los seed.
```
# Migraciones
php artisan migrate

# Seed
php artisan db:seed
```

## Levantar el servidor

Una vez realizada toda la instalacion y configuracion de la aplicacion, se levanta el servidor local.

```
# Migraciones
php artisan migrate
```