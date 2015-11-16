<?php
error_reporting(0);
session_start();
define('BASEPATH', dirname(__DIR__) . '/');
define('BASEURL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(BASEPATH))));

require '../../librerias/globales.php';
require_once '../../modelo/inventario/Consumible.php';

$objmod = new Consumible();

if (isset($_GET['modulo'])) {
    $objmod->url($_SERVER['SCRIPT_NAME'], $_GET['modulo']);
}

$img_mod = _img_dt . _img_dt_mod;
$img_del = _img_dt . _img_dt_del;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_boostrap; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_boostrap_theme; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_estilos; ?>"/>

        <script src="<?php echo _ruta_librerias_js . _js_jquery; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_bootstrap; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_dataTable; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_bootstrap_tooltip; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_validarcampos; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_script_js . 'consumible.js' ?>" type="text/javascript"></script>

    </head>
    <body>
        <div class="panel panel-default" style="width : 90%;margin: auto;height: auto;position: relative; top:25px;">
            <div class="panel-heading" style="font-weight: bold;font-size: 12px;">Registrar Consumibles</div>
            <div class="panel-body">
                <form name="frmregistrar" id="frmregistrar" method="post" enctype="multipart/form-data">
                    <table width="783" height="395" align="center">
                        <tr>
                            <td width="29" height="40" align="left">&nbsp;</td>
                            <td width="100" height="40" align="left">Nombre Consumible:</td>
                            <td width="238">
                                <div style="margin-top: 10px" class="form-group">
                                    <input type="text" class="form-control input-sm" id="nombre_consumible" name="nombre_consumible" maxlength="50" />
                                </div>
                            </td>
                            <td width="54">&nbsp;</td>
                            <td width="97" height="40" align="left">Marca Consumible:</td>
                            <td width="184">
                                <div style="margin-top: 10px" class="form-group">
                                    <input type="text" class="form-control input-sm" id="marca_consumible" name="marca_consumible" maxlength="50" />
                                </div>
                            </td>
                            <td width="49">&nbsp;</td>
                        </tr>
                        <td colspan="7" align="center"> 
                            <div id="botones" style="margin-top: 50px;">
                                <input type="hidden" name="accion" value="agregar" id="accion"/>
                                <button type="button" id="guardar" class="btn btn-primary btn-sm">Guardar</button>
                                <button type="button" id="limpiar" class="btn btn-primary btn-sm">Limpiar</button>
                                <button type="button" id="salir" class="btn btn-primary btn-sm">Salir</button>
                            </div>
                        </td>

                        <tr>
                            <td  colspan="6" align="center">&nbsp;</td>
                        </tr>

                        <tr>
                            <td  colspan="7" align="center">
                                <div style="margin:auto;width:95%">
                                    <table  id="tabla_registrar" border="0" cellspacing="1" class="dataTable">
                                        <thead>
                                            <tr>
<!--                                                <th>Cod. Consumible</th>-->
                                                <th>Nombre Consumible</th>
                                                <th>Marca Consumible</th>
                                                <th>Modificar</th>
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                        $result = $objmod->getConsumible();
                                                        $es_array = is_array($result) ? TRUE : FALSE;
                                                        if ($es_array === TRUE) {
                                                            for ($i = 0; $i < count($result); $i++) {
                                                                ?>
                                                                <tr>                                                                    
                                                                    <td>
                                                                        <?php echo $result[$i]['nombre_consumible']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $result[$i]['marca_consumible']; ?>
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
                            </td>
                        </tr>
                        <tr>
                            <td  colspan="7" align="center">&nbsp;</td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>