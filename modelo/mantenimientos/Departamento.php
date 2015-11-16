<?php

if (!defined('BASEPATH')){
    exit("<div style='color:#FF0000;text-align:center;margin:0 auto'>Acceso Denegado</div>");
}


$path   = dirname(__FILE__);
$modulo = 'mantenimiento';
$fin    = strpos($path, $modulo);
$path   = substr($path, 0, $fin);
$seguridad = $path . 'seguridad/Seguridad.php';
require_once $seguridad;

class Departamento extends Seguridad
{

    protected $_table = 'departamento';

    public function getDepartamento()
    {
        
        $data  = array(
                    'tabla' => 'departamento',
                    'campos' => "id,codigo_departamento, nombre_departamento, direccion_departamento",
                    );
        $result = $this->select($data, FALSE);
        return $result;
    }
    
    public function accion($datos)
    {
        session_start();
        $this->id_usuario    = $_SESSION['id_usuario'];
        $this->cod_submodulo = $_SESSION['cod_modulo'];
        $this->_accion = $datos['accion'];
        $response_data = '';
        switch ($this->_accion) {
            case 'save':
                $nombre_departamento = $datos['nombre_departamento'];
                $existe              = $this->recordExists($this->_table, "nombre_departamento='" . $nombre_departamento . "'");
                if ($existe === TRUE) {
                    $response_data['existe'] = 'ok';
                    $response_data['msg']    = 'El Nombre del Departamente se encuentra registrado en el sistema';
                } else {
                    $this->_datos  = $datos;
                    $response_data = $this->add();
                }
            break;
            case 'update':
                $this->_datos = $datos;
                $response_data = $this->mod();
            break;
            case 'delete':
                $this->_datos = $datos;
                $response_data = $this->del();
            break;
        }
        return $response_data;
    }
}