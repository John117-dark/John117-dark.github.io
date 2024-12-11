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
                    <li><a href="./main.php">Home</a></li>
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
                                <a href="./php/logout.php" class="dropdown-item">
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