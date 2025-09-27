<?php
include_once('../conf/conf.php');

$nombre=isset($_POST['nombre']) ? $_POST['nombre']:"";
$correo=isset($_POST['correo']) ? $_POST['correo']:"";
$pwd=isset($_POST['pwd']) ? $_POST['pwd']:"";
$bandera=isset($_POST['bandera']) ? $_POST['bandera']:"";
$fecha = date("Y-m-d");
$rol=2;
$pwd_hash = password_hash($pwd, PASSWORD_DEFAULT);
if($bandera == 1){

$sql = "SELECT idusuario, nombre, correo, pwd, idrol FROM usuario WHERE correo = ? LIMIT 1";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $hash = $row['pwd'];

    
    if (password_verify($pwd, $hash)) {
       
        session_start();
        $_SESSION['idusuario'] = $row['idusuario'];
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['idrol'] = $row['idrol'];

       
         header("Location: ../vistas/panel.php"); exit();
    } else {
        header("Location: ../vistas/login.php?error=1");
    }
} else {
    echo "Correo o contraseña incorrectos.";
}

}else if($bandera ==2){

$sql = "INSERT INTO usuario (nombre, correo,pwd,idrol,fecha_registro) VALUES (?, ?, ?,?,?)";
$stmt = $conexion->prepare($sql);

$stmt->bind_param("sssis",$nombre, $correo, $pwd_hash,$rol,$fecha);
if ($stmt->execute()) {
     echo '
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1055">
      <div id="registroToast" class="toast align-items-center text-white bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body">
            ✅ Usuario registrado con éxito.
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>
    </div>

    <script>
      // Redirige después de 2 segundos
      setTimeout(function(){
        window.location.href = "../vistas/login.php";
      }, 2000);
    </script>
    ';
} else {
    echo "Error: " . $stmt->error;
}
}else {

}
 $stmt->close();
    $conexion->close();
?>