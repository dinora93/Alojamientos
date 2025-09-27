<?php
session_start();
include_once('../conf/conf.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idregistro = $_POST['idregistro'];
    $user = $_SESSION['idusuario'];

    $sql = "DELETE FROM cuentaalojamiento WHERE idregistro = ? AND idusuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ii", $idregistro, $user);

    if ($stmt->execute()) {
        $_SESSION['msg'] = "Reserva eliminada con éxito.";
    } else {
        $_SESSION['msg'] = "Error al eliminar la reserva.";
    }

    header("Location: ../vistas/reservas.php");
    exit();
}
?>
