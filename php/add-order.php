<?php
session_start();
include 'conexion.php';

// Check if user is authenticated
if (!isset($_SESSION['user_data'])) {
    echo json_encode([
        'status' => 'error', 
        'message' => 'Usuario no autenticado'
    ]);
    exit;
}

// Rest of your order creation logic
$user_id = $_SESSION['user_data']['id']; // Assuming you store user_id in session

// Fetch all available products
function getProductsList($conexion) {
    $query = "SELECT product_id, nombre, descripcion, precio, img, stock FROM products WHERE stock > 0";
    $result = mysqli_query($conexion, $query);
    $products = [];
    
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
    
    return $products;
}

// Validate and insert order
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate input
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $cantidad = isset($_POST['cantidad']) ? floatval($_POST['cantidad']) : 0;

    // Validate product
    $product_query = "SELECT precio, stock FROM products WHERE product_id = ?";
    $stmt = mysqli_prepare($conexion, $product_query);
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($product = mysqli_fetch_assoc($result)) {
        // Check if requested quantity is available
        if ($cantidad > $product['stock']) {
            die(json_encode(['status' => 'error', 'message' => 'Cantidad supera el stock disponible']));
        }

        // Calculate total
        $total = $cantidad * $product['precio'];

        // Insert order
        $insert_query = "INSERT INTO ordenes (usuario_id, product_id, fecha, cantidad, estado, total) 
                         VALUES (?, ?, CURDATE(), ?, 'Pendiente', ?)";
        $insert_stmt = mysqli_prepare($conexion, $insert_query);
        mysqli_stmt_bind_param($insert_stmt, "iids", $usuario_id, $product_id, $cantidad, $total);
        
        if (mysqli_stmt_execute($insert_stmt)) {
            // Update product stock
            $update_stock_query = "UPDATE products SET stock = stock - ? WHERE product_id = ?";
            $update_stmt = mysqli_prepare($conexion, $update_stock_query);
            mysqli_stmt_bind_param($update_stmt, "di", $cantidad, $product_id);
            mysqli_stmt_execute($update_stmt);

            echo json_encode(['status' => 'success', 'message' => 'Orden creada exitosamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al crear la orden']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Producto no encontrado']);
    }
    exit;
}
?>