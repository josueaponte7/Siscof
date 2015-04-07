<?php

define('BASEPATH', '');


if (!isset($_POST['accion'])) {
    exit("<div style='color:#FF0000;text-align:center;margin:0 auto'>Acceso Denegado</div>");
} else {
    $accion = addslashes($_POST['accion']);

    require_once '../../modelo/inventario/Componente.php';
    $obj = new Componente();
    
    if (isset($_POST['nombre_componente'])) {
        $datos['id_items'] = $_POST['nombre_componente'];
    }
    if (isset($_POST['marca_componente'])) {
        $datos['marca_componente'] = $_POST['marca_componente'];
    }

    if (isset($_POST['serial_componente'])) {
        $datos['serial_componente'] = $_POST['serial_componente'];
    }
    
    if (isset($_POST['num_bien_componente'])) {
        $datos['num_bien_componente'] = $_POST['num_bien_componente'];
    }
    if (isset($_POST['id_componente'])) {
        $datos['id_componente'] = $_POST['id_componente'];
    }
    
    switch ($accion) {
        case 'Agregar':
            $resultado = $obj->addComponente($datos);
            echo json_encode($resultado);
        break;
        case 'Modificar':
             $resultado = $obj->editComponente($datos);
            echo json_encode($resultado);
        break;
        case 'Eliminar':
            $resultado = $obj->delComponente($datos);
            echo json_encode($resultado);
        break;
    }
}
