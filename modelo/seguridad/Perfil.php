<?php

if (!defined('BASEPATH')) {
    exit("<div style='color:#FF0000;text-align:center;margin:0 auto'>Acceso Denegado</div>");
}
$path = dirname(__FILE__);
require_once "$path/Seguridad.php";

class Perfil extends Seguridad
{

    private $_campos = '*';

    public function __construct()
    {
        $this->_table   = 's_perfil';
    }
    
    
    public function accion($datos)
    {
        session_start();
        $this->id_usuario    = $_SESSION['id_usuario'];
        $this->cod_submodulo = $_SESSION['cod_modulo'];
        
        $this->_accion = $datos['accion'];
        switch ($this->_accion) {
            case 'save':
                $keys   = array('id','perfil');
                $values = array($datos['id'],$datos['perfil']);
                
                array_push($keys, 'usuario_creacion','fecha_creacion');
                array_push($values, $this->id_usuario,date('Y-m-d H:i:s '));
                
                $dato = array_combine($keys,$values);
                

                $perfil            = $dato['perfil'];
                $existe            = $this->recordExists($this->_table, "perfil='" . $perfil . "'");
                if ($existe === TRUE) {
                    $response_data['existe'] = 'ok';
                    $response_data['msg']    = '<span style="color:#FF0000">El Nombre del Grupo se encuentra registrado en el sistema</span>';
                } else {
                    $this->_datos  = $dato;
                    $response_data = $this->add();
                }
            break;
            case 'update':
                $keys   = array('id','perfil');
                $values = array($datos['id'],$datos['perfil']);
            
                array_push($keys, 'usuario_modificacion','fecha_actualizacion');
                array_push($values, $this->id_usuario,date('Y-m-d H:i:s '));
                
                $dato = array_combine($keys,$values);
                

                $this->_datos = $dato;
                $response_data = $this->mod();
            break;
            case 'delete':
                $this->_datos = $datos;
                $response_data = $this->del();
            break;
            case 'BuscarPrivilegios':
                $datos_responses = array();
                $resultado = $this->getPrivilegioPerfil($datos);
                
                for ($j = 0; $j < count($resultado) - 1; $j++) {
                    
                    $values = array();
                    $keys   = array();
                    while (list($key, $value) = each($resultado[$j])) {
                        
                        array_push($values, $value);
                        array_push($keys, $key);
                    }
                    
                    $arreglo_datos = array_combine($keys, $values);
                    
                    array_push($datos_responses, $arreglo_datos);
                }
                $response_data = $datos_responses;
                
            break;
            case 'AgregarPrivilegios':
            $response_data = $this->addPrivilegios($datos);
 
            break;
        }
        return $response_data;
    }
    
    public function addPerfil($datos)
    {

        $where = "perfil='" . $datos['perfil'] . "'";

        $exis_reg = parent::recordExists($this->table, $where);

        try {
            if ($exis_reg === TRUE) {
                $this->_cod_msg = 15;
                $this->_mensaje = "<span style='color:#FF0000'>El Nombre del Perfil ya existe</span>";
            } else {

                $this->a_datos = $datos;
                $resultado     = $this->_addPerfil();
                if ($resultado === TRUE) {
                    $this->_cod_msg = 21;
                    $this->_mensaje = "El Registro ha sido Guardado Exitosamente";
                }
            }
            throw new Exception($this->_mensaje, $this->_cod_msg);
        } catch (Exception $e) {
            return array('error_codmensaje' => $e->getCode(), 'error_mensaje' => $e->getMessage());
        }
    }

    private function _editPerfil()
    {
        $resultado = parent::mod();
        return $resultado;
    }

    public function editPerfil($datos)
    {

        try {
            $codigo_perfil = array_shift($datos);
            $this->where   = "codigo_perfil=$codigo_perfil";
            $this->a_datos = $datos;
            $resultado     = $this->_editPerfil();
            if ($resultado === TRUE || $resultado > 0) {
                $this->_cod_msg = 22;
                $this->_mensaje = "El Registro ha sido Modificado Exitosamente";
            }
            throw new Exception($this->_mensaje, $this->_cod_msg);
        } catch (Exception $e) {
            return array('error_codmensaje' => $e->getCode(), 'error_mensaje' => $e->getMessage());
        }
    }

    private function _delPerfil()
    {
        $resultado = parent::del();
        return $resultado;
    }

    public function delPerfil($data)
    {

        try {
            $this->where   = "codigo_perfil=" . $data['codigo_perfil'];
            $this->r_affec = TRUE;
            $resultado     = $this->_delPerfil();
            if ($resultado === TRUE || $resultado > 0) {
                $this->_cod_msg = 23;
                $this->_mensaje = "El Registro ha sido Eliminado Exitosamente";
            }
            throw new Exception($this->_mensaje, $this->_cod_msg);
        } catch (Exception $e) {
            return array('error_codmensaje' => $e->getCode(), 'error_mensaje' => $e->getMessage());
        }
    }
    
    protected function getPerfiles()
    {
        $data   = array('tabla' => $this->_table, 'campos' => $this->_campos,'condicion'=> 'id > 2');
        $result = parent::select($data, FALSE);
        return $result;
    }

    public function getPerfil($datos)
    {
       
        if (!empty($datos['id_usuario'])) {
            $this->_id_usuario = $datos['id_usuario'];
        }
        if (!empty($datos['campos'])) {
            $this->_campos = $datos['campos'];
        }
        if(isset($datos['tabla'])){
            $this->_table = $datos['tabla'];
        }
    
        $result = $this->getPerfiles();
        return $result;
    }

    public function addPrivilegios($datos)
    {
        
        $bandera = FALSE;
        try {
            $cod_perfil = $datos['cod_perfil'];
            $activados  = explode(',', $datos['activados']);
            $sql_del    = "DELETE FROM s_perfil_privilegio WHERE codigo_perfil = $cod_perfil;";
            $result     = parent::execute($sql_del);
            
                $sql = "INSERT INTO s_perfil_privilegio(perfil_id,submodulo_id,agregar,modificar,eliminar,consultar,imprimir)VALUES";
                for ($i = 0; $i < count($activados); $i++) {
                    $mod_tipo = explode(';', $activados[$i]);
                    $sql .= "($cod_perfil,$mod_tipo[0],$mod_tipo[1],$mod_tipo[2],$mod_tipo[3],$mod_tipo[4],$mod_tipo[5]),";
                }
                $sql = substr($sql, 0, -1).';';
                $resultado     = parent::execute($sql);
                if($resultado){
                   $bandera = TRUE;
                }
            if ($bandera == TRUE) {
                $this->_cod_msg = 21;
                $this->_mensaje = "El Registro ha sido Guardado Exitosamente";
            }
            throw new Exception($this->_mensaje, $this->_cod_msg);
        } catch (Exception $e) {
            return array('error_codmensaje' => $e->getCode(), 'error_mensaje' => $e->getMessage());
        }
    }
    
    public function getPrivilegioPerfil($data)
    {

        
        $id = $data['id'];
        $sql_del    = "SELECT 
                        pp.submodulo_id,
                        pp.agregar ,
                        pp.modificar,
                        pp.eliminar,
                        pp.consultar,
                        pp.imprimir
                       FROM s_modulo AS m
                       INNER JOIN s_sub_modulo AS sm ON m.id=sm.modulo_id
                       LEFT JOIN s_perfil_privilegio pp ON sm.id=pp.submodulo_id
                       WHERE perfil_id=$id
                       GROUP BY sm.id
                       ORDER BY m.modulo,sm.sub_modulo";
       $result     = parent::ex_query($sql_del);
       return $result;
    }

}