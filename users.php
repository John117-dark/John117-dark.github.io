<?php session_start();
    if(!isset($_SESSION['user_data'])){
        header("Location: ./login.php");
    }
    $user_data = $_SESSION['user_data'];
?>

<?php 
    include "./php/conexion.php";
    $sql="select * from users order by id DESC";
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
                <h1 class="h4">Usuarios</h1>
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
                            <th scope="col">EMAIL</th>
                            <th scope="col">PASSWORD</th>
                            <th scope="col">NIVEL</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php   
                            while($fila = mysqli_fetch_array($res)){
                        ?>
                        <tr>
                            <td>
                                <?php echo $fila['id']  ?>
                            </td>
                            <td>
                                <?php echo $fila['name']  ?>
                            </td>
                            <td>
                                <?php echo $fila['email'] ?>
                            </td>
                            <td>**********</td>
                            <td>
                                <?php 
                      if($fila['level']==1){
                        echo '<span class="badge bg-success">Administrador</span>';
                      }
                      else{echo '<span class="badge bg-dark">Usuario</span>';}
                    ?>
                            </td>
                            <td class="text-end">
                                <form action="./php/user_delete.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="user_id" value="<?php echo $fila['id']; ?>">
                                    <button type="submit" class="btn btn-outline-danger btn-sm"
                                        onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                        <i class="bi bi-trash2"></i>
                                    </button>
                                </form>
                                <button class="btn btn-outline-warning btn-sm mx-2 btnEdit"
                                    data-email="<?php echo $fila['email'] ?>" 
                                    data-id="<?php echo $fila['id'] ?>"
                                    data-name="<?php echo $fila['name'] ?>"
                                    data-tel="<?php echo $fila['telefono'] ?>"
                                    data-dir="<?php echo $fila['direccion'] ?>" 
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEdit">
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="./php/user_insert.php" method="post" class="needs-validation" novalidate id="form" enctype="multipart/form-data">
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
                                <label for="">Telefono:</label>
                                <input name="txtTelefono" id="" required type="text" class="form-control"
                                    placeholder="Inserta Telefono">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label for="">Email:</label>
                                <input name="txtEmail" required type="email" class="form-control"
                                    placeholder="Inserta el email">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>
                            <div class="col-6 mb-2">
                                <label for="">Nivel:</label>
                                <input name="txtLevel" required type="text" class="form-control"
                                    placeholder="Inserta el nivel">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label for="">Password:</label>
                                <input name="txtPassword" required type="password" class="form-control"
                                    placeholder="Inserta la Contraseña">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>
                            <div class="col-6 mb-2">
                                <label for="">Confirmar Password:</label>
                                <input name="txtPasswordConfirm" required type="password" class="form-control"
                                    placeholder="Inserta la Contraseña">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-2">
                                <label for="">Direccion:</label>
                                <input name="txtDireccion" required type="email" class="form-control"
                                    placeholder="Inserta tu Direccion">
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
    <div class="modal fade modal-lg" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="./php/user_update.php" method="post" class="needs-validation" novalidate id="form">
                    <div class="modal-body">
                        <input type="text" id="txtIdEdit" name="txtIdEdit">
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label for="">Nombre:</label>
                                <input name="txtNameEdit" id="txtNameEdit" required type="text" class="form-control"
                                    placeholder="Inserta el nombre">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>
                            <div class="col-6 mb-2">
                                <label for="">Telefono:</label>
                                <input name="txtTelefonoEdit" id="txtTelefonoEdit" required type="text"
                                    class="form-control" placeholder="Inserta Telefono">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label for="">Email:</label>
                                <input id="txtEmailEdit" name="txtEmailEdit" required type="email" class="form-control"
                                    placeholder="Inserta el email">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>
                            <div class="col-6 mb-2">
                                <label for="">Nivel:</label>
                                <input id="txtLevelEdit" name="txtLevelEdit" required type="text" class="form-control"
                                    placeholder="Inserta el nivel">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label for="">Password:</label>
                                <input name="txtPassword" required type="password" class="form-control"
                                    placeholder="Inserta la Contraseña">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>
                            <div class="col-6 mb-2">
                                <label for="">Confirmar Password:</label>
                                <input name="txtPasswordConfirm" required type="password" class="form-control"
                                    placeholder="Inserta la Contraseña">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label for="">Direccion:</label>
                                <input name="txtDireccionEdit" id="txtDireccionEdit" required type="email"
                                    class="form-control" placeholder="Inserta tu Direccion">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark" id="btnEdit">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="./js/users.js"></script>

    <?php 
        if(isset($_GET['status'])){
            if($_GET['status']==1){
                ?>
    <script>
        Swal.fire({

            icon: "success",
            title: "Datos guardados correctamente",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
    <?php
            }
        }
    ?>
</body>

</html>