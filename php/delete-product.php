<?php
session_start();
if(!isset($_SESSION['user_data'])){
    header("Location: ./login.php");
    exit();
}

include "./conexion.php";

// Verificar si se ha enviado el ID del usuario
if (isset($_POST['prod_id'])) {
    $prod_id = $_POST['prod_id'];

    // Evitar inyecciones SQL utilizando consultas preparadas
    $sql = "DELETE FROM products WHERE product_id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $prod_id); // "i" es el tipo para enteros
    $stmt->execute();

    // Verificar si la eliminación fue exitosa
    if ($stmt->affected_rows > 0) {
        // Redirigir a la página de usuarios con un mensaje de éxito
        $_SESSION['message'] = "Producto eliminado correctamente.";
        header("Location: ../prod-details.php");
    } else {
        // En caso de error, redirigir con un mensaje de error
        $_SESSION['message'] = "Error al eliminar el producto.";
        header("Location: ../prod-details.php");
        
    }

    $stmt->close();
} else {
    // Si no se pasa un ID de usuario, redirigir a la página principal
    $_SESSION['message'] = "No se proporcionó un ID de producto.";
    header("Location: dietasNuevo/users.php");
}

$conexion->close();
?>
