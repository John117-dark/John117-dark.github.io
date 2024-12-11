<?php
include "./conexion.php";

// Validar y asignar los datos del formulario
$nombre = $_POST['txtName'];
$email = $_POST['txtEmail'];
$password = $_POST['txtPassword'];
$level = $_POST['txtLevel'];
$telefono = $_POST['txtTelefono'];
$direccion = $_POST['txtDireccion'];
$img = $_FILES['txtFile']['name'];
$temp = explode(".",$img);
$ext = end($temp);
$new_name=date('Y_m_d_h_i_s').rand(1000,9999).".".$ext;
$destiny="../img/pfp/";

// Validar campos obligatorios
if (empty($nombre) || empty($email) || empty($password)) {
    die("Los campos Nombre, Correo y Contraseña son obligatorios.");
}

if(move_uploaded_file($_FILES['txtFile']['tmp_name'],$destiny.$new_name)){
    echo "Archivo subido correctamente";
    $consulta = "INSERT INTO users (name, email, password, img, level, telefono, direccion) 
                 VALUES ('$nombre', '$email', '$password', '$new_name', $level, '$telefono', '$direccion')";
    echo $consulta;
    $conexion->query($consulta) or die($conexion->error);
    echo "\n Registro insertado correctamente";
    header("Location: ../users.php");
}else{
    echo "No se pudo subir el archivo";
}



// Manejo de la imagen
//$img = 'default.jpg'; // Imagen por defecto


// Ejecutar la consulta
//if (mysqli_query($conexion, $consulta)) {
    //echo "Usuario agregado exitosamente.";
    //header("Location: ../users.php");
//} else {
    //echo "Error al agregar el usuario: " . mysqli_error($conexion);
//}

mysqli_close($conexion);
?>
