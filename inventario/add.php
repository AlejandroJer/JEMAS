<?php
 namespace controladores;
 require_once("../autoload.php");
 use modelos\{proveedores, productos, usuarios};
    $proveedores = new proveedores();
    $empleados = new usuarios();
    $productos = new productos();
    $proveedoresResults = $proveedores->GetNombresProveedores();
    $productosResultsCategoria = $productos->GetCategorias();
    $productosResultsMaterial = $productos->GetMateriales();
    if (!isset($_SESSION['logged_usr'])) {
        header('Location: ./../auth/login.php');
        exit;
    } else {
        $user_id = $_SESSION['logged_usr'];
        $user = $empleados->GetUsuarioById($user_id);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JEMAS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../sources/css/root.css">
</head>
<body class="container-fluid">
    <section class="index_section row">
        <!-- MAIN NAV -->
        <nav class="navHome d-flex flex-column flex-shrink-0 bg-light p-0 border-end" style="width: 4.5rem; position: sticky; height: 100vh; top: 0;">
            <a href="#" class="d-block py-3 text-decoration-none mx-auto" data-bs-toggle="tooltip" data-bs-placement="right" title="JEMAS">
                <img src="../sources/imgs/logo.png" alt="" srcset="" style="width: 45px;">
            </a>
            <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                <li class="nav-item">
                    <a href="../dashboard.php" class="nav-link py-3 border-bottom rounded-0 link-dark link-dark border-top" data-bs-toggle="tooltip" data-bs-placement="right" title="Home">
                        <iconify-icon icon="ic:round-home" width="40" height="40"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="./add.php" class="option_container active nav-link py-3 border-bottom rounded-0 bg-dark" data-bs-toggle="tooltip" data-bs-placement="right" title="Inventario">
                        <iconify-icon class="iconify" icon="ic:baseline-inventory" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="../proveedores/read.php" class="option_container nav-link py-3 border-bottom rounded-0 link-dark  link-dark" data-bs-toggle="tooltip" data-bs-placement="right" title="Proveedores">
                        <iconify-icon class="iconify" icon="fa-solid:users" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="../empleados/read.php" class="option_container nav-link py-3 border-bottom rounded-0 link-dark  link-dark" data-bs-toggle="tooltip" data-bs-placement="right" title="Empleados">
                        <iconify-icon class="iconify" icon="clarity:employee-solid" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="../movimientos/readProductos.php" class="option_container nav-link py-3 border-bottom rounded-0 link-dark link-dark" data-bs-toggle="tooltip" data-bs-placement="right" title="Movimientos">
                        <iconify-icon class="iconify" icon="bi:arrow-left-right" width="30" height="30"></iconify-icon>
                    </a>
                </li>
            </ul>
            <div class="border-top dropup">
                <a href="#" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown"  data-bs-offset="10,0">
                    <iconify-icon class="iconify" icon="mingcute:user-4-fill" width="30" height="30"></iconify-icon>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#" class="dropdown-item">Usuario #<?= $user['id_usr'] ?></a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a href="#" class="dropdown-item disabled" tabindex="-1"><?= $user['nombre_usr']. ' ' .$user['apellido_usr']?></a></li>
                    <li><a href="#" class="dropdown-item disabled" tabindex="-1"><?= $user['email_usr']?></a></li>
                </ul>
            </div>
        </nav>
        <section class="main_container col-lg-11 ms-3">
            <!-- PRODUCTS NAV -->
            <ul class="nav nav-tabs mt-4">
                <li class="nav-item">
                    <a href="./read.php" class="nav-link">Ver Productos</a>
                </li>
                <li class="nav-item">
                    <a href="./add.php" class="nav-link active" aria-current="page">Agregar Inventario</a>
                </li>
                <li class="nav-item">
                    <a href="./extras/add.php" class="nav-link" aria-current="page">Agregar Tags</a>
                </li>
            </ul>
            <!-- MAIN CONTENT -->
            <main class="dashboard_container container">
                <!-- FORM - to edit products -->
                <form action="../controladores/SetProducto.php" method="post" enctype="multipart/form-data" class="my-4 needs-validation" novalidate>
                    <input type="hidden" name="id_inv" value="null">
                    <input type="file" accept=".jpeg, .png, .jpg" id="image"  name="image" class="form-control border-warning inputfile-warning visually-hidden">
                    <div class="row">
                        <div class="col-lg-10">
                            <!-- NOMBRE -->
                            <div class="row my-3">
                                <div class="col-lg-2">
                                    <label for="producto-nombre" class="d-flex justify-content-end col-form-label fs-4">Nombre:</label>
                                </div>
                                <div class="col-lg-10 ">
                                    <input type="text" class="form-control" name="producto-nombre" id="producto-nombre" placeholder="Nombre del producto" value="" required>
                                    <div class="invalid-feedback">
                                        Ingresa un nombre para el producto
                                    </div>
                                </div>
                            </div>
                            <!-- PROVEEDOR -->
                            <div class="row mb-3">
                                <div class="col-lg-2">
                                    <label for="producto-proveedor" class="d-flex justify-content-end col-form-label fs-4">Proveedor:</label>
                                </div>
                                <div class="col-lg-10 ">
                                    <select name="producto-proveedor" id="producto-proveedor" class="form-select" required>
                                        <option value="" selected>Proveedor del producto</option>
                                        <?php if(!empty($proveedoresResults)): ?>
                                            <?php foreach ($proveedoresResults as $proveedoresResult) { ?>
                                                <option value="<?= $proveedoresResult['id_proveedor']; ?>"><?= $proveedoresResult['nombre_empresa'];?></option>
                                            <?php } ?>
                                        <?php endif; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Selecciona el proveedor del producto
                                    </div>
                                </div>
                            </div>
                            <!-- CATEGORIA -->
                            <div class="row mb-3">
                                <div class="col-lg-2">
                                    <label for="producto-categoria" class="d-flex justify-content-end col-form-label fs-4">Categoría:</label>
                                </div>
                                <div class="col-lg-10">
                                    <select name="categoria" id="producto-categoria" class="form-select" required>
                                        <option value="" selected>Categoria del producto</option>
                                        <?php if(!empty($productosResultsCategoria)): ?>
                                            <?php foreach ($productosResultsCategoria as $categoria) { ?>
                                                <option value="<?= $categoria['id'] ?>"><?= $categoria['categoria'] ?></option>
                                            <?php } ?>
                                        <?php endif; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Selecciona la categoria del producto
                                    </div>
                                </div>
                            </div>
                            <!-- MATERIAL -->
                            <div class="row mb-3">
                                <div class="col-lg-2">
                                    <label for="tipo-material" class="d-flex justify-content-end col-form-label fs-4">Material:</label>
                                </div>
                                <div class="col-lg-10 ">
                                    <select name="tipo-material" id="tipo-material" class="form-select" required>
                                        <option value="" selected>Material del producto</option>
                                        <?php if(!empty($productosResultsMaterial)): ?>
                                            <?php foreach ($productosResultsMaterial as $material) { ?>
                                                <option value="<?= $material['id'] ?>"><?= $material['material'] ?></option>
                                            <?php } ?>
                                        <?php endif; ?> 
                                    </select>
                                    <div class="invalid-feedback">
                                        Selecciona el material del producto
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <!-- IMAGEN -->
                            <div class="card col-lg-12 ">
                                <button type="button" class="card-body btn border-0 p-0" id="update-image" onclick="updateImage(event);">
                                    <img src="../sources/imgs/defaultImg.jpeg" alt="imagen-actual-del-producto" class="card-img-top" id="img-image">
                                </button>
                                <label for="update-image" class="col-form-label text-center">Agregar</label>
                            </div>
                        </div>
                    </div>
                    <!-- PESO -->
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="peso" class="d-flex justify-content-end col-form-label fs-4">Peso:</label>
                        </div>
                        <div class="col-lg-10 ">
                            <input type="number" min="0" step="0.01"  class="form-control" name="peso" id="peso" placeholder="Gramos" value="" required>
                            <div class="invalid-feedback">
                                Ingresa el peso en gramos del producto
                            </div>
                        </div>
                    </div>
                    <!-- PRECIO DE VENTA -->
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="precio-venta" class="d-flex justify-content-end col-form-label fs-4">Venta:</label>
                        </div>
                        <div class="col-lg-10 ">
                            <input type="number" min="0" step="0.01" class="form-control" name="producto-precio-venta" id="precio-venta" placeholder="Precio MXN venta" value="" required>
                            <div class="invalid-feedback">
                                Ingresa el precio de venta del producto
                            </div>
                        </div>
                    </div>
                    <!-- PRECIO DE COMPRA -->
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="precio-compra" class="d-flex justify-content-end col-form-label fs-4">Compra:</label>
                        </div>
                        <div class="col-lg-10 ">
                            <input type="number" min="0" step="0.01" class="form-control" name="producto-precio-compra" id="precio-compra" placeholder="Precio MXN compra" value="" required>
                            <div class="invalid-feedback">
                                Ingresa el precio de compra del producto
                            </div>
                        </div>
                    </div>
                    <!-- CANTIDAD -->
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="cantidad-disponible" class="d-flex justify-content-end col-form-label fs-4">Cantidad:</label>
                        </div>
                        <div class="col-lg-10 ">
                            <input type="number" min="0" class="form-control" name="cantidad-disponible" id="cantidad-disponible" placeholder="Cantidad Disponible" value="" required>
                            <div class="invalid-feedback">
                                Ingresa la cantidad disponible del producto
                            </div>
                        </div>
                    </div>
                    <!-- UBICACION -->
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="ubicacion-almacen" class="d-flex justify-content-end col-form-label fs-4 p-0">Ubicación:</label>
                        </div>
                        <div class="col-lg-10 ">
                            <input type="text" class="form-control" name="ubicacion-almacen" id="ubicacion-almacen" placeholder="Ubicacion en el almacén" value="" required>
                            <div class="invalid-feedback">
                                Ingresa la ubicación del producto en el almacén
                            </div>
                        </div>
                    </div>
                    <!-- DESCRIPCION -->
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="form-floating">
                                <textarea id="producto-descripcion" class="form-control pt-5" name="producto-descripcion" placeholder="Descripción" style="height: 150px" required></textarea>
                                <label for="producto-descripcion" class="fs-4">Descripción:</label>
                                <div class="invalid-feedback">
                                    Ingresa una descripción para el producto
                                </div>
                            </div>
                        </div>
                    </div> 
                    <!-- FORMS BTNS -->
                    <div class="row mb-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary col-auto me-3" name="submit" id="submit">Guardar</button>
                    </div>
                </form>
            </main>
        </section>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script src="../sources/js/app.js"></script>
</html>
