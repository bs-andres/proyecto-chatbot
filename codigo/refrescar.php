<?php
session_start();
include("conexion.php");

$id_usuario = $_SESSION['id_usuario'];

// Elimina los mensajes del usuario en sesión
$sql = "DELETE FROM historial WHERE id_usuario = ?";
$stmt = $connPHP->prepare($sql);
$stmt->bind_param("i", $id_usuario);

if ($stmt->execute()) {
    echo "chat borrado.";
    header("Location: chat.php");
} else {
    echo "Error al eliminar el chat: " . $stmt->error;
}

$stmt->close();
$connPHP->close();
?>