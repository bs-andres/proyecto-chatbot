<?php
include("conexion.php");

$id_consulta = $_POST['id_consulta'] ?? 0;//recibo del post
$respuesta = $_POST['respuesta'] ?? '';

if ($id_consulta > 0 && !empty($respuesta)) {
    //se guarda la respuesta en la tabla
    $stmt = $connPHP->prepare("UPDATE consultas SET respuesta = ?, preg_contestada = TRUE WHERE id_consulta = ?");
    $stmt->bind_param("si", $respuesta, $id_consulta);

    if ($stmt->execute()) {
        echo "<script>window.location.href='preguntas.php';</script>";//redirije si sale bien
    } else {
        echo "Error al guardar la respuesta.";//mustra mensaje si no
    }

    $stmt->close();
} else {
    echo "Datos incompletos.";//si if no anda
}

$connPHP->close();
?>