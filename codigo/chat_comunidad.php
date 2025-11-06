<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Chat Comunidad</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="css/diseño.css">
<style>
    /* Estilos base */
    .header-container {
        padding: 10px 15px;
        margin-bottom: 20px;
    }
    
    .logo-back {
        width: 70px;
        height: auto;
        transition: width 0.3s ease;
    }
    
    .logo-main {
        width: 150px;
        height: auto;
        margin-left: 10px;
        transition: width 0.3s ease;
    }
    
    .btn-header {
        background-color: #8c52ff !important;
        color: white !important;
        border: none;
        padding: 6px 10px;
        font-size: 15px;
        border-radius: 8px;
        cursor: pointer;
        opacity: 1 !important;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        transition: background 0.3s ease, transform 0.2s ease;
        text-decoration: none;
        display: inline-block;
        white-space: nowrap;
        margin-left: 5px;
        min-height: 38px;
    }
    
    .btn-header:hover {
        background-color: #6e3fcf !important;
        transform: translateY(-2px);
    }
    
    .header-buttons {
        display: flex;
        align-items: center;
        gap: 5px;
        flex-wrap: nowrap;
    }
    
    .chat-title {
        color: white;
        text-align: center;
        font-size: 1.5rem;
        margin-bottom: 20px;
        transition: font-size 0.3s ease;
    }
    
    .chat-container {
        max-width: 900px;
        margin: auto;
        padding: 0 15px;
    }
    
    .chat-log {
        margin-bottom: 60px;
        padding-bottom: 30px;
    }
    
    .input-barra-derecha {
        transition: font-size 0.3s ease;
    }
    
    .btn-scroll {
        transition: all 0.3s ease;
    }
    
    /* Tablets y móviles grandes (menos de 768px) */
    @media (max-width: 767px) {
        .logo-back { width: 50px; }
        .logo-main { width: 100px; }
        .chat-title { font-size: 1.2rem; }
        .btn-header { 
            font-size: 13px; 
            padding: 5px 7px;
            min-height: 36px;
            white-space: nowrap;
        }
    }
    
    /* Móviles (menos de 576px) */
    @media (max-width: 575px) {
        .header-container { padding: 8px 10px; }
        .logo-back { width: 40px; }
        .logo-main { width: 80px; margin-left: 5px; }
        .btn-header { 
            font-size: 12px; 
            padding: 4px 6px;
            min-height: 34px;
            white-space: nowrap;
        }
        .chat-title { font-size: 1.1rem; }
        .header-buttons { 
            gap: 3px;
        }
        .input-barra-derecha {
            font-size: 15px;
            padding: 8px;
        }
        /* Botones de scroll más pequeños */
        .btn-scroll {
            padding: 6px 10px !important;
            font-size: 14px !important;
        }
        .btn-scroll img {
            height: 12px !important;
            width: 12px !important;
        }
        /* Mayor separación en móviles */
        .chat-log {
            margin-bottom: 70px;
            padding-bottom: 35px;
        }
    }
    
    /* Móviles pequeños (menos de 400px) */
    @media (max-width: 399px) {
        .logo-back { width: 35px; }
        .logo-main { width: 70px; margin-left: 5px; }
        .btn-header { 
            font-size: 11px; 
            padding: 4px 5px;
            min-height: 32px;
            white-space: nowrap;
        }
        .chat-title { font-size: 1rem; }
        .input-barra-derecha {
            font-size: 14px;
            padding: 6px;
        }
        .header-buttons {
            gap: 2px;
        }
    }
    
    /* Móviles muy pequeños (menos de 350px) */
    @media (max-width: 349px) {
        .logo-back { width: 30px; }
        .logo-main { width: 60px; }
        .btn-header { 
            font-size: 10px; 
            padding: 3px 4px; 
            margin-left: 0px;
            min-height: 30px;
            white-space: nowrap;
        }
        .chat-title { font-size: 0.95rem; }
        .input-barra-derecha {
            font-size: 13px;
            padding: 5px;
        }
        /* Reducir espaciado del formulario */
        #formulario {
            gap: 3px;
        }
        .header-buttons {
            gap: 2px;
        }
    }
    
    /* Mejora de accesibilidad táctil */
    @media (hover: none) and (pointer: coarse) {
        .btn-header,
        button[type="submit"],
        button[type="button"] {
            min-height: 44px;
            min-width: 44px;
        }
    }
