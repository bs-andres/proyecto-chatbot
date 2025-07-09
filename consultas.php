<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Paquetes Turísticos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href=".css">
</head>
<body>
    <?php
    include("conexion.php");

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        //Cuando el usuario responde si/no
        if (isset($_POST['opcion'], $_POST['pregunta_original'])) {//recibo datos del formulario
            $decision = $_POST['opcion'];//variable con la decision
            $pregunta = htmlspecialchars($_POST['pregunta_original'], ENT_QUOTES);

            if ($decision === 'no') {
                header("Location: chat.php");
                exit();
            } elseif ($decision === 'si') {//muestra formulario de agregar respuesta
                echo "
                <form method='POST'>
                    <input type='hidden' name='nueva_pregunta' value='$pregunta'>
                    <label>Escribí la nueva respuesta:</label><br>
                    <input type='text' name='respuesta' placeholder='Tu respuesta' required>
                    <button type='submit'>Guardar</button>
                </form>";
            }
        }

        //guarda la nueva respuesta
        elseif (isset($_POST['nueva_pregunta'], $_POST['respuesta'])) {
            $pregunta = trim($_POST['nueva_pregunta']);
            $respuesta = trim($_POST['respuesta']);

            $stmt = $connPHP->prepare("INSERT INTO consultas (pregunta, respuesta) VALUES (?, ?)");
            $stmt->bind_param("ss", $pregunta, $respuesta);

            if ($stmt->execute()) {
                header('Location: chat.php');
                exit();
            } else {
                echo "<p>Error al guardar: " . $stmt->error . "</p>";
            }
            $stmt->close();
        }

        //Cuando el usuario hace una consulta
        elseif (isset($_POST['pregunta'])) {
            $pregunta = trim($_POST['pregunta']);
            $stmt = $connPHP->prepare("SELECT respuesta FROM consultas WHERE pregunta = ?");
            $stmt->bind_param("s", $pregunta);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows > 0) {
                $respuesta = $resultado->fetch_assoc()['respuesta'];
                echo "<h3>Respuesta:</h3> " . htmlspecialchars($respuesta);
            } else {//formulario si no hay respuesta, le deja la opcion de agregarla
                echo "
                <p>No encontré una respuesta para: <strong>" . htmlspecialchars($pregunta) . "</strong></p>
                <p>¿Querés agregar una respuesta?</p>
                <form method='POST'>
                    <input type='hidden' name='pregunta_original' value='" . htmlspecialchars($pregunta, ENT_QUOTES) . "'>
                    <button type='submit' name='opcion' value='si' class='btn btn-success'>Sí, quiero agregar una respuesta</button>
                    <button type='submit' name='opcion' value='no' class='btn btn-danger'>No me apetece</button>
                </form>";
            }
            $stmt->close();
        }
    }

    $connPHP->close();
    ?>
</body>
</html>