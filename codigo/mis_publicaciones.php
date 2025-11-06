<?php
include("conexion.php");
session_start();

$id_usuario = $_SESSION['id_usuario'];

//selecciona las publicaciones del usuario
$stmt = $connPHP->prepare("
    SELECT p.id_publicacion, u.nombre, p.contenido, p.likes, p.fecha, p.id_usuario
    FROM publicaciones p
    JOIN usuarios u ON p.id_usuario = u.id_usuario
    WHERE p.id_usuario = ?
    ORDER BY p.fecha ASC
");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Mis Publicaciones</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background: radial-gradient(ellipse, #212fe8, #41ab92);
    color: white;
    font-family: Arial, sans-serif;
    min-height: 100vh;
}
.container {
    max-width: 900px;
    margin-top: 30px;
}
.burbuja {
    margin: 10px 0;
    padding: 10px 15px;
    border-radius: 15px;
    max-width: 60%;
    word-wrap: break-word;
    box-shadow: 0 1px 3px rgba(0,0,0,0.2);
}
.user {
    background-color: #d1e7dd;
    align-self: flex-end;
    text-align: right;
    margin-left: auto;
    color: #000;
}
.IA {
    background-color: #e2e3e5;
    align-self: flex-start;
    text-align: left;
    color: #000;
}
.nombre {
    font-weight: bold;
    font-size: 0.85rem;
    margin-bottom: 3px;
}
.fecha {
    font-size: 0.75rem;
    color: #555;
    margin-top: 5px;
}
</style>
</head>
<body>

<div class="container">
    <a href="chat_comunidad.php">
        <img src="../otros/flecha.png" alt="logo" style="width:60px;">
    </a>
        <h3 style="text-align:center; margin-bottom: 25px;">Mis publicaciones</h3>
    <?php if ($result->num_rows > 0): ?>
        <?php while ($fila = $result->fetch_assoc()): ?>
            <?php 
            // todas son del usuario, pero mantenemos la estructura por coherencia
            $es_mio = ($fila['id_usuario'] == $id_usuario);
            $clase = $es_mio ? 'burbuja user' : 'burbuja IA';
            ?>
            <div class="mensaje-container d-flex flex-column <?php echo $es_mio ? 'align-items-end' : 'align-items-start'; ?>">
                <div class="<?php echo $clase; ?>">
                    <div class="nombre"><?php echo htmlspecialchars($fila['nombre']); ?></div>
                    <div><?php echo nl2br(htmlspecialchars($fila['contenido'])); ?></div>
                    <div class="fecha">
                        <?php echo date("d/m/Y", strtotime($fila['fecha'])); ?> — 👍 <?php echo $fila['likes']; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No has publicado nada aún.</p>
    <?php endif; ?>
</div>

</body>
</html>

<?php
$stmt->close();
$connPHP->close();
?>