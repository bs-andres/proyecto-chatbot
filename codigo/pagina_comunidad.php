<?php
session_start();
include("conexion.php");

$id_usuario = $_SESSION['id_usuario'];

//verifica si ya la vio con el booleano
$stmt = $connPHP->prepare("SELECT comunidad FROM usuarios WHERE id_usuario = ?");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$stmt->bind_result($bienvenida);
$stmt->fetch();
$stmt->close();

//si ya la vio, redirige directamente al chat
if ($bienvenida) {
    header("Location: chat_comunidad.php");
    exit;
}

//una vez que lo ve, lo actualiza
$stmt = $connPHP->prepare("UPDATE usuarios SET comunidad = 1 WHERE id_usuario = ?");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Leandal</title>
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html, body {
    width: 100%;
    height: 100%;
    overflow: hidden;
}

body {
    background: url('../otros/bienv.png') center/cover no-repeat;
    font-family: Arial, sans-serif;
    display: flex;
    flex-direction: column;
    position: relative;
}

.header {
    position: absolute;
    top: 15px;
    right: 15px;
    z-index: 10;
}

.header a {
    display: inline-block;
    border-radius: 50%;
    padding: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease;
}

.header img {
    width: 50px;
    height: 50px;
    display: block;
}

.content {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.text-content {
    padding: 30px;
    border-radius: 15px;
    max-width: 600px;
    text-align: center;
    color: #fff;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
}

.text-content h1 {
    font-size: 2.5rem;
    margin-bottom: 15px;
}

/* ✅ Media queries reales */
@media (max-width: 767px) {
    .header img { width: 40px; height: 40px; }
    .text-content { max-width: 90%; padding: 20px; }
    .text-content h1 { font-size: 1.8rem; }
}

@media (max-width: 480px) {
    .header img { width: 35px; height: 35px; }
    .text-content h1 { font-size: 1.5rem; }
    .text-content p { font-size: 0.9rem; }
}

@media (max-height: 500px) and (orientation: landscape) {
    .header img { width: 30px; height: 30px; }
    .text-content { max-width: 80%; padding: 15px; }
    .text-content h1 { font-size: 1.3rem; }
    .text-content p { font-size: 0.85rem; }
}
</style>
</head>
<body>
    <div class="header">
        <a href="chat_comunidad.php" title="Continuar">
            <img src="../otros/quitar.png" alt="Cerrar">
        </a>
    </div>
    <div class="content">
        <div class="text-content" style="color:white;">
            <h3>Bienvenido/a a nuestro</h3> 
            <h1>Rincón de Sugerencias</h1><br>
            <p>Podras opinar sobre distintos aspectos de la escuela para lograr que sea un lugar mejor y ¡no olvides ser respetuoso/a!</p>
        </div>
    </div>
</body>
</html>