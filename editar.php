<?php

require_once "conexion.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
    header("Location: listar.php?mensaje=" . urlencode("Registro no valido."));
    exit;
}

$stmt = $conexion->prepare("SELECT id, name, email, age, country FROM registros WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$registro = $resultado->fetch_assoc();
$stmt->close();

if (!$registro) {
    $conexion->close();
    header("Location: listar.php?mensaje=" . urlencode("El registro no existe."));
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 2 - Editar registro</title>
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
            <h2 id="titulo-formulario">Editar usuario</h2>
            <p>
                Actualiza los datos necesarios y guarda los cambios.
            </p>

            <form action="guardar.php" method="POST" class="formulario">
                <input type="hidden" name="id" value="<?php echo (int) $registro["id"]; ?>">

                <div class="campo">
                    <label for="name">Nombre completo</label>
                    <input type="text" id="name" name="name" maxlength="100" value="<?php echo htmlspecialchars($registro["name"]); ?>" placeholder="Ej. Ana Martinez" autocomplete="name" required>
                    <small>Escribe el nombre y apellido del usuario.</small>
                </div>

                <div class="campo">
                    <label for="email">Correo electronico</label>
                    <input type="email" id="email" name="email" maxlength="150" value="<?php echo htmlspecialchars($registro["email"]); ?>" placeholder="usuario@correo.com" autocomplete="email" required>
                    <small>Debe ser un correo valido y no repetido.</small>
                </div>

                <div class="campo">
                    <label for="age">Edad</label>
                    <input type="number" id="age" name="age" min="1" max="120" value="<?php echo (int) $registro["age"]; ?>" placeholder="Ej. 25" inputmode="numeric" required>
                    <small>Ingresa una edad entre 1 y 120.</small>
                </div>

                <div class="campo">
                    <label for="country">Pais</label>
                    <input type="text" id="country" name="country" maxlength="100" value="<?php echo htmlspecialchars($registro["country"]); ?>" placeholder="Ej. Mexico" autocomplete="country-name" required>
                    <small>Pais donde vive el usuario.</small>
                </div>

                <div class="acciones-formulario">
                    <button type="submit">Actualizar usuario</button>
                    <a class="boton secundario" href="listar.php">Cancelar</a>
                </div>
            </form>
        </section>
    </main>
    <footer>
        <p>
            Actividad 2 - Aplicaciones Interactivas
        </p>
    </footer>
</body>
</html>
<?php

$conexion->close();
