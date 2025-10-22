<?php
include("conexion.php");
session_start();

if (isset($_SESSION['id_usuario'])) {//si inicio sesion
    $id_usuario = $_SESSION['id_usuario'];//variable con sesion
} else {
    $id_usuario = null;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['pregunta'])) {//si recibió la pregunta
    $pregunta = trim($_POST['pregunta']);//variable con la pregunta

    if ($pregunta === "5") {//si escribio 5 inicia del test
        if (!$id_usuario) {//si no inició sesión no puede hacer el test
            echo "Debes iniciar sesión para hacer el test.";
            exit;
        }

        //borra el antiguo test
        $connPHP->query("DELETE FROM test WHERE id_usuario = " . ($id_usuario));

        $_SESSION['en_test'] = true;//variable de si está en el test
        $_SESSION['pregunta_actual'] = 5;//empieza en la pregunta 5

        //selecciona la primera pregunta del test
        $stmt_q = $connPHP->prepare("SELECT respuesta FROM consultas WHERE pregunta = ?");
        $stmt_q->bind_param("i", $_SESSION['pregunta_actual']);//parametro pregunta actual
        $stmt_q->execute();
        $res_q = $stmt_q->get_result();

        if ($res_q->num_rows > 0) {
            $fila_q = $res_q->fetch_assoc();
            echo $fila_q['respuesta'];//muestra la primera pregunta
        }

        $stmt_q->close();
        exit;
    }

    if (isset($_SESSION['en_test']) && $_SESSION['en_test'] === true) {//si está haciendo el test

        $opcion = $pregunta;//opción elegida
        $preg_actual = $_SESSION['pregunta_actual'];//pregunta actual del usuario

        $opcion = strtolower(trim($pregunta));//variable de la opcion

        //verificar que el usuario solo inserte de a-f
        $opciones_validas = ['a', 'b', 'c', 'd', 'e', 'f'];
        if (!in_array($opcion, $opciones_validas)) {//si no escribe de a-f muestra mensaje
            echo "recuerda que debes elegir entre a y f.";
            exit;
        }

        $stmt_test = $connPHP->prepare("INSERT INTO test (id_usuario, opcion) VALUES (?, ?)");//se inserta las opciones del usuario en la bd
        $stmt_test->bind_param("is", $id_usuario, $opcion);
        $stmt_test->execute();
        $stmt_test->close();

        $_SESSION['pregunta_actual']++;//cuando responde la pregunta suma +1
        $preg_siguiente = $_SESSION['pregunta_actual'];

        // si llega al final del test (última pregunta es la 9)
        if ($preg_siguiente > 9) {
            unset($_SESSION['en_test'], $_SESSION['pregunta_actual']); //termina el test

            //agarra todas las opciones del usuario
            $stmt_res = $connPHP->prepare("SELECT opcion FROM test WHERE id_usuario = ?");
            $stmt_res->bind_param("i", $id_usuario);
            $stmt_res->execute();
            $res = $stmt_res->get_result();

            //array que contiene opciones con su contador
            $conteo = [
                'a' => 0, // Química
                'b' => 0, // Automotores
                'c' => 0, // Programación
                'd' => 0, // Informática
                'e' => 0, // Maestro Mayor de Obra
                'f' => 0  // Electromecánica
            ];

            while ($fila = $res->fetch_assoc()) {
                $op = strtolower(trim($fila['opcion'])); //evita mayusculas y espacios
                if (isset($conteo[$op])) $conteo[$op]++; //+1 si se elige una opcion
            }
            $stmt_res->close();

            //busca la orientación más elegida
            $maximo = max($conteo);
            $ganadores = [];

            foreach ($conteo as $op => $cant) {
                if ($cant === $maximo && $maximo > 0) $ganadores[] = $op;//ponemos a los ganadores dentro del array
            }

            //nombres de las orientaciones
            $orientaciones = [
                'a' => "Química",
                'b' => "Automotores",
                'c' => "Programación",
                'd' => "Informática",
                'e' => "Maestro Mayor de Obra",
                'f' => "Electromecánica"
            ];

            if (count($ganadores) > 1) {//si hay 2 ganadores lo muestra
                $nombres = array_map(fn($g) => $orientaciones[$g], $ganadores);//busco las orientaciones ganadoras y hago un nuevo array (de letras -> a palabras)
                $resultado = implode(" y ", $nombres);//muestra los 2 nombres en caso de empate
                echo "¡Test finalizado!<br>¡Wow! un empate<br>Creo que te caería bien <strong>{$resultado}</strong>.<br>
                    Te recomiendo hablar con un profe o referente de la escuela para más info de cada orientación.";
            } elseif (count($ganadores) === 1) {//si hay un ganador lo muestra
                $resultado = $orientaciones[$ganadores[0]];
                echo "¡Test finalizado!<br>Creo que te caería bien <strong>{$resultado}</strong>.<br>
                    Te recomiendo hablar con un profe o referente de la escuela para más info.";
            } else {
                echo "¡Test finalizado!<br>Vuelve a hacer el test bien para saber el resultado.";
            }

            exit;
        }
        // busca y muestra la siguiente pregunta
        $stmt_next = $connPHP->prepare("SELECT respuesta FROM consultas WHERE pregunta = ?");
        $stmt_next->bind_param("i", $preg_siguiente);
        $stmt_next->execute();
        $res_next = $stmt_next->get_result();

        if ($res_next->num_rows > 0) {
            $fila_next = $res_next->fetch_assoc();
            echo $fila_next['respuesta'];
        }

        $stmt_next->close();
        exit;
    }

    //-----------------chat normal------------------------------
    $stmt = $connPHP->prepare("SELECT id_consulta, respuesta, preg_contestada, contador FROM consultas WHERE pregunta = ?");//agarra la respuesta de la pregunta
    $stmt->bind_param("s", $pregunta);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {//si la consulta esta en la bd
        $fila = $resultado->fetch_assoc();
        $id_consulta = $fila['id_consulta'];
        $pregfrec = $fila['contador'] + 1;//suma al contador

        $stmt_update = $connPHP->prepare("UPDATE consultas SET contador = ? WHERE id_consulta = ?");//actualizar contador
        $stmt_update->bind_param("ii", $pregfrec, $id_consulta);
        $stmt_update->execute();
        $stmt_update->close();

        if ($fila['preg_contestada']) {//si tiene respuesta la muestra
            echo $fila['respuesta'];
            if ($id_usuario) {//guardar historial solo si hay usuario
                $stmt_historial = $connPHP->prepare("INSERT INTO historial (id_usuario, id_consulta) VALUES (?, ?)");//inserta en el historial
                $stmt_historial->bind_param("ii", $id_usuario, $id_consulta);
                $stmt_historial->execute();
                $stmt_historial->close();
            }
        } else {
            echo "Lamentablemente aún no tengo una respuesta para <strong>" . ($pregunta) . "</strong>.<br>
                  El menú que tenemos es:<br>2🔹Orientaciones.<br>3🔹Ubicaciones.<br>4🔹Info. <br>5🔹Test vocacional.";//si no hay respuesta muestra el menu
        }
    } else {
        $stmt_insert = $connPHP->prepare("INSERT INTO consultas (pregunta, titulo, respuesta, contador, preg_contestada) VALUES (?, ?, '', 1, false)");//inserta nueva consulta
        $stmt_insert->bind_param("ss", $pregunta, $pregunta);
        if ($stmt_insert->execute()) {//se agradece al usuario por la nueva consulta
            echo "¡Gracias por tu consulta! Por ahora no tengo una respuesta para <strong>" . ($pregunta) . "</strong>.<br>
                  El menú que te ofrecemos es:<br>2🔹Orientaciones.<br>3🔹Ubicaciones.<br>4🔹Info. <br>5🔹Test vocacional.";
        }
    }

    $stmt->close();
}

$connPHP->close();
?>