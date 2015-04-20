<?php
session_start();
define('BASEPATH', dirname(__DIR__) . '/');
define('BASEURL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(BASEPATH))));

require '../../librerias/globales.php';
require_once '../../modelo/mantenimientos/Items.php';

$objmod = new Items();

if (isset($_GET['modulo'])) {
    $objmod->url($_SERVER['SCRIPT_FILENAME'], $_GET['modulo']);
    $_SESSION['cod_modulo'] = $_GET['modulo'];
}

$img_mod  = _img_dt . _img_dt_mod;
$img_del  = _img_dt . _img_dt_del;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_boostrap; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_boostrap_theme; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_dataTablesbootstrap; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_dataTablesresponsive; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_animate; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_estilo; ?>"/>

        <script src="<?php echo _ruta_librerias_js . _js_jquery; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_bootstrap; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_dataTable; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_dataTableboostrap; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_dataTableresponsive; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_validarcampos; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_librerias; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_script_js . 'items.js' ?>" type="text/javascript"></script>

    </head>
    <body>
        <div class="panel panel-default" style="width : 95%;margin: auto;height: auto;position: relative; top:25px;">
            <div class="panel-heading" style="font-weight: bold;font-size: 12px;">Registr&oacute; de Bienes</div>
            <div class="panel-body">
                <form name="frmregistrar" id="frmregistrar" method="post" enctype="multipart/form-data">
                    <div class="form-inline">
                        <div class="form-group col-xs-6">
                            <label>C&oacute;digo del Bien:</label>
                            <input type="text" style="width: 65%;color: #FF0000;font-weight: bold;background-color:#FFFFFF " disabled="disabled" id="codigo_bien" name="codigo_bien" class="form-control input-sm" />                           
                        </div>
                        <div class="form-group col-xs-6">
                            <label>Nombre del Bien:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <input type="text" style="width: 65%;" id="nombre_bien" name="nombre_bien" maxlength="45" class="form-control input-sm"/> 
                        </div>                        
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <div class="form-inline">
                        <div class="form-group col-xs-6">
                            <label>N&deg; de Serial:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <input type="text" style="width: 65%;" id="serial_bien" name="serial_bien" maxlength="20" class="form-control input-sm" >                           
                        </div>
                        <div class="form-group col-xs-6">
                            <label>N&deg; de Bien Nacional:</label>
                            <input type="text" style="width: 65%;" id="numero_bien" name="numero_bien" class="form-control input-sm" maxlength="10" /> 
                        </div>                        
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <div class="form-inline col-xs-12">
                        <label>Descripci&oacute;n:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <textarea class="form-control input-sm"  style="width: 86%;resize: none" id="descripcion_bien" name="descripcion_bien" maxlength="150" ></textarea>    
                    </div> 

                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <div class="row" style="text-align:center;">
                        <input type="hidden" name="id" value="" id="id"/>
                        <button type="button" id="guardar" class="btn btn-primary btn-sm">Guardar</button>
                        <button type="button" id="limpiar" class="btn btn-primary btn-sm">Limpiar</button>
                    </div>
                </form>
                <div style="margin:auto;width:95%">
                    <input type="hidden" name="fila" value="" id="fila"/>
                    <table  id="tabla_registrar" border="0" cellspacing="1" class="tablas table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
                        <thead>
                            <tr class="success">
                                <th>&nbsp;</th>
                                <th>C&oacute;digo</th>
                                <th>Nombre</th>
                                <th>N&deg; de Serial</th>
                                <th>N&deg; de Bien Nacional</th>
                                <th>Descripci&oacute;n</th>
                                <th>Modificar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result   = $objmod->getItems();
                            $es_array = is_array($result) ? TRUE : FALSE;
                            if ($es_array === TRUE) {
                                for ($i = 0; $i < count($result); $i++) {
                                    ?>
                                    <tr id="<?php echo $result[$i]['id']; ?>" > 
                                        <td>
                                            &nbsp;
                                        </td>
                                        <td>
                                            <?php echo $result[$i]['codigo_bien']; ?>
                                        </td>
                                        <td>
                                            <?php echo $result[$i]['nombre_bien']; ?>
                                        </td>
                                        <td>
                                            <?php echo $result[$i]['serial_bien']; ?>
                                        </td>
                                        <td>
                                            <?php echo $result[$i]['numero_bien']; ?>
                                        </td>                                                                    
                                        <td>
                                            <?php echo $result[$i]['descripcion_bien']; ?>
                                        </td>  
                                        <td>
                                            <img class="modificar"  title="Modificar" style="cursor: pointer" src="<?php echo $img_mod ?>" width="18" height="18" alt="Modificar"/>
                                        </td>
                                        <td>
                                            <img class="eliminar"  title="Eliminar" style="cursor: pointer" src="<?php echo $img_del ?>" width="18" height="18" alt="Modificar"/>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>