<?php
include("conexion.php");

// Inicializamos variables
$pregunta = "";
$respuesta = "";

// Verificamos si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_consulta'])) {
        $id = intval($_POST['id_consulta']);

        if (isset($_POST["respuesta"])) {
            $nueva_respuesta = $_POST["respuesta"];
            $sql_update = "UPDATE consultas SET respuesta = ?, preg_contestada = true WHERE id_consulta = ?";
            $stmt = $connPHP->prepare($sql_update);
            $stmt->bind_param("si", $nueva_respuesta, $id);
            $stmt->execute();
            echo "<script>alert('Respuesta actualizada correctamente'); window.location.href='todas_preguntas.php';</script>";
            exit;
        }

        // Obtener datos actuales (para mostrar en el formulario en caso de edición)
        $sql = "SELECT pregunta, respuesta FROM consultas WHERE id_consulta = ?";
        $stmt = $connPHP->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $pregunta = $fila["pregunta"];
            $respuesta = $fila["respuesta"];
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
    $id = intval($_GET['id_consulta']);
    $sql = "SELECT pregunta, respuesta FROM consultas WHERE id_consulta = ?";
    $stmt = $connPHP->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $pregunta = $fila["pregunta"];
        $respuesta = $fila["respuesta"];
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
    <title>Modificar respuesta</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <style>
        textarea {
            width: 100%;
            height: 150px;
            padding: 10px;
            font-size: 16px;
            border-radius:15px;
        }
    </style>
    <a href="chat.php">
    </a>
</head>
<body>
    <div class="login-container">
        <h2>Modificar respuesta</h2>
        <form method="POST">
            <input type="hidden" name="id_consulta" value="<?= htmlspecialchars($id) ?>">
            <label for="respuesta">Respuesta:</label><br>
            <textarea name="respuesta"><?= htmlspecialchars($respuesta) ?></textarea><!-- muestra la respuesta a modificar -->
            <button type="submit" class="btn-inicio">Guardar cambios</button>
            <button type="button" class="btn-inicio" onclick="window.location.href='todas_preguntas.php'">Volver</button>
        </form>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
