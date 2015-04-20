<?php
session_start();
define('BASEPATH', dirname(__DIR__) . '/');
define('BASEURL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(BASEPATH))));


require_once '../../librerias/globales.php';
require_once '../../modelo/mantenimientos/Items.php';
$objitems = new Items();
if (isset($_GET['modulo'])) {
    $_SESSION['cod_modulo'] = $_GET['modulo'];
    $objitems->url($_SERVER['SCRIPT_FILENAME'], $_GET['modulo']);
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
        <script src="<?php echo _ruta_librerias_script_js . 'componente.js' ?>" type="text/javascript"></script>
        <style>
            #contenedor{
                -moz-animation-duration: 5s;
                -webkit-animation-duration: 5s;
                -o-animation-duration: 5s;
            }
        </style>
    </head>
    <body>
        <div id="contenedor" class="panel panel-default animated slideInDown" style="width : 90%;margin: auto;height: auto;position: relative; top:25px;">
            <div class="panel-heading" style="font-weight: bold;font-size: 12px;">Incorporar/Desincorporar Bienes</div>
            <div class="panel-body">
                <form name="frmusuario" id="frmusuario" method="post" enctype="multipart/form-data">
                    <div class="row form-inline">
                        <div class="form-group col-xs-6">
                            <label>Numero de Bien:</label>
                            <select style="width: 70%"  id="bien"  name="bien"  class="form-control select2 input-sm">
                                <option value="0">Seleccione</option>
                                <?php
                                $result_depar = $objitems->getItems();
                                for ($i = 0; $i < count($result_depar); $i++) {
                                    ?>
                                    <option  value="<?php echo $result_depar[$i]['id'] ?>"><?php echo $result_depar[$i]['numero_bien'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div> 
                        <div class="form-group col-xs-6">
                            <label>C&oacute;digo del Bien:&nbsp;</label>
                            <input type="text" disabled="disabled" style="width: 70%" id="codigo" name="codigo" class="form-control input-sm"  value="" maxlength="22" />
                        </div> 
                    </div>
                    <br/>
                    <div class="row form-inline">
                        <div class="form-group col-xs-6">
                            <label>Serial del Bien:&nbsp;&nbsp;</label>
                            <input type="text" disabled="disabled" style="width: 70%" id="serial" name="serial" class="form-control input-sm"  value="" maxlength="22" />
                        </div>
                        <div class="form-group col-xs-6">
                            <label>Nombre Bien:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <input type="text" disabled="disabled" style="width: 70%" id="numero" name="numero" class="form-control input-sm"  value="" maxlength="22" />
                        </div>                        
                    </div>
                    <br/>
                    <div class="row form-inline">
                        <div class="form-group col-xs-6">
                            <label>Estatus:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <select style="width: 70%"  id="incorporado"  name="incorporado"  class="form-control select2 input-sm">
                                <option value="2">Seleccione</option>
                                <option value="1">Incorporar</option>
                                <option value="0">Desincorporar</option>
                            </select>
                        </div>
                    </div>
                    <br/>
                    <br/>
                    <div class="row form-inline">
                        <div class="form-group col-xs-12" style="text-align: center">
                            <button type="button" id="guardar" class="btn btn-primary btn-sm">Guardar</button>
                            <button type="button" id="limpiar" class="btn btn-primary btn-sm">Limpiar</button>
                        </div>
                    </div>
                </form>
                <table id="tabla_usuarios" border="0" cellspacing="1"  class="tablas table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive" >
                    <thead>
                        <tr class="success">
                            <th>C&oacute;digo</th>
                            <th>Bien</th>                            
                            <th>Serial</th>
                            <th>N&uacute;mero de Bien Nacional</th>
                            <th>Estatus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $objitems->getItems();
                        for ($i = 0; $i < count($result); $i++) {
                            
                            if($result[$i]['incorporado'] == 0){
                                $incorporado = 'Desincorporado';
                            }else if($result[$i]['incorporado'] == 1){
                                $incorporado = 'Incorporado';
                            }else if($result[$i]['incorporado'] == 2){
                                $incorporado = '';
                            }
                            ?>
                            <tr>
                                <td><?php echo $result[$i]['codigo_bien']; ?></td>
                                <td><?php echo $result[$i]['nombre_bien']; ?></td>
                                <td><?php echo $result[$i]['serial_bien']; ?></td>
                                <td><?php echo $result[$i]['numero_bien']; ?></td>
                                <td><?php echo $incorporado; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>