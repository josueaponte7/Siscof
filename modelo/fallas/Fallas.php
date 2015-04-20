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
    
    public function accion($datos)
    {
        
        session_start();
        $this->id_usuario    = $_SESSION['id_usuario'];
        $this->_accion = $datos['accion'];
        $this->_accion = $datos['accion'];
        $this->_datos  = $datos;
        switch ($this->_accion) {
            case 'save':
                $this->_table = 'fallas';
                $this->autoIncrement($this->_table);
                $cod_falla = (int)substr($datos['num_falla'], -2); 
                $data['id']            = $this->auto_increment;
                $data['cod_falla']     = $cod_falla;
                $data['num_falla']     = $datos['num_falla'];
                $data['fecha']         = date("Y-m-d");
                $data['problema']      = $datos['problema'];
                $data['bien_id']       = $datos['bien_id'];
                $data['usuario_fa_id'] = $datos['usuariof_id'];
                $data['usuario_re_id'] = $datos['usuario_id'];
                $data['id_estatus']    = 1;
                $data['accion']        = $datos['accion'];
                $this->_datos          = $data;
                $response_data         = $this->add();
            break;
            case 'bien':
                
                $data['tabla'] = "bien AS b, usuario_f AS uf";
                $data['campos'] = "b.id,numero_bien,CONCAT(b.codigo_bien,' (',b.nombre_bien,')') AS nombre_bien";
                $data['condicion'] = 'b.usuariof_id=uf.id AND uf.departamento_id=' . $datos['id'];

                $result = $this->select($data, 'ASSOC');
                $resultado = array();
                for ($i = 0; $i < count($result); $i++) {
                    $response_data[] = array('id'=>$result[$i]['id'],'numero_bien'=>$result[$i]['numero_bien'],'nombre_bien'=>$result[$i]['nombre_bien']);
                }

            break;
            case 'usuario':
                $data      = array(
                    'tabla'     => 'bien AS b, usuario_f AS uf',
                    'campos'    => "uf.id,CONCAT_WS(' ', uf.nombre, uf.apellido) AS nombres, (SELECT CONCAT(DATE_FORMAT(CURRENT_DATE(),'%m%y'),(SELECT codigo_bien FROM bien WHERE id=".$datos['id']."),LPAD(IF(COUNT(cod_falla)= 0,1,cod_falla+1),2,'0')) FROM fallas WHERE bien_id=".$datos['id']." ORDER BY num_falla DESC LIMIT 1) AS num_falla",
                    'condicion' => 'b.usuariof_id=uf.id AND b.id=' . $datos['id']
                );
                
                $result                 = $this->select($data, 'ASSOC');
                $response_data['id']        = (int) $result[0]['id'];
                $response_data['nombres']   = $result[0]['nombres'];
                $response_data['num_falla'] = $result[0]['num_falla'];
            break;
            case 'procesar':
                $this->_table = 'fallas';
                $num_falla = $datos['num_falla'];
                $id = $this->get($this->_table, 'id', 'num_falla='.$num_falla);
                
                $dato['id']         = $id;
                $dato['id_estatus'] = 3;
                $dato['accion']     = 'update';
                $this->_datos       = $dato;
                $response_data      = $this->mod();
            break;
            case 'cerrar':
                
                $this->_table        = 'fallas_resuelta';
                $this->autoIncrement($this->_table);
                
                $dato['id']          = $this->auto_increment;
                $dato['num_falla']   = $datos['num_falla'];
                $dato['descripcion'] = $datos['descripcion'];
                $dato['usuario_id']  = $datos['usuario_id'];
                $dato['fecha']       = date("Y-m-d");
                $dato['accion']      = 'save';
                $this->_datos        = $dato;
                $this->add();
                /*$this->_table = 'fallas';
                $num_falla = $datos['num_falla'];
                $id = $this->get($this->_table, 'id', 'num_falla='.$num_falla);
                
                $dato['id']         = $id;
                $dato['id_estatus'] = 3;
                $dato['accion']     = 'update';
                $this->_datos       = $dato;
                $response_data      = $this->mod();*/
            break;
        }
        return $response_data;
    }
    public function getFallas($datos=array())
    {
        $usuario_id = $_SESSION['id_usuario'];
        $data  = array(
                    'tabla'     =>'fallas AS f, bien AS b, usuario_f as uf, estatus_fallas AS ef',
                    'campos'    =>"f.num_falla,f.problema,b.codigo_bien,b.nombre_bien,CONCAT(uf.nombre,' ',uf.apellido) AS nombres,date_format(f.fecha,'%d/%m/%Y') AS fecha,ef.estatus",
                    'condicion' =>"f.usuario_re_id=$usuario_id AND f.bien_id=b.id AND f.usuario_fa_id=uf.id AND f.id_estatus=ef.id",
                    'order by'  =>'f.id DESC'
                    );
        $dat = array_merge($data,$datos);
        $result = $this->select($dat, FALSE);
        return $result;
    }
    public function getEstatusFallas($datos=array())
    {
        $data['tabla']  = "estatus_fallas";
        $data['campos'] = "id,estatus";
        $dat = array_merge($data,$datos);
        $result = $this->select($dat, 'ASSOC');
        return $result;
    }

}