<?php
include("conexion.php");

//variables para preg y resp
$pregunta = "";
$respuesta = "";

//si llego el archivo con post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_consulta'])) {//si llego la consulta
        $id = ($_POST['id_consulta']);//variable con id

        if (isset($_POST["respuesta"]) && isset($_POST["pregunta"])) {//si recibio respuesta y pregunta
            // convertir saltos de línea a <br> antes de guardar
            $nueva_respuesta = str_replace("\n", "<br>", $_POST["respuesta"]);
            $nueva_pregunta = str_replace("\n", "<br>", $_POST["pregunta"]);

            $sql_update = "UPDATE consultas SET titulo = ?, respuesta = ?, preg_contestada = true WHERE id_consulta = ?";
            $stmt = $connPHP->prepare($sql_update);
            $stmt->bind_param("ssi", $nueva_pregunta, $nueva_respuesta, $id);
            $stmt->execute();
            echo "<script>window.location.href='todas_preguntas.php';</script>";
            exit;
        }

        //muestra los datos a modificar
        $sql = "SELECT titulo, respuesta FROM consultas WHERE id_consulta = ?";
        $stmt = $connPHP->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            // convertir <br> a saltos de línea para mostrar en textarea
            $pregunta = str_replace(['<br>', '<br />'], "\n", $fila["titulo"]);
            $respuesta = str_replace(['<br>', '<br />'], "\n", $fila["respuesta"]);
        } else {
            echo "Consulta no encontrada.";
            exit;
        }
    } else {
        echo "ID no proporcionado.";
        exit;
    }
} elseif (isset($_GET['id_consulta'])) {
    // Si se accede por primera vez vía GET, mostramos el formulario
    $id = ($_GET['id_consulta']);
    $sql = "SELECT titulo, respuesta FROM consultas WHERE id_consulta = ?";
    $stmt = $connPHP->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        // convertir <br> a saltos de línea para mostrar en textarea
        $pregunta = str_replace(['<br>', '<br />'], "\n", $fila["titulo"]);
        $respuesta = str_replace(['<br>', '<br />'], "\n", $fila["respuesta"]);
    } else {
        echo "Consulta no encontrada.";
        exit;
    }
} else {
    echo "ID no proporcionado.";
    exit;
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Consulta</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        textarea {
            width: 100%;
            height: 150px;
            padding: 10px;
            font-size: 16px;
            border-radius:15px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Modificar consulta</h2>
        <form method="POST">
            <input type="hidden" name="id_consulta" value="<?= ($id) ?>">

            <label for="pregunta">Pregunta:</label><br>
            <textarea name="pregunta"><?= ($pregunta) ?></textarea><br>

            <label for="respuesta">Respuesta:</label><br>
            <textarea name="respuesta"><?= ($respuesta) ?></textarea><br>

            <button type="submit" class="btn-inicio">Guardar cambios</button>
            <button type="button" class="btn-inicio" onclick="window.location.href='todas_preguntas.php'">Volver</button>
        </form>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>