<?php
class Rol{
    private $id;
    private $descripcion;
    private $usuarios;
    private $msjOperacion;

    public function __construct(){
        $this->id = "";
        $this->descripcion = "";
        $this->usuarios = "";
        $this->msjOperacion = "";
    }

    public function set($id, $descripcion){
        $this->id = $id;
        $this->descripcion = $descripcion;
    }

    public function getId(){
        return $this->id;
    }
    public function getDescripcion(){
        return $this->descripcion;
    }
    public function getUsuarios(){
        return $this->usuarios;
    }
    public function getMsjOperacion(){
        return $this->msjOperacion;
    }

    public function setId($id){
        $this->id = $id;
    }
    public function setDescipcion($descipcion){
        $this->descipcion = $descipcion;
    }
    public function setUsuarios($usuarios){
        $this->usuarios = $usuarios;
    }
    public function setMsjOperacion($msjOperacion){
        $this->msjOperacion = $msjOperacion;
    }
    
    /** Busca en la bd los datos con ese id y los carga en un objeto
     * @return bool */
    public function cargar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM rol WHERE id = ".$this->getId();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->set($row['id'], $row['descripcion']);
                    $resp = true;
                }
            }
        } else {
            $this->setMsjOperacion("rol->listar: ".$base->getError());
        }
        return $resp;
    }
    
    /** Si el registro se inserta en la bd retorna true, caso contrario false.
     * @return bool */
    public function insertar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO rol VALUES('".$this->getId()."', '".$this->getDescripcion()."')";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql) == -1) {
                $resp = true;
            } else {
                $this->setMsjOperacion("rol->insertar: ".$base->getError());
            }
        } else {
            $this->setMsjOperacion("rol->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE rol SET id='".$this->getId()."', descripcion='".$this->getDescripcion()."' WHERE id='".$this->getId()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMsjOperacion("rol->modificar: ".$base->getError());
            }
        } else {
            $this->setMsjOperacion("rol->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM rol WHERE id=".$this->getId();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMsjOperacion("rol->eliminar: ".$base->getError());
            }
        } else {
            $this->setMsjOperacion("rol->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro=""){
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM rol";
        if ($parametro != "") {
            $sql .=' WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){
                    $obj = new Rol();
                    $obj->set($row['id'], $row['descripcion']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $this->setMsjOperacion("rol->listar: ".$base->getError());
        }
    
        return $arreglo;
    }
}