$(function () {
    // Autocompletado al input con id pregunta
    $("#pregunta").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "sugerencias.php",
                dataType: "json",
                data: { term: request.term },
                success: function (data) {
                    response(data);
                }
            });
        },
        minLength: 2
    });
});

$(document).ready(function () {
    const chatLog = $("#chat-log");

    $("#formulario").submit(function (e) {
        e.preventDefault();
        const mensaje = $("#pregunta").val().trim();
        if (mensaje === "") return;

        // Cierra sugerencias
        $("#pregunta").autocomplete("close");

        // Mostrar el mensaje del usuario
        chatLog.append(`<div class="burbuja user">${mensaje}</div>`);


        // Enviar pregunta a IA (consultas.php) y mostrar respuesta
        $.ajax({
            type: "POST",
            url: "consultas.php",
            data: { pregunta: mensaje },
            success: function (respuesta) {
                chatLog.append(`<div class="burbuja IA">${respuesta}</div>`);
                chatLog.scrollTop(chatLog[0].scrollHeight); // auto scroll
            }
        });

        $("#pregunta").val(""); // Limpiar campo
    });

    // Autopregunta desde localStorage
    const preguntaAuto = localStorage.getItem("preguntaAuto");
    if (preguntaAuto) {
        localStorage.removeItem("preguntaAuto");

        chatLog.append(`<div class="burbuja user">${preguntaAuto}</div>`);

        $.ajax({
            type: "POST",
            url: "consultas.php",
            data: { pregunta: preguntaAuto },
            success: function (respuesta) {
                chatLog.append(`<div class="burbuja IA">${respuesta}</div>`);
                chatLog.scrollTop(chatLog[0].scrollHeight);
            }
        });

        $.post("guardar_mensaje.php", { mensaje: preguntaAuto }, function () {
            cargarHistorial();
        });
    }
});