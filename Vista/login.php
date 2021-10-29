<?php
    $title = 'Login';
    $paginaLogin = true;
    include_once 'estructura/cabecera.php';

    $datos = data_submitted();
    $msj = "";
    if (isset($datos['user'])){
        $msj = 'Tienes que iniciar sesion para poder ingresar al sitio.';
    } elseif (isset($datos['error'])){
        $msj = $datos['error'];
    }
?>

<div class="container">
    <div class="row login-user justify-content-center text-center">
        <div class="col-12 text-center"></div>
            <form class="needs-validation" method="POST" action="accion/verificarLogin.php" novalidate>
                <i class="fas fa-dragon"></i>
                <h1 class="h3 mb-3 fw-normal">Login</h1>
                <p style="color: red;"><?php echo $msj;?></p>
                <div class="form-floating mt-5">
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder='usuario' pattern="[a-zA-Z]{3,50}" required>
                <label for="nombre">Usuario</label>
                <div class="invalid-feedback" id="pass-text">El usuario debe contener entre 3-50 caracteres. (Solo letras minusculas o mayusculas)</div>
                </div>
                <div class="form-floating mt-5">
                <input type="password" class="form-control" id="password" name='password' placeholder="password" pattern="[a-zA-Z0-9]{7,20}" required>
                <label for="password">Contraseña</label>
                <div class="invalid-feedback" id="pass-text">La contraseña debe tener entre 7-20 caracteres. (Solo puede contener letras minusculas, mayusculas o numeros)</div>
                </div>

                <button class="w-20 btn btn-lg btn-dark my-5" type="submit">Ingresar</button>
            </form>
        </div>
  </div>
</div>

<?php
    include_once 'estructura/pie.php';
?>