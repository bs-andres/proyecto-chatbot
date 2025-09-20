<?php
session_start();
include("conexion.php");

// Si ya está logueado lo mando al chat
if (isset($_SESSION['usuario'])) {
    header("Location: chat.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim($_POST['usuario'] ?? '');
    $clave   = trim($_POST['clave'] ?? '');

    if (!empty($usuario) && !empty($clave)) {
        // Preparamos consulta segura
        $stmt = $connPHP->prepare("SELECT id_usuario, nombre, contraseña FROM usuarios WHERE nombre = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            // Verificar contraseña
            if (password_verify($clave, $row['contraseña'])) {
                $_SESSION['usuario'] = $row['nombre'];
                $_SESSION['id_usuario'] = $row['id_usuario'];
                header("Location: chat.php");
                exit();
            } else {
                $error = "Contraseña incorrecta";
            }
        } else {
            $error = "El usuario no existe";
        }

        $stmt->close();
    } else {
        $error = "Por favor completá ambos campos";
    }
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
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <?php if (!empty($error)): ?>
            <p style="color:red;"><?= $error ?></p>
        <?php endif; ?>
        <form method="post">
            <input type="text" name="usuario" placeholder="Usuario" required><br>
            <input type="password" name="clave" placeholder="Contraseña" required><br>
            <button type="submit" class="btn-inicio">Entrar</button>
            <button type="button" class="btn-inicio" onclick="window.location.href='registro.php'">Registrarse</button>
            <button type="button" class="btn-inicio" onclick="window.location.href='chat.php'">Volver</button>
        </form>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
