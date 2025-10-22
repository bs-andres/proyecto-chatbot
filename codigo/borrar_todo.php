<?php
include("conexion.php");

$stmt = $connPHP->prepare("DELETE FROM consultas WHERE preg_contestada = false");//elimina las consultas sin respuesta

if ($stmt->execute()) {
    echo "<script>window.location.href='preguntas.php';</script>";//te redirige al archivo
} else {
    echo "Error al eliminar la consulta: " . $stmt->error;//error
}
$stmt->close();
$connPHP->close();
?>