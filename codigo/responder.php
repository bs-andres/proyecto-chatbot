<?php
if (!isset($_GET['id_consulta'])) {//¿recibio el id?
    die("ID de consulta no recibido.");//mensaje de error
}
$id_consulta = $_GET['id_consulta'];//variable con id
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responder consulta</title>
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
        <h2>Responder pregunta</h2>
        <form method="POST" action="guardar_respuesta.php">
            <input type="hidden" name="id_consulta" value="<?php echo ($id_consulta); ?>"><!-- id -->
          <textarea type="text"name="respuesta" required></textarea><br><!-- input para la respuesta -->
            <button type="submit" class="btn-inicio">Guardar respuesta</button>
            <button type="button" class="btn-inicio" onclick="window.location.href='preguntas.php'">Volver</button>
        </form>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
