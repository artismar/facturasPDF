<?php
    $title = 'Inicio';
    $seguro = true;
    include_once 'estructura/cabecera.php';
?>

    <div class="container">
        <div class="row">
            <div class="col-12 mt-5">
                <h1>Bienvenido <?php echo $sesion->getUsuario();?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-4 mt-5">
                <p>Tecnicatura Universitaria <br>De Desarrollo Web</p>
            </div>
            <div class="col-4 mt-5">
                <p>Programacion Web <br>Dinamica</p>
            </div>
            <div class="col-4 mt-5">
                <p>Trabajo <br>Librerias</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <hr>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 mt-5 text-center">
                <h4>Creador de facturas PDF</h4>
                <?php 
                    if ($rol->getId() == 1){
                        echo "<p>Ingresaste como <span style='color: rgb(27, 112, 63);'>Administrador</span> <br>Tienes permiso para crear, gestionar y ver facturas. <br><a href='crearFactura.php'>Crear</a></p>";
                    } else {
                        echo "<p>Ingresaste como <span style='color: rgb(27, 112, 63);'>Lector</span> <br>Tienes permiso para crear, gestionar y ver facturas. <br><a href='crearFactura.php'>Crear</a></p>";
                    }
                ?>
            </div>
        </div>
    </div>


    <?php
    include_once 'estructura/pie.php';
    ?>