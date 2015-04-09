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

class Herramientas extends Items
{
    
    
    private $_mensaje;
    private $_cod_msg;

    public function __construct()
    {
        
    }

    public function addHerramientas($datos)
    {
       
        try {
            $serial_herramienta = $datos['serial_herramienta'];
            
            $exi_ced = $this->recordExists("herramientas", "serial_herramienta='" . $serial_herramienta . "'");
            if ($exi_ced === TRUE) {
                 $this->_cod_msg   = 15;
                $this->_mensaje   = '<span style="color:#FF0000">El serial se encuetra registrado en el sistema</span>';
            } else {

                $this->autoIncrement('herramientas', 'id_herramientas');
                $ultimo = $this->auto_increment;
                
                $datos['id_herramientas'] = $ultimo;               
                $insert = $this->insert('herramientas', $datos);
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
    
    public function editHerramienta($datos)
    {   
        
 
        $id_herramientas    = $datos['id_herramientas'];

        try {
            unset( $datos['id_herramientas']);

            //$data  = array('cod_telefono'=>$cod_telefono,'telefono' => $telefono, 'direccion' => $direccion);
            $where = "id_herramientas='$id_herramientas'";

            $update = (boolean) $this->update('herramientas', $datos, $where);

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
    
    public function delHerramienta($datos)
    {
        
        try {
 
            $id_herramientas = $datos['id_herramientas'];

            $where = "id_herramientas='$id_herramientas'";
            $existe = $this->recordExists('consultorio', $where);
            $existe = FALSE;
            if ($existe === TRUE) {
                $this->_cod_msg = 30;
                $this->_mensaje = '<span style="color:#FF0000">La Especialidad no puede ser eliminada ya que posee registros asociados</span>';
            } else {
                $delete = $this->delete('herramientas', $where);

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
    
    public function getHerramientas()
    {
        $data  = array(
                    'tabla' => 'herramientas',
                    'campos' => "nombre_herramienta, marca_herramienta, serial_herramienta",
                    );
        $result = $this->select($data, FALSE);
        return $result;
    }
    
}
