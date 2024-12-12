<?php session_start();
    if(!isset($_SESSION['user_data'])){
        header("Location: ./login.php");
    }
    $user_data = $_SESSION['user_data'];
?>

<?php 
    include "./php/conexion.php";
    $sql = "select * from products where categoria_id = 3 order by product_id desc";
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
  
    <!-- MODAL FOR ADDING ORDERS -->
    <div class="modal fade modal-lg" id="modalAddOrder" tabindex="-1" aria-labelledby="addOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addOrderModalLabel">Crear Nueva Orden</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="orderForm" method="post" class="needs-validation" novalidate>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="productSelect" class="form-label">Seleccionar Producto</label>
                            <select id="productSelect" name="product_id" class="form-control" required>
                                <option value="">Seleccione un producto</option>
                                <!-- Products will be dynamically populated here -->
                            </select>
                            <div class="invalid-feedback">Por favor seleccione un producto</div>
                        </div>
                    </div>
                    
                    <div id="productDetails" class="row" style="display:none;">
                        <div class="col-6">
                            <img id="productImage" src="" class="img-fluid" alt="Imagen del producto">
                        </div>
                        <div class="col-6">
                            <p><strong>Descripción:</strong> <span id="productDescription"></span></p>
                            <p><strong>Precio:</strong> $<span id="productPrice"></span></p>
                            <p><strong>Stock Disponible:</strong> <span id="productStock"></span></p>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 mb-3">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad" 
                                   min="1" required>
                            <div class="invalid-feedback">Ingrese una cantidad válida</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-dark" id="btnCreateOrder">Crear Orden</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const productSelect = document.getElementById('productSelect');
    const productDetails = document.getElementById('productDetails');
    const productImage = document.getElementById('productImage');
    const productDescription = document.getElementById('productDescription');
    const productPrice = document.getElementById('productPrice');
    const productStock = document.getElementById('productStock');
    const orderForm = document.getElementById('orderForm');
    const cantidad = document.getElementById('cantidad');

    // Fetch and populate products
    function loadProducts() {
        fetch('./php/get_products.php')
            .then(response => response.json())
            .then(products => {
                productSelect.innerHTML = '<option value="">Seleccione un producto</option>';
                products.forEach(product => {
                    const option = document.createElement('option');
                    option.value = product.product_id;
                    option.textContent = product.nombre;
                    productSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error', 'No se pudieron cargar los productos', 'error');
            });
    }

    // Product selection event
    productSelect.addEventListener('change', function() {
        const selectedProductId = this.value;
        
        if (selectedProductId) {
            fetch(`./php/get_product_details.php?product_id=${selectedProductId}`)
                .then(response => response.json())
                .then(product => {
                    productImage.src = product.img; // Now uses the full path from PHP
                    productDescription.textContent = product.descripcion;
                    productPrice.textContent = product.precio;
                    productStock.textContent = product.stock;
                    
                    // Set max quantity to available stock
                    cantidad.max = product.stock;
                    cantidad.min = 1;
                    
                    productDetails.style.display = 'flex';
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'No se pudieron cargar los detalles del producto', 'error');
                });
        } else {
            productDetails.style.display = 'none';
        }
    });

    // Order submission
    orderForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Client-side validation
        if (!this.checkValidity()) {
            e.stopPropagation();
            this.classList.add('was-validated');
            return;
        }

        const formData = new FormData(this);

        fetch('./php/add-order.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                Swal.fire('Éxito', data.message, 'success')
                    .then(() => {
                        // Reload page or update orders list
                        location.reload();
                    });
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error', 'Ocurrió un error al crear la orden', 'error');
        });
    });

    // Initial load of products
    loadProducts();
});
</script>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</body>
</html>