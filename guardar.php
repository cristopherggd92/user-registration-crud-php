<?php

require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$age = filter_input(INPUT_POST, "age", FILTER_VALIDATE_INT);
$country = trim($_POST["country"] ?? "");

if ($name === "" || $email === "" || $age === false || $age === null || $country === "") {
    header("Location: index.php?mensaje=" . urlencode("Todos los campos son obligatorios."));
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: index.php?mensaje=" . urlencode("El correo electronico no es valido."));
    exit;
}

if ($id) {
    $sql = "UPDATE registros SET name = ?, email = ?, age = ?, country = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssisi", $name, $email, $age, $country, $id);
    $destino = "listar.php";
    $mensaje = "Registro actualizado correctamente.";
} else {
    $sql = "INSERT INTO registros (name, email, age, country) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssis", $name, $email, $age, $country);
    $destino = "index.php";
    $mensaje = "Registro guardado correctamente.";
}

if (!$stmt->execute()) {
    $mensaje = $conexion->errno === 1062
        ? "El correo electronico ya esta registrado."
        : "No se pudo guardar el registro: " . $conexion->error;
}

$stmt->close();
$conexion->close();

header("Location: {$destino}?mensaje=" . urlencode($mensaje));
exit;
