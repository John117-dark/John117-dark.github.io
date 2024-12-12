<?php
include 'conexion.php';

header('Content-Type: application/json');

$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

if ($product_id <= 0) {
    echo json_encode(['error' => 'ID de producto inválido']);
    exit;
}

$query = "SELECT product_id, nombre, descripcion, precio, stock, img FROM products WHERE product_id = ?";
$stmt = mysqli_prepare($conexion, $query);
mysqli_stmt_bind_param($stmt, "i", $product_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($product = mysqli_fetch_assoc($result)) {
    // Ensure the image path is web-accessible
    $product['img'] = !empty($product['img']) 
    ? (strpos($product['img'], 'http') === 0 
        ? $product['img'] 
        : './img/productos/' . $product['img']) 
        : './default-product.jpg';
    
    echo json_encode($product);
} else {
    echo json_encode(['error' => 'Producto no encontrado']);
}
?>