<?php
class Session{
    private $usuario;
    private $password;
    private $msjOperacion;

    public function __construct(){
        session_start();
    }

    public function getUsuario(){
        return $_SESSION['usuario'];
    }
    public function getPassword(){
        return $_SESSION['password'];
    }
    public function getMsjOperacion(){
        return $_SESSION['error'];
    }

    public function setUsuario($usuario){
        $_SESSION['usuario'] = $usuario;
    }
    public function setPassword($password){
        $_SESSION['password'] = $password;
    }
    public function setMsjOperacion($msjOperacion){
        $_SESSION['error'] = $msjOperacion;
    }

    /** Actualiza los atributus con los valores dados.
     * @param string $usuario
     * @param string $pass */
    public function iniciar($usuario, $password){
        $this->setUsuario($usuario);
        $this->setPassword($password);
    }

    /** Valida si la sesion actual tiene usuario y pass validos.
     * @return bool */
    public function validar(){
        $valido = false;
        $usuarios = new AbmUsuario();
        $datos['nombre'] = $this->getUsuario();
        $datos['password'] = $this->getPassword();
        $buscarUser['nombre'] = $datos['nombre'];
        $usuario = $usuarios->buscar($buscarUser);
        if (count($usuario) > 0 and $usuario[0]->getPassword() == $datos['password']){
            $valido = true;
        } else {
            session_destroy();
            $this->setMsjOperacion('El usuario o la contraseña no es correcto');
        }
        return $valido;
    }

    /** Verifica si la sesion esta activa o no.
     * @return bool */
    public function activa(){
        $activa = false;
        if (isset($_SESSION['usuario'])){
            $activa = true;
        }
        return $activa;
    }

    /** Devuelve el usuario logueado
     * @return object */
    public function getUsuarioLogeado(){
        $userLog = null;
        $usuarios = new AbmUsuario();
        $datos['nombre'] = $this->getUsuario();
        $usuario = $usuarios->buscar($datos);
        if (count($usuario) > 0){
            $userLog = $usuario[0];
        }
        return $userLog;
    }

    /** Devuelve el rol del usuario logueado.
     * @param object */
    public function getRol(){
        $rol = null;
        $usuario = $this->getUsuarioLogeado();
        if ($usuario != null){
            $rol = $usuario->getRol();
        }
        return $rol;
    }

    /** Cierra la sesion actual */
    public function cerrar(){
        session_unset();
        session_destroy();
    }
}

?>