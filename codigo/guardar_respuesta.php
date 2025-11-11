<?php
include("conexion.php");

$id_consulta = $_POST['id_consulta'];//recibe los datos
$pregunta    = trim($_POST['pregunta']);
$titulo      = trim($_POST['titulo']);
$respuesta   = trim($_POST['respuesta']);

//validaciones básicas
if ($id_consulta > 0 && !empty($respuesta) && !empty($titulo) && !empty($pregunta)) {

    /*verifica si la pregunta ya existe*/
    $stmtCheck = $connPHP->prepare("SELECT id_consulta FROM consultas WHERE pregunta = ? AND id_consulta != ? LIMIT 1");
    $stmtCheck->bind_param("si", $pregunta, $id_consulta);
    $stmtCheck->execute();
    $stmtCheck->store_result();

    if ($stmtCheck->num_rows > 0) {//si existe
        $stmtCheck->close();
        $connPHP->close();

        //redirige a responder.php preservando datos
        ?>
        <form id="redir" action="responder.php" method="POST">
            <input type="hidden" name="id_consulta" value="<?= htmlspecialchars($id_consulta) ?>">
            <input type="hidden" name="pregunta" value="<?= htmlspecialchars($pregunta) ?>">
            <input type="hidden" name="titulo" value="<?= htmlspecialchars($titulo) ?>">
            <input type="hidden" name="respuesta" value="<?= htmlspecialchars($respuesta) ?>">
            <input type="hidden" name="error" value="La pregunta ya existe">
        </form>
        <script>
            document.getElementById('redir').submit();
        </script>
        <?php
        exit;
    }

    $stmtCheck->close();

    //actualiza los bd
    $stmt = $connPHP->prepare("UPDATE consultas SET pregunta = ?, titulo = ?, respuesta = ?, preg_contestada = TRUE WHERE id_consulta = ?");
    $stmt->bind_param("sssi", $pregunta, $titulo, $respuesta, $id_consulta);
    if ($stmt->execute()) {
        echo "<script>window.location.href='todas_preguntas.php';</script>";//redirige para agregarla al catalogo
    } else {
        echo "❌ Error al guardar la respuesta.";
    }

    $stmt->close();

} else {
    echo "❌ Datos incompletos.";
}

$connPHP->close();
?>