</style>
</head>
<body>

<div class="container-fluid header-container d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center">
        <a href="chat.php">
            <img src="../otros/flecha.png" alt="Volver" class="logo-back">
        </a>
        <a href="info.html">
            <img src="../otros/leandal.png" alt="Logo" class="logo-main">
        </a>
    </div>
    <div class="ms-auto header-buttons">
        <button id="btn-ordenar-likes" class="btn btn-header" data-orden="fecha">Ordenar 👍</button>
        <a href="mis_publicaciones.php" class="btn btn-header">Mis publicaciones</a>
    </div>
</div>

<h3 class="chat-title">Rincón de sugerencias</h3>

<div class="chat-container">
    <!-- Publicaciones -->
    <div id="publicaciones" class="chat-log"><?php include("chat_comunidad_ajax.php"); ?></div>

    <!-- Formulario para publicar -->
    <form id="formulario" class="d-flex justify-content-end mt-3">
        <button id="btn-abajo" type="button" class="btn btn-scroll" onclick="scrollToBottom()" 
            style="display:none; background-color: rgb(64, 224, 208); border-radius:30px; font-size:15px; margin-right:5px;">
            <img src="../otros/bajar.png" alt="Bajar" style="height:14px; width:14px;">
        </button>

        <button id="btn-arriba" type="button" class="btn btn-scroll" onclick="scrollToTop()" 
            style="display:none; background-color: rgb(64, 224, 208); border-radius:30px; font-size:15px; margin-right:5px;">
            <img src="../otros/subir.png" alt="Subir" style="height:14px; width:14px;">
        </button>
        
        <input type="text" id="mensaje" class="input-barra-derecha" name="mensaje" placeholder="¿Alguna opinión sobre la escuela?" autocomplete="off">
        
        <button class="btn" type="submit" style="background-color: rgb(64, 224, 208); border-radius:15px; min-height: 44px; min-width: 44px;">
            <img src="../otros/mandar.png" alt="Enviar" style="height:24px; width:24px;">
        </button>
    </form>
</div>

<script>
document.getElementById("btn-ordenar-likes").addEventListener("click", function(e) {
    //evita que el botón recargue la página
    e.preventDefault();

    // Referencia al botón que se presionó
    const btn = e.currentTarget;
    const contenedor = document.getElementById("publicaciones");//se actualiza el contenedor de publicaciones

    //obtiene la data del botn ordenar, default fecha
    let ordenActual = btn.getAttribute("data-orden") || "fecha";

    // Alterna entre "fecha" y "likes"
    let nuevoOrden = ordenActual === "fecha" ? "likes" : "fecha";

    //llama al archivo PHP con el nuevo orden
    fetch('chat_comunidad_ajax.php?orden=' + nuevoOrden)
        .then(response => response.text()) //convierte la respuesta en texto (HTML)
        .then(html => {
            // Reemplaza el contenido del contenedor con el HTML recibido
            contenedor.innerHTML = html;

            //actualiza el data-orden del botón
            btn.setAttribute("data-orden", nuevoOrden);

            //segun el orden cambia
            if (nuevoOrden === "likes") {
                btn.textContent = "Ordenar 🕒";
            } else {
                btn.textContent = "Ordenar 👍";
            }
        })
        .catch(error => {
            //error
            console.error('Error:', error);
        });
});
</script>

<script src="js/comunidad.js"></script>
</body>
</html>