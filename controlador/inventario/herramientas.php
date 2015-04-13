<?php

define('BASEPATH', '');

if (!isset($_POST['accion'])) {
    exit("<div style='color:#FF0000;text-align:center;margin:0 auto'>Acceso Denegado</div>");
} else {
    require_once '../../modelo/inventario/Herramientas.php';
    $obj = new Herramientas();
    $resultado = $obj->accion($_POST);
    echo $resultado;
}
