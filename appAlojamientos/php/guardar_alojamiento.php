<?php
include_once('../conf/conf.php'); // tu conexión a la BD

// Obtener datos del formulario
$titulo      = $_POST['titulo'] ?? "";
$descripcion = $_POST['descripcion'] ?? "";
$departamento = $_POST['departamento'] ?? "";
$direccion   = $_POST['direccion'] ?? "";
$precio      = $_POST['precio'] ?? "";

// Manejo de imagen
if(isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK){
    $nombreArchivo = $_FILES['img']['name'];
    $tmpArchivo    = $_FILES['img']['tmp_name'];
    $destino       = "../public/imgAlojamientos/" . $nombreArchivo;

    // Mover archivo a carpeta de uploads
    if(!move_uploaded_file($tmpArchivo, $destino)){
        die("Error al subir la imagen.");
    }
} else {
    die("No se subió ninguna imagen.");
}

// Insertar en la base de datos
$sql = "INSERT INTO alojamientos (titulo, descripcion, img, departamento, direccion, precio)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("sssssd", $titulo, $descripcion, $nombreArchivo, $departamento, $direccion, $precio);

if($stmt->execute()){
    // Éxito → redirigir al listado con mensaje
    header("Location: ../vistas/panel.php?msg=1");
    exit();
} else {
    echo "Error al registrar alojamiento: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>
