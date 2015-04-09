<?php

define('BASEPATH', '');


if (!isset($_POST['accion'])) {
    exit("<div style='color:#FF0000;text-align:center;margin:0 auto'>Acceso Denegado</div>");
} else {
    $accion = addslashes($_POST['accion']);
    
    require_once '../../modelo/inventario/Consumible.php';
    $obj = new Consumible();
    
    if (isset($_POST['nombre_consumible'])) {
        $datos['nombre_consumible'] = $_POST['nombre_consumible'];
    }
    if (isset($_POST['marca_consumible'])) {
        $datos['marca_consumible'] = $_POST['marca_consumible'];
    }
    
    
    switch ($accion) {
        case 'agregar':
            $resultado = $obj->addConsumible($datos);
            echo json_encode($resultado);
        break;
    }
}
