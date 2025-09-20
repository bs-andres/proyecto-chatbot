<?php
include("conexion.php");

if (!isset($_GET['id_consulta'])) {
    die("ID de consulta no recibido.");
}

$id_consulta = $_GET['id_consulta'];

if ($id_consulta > 0) {
    $stmt = $connPHP->prepare("DELETE FROM consultas WHERE id_consulta = ?");
    $stmt->bind_param("i", $id_consulta);

    if ($stmt->execute()) {
        echo "<script>window.location.href='preguntas.php';</script>";
    } else {
        echo "Error al eliminar la consulta.";
    }

    $stmt->close();
} else {
    echo "ID inválido.";
}

$connPHP->close();
?>