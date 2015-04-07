<?php

if (!defined('BASEPATH')){
    exit("<div style='color:#FF0000;text-align:center;margin:0 auto'>Acceso Denegado</div>");
}


$path   = dirname(__FILE__);
$modulo = 'mantenimientos';
$fin    = strpos($path, $modulo);
$path   = substr($path, 0, $fin);
$seguridad = $path . 'seguridad/Usuario.php';
require_once $seguridad;

class UsuarioF extends Usuario
{

    protected $_mensaje;
    protected $_cod_msg;

    public function __construct()
    {
        
    }
    
    public function accion($datos)
    {  
        session_start();
        $this->id_usuario    = $_SESSION['id_usuario'];
        $this->cod_submodulo = $_SESSION['cod_modulo'];
        $response_data = array();
        
        print_r($datos);
        exit;
        unset($datos['r_clave']);
        $this->_accion = $datos['accion'];
        switch ($this->_accion) {
            case 'save':
                $usuario = $datos['usuario'];
                $this->where = "usuario='" . $usuario . "'";
                $existe = $this->recordExists($this->_table, $this->where);
               
                if ($existe === TRUE) {
                    $response_data['existe'] = 'ok';
                    $response_data['msg']    = 'El Nombre del Departamente se encuentra registrado en el sistema';
                }else{
                    
                    $datos['clave']                   = $this->clave(trim($datos['clave']));
                    $this->_datos                     = $datos;
                    $this->_datos['fecha_creacion']   = date("Y-m-d H:i:s");
                    $this->_datos['usuario_creacion'] = $this->id_usuario;
                    $response_data = $this->add();
                }
            break;
            case 'update':
                $this->_datos                         = $datos;
                $this->_datos['clave']                = $this->clave(trim($this->_datos['clave']));
                $this->_datos['fecha_actualizacion']  = date("Y-m-d H:i:s");
                $this->_datos['usuario_modificacion'] = $this->id_usuario;
                $response_data                        = $this->mod();
                break;
            case 'delete':
                $this->_datos  = $datos;
                $response_data = $this->del();
            break;
        }
        return $response_data;
    }
    
    public function addUsuarioF($datos)
    {

        try {

            $this->autoIncrement('s_usuario', 'id_usuario');
            
            $datuser['id_usuario']    = $this->auto_increment;
            $datuser['usuario']       = $datos['usuario'];
            $datuser['clave']         = $datos['clave'];
            $datuser['codigo_perfil'] = $datos['tipo_usuario'];
            $datuser['activo']        = $datos['estatus'];
            $usuario                  = $datos['usuario'];
            
            $exi_ced = (boolean)$this->recordExists("s_usuario", " usuario = '" . $usuario . "'");
            //$exi_ced = FALSE;
            if ($exi_ced === TRUE) {
                $this->_cod_msg   = 15;
                $this->_mensaje   = '<span style="color:#FF0000">El Usuario se encuentra Registrado en el sistema</span>';
            } else {
                $resultado = $this->addUsuario($datuser);
                
                if($resultado['error_codmensaje'] == 21){
                    $this->autoIncrement('usuario_f', 'id_usuario_f');
                    $ultimo     = $this->auto_increment;
                    $usuario    = $this->last('s_usuario'," usuario = '" . $usuario . "'");
                    $id_usuario = $usuario['id_usuario'];
                    
                    $dats['id_usuario_f']    = $ultimo;
                    $dats['nombre']          = $datos['nombre'];
                    $dats['apellido']        = $datos['apellido'];
                    $dats['id_departamento'] = $datos['id_departamento'];
                    $dats['activo']          = $datos['estatus'];
                    $dats['id_usuario']      = $id_usuario;
                    $insert = $this->insert('usuario_f', $dats);
                    if ($insert === TRUE) {
                        $this->_cod_msg = 21;
                        $this->_mensaje = "El Registro ha sido Guardado Exitosamente";
                    } else {
                        $this->_cod_msg = 16;
                        $this->_mensaje = '<span style="color:#FF0000">Ocurrio un error comuniquese con informatica</span>';
                    }
                }else if($resultado['error_codmensaje'] == 15){
                    $this->_cod_msg = 15;
                    $this->_mensaje = "<span style='color:#FF0000'>El Nombre del Usuario ya existe</span>";
                }else{
                    $this->_cod_msg = 20;
                    $this->_mensaje = "<span style='color:#FF0000'>Hubo un error comuniquese con Inform&aacute;tica</span>";
                }

                
            }
            throw new Exception($this->_mensaje, $this->_cod_msg);
        } catch (Exception $e) {
            return array('error_codmensaje' => $e->getCode(), 'error_mensaje' => $e->getMessage());
        }
    }
    public function getTipoUsuario()
    {
        $data  = array(
                    'tabla' => 's_perfil',
                    'campos' => "codigo_perfil, perfil",
                    'condicion'=>'codigo_perfil > 2'
                    );
        $result = $this->select($data, FALSE);
        return $result;
    }
    
     public function getUsuarioF()
    {
        $data  = array(
                    'tabla'     => 's_usuario AS su,s_perfil AS sp,usuario_f AS uf,departamento AS dp ',
                    'campos'    => "uf.id_usuario_f,su.usuario,uf.nombre,uf.apellido,su.perfil_id, sp.perfil,uf.departamento_id,dp.nombre_departamento,su.activo",
                    'condicion' => 'su.perfil_id=sp.id AND su.id=uf.usuario_id AND uf.departamento_id=dp.id',
                    'order by'  => 'uf.id'
                    );
        $result = $this->select($data, FALSE);
        return $result;
    }

}