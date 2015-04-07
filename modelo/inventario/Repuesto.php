<?php

if (!defined('BASEPATH')){
    exit("<div style='color:#FF0000;text-align:center;margin:0 auto'>Acceso Denegado</div>");
}


$path   = dirname(__FILE__);
$modulo = 'inventario';
$fin    = strpos($path, $modulo);
$path   = substr($path, 0, $fin);
$seguridad = $path . 'mantenimientos/Items.php';
require_once $seguridad;

class Repuesto extends Items {
    
    private $_mensaje;
    private $_cod_msg;

    public function __construct()
    {
        
    }

    public function addRepuesto($datos)
    {
        
       
        try {
            //$nombre_repuesto      = $datos['nombre_repuesto'];
            
            //$exi_ced = $this->recordExists("repuesto", "nombre_repuesto='" . $nombre_repuesto . "'");
            $exi_ced = FALSE;
            if ($exi_ced === TRUE) {
                $this->_cod_msg   = 15;
                $this->_mensaje   = '<span style="color:#FF0000">La C&oacute;digo se registrado en el sistema</span>';
            } else {

                $this->autoIncrement('repuesto', 'id_repuesto');
                $ultimo = $this->auto_increment;
                
                $datos['id_repuesto'] = $ultimo;               
                $insert = $this->insert('repuesto', $datos);
              
                if ($insert === TRUE) {                      
                    $this->_cod_msg = 21;
                    $this->_mensaje = "El Registro ha sido Guardado Exitosamente";
                } else {
                    $this->_cod_msg = 16;
                    $this->_mensaje = '<span style="color:#FF0000">Ocurrio un error comuniquese con informatica</span>';
                }
            }
            throw new Exception($this->_mensaje, $this->_cod_msg);
        } catch (Exception $e) {
            return array('error_codmensaje' => $e->getCode(), 'error_mensaje' => $e->getMessage());
        }
    }
    
    public function editRespuesto($datos)
    {   
        
 
        $id_repuesto = $datos['id_repuesto'];

        try {
            unset( $datos['id_repuesto']);

            //$data  = array('cod_telefono'=>$cod_telefono,'telefono' => $telefono, 'direccion' => $direccion);
            $where = "id_repuesto='$id_repuesto'";

            $update = (boolean) $this->update('repuesto', $datos, $where);

            if ($update === TRUE || $update > 0) {
                $this->_cod_msg   = 22;
                $this->_mensaje   = "El Registro ha sido  Modificado exitosamente";
                
            } else {
                $this->_tipoerror = 'error';
                $this->_mensaje   = '<span style="color:#FF0000">Ocurrio un error comuniquese con informatica</span>';
                $this->_cod_msg   = 16;
            }
            throw new Exception($this->_mensaje, $this->_cod_msg);
        } catch (Exception $e) {
              return array('error_codmensaje' => $e->getCode(), 'error_mensaje' => $e->getMessage());
        }
    }
    
    public function delRespuesto($datos)
    {
        
        try {
 
            $id_repuesto = $datos['id_repuesto'];

            $where = "id_repuesto='$id_repuesto'";
            $existe = $this->recordExists('repuesto', $where);
            $existe = FALSE;
            if ($existe === TRUE) {
                $this->_cod_msg = 30;
                $this->_mensaje = '<span style="color:#FF0000">La Especialidad no puede ser eliminada ya que posee registros asociados</span>';
            } else {
                $delete = $this->delete('repuesto', $where);

                if ($delete == TRUE) {
                    $this->_cod_msg = 23;
                    $this->_mensaje = "El Registro ha sido Eliminado Exitosamente";
                } else {
                    $this->_cod_msg = 16;
                    $this->_mensaje = '<span style="color:#FF0000">Ocurrio un error comuniquese con informatica</span>';
                }
            }
            throw new Exception($this->_mensaje, $this->_cod_msg);
        } catch (Exception $e) {
            return array('error_codmensaje' => $e->getCode(), 'error_mensaje' => $e->getMessage());
        }
    }
    
    public function getRepuesto()
    {
        $data  = array(
                    'tabla' => 'repuesto',
                    'campos' => "nombre_repuesto, marca_repuesto, modelo_repuesto",
                    );
        $result = $this->select($data, FALSE);
        return $result;
    } 
    
    
    
}
