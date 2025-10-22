<?php
include("conexion.php");
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $clave  = trim($_POST['clave']);

    if (empty($nombre) || empty($clave)) {
        $error = "Todos los campos son obligatorios.";
    } else {
        //verifica si el nombre ya existe
        $check_sql = "SELECT id_usuario FROM usuarios WHERE nombre = ?";
        $stmt = $connPHP->prepare($check_sql);
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "El nombre de usuario ya existe. Por favor elige otro.";
        } else {
            $stmt->close();

            //inserta nuevo usuario
            $hash = password_hash($clave, PASSWORD_DEFAULT);
            $insert_sql = "INSERT INTO usuarios (nombre, contraseña) VALUES (?, ?)";
            $stmt = $connPHP->prepare($insert_sql);
            $stmt->bind_param("ss", $nombre, $hash);

            if ($stmt->execute()) {
                //Guardar la sesión
                $_SESSION['id_usuario'] = $connPHP->insert_id;//variables de sesion
                $_SESSION['usuario']    = $nombre;
                $id_usuario = $_SESSION['id_usuario'];
                $id_consulta = 1;//mensaje de bienvenida

                //inserta mensaje inicial en el historial
                $stmt_historial = $connPHP->prepare("INSERT INTO historial (id_usuario, id_consulta) VALUES (?, ?)");//inserta en el historial
                $stmt_historial->bind_param("ii", $id_usuario, $id_consulta);
                $stmt_historial->execute();
                $stmt_historial->close();

                //redirige al chat
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
        <p style="color:red;"><?= ($error) ?></p>
    <?php endif; ?>

    <form action="registro.php" method="post">
        <input type="text" name="nombre" placeholder="Usuario" required><br>
        <input type="password" name="clave" placeholder="Contraseña" required><br>
        <button type="submit" class="btn-inicio">Registrarse</button>
        <button type="button" class="btn-inicio" onclick="window.location.href='chat.php'">Volver</button>
    </form>
</div>