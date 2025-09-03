<?php
session_start();

// Solo borramos la variable 'usuario' para "cerrar sesión"
unset($_SESSION['usuario']);

// Redirigimos al chat
header("Location: chat.php");
exit();
