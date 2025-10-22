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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #222;
            padding: 20px;
            padding-top: 80px;
        }

        /* Botón flecha arriba a la izquierda */
        .btn-volver {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
            background: none;
            border: none;
            padding: 0;
        }

        .btn-volver img {
            width: 50px;
            height: 50px;
            display: block;
            transition: transform 0.3s ease;
        }

        .btn-volver:hover img {
            transform: scale(1.1);
        }

        /* Título centrado */
        h1 {
            text-align: center;
            color: white;
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: bold;
        }

        /* Contenedor responsivo para la tabla */
        .table-container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(32, 221, 250, 0.5);
        }

        thead {
            position: sticky;
            top: 0;
        }

        th {
            background-color: #007BFF;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            border: none;
        }

        td {
            padding: 12px 15px;
            text-align: left;
            word-wrap: break-word;
            border-bottom: 1px solid #e0e0e0;
            font-size: 14px;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background-color: #f9f9f9;
        }

        /* Respuesta con truncado */
        .respuesta-cell {
            max-width: 300px;
        }

        .completa {
            word-break: break-word;
            white-space: normal;
        }

        .ver-mas {
            background-color: transparent;
            color: #007BFF;
            border: none;
            padding: 0;
            cursor: pointer;
            font-size: 12px;
            text-decoration: underline;
            margin-left: 5px;
        }

        .ver-mas:hover {
            color: #0056b3;
        }

        .btn-inicio {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12px;
            transition: background-color 0.3s ease;
            white-space: nowrap;
        }

        .btn-inicio:hover {
            background-color: #0056b3;
        }

        .btn-inicio:active {
            background-color: #003d82;
        }

        /* Responsive para tablets */
        @media (max-width: 768px) {
            body {
                padding: 15px;
                padding-top: 70px;
            }

            .btn-volver img {
                width: 45px;
                height: 45px;
            }

            h1 {
                font-size: 24px;
                margin-bottom: 25px;
            }

            th, td {
                padding: 10px 12px;
                font-size: 13px;
            }

            .respuesta-cell {
                max-width: 200px;
            }

            .btn-inicio {
                padding: 6px 10px;
                font-size: 11px;
            }
        }

        /* Responsive para móviles */
        @media (max-width: 480px) {
            body {
                padding: 10px;
                padding-top: 65px;
            }

            .btn-volver {
                top: 15px;
                left: 15px;
            }

            .btn-volver img {
                width: 40px;
                height: 40px;
            }

            h1 {
                font-size: 20px;
                margin-bottom: 20px;
            }

            .table-container {
                overflow-x: auto;
            }

            table {
                border-radius: 10px;
                font-size: 12px;
            }

            th {
                padding: 10px 8px;
                font-size: 12px;
            }

            td {
                padding: 8px;
                font-size: 12px;
            }

            .respuesta-cell {
                max-width: 150px;
            }

            .resumen {
                display: block;
                margin-bottom: 5px;
            }

            .ver-mas {
                font-size: 11px;
                display: block;
                margin-left: 0;
                margin-top: 3px;
            }

            .btn-inicio {
                padding: 5px 8px;
                font-size: 10px;
            }

            tbody tr:hover {
                background-color: #fff;
            }
        }

        /* Sin elementos flotantes innecesarios */
        a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body>
    <!-- Botón flecha arriba a la izquierda contra la pared -->
    <a href="chat.php" class="btn-volver">
        <img src="../otros/flecha.png" alt="volver a inicio">
    </a>

    <!-- Título centrado -->
    <h1>Modificar respuestas</h1>

    <!-- Tabla responsiva -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Pregunta</th>
                    <th>Respuesta</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($fila["titulo"]) . "</td>";
                        $respuestaCompleta = ($fila["respuesta"]);
                        $resumen = mb_strimwidth($fila["respuesta"], 0, 80, "...");
                        echo "<td class='respuesta-cell'>
                                <span class='resumen'>$resumen</span>
                                <span class='completa' style='display:none;'>$respuestaCompleta</span>
                                <button class='ver-mas'>Ver más</button>
                            </td>";
                        echo "<td>
                            <a href='modificar.php?id_consulta=" . htmlspecialchars($fila["id_consulta"]) . "'>
                                <button type='button' class='btn-inicio'>Modificar</button>
                            </a>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' style='text-align:center;'>No hay preguntas.</td></tr>";
                }
                $connPHP->close();
                ?>
            </tbody>
        </table>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const botones = document.querySelectorAll('.ver-mas');//selecciona todos los elementos con ver mas
        botones.forEach(boton => { //recorre cada botón encontrado
            boton.addEventListener('click', function(e) {  //al clickear se hace una funcion
                e.preventDefault();//evita la recarga de la pagina
                // Busca el elemento padre más cercano con la clase "respuesta-cell"
                // Esto sirve para trabajar dentro del bloque correspondiente
                const celda = this.closest('.respuesta-cell');

                // Dentro de esa celda, selecciona los elementos con las clases "resumen" y "completa"
                const resumen = celda.querySelector('.resumen');
                const completa = celda.querySelector('.completa');

                //si el texto completo está oculto, lo muestra
                if (completa.style.display === 'none') {
                    //muestra el texto completo
                    completa.style.display = 'inline';
                    //oculta el resumen
                    resumen.style.display = 'none';
                    //cambia el texto del botón
                    this.textContent = 'Ver menos';
                } else {
                    //si el texto completo está visible, lo oculta
                    completa.style.display = 'none';
                    //muestra nuevamente el resumen
                    resumen.style.display = 'inline';
                    //cambia el texto del botón
                    this.textContent = 'Ver más';
                }
            });
        });
    });
</script>

</body>
</html>