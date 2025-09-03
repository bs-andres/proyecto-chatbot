<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leandal - Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="css/diseños.css">
</head>
<body>
    <!--  Encabezado fijo con logo y botón de menú -->
    <div class="container-fluid d-flex align-items-center">
        <a class="navbar-brand" href="" data-bs-toggle="offcanvas" data-bs-target="#menu">
            <span style="font-size: 35px;  position: fixed; top:30px;">☰</span>
        </a>
        <a href="info.html">
            <img src="../otros/logo_transparente.png" alt="logo" style="width:110px; margin-left:50px;">
        </a>
        <div style="margin-left:auto;">
            <?php if (isset($_SESSION['usuario'])): ?><!--  si inicio sesion -->
                <a href="logout.php" class="btn-cerrar">Cerrar Sesión</a>
            <?php else: ?>
                <a href="login.php" class="btn-inicio">Iniciar Sesión</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Menú lateral -->
    <div class="offcanvas offcanvas-start" id="menu" style="--bs-offcanvas-width: 250px;">
        <div class="offcanvas-header">
            <h1 class="offcanvas-title">Menú</h1>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <?php if (isset($_SESSION['usuario'])): ?><!--  si inicio sesion -->
                <span style="color:black; margin-right:10px;">Bienvenido <?php echo $_SESSION['usuario']; ?></span><!--  muestra el nombre -->
            <?php endif; ?>
            <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario'] === 'admin'): ?><!--  si es el admin tiene botones especiales -->
                <a href="preguntas.php" style="width: 165px;" class="btn btn-normal mb-2">preguntas sin responder</a><br>
                <a href="todas_preguntas.php" style="width: 165px;" class="btn btn-normal mb-2">todas las preguntas</a><br>
            <?php endif; ?>
            
            <a href="preg_frec.php" style="width: 165px;" class="btn btn-normal mb-2">preguntas frecuentes</a><br>
            <a class="btn btn-normal mb-2" style="width: 165px;" data-bs-toggle="collapse" href="#vermapas" role="button" aria-expanded="false" aria-controls="vermapas">
                Mapa de la Escuela
            </a>
            <div class="collapse mt-2" id="vermapas">
                <div class="d-grid gap-2">
                    <a href="https://drive.google.com/file/d/1sg12kHxCaNakFrK5yB79Yo7mjP-HCgqG/view?usp=sharing" class="btn btn-mapa">Mapa Planta Baja</a>
                    <a href="https://drive.google.com/file/d/1zwvS-26GWQ0ztwFUbnb7r8eKDUA9zmLg/view?usp=sharing" class="btn btn-mapa">Mapa 1° Piso</a>
                    <a href="https://drive.google.com/file/d/1IZE3ustPUGgZFRSkuv-185QyPJYVUd3I/view?usp=sharing" class="btn btn-mapa">Mapa 2° Piso</a>
                </div>
            </div>
        </div>
    </div>

    <h3 style="color:white; text-align:center;">Leandal</h3>
    <div class="chat-container">
        <div class="chat-log" id="chat-log"></div><!--  el chat -->

        <form id="formulario" class="d-flex justify-content-end mt-3"><!--  barra donde se pregunta -->
            <input type="text" id="pregunta" class="input-barra-derecha" placeholder="Escribí tu pregunta..." autocomplete="off">
        </form>
    </div>
    <script src="js/java.js"></script>
</body>
</html>