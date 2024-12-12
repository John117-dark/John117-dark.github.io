<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    
    <link rel="preload" href="./css/styles.css">
    <link rel="preload" href="./css/mediaquery.css">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/mediaquery.css">

</head>
<body class="d-flex justify-content-center">
<div class="login-container">
        <div class="image-section">
            <img src="./img/login-resize.webp" alt="Laptop-image">
        </div>
        <div class="form-section">
            <h1>Bienvenido</h1>
            <form id="loginForm" action="./php/login.php" method="POST"  class="row" >
                <label for="email">Email:</label>
                <div class="input-group">
                    <input type="email" id="email" name="txtEmail" placeholder="Introduce tu email" required>
                </div>

                <label for="password">Contraseña:</label>
                <div class="input-group">
                    <input type="password" id="password" name="txtPassword" placeholder="Introduce tu contraseña" required>
                </div>

                <button type="submit">Log-In</button>

                <p>No tienes cuenta? <a href="signup.php">Regístrate</a></p>
            </form>
            <div class="back-to-home">
                <a href="main.html"><button type="button">Volver al Inicio</button></a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php 
        if(isset($_GET['error'])){
    ?>
                <script>
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Datos no validos",
                    });
                </script>
    <?php  } ?>

   
</body>
</html>