<?php

define('BASEPATH', '');

if (!isset($_POST['accion'])) {
    exit("<div style='color:#FF0000;text-align:center;margin:0 auto'>Acceso Denegado</div>");
} else {
    $accion = addslashes($_POST['accion']);

    require_once '../../modelo/inventario/Herramientas.php';
    $obj = new Herramientas();
    
    if (isset($_POST['nombre_herramienta'])) {
        $datos['id_items'] = $_POST['nombre_herramienta'];
    }
    if (isset($_POST['marca_herramienta'])) {
        $datos['marca_herramienta'] = $_POST['marca_herramienta'];
    }

    if (isset($_POST['serial_herramienta'])) {
        $datos['serial_herramienta'] = $_POST['serial_herramienta'];
    }
    if (isset($_POST['id_herramientas'])) {
        $datos['id_herramientas'] = $_POST['id_herramientas'];
    }
    
    if (isset($_POST['num_bien_herramienta'])) {
        $datos['num_bien_herramienta'] = $_POST['num_bien_herramienta'];
    }
    if(isset($_POST['id_usuario_f'])){
        $datos['id_usuario_f'] = $_POST['id_usuario_f'];
    }
    switch ($accion) {
        case 'Agregar':
            $resultado = $obj->addHerramientas($datos);
            echo json_encode($resultado);
        break;
        case 'Modificar':
             $resultado = $obj->editHerramienta($datos);
            echo json_encode($resultado);
        break;
        case 'Eliminar':
            $resultado = $obj->delHerramienta($datos);
            echo json_encode($resultado);
        break;
    }
}
