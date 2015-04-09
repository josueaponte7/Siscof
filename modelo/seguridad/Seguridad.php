<?php

date_default_timezone_set("America/Caracas");
$path = dirname(__FILE__);
require_once "$path/Bitacora.php";
class Seguridad extends Bitacora
{
    //private $_siteKey = 'M@t3N1D@d1Nt3Gr@lAra6u@';
    private $_siteKey = 'Si$c0f';
    private $_hashmac;
    protected $_clave;
    protected $_usuario;
    protected $_id_usuario;
    protected $_session_id ;
 
    protected $_table;
    protected $a_datos;
    protected $increment = FALSE;
    protected $camp_auto;
    protected $_datos;
    protected $where;
    protected $bitacora = FALSE;
    protected $_accion = '';
    
    protected $_msg_save   = "El Registro ha sido Guardado Exitosamente";
    protected $_msg_update = "El Registro ha sido  Modificado exitosamente";
    protected $_msg_delete = "El Registro ha sido Eliminado Exitosamente";
    protected $_msg_error  = "Ocurrio un error comuniquese con informatica";

    public function __construct()
    {
        //$this->id_usuario = $_SESSION['id_usuario'];
        
    }
    protected function mensajes($result)
    {
        $resultado['success'] = 'exitoso';
        switch ($this->_accion) {
            case 'save':
                if ($result['success'] === 'ok') {
                    $resultado['msg'] = $this->_msg_save;
                    $resultado['id']  = $result['id'];
                } else {
                    $resultado['success'] = 'error';
                    $resultado['msg']     = $this->_msg_error;
                }
            break;
            case 'update':
                if ($result['update'] === 'ok' || $result['columns_affected'] > 0) {
                    $resultado['msg']     = $this->_msg_update;
                } else if ($result['error'] === 'ok') {
                    $resultado['success'] = 'error';
                    $resultado['msg']     = $this->_msg_error;
                }
            break;
            case 'delete':
                if ($result['delete'] === 'ok') {
                    $resultado['msg'] = $this->_msg_delete;
                }
            break;
        }

        return $resultado;
    }
    
    protected function add()
    {
        $this->_accion = $this->_datos['accion'];
        unset($this->_datos['accion']);
        $resultados  = parent::insert($this->_table, $this->_datos);
        if($resultados['success'] == 'ok'){
            $resultado = $this->mensajes($resultados);
            parent::bitacorasSql();
        }
        return $resultado;
    }
    
    protected function mod()
    {
        
        $this->_accion = $this->_datos['accion'];
        $this->where = 'id ='.$this->_datos['id'];
        unset($this->_datos['accion']);
        unset($this->_datos['id']);
        $resultados  = parent::update($this->_table, $this->_datos,  $this->where);

        if($resultados['update'] == 'ok'){
            $resultado = $this->mensajes($resultados);
            parent::bitacorasSql();
        }
        return $resultado;
    }
    
    protected function del()
    {
        $this->_accion = $this->_datos['accion'];
        $this->where = 'id ='.$this->_datos['id'];
        unset($this->_datos['accion']);
        unset($this->_datos['id']);
        $resultados   = parent::delete($this->_table, $this->where);
        if ($resultados['delete'] == 'ok') {
            $resultado = $this->mensajes($resultados);
            parent::bitacorasSql();
        }
        return $resultado;
    }
    private function _HahsClave()
    {
        $this->_hashmac = hash_hmac('whirlpool', $this->_clave, $this->_siteKey);
        return $this->_hashmac;
    }
    
    private function _searchSession()
    {
        //Buscar registros del usuario logueado

        $resultado = $this->numRows('s_sesion_activa', 'usuario_id',"usuario_id=$this->_id_usuario");
        return $resultado;
    }
    
    protected function loginUser($datos)
    {
        $usuario        = $datos['usuario']; 
        $this->_usuario = $usuario;
        $clave          = $datos['clave'];
        $this->_clave   = $this->clave($clave);
        // consulta a la base de datos
        $data['tabla']  = "s_usuario";
        $data['campos'] = "id,activo,perfil_id";
        $data['condicion'] = "BINARY usuario = '" . $this->_usuario . "' AND clave = '" . $this->_clave . "'";

        $result = $this->row($data);
        return $result;
    }
    
    protected function clave($clave)
    {
        $this->_clave = $clave;
        return $this->_HahsClave();
    }

    
    private function _crearSession()
    {
            $this->_session_id = hash("sha1", md5(uniqid(rand(), true)));
            
            $ip = $_SERVER['REMOTE_ADDR'];
            
            $fecha_session = date('Y-m-d H:i');
            
            $data = array("usuario_id" => $this->_id_usuario, "session_id" => $this->_session_id ,  "fecha_session" => $fecha_session, "ip" => $ip);
            $insert = $this->insert('s_sesion_activa', $data);
            if($insert['success'] === 'ok'){
                $data_ac = array('conectado'=>1); 
                $this->update('s_usuario',$data_ac , "usuario_id=$this->_id_usuario");
                $data_respose['creacion'] = 'exito';
                return $data_respose;
            }else{
                $data_respose['creacion'] = 'error' ;
                return $data_respose;
            }
    }
    
    protected function crearSession()
    {
        
        
        //Buscar registros del usuario logueado
        $buscar = $this->_searchSession();

        if($buscar['num_rows'] == 0){
           //Crear registros del usuario logueado
           $resultado =  $this->_crearSession();
        }else if ($buscar['num_rows'] > 0){
            //Borrar registros del usuario logueado
            $borrar = $this->_borrarSession();
            if ($borrar['delete'] == 'ok') {
                //Crear registros del usuario logueado
                $resultado =  $this->_crearSession();
            }
        }
       return $resultado;
    }
    
    
     private function _sessionActiva($id_usuario, $conectado = TRUE)
    {

        $data = array('conectado' => $conectado);
        $where = "usuario_id='$id_usuario'";
        return $this->update('usuario', $data, $where);
    }

    protected function sessionActiva(){
        
    }


    private function _borrarSession()
    {
        //Eliminar registros del usuario logueado
        $delete = $this->delete("s_sesion_activa", "usuario_id='" . $this->_id_usuario . "'");
        return $delete;
    }
    
    protected function borrarSession(){
        $resul = $this->_borrarSession();
        return $resul;
    }

    public function url($url,$modulo)
    {
        date_default_timezone_set('America/Caracas');
        $dividir_ruta         = explode("Siscof/", $url);
        $ruta                 = $dividir_ruta[1];
        $_SESSION['url']      = $ruta;
        $_SESSION['s_modulo'] = $modulo;
        $_SESSION['start']      = strtotime(date("Y-m-d H:i"));
    }
    public function formateaBD($fecha) {
        $fechaesp = preg_split("/[\-\/]/", $fecha);
        $revertirfecha = array_reverse($fechaesp);
        $fechabd = implode('-', $revertirfecha);
        return $fechabd;
    }
    public function tiempoSession() {
        date_default_timezone_set('America/Caracas');
        $datetime1 =  strtotime(date("Y-m-d H:i"));
        $datetime2 =  $_SESSION['start'];
        $interval  = abs($datetime2 - $datetime1);
        $minutes   = round($interval / 3600);
        return $minutes;
    }
}
