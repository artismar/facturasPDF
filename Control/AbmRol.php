<?php
class AbmRol{

    /** Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto.
     * @param array $datos
     * @return object
     */
    private function cargarObjeto($datos){
        $objeto = null;
        // array_key_exists devuelve true si el valor del primer parametro coincide con alguna clave del array asociativo pasado en el segundo parametro.
        // isset devuelve true si la variable existe y no es null.
        if (array_key_exists('id', $datos) and array_key_exists('descripcion', $datos)){
            $objeto = new Rol();
            $objeto->set($datos['id'], $datos['descripcion']);
        }
        return $objeto;
    }

    /** Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves.
     * @param array $datos
     * @return object */
    private function cargarObjetoConClave($datos){
        $objeto = null;
        if(isset($datos['id']) ){
            $objeto = new Rol();
            $objeto->set($datos['id'], null, null, null, null, null);
        }
        return $objeto;
    }

    /** Corrobora que dentro del arreglo asociativo estan seteados los campos claves.
     * @param array $datos
     * @return boolean */
    private function seteadosCamposClaves($datos){
        $existe = false;
        if (isset($datos['id'])) // isset devuelve true si la variable existe y no es null.
            $existe = true;
        return $existe;
    }

    /** Busca los datos solicitados en la var y devuelve un array con los objetos.
     * @param array $datos
     * @return array */
    public function buscar($datos){
        $where = " true ";
        if ($datos!=null){
            if  (isset($datos['id']))
                $where .= " and id =".$datos['id'];
            if  (isset($datos['descripcion']))
                 $where .= " and descripcion ='".$datos['descripcion']."'";
        }
        $objetos = Rol::listar($where);
        return $objetos;
    }

    /** Permite ingresar un registro.
     * @param array $datos
     * @return boolean */
    public function alta($datos){
        $alta = false;
        $objeto = $this->cargarObjeto($datos);
        $rol['id'] = $datos['id'];
        $existe = $this->buscar($rol);
        if (isset($datos['id'])){
            if (count($existe) == 0){
                if ($objeto != null and $objeto->insertar()){
                    $alta = true;
                }
            }
        }
        return $alta;
    }

    /** Permite eliminar un registro.
     * @param array $datos
     * @return boolean */
    public function baja($datos){
        $baja = false;
        if ($this->seteadosCamposClaves($datos)){
            $objeto = $this->cargarObjetoConClave($datos);
            if ($objeto!=null and $objeto->eliminar()){
                $baja = true;
            }
        }
        return $baja;
    }

    /** Permite modificar un registro.
     * @param array $datos
     * @return boolean */
    public function modificacion($datos){
        $modificar = false;
        if ($this->seteadosCamposClaves($datos)){
            $objeto = $this->cargarObjeto($datos);
            $nuevoArray['id'] = $datos['id'];
            $rolExiste = $this->buscar($nuevoArray); // verifico si el rol ya existe en la bd
            if(count($rolExiste) > 0 and $objeto!=null and $objeto->modificar()){
                $modificar = true;
            }
        }
        return $modificar;
    }

    public function convertirObjArray($obj){
        $array = array();
        $array['id'] = $obj->getId();
        $array['descripcion'] = $obj->getDescripcion();
        return $array;
    }
}

?>