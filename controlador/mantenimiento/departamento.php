<?php

define('BASEPATH', '');


if (!isset($_POST['accion'])) {
    exit("<div style='color:#FF0000;text-align:center;margin:0 auto'>Acceso Denegado</div>");
} else {
    $accion = addslashes($_POST['accion']);

    require_once '../../modelo/mantenimientos/Departamento.php';
    $obj = new Departamento();
    $resultado = $obj->accion($_POST);
    echo json_encode($resultado);
}
