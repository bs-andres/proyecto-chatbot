<?php
include("conexion.php");
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $clave = $_POST['clave'];

    if (empty($nombre) || empty($clave)) {
        $error = "Todos los campos son obligatorios.";
    } else {
        // Verificar si el nombre ya existe
        $check_sql = "SELECT id_usuario FROM usuarios WHERE nombre = ?";
        $stmt = $connPHP->prepare($check_sql);
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "El nombre de usuario ya existe. Por favor elige otro.";
        } else {
            $stmt->close();

            // Insertar nuevo usuario
            $hash = password_hash($clave, PASSWORD_DEFAULT);
            $insert_sql = "INSERT INTO usuarios (nombre, contraseña) VALUES (?, ?)";
            $stmt = $connPHP->prepare($insert_sql);
            $stmt->bind_param("ss", $nombre, $hash);

            if ($stmt->execute()) {
                $_SESSION['id_usuario'] = $stmt->insert_id;
                $_SESSION['nombre'] = $nombre;

                header("Location: login.php");
                exit();
            } else {
                $error = "Error al registrar usuario: " . $stmt->error;
            }
        }

        $stmt->close();
    }

    $connPHP->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<div class="login-container">
    <h2>Crear cuenta</h2>
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form action="registro.php" method="post">
        <input type="text" name="nombre" placeholder="Usuario" required><br>
        <input type="password" name="clave" placeholder="Contraseña" required><br>
        <button type="submit" class="btn-inicio">Registrarse</button>
        <button type="button" class="btn-inicio" onclick="window.location.href='chat.php'">Volver</button>
    </form>
</div>
