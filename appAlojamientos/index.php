<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <title>AirHome</title>
</head>

<body>
  <!-- Menu de acciones -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="font-size:15px;">
  <div class="container-fluid">
    <!-- Div contenedor principal -->
    <div class="navbar-container">
      
      <!-- Div para el logo -->
      <div class="navbar-logo">
        <a class="navbar-brand" href="index.php">AireHome</a>
      </div>
      
      <!-- Botón toggle para móvil -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <!-- Div para el menú de navegación y login -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="navbar-content">
          
          <!-- Div para el menú de navegación -->
          <div class="navbar-menu">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#alojamientos">Alojamientos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#formas">Formas de pago</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#footer">Mas información</a>
              </li>
            </ul>
          </div>
          
          <!-- Div para registro/login -->
          <div class="navbar-auth">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" href="./vistas/login.php">Entrar | Registrarse</a>
              </li>
            </ul>
          </div>
          
        </div>
      </div>
      
    </div>
  </div>
</nav>
  <!-- Barra de busqueda -->
  <br><br>
  <div class="d-flex justify-content-center my-3">
    <form action="" method="POST" class="input-group" style="max-width: 500px;">
      <input type="text" name="buscar" class="form-control rounded-pill me-2 px-4" placeholder="Buscar por departamento...">
      <button class="btn btn-primary rounded-pill px-4">Buscar</button>
    </form>
  </div>

  <div class="container my-4" id="alojamientos">
    <div class="row g-4">
      <?php
      include_once('./conf/conf.php');
      $buscar = isset($_POST['buscar']) ? $_POST['buscar'] : "";

      if ($buscar == "") {
        $sql = "SELECT * FROM alojamientos ORDER BY departamento";
        $stmt = $conexion->prepare($sql);
      } else {
        $sql = "SELECT * FROM alojamientos WHERE departamento LIKE ? ORDER BY departamento";
        $stmt = $conexion->prepare($sql);
        $param = "%$buscar%";
        $stmt->bind_param("s", $param);
      }
      $stmt->execute();
      $result = $stmt->get_result();


      $currentDept = "";

      while ($row = $result->fetch_assoc()) {
        if ($currentDept != $row['departamento']) {
          $currentDept = $row['departamento'];
          echo "<h4 class='mt-4 mb-3 text-dark'>$currentDept >>></h4>";
          echo "<div class='row g-4'>";
        }
      ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
          <div class="card h-100 shadow-sm">
            <img src="./public/imgAlojamientos/<?php echo $row['img']; ?>"
              height="200" class="card-img-top" alt="...">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title" style="font-size:14px;"><?php echo $row['titulo']; ?></h5>
              <div class="mt-auto d-flex justify-content-between align-items-center">
                <button class="btn btn-sm btn-primary verMasBtn btn-sm"
                  data-bs-toggle="modal"
                  data-bs-target="#verMasModal"
                  data-titulo="<?php echo $row['titulo']; ?>"
                  data-descripcion="<?php echo $row['descripcion']; ?>"
                  data-departamento="<?php echo $row['departamento']; ?>"
                  data-direccion="<?php echo $row['direccion']; ?>"
                  data-precio="<?php echo $row['precio']; ?>"
                  data-img="./public/imgAlojamientos/<?php echo $row['img']; ?>">
                  Ver más
                </button>
                <span class="badge bg-success">$ <?php echo $row['precio']; ?></span>
              </div>
            </div>
          </div>
        </div>
      <?php
      }
      echo "</div>";
      ?>
      <!-- Modal -->
      <div class="modal fade" id="verMasModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalTitulo"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <img id="modalImg" src="" class="img-fluid rounded">
                </div>
                <div class="col-md-6">
                  <p id="modalDescripcion"></p>
                  <p><strong>Departamento:</strong> <span id="modalDepartamento"></span></p>
                  <p><strong>Dirección:</strong> <span id="modalDireccion"></span></p>
                  <h5 class="text-success">$ <span id="modalPrecio"></span></h5>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

      <script>
        document.querySelectorAll('.verMasBtn').forEach(button => {
          button.addEventListener('click', () => {
            document.getElementById('modalTitulo').innerText = button.getAttribute('data-titulo');
            document.getElementById('modalDescripcion').innerText = button.getAttribute('data-descripcion');
            document.getElementById('modalDepartamento').innerText = button.getAttribute('data-departamento');
            document.getElementById('modalDireccion').innerText = button.getAttribute('data-direccion');
            document.getElementById('modalPrecio').innerText = button.getAttribute('data-precio');
            document.getElementById('modalImg').src = button.getAttribute('data-img');
          });
        });
      </script>

    </div>
  </div>
  </div>
  </div>

  <div class="container my-5" id="formas">
    <h2 class="text-center mb-4">Formas de Pago</h2>
    <p class="text-center text-muted mb-5">Elige la forma de pago más conveniente para disfrutar de nuestros servicios de alojamiento.</p>

    <div class="row g-4">
      <!-- Pago con Tarjeta -->
      <div class="col-12 col-sm-6 col-md-4">
        <div class="card shadow-sm h-100 text-center">
          <div class="card-body">
            <i class="bi bi-credit-card-2-front fs-1 text-primary mb-3"></i>
            <h5 class="card-title">Tarjeta de Crédito/Débito</h5>
            <p class="card-text">Aceptamos Visa, MasterCard y American Express de manera segura.</p>
          </div>
        </div>
      </div>

      <!-- Transferencia Bancaria -->
      <div class="col-12 col-sm-6 col-md-4">
        <div class="card shadow-sm h-100 text-center">
          <div class="card-body">
            <i class="bi bi-bank fs-1 text-success mb-3"></i>
            <h5 class="card-title">Transferencia Bancaria</h5>
            <p class="card-text">Puedes realizar una transferencia desde tu banco directamente a nuestra cuenta.</p>
          </div>
        </div>
      </div>

      <!-- Pago en Línea -->
      <div class="col-12 col-sm-6 col-md-4">
        <div class="card shadow-sm h-100 text-center">
          <div class="card-body">
            <i class="bi bi-wallet2 fs-1 text-warning mb-3"></i>
            <h5 class="card-title">Pago en Línea</h5>
            <p class="card-text">Utiliza plataformas como PayPal para pagar de forma rápida y confiable.</p>
          </div>
        </div>
      </div>

      <!-- Pago en Efectivo -->
      <div class="col-12 col-sm-6 col-md-4">
        <div class="card shadow-sm h-100 text-center">
          <div class="card-body">
            <i class="bi bi-cash-stack fs-1 text-dark mb-3"></i>
            <h5 class="card-title">Pago en Efectivo</h5>
            <p class="card-text">Puedes realizar tu pago en efectivo al momento de tu llegada.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap Icons (para los íconos de pago) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <footer class="bg-dark text-light pt-5 pb-4" id="footer">
    <div class="container text-center text-md-start">
      <div class="row">

        <!-- Logo / Nombre -->
        <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mb-4">
          <h5 class="fw-bold text-uppercase mb-4">Alojamientos El Paraíso</h5>
          <p>
            Vive una experiencia única con nuestras habitaciones y servicios de primer nivel.
          </p>
        </div>

        <!-- Enlaces -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <h6 class="fw-bold text-uppercase mb-4">Enlaces</h6>
          <p><a href="#" class="text-reset text-decoration-none">Inicio</a></p>
          <p><a href="#" class="text-reset text-decoration-none">Habitaciones</a></p>
          <p><a href="#" class="text-reset text-decoration-none">Reservas</a></p>
          <p><a href="#" class="text-reset text-decoration-none">Contacto</a></p>
        </div>

        <!-- Contacto -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <h6 class="fw-bold text-uppercase mb-4">Contacto</h6>
          <p><i class="bi bi-house-door me-2"></i> San Miguel, El Salvador</p>
          <p><i class="bi bi-envelope me-2"></i> info@alojamientos.com</p>
          <p><i class="bi bi-phone me-2"></i> +503 7777-7777</p>
        </div>

        <!-- Redes sociales -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4 text-center">
          <h6 class="fw-bold text-uppercase mb-4">Síguenos</h6>
          <a href="#" class="btn btn-outline-light btn-floating m-1 rounded-circle"><i class="bi bi-facebook"></i></a>
          <a href="#" class="btn btn-outline-light btn-floating m-1 rounded-circle"><i class="bi bi-instagram"></i></a>
          <a href="#" class="btn btn-outline-light btn-floating m-1 rounded-circle"><i class="bi bi-twitter"></i></a>
        </div>
      </div>
    </div>

    <!-- Línea inferior -->
    <div class="text-center p-3 border-top border-secondary mt-3">
      © 2025 Alojamientos El Paraíso | Todos los derechos reservados
    </div>
  </footer>

</body>

</html>