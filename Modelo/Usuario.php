<?php
class Usuario{
    private $id;
    private $nombre;
    private $password;
    private $mail;
    private $rol;
    private $deshabilitado;
    private $msjOperacion;

    public function __construct(){
        $this->id = "";
        $this->nombre = "";
        $this->password = "";
        $this->mail = "";
        $this->rol = "";
        $this->deshabilitado = "";
        $this->msjOperacion = "";
    }

    public function set($id, $nombre, $password, $mail, $rol, $deshabilitado){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->password = $password;
        $this->mail = $mail;
        $this->rol = $rol;
        $this->deshabilitado = $deshabilitado;
    }

    public function getId(){
        return $this->id;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getMail(){
        return $this->mail;
    }
    public function getRol(){
        return $this->rol;
    }
    public function getDeshabilitado(){
        return $this->deshabilitado;
    }
    public function getMsjOperacion(){
        return $this->msjOperacion;
    }

    public function setId($id){
        $this->id = $id;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function setPassword($password){
        $this->password = $password;
    }
    public function setMail($mail){
        $this->mail = $mail;
    }
    public function setRol($rol){
        $this->rol = $rol;
    }
    public function setDeshabilitado($deshabilitado){
        $this->deshabilitado = $deshabilitado;
    }
    public function setMsjOperacion($msjOperacion){
        $this->msjOperacion = $msjOperacion;
    }

    /** Busca en la bd los datos con ese id y los carga en un objeto
     * @return bool */
    public function cargar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM usuario WHERE id = ".$this->getId();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $rol = new Rol();
                    $rol->setId($row['IdRol']);
                    $rol->cargar();
                    $this->set($row['id'], $row['nombre'], $row['password'], $row['mail'], $rol, $row['deshabilitado']);
                    $resp = true;
                }
            }
        } else {
            $this->setMsjOperacion("usuario->listar: ".$base->getError());
        }
        return $resp;
    }
    
    /** Si el registro se inserta en la bd retorna true, caso contrario false.
     * @return bool */
    public function insertar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO usuario VALUES('".$this->getNombre()."', '".$this->getPassword()."', '".$this->getMail()."', ".$this->getRol()->getId().", '".$this->getDeshabilitado()."')";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql) == -1) {
                $resp = true;
            } else {
                $this->setMsjOperacion("usuario->insertar: ".$base->getError());
            }
        } else {
            $this->setMsjOperacion("usuario->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE usuario SET nombre = '" . $this->getNombre() . "', password= '" . $this->getPassword() . "', mail= '" . $this->getMail() . "', idRol= " . $this->getRol()->getId() . ", deshabilitado= '" . $this->getDeshabilitado() . "' WHERE id = " . $this->getId();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMsjOperacion("usuario->modificar: ".$base->getError());
            }
        } else {
            $this->setMsjOperacion("usuario->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM usuario WHERE id=".$this->getId();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMsjOperacion("usuario->eliminar: ".$base->getError());
            }
        } else {
            $this->setMsjOperacion("usuario->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro=""){
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM usuario";
        if ($parametro != "") {
            $sql .= ' WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){
                    $obj = new Usuario();
                    $rol = new Rol();
                    $rol->setId($row['idRol']);
                    $rol->cargar();
                    $obj->set($row['id'], $row['nombre'], $row['password'], $row['mail'], $rol, $row['deshabilitado']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMsjOperacion("usuario->listar: ".$base->getError());
        }
    
        return $arreglo;
    }
}

?>