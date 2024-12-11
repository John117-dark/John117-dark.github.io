<?php session_start();
    if(!isset($_SESSION['user_data'])){
        header("Location: ./login.php");
    }
    $user_data = $_SESSION['user_data'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
</head>
<body class="d-flex">
    <!-- SIDEBAR -->
    <?php include "./layouts/aside.php"; ?>
    <!-- END SIDEBAR -->
    <!-- MAIN CONTENT -->
    <main class="flex-grow-1">
        <?php include "./layouts/header.php"; ?>
        <section class="container mt-4 p-4">
            <h4>Bienvenido de nuevo</h4>
            <!--STATS-->
            <div class="row">
                <div class="col-3">
                    <div class="card" style="height: 100px;">
                        <div class="card-body ">
                            <label class="">
                                <i class="bi bi-wallet" style="color: #0052e0;"></i>
                                TOTAL INGRESOS MENSUALES
                            </label>
                            <h5 class="h2 text-center">$250.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card" style="height: 100px;">
                        <div class="card-body ">
                            <label class="">
                                <i class="bi bi-people" style="color: #0052e0;"></i>
                                USUARIOS ACTIVOS
                            </label>
                            <h5 class="h2 text-center">250</h5>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card" style="height: 100px;">
                        <div class="card-body ">
                            <label class="">
                                <i class="bi bi-cash" style="color: #0052e0;"></i>
                                USUARIOS POR PAGAR
                            </label>
                            <h5 class="h2 text-center">3</h5>
                        </div>
                    </div>

                </div>
                <div class="col-3">
                    <div class="card" style="height: 100px;">
                        <div class="card-body ">
                            <label class="">
                                <i class="bi bi-laptop" style="color: #0052e0;"></i>
                                TOTAL COMPUTADORAS
                            </label>
                            <h5 class="h2 text-center">32</h5>
                        </div>
                    </div>
                </div>

            </div>
            <!--STATS-->
            <!--CHARTS-->
            <div class="row mt-4">
                <div class="col-6">
                    <div class="card" style="height: 300px;">
                        <div class="card-header">
                            INGRESOS POR MES
                        </div>
                        <div class="card-body">
                            <canvas id="chartIngresos"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card" style="height: 300px;">
                        <div class="card-header">
                            COMPUTADORAS POR CATEGORÍA
                        </div>
                        <div class="card-body">
                            <canvas id="chartCategorias"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!--CHARTS-->


        </section>
    </main>
    <!--END MAIN CONTENT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>  
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="./js/script.js"></script>

</body>
</html>