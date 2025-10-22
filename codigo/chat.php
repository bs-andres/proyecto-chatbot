<?php
session_start();

if (!empty($_GET['titulo'])) { //si llego el get
    $pregunta = $_GET['titulo']; //lo agrega pone en el input
} else {
    $pregunta = ''; //si no, queda vacío
}
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
    <link rel="stylesheet" href="css/diseño.css">
</head>

<style>
  .bienvenido {
    display: block;        /* Hace que cada línea esté en bloque */
    font-size: 24px;       /* Tamaño más grande para "Bienvenido" */
    color: white;
    font-weight: normal;   /* No tan pesado para "Bienvenido" */
  }
  .usuario {
    display: block;        /* Nombre en su propia línea */
    font-size: 28px;       /* Más grande que "Bienvenido" */
    color: white;
    font-weight: bold;     /* Nombre en negrita */
  }
</style>

<body>
    <!--  Encabezado fijo con logo y botón de menú -->
    <div class="container-fluid d-flex align-items-center">
        <a class="navbar-brand" href="#" data-bs-toggle="offcanvas" data-bs-target="#menu">
            <span style="font-size: 35px; position: sticky; top:30px;">☰</span>
        </a>
        <a href="info.html">
            <img src="../otros/leandal.png" alt="logo" style="width:110px; margin-left:10px;">
        </a>

        <div style="margin-left:auto;">
            <?php if (isset($_SESSION['usuario'])): ?><!--  si inició sesión -->
                <a href="logout.php" class="btn-cerrar">Cerrar Sesión</a>
            <?php else: ?>
                <a href="login.php" class="btn-inicio">Iniciar Sesión</a>
            <?php endif; ?>
            <a href="refrescar.php" class="btn" title="Refrescar chat" style="background-color: rgb(64, 224, 208); border-radius:15px; font-size: 20px;">
                <img src="../otros/refrescar.png" style="height:24px;width: 24px;">
            </a>
        </div>
    </div>

    <!-- menú -->
    <div class="offcanvas offcanvas-start" id="menu" style="--bs-offcanvas-width: 250px;">
        <div class="offcanvas-body">
            <?php if (isset($_SESSION['usuario'])): ?>
                <div class="offcanvas-header">
                    <span>
                        <span class="bienvenido">Bienvenido</span>
                        <span class="usuario"><?php echo ($_SESSION['usuario']); ?></span>
                    </span>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>

                <?php if ($_SESSION['usuario'] === 'admin'): ?>
                    <a href="preg_frec.php" style="width: 165px;" class="btn btn-normal mb-2">preguntas frecuentes</a><br>
                    <a href="preguntas.php" style="width: 165px;" class="btn btn-normal mb-2">Preguntas sin responder</a><br>
                    <a href="todas_preguntas.php" style="width: 165px;" class="btn btn-normal mb-2">Todas las preguntas</a><br>
                <?php else: ?>
                    <a href="preg_frec.php" style="width: 165px;" class="btn btn-normal mb-2">preguntas frecuentes</a><br>
                    <a class="btn btn-normal mb-2" style="width: 165px;" data-bs-toggle="collapse" href="#vermapas" role="button" aria-expanded="false" aria-controls="vermapas">
                        Mapa de la Escuela
                    </a>
                     <div class="collapse mt-2" id="vermapas">
                        <div class="d-grid gap-2">
                            <a href="https://drive.google.com/file/d/1sg12kHxCaNakFrK5yB79Yo7mjP-HCgqG/view?usp=sharing" class="btn btn-mapa" target="_blank" rel="noopener noreferrer">Mapa Planta Baja</a>
                            <a href="https://drive.google.com/file/d/1zwvS-26GWQ0ztwFUbnb7r8eKDUA9zmLg/view?usp=sharing" class="btn btn-mapa" target="_blank" rel="noopener noreferrer">Mapa 1° Piso</a>
                            <a href="https://drive.google.com/file/d/1IZE3ustPUGgZFRSkuv-185QyPJYVUd3I/view?usp=sharing" class="btn btn-mapa" target="_blank" rel="noopener noreferrer">Mapa 2° Piso</a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <script>
                    //mensaje de bienvenida
                    document.addEventListener("DOMContentLoaded", function() {
                            const chatLog = document.getElementById("chat-log");
                            const burbujaIA = document.createElement("div");
                            burbujaIA.className = "burbuja IA";
                            burbujaIA.innerHTML = "¡Bienvenido a leandal!, presiona 1 para ver el menu";
                            chatLog.appendChild(burbujaIA);
                        });
                </script>
                <div class="offcanvas-header">
                    <h1 class="offcanvas-title">Menú</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>
                <a href="preg_frec.php" style="width: 165px;" class="btn btn-normal mb-2">preguntas frecuentes</a><br>
                <a class="btn btn-normal mb-2" style="width: 165px;" data-bs-toggle="collapse" href="#vermapas" role="button" aria-expanded="false" aria-controls="vermapas">
                    Mapa de la Escuela
                </a>
                 <div class="collapse mt-2" id="vermapas">
                        <div class="d-grid gap-2">
                            <a href="https://drive.google.com/file/d/1sg12kHxCaNakFrK5yB79Yo7mjP-HCgqG/view?usp=sharing" class="btn btn-mapa" target="_blank" rel="noopener noreferrer">Mapa Planta Baja</a>
                            <a href="https://drive.google.com/file/d/1zwvS-26GWQ0ztwFUbnb7r8eKDUA9zmLg/view?usp=sharing" class="btn btn-mapa" target="_blank" rel="noopener noreferrer">Mapa 1° Piso</a>
                            <a href="https://drive.google.com/file/d/1IZE3ustPUGgZFRSkuv-185QyPJYVUd3I/view?usp=sharing" class="btn btn-mapa" target="_blank" rel="noopener noreferrer">Mapa 2° Piso</a>
                        </div>
                    </div>
            <?php endif; ?>
        </div>
    </div>

    <h3 style="color:white; text-align:center;">Leandal</h3>

    <div class="chat-container">
        <div class="chat-log" id="chat-log"></div><!--  el chat -->

        <form id="formulario" class="d-flex justify-content-end mt-3" action="guardar_mensaje.php" method="POST">
            <!-- Botones de scroll -->
            <button id="btn-abajo" class="btn" onclick="scrollToBottom()" style="display:none; background-color: rgb(64, 224, 208); border-radius:30px; font-size: 15px;">
                <img src="../otros/bajar.png" style="height:14px; width:14px;">
            </button>
            <button type="button" id="btn-arriba" onclick="scrollToTop()" class="btn" style="display:none; background-color: rgb(64, 224, 208); border-radius:30px; font-size: 15px;">
                <img src="../otros/subir.png" style="height:14px; width:14px;">
            </button>

            <!-- Barra de entrada -->
            <input type="text" id="pregunta" class="input-barra-derecha" name="mensaje" placeholder="¿que quieres saber?" value="<?php echo $pregunta; ?>">
            <button type="submit" class="btn" style="background-color: rgb(64, 224, 208); border-radius:15px; font-size: 20px;">
                <img src="../otros/mandar.png" style="height:24px; width:24px;">
            </button>
        </form>
    </div>

    <script>
        window.onscroll = function() {
            const btnArriba = document.getElementById("btn-arriba");
            const btnAbajo = document.getElementById("btn-abajo");
            const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
            const scrollHeight = document.documentElement.scrollHeight || document.body.scrollHeight;
            const windowHeight = window.innerHeight;

            if (scrollTop > 20) {
                btnArriba.style.display = "block"; //lo muestra
            } else {
                btnArriba.style.display = "none"; //no lo muestra
            }


            if (scrollTop + windowHeight < scrollHeight - 15) {
                btnAbajo.style.display = "block"; //lo muestra
            } else {
                btnAbajo.style.display = "none";  //no lo muestra
            }
        };

        // Funciones de desplazamiento
        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function scrollToBottom() {
            window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
        }
    </script>
    <script src="js/java.js"></script>
</body>
</html>