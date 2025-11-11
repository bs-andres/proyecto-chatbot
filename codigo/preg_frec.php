<?php
session_start();
include("conexion.php");

//consulta para obtener las 7 preguntas con mayor contador que no sean del menu
$sql = "SELECT id_consulta, titulo, pregunta FROM consultas WHERE preg_contestada = true AND pregunta > 5 ORDER BY contador DESC LIMIT 7";
$resultado = $connPHP->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Preguntas Frecuentes</title>
    <link rel="stylesheet" href="css/diseño.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table { 
            width: 80%;
            margin: auto;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(32, 221, 250, 0.5);
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
    </style>
    <a href="chat.php">
        <img src="../otros/flecha.png" alt="logo" style="width:60px;">
    </a>
</head>
<body>
        <h2 class="text-center mb-4" style="color:white;">Preguntas más frecuentes</h2>
        <table>
            <thead>
                <tr>
                    <th>Pregunta</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                        $pregunta = ($fila['titulo']);
                        echo "<tr>";
                        echo "<td>" . ($fila['titulo']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2' class='text-center'>no se ingresaron preguntas.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$connPHP->close();
?>