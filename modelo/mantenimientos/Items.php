<?php

if (!defined('BASEPATH')) {
    exit("<div style='color:#FF0000;text-align:center;margin:0 auto'>Acceso Denegado</div>");
}

$path      = dirname(__FILE__);
$modulo    = 'mantenimiento';
$fin       = strpos($path, $modulo);
$path      = substr($path, 0, $fin);
$seguridad = $path . 'seguridad/Seguridad.php';

require_once $seguridad;

class Items extends Seguridad
{

    protected $_table = 'bien';
    public function __construct()
    {
        
    }
    
    public function accion($datos)
    {
        session_start();
        $this->id_usuario    = $_SESSION['id_usuario'];
        $this->cod_submodulo = $_SESSION['cod_modulo'];
        $this->_accion = $datos['accion'];
        $this->_accion = $datos['accion'];
        $this->_datos  = $datos;
        switch ($this->_accion) {
            case 'save':
                $resultado = $this->agregar();
            break;
            case 'update':
                $resultado = $this->modificar($datos);
            break;
            case 'delete':
                $resultado = $this->eliminar($datos);
            break;
            case 'buscar_bien':
                $data      = array(
                    'tabla'     => 'bien',
                    'campos'    => "id,codigo_bien,nombre_bien,serial_bien,numero_bien,descripcion_bien,incorporado",
                    'condicion' => 'id =' . $datos['id']
                );
                $result = $this->select($data, FALSE);
                $resultado['codigo']      = $result[0]['codigo_bien'];
                $resultado['serial']      = $result[0]['serial_bien'];
                $resultado['numero']      = $result[0]['numero_bien'];
                $resultado['incorporado'] = $result[0]['incorporado'];

                break;
            case 'up_estatus':
                $dato['id']          = $datos['id'];
                $dato['incorporado'] = $datos['incorporado'];
                $dato['accion']      = 'update';
                $resultado = json_decode($this->modificar($dato));

            break;
        
        }
        return $resultado;
    }
    
    private function agregar()
    {
        $serial_bien = $this->_datos ['serial_bien'];
        $exi_ced     = $this->recordExists($this->_table, "serial_bien='" . $serial_bien . "'");
        if ($exi_ced === TRUE) {
            $response_data['cod_msg']     = 15;
            $response_data['msg'] = 'El N&deg; de Serial se encuentra registrado en el sistema';
        } else {
            
            $response_data = $this->add();
        }
        return json_encode($response_data);
    }
    public function modificar($datos)
    {
        
        $this->_datos = $datos;
        $response_data = $this->mod();
        return json_encode($response_data);
    }
    
    public function eliminar($datos)
    {
       $this->_datos = $datos;
       $response_data = $this->del();
       return json_encode($response_data);
    }
    public function getItems($datos=array())
    {
        
        $data   = array(
            'tabla'  => 'bien',
            'campos' => "id,codigo_bien,nombre_bien,serial_bien,numero_bien,descripcion_bien,incorporado",
            'ordenar'=>'id ASC'
        );
        $result = $this->select($data, FALSE);
        return $result;
    }
    
}
