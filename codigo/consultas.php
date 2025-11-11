<?php
include("conexion.php");
session_start();

if (isset($_SESSION['id_usuario'])) {//verifica la sesion
    $id_usuario = $_SESSION['id_usuario'];
} else {
    $id_usuario = null;
}

if (!isset($_SESSION['ultima_respuesta'])) {
    $_SESSION['ultima_respuesta'] = "1"; //inicializa con 1 como valor default
}
if (!isset($_SESSION['en_test'])) {
    $_SESSION['en_test'] = false; //reinicia el test por si acaso
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['pregunta'])) {
    $pregunta = trim($_POST['pregunta']);//recibe la pregunta

    //consultas validas siempre
    if (in_array(strtolower($pregunta), ["1", "hola", "menu","gracias","como estas","buenos dias","adios"])) {
        unset($_SESSION['ultima_respuesta']);
    }

    //mensaje para opciones de test no válidas
    if (in_array($pregunta, ["6", "7", "8", "9"]) && $_SESSION['en_test'] === false) {
        echo "Esta consulta es parte del test, presiona 🔹1 para ir al menú y empezarlo";
        exit;
    }
    //inicio del test
    if ($pregunta === "5") {
        //agarra los números válidos del menú
        $opciones_validas = [];
        if (preg_match_all('/(\d+)\s*🔹/u', $_SESSION['ultima_respuesta'], $matches)) {
            $opciones_validas = $matches[1]; // ['1','2','5', ...]
        }

        //verificar si el 5 esta
        if ($pregunta === "5") {
            if (!in_array("5", $opciones_validas)) {
                echo "Por favor, escribí una de las opciones mostradas o escribí 🔹1 para volver al menú.";
                exit;
            }
        }

        if (!$id_usuario) {
            echo "Debes iniciar sesión para hacer el test.";
            exit;
        }

        $connPHP->query("DELETE FROM test WHERE id_usuario = " . ($id_usuario));

        $_SESSION['en_test'] = true;
        $_SESSION['pregunta_actual'] = 5;

        $stmt_q = $connPHP->prepare("SELECT respuesta FROM consultas WHERE pregunta = ?");
        $stmt_q->bind_param("i", $_SESSION['pregunta_actual']);
        $stmt_q->execute();
        $res_q = $stmt_q->get_result();

        if ($res_q->num_rows > 0) {
            $fila_q = $res_q->fetch_assoc();
            echo $fila_q['respuesta'];
            $_SESSION['ultima_respuesta'] = $fila_q['respuesta'];
        }

        $stmt_q->close();
        exit;
    }

    //si está haciendo el test
    if (isset($_SESSION['en_test']) && $_SESSION['en_test'] === true) {
        $opcion = strtolower(trim($pregunta));
        $opciones_validas = ['a', 'b', 'c', 'd', 'e', 'f'];

        if (!in_array($opcion, $opciones_validas)) {
            echo "Recuerda que debes elegir entre a y f.";
            exit;
        }

        $stmt_test = $connPHP->prepare("INSERT INTO test (id_usuario, opcion) VALUES (?, ?)");
        $stmt_test->bind_param("is", $id_usuario, $opcion);
        $stmt_test->execute();
        $stmt_test->close();

        $_SESSION['pregunta_actual']++;
        $preg_siguiente = $_SESSION['pregunta_actual'];

        if ($preg_siguiente > 9) {
            unset($_SESSION['en_test'], $_SESSION['pregunta_actual'], $_SESSION['ultima_respuesta']);

            $stmt_res = $connPHP->prepare("SELECT opcion FROM test WHERE id_usuario = ?");
            $stmt_res->bind_param("i", $id_usuario);
            $stmt_res->execute();
            $res = $stmt_res->get_result();

            $conteo = [
                'a' => 0,
                'b' => 0,
                'c' => 0,
                'd' => 0,
                'e' => 0,
                'f' => 0
            ];

            while ($fila = $res->fetch_assoc()) {
                $op = strtolower(trim($fila['opcion']));
                if (isset($conteo[$op])) $conteo[$op]++;
            }
            $stmt_res->close();

            $maximo = max($conteo);
            $ganadores = [];
            foreach ($conteo as $op => $cant) {
                if ($cant === $maximo && $maximo > 0) $ganadores[] = $op;
            }

            $orientaciones = [
                'a' => "Química",
                'b' => "Automotores",
                'c' => "Programación",
                'd' => "Informática",
                'e' => "Maestro Mayor de Obra",
                'f' => "Electromecánica"
            ];

            if (count($ganadores) > 1) {
                $nombres = array_map(fn($g) => $orientaciones[$g], $ganadores);
                $resultado = implode(" y ", $nombres);
                echo "¡Test finalizado!<br>¡Wow! un empate<br>Creo que te caería bien <strong>{$resultado}</strong>.<br>
                      Te recomiendo hablar con un profe o referente de la escuela para más info de cada orientación.<br>
                      presione 🔹1 para ir al menu";
            } elseif (count($ganadores) === 1) {
                $resultado = $orientaciones[$ganadores[0]];
                echo "¡Test finalizado!<br>Creo que te caería bien <strong>{$resultado}</strong>.<br>
                      Te recomiendo hablar con un profe o referente de la escuela para más info.<br>
                      presione 🔹1 para ir al menu";
            } else {
                echo "¡Test finalizado!<br>Vuelve a hacer el test bien para saber el resultado.";
            }

            exit;
        }

        $stmt_next = $connPHP->prepare("SELECT respuesta FROM consultas WHERE pregunta = ?");
        $stmt_next->bind_param("i", $preg_siguiente);
        $stmt_next->execute();
        $res_next = $stmt_next->get_result();

        if ($res_next->num_rows > 0) {
            $fila_next = $res_next->fetch_assoc();
            echo $fila_next['respuesta'];
            $_SESSION['ultima_respuesta'] = $fila_next['respuesta'];
        }

        $stmt_next->close();
        exit;
    }

    //-----------------------------------validacion de opciones-----------------------------------//
    if (isset($_SESSION['ultima_respuesta'])) {
        $ultima_respuesta = $_SESSION['ultima_respuesta'];
        $ultima_respuesta = mb_convert_encoding($ultima_respuesta, 'UTF-8', 'auto');

        $opciones_validas = [];
        if (preg_match_all('/(\d+)\s*🔹/u', $ultima_respuesta, $matches)) {
            $opciones_validas = $matches[1];
        }

        if (!in_array("1", $opciones_validas)) {
            $opciones_validas[] = "1";
        }

        //si el usuario escribe algo no válido, insertar en la BD solo si no existe
        if (!empty($opciones_validas) && !in_array($pregunta, $opciones_validas) && $pregunta !== "1") {
            $stmt_check = $connPHP->prepare("SELECT id_consulta FROM consultas WHERE titulo = ?");
            $stmt_check->bind_param("s", $pregunta);
            $stmt_check->execute();
            $res_check = $stmt_check->get_result();
            
            if ($res_check->num_rows === 0) {
                $stmt_insert = $connPHP->prepare("INSERT INTO consultas (pregunta, titulo, respuesta, contador, preg_contestada) VALUES ('', ?, '', 1, false)");
                $stmt_insert->bind_param("s", $pregunta);
                $stmt_insert->execute();
                $stmt_insert->close();

                echo "¡Gracias por tu consulta!, por ahora no tengo una respuesta.";
                exit;
            }
            $stmt_check->close();

            echo "Por favor, escribí una de las opciones mostradas o escribí 🔹1 para volver al menú.";
            exit;
        }
    }

    //-----------------Chat normal------------------------------
    $stmt = $connPHP->prepare("SELECT id_consulta, respuesta, preg_contestada, contador FROM consultas WHERE pregunta = ?");
    $stmt->bind_param("s", $pregunta);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $id_consulta = $fila['id_consulta'];
        $pregfrec = $fila['contador'] + 1;

        $stmt_update = $connPHP->prepare("UPDATE consultas SET contador = ? WHERE id_consulta = ?");
        $stmt_update->bind_param("ii", $pregfrec, $id_consulta);
        $stmt_update->execute();
        $stmt_update->close();

        if ($fila['preg_contestada']) {
            echo $fila['respuesta'];
            $_SESSION['ultima_respuesta'] = $fila['respuesta'];

            if ($id_usuario) {
                $stmt_historial = $connPHP->prepare("INSERT INTO historial (id_usuario, id_consulta) VALUES (?, ?)");
                $stmt_historial->bind_param("ii", $id_usuario, $id_consulta);
                $stmt_historial->execute();
                $stmt_historial->close();
            }
        }
    }
}
$connPHP->close();
?>