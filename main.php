<?php session_start();
    if(!isset($_SESSION['user_data'])){
        header("Location: ./login.php");
    }
    $user_data = $_SESSION['user_data'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartTech</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <link rel="preload" href="./css/styles.css">
    <link rel="preload" href="./css/mediaquery.css">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/mediaquery.css">
    <link rel="preload" src="./img/land-resize.webp">
</head>
<body>
<header class="pt-4">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">

            <div class="logo">SmartTech</div>

            <div class="burger">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <div class="nav-links">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Explore</a></li>
                    <li><a href="#">Service</a></li>
                    <li><a href="#">Shop</a></li>
                </ul>
            </div>
            
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="navbar-item mx-4">
                        <button type="button" class="btn btn-ligth position-relative">
                            <i class="bi bi-bell"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                99+
                                <span class="visually-hidden">unread messages</span>
                            </span>
                            </button>
                    </li>
                    <li class="navbar-item mx-1">
                        <img style="border:3px solid rgb(8, 90, 8);width: 40px; height: 40px;border-radius: 50%;"  src="./img/pfp/<?php echo $user_data['img'] ?>" alt="">
                    </li>
                    <li class="navbar-item dropdown">
                        <a href="" class="nav-link dropdown-toggle" 
                            id="userDropdown" role="button" 
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $user_data['name'].' - '.$user_data['email'];  ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a href="" class="dropdown-item"> 
                                    <i class="bi bi-person"></i> 
                                    Perfil
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li>
                                <a href="" class="dropdown-item">
                                    <i class="bi bi-box-arrow-left"></i>
                                    Cerrar Sesión
                                </a>
                            </li>


                        </ul>

                    </li>
                    
                </ul>
            </div>



        </div>
    </nav>
</header>

    <section class="hero">
        <div class="hero-content">
            <h1>Encuentra tu próximo dispositivo</h1>
            <p>Te recomendamos elegir algún tipo de uso para recomendar algún dispositivo.</p>
            <a href="#" class="btn">Explorar categorías</a>
        </div>
        <div class="hero-image">
            <img src="./img/land-resize.webp" alt="Laptop-image">
        </div>
    </section>

    <section class="categories">
        <h2>Categorías</h2>
        <div class="categories-container">
            <a href="./work.php" class="category work">
                    <div class="category work">
                    <div class="label">Work</div>
                    <img src="./img/work.webp" alt="Work">
                </div>
            </a>
            <a href="./desktop.php" class="category desktop">
                <div class="category desktop">
                    <div class="label">Desktop</div>
                    <img src="./img/desktop.webp" alt="Desktop">
                </div>
            </a>
            <a href="./all_uses.php" class="category all-uses">
                <div class="category all-uses">
                    <div class="label">All uses</div>
                    <img src="./img/all-uses.webp" alt="All uses">
                </div>
            </a>
            <a href="./gaming.php" class="category gaming">
                <div class="category gaming">
                    <div class="label">Gaming</div>
                    <img src="./img/gaming.webp" alt="Gaming">
                </div>
            </a>
        </div>
    </section>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>  
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="./script.js"></script>
</body>
</html>