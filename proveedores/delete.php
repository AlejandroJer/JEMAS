<?php
 require_once("../autoload.php");

    // catch the id of the product to update
    $result = $_SESSION['proveedores'];
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
    <section class="index_section row vh-100">
        <!-- MAIN NAV -->
        <nav class="navHome d-flex flex-column flex-shrink-0 bg-light p-0 border-end" style="width: 4.5rem">
            <a href="#" class="d-block p-3 link-dark text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="right" title="JEMAS">
                <iconify-icon icon="map:jewelry-store" width="40" height="40"></iconify-icon>
            </a>
            <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                <li class="nav-item">
                    <a href="../dashboard.php" class="nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
                        <iconify-icon icon="bxs:dashboard" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="../inventario/read.php" class="option_container nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Inventario">
                        <iconify-icon class="iconify" icon="ic:baseline-inventory" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="./add.php" class="option_container nav-link active py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Proveedores">
                        <iconify-icon class="iconify" icon="fa-solid:users" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="../empleados/read.php" class="option_container nav-link py-3 border-bottom rounded-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Empleados">
                        <iconify-icon class="iconify" icon="clarity:employee-solid" width="30" height="30"></iconify-icon>
                    </a>
                </li>
            </ul>
            <div class="border-top">
                <a href="./auth/login.php" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="right" title="Iniciar Sesion">
                    <iconify-icon class="iconify" icon="clarity:sign-in-solid" width="30" height="30"></iconify-icon>
                </a>
            </div>
        </nav>
        <section class="main_container col-lg-11">
            <!-- PRODUCTS NAV -->
            <ul class="nav nav-tabs mt-4">
                <li class="nav-item">
                    <a href="./read.php" class="nav-link" aria-current="page">Ver Proveedores</a>
                </li>
                <li class="nav-item">
                    <a href="./add.php" class="nav-link active">Agregar Proveedor</a>
                </li>
            </ul>
            <main class="dashboard_container container">
                <!-- FORM - to delete supliers -->
                <form action="../controladores/deletes/DeleteProveedor.php" method="POST" enctype="multipart/form-data" class="my-4 needs-validation" novalidate>
                    <!-- NOMBRE -->
                    <div class="row my-3">
                        <div class="col-lg-2">
                            <label for="nombre-empresa" class="d-flex justify-content-end col-form-label fs-4">Empresa:</label>
                        </div>
                        <div class="col-lg-10 ">
                            <input type="text" class="form-control" name="nombre-empresa" id="nombre-empresa" placeholder="Nombre de la Empresa" value="<?= $result['nombre_empresa']; ?>" disabled>
                        </div>
                    </div>
                    <!-- DIRECCION -->
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="direccion-proveedor" class="d-flex justify-content-end col-form-label fs-4">Dirección:</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="direccion-proveedor" id="direccion-proveedor" placeholder="Dirección del proveedor" value="<?= $result['direccion']; ?>" disabled>
                        </div>
                    </div>
                    <!-- CONTACTO -->
                    <div class="row my-3">
                        <div class="col-lg-2">
                            <label for="persona-contacto" class="d-flex justify-content-end col-form-label fs-4">Contacto:</label>
                        </div> 
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="persona-contacto" id="persona-contacto" placeholder="Nombre de contacto" value="<?= $result['persona_contacto']; ?>" disabled>
                        </div>
                    </div>
                    <!-- TELEFONO -->
                    <div class="row mb-3">
                        <div class="col-lg-2">
                            <label for="telefono" class="d-flex justify-content-end col-form-label fs-4">Teléfono:</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="tel" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" value="<?= $result['num_telefono']; ?>" disabled>
                        </div>
                    </div>
                    <!-- CORREO -->
                    <div class="row my-3">
                        <div class="col-lg-2">
                            <label for="correo-proveedor" class="d-flex justify-content-end col-form-label fs-4">Correo:</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="email" class="form-control" name="correo-proveedor" id="correo-proveedor"  placeholder="Correo" value="<?= $result['email_proveedor']; ?>" disabled>
                        </div>
                    </div>
                    <!-- FORMS BTNS -->
                    <div class="row mb-3 d-flex justify-content-end">
                        <input type="hidden" name="id_proveedor" value="<?= $result['id_proveedor'] ?>">
                        <button type="button" class="btn btn-danger col-auto me-3" data-bs-toggle="modal" data-bs-target="#modal-submit">Borrar</button>
                    </div>
                        <!-- MODAL TO UPDATE THE PRODUCT -->
                        <div class="modal fade" id="modal-submit"  tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3>Borrar Proveedor</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>¿Estás seguro de borrar este proveedor?</h5>
                                        <p>Esta acción no se puede deshacer.</p>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-between">
                                        <!-- SUBMIT/CANCEL BTN - to submit/cancel the update -->
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-danger" name="submit" id="submit">Borrar</button>
                                    </div>
                                </div>
                            </div>
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