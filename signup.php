<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Registro</title>
    <link rel="preload" href="./css/styles.css">
    <link rel="preload" href="./css/mediaquery.css">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/mediaquery.css">
</head>
<body>
    <div class="login-container">
        <div class="image-section">
            <img src="./img/login-resize.webp" alt="Laptop-image">
        </div>
        <div class="form-section">
            <h1>Registro</h1>
            <?php if(isset($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            <form id="signupForm" method="POST" action="">
                <label for="name">Nombre:</label>
                <div class="input-group">
                    <input type="text" id="name" name="name" placeholder="Introduce tu nombre" required>
                </div>

                <label for="email">Email:</label>
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="Introduce tu email" required>
                </div>

                <label for="telefono">Teléfono (opcional):</label>
                <div class="input-group">
                    <input type="tel" id="telefono" name="telefono" placeholder="Introduce tu teléfono">
                </div>

                <label for="direccion">Dirección (opcional):</label>
                <div class="input-group">
                    <input type="text" id="direccion" name="direccion" placeholder="Introduce tu dirección">
                </div>

                <label for="password">Contraseña:</label>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Introduce tu contraseña" required>
                </div>

                <label for="confirm-password">Confirmar Contraseña:</label>
                <div class="input-group">
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirma tu contraseña" required>
                </div>

                <button type="submit">Registrarse</button>

                <p>Ya tienes cuenta? <a href="login.php">Inicia Sesión</a></p>
            </form>
        </div>
    </div>
</body>
</html>