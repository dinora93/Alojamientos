<?php
$host = "localhost";   // Servidor de la BD
$user = "root";        // Usuario de la BD
$pass = "";            // Contraseña de la BD
$db   = "dbappalojamientos";     // Nombre de la base de datos

// Crear conexión
$conexion = new mysqli($host, $user, $pass, $db);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Para mostrar acentos correctamente
$conexion->set_charset("utf8");
?>
