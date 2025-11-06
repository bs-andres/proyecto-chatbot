// Mostrar botones según scroll
window.onscroll = function() {
    const btnArriba = document.getElementById("btn-arriba");
    const btnAbajo = document.getElementById("btn-abajo");
    const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
    const scrollHeight = document.documentElement.scrollHeight || document.body.scrollHeight;
    const windowHeight = window.innerHeight;

    btnArriba.style.display = scrollTop > 20 ? "block" : "none";
    btnAbajo.style.display = (scrollTop + windowHeight < scrollHeight - 15) ? "block" : "none";
};

// Funciones de desplazamiento
function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function scrollToBottom() {
    window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
}

$(document).ready(function(){

    // Enviar nuevo mensaje
    $('#formulario').submit(function(e){
        e.preventDefault();
        var mensaje = $('#mensaje').val().trim();
        if(mensaje === '') return;

        $.ajax({
            url: 'chat_comunidad_ajax.php',
            method: 'POST',
            data: {mensaje: mensaje},
            success: function(){
                $('#mensaje').val('');
                cargarPublicaciones(true); // ✅ hace scroll
            }
        });
    });

    // Dar like (delegado)
    $('#publicaciones').on('click', '.btn-like', function(){
        var id = $(this).data('id');
        $.ajax({
            url: 'chat_comunidad_ajax.php',
            method: 'POST',
            data: {like: id},
            success: function(){
                cargarPublicaciones(false); // ❌ no hace scroll
            }
        });
    });

    // Borrar publicación (delegado)
    $('#publicaciones').on('click', '.btn-borrar', function(){
        var id = $(this).data('id');

        $.ajax({
            url: 'borrar_publicacion.php',
            method: 'POST',
            data: {id_publicacion: id},
            success: function(respuesta){
                if(respuesta.trim() === 'ok'){
                    cargarPublicaciones(false); // ✅ hace scroll
                }
            },
            error: function(){
                alert('Hubo un error al intentar borrar la publicación.');
            }
        });
    });

    // ✅ Cargar publicaciones con o sin scroll
    function cargarPublicaciones(hacerScroll = true){
        $.ajax({
            url: 'chat_comunidad_ajax.php',
            method: 'GET',
            success: function(data){
                $('#publicaciones').html(data);

                // 🔽 Solo desplaza si corresponde
                if(hacerScroll){
                    $('html, body').animate({
                        scrollTop: $(document).height()
                    }, 300);
                }
            }
        });
    }

    // Carga inicial
    cargarPublicaciones(true);

});