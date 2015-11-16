<?php

define('BASEPATH', '');



if (!isset($_POST['accion'])) {
    exit("<div style='color:#FF0000;text-align:center;margin:0 auto'>Acceso Denegado</div>");
} else {
    
    require_once '../../modelo/seguridad/Modulo.php';
    $obj = new Modulo();
    $resultado  = $obj->accion($_POST);
    echo json_encode($resultado);
    //$accion = addslashes($_POST['accion']);
    
}