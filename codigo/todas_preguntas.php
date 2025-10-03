<?php
include("conexion.php");

//sentencia sql para obtener todas las preguntas y respuestas
$sql = "SELECT id_consulta, titulo, respuesta FROM consultas WHERE preg_contestada = true ORDER BY titulo ASC ";
$resultado = $connPHP->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/diseño.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>todas las preguntas</title>
    <style>
        body {
            background-color: #222;
        }
        table { 
            width: 80%;
            max-width: 900px;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(32, 221, 250, 0.5);
        }
        th, td {
            padding: 10px;
            text-align: left;
            word-wrap: break-word;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        .btn-inicio {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 8px;
            cursor: pointer;
        }
        .btn-inicio:hover {
            background-color: #0056b3;
        }
    </style>
    <a href="chat.php">
        <img src="../otros/flecha.png" alt="logo" style="width:60px;">
    </a>
</head>
<body>
    <h1 style="text-align:center; color: white">modificar respuestas</h1>
    <table>
        <tr><!-- tabla -->
            <th>Pregunta</th>
            <th>respuesta</th>
            <th>modificar</th>
        </tr>
        <?php
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . ($fila["titulo"]) . "</td>";
                $respuestaCompleta = ($fila["respuesta"]);
                $resumen = (mb_strimwidth($fila["respuesta"], 0, 80, "..."));
                echo "<td>
                        <span class='resumen'>$resumen</span>
                        <span class='completa' style='display:none;'>$respuestaCompleta</span>
                        <button class='ver-mas btn btn-sm btn-link'>Ver más</button>
                    </td>";
                echo "<td>
                    <a href='modificar.php?id_consulta=" . $fila["id_consulta"] . "'>
                        <button type='button' class='btn-inicio'>Modificar</button>
                    </a>
                </td>";
            echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>no hay preguntas.</td></tr>";
        }
        $connPHP->close();
        ?>
    </table>
    <script>
        //funcion de resumen de respuesta
        document.addEventListener("DOMContentLoaded", function() {
            const botones = document.querySelectorAll('.ver-mas');

            botones.forEach(boton => {
                boton.addEventListener('click', function() {
                    const celda = this.parentElement;
                    const resumen = celda.querySelector('.resumen');
                    const completa = celda.querySelector('.completa');
                    if (completa.style.display === 'none') {//nota larga
                        completa.style.display = 'inline';
                        resumen.style.display = 'none';
                        this.textContent = 'Ver menos';
                    } else {
                        completa.style.display = 'none';//nota corta
                        resumen.style.display = 'inline';
                        this.textContent = 'Ver más';
                    }
                });
            });
        });
    </script>
</body>
</html>