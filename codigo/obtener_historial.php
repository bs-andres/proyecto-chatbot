<?php
include("conexion.php");
session_start();

if (!isset($_SESSION['id_usuario'])) {//si inicio sesion
    http_response_code(403);
    echo "Acceso denegado.";
    exit;
}

$id_usuario = $_SESSION['id_usuario'];//variable con el id_usuario
//selecciona el "historial" de un usuario
$sql = "SELECT h.*, c.pregunta, c.respuesta
        FROM historial h
        JOIN consultas c ON h.id_consulta = c.id_consulta
        WHERE h.id_usuario = ?
        ORDER BY h.fecha ASC";

$stmt = $connPHP->prepare($sql);
$stmt->bind_param("i", $id_usuario);//parametros
$stmt->execute();
$resultado = $stmt->get_result();

$mensajes = [];//array para mensajes

while ($fila = $resultado->fetch_assoc()) {//while de la variable resultado
    $mensajes[] = [//llena el array con preguntas y respuestas
        'pregunta' => htmlspecialchars($fila['pregunta']),
        'respuesta' => htmlspecialchars($fila['respuesta'])
    ];
}

header('Content-Type: application/json');//indica que va a ser json
echo json_encode($mensajes);//lo manda en formato json
?>