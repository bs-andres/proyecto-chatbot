<?php
session_start();
include("conexion.php");

$id_usuario = $_SESSION['id_usuario'];

$sql = "DELETE FROM usuarios WHERE id_usuario = ?";
$stmt = $connPHP->prepare($sql);
$stmt->bind_param("i", $id_usuario);

if ($stmt->execute()) {//si sale bien
    session_unset();//Cierra sesión
    session_destroy();

    header("Location: login.php");
    exit();
} else {
    echo "Error al eliminar la cuenta.";
}
