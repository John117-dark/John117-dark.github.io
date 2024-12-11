<?php 
session_start();
include "./conexion.php";

$email = $_POST['txtEmail'];
$password = $_POST['txtPassword'];

// Query to check email and password
$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$res = $conexion->query($sql) or die($conexion->error);

if (mysqli_num_rows($res) > 0) {
    echo "LOGIN CORRECTO <br>";
    $fila = mysqli_fetch_row($res); // Fetch the first row
    $id = $fila[0];
    $name = $fila[1];
    $email = $fila[2];
    $level = $fila[5];
    $img = $fila[4];

    // Store user data in the session
    $_SESSION['user_data'] = [
        'id' => $id,
        'name' => $name,
        'email' => $email,
        'level' => $level,
        'img' => $img,
    ];

    // Redirect based on the user's level
    if ($level == 1) {
        header('Location: ../admin.php'); // Redirect to admin page
    } elseif ($level == 0) {
        header('Location: ../main.php'); // Redirect to main page
    } else {
        echo "NIVEL NO VÁLIDO";
        header("Location: ../login.php?error=1"); // Redirect with error
    }
} else {
    echo "DATOS NO VÁLIDOS";
    header("Location: ../login.php?error=1"); // Redirect with error
}
?>
