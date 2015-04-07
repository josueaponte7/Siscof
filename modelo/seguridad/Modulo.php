<?php

if (!defined('BASEPATH')) {
    exit("<div style='color:#FF0000;text-align:center;margin:0 auto'>Acceso Denegado</div>");
}
$path = dirname(__FILE__);
require_once "$path/Seguridad.php";
class Modulo extends Seguridad
{
    protected $_id_usuario;
    protected $_perfil_id;
    private   $_menu = FALSE;
    private   $_campos = '*';
    public function __construct()
    {
        $this->table = 's_modulo';
    }
    
    private function _addModulo()
    {
        $resultado   = parent::add();
        return $resultado;
    }

    public function addModulo($datos)
    {   
        
        try {
             $where_mod = "modulo='" . $datos['modulo'] . "'";
            $where_pos = "posicion='" . $datos['posicion'] . "'";

            $exis_mod = parent::recordExists($this->table, $where_mod);
            $exis_pos = parent::recordExists($this->table,$where_pos);
            if ($exis_mod === TRUE) {
               $this->_cod_msg = 15;
               $this->_mensaje = "<span style='color:#FF0000'>El Nombre del Modulo ya existe</span>";
            }else if($exis_pos === TRUE){
               $this->_cod_msg = 16;
               $this->_mensaje = "<span style='color:#FF0000'>La Posici&oacute;n del Moduo en el Men&uacute; ya existe</span>";
            }else{

                $this->a_datos = $datos;
                $resultado = $this->_addModulo(); 

                if($resultado['success'] === TRUE){
                    $this->_cod_msg = 21;
                    $this->_mensaje = 'El Registro ha sido Guardado Exitosamente';
                    $response_data['id'] = $resultado['id'];
                }
            }
            throw new Exception($this->_mensaje, $this->_cod_msg);
        } catch (Exception $e) {
            $response_data['msg']     = $e->getMessage();
            $response_data['cod_msg'] = $e->getCode();
            return json_encode($response_data);
        }
    }
    
    private function _editModulo()
    {
        $resultado   = parent::mod();
        return $resultado;
    }
    
    public function editModulo($datos)
    {
        try {
            $cod_modulo    = array_shift($datos);
            $this->where   = "cod_modulo=$cod_modulo";
            $this->a_datos = $datos;
            $resultado     = $this->_editModulo();
            if ($resultado === TRUE || $resultado > 0) {
                $this->_cod_msg   = 22;
                $this->_mensaje   = "El Registro ha sido Modificado Exitosamente";
            }
            throw new Exception($this->_mensaje, $this->_cod_msg);
        } catch (Exception $e) {
            return array('error_codmensaje' => $e->getCode(), 'error_mensaje' => $e->getMessage());
        }
    }
    
    private function _delModulo()
    {
        $resultado   = parent::del();
        return $resultado;
    }
    public function delModulo($data)
    {

        try {
            $this->where   = "cod_modulo=".$data['cod_modulo'];
            $this->r_affec = TRUE;
            $resultado = $this->_delModulo();
            if ($resultado === TRUE || $resultado > 0) {
                $this->_cod_msg   = 23;
                $this->_mensaje   = "El Registro ha sido Eliminado Exitosamente";
            }
            throw new Exception($this->_mensaje, $this->_cod_msg);
        } catch (Exception $e) {
            return array('error_codmensaje' => $e->getCode(), 'error_mensaje' => $e->getMessage());
        }
    }
    protected function getModulos()
    {
        if($this->_menu === FALSE){
            $data = array(
                'tabla'     => 's_perfil_privilegio spp,s_perfil AS sp, s_sub_modulo AS ssm,s_modulo AS sm',
                'campos'    => 'sm.id,sm.modulo ',
                'condicion' => "spp.perfil_id=$this->_perfil_id AND spp.submodulo_id=ssm.id AND ssm.modulo_id=sm.id GROUP BY sm.id",
                'ordenar'   => 'sm.posicion,sm.id ASC'
                );
        }else{
            $data   = array('tabla' => 's_modulo','campos'=>$this->_campos);
        }
        $result = parent::select($data, FALSE);
        return $result;
    }
    
    public function getModulo($datos)
    {
        if(!empty($datos['id_usuario'])){
            $this->_id_usuario = $datos['id_usuario'];
        }
        if(!empty($datos['perfil_id'])){
            $this->_perfil_id = $datos['perfil_id'];
        }
        if(!empty($datos['menu'])){
            $this->_menu = $datos['menu'];
        }   
        if(!empty($datos['campos'])){
            $this->_campos = $datos['campos'];
        }
  
        $result =  $this->getModulos();
        return $result;
    }
}
