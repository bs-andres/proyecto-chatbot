<?php
session_start();
include("conexion.php");

// ✅ 1) Tomar datos
// Si venimos por POST (error), tomamos esos valores
$id_consulta = $_POST['id_consulta'] ?? $_GET['id_consulta'] ?? null;
$preguntaPOST = $_POST['pregunta'] ?? null;
$tituloPOST   = $_POST['titulo'] ?? null;
$respuestaPOST = $_POST['respuesta'] ?? null;
$error        = $_POST['error'] ?? null;

// Validar ID
if (!$id_consulta) {
    die("ID de consulta no recibido.");
}

// ✅ 2) Traer datos originales si no vienen por POST
$sql = "SELECT titulo, pregunta FROM consultas WHERE id_consulta = ?";
$stmt = $connPHP->prepare($sql);
$stmt->bind_param("i", $id_consulta);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows == 0) {
    die("Consulta no encontrada.");
}

$fila = $resultado->fetch_assoc();
$tituloBD   = $fila['titulo'];
$preguntaBD = $fila['pregunta'];

// ✅ 3) Determinar cuál pregunta usar
// Si vino del POST (error), usar esa
// Si no, calcular un nuevo número sugerido
if ($preguntaPOST !== null) {
    $preguntaFinal = $preguntaPOST;
} else {
    // Obtener máximo numérico
    $sql_max = "SELECT MAX(CAST(pregunta AS UNSIGNED)) AS maxnum FROM consultas WHERE preg_contestada = TRUE";
    $res_max = $connPHP->query($sql_max);
    $row_max = $res_max->fetch_assoc();
    $maxNumero = $row_max['maxnum'] ?? 0;
    $preguntaFinal = $maxNumero + 1;
}

// ✅ 4) Título final
$tituloFinal = $tituloPOST ?? $tituloBD;

// ✅ 5) Respuesta
$respuestaFinal = $respuestaPOST ?? "";
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
        input, textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 15px;
            margin-bottom: 10px;
        }
        textarea {
            height: 150px;
        }
        label {
            color: white;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Responder pregunta</h2>
        <?php if (!empty($error)): ?>
            <p style="color:red;"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form method="POST" action="guardar_respuesta.php">
            <input type="hidden" name="id_consulta" value="<?= $id_consulta; ?>">

            <label>N° de consulta(recomendado):</label>
            <input type="text" name="pregunta" value="<?= htmlspecialchars($preguntaFinal); ?>">

            <label>Consulta:</label>
            <input type="text" name="titulo" value="<?= htmlspecialchars($tituloFinal); ?>" required>

            <label>Respuesta:</label>
            <textarea name="respuesta" required><?= htmlspecialchars($respuestaFinal); ?></textarea>

            <button type="submit" class="btn-inicio">Guardar respuesta</button>
            <button type="button" class="btn-inicio" onclick="window.location.href='preguntas.php'">Volver</button>
        </form>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>