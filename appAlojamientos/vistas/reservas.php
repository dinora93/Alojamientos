<?php
session_start();
include_once('../conf/conf.php');
if (!isset($_SESSION['idusuario'])) {

    header("Location: ../vistas/login.php");
    exit();
}
$user = $_SESSION['idusuario'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <title>Reservas</title>
</head>

<body>
    <?php

    if ($_SESSION['idrol'] == 2) {
    ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="panel.php">AireHome</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="panel.php">Alojamientos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../vistas/reservas.php">Reservas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../php/salir.php">Salir</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <?php
       
        $sql = "SELECT ca.idregistro, a.titulo, a.descripcion, a.departamento, a.direccion, a.precio, a.img, ca.fecha_registro
        FROM cuentaalojamiento ca
        INNER JOIN alojamientos a ON ca.idalojamiento = a.idalojamientos
        WHERE ca.idusuario = ?";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $user);
        $stmt->execute();
        $result = $stmt->get_result();

        ?>
        <div class="container my-4">
    <h4 class="mb-4">Mis Reservas</h4>
    <table class="table table-bordered table-hover table-striped align-middle">
        <thead class="table-dark" style="font-size:13px;">
            <tr>
                <th>Imagen</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Departamento</th>
                <th>Dirección</th>
                <th>Precio</th>
                <th>Fecha Reserva</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody style="font-size:13px;">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td>
                    <img src="../public/imgAlojamientos/<?php echo $row['img']; ?>" 
                         width="100" height="70" class="img-fluid rounded">
                </td>
                <td><?php echo $row['titulo']; ?></td>
                <td><?php echo $row['descripcion']; ?></td>
                <td><?php echo $row['departamento']; ?></td>
                <td><?php echo $row['direccion']; ?></td>
                <td><span class="badge bg-success">$ <?php echo $row['precio']; ?></span></td>
                <td><?php echo $row['fecha_registro']; ?></td>
                <td>
                    <form action="../php/eliminar_reserva.php" method="POST" onsubmit="return confirm('¿Seguro de cancelar esta reserva?');">
                        <input type="hidden" name="idregistro" value="<?php echo $row['idregistro']; ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar Reserva</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

    <?php
    } else {
        header("Location: ../index.php");
    }
    ?>
</body>

</html>