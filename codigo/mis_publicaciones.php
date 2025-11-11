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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mis Publicaciones</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
* {
    box-sizing: border-box;
}

body {
    background: radial-gradient(ellipse at center, #212fe8, #41ab92);
    color: white;
    font-family: Arial, sans-serif;
    min-height: 100vh;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px 15px;
}

.header-section {
    display: flex;
    align-items: center;
    margin-bottom: 25px;
    gap: 15px;
}

.back-button {
    flex-shrink: 0;
}

.back-button img {
    width: 50px;
    height: auto;
    transition: transform 0.2s;
}

.back-button img:hover {
    transform: scale(1.1);
}

h3 {
    flex-grow: 1;
    text-align: center;
    margin: 0;
    font-size: 1.5rem;
}

.mensaje-container {
    display: flex;
    flex-direction: column;
    margin-bottom: 15px;
}

.burbuja {
    padding: 12px 16px;
    border-radius: 18px;
    max-width: 85%;
    word-wrap: break-word;
    word-break: break-word;
    box-shadow: 0 2px 5px rgba(0,0,0,0.15);
    animation: fadeIn 0.3s ease-in;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.user {
    background-color: #d1e7dd;
    align-self: flex-end;
    text-align: right;
    color: #000;
    border-bottom-right-radius: 4px;
}

.IA {
    background-color: #e2e3e5;
    align-self: flex-start;
    text-align: left;
    color: #000;
    border-bottom-left-radius: 4px;
}

.nombre {
    font-weight: bold;
    font-size: 0.9rem;
    margin-bottom: 5px;
    color: #2c5f2d;
}

.user .nombre {
    color: #2c5f2d;
}

.IA .nombre {
    color: #495057;
}

.contenido {
    line-height: 1.4;
    font-size: 0.95rem;
}

.fecha {
    font-size: 0.75rem;
    color: #666;
    margin-top: 6px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.no-publicaciones {
    text-align: center;
    margin-top: 50px;
    font-size: 1.1rem;
    opacity: 0.9;
}

/* Responsive para tablets */
@media (max-width: 768px) {
    .container {
        padding: 15px 12px;
    }
    
    h3 {
        font-size: 1.3rem;
    }
    
    .burbuja {
        max-width: 90%;
        padding: 10px 14px;
    }
    
    .back-button img {
        width: 45px;
    }
}

/* Responsive para móviles */
@media (max-width: 576px) {
    .container {
        padding: 10px 10px;
    }
    
    .header-section {
        gap: 10px;
        margin-bottom: 20px;
    }
    
    h3 {
        font-size: 1.2rem;
    }
    
    .back-button img {
        width: 40px;
    }
    
    .burbuja {
        max-width: 95%;
        padding: 10px 12px;
        font-size: 0.9rem;
    }
    
    .nombre {
        font-size: 0.85rem;
    }
    
    .contenido {
        font-size: 0.9rem;
    }
    
    .fecha {
        font-size: 0.7rem;
        flex-wrap: wrap;
    }
    
    .mensaje-container {
        margin-bottom: 12px;
    }
}

/* Responsive para móviles muy pequeños */
@media (max-width: 375px) {
    h3 {
        font-size: 1.1rem;
    }
    
    .back-button img {
        width: 35px;
    }
    
    .burbuja {
        padding: 8px 10px;
        font-size: 0.85rem;
    }
}
</style>
</head>
<body>
<div class="container">
    <div class="header-section">
        <a href="chat_comunidad.php" class="back-button">
            <img src="../otros/flecha.png" alt="Volver">
        </a>
        <h3>Mis publicaciones</h3>
    </div>
    
    <?php if ($result->num_rows > 0): ?>
        <?php while ($fila = $result->fetch_assoc()): ?>
            <?php 
            $es_mio = ($fila['id_usuario'] == $id_usuario);
            $clase = $es_mio ? 'burbuja user' : 'burbuja IA';
            ?>
            <div class="mensaje-container">
                <div class="<?php echo $clase; ?>">
                    <div class="nombre"><?php echo htmlspecialchars($fila['nombre']); ?></div>
                    <div class="contenido"><?php echo nl2br(htmlspecialchars($fila['contenido'])); ?></div>
                    <div class="fecha">
                        <span><?php echo date("d/m/Y H:i", strtotime($fila['fecha'])); ?></span>
                        <span>👍 <?php echo $fila['likes']; ?></span>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="no-publicaciones">No has publicado nada aún.</p>
    <?php endif; ?>
</div>
</body>
</html>
<?php
$stmt->close();
$connPHP->close();
?>