<?php

//define('BASEPATH', str_replace("\\", "/", $system_path));
define('BASEPATH', '');

require_once '../../modelo/seguridad/Usuario.php';
$user = new Usuario();
if (!isset($_POST['accion'])) {
    
} else {
    $resultado = $user->accion($_POST);
    echo json_encode($resultado);
        
    /*switch ($accion) {
        case 'Agregar':
            $resultado = $user->addUsuario($datos);
            echo json_encode($resultado);
        break;
        case 'Ingresar':
            $passw = $user->loginUsuario($usuario, $clave, $tipo, $status);
            if ($passw === TRUE) {
                echo 500;
            } else if ($passw == 4) {
                echo $passw;
            } else if ($passw == 2) {
                echo $passw;
            } else if ($passw == 1) {
                echo $passw;
            } else {
                echo 0;
            }
        break;
    }*/
}
?>
