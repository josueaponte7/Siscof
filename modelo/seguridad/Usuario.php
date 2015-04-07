<?php
if (!defined('BASEPATH')) {
    exit("<div style='color:#FF0000;text-align:center;margin:0 auto'>Acceso Denegado</div>");
}
$path = dirname(__FILE__);

require_once "$path/Perfil.php";

class Usuario extends Perfil
{
    
    public function __construct() 
    {
        $this->_table   = 's_usuario';
    }
     private function _addUsuario()
    {
        $resultado = parent::add();
        return $resultado;
    }

    public function addUsuario($datos)
    {
        
        $this->table   = 's_usuario';
        try {
            $where    = "usuario='" . $datos['usuario'] . "'";
            $exis_reg = parent::recordExists($this->table, $where);
            
            if ($datos['usuario'] == 'admin') {
                $this->_cod_msg = 20;
                $this->_mensaje = "<span style='color:#FF0000'>Hubo un error comuniquese con Inform&aacute;tica</span>";
            } else if ($exis_reg === TRUE) {
                $this->_cod_msg = 15;
                $this->_mensaje = "<span style='color:#FF0000'>El Nombre del Usuario ya existe</span>";
            } else {
                $this->table   = 's_usuario';
                $datos['clave'] = $this->clave($datos['clave']);
                $this->a_datos = $datos;
                
                $resultado     = $this->_addUsuario();
                
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
    
    public function modificarClave($datos)
    {
        
        $this->table   = 's_usuario';
        try {
            $where    = "usuario='" . $datos['usuario'] . "'";
            $exis_reg = parent::recordExists($this->table, $where);
            
            if ($datos['usuario'] == 'admin') {
                $this->_cod_msg = 20;
                $this->_mensaje = "<span style='color:#FF0000'>Hubo un error comuniquese con Inform&aacute;tica</span>";
            } else if ($exis_reg === TRUE) {
                $this->_cod_msg = 15;
                $this->_mensaje = "<span style='color:#FF0000'>El Nombre del Usuario ya existe</span>";
            } else {
                $this->table   = 's_usuario';
                $datos['clave'] = $this->clave($datos['clave']);
                $this->a_datos = $datos;
                
                $resultado     = $this->_addUsuario();
                
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
    
     protected function getUsuarios()
    {
        if(!isset($this->_sql)){
            $data   = array('tabla' => $this->table, 'campos' => $this->_campos);
            $result = parent::select($data, FALSE);
        }else{
            $result     = parent::ex_query($this->_sql);
        }
        return $result;
    }

    public function getUsuario($datos)
    {
        
        if (!empty($datos['campos'])) {
            $this->_campos = $datos['campos'];
        }
        if(isset($datos['sql'])){
            $this->_sql = $datos['sql'];
        }
        $result = $this->getUsuarios();
        return $result;
    }
    
    public function accion($datos)
    {
        session_start();
        $this->id_usuario    = $_SESSION['id_usuario'];
        $this->cod_submodulo = $_SESSION['cod_modulo'];
        $response_data = array();
        unset($datos['r_clave']);
        $this->_accion = $datos['accion'];
        switch ($this->_accion) {
            case 'save':
                $usuario = $datos['usuario'];
                $this->where = "usuario='" . $usuario . "'";
                $existe = $this->recordExists($this->_table, $this->where);
               
                if ($existe === TRUE) {
                    $response_data['existe'] = 'ok';
                    $response_data['msg']    = 'El Nombre del Departamente se encuentra registrado en el sistema';
                }else{
                    
                    $datos['clave']                   = $this->clave(trim($datos['clave']));
                    $this->_datos                     = $datos;
                    $this->_datos['fecha_creacion']   = date("Y-m-d H:i:s");
                    $this->_datos['usuario_creacion'] = $this->id_usuario;
                    $response_data = $this->add();
                }
            break;
            case 'update':
                $this->_datos                         = $datos;
                $this->_datos['clave']                = $this->clave(trim($this->_datos['clave']));
                $this->_datos['fecha_actualizacion']  = date("Y-m-d H:i:s");
                $this->_datos['usuario_modificacion'] = $this->id_usuario;
                $response_data                        = $this->mod();
                break;
            case 'delete':
                $this->_datos  = $datos;
                $response_data = $this->del();
            break;
        }
        return $response_data;
    }
}