<?php

define('BASEPATH', '');

//$resulsub  = $obj->getSubModulos(1);

if (!isset($_POST['accion'])) {
    exit("<div style='color:#FF0000;text-align:center;margin:0 auto'>Acceso Denegado</div>");
} else {
    
    require_once '../../modelo/seguridad/SubModulo.php';
    $obj = new SubModulo();
    $resultado  = $obj->accion($_POST);
    echo json_encode($resultado);
}

