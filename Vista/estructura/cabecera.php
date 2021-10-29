<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php $title?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <?php 
        if (!isset($accion)){ // Determinamos si es el header es de una pagina de la carpeta accion o vista y segun de donde sea, redireccionamos.
            include_once "../configuracion.php";
            echo '<link rel="stylesheet" href="css/estilos.css">';
            echo '<script src="js/formulario.js"></script>';
        } else {
            include_once "../../configuracion.php";
            echo '<link rel="stylesheet" href="../css/estilos.css">';
            echo '<script src="../js/formulario.js"></script>';
        }
    ?>
</head>
<body>
    <?php
        error_reporting(0);
        $usuarioLogin = null;
        $sesion = new Session();
            if (isset($seguro)){
                $sesion = new Session();
                if ($sesion->activa()){
                    $usuarioLogin = $sesion->getUsuarioLogeado();
                    $rol = $sesion->getRol();
                } else {
                    header('location:login.php?user=null');
                }
            }
    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
    <div class="container-fluid">
        <?php
        if (!isset($accion)){
            echo '<a class="navbar-brand" href="index.php"><i class="fas fa-dragon"></i></a>';
        } else{
            echo '<a class="navbar-brand" href="../index.php"><i class="fas fa-dragon"></i></a>';
        }
        ?>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <?php
        if (!isset($accion)){
            echo '<li class="nav-item">
                  <a class="nav-link" aria-current="page" href="index.php">Inicio</a>
                  </li>';
        } else{
            echo '<li class="nav-item">
                  <a class="nav-link" aria-current="page" href="../index.php">Inicio</a>
                  </li>';
        }
        ?>
        </ul>
        <?php
            if ($usuarioLogin != null){
                if (!isset($accion)){
                    echo '<span>Usuario: '.$usuarioLogin->getNombre().' | Rol: '.$usuarioLogin->getRol()->getDescripcion().' | <a class="text-body" href="accion/cerrarSesion.php">Cerrar Sesion</a></span>';
                } else{
                    echo '<span>Usuario: '.$usuarioLogin->getNombre().' | Rol: '.$usuarioLogin->getRol()->getDescripcion().' | <a class="text-body" href="cerrarSesion.php">Cerrar Sesion</a></span>';
                }
            } else{
                if (!isset($accion)){
                    echo '<a class="nav-link text-body" href="login.php"><span>Login</span></a>';
                } else{
                    echo '<a class="nav-link text-body" href="../login.php"><span>Login</span></a>';
                }
            }
        ?>
        </div>
    </div>
    </nav>