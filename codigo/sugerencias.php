<?php
include("conexion.php");
//obtiene la variable que escribe el usuario
if (isset($_GET['term'])) {
    $busqueda = "%" . $_GET['term'] . "%";//busca algo parecido a lo obtenido
    $stmt = $connPHP->prepare("SELECT pregunta FROM consultas WHERE pregunta LIKE ? AND preg_contestada = true LIMIT 5");//selecciona las preguntas hasta 5
    $stmt->bind_param("s", $busqueda);//parametros
    $stmt->execute();
    $resultado = $stmt->get_result();

    $sugerencias = [];
    while ($fila = $resultado->fetch_assoc()) {
        $sugerencias[] = $fila['pregunta'];//array 
    }

    echo json_encode($sugerencias);//muestra las sugerencias

    $stmt->close();
    $connPHP->close();
}
?>