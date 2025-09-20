<?php
include("conexion.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['pregunta'])) {
    $pregunta = trim($_POST['pregunta']);
    $id_usuario = $_SESSION['id_usuario'] ?? null;

    // Buscar si la pregunta ya existe en la base de datos
    $stmt = $connPHP->prepare("SELECT id_consulta, respuesta, preg_contestada, contador FROM consultas WHERE pregunta = ?");
    $stmt->bind_param("s", $pregunta);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $id_consulta = $fila['id_consulta'];
        $pregfrec = $fila['contador'] + 1;

        // Actualizar contador de frecuencia
        $stmt_update = $connPHP->prepare("UPDATE consultas SET contador = ? WHERE id_consulta = ?");
        $stmt_update->bind_param("ii", $pregfrec, $id_consulta);
        $stmt_update->execute();
        $stmt_update->close();

        // Si la pregunta ya tiene respuesta
        if ($fila['preg_contestada']) {
            $respuesta_bot = $fila['respuesta'];
            echo ($respuesta_bot);

            // Guardar en historial usando id_consulta
            if ($id_usuario) {
                $stmt_historial = $connPHP->prepare("INSERT INTO historial (id_usuario, id_consulta) VALUES (?, ?)");
                $stmt_historial->bind_param("ii", $id_usuario, $id_consulta);
                $stmt_historial->execute();
                $stmt_historial->close();
            }
        } else {
            echo "Al parecer aún no tengo una respuesta para <strong>" . ($pregunta) . "</strong>, xd<br>el menu que tenemos es: <br>1.orientaciones <br>2.ubicaciones <br>3.datos.";
        }
    } else {
        // Insertar nueva pregunta sin respuesta
        $stmt_insert = $connPHP->prepare("INSERT INTO consultas (pregunta, respuesta, contador, preg_contestada) VALUES (?, '', 1, false)");
        $stmt_insert->bind_param("s", $pregunta);

        if ($stmt_insert->execute()) {
            echo "¡Gracias por tu pregunta! Por ahora no tengo una respuesta para <strong>" . ($pregunta) . "</strong>,entonces, el menu que te ofrecemos es 1.orientaciones, 2.ubicaciones, 3.datos.";
        } else {
            echo "Error al guardar la pregunta.";
        }
        $stmt_insert->close();
    }

    $stmt->close();
}

$connPHP->close();
?>