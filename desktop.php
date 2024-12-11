<?php session_start();
    if(!isset($_SESSION['user_data'])){
        header("Location: ./login.php");
    }
    $user_data = $_SESSION['user_data'];
?>

<?php 
    include "./php/conexion.php";
    $sql = "select * from products where categoria_id = 2 order by product_id desc";
    $res= $conexion->query($sql) or die($conexion->error);
    $sql_cat="select * from categorias order by categoria_id DESC";
    $res_cat= $conexion->query($sql_cat) or die($conexion->error);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <link rel="preload" href="./css/styles.css">
    <link rel="preload" href="./css/mediaquery.css">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/mediaquery.css">
    <link rel="preload" src="./img/land-resize.webp">
</head>
<body>
    
    <div class="d-flex">
        <main class="flex-grow-1">
             <!-- HEADER -->
             <?php include "./layouts/header.php"; ?>
            <!-- END HEADER -->
            <!-- TITLE SECTION -->
            <div class="mx-4 d-flex justify-content-between">
                <h1 class="h4">Computadoras</h1>
                <div>
                    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalAdd">Agregar</button>
                </div>

            </div>
            <!-- END TITLE SECTION -->
            <section class="p-4 container">
                <div class="row">

                <?php   
                    while($fila = mysqli_fetch_array($res)){
                ?>

                    <div class="col-3 mt-2 p-2">
                        <div class="card">
                            <img src="./img/productos/<?php echo $fila['img'] ?>" height="150px"  class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title"><?php echo $fila['nombre']  ?></h5>
                              <p class="card-text"><?php echo $fila['descripcion']  ?></p>
                              <a href="#" class="btn btn-dark w-100">Ver producto</a>
                            </div>
                        </div>
                    </div>
                    <?php }  ?>
                </div>

            </section>
            
        </main>

    </div>
  
    <div class="modal fade modal-lg" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Producto</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="./php/add-product.php" enctype="multipart/form-data" method="post"  class="needs-validation" novalidate id="form">
            <div class="modal-body">
                <div class="row">
                    <div class="col-6 mb-2">
                        <label for="">Nombre:</label>
                        <input name="txtName" id="" required type="text" class="form-control" placeholder="Inserta el nombre">
                        <div class="valid-feedback">Correcto</div>
                        <div class="invalid-feedback">Datos no validos</div>
                    </div>
                    <div class="col-6 mb-2">
                        <label for="">Descripcion:</label>
                        <input name="txtDescription" required type="text" class="form-control" placeholder="Inserta la descripción">
                        <div class="valid-feedback">Correcto</div>
                        <div class="invalid-feedback">Datos no validos</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mb-2">
                        <label for="">Precio</label>
                        <input name="txtPrecio" required  type="number" class="form-control" placeholder="Inserta el precio" >
                        <div class="valid-feedback">Correcto</div>
                        <div class="invalid-feedback">Datos no validos</div>
                    </div>
                    <div class="col-6 mb-2">
                        <label for="">Imágen</label>
                        <input accept="image/*" name="txtFile" required type="file" class="form-control" >
                        <div class="valid-feedback">Correcto</div>
                        <div class="invalid-feedback">Datos no validos</div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-6 mb-2">
                        <label for="">Categoria</label>
                        <select name="txtCategoria" class="form-control" id="">
                        <?php   
                    while($fila2 = mysqli_fetch_array($res_cat)){
                ?>
                <option value="<?php echo $fila2['categoria_id'] ?>"><?php echo $fila2['nombre'] ?></option>
                    <?php } ?> 
                        </select>
                        <div class="valid-feedback">Correcto</div>
                        <div class="invalid-feedback">Datos no validos</div>
                    </div>
                    <div class="col-6 mb-2">
                        <label for="">Marca</label>
                        <input name="txtMarca" required  type="text" class="form-control" placeholder="Inserta la marca" >
                        <div class="valid-feedback">Correcto</div>
                        <div class="invalid-feedback">Datos no validos</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mb-2">
                        <label for="">Stock</label>
                        <input name="txtStock" required  type="number" class="form-control" placeholder="Inserta el Stock" >
                        <div class="valid-feedback">Correcto</div>
                        <div class="invalid-feedback">Datos no validos</div>
                    </div>
                    <div class="col-6 mb-2">
                        <label for="">Modelo</label>
                        <input name="txtModelo" required type="text" class="form-control" placeholder="Inserta el modelo">
                        <div class="valid-feedback">Correcto</div>
                        <div class="invalid-feedback">Datos no validos</div>
                    </div>
                    
                </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-dark" id="btnSave">Guardar</button>
            </div>
        </form>
      </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script  src="./js/users.js"></script>
</body>
</html>