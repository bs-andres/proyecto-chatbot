<?php
include("conexion.php");

$stmt = $connPHP->prepare("DELETE FROM consultas WHERE preg_contestada = false");

if ($stmt->execute()) {
    echo "<script>window.location.href='preguntas.php';</script>";
} else {
    echo "Error al eliminar la consulta: " . $stmt->error;
}
$stmt->close();
$connPHP->close();
?>