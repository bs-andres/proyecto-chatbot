<?php
include("conexion.php");
session_start();

$id_usuario = $_SESSION['id_usuario'] ?? 1; // Valor de prueba si no hay sesión

// Consulta para obtener preguntas y respuestas
$sql = "SELECT h.*, c.pregunta, c.respuesta
        FROM historial h
        JOIN consultas c ON h.id_consulta = c.id_consulta
        WHERE h.id_usuario = ?
        ORDER BY h.fecha ASC";

$stmt = $connPHP->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Chat</title>
    <style>
        .chat-container {
            max-width: 1200px;
            margin: 10px auto;
            border-radius: 10px;
            padding: 20px;
        }
        .chat-log {
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }
        .burbuja {
            margin: 10px 0;
            padding: 10px 15px;
            border-radius: 15px;
            max-width: 75%;
            word-wrap: break-word;
        }
        .user {
            background-color: #d1e7dd;
            align-self: flex-end;
            text-align: right;
            margin-left: auto;
        }
        .IA {
            background-color: #e2e3e5;
            align-self: flex-start;
            text-align: left;
        }
        .input-barra-derecha {
            width: 100%;
            padding: 10px;
            border-radius: 10px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <div class="chat-log">
            <?php while ($mensaje = $resultado->fetch_assoc()): ?>
                <div class="burbuja user">
                    <?= htmlspecialchars($mensaje['pregunta']) ?>
                </div>
                <div class="burbuja IA">
                    <?= htmlspecialchars($mensaje['respuesta']) ?>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>