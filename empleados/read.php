<?php
 namespace controladores;
 require_once("../autoload.php");
 use modelos\usuarios;
    $empleados = new usuarios();

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
                    <a href="../dashboard.php" class="nav-link py-3 border-bottom rounded-0 link-dark border-top" data-bs-toggle="tooltip" data-bs-placement="right" title="Home">
                        <iconify-icon icon="ic:round-home" width="40" height="40"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="../inventario/read.php" class="option_container nav-link py-3 border-bottom rounded-0 link-dark" data-bs-toggle="tooltip" data-bs-placement="right" title="Inventario">
                        <iconify-icon class="iconify" icon="ic:baseline-inventory" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="../proveedores/read.php" class="option_container nav-link py-3 border-bottom rounded-0 link-dark" data-bs-toggle="tooltip" data-bs-placement="right" title="Proveedores">
                        <iconify-icon class="iconify" icon="fa-solid:users" width="30" height="30"></iconify-icon>
                    </a>
                </li>
                <li class="option">
                    <a href="./read.php" class="option_container nav-link active py-3 border-bottom rounded-0 bg-dark" data-bs-toggle="tooltip" data-bs-placement="right" title="Empleados">
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
                    <li><hr class="dropdown-divider"></li>
                    <li><a href="../logout.php" class="dropdown-item text-danger">Cerrar Sesion</a></li>
                </ul>
            </div>
        </nav>
        <!-- MAIN CONTAINER -->
        <section class="main_container col-lg-11 ms-3">
            <!-- PRODUCTS NAV -->
            <ul class="nav nav-tabs my-4">
                <li class="nav-item">
                    <a href="./read.php" class="nav-link active" aria-current="page">Ver Empleados</a>
                </li>
                <li class="nav-item">
                    <a href="./add.php" class="nav-link">Agregar Empleado</a>
                </li>
            </ul>
            <!-- SEARCH BAR AND FILTER BUTTON -->
            <div class="read_header row my-4 align-items-center">
                <!-- SEARCH BAR -->
                <div class="col-lg-12">
                    <div class="search_bar input-group">
                        <button type="button" name="submit" id="search-button" class="btn border border-end-0 search" style="background-color: #FFF">
                            <iconify-icon icon="circum:search" width="30" height="30"></iconify-icon>
                        </button>
                        <div class="form-floating flex-grow-1">
                            <input type="text" name="search" id="search" placeholder="Buscar" class="form-control border-start-0 search">
                            <label for="search" id="keyword">Buscar</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- PRODUCTS RESULT -->
            <section class="dashboard_container container" id="mainContainer">
                <!-- COLLAPSE BUTTON -->
                <div class="row mx-1 my-3">
                    <div class="d-flex">
                        <button type="button" id="Alternar" class="btn btn-outline-secondary btn-sm ms-auto">Expandir</button>
                        <button type="button" id="flex" class="btn btn-outline-secondary btn-sm ms-2" onclick="checkFlex(event)">Todo</button>
                    </div>
                </div>
                </div>

                <main class="dashboard_container container" id="main">

                </main>
                <nav>
                    <ul class="pagination justify-content-center" id="index">

                    </ul>
                </nav>
        </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script src="../sources/js/app.js"></script>
<script src="../sources/js/readEmpleados.js"></script>
<script src=""></script>
</html>




        