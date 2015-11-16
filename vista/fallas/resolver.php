<?php
session_start();
define('BASEPATH', dirname(__DIR__) . '/');
define('BASEURL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(BASEPATH))));

require_once '../../librerias/globales.php';
require_once '../../modelo/mantenimientos/Items.php';
$objitems = new Items();
if (isset($_GET['modulo'])) {
    $_SESSION['cod_modulo'] = $_GET['modulo'];
    $objitems->url($_SERVER['SCRIPT_NAME'], $_GET['modulo']);
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
        <script src="<?php echo _ruta_librerias_script_js . 'desincoporar.js' ?>" type="text/javascript"></script>
        <style type="text/css">
            ul#cod_local,ul#cod_cel,ul#nacionalidad{
                min-width:50px !important;
                width: 50px !important;

            }
            ul#cod_local > li > span,ul#cod_cel > li > span{
                text-align:center !important;
                padding: 2px !important;
            }
        </style>
    </head>
    <body>
        <div id="contenedor" class="panel panel-default animated slideInDown" style="width : 90%;margin: auto;height: auto;position: relative; top:25px;">
            <div class="panel-heading" style="font-weight: bold;font-size: 12px;">Desincorporar Bienes</div>
            <div class="panel-body">
                <table id="tabla_desincorporar" border="0" cellspacing="1"  class="tablas table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive" >
                    <thead>
                        <tr class="success">
                            <th>C&oacute;digo</th>
                            <th>Bien</th>                            
                            <th>Serial</th>
                            <th>N&uacute;mero de Bien Nacional</th>
                            <th>Estatus</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data['tabla'] = 'bien';
                        $data['campos'] = 'id,codigo_bien,nombre_bien,serial_bien,numero_bien,descripcion_bien';
                        $data['consicion'] = 'incorporado=0';
                        $result = $objitems->getItems($data);
                        for ($i = 0; $i < count($result); $i++) {
                            ?>
                            <tr>
                                <td><?php echo $result[$i]['codigo_bien']; ?></td>
                                <td><?php echo $result[$i]['nombre_bien']; ?></td>
                                <td><?php echo $result[$i]['serial_bien']; ?></td>
                                <td><?php echo $result[$i]['numero_bien']; ?></td>
                                <td>DESINCORPORADO</td>
                                <td><input type="checkbox" name="desincorporar[]" value="<?php echo $result[$i]['id']; ?>" /></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <br/>
                <br/>
                <div id="div_desincorporar" class="row" style="text-align:center;display: none">
                    <input type="hidden" name="id" value="" id="id"/>
                    <button type="button" id="guardar" class="btn btn-primary btn-sm">Desincorporar del Sistema</button>
                    <button type="button" id="limpiar" class="btn btn-primary btn-sm">Cancelar</button>
                </div>
            </div>
        </div>
    </body>
</html>