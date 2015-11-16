<?php
$path = dirname(__FILE__);
require_once "$path/Modulo.php";
class SubModulo extends Modulo
{
    
    private $_cod_modulo;
    private $_cod_submodulo;
    protected $_id_usuario;
    protected $_menu = 1;
    protected $_ultimo = array();
    private $_where = FALSE;
    private $_ac_sql = FALSE;
    protected $_sql;
    //protected $_table = 's_modulo';
    public function __construct()
    {
        $this->_table = 's_sub_modulo';
    }
    
    
    public function accion($datos)
    {
        session_start();
        $this->id_usuario    = $_SESSION['id_usuario'];
        $this->cod_submodulo = $_SESSION['cod_modulo'];
        $seguridad['usuario_creacion'] = $this->id_usuario;
        $seguridad['fecha_creacion'] = date('Y-m-d H:i:s ');

        $this->_accion = $datos['accion'];
        $response_data = '';
        switch ($this->_accion) {
            case 'save':
                
                $keys   = array('sub_modulo','posicion','ruta','activo','modulo_id');
                $values = array($datos['submodulo'],$datos['sbm_posicion'],$datos['ruta'],$datos['sbmod_estatus'],$datos['modulo_id']);
                
                $dato_r = array_combine($keys,$values);
                $dato = array_merge($dato_r, $seguridad);
                
                
                $modulo            = $dato['sub_modulo'];
                $posicion          = $dato['posicion'];
                $existe            = $this->recordExists($this->_table, "modulo='" . $modulo . "'");
                $existe_ps         = $this->recordExists($this->_table, "posicion='" . $posicion . "'");
                if ($existe === TRUE) {
                    $response_data['existe'] = 'ok';
                    $response_data['msg']    = '<span style="color:#FF0000">El Nombre del Sub M&oacute;dulo se encuentra registrado en el sistema</span>';
                }else if($existe_ps === TRUE){
                    $response_data['existe_pos'] = 'ok';
                    $response_data['msg']    = '<span style="color:#FF0000">La posici&oacute;n se encuentra registrada</span>';
                } else {
                    $this->_datos  = $dato;
                    $response_data = $this->add();
                }
            break;
            case 'update':
                $keys   = array('id','sub_modulo','posicion','ruta','activo','modulo_id');
                $values = array($datos['id'], $datos['submodulo'],$datos['sbm_posicion'],$datos['ruta'],$datos['sbmod_estatus'],$datos['modulo_id']);
                
                $dato_r = array_combine($keys,$values);
                $dato = array_merge($dato_r, $seguridad);
                
                $this->_datos = $dato;
                $response_data = $this->mod();
            break;
            case 'delete':
                $this->_datos = $datos;
                $response_data = $this->del();
            break;
            case 'BuscarSubModulos':
   
                $data['menu']   = 0;
                $data['campos'] = 'id,sub_modulo,posicion,activo,ruta,modulo_id';
                $this->_where   = 'modulo_id=' . $datos['id_mod'];
                $resultado      = $this->getSubModulo($data);

                $es_array  = is_array($resultado) ? TRUE : FALSE;
                
                $es_int    = is_int($resultado) ? 1 : 0;
                if ($es_array === FALSE && $es_int == 1) {
                    $response_data['existe'] = 'no';
                } else {
                    
                    $datos_responses = array();

                    for ($j = 0; $j < count($resultado) - 1; $j++) {
                        $values = array();
                        $keys = array();
                        while (list($key,$value) = each($resultado[$j])) {
                            array_push($values, $value);
                            array_push($keys, $key);
                        }
                        $arreglo_datos = array_combine($keys, $values);
                        array_push($datos_responses, $arreglo_datos);
                    }
                    $response_data = $datos_responses;
                }
            break;
        }
        return $response_data;
    }


    protected function getSubModulos()
    {
        
        if($this->_menu === 1){ 
        $data = array(
            'tabla'     => 's_perfil_privilegio AS spp,s_usuario AS su,s_sub_modulo AS ssm',
            'campos'    => 'ssm.id,ssm.modulo_id,ssm.sub_modulo,ssm.ruta ',
            'condicion' => "su.id=$this->_id_usuario AND  ssm.modulo_id=$this->_cod_modulo AND ssm.activo = 1 AND spp.perfil_id=su.perfil_id  GROUP BY ssm.sub_modulo,ssm.modulo_id ",
            'ordenar'   => 'ssm.posicion,ssm.id ASC'
            );
        }else{
            $data = array('tabla' => 's_sub_modulo','campos'=>  $this->_campos,'condicion'=>$this->_where);
        }
        
        if($this->_ac_sql == TRUE){
            
            $result = parent::ex_query($this->_sql);
        } else {
            $result = parent::select($data,'ASSOC');
            parent::autoIncrement($this->_table, 'cod_submodulo');
        }
        if($result === 0){
            return $this->auto_increment;
        }else {
            $this->_ultimo = array('ul_codsubmodulo'=>$this->auto_increment);
            return $result;
        }
    }
    public function getSubModulo($datos)
    {   
        $default       = array('campos' => '*');
        $options       = array_merge($default, $datos);
        $this->_campos = $options['campos'];
        if(!empty($datos['usuario_id'])){
            $this->_id_usuario = $datos['usuario_id'];
        }
        if(isset($datos['menu'])){
            $this->_menu = $datos['menu'];
        }   
        if(!empty($datos['id'])){
            $this->_cod_modulo = $datos['id'];
            $this->_where = 'id='.$this->_cod_modulo;
        }
        if(!empty($datos['id'])){
            $this->_cod_submodulo = $datos['id'];
            $this->_where         = 'id=' . $this->_cod_submodulo;
        }
        if(isset($datos['sql'])){
            $this->_ac_sql = TRUE;
            $this->_sql    = $datos['sql'];
        }
        $result =  $this->getSubModulos();
        $es_array  = is_array($result) ? TRUE : FALSE;
        $es_int    = is_int($result) ? TRUE : FALSE;
        
        
        if ($this->_menu == 0) {
            if($es_array == TRUE && $es_int == FALSE){
                $result = array_merge($result, array('ultimo' => $this->auto_increment));
            }else{
                $result = $this->auto_increment;
            }
            return $result;
        } else {
            return $result;
        }
    }
}
