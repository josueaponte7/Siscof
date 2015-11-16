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
        }
        return $response_data;
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
            $this->table = $datos['tabla'];
        }
        
        $result = $this->getPerfiles();
        return $result;
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
