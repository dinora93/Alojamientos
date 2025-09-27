<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <title>Cuenta</title>
</head>
<body>
 
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="font-size:15px;">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">AireHome</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../index.php">Alojamientos</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>
<div class="container d-flex justify-content-center align-items-center vh-100">
  <div class="row w-100 shadow-lg rounded-4 overflow-hidden" style="max-width: 900px;">
<?php if(isset($_GET['error']) && $_GET['error'] == 1): ?>
<div class="container mt-3">
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    ❌ Correo o contraseña incorrectos.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
</div>
<?php endif; ?>
    <!-- Iniciar Sesión -->
    <div class="col-md-6 bg-primary text-white p-5 d-flex flex-column justify-content-center">
      <h2 class="fw-bold mb-4 text-center">Bienvenido</h2>
      <p class="text-center mb-4">Inicia sesión para continuar explorando alojamientos increíbles.</p>
      <form action="../php/validacion.php" method="POST">
        <div class="mb-3">
             <input type="text" value="1" name="bandera" hidden>
          <label for="loginEmail" class="form-label"><i class="bi bi-envelope me-2"></i>Correo electrónico</label>
          <input type="email" class="form-control rounded-pill" id="loginEmail" name="correo" placeholder="ejemplo@correo.com" required autocomplete="off">
        </div>
        <div class="mb-3">
          <label for="loginPassword" class="form-label"><i class="bi bi-lock me-2"></i>Contraseña</label>
          <input type="password" class="form-control rounded-pill" id="loginPassword" name="pwd" placeholder="********" required>
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-light rounded-pill fw-bold">Ingresar</button>
        </div>
      </form>
    </div>

    <!-- Registrarse -->
    <div class="col-md-6 bg-white p-5 d-flex flex-column justify-content-center">
      <h2 class="fw-bold mb-4 text-center text-primary">Crear cuenta</h2>
      <form action="../php/validacion.php" method="POST">
        <div class="mb-3">
         <input type="text" value="2" name="bandera" hidden>
          <label for="registerName" class="form-label"><i class="bi bi-person me-2"></i>Nombre completo</label>
          <input type="text" class="form-control rounded-pill" id="registerName" name="nombre" placeholder="Tu nombre" required autocomplete="off">
        </div>
        <div class="mb-3">
          <label for="registerEmail" class="form-label"><i class="bi bi-envelope me-2"></i>Correo electrónico</label>
          <input type="email" class="form-control rounded-pill" id="registerEmail" name="correo" placeholder="ejemplo@correo.com" autocomplete="off">
        </div>
        <div class="mb-3">
          <label for="registerPassword" class="form-label"><i class="bi bi-lock me-2"></i>Contraseña</label>
          <input type="password" class="form-control rounded-pill" name="pwd" id="registerPassword" placeholder="********" required>
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-primary rounded-pill fw-bold">Registrarse</button>
        </div>
      </form>
    </div>

  </div>
</div>
</body>
</html>