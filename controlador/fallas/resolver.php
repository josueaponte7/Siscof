<?php

define('BASEPATH', '');

if (!isset($_POST['accion'])) {
    exit("<div style='color:#FF0000;text-align:center;margin:0 auto'>Acceso Denegado</div>");
} else {
    $accion = addslashes($_POST['accion']);
    
    require_once '../../modelo/fallas/ResolverFallas.php';
    $obj = new ResolverFallas();

    if (isset($_POST['id_falla'])) {
        $datos['id_falla'] = $_POST['id_falla'];
    }
    if (isset($_POST['id_usuario'])) {
        $datos['id_usuario'] = $_POST['id_usuario'];
    }
    if (isset($_POST['descripcion'])) {
        $datos['descripcion'] = $_POST['descripcion'];
    }
    if (isset($_POST['estatus'])) {
        $datos['estatus'] = $_POST['estatus'];
    }
    switch ($accion) {
        case 'Resolver':
            $resultado = $obj->resolverFallas($datos);
            echo json_encode($resultado);
        break;
    }
}
