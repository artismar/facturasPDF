<?php
class AbmUsuario{

    /** Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto.
     * @param array $datos
     * @return object
     */
    private function cargarObjeto($datos){
        $objeto = null;
        $abmRol = new AbmRol;
        $buscaRol['id'] = $datos['idRol'];
        $rol = $abmRol->buscar($buscaRol);
        // array_key_exists devuelve true si el valor del primer parametro coincide con alguna clave del array asociativo pasado en el segundo parametro.
        // isset devuelve true si la variable existe y no es null.
        if (count($rol) > 0){
            if (array_key_exists('id', $datos) and array_key_exists('nombre', $datos) and array_key_exists('password', $datos) and array_key_exists('mail', $datos) and array_key_exists('idRol', $datos) and array_key_exists('deshabilitado', $datos)){
                $objeto = new Usuario();
                $objeto->set($datos['id'], $datos['nombre'], $datos['password'], $datos['mail'], $rol[0], $datos['deshabilitado']);
            }
        }
        return $objeto;
    }

    /** Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves.
     * @param array $datos
     * @return object */
    private function cargarObjetoConClave($datos){
        $objeto = null;
        if(isset($datos['id']) ){
            $objeto = new Usuario();
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
        if ($datos != null){
            if  (isset($datos['id']))
                $where .= " and id = ".$datos['id'];
            if  (isset($datos['nombre']))
                 $where .= " and nombre = '".$datos['nombre']."'";
            if  (isset($datos['password']))
                $where .= " and password = '".$datos['password']."'";
            if  (isset($datos['mail']))
                $where .= " and mail = '".$datos['mail']."'";
            if  (isset($datos['idRol']))
                $where .= " and idRol = ".$datos['idRol'];
            if  (isset($datos['deshabilitado']))
            $where .= " and deshabilitado = '".$datos['deshabilitado']."'";
        }
        $objetos = Usuario::listar($where);
        return $objetos;
    }

    /** Permite ingresar un registro.
     * @param array $datos
     * @return boolean */
    public function alta($datos){
        $alta = false;
        $objeto = $this->cargarObjeto($datos);
        $usuario['id'] = $datos['id'];
        $existe = $this->buscar($usuario);
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
            $usuarioExiste = $this->buscar($nuevoArray); // verifico si el usuario ya existe en la bd
            if(count($usuarioExiste) > 0 and $objeto != null and $objeto->modificar()){
                $modificar = true;
            }
        }
        return $modificar;
    }

    public function convertirObjArray($obj){
        $array = array();
        $array['id'] = $obj->getId();
        $array['nombre'] = $obj->getNombre();
        $array['password'] = $obj->getPassword();
        $array['mail'] = $obj->getMail();
        $array['idRol'] = $obj->getRol()->getId();
        return $array;
    }
}

?>