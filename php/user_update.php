<?php
include "./conexion.php";

// Validar y asignar los datos del formulario
$nombre = $_POST['txtNameEdit'];
$email = $_POST['txtEmailEdit'];
$password = $_POST['txtPassword'];
$level = $_POST['txtLevelEdit'];
$telefono = $_POST['txtTelefonoEdit'];
$direccion = $_POST['txtDireccionEdit'];
$id = $_POST['txtIdEdit'];  

$consulta = "update users set name='$nombre', email='$email', level='$level', telefono='$telefono', direccion='$direccion' where id='$id'";

$conexion->query($consulta) or die($conexion->error);

if (mysqli_query($conexion, $consulta)) {
    echo "dato actualizado correctamente";
    header("Location: ../users.php");
} else {
    echo "Error al agregar el usuario: " . mysqli_error($conexion);
}

?>