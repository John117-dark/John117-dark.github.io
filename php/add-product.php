<?php
include "./conexion.php";

$nombre = $_POST['txtName'];
$descripcion = $_POST['txtDescription'];
$precio = $_POST['txtPrecio'];
$stock = $_POST['txtStock'];
$marca = $_POST['txtMarca'];
$modelo = $_POST['txtModelo'];
$img = $_FILES['txtFile']['name'];
$temp = explode(".",$img);
$ext = end($temp);
$new_name=date('Y_m_d_h_i_s').rand(1000,9999).".".$ext;
$destiny="../img/productos/";

if(move_uploaded_file($_FILES['txtFile']['tmp_name'],$destiny.$new_name)){
    echo "Archivo subido correctamente";
    $consulta = "INSERT INTO products (nombre, descripcion, precio, stock, marca, modelo, img, categoria_id) 
        VALUES ('$nombre', '$descripcion', '$precio', '$stock', '$marca', '$modelo', '$new_name', 1)";
    echo $consulta;
    $conexion->query($consulta) or die($conexion->error);
    echo "\n Registro insertado correctamente";
    header("Location: ../dietas.php");
}else{
    echo "No se pudo subir el archivo";
}

die();

// Verifica si los campos necesarios están presentes
if (empty($nombre) || empty($descripcion) || empty($precio)) {
    die("Faltan datos obligatorios.");
}

// Construye la consulta SQL



if (mysqli_query($conexion, $consulta)) {
    echo "Producto agregado exitosamente.";
    header("Location: ./users.php");
} else {
    echo "Error al agregar el producto: " . mysqli_error($conexion);
}
?>
