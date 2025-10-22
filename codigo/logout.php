<?php
session_start();
session_unset();//limpia todas las variables de sesión
session_destroy();//destruye la sesión

header("Location: login.php");//redirige
exit;
