<?php

if (!defined('BASEPATH')){
    exit("<div style='color:#FF0000;text-align:center;margin:0 auto'>Acceso Denegado</div>");
}


$path   = dirname(__FILE__);
$modulo = 'fallas';
$fin    = strpos($path, $modulo);
$path   = substr($path, 0, $fin);
$seguridad = $path . 'seguridad/Seguridad.php';
require_once $seguridad;

class Fallas extends Seguridad
{

    private $_mensaje;
    private $_cod_msg;

    public function __construct()
    {
        
    }

    public function addFallas($datos)
    {
        
        try {
            $problema            = $datos['problema'];
            $nombre_departamento = $datos['id_departamento'];
            
            $exi_ced = $this->recordExists("fallas", "problema='" . $problema . "' AND id_departamento = $nombre_departamento");
            if ($exi_ced === TRUE) {
                 $this->_cod_msg   = 15;
                $this->_mensaje   = '<span style="color:#FF0000">La C&oacute;digo se registrado en el sistema</span>';
            } else {

                $this->autoIncrement('fallas', 'id_falla');
                $ultimo = $this->auto_increment;
                
                $datos['id_falla']   = $ultimo; 
                $datos['id_estatus'] = 1; 
                $datos['fecha']      = date('Y-m-d'); 
                $insert = $this->insert('fallas', $datos);
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
    public function getFallas()
    {
        $data  = array(
                    'tabla'     => 'fallas f, departamento dep',
                    'campos'    => "f.problema, f.num_falla, f.id_departamento, dep.nombre_departamento, f.estatus",
                    'condicion' =>'f.id_departamento = dep.id_departamento',
                    'order by'  =>'f.id_falla',
                    'limit'     =>'1'
                    );
        $result = $this->select($data, FALSE);
        return $result;
    }

}