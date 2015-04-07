<?php

if (!defined('BASEPATH')) {
    exit("<div style='color:#FF0000;text-align:center;margin:0 auto'>Acceso Denegado</div>");
}


$path      = dirname(__FILE__);
$modulo    = 'inventario';
$fin       = strpos($path, $modulo);
$path      = substr($path, 0, $fin);
$seguridad = $path . 'mantenimientos/Items.php';
require_once $seguridad;

class Componente extends Items
{

    private $_mensaje;
    private $_cod_msg;

    public function __construct()
    {
        
    }

    public function addComponente($datos)
    {

        try {
            $num_bien_componente = $datos['num_bien_componente'];

            $exi_ced = $this->recordExists("componente", "num_bien_componente='" . $num_bien_componente . "'");
            if ($exi_ced === TRUE) {
                $this->_cod_msg = 15;
                $this->_mensaje = '<span style="color:#FF0000">La C&oacute;digo se registrado en el sistema</span>';
            } else {

                $this->autoIncrement('componente', 'id_componente');
                $ultimo = $this->auto_increment;

                $datos['id_componente'] = $ultimo;
                $insert                 = $this->insert('componente', $datos);
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
    
    public function editComponente($datos)
    {   
        
 
        $id_componente    = $datos['id_componente'];

        try {
            unset( $datos['id_componente']);

            //$data  = array('cod_telefono'=>$cod_telefono,'telefono' => $telefono, 'direccion' => $direccion);
            $where = "id_componente='$id_componente'";

            $update = (boolean) $this->update('componente', $datos, $where);

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
    
    public function delComponente($datos)
    {
        
        try {
 
            $id_componente = $datos['id_componente'];

            $where = "id_componente='$id_componente'";
            $existe = $this->recordExists('consultorio', $where);
            $existe = FALSE;
            if ($existe === TRUE) {
                $this->_cod_msg = 30;
                $this->_mensaje = '<span style="color:#FF0000">La Especialidad no puede ser eliminada ya que posee registros asociados</span>';
            } else {
                $delete = $this->delete('componente', $where);

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
    public function getComponente()
    {
        $data   = array(
            'tabla'  => 'componente',
            'campos' => "nombre_componente, marca_componente, serial_componente",
        );
        $result = $this->select($data, FALSE);
        return $result;
    }

}
