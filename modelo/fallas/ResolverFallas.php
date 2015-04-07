<?php
if (!defined('BASEPATH')){
    exit("<div style='color:#FF0000;text-align:center;margin:0 auto'>Acceso Denegado</div>");
}


$path   = dirname(__FILE__);
$modulo = 'fallas';
$fin    = strpos($path, $modulo);
$path   = substr($path, 0, $fin);
$seguridad = $path . 'fallas/AsignarFalla.php';
require_once $seguridad;
class ResolverFallas extends AsignarFalla
{
    private $_mensaje;
    private $_cod_msg;

    public function __construct()
    {
        
    }
    public function resolverFallas($datos)
    {
        
        try {
            
            //$exi_ced = $this->recordExists("fallas", "problema='" . $problema . "' AND id_departamento = $nombre_departamento");
            $exi_ced = FALSE;
            if ($exi_ced === TRUE) {
                 $this->_cod_msg   = 15;
                $this->_mensaje   = '<span style="color:#FF0000">La C&oacute;digo se registrado en el sistema</span>';
            } else {

                $this->autoIncrement('fallas_resuelta', 'id_f_resuelta');
                $ultimo = $this->auto_increment;
                
                $datos['id_f_resuelta']   = $ultimo; 
                $datos['fecha']      = date('Y-m-d'); 
                $estatus = $datos['estatus'];
                unset($datos['estatus']);
                $insert = $this->insert('fallas_resuelta', $datos);
                if ($insert === TRUE) {
                    $id_falla = $datos['id_falla'];
                    $where = "id_falla = '$id_falla'";
                    $dat['id_estatus'] = $estatus;
                    $update = (boolean) $this->update('fallas', $dat, $where);
                    
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
}
