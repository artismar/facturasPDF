<?php
    include_once '../../configuracion.php';
    $seguro = true;
    $accion = true;
    $datos = data_submitted();
    $sesion = new Session();
    $sesion->iniciar($datos['nombre'], md5($datos['password']));
    if ($sesion->validar()){
        header("Location:../index.php");
    } else{
        $msj = $sesion->getMsjOperacion();
        $sesion->cerrar();
        header("Location:../login.php?error=$msj");
    }
?>