<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 2 - Registro de Usuarios</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Registro de Usuarios</h1>
    </header>
    <nav>
        <a href="index.php">Inicio</a>
        <a href="listar.php">Ver registros</a>
    </nav>
    <main>
        <section class="contenedor">
            <h2 id="titulo-formulario">Registrar usuario</h2>
            <p>
                Completa los datos del usuario. Los campos marcados son obligatorios.
            </p>

            <?php if (isset($_GET["mensaje"])): ?>
                <div class="alerta exito">
                    <?php echo htmlspecialchars($_GET["mensaje"]); ?>
                </div>
            <?php endif; ?>

            <form action="guardar.php" method="POST" class="formulario">
                <div class="campo">
                    <label for="name">Nombre completo</label>
                    <input type="text" id="name" name="name" maxlength="100" placeholder="Ej. Ana Martinez" autocomplete="name" required>
                    <small>Escribe el nombre y apellido del usuario.</small>
                </div>

                <div class="campo">
                    <label for="email">Correo electronico</label>
                    <input type="email" id="email" name="email" maxlength="150" placeholder="usuario@correo.com" autocomplete="email" required>
                    <small>Debe ser un correo valido y no repetido.</small>
                </div>

                <div class="campo">
                    <label for="age">Edad</label>
                    <input type="number" id="age" name="age" min="1" max="120" placeholder="Ej. 25" inputmode="numeric" required>
                    <small>Ingresa una edad entre 1 y 120.</small>
                </div>

                <div class="campo">
                    <label for="country">Pais</label>
                    <input type="text" id="country" name="country" maxlength="100" placeholder="Ej. Mexico" autocomplete="country-name" required>
                    <small>Pais donde vive el usuario.</small>
                </div>

                <button type="submit">Guardar usuario</button>
            </form>
        </section>
    </main>
    <footer>
        <p>
            Diseño web
        </p>
    </footer>
</body>
</html>
