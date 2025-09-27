<?php
session_start();
include_once('../conf/conf.php');
if (!isset($_SESSION['idusuario'])) {

    header("Location: ../vistas/login.php");
    exit();
}
$fecha = date("Y-m-d");
$user = isset($_GET['user']) ? $_GET['user']:"";
$id=isset($_GET['id']) ? $_GET['id']:"";

$sql = "INSERT INTO cuentaalojamiento (idalojamiento, idusuario,fecha_registro)
        VALUES (?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("iis", $id,$user,$fecha);

if($stmt->execute()){
    // Éxito → redirigir al listado con mensaje
    header("Location: ../vistas/panel.php?msg=1");
    exit();
} else {
    echo "Error al reservar alojamiento: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>