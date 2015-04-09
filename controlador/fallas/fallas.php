<?php

define('BASEPATH', '');

if (!isset($_POST['accion'])) {
    exit("<div style='color:#FF0000;text-align:center;margin:0 auto'>Acceso Denegado</div>");
} else {
    $accion = addslashes($_POST['accion']);
    
    require_once '../../modelo/fallas/Fallas.php';
    $obj = new Fallas();

    if (isset($_POST['problema'])) {
        $datos['problema'] = $_POST['problema'];
    }
    if (isset($_POST['num_falla'])) {
        $datos['num_falla'] = $_POST['num_falla'];
    }
    
    if (isset($_POST['id_departamento'])) {
        $datos['id_departamento'] = $_POST['id_departamento'];
    }

    if (isset($_POST['estatus'])) {
        $datos['estatus'] = $_POST['estatus'];
    }
    if (isset($_POST['id_usuario'])) {
        $datos['id_usuario'] = $_POST['id_usuario'];
    }
    if (isset($_POST['cod_falla'])) {
        $datos['cod_falla'] = $_POST['cod_falla'];
    }
    switch ($accion) {
        case 'agregar':
            $resultado = $obj->addFallas($datos);
            echo json_encode($resultado);
        break;
    }
}
