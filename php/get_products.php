<?php
include 'conexion.php'; // Your database connection file

header('Content-Type: application/json');

$query = "SELECT product_id, nombre FROM products WHERE stock > 0";
$result = mysqli_query($conexion, $query);

$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}

echo json_encode($products);
?>