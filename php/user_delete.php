<?php
session_start();
if(!isset($_SESSION['user_data'])){
    header("Location: ./login.php");
    exit();
}

include "./conexion.php";

// Verificar si se ha enviado el ID del usuario
if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    // Evitar inyecciones SQL utilizando consultas preparadas
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $user_id); // "i" es el tipo para enteros
    $stmt->execute();

    // Verificar si la eliminación fue exitosa
    if ($stmt->affected_rows > 0) {
        // Redirigir a la página de usuarios con un mensaje de éxito
        $_SESSION['message'] = "Usuario eliminado correctamente.";
        header("Location: ../users.php");
    } else {
        // En caso de error, redirigir con un mensaje de error
        $_SESSION['message'] = "Error al eliminar el usuario.";
        header("Location: ../users.php");
        
    }

    $stmt->close();
} else {
    // Si no se pasa un ID de usuario, redirigir a la página principal
    $_SESSION['message'] = "No se proporcionó un ID de usuario.";
    header("Location: dietasNuevo/users.php");
}

$conexion->close();
?>
