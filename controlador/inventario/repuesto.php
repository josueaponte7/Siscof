<?php

define('BASEPATH', '');

if (!isset($_POST['accion'])) {
    exit("<div style='color:#FF0000;text-align:center;margin:0 auto'>Acceso Denegado</div>");
} else {
    $accion = addslashes($_POST['accion']);

    require_once '../../modelo/inventario/Repuesto.php';
    $obj = new Repuesto();
    
    if (isset($_POST['nombre_repuesto'])) {
        $datos['id_items'] = $_POST['nombre_repuesto'];
    }
    if (isset($_POST['marca_repuesto'])) {
        $datos['marca_repuesto'] = $_POST['marca_repuesto'];
    }

    if (isset($_POST['modelo_repuesto'])) {
        $datos['modelo_repuesto'] = $_POST['modelo_repuesto'];
    }    
    if (isset($_POST['id_repuesto'])) {
        $datos['id_repuesto'] = $_POST['id_repuesto'];
    }
    switch ($accion) {
        case 'Agregar':
            $resultado = $obj->addRepuesto($datos);
            echo json_encode($resultado);
        break;
        case 'Modificar':
             $resultado = $obj->editRespuesto($datos);
            echo json_encode($resultado);
        break;
    case 'Eliminar':
            $resultado = $obj->delRespuesto($datos);
            echo json_encode($resultado);
        break;
    }
}
