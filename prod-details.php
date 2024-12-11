<?php session_start();
    if(!isset($_SESSION['user_data'])){
        header("Location: ./login.php");
    }
    $user_data = $_SESSION['user_data'];
?>

<?php 
    include "./php/conexion.php";
    $sql="select * from products order by product_id";
    $res= $conexion->query($sql) or die($conexion->error);
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
</head>

<body>

    <div class="d-flex">
        <!-- SIDEBAR -->
        <?php include "./layouts/aside.php"; ?>
        <!--END  SIDEBAR -->
        <main class="flex-grow-1">
            <!-- HEADER -->
            <?php include "./layouts/header.php"; ?>
            <!-- END HEADER -->
            <!-- TITLE SECTION -->
            <div class="mx-4 d-flex justify-content-between">
                <h1 class="h4">Detalles de Productos</h1>
                <div>
                    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalAdd">Agregar</button>
                </div>

            </div>
            <!-- END TITLE SECTION -->
            <section class="mt-4 p-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">PRECIO</th>
                            <th scope="col">STOCK</th>
                            <th scope="col">CATEGORIA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php   
                            while($fila = mysqli_fetch_array($res)){
                        ?>
                        <tr>
                            <td>
                                <?php echo $fila['product_id']  ?>
                            </td>
                            <td>
                                <?php echo $fila['nombre']  ?>
                            </td>
                            <td>
                                <?php echo $fila['precio']  ?>
                            </td>
                            <td>
                                <?php echo $fila['stock'] ?>
                            </td>
                            <td>
                                <?php echo $fila['categoria_id']  ?>
                            </td>
                            <td class="text-end">
                                <form action="./php/delete-product.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="prod_id" value="<?php echo $fila['product_id']; ?>">
                                    <button type="submit" class="btn btn-outline-danger btn-sm"
                                        onclick="return confirm('¿Estás seguro de eliminar este producto?')">
                                        <i class="bi bi-trash2"></i>
                                    </button>
                                </form>
                                <button class="btn btn-outline-warning btn-sm mx-2 btnEdit"
                                    data-name="<?php echo htmlspecialchars($fila['nombre'], ENT_QUOTES, 'UTF-8'); ?>"
                                    data-id="<?php echo htmlspecialchars($fila['product_id'], ENT_QUOTES, 'UTF-8'); ?>"
                                    data-description="<?php echo htmlspecialchars($fila['descripcion'], ENT_QUOTES, 'UTF-8'); ?>"
                                    data-categoria="<?php echo htmlspecialchars($fila['categoria_id'], ENT_QUOTES, 'UTF-8'); ?>"
                                    data-precio="<?php echo htmlspecialchars($fila['precio'], ENT_QUOTES, 'UTF-8'); ?>"
                                    data-stock="<?php echo htmlspecialchars($fila['stock'], ENT_QUOTES, 'UTF-8'); ?>"
                                    data-marca="<?php echo htmlspecialchars($fila['marca'], ENT_QUOTES, 'UTF-8'); ?>"
                                    data-modelo="<?php echo htmlspecialchars($fila['modelo'], ENT_QUOTES, 'UTF-8'); ?>"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalProdEdit">
                                    <i class="bi bi-pen"></i>
                                </button>

                                <button class="btn btn-outline-dark btn-sm">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <?php }  ?>
                    </tbody>
                </table>
            </section>

        </main>

    </div>

    <!-- Modal -->
    <div class="modal fade modal-lg" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="./php/add-product.php" enctype="multipart/form-data" method="post"
                    class="needs-validation" novalidate id="form">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label for="">Nombre:</label>
                                <input name="txtName" id="" required type="text" class="form-control"
                                    placeholder="Inserta el nombre">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>
                            <div class="col-6 mb-2">
                                <label for="">Descripcion:</label>
                                <input name="txtDescription" required type="text" class="form-control"
                                    placeholder="Inserta la descripción">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label for="">Precio</label>
                                <input name="txtPrecio" required type="number" class="form-control"
                                    placeholder="Inserta el precio">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>
                            <div class="col-6 mb-2">
                                <label for="">Imágen</label>
                                <input accept="image/*" name="txtFile" required type="file" class="form-control">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label for="">Categoria</label>
                                <select name="txtCategoria" class="form-control" id="">
                                    <option value="1">All Uses</option>
                                    <option value="2">Desktop</option>
                                </select>
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>
                            <div class="col-6 mb-2">
                                <label for="">Marca</label>
                                <input name="txtMarca" required type="text" class="form-control"
                                    placeholder="Inserta la marca">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label for="">Stock</label>
                                <input name="txtStock" required type="number" class="form-control"
                                    placeholder="Inserta el Stock">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>
                            <div class="col-6 mb-2">
                                <label for="">Modelo</label>
                                <input name="txtModelo" required type="text" class="form-control"
                                    placeholder="Inserta el modelo">
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

    <!-- Modal Edit -->
<div class="modal fade modal-lg" id="modalProdEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Producto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="./php/edit-product.php" enctype="multipart/form-data" method="post" class="needs-validation" novalidate id="form">
                <div class="modal-body">
                    <input type="text" id="txtIdEdit" name="txtId">
                    <div class="row">
                        <div class="col-6 mb-2">
                            <label for="">Nombre:</label>
                            <input name="txtName" id="txtNameEdit" required type="text" class="form-control" placeholder="Inserta el nombre">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Datos no validos</div>
                        </div>
                        <div class="col-6 mb-2">
                            <label for="">Descripcion:</label>
                            <input name="txtDescription" id="txtDescripcionEdit" required type="text" class="form-control" placeholder="Inserta la descripción">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Datos no validos</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-2">
                            <label for="">Precio</label>
                            <input name="txtPrecio" id="txtPrecioEdit" required type="number" class="form-control" placeholder="Inserta el precio">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Datos no validos</div>
                        </div>
                        <div class="col-6 mb-2">
                            <label for="">Imágen</label>
                            <input accept="image/*" name="txtFile" type="file" class="form-control">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Datos no validos</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-2">
                            <label for="">Categoria</label>
                            <select name="txtCategoria" id="txtCategoriaEdit" class="form-control">
                                <option value="1">All Uses</option>
                                <option value="2">Desktop</option>
                            </select>
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Datos no validos</div>
                        </div>
                        <div class="col-6 mb-2">
                            <label for="">Marca</label>
                            <input name="txtMarca" id="txtMarcaEdit" required type="text" class="form-control" placeholder="Inserta la marca">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Datos no validos</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-2">
                            <label for="">Stock</label>
                            <input name="txtStock" id="txtStockEdit" required type="number" class="form-control" placeholder="Inserta el Stock">
                            <div class="valid-feedback">Correcto</div>
                            <div class="invalid-feedback">Datos no validos</div>
                        </div>
                        <div class="col-6 mb-2">
                            <label for="">Modelo</label>
                            <input name="txtModelo" id="txtModeloEdit" required type="text" class="form-control" placeholder="Inserta el modelo">
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



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="./js/products.js"></script>
</body>

</html>