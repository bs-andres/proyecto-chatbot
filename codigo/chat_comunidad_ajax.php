<?php
include("conexion.php");
session_start();

$id_usuario = $_SESSION['id_usuario'];

//lista de palabras inapropiadas
$prohibidas = ["boludo", "pelotudo", "tarado", "idiota", "estúpido", "inútil", "imbécil", "forro", "salame", "gil", "boluda", "pelotuda", "tonto", "bobo", "nabo", "ganso", "cagón", "sorete", "choto", "puto", "puta", "mierda", "carajo", "la concha", "hijo de", "cornudo", "maricón", "pajero", "mogólico", "retardado", "negro", "grasa", "chupamedias", "chupapija", "orto", "culo", "garca", "trucho", "trolo", "pete", "jodete", "callate", "andate", "cagaste", "cagada", "rompé", "rompete", "rompiste", "rompepelotas", "rompehuevos", "hinchapelotas", "hincha", "pesado", "chanta", "ladrón", "ratero", "maldito", "desgraciado", "infeliz", "bastardo", "malnacido", "zorra", "zorrita", "idiota", "ridículo", "ridícula", "basura", "escoria", "pelmazo", "sopenco", "gilastrun", "imbécil", "trola", "guacho", "pendejo", "atrevido", "insolente", "agrandado", "cabeza", "wachiturro"];

//censuara con ****
function censurarTexto($texto, $prohibidas) {
    foreach ($prohibidas as $palabra) {
        $malapalabra = '/' . preg_quote($palabra, '/') . '/i';//sacamos caracteres especiales
        $texto = preg_replace_callback($malapalabra, function($coincidencia) use ($palabra) {
            return str_repeat('*', strlen($coincidencia[0]));
        }, $texto);
    }
    return $texto;
}

// ------------------ Guardar nuevo mensaje ------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mensaje'])) {
    $mensaje = trim($_POST['mensaje']);//lega mensaje

    if (!empty($mensaje)) {

        // ✅ Censurar antes de guardar
        $mensaje = censurarTexto($mensaje, $prohibidas);

        $stmt = $connPHP->prepare("INSERT INTO publicaciones (id_usuario, contenido, likes) VALUES (?, ?, 0)");
        $stmt->bind_param("is", $id_usuario, $mensaje);
        $stmt->execute();
        $stmt->close();
    }
    exit;
}

// ------------------ Dar like (solo uno por usuario) ------------------
if (isset($_POST['like'])) {
    $id_pub = intval($_POST['like']);

    //verifica si el usuario ya dio like
    $stmt = $connPHP->prepare("SELECT id_like FROM likes WHERE id_usuario = ? AND id_publicacion = ?");
    $stmt->bind_param("ii", $id_usuario, $id_pub);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {//si no devuelve nada
        $stmt->close();

        $stmt = $connPHP->prepare("INSERT INTO likes (id_usuario, id_publicacion) VALUES (?, ?)");//lo inserta
        $stmt->bind_param("ii", $id_usuario, $id_pub);
        $stmt->execute();
        $stmt->close();

        $stmt = $connPHP->prepare("UPDATE publicaciones SET likes = likes + 1 WHERE id_publicacion = ?");//lo actualiza
        $stmt->bind_param("i", $id_pub);
        $stmt->execute();
        $stmt->close();
    }
    exit;
}


// ------------------ Mostrar publicaciones ------------------

if (isset($_GET['orden']) && $_GET['orden'] === 'likes') {//estado del ordenador
    $orden = 'likes';
} else {
    $orden = 'fecha';
}
//asigna orden
if ($orden === 'likes') {
    $sql = "
        SELECT p.id_publicacion, u.nombre, p.contenido, p.likes, p.fecha, p.id_usuario
        FROM publicaciones p
        JOIN usuarios u ON p.id_usuario = u.id_usuario
        WHERE p.fecha >= DATE_SUB(NOW(), INTERVAL 1 MONTH)
        ORDER BY p.likes DESC
    ";
} else {
    $sql = "
        SELECT p.id_publicacion, u.nombre, p.contenido, p.likes, p.fecha, p.id_usuario
        FROM publicaciones p
        JOIN usuarios u ON p.id_usuario = u.id_usuario
        WHERE p.fecha >= DATE_SUB(NOW(), INTERVAL 1 MONTH)
        ORDER BY p.fecha ASC
    ";
}

$stmt = $connPHP->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<style>
/* Contenedor del mensaje */
.mensaje-container {
    display: flex;
    flex-direction: column;
}
.nombre {
    font-weight: bold;
    font-size: 0.9rem;
    color: #1a1a1a;
    margin-bottom: 3px;
}
.fecha {
    font-size: 0.75rem;
    color: #777;
    margin-top: 5px;
}
.textarea-editar {
    background-color: #d1e7dd;
}

</style>

<?php
while ($fila = $result->fetch_assoc()):
    $usuario = ($fila['id_usuario'] == $id_usuario);
    $es_admin = ($_SESSION['usuario'] === 'admin');//si el usuario es admin
    if ($usuario) {//define la borbuja del usuario
        $clase = 'burbuja user';
    } else {
        $clase = 'burbuja IA';
    }

?>
<div class="mensaje-container d-flex flex-column <?php echo $usuario ? 'align-items-end' : 'align-items-start'; ?>">
    <div class="<?php echo $clase; ?>">
        <div class="nombre">
            <?php if ($usuario || $es_admin): ?>
                <button class="btn btn-sm ms-2 btn-borrar" data-id="<?php echo $fila['id_publicacion']; ?>" title="Borrar mensaje">❌</button>
            <?php endif; ?>
            
            <?php if ($usuario): ?>
                <button class="btn btn-sm ms-2 btn-editar"
                    data-id="<?php echo $fila['id_publicacion']; ?>"
                    data-contenido="<?php echo htmlspecialchars($fila['contenido'], ENT_QUOTES); ?>">✏️</button>
            <?php endif; ?>

            <?php echo ($fila['nombre']); ?>
        </div>

        <div class="contenidoTexto"><?php echo nl2br(($fila['contenido'])); ?></div>
        <div class="fecha">
            <?php echo date("d/m/Y", strtotime($fila['fecha'])); ?>
            <button class="btn btn-sm btn-like ms-2" title="dar me gusta" data-id="<?php echo $fila['id_publicacion']; ?>">
                👍 <?php echo $fila['likes']; ?>
            </button>
        </div>
    </div>
</div>
<?php endwhile; ?>
<?php
$stmt->close();
$connPHP->close();
?>


<script>
document.querySelectorAll(".btn-editar").forEach(btn => {
    btn.addEventListener("click", () => {//creamos un evento al hacer click

        const id = btn.dataset.id;//data-id guarda el id de la publicacion
        const burbuja = btn.closest(".burbuja");
        const textoDiv = burbuja.querySelector(".contenidoTexto");//agarramos el texto original
        const textoOriginal = textoDiv.innerText;//lo mostramos en un textarea
        //al editar se borra el boton de borrar publicacion
        const btnBorrar = burbuja.querySelector(".btn-borrar");
        if (btnBorrar) btnBorrar.style.display = "none";

        //se crea el textarea
        const textarea = document.createElement("textarea");
        textarea.className = "form-control textarea-editar";//con color de la burbuja
        textarea.value = textoOriginal;//mostramos el texto original

        //reemplaza el contenido por textarea
        textoDiv.replaceWith(textarea);

        //confirmar cambio
        const btnGuardar = document.createElement("button");
        btnGuardar.textContent = "✅";
        btnGuardar.className = "btn btn-sm ms-2";
        //descartar cambio
        const btnCancelar = document.createElement("button");
        btnCancelar.textContent = "❌";
        btnCancelar.className = "btn btn-sm ms-2";

        // Insertar botones
        burbuja.querySelector(".fecha").prepend(btnGuardar, btnCancelar);//los pone delante de la fecha

        //si cancela la modificacion desaparecen los botones y vuelve el texto original
        btnCancelar.addEventListener("click", () => {
            textarea.replaceWith(textoDiv);
            btnGuardar.remove();
            btnCancelar.remove();
            
            //vuelve el boton para borrar publicacion
            if (btnBorrar) btnBorrar.style.display = "";
        });

        //guardar nueva publicacion
        btnGuardar.addEventListener("click", () => {
            const nuevoTexto = textarea.value.trim();//trim quita los espacios
            if (nuevoTexto === "") return;//si el editar queda vacio al guardar, muestra el texto original

            const formData = new FormData();
            formData.append("id_publicacion", id);
            formData.append("contenido", nuevoTexto);//agregamos nuevo texto a la publicacion
            //se actualiza con .ajax
            fetch("editar_publicacion.php", {
                method: "POST",
                body: formData
            })
            .then(r => r.text())//pone la respuesta del servidor como texto
            .then(r => {
                if (r === "ok") {//si es exitoso
                    textoDiv.innerText = nuevoTexto;//deja el texto como nuevecito
                    textarea.replaceWith(textoDiv);//quita textarea
                    btnGuardar.remove();
                    btnCancelar.remove();

                    //muestra el boton borrar publicacion
                    if (btnBorrar) btnBorrar.style.display = "";
                } else {
                    alert("Error: " + r);
                }
            });
        });
    });
});
</script>