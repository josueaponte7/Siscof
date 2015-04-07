<?php

if (!defined('BASEPATH')){
    exit("<div style='color:#FF0000;text-align:center;margin:0 auto'>Acceso Denegado</div>");
}


$path   = dirname(__FILE__);
$modulo = 'consumible';
$fin    = strpos($path, $modulo);
$path   = substr($path, 0, $fin);
$seguridad = $path . 'seguridad/Seguridad.php';
require_once $seguridad;

class Registrar extends Seguridad
{
  
    private $_mensaje;
    private $_cod_msg;

    public function __construct()
    {
        
    }

    public function addRegistrar($datos)
    {
       
        try {
            $nombre_consumible      = $datos['nombre_consumible'];
            
            $exi_ced = $this->recordExists("consumibles", "nombre_consumible='" . $nombre_consumible . "'");
            if ($exi_ced === TRUE) {
                 $this->_cod_msg   = 15;
                $this->_mensaje   = '<span style="color:#FF0000">La C&oacute;digo se registrado en el sistema</span>';
            } else {

                $this->autoIncrement('consumibles', 'id_consumible');
                $ultimo = $this->auto_increment;
                
                $datos['id_consumible'] = $ultimo;               
                $insert = $this->insert('consumibles', $datos);
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
    public function getRegistrar()
    {
        $data  = array(
                    'tabla' => 'consumibles',
                    'campos' => "nombre_consumible, marca_consumible",
                    );
        $result = $this->select($data, FALSE);
        return $result;
    } 
    
}
