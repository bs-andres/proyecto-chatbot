<?php
include("conexion.php");

//sentencia sql para obtener las preguntas no contestadas
$sql = "SELECT id_consulta, pregunta FROM consultas WHERE preg_contestada = FALSE";//sql que agarra id y su pregunta donde la pregunta no haya sido contestada
$resultado = $connPHP->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/diseños.css">
    <title>Preguntas sin responder</title>
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
</head>
<a href="chat.php">
    <img src="../otros/flecha.png" alt="logo" style="width:60px;">
</a>
<body>
    <h1 style="text-align:center; color: white">Preguntas sin responder</h1>
    <table>
        <tr><!-- tabla -->
            <th>Pregunta</th>
            <th>Añadir Respuesta</th>
        </tr>
        <?php
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($fila["pregunta"]) . "</td>";
                echo "<td>
                    <a href='responder.php?id_consulta=" . $fila["id_consulta"] . "'>
                        <button type='button' class='btn-inicio'>Responder</button>
                    </a>
                </td>";
            echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No hay preguntas sin responder.</td></tr>";//si no hay nada muestra mensaje
        }
        $connPHP->close();
        ?>
    </table>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
