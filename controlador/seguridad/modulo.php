<?php

define('BASEPATH', '');

require_once '../../modelo/seguridad/Modulo.php';
$obj_modulo = new Modulo();

if (!isset($_POST['accion'])) {
    exit("<div style='color:#FF0000;text-align:center;margin:0 auto'>Acceso Denegado</div>");
} else {

    $accion = addslashes($_POST['accion']);
    if (isset($_POST['id'])) {
        $data['id'] = addslashes($_POST["id"]);
    }
    if (isset($_POST['modulo'])) {
        $data['modulo'] = addslashes($_POST["modulo"]);
    }
    if (isset($_POST['mod_estatus'])) {
        $data['activo'] = addslashes($_POST["mod_estatus"]);
    }
    if (isset($_POST['mod_posicion'])) {
        $data['posicion'] = addslashes($_POST["mod_posicion"]);
    }
    switch ($accion) {
        case 'save':
            $resultado = $obj_modulo->addModulo($data);
            echo $resultado;
        break;
        case 'Modificar':
            $resultado = $obj_modulo->editModulo($data);
            echo json_encode($resultado);
        break;
        case 'Eliminar':
            $resultado = $obj_modulo->delModulo($data);
            echo json_encode($resultado);
        break;
    }
}