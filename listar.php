<?php

require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST["accion"] ?? "") === "eliminar") {
    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

    if ($id) {
        $stmt = $conexion->prepare("DELETE FROM registros WHERE id = ?");
        $stmt->bind_param("i", $id);
        $mensaje = $stmt->execute()
            ? "Registro eliminado correctamente."
            : "No se pudo eliminar el registro.";
        $stmt->close();

        header("Location: listar.php?mensaje=" . urlencode($mensaje));
        exit;
    }
}

$resultado = $conexion->query("SELECT id, name, email, age, country FROM registros ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 2 - Registros</title>
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
            <h2>Registros guardados</h2>
            <p>
                Consulta, edita o elimina los usuarios registrados en la base de datos.
            </p>

            <?php if (isset($_GET["mensaje"])): ?>
                <div class="alerta exito">
                    <?php echo htmlspecialchars($_GET["mensaje"]); ?>
                </div>
            <?php endif; ?>

            <?php if ($resultado && $resultado->num_rows > 0): ?>
                <div class="tabla-contenedor">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Edad</th>
                                <th>Pais</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($registro = $resultado->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo (int) $registro["id"]; ?></td>
                                    <td><?php echo htmlspecialchars($registro["name"]); ?></td>
                                    <td><?php echo htmlspecialchars($registro["email"]); ?></td>
                                    <td><?php echo (int) $registro["age"]; ?></td>
                                    <td><?php echo htmlspecialchars($registro["country"]); ?></td>
                                    <td class="acciones">
                                        <a class="boton secundario" href="editar.php?id=<?php echo (int) $registro["id"]; ?>">Editar</a>
                                        <form action="listar.php" method="POST" onsubmit="return confirm('Deseas eliminar este registro?');">
                                            <input type="hidden" name="accion" value="eliminar">
                                            <input type="hidden" name="id" value="<?php echo (int) $registro["id"]; ?>">
                                            <button class="peligro" type="submit">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="estado-vacio">
                    <h3>No hay registros guardados</h3>
                    <p>Agrega el primer usuario desde el formulario de inicio.</p>
                    <a class="boton" href="index.php">Registrar usuario</a>
                </div>
            <?php endif; ?>
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
