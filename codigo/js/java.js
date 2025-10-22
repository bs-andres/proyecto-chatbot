
document.addEventListener("DOMContentLoaded", function () {

    const chatLog = $("#chat-log"); //variable que contiene el chat

    //función para hacer scroll hasta el final
    function scrollAlFinal() {
        chatLog.scrollTop(chatLog.prop("scrollHeight"));//define la posicion actual
    }

    //función que obtiene y muestra el historial
    function cargarHistorial() {
        fetch('obtener_historial.php')//obtenemos el historial a traves del archivo
            .then(response => {
                if (!response.ok) throw new Error("Error al obtener el historial");//si hubo error muestra un mensaje
                return response.json();//convierte la respuesta en js
            })
            .then(data => {//array con el historial
                chatLog.html(""); //limpia el chat

                data.forEach(mensaje => {//recorre cada mensaje
                    chatLog.append(`<div class="burbuja user">${mensaje.pregunta}</div>`);//agrega la burbuja del usuario con su estilo y mensaje
                    chatLog.append(`<div class="burbuja IA">${mensaje.respuesta}</div>`);//y aqui la del bot
                });

                scrollAlFinal(); //Hace scroll al final del historial
            })
            .catch(error => {//si falla
                console.error("Error:", error);//muestra el error
            });
    }

    cargarHistorial(); //llama la funcion del historial

    //autocompletado para el input
    $("#pregunta").autocomplete({
        source: function (request, response) {//funcion que toma lo que el usuario escribe y lo muestra
            $.ajax({
                url: "sugerencias.php",//pide el archivo
                dataType: "json",//en js
                data: { term: request.term },//envia el texto del usuario
                success: function (data) {//recibe los datos
                    response(data);//la muestra
                }
            });
        },
        minLength: 3//minimo 3 letras para que aparezca
    });

    //manejo del envío del formulario
    $("#formulario").submit(function (e) {
        e.preventDefault();//evita el manejo normal

        const mensaje = $("#pregunta").val().trim();//variable con el texto del usuario sin espacion
        if (mensaje === "") return;//si no envia nada no pasa nada

        $("#pregunta").autocomplete("close");//cierra el autocompletado

        chatLog.append(`<div class="burbuja user">${mensaje}</div>`);//muestra el mensaje del usuario
        scrollAlFinal(); //baja hasta el mensaje del usuario

        // Enviar pregunta al chatbot
        $.ajax({
            type: "POST",//metodo post
            url: "consultas.php",//a este archivo
            data: { pregunta: mensaje },//manda la consulta
            success: function (respuesta) {//funcion que devuelve la respuesta
                chatLog.append(`<div class="burbuja IA">${respuesta}</div>`);//agrega la borbuja con la respuesta
                scrollAlFinal(); //baja a la respuesta
            }
        });

        $("#pregunta").val(""); //limpia el input
    });
});