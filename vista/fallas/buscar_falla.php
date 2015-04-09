<?php
session_start();
define('BASEPATH', dirname(__DIR__) . '/');
define('BASEURL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(BASEPATH))));
require_once '../../modelo/fallas/AsignarFalla.php';
$obj      = new Fallas();
$id_falla = $_POST['id_falla'];

$sql    = "SELECT problema FROM fallas WHERE id_falla=$id_falla";
$result = $obj->ex_query($sql);
echo $result[0]['problema'];
