<?php

define('BASEPATH', '');


if (!isset($_POST['accion'])) {
    exit("<div style='color:#FF0000;text-align:center;margin:0 auto'>Acceso Denegado</div>");
} else {
    $accion = addslashes($_POST['accion']);

    require_once '../../modelo/inventario/Equipos.php';
    $obj = new Equipos();
    
    if (isset($_POST['cod_equipo'])) {
        $datos['cod_equipo'] = $_POST['cod_equipo'];
    }
    if (isset($_POST['marca'])) {
        $datos['marca'] = $_POST['marca'];
    }

    if (isset($_POST['modelo'])) {
        $datos['modelo'] = $_POST['modelo'];
    }
    
    if (isset($_POST['serial_equipo'])) {
        $datos['serial_equipo'] = $_POST['serial_equipo'];
    }
    
    if (isset($_POST['num_bien'])) {
        $datos['num_bien'] = $_POST['num_bien'];
    }
    
    if (isset($_POST['id_departamento'])) {
        $datos['id_departamento'] = $_POST['id_departamento'];
    }
    
    switch ($accion) {
        case 'agregar':
            $resultado = $obj->addEquipos($datos);
            echo json_encode($resultado);
        break;
    }
}
