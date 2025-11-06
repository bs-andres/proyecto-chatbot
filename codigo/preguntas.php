
<?php
include("conexion.php");

//sentencia sql para obtener las preguntas no contestadas
$sql = "SELECT id_consulta, titulo FROM consultas WHERE preg_contestada = FALSE";//agarra el id y la pregunta sin respuesta
$resultado = $connPHP->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/diseño.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        .btn-borrar {
            background-color: rgb(64, 224, 208);
            color: white !important;
            border: none;
            padding: 8px 12px;
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
            opacity: 1 !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            transition: background 0.3s ease, transform 0.2s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-borrar:hover {
            background-color: rgb(64, 224, 208);
            transform: translateY(-2px);
        }
    </style>
</head>
<div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 20px;">
    <a href="chat.php">
        <img src="../otros/flecha.png" alt="logo" style="width:60px;">
    </a>
    <a href='borrar_todo.php'>
        <button type='button' class='btn-borrar'>borrar todo</button>
    </a>
</div>

<body>
    <h1 style="text-align:center; color: white">Preguntas sin responder</h1>
    <table>
        <tr><!-- tabla -->
            <th>Pregunta</th>
            <th>Añadir Respuesta</th>
            <th>quitar pregunta</th>
        </tr>
        <?php
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . ($fila["titulo"]) . "</td>";
                echo "<td>
                    <a href='responder.php?id_consulta=" . $fila["id_consulta"] . "'>
                        <button type='button' class='btn-inicio'>Responder</button>
                    </a>
                </td>";
                echo "<td>
                    <a href='borrar.php?id_consulta=" . $fila["id_consulta"] . "'>
                        <button type='button' class='btn-borrar'>quitar</button>
                    </a>
                </td>";
            echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No hay preguntas sin responder.</td></tr>";//si no hay nada muestra mensaje
        }
        $connPHP->close();
        ?>
    </table>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>