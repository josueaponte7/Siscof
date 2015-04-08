<?php
error_reporting(0);
session_start();
define('BASEPATH', dirname(__DIR__) . '/');
define('BASEURL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(BASEPATH))));


require_once '../../librerias/globales.php';
require_once '../../modelo/inventario/Herramientas.php';
require_once '../../modelo/mantenimientos/Departamento.php';

$objdep = new Departamento();
$objmod = new Herramientas();

if (isset($_GET['modulo'])) {
    $objmod->url($_SERVER['SCRIPT_FILENAME'], $_GET['modulo']);
}

$img_mod      = _img_dt . _img_dt_mod;
$img_del      = _img_dt . _img_dt_del;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_boostrap; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_boostrap_theme; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_select2; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_select2_bootstrap; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_dataTablesbootstrap; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_dataTablesresponsive; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_animate; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_estilo; ?>"/>
        <script src="<?php echo _ruta_librerias_js . _js_jquery; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_bootstrap; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_select2; ?>" type="text/javascript"></script>
        <!--<script src="<?php echo _ruta_librerias_js . _js_select2_es; ?>" type="text/javascript"></script>-->
        <script src="<?php echo _ruta_librerias_js . _js_dataTable; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_dataTableboostrap; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_dataTableresponsive; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_text_counter; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_validarcampos; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_librerias; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_script_js . 'herramientas.js' ?>" type="text/javascript"></script>
    </head>
    <body>
        <div class="panel panel-default" style="width : 90%;margin: auto;height: auto;position: relative; top:25px;">
            <div class="panel-heading" style="font-weight: bold;font-size: 12px;">Registrar Herramientas</div>
            <div class="panel-body">
                <form name="frmherramienta" id="frmherramienta" method="post" enctype="multipart/form-data">
                    <div class="row form-inline">
                        <div class="form-group col-xs-6">
                            <label>Departamento:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <select style="width: 70%"  id="departamento_id"  name="departamento_id"  class="form-control select2 input-sm">
                                <option value="0">Seleccione</option>
                                <?php
                                $result_depar = $objdep->getDepartamento();
                                for ($i = 0; $i < count($result_depar); $i++) {
                                    ?>
                                    <option  value="<?php echo $result_depar[$i]['id'] ?>"><?php echo $result_depar[$i]['nombre_departamento'] ?></option>
                                <?php }
                                ?>
                            </select>
                        </div> 
                        <div class="form-group col-xs-6">
                            <label>Usuario:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <select style="width: 70%"  id="usuariof_id"  name="usuariof_id"  class="form-control select2 input-sm">
                                <option value="0">Seleccione</option>
                                <?php
                                $result_depar = $objdep->getDepartamento();
                                for ($i = 0; $i < count($result_depar); $i++) {
                                    ?>
                                    <option  value="<?php echo $result_depar[$i]['id'] ?>"><?php echo $result_depar[$i]['nombre_departamento'] ?></option>
                                <?php }
                                ?>
                            </select>
                        </div> 
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>