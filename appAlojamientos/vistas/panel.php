<?php
session_start();
include_once('../conf/conf.php');
if (!isset($_SESSION['idusuario'])) {

    header("Location: ../vistas/login.php");
    exit();
}
$user = $_SESSION['idusuario'];
$buscar = isset($_POST['buscar']) ? $_POST['buscar'] : "";
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

    <title>Panel</title>
</head>

<body>
    <?php

    if ($_SESSION['idrol'] == 1) {
    ?>
        <!-- Contenido usuario admin -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="panel.php">AireHome</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../php/salir.php">Salir</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <div class="container my-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Alojamientos</h4>
                <!-- Botón Agregar -->
                <?php
                if (isset($_GET['msg']) && $_GET['msg'] == 1) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            ✅ Alojamiento registrado con éxito.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
          </div>';
                }
                ?>

                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#agregarModal">
                    + Agregar Alojamiento
                </button>
            </div>
            <table class="table table-striped table-bordered">
                <thead class="table-dark" style="font-size:14px;">
                    <tr>
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Departamento</th>
                        <th>Dirección</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody style="font-size:13px;">
                    <?php
                    $sql = "SELECT * FROM alojamientos";
                    $result = $conexion->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                      <td>{$row['idalojamientos']}</td>
                      <td><img src='../public/imgAlojamientos/{$row['img']}' width='80'></td>
                      <td>{$row['titulo']}</td>
                      <td>{$row['descripcion']}</td>
                      <td>{$row['departamento']}</td>
                      <td>{$row['direccion']}</td>
                      <td>" . '$' . "{$row['precio']}</td>
                    </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Modal para agregar alojamiento -->
        <div class="modal fade" id="agregarModal" tabindex="-1" aria-labelledby="agregarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="../php/guardar_alojamiento.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="agregarModalLabel">Agregar Alojamiento</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título</label>
                                <input type="text" name="titulo" id="titulo" class="form-control" maxlength="100" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="img" class="form-label">Imagen</label>
                                <input type="file" name="img" id="img" class="form-control" accept="image/*" required>
                            </div>
                            <div class="mb-3">
                                <label for="departamento" class="form-label">Departamento</label>
                                <select name="departamento" id="departamento" class="form-control">
                                    <option value="Ahuachapan">Ahuachapan</option>
                                    <option value="Cabañas">Cabañas</option>
                                    <option value="Cuscatlan">Cuscatlan</option>
                                    <option value="Chalatenango">Chalatenango</option>
                                    <option value="La libertad">La libertad</option>
                                    <option value="La Unión">La Unión</option>
                                    <option value="Morazán">Morazán</option>
                                    <option value="San Miguel">San Miguel</option>
                                    <option value="San Salvador">San Salvador</option>
                                    <option value="Sonsonate">Sonsonate</option>
                                    <option value="Usulutan">Usulutan</option>
                                </select>
                                <!-- <input type="text" name="departamento" id="departamento" class="form-control" required> -->
                            </div>
                            <div class="mb-3">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" name="direccion" id="direccion" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="precio" class="form-label">Precio</label>
                                <input type="number" name="precio" id="precio" class="form-control" step="0.01" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php
    } else if ($_SESSION['idrol'] == 2) {
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

        <div class="container my-4">
            <div class="row g-4">
                <br><br>
                <div class="d-flex justify-content-center">
                    <form action="" method="POST" class="d-flex w-100 justify-content-center align-items-center" style="max-width: 700px;">
                        <input type="text" name="buscar" class="form-control rounded-pill me-2 px-4"
                            placeholder="Buscar Alojamientos por departamentos" value="<?php echo $buscar; ?>">
                        <button class="btn btn-primary rounded-pill px-4">Buscar</button>
                    </form>
                </div>
                <?php
                if (isset($_GET['msg']) && $_GET['msg'] == 1) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            ✅ Alojamiento reservado con éxito.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
          </div>';
                }
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $buscar = isset($_POST['buscar']) ? $_POST['buscar'] : "";

                    if ($buscar == "") {
                        $sql = "SELECT a.idalojamientos, a.titulo, a.descripcion, a.precio, a.img, a.departamento,
                   CASE 
                       WHEN ca.idusuario IS NOT NULL THEN 'Reservado por mí'
                       ELSE 'Disponible'
                   END AS estado
            FROM alojamientos a
            LEFT JOIN cuentaalojamiento ca 
                   ON a.idalojamientos = ca.idalojamiento 
                  AND ca.idusuario = ?";

                        $stmt = $conexion->prepare($sql);
                        $stmt->bind_param("i", $user);
                    } else {
                        $sql = "SELECT a.idalojamientos, a.titulo, a.descripcion, a.precio, a.img, a.departamento,
                   CASE 
                       WHEN ca.idusuario IS NOT NULL THEN 'Reservado por mí'
                       ELSE 'Disponible'
                   END AS estado
            FROM alojamientos a
            LEFT JOIN cuentaalojamiento ca 
                   ON a.idalojamientos = ca.idalojamiento 
                  AND ca.idusuario = ? 
            WHERE a.departamento = ?";

                        $stmt = $conexion->prepare($sql);
                        $stmt->bind_param("is", $user, $buscar);
                    }

                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card h-100">
                                <img src="../public/imgAlojamientos/<?php echo $row['img']; ?>"
                                    class="card-img-top" height="200" alt="...">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title" style="font-size:14px;"><?php echo $row['titulo']; ?></h5>
                                    <!-- <p class="card-text flex-grow-1"><?php echo $row['descripcion']; ?></p> -->
                                    <div class="d-flex justify-content-between align-items-center">
                                        <?php if ($row['estado'] == "Reservado por mí"): ?>
                                            <span class="badge bg-warning">Reservado</span>
                                        <?php else: ?>
                                            <a href="../php/reserva.php?id=<?php echo $row['idalojamientos']; ?>&user=<?php echo $user ?>"
                                                type="button" class="btn btn-primary btn-sm">Reservar</a>
                                            <span class="badge bg-success">$ <?php echo $row['precio']; ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                } else {


                    $sql = "SELECT a.idalojamientos, a.titulo, a.descripcion, a.precio, a.img, a.departamento,
               CASE 
                   WHEN ca.idusuario IS NOT NULL THEN 'Reservado por mí'
                   ELSE 'Disponible'
               END AS estado
        FROM alojamientos a
        LEFT JOIN cuentaalojamiento ca 
               ON a.idalojamientos = ca.idalojamiento 
              AND ca.idusuario = ?";

                    $stmt = $conexion->prepare($sql);
                    $stmt->bind_param("i", $user);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card h-100">
                                <img src="../public/imgAlojamientos/<?php echo $row['img']; ?>"
                                    class="card-img-top" height="200" alt="...">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title" style="font-size:13px;"><?php echo $row['titulo']; ?></h5>
                                    <!-- <p class="card-text flex-grow-1"><?php echo $row['descripcion']; ?></p> -->
                                    <div class="d-flex justify-content-between align-items-center">
                                        <?php if ($row['estado'] == "Reservado por mí"): ?>
                                            <span class="badge bg-warning">Reservado</span>
                                        <?php else: ?>
                                            <a href="../php/reserva.php?id=<?php echo $row['idalojamientos']; ?>&user=<?php echo $user ?> " type="button" class="btn btn-primary btn-sm">Reservar</a>

                                            <span class="badge bg-success">$ <?php echo $row['precio']; ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } ?>

            </div>
        </div>


    <?php
    }
    ?>
</body>

</html>