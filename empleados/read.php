
<?php
  require_once("../autoload.php");

    if(isset($_SESSION['results'])){
        $results = $_SESSION['results'];
        $index = $_SESSION['index'];
        $page = $_SESSION['pageClicked'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JEMAS</title>
    <link rel="stylesheet" href="../sources/css/root.css">
    <link rel="stylesheet" href="../sources/css/nav.css">
    <link rel="stylesheet" href="../sources/css/read.css">
</head>
<body>
    <section class="index_section">
        <nav class="navHome">
            <header class="navHome_header">
                <h1>JEMAS</h1>
            </header>

            <div class="navHome_ol">
                <a href="../dashboard.php">
                    <div  class="option_container">
                        <h3>Dashboard</h3>
                    </div>
                </a>
                <div class="option">
                    <div class="option_container">
                        <div>
                            <iconify-icon class="iconify" icon="ic:baseline-inventory" width="20" height="20"></iconify-icon>
                            <h3>Inventario</h3>
                        </div>
                        <span class="arrow"></span>
                    </div>
                    <ul class="navHome_ul hidden">
                        <a href="../inventario/add.php"><li>Agregar Inventario</li></a>
                        <a href="../inventario/read.php"><li>Ver Inventario</li></a>
                        <a href="../inventario/search.php"><li>Buscar en Inventario</li></a>
                    </ul>
                </div>
                <div class="option">
                    <div class="option_container">
                        <div>
                            <iconify-icon class="iconify" icon="fa-solid:users" width="20" height="20"></iconify-icon>
                            <h3>Proveedores</h3>
                        </div>
                        <span class="arrow"></span>
                    </div>
                    <ul class="navHome_ul hidden">
                        <a href="../proveedores/add.php"><li>Agregar Proveedor</li></a>
                        <a href="../proveedores/read.php"><li>Ver Proveedores</li></a>
                        <a href="../proveedores/search.php"><li>Buscar en Proveedores</li></a>
                    </ul>
                </div>
                <div class="option target">
                    <div class="option_container">
                        <div>
                            <iconify-icon class="iconify" icon="clarity:employee-solid" width="20" height="20"></iconify-icon>
                            <h3>Empleados</h3>
                        </div>
                        <span class="arrow"></span>
                    </div>
                    <ul class="navHome_ul">
                        <a href="./add.php"><li>Agregar Empleado</li></a>
                        <a href="./read.php"><li class="target">Ver Empleados</li></a>
                        <a href="./search.php"><li>Buscar en Empleados</li></a>
                    </ul>
                </div>
            </div>
        </nav>

        <section class="main_container">
            <header class="main_header">
                <span id="NavArrow"></span>
                <div class="header_login" data-messages="Iniciar Secion">
                    <a href="../auth/login.php">
                        <iconify-icon class="iconify" icon="clarity:sign-in-solid" width="30" height="30"></iconify-icon>
                    </a>
                </div>
            </header>
            <main class="read_container">
                <div class="read_header">
                    <form action="../controladores/gets/ReadUsuario.php" method="POST">
                        <button type="submit" name="submit" class="btn_read">Ver Empleados</button>
                    </form>
                </div>
                <div class="read_main">
                    <?php if(!empty($results)): ?>
                        <?php foreach ($results as $result) { ?>
                            <div class="readObject_Container target">
                                <div class="readObject_header">
                                    <form action="../controladores/edits/UpdateEmpleados.php" method="post" class="form_edit">
                                        <input type="hidden" name="id" value=<?php echo $result['id_usr']; ?>>
                                        <button class="button"> Editar</button>
                                    </form>
                                    <span class="arrow"></span>
                                </div>
                                <div class="principal_data">
                                    <div class="image_container">
                                        <?php if($result['sexo'] == 'f'){ ?>
                                            <iconify-icon icon="mdi:face-woman" width="100" height="100"></iconify-icon>
                                        <?php } else if($result['sexo'] == 'm'){ ?>
                                            <iconify-icon icon="mdi:face-man" width="100" height="100"></iconify-icon>
                                        <?php } ?>
                                    </div>
                                    <div class="data_container">
                                        <h4>Nombre: <p><?=$result['nombre_usr'] . ' ' . $result['apellido_usr'];?></p></h4>
                                   </div>
                                </div>
                                <div class="data_container hidden">
                                    <h4>Correo: <?=$result['email_usr'];?></h4>
                                </div>
                            </div> 
                        <?php } ?>
                        <form action = "../controladores/gets/ReadUsuario.php" method = "POST" class="form_pages">
                            <?php for($i = 0; $i < $index; $i++): ?>
                                <?php if($i == $page){ ?>
                                    <button type="submit" class="btn_page target" name="submitPaginated" value="<?=$i?>"><?=$i+1?></button>
                                <?php } else {?>
                                    <button type="submit" class="btn_page" name="submitPaginated" value="<?=$i?>"><?=$i+1?></button>
                                <?php } ?>
                           <?php endfor; ?>
                        </form>
                     <?php endif; ?>
            </div> 
         </main>

        </section>
    </section>

    <?php unset($_SESSION['results']); 
             unset($_SESSION['index']); ?>
</body>
<script src="../sources/js/nav.js"></script>
<script src="../sources/js/read.js"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</html>



        