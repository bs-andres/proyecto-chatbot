<?php
include("conexion.php");
session_start(); // Asegúrate de iniciar la sesión si vas a usar $_SESSION

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['pregunta'])) {
  $pregunta = trim($_POST['pregunta']);

  // Obtengo el id del usuario
  $id_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null;

  if (!$id_usuario) {
    echo "Error: Usuario no autenticado.";
    exit;
  }

  // Guardar la pregunta en el historial (tabla mensajes)
  $stmt_historial = $connPHP->prepare("INSERT INTO mensajes (id_usuario, mensaje) VALUES (?, ?)");//insertamos los datos del historial
  $stmt_historial->bind_param("is", $id_usuario, $pregunta);
  $stmt_historial->execute();
  $stmt_historial->close();

  // Buscar si la pregunta ya existe
  $stmt = $connPHP->prepare("SELECT id_consulta, respuesta, preg_contestada, contador FROM consultas WHERE pregunta = ?");
  $stmt->bind_param("s", $pregunta);
  $stmt->execute();
  $resultado = $stmt->get_result();

  if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();

    // Incrementar contador
    $pregfrec = $fila['contador'] + 1;
    $stmt_update = $connPHP->prepare("UPDATE consultas SET contador = ? WHERE id_consulta = ?");
    $stmt_update->bind_param("ii", $pregfrec, $fila['id_consulta']);
    $stmt_update->execute();
    $stmt_update->close();

    // Mostrar respuesta o aviso
    if ($fila['preg_contestada']) {
      echo htmlspecialchars($fila['respuesta']);
    } else {
      echo "Lo siento, todavía no tengo una respuesta para <strong>" . htmlspecialchars($pregunta) . "</strong>, pero pronto la tendré.";
    }
  } else {
    // Insertar nueva pregunta sin respuesta
    $stmt_insert = $connPHP->prepare("INSERT INTO consultas (pregunta, respuesta, contador, preg_contestada) VALUES (?, '', 1, false)");
    $stmt_insert->bind_param("s", $pregunta);
    if ($stmt_insert->execute()) {
      echo "¡Gracias por tu pregunta! Por ahora no tengo una respuesta para <strong>" . htmlspecialchars($pregunta) . "</strong>.";
    } else {
      echo "Error al guardar la pregunta.";
    }
    $stmt_insert->close();
  }

  $stmt->close();
}
$connPHP->close();
?>
