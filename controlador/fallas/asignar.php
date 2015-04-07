<?php

define('BASEPATH', '');

if (!isset($_POST['accion'])) {
    exit("<div style='color:#FF0000;text-align:center;margin:0 auto'>Acceso Denegado</div>");
} else {
    $accion = addslashes($_POST['accion']);
    
    require_once '../../modelo/fallas/AsignarFalla.php';
    $obj = new AsignarFalla();

    if (isset($_POST['id_falla'])) {
        $datos['id_falla'] = $_POST['id_falla'];
    }
    if (isset($_POST['tecnico'])) {
        $datos['id_usuario'] = $_POST['tecnico'];
    }
    switch ($accion) {
        case 'Asignar':
            $resultado = $obj->asignarFallas($datos);
            echo json_encode($resultado);
        break;
    }
}
