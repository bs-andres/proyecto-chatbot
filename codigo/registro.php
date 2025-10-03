<?php
include("conexion.php");
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $clave = trim($_POST['clave']);

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
                // Guardar sesión usando las mismas claves que login.php
                $_SESSION['id_usuario'] = $connPHP->insert_id;
                $_SESSION['usuario']    = $nombre;

                // Ir directo al chat ya logueado
                header("Location: chat.php");
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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