<?php
include("conexion.php");

if (!isset($_GET['id_consulta'])) {//obtiene el id de la consulta a borrar
    die("ID de consulta no recibido.");
}

$id_consulta = $_GET['id_consulta'];//variable con el id

if ($id_consulta > 0) {
    $stmt = $connPHP->prepare("DELETE FROM consultas WHERE id_consulta = ?");//borra la consulta
    $stmt->bind_param("i", $id_consulta);

    if ($stmt->execute()) {
        echo "<script>window.location.href='preguntas.php';</script>";//redirige
    } else {
        echo "Error al eliminar la consulta.";//mensaje de error
    }

    $stmt->close();
} else {
    echo "ID inválido.";
}

$connPHP->close();
?>