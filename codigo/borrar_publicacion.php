<?php
include("conexion.php");

// Si viene por AJAX (POST)
if (isset($_POST['id_publicacion'])) {
    $id = intval($_POST['id_publicacion']); // seguridad

    $sql = "DELETE FROM publicaciones WHERE id_publicacion = $id";
    if (mysqli_query($connPHP, $sql)) {
        echo "ok"; // devolvemos texto simple para AJAX
    } else {
        echo "error_db";
    }
    exit; // muy importante: corta aquí
}

// Si se accede directamente por URL, redirige como antes
header("Location: chat_comunidad.php");
exit;
?>
