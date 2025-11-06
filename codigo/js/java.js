document.addEventListener("DOMContentLoaded", function () {

    const chatLog = document.getElementById("chat-log"); //variable que contiene el chat
    const preguntaInput = document.getElementById("pregunta"); //input de la pregunta
    const formulario = document.getElementById("formulario"); //formulario de envío
    const btnArriba = document.getElementById("btn-arriba"); //botón subir
    const btnAbajo = document.getElementById("btn-abajo"); //botón bajar

    //función que obtiene y muestra el historial
    function cargarHistorial() { 
        fetch('obtener_historial.php') //obtenemos el historial a traves del archivo
            .then(response => {
                if (!response.ok) throw new Error("Error al obtener el historial"); //si hubo error muestra un mensaje
                return response.json(); //convierte la respuesta en js
            })
            .then(data => { //array con el historial
                chatLog.innerHTML = ""; //limpia el chat

                data.forEach(mensaje => { //recorre cada mensaje
                    //agrega la burbuja del usuario con su estilo y mensaje
                    const burbujaUsuario = document.createElement("div");
                    burbujaUsuario.className = "burbuja user";
                    burbujaUsuario.innerHTML = mensaje.pregunta;
                    chatLog.appendChild(burbujaUsuario);

                    //y aqui la del bot
                    const burbujaIA = document.createElement("div");
                    burbujaIA.className = "burbuja IA";
                    burbujaIA.innerHTML = mensaje.respuesta;
                    chatLog.appendChild(burbujaIA);
                });

            })
            .catch(error => { //si falla
                console.error("Error:", error); //muestra el error
            });
    }

    cargarHistorial(); //llama la funcion del historial

    //manejo del envío del formulario
    formulario.addEventListener("submit", function (e) {
        e.preventDefault(); //evita el manejo normal

        const mensaje = preguntaInput.value.trim(); //variable con el texto del usuario sin espacio
        if (!mensaje) return; //si no envia nada no pasa nada

        // Crear burbuja del usuario y agregar al chat
        const burbujaUsuario = document.createElement("div");
        burbujaUsuario.className = "burbuja user";
        burbujaUsuario.innerHTML = mensaje;
        chatLog.appendChild(burbujaUsuario);

        // scroll hasta la burbuja del usuario
        burbujaUsuario.scrollIntoView({ behavior: "smooth", block: "end" });

        // Enviar pregunta al chatbot
        $.ajax({
            type: "POST", //metodo post
            url: "consultas.php", //a este archivo
            data: { pregunta: mensaje }, //manda la consulta
            success: function (respuesta) { //funcion que devuelve la respuesta
                // Crear burbuja de la IA y agregar al chat
                const burbujaIA = document.createElement("div");
                burbujaIA.className = "burbuja IA";
                burbujaIA.innerHTML = respuesta;
                chatLog.appendChild(burbujaIA);

                // scroll automático hasta la burbuja de la IA
                burbujaIA.scrollIntoView({ behavior: "smooth", block: "end" });
            }
        });
        preguntaInput.value = ""; //limpia el input
    });

    // ------------------ BOTONES DE SCROLL ------------------
    window.onscroll = function() {
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

    // Eventos de click en los botones
    btnArriba.addEventListener("click", scrollToTop);
    btnAbajo.addEventListener("click", scrollToBottom);

});