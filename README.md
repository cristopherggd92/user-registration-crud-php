# Actividad 2 - CRUD de Usuarios

Proyecto PHP con MySQL para registrar, listar, editar y eliminar usuarios usando XAMPP.

## Requisitos

- XAMPP instalado.
- Apache y MySQL activos desde el panel de XAMPP.
- Navegador web.

## Estructura del proyecto

- `index.php`: formulario para registrar usuarios.
- `listar.php`: listado de usuarios con acciones para editar y eliminar.
- `editar.php`: formulario para modificar un usuario existente.
- `guardar.php`: guarda registros nuevos y actualiza registros existentes.
- `conexion.php`: configuracion de conexion a MySQL.
- `crear_base.sql`: script para crear la base de datos y la tabla.
- `styles.css`: estilos visuales del sitio.

## Base de datos

El proyecto usa la base de datos `actividad_2` y la tabla `registros`.

Para crearla desde phpMyAdmin:

1. Abre `http://localhost/phpmyadmin`.
2. Entra a la pestana `SQL`.
3. Copia y ejecuta el contenido de `crear_base.sql`.

Tambien puedes importarla desde terminal:

```bash
/Applications/XAMPP/xamppfiles/bin/mysql -u root < crear_base.sql
```

## Configuracion de conexion

La conexion esta definida en `conexion.php`:

```php
$servidor = "localhost";
$usuario = "root";
$password = "";
$base_datos = "actividad_2";
```

Estos datos funcionan con una instalacion normal de XAMPP en local. Si tu MySQL tiene contrasena, actualiza `$password`.

## Ejecucion en XAMPP

1. Copia o conserva la carpeta del proyecto en:

```text
/Applications/XAMPP/xamppfiles/htdocs/actividad2
```

2. Inicia Apache y MySQL desde XAMPP.
3. Abre en el navegador:

```text
http://localhost/actividad2/index.php
```

## Funcionalidades

- Registrar usuarios con nombre, correo, edad y pais.
- Validar campos obligatorios desde el formulario.
- Evitar correos duplicados por medio de una restriccion `UNIQUE`.
- Listar registros guardados.
- Editar registros existentes.
- Eliminar registros.

## Notas

El formulario usa un estilo visual en color verde para mejorar la claridad de los campos, botones y mensajes del sistema.
