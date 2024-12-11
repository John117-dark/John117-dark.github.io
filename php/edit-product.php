<?php
include "./conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and assign form data
    $nombre = $_POST['txtName'];
    $descripcion = $_POST['txtDescription'];
    $precio = $_POST['txtPrecio'];
    $stock = $_POST['txtStock'];
    $marca = $_POST['txtMarca'];
    $modelo = $_POST['txtModelo'];
    $categoria = $_POST['txtCategoria'];
    $id = $_POST['txtId'];

    $consulta = "
        UPDATE products 
        SET 
            nombre='$nombre', 
            descripcion='$descripcion', 
            precio='$precio', 
            stock='$stock', 
            marca='$marca', 
            modelo='$modelo', 
            categoria_id='$categoria' 
        WHERE product_id='$id'
    ";

    // Execute the query and handle errors
    if ($conexion->query($consulta)) {
        echo "Dato actualizado correctamente";
        header("Location: ../prod-details.php");
    } else {
        die("Error al actualizar: " . $conexion->error);
    }
} else {
    die("Método no permitido");
}
?>
