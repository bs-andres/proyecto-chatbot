<?php
include("conexion.php");
session_start();

if (!isset($_SESSION['id_usuario'])) {
    die("no-login");
}

$id_usuario = $_SESSION['id_usuario'];
$id_pub     = intval($_POST['id_publicacion']);
$nuevo      = trim($_POST['contenido']);

// Verificar que el usuario sea el dueño
$stmt = $connPHP->prepare("SELECT id_usuario FROM publicaciones WHERE id_publicacion = ?");
$stmt->bind_param("i", $id_pub);
$stmt->execute();
$stmt->bind_result($autor);
$stmt->fetch();
$stmt->close();

if ($autor != $id_usuario) {
    die("permiso-denegado");
}

// Actualizar publicación
$stmt = $connPHP->prepare("UPDATE publicaciones SET contenido = ? WHERE id_publicacion = ?");
$stmt->bind_param("si", $nuevo, $id_pub);
$stmt->execute();
$stmt->close();

echo "ok";
