<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ia";

// Crear conexión
$connPHP = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($connPHP->connect_error) {
    die("Conexión fallida: " . $connPHP->connect_error);
}
?>