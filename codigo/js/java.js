// Espera a que el DOM esté completamente cargado antes de ejecutar el código
document.addEventListener("DOMContentLoaded", function () {

    cargarHistorial(); //llama la funcion que mostrara el historial
    // Función que obtiene el historial
    function cargarHistorial() {
        fetch('obtener_historial.php') //realiza un GET al archivo
            .then(response => {
                // Si la respuesta no es exitosa, lanza un error
                if (!response.ok) throw new Error("Error al obtener el historial");
                return response.json(); // Convierte la respuesta en formato JSON
            })
            .then(data => {
                const chatLog = document.getElementById("chat-log"); // Obtiene el contenedor del chat
                chatLog.innerHTML = ""; // Limpia el contenido anterior

                // Recorre cada mensaje recibido y lo muestra en el chat
                data.forEach(mensaje => {
                    const burbujaUser = document.createElement("div"); //crea burbuja del usuario
                    burbujaUser.className = "burbuja user"; //clase css para la burbuja
                    burbujaUser.textContent = mensaje.pregunta; //inserta la pregunta

                    const burbujaIA = document.createElement("div");
                    burbujaIA.className = "burbuja IA";
                    burbujaIA.textContent = mensaje.respuesta;

                    chatLog.appendChild(burbujaUser); // Agrega la burbuja del usuario al chat
                    chatLog.appendChild(burbujaIA); // Agrega la burbuja de la IA al chat
                });
            })
            .catch(error => {
                // Muestra error si algo falla
                console.error("Error:", error);
            });
    }

    // Cuando el DOM está listo, ejecuta el bloque jQuery
    $(function () {
        const chatLog = $("#chat-log"); // Selecciona el contenedor del chat

        // Configura el autocompletado para el input con id 'pregunta'
        $("#pregunta").autocomplete({
            source: function (request, response) {
                // Realiza una petición AJAX a 'sugerencias.php' con el término ingresado
                $.ajax({
                    url: "sugerencias.php",
                    dataType: "json",
                    data: { term: request.term }, // Envía el término de búsqueda
                    success: function (data) {
                        response(data); // Devuelve las sugerencias al autocompletado
                    }
                });
            },
            minLength: 2 // Mínimo de 2 caracteres antes de mostrar sugerencias
        });

        // Maneja el envío del formulario de pregunta
        $("#formulario").submit(function (e) {
            e.preventDefault(); // Evita que se recargue la página

            const mensaje = $("#pregunta").val().trim(); // Obtiene y limpia el mensaje
            if (mensaje === "") return; // Si está vacío, no hace nada

            $("#pregunta").autocomplete("close"); // Cierra el menú de sugerencias

            // Muestra el mensaje del usuario en el chat
            chatLog.append(`<div class="burbuja user">${mensaje}</div>`);

            // Envía la pregunta a 'consultas.php' mediante AJAX
            $.ajax({
                type: "POST",
                url: "consultas.php",
                data: { pregunta: mensaje }, // Envía la pregunta como parámetro
                success: function (respuesta) {
                    // Muestra la respuesta de la IA en el chat
                    chatLog.append(`<div class="burbuja IA">${respuesta}</div>`);
                }
            });

            $("#pregunta").val(""); // Limpia el campo de entrada
        });

    });
});