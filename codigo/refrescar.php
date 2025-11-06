<?php
session_start();
include("conexion.php");

$id_usuario = $_SESSION['id_usuario'];

//cierra el test si se estaba haciendo
unset($_SESSION['en_test']);
unset($_SESSION['pregunta_actual']);

//elimina los mensajes del usuario en sesión
$sql = "DELETE FROM historial WHERE id_usuario = ?";
$stmt = $connPHP->prepare($sql);
$stmt->bind_param("i", $id_usuario);

if ($stmt->execute()) {
    header("Location: chat.php");//redirige
    exit;
} else {
    echo "Error al eliminar el chat: " . $stmt->error;
}

$stmt->close();
$connPHP->close();
?>
