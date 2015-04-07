<?php
error_reporting(0);
session_start();
define('BASEPATH', dirname(__DIR__) . '/');
define('BASEURL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(BASEPATH))));


require_once '../../librerias/globales.php';
require_once '../../modelo/inventario/Herramientas.php';
$objmod = new Herramientas();

if (isset($_GET['modulo'])) {
    $objmod->url($_SERVER['SCRIPT_FILENAME'], $_GET['modulo']);
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
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_estilos; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_select2; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_select2_bootstrap; ?>"/>

        <script src="<?php echo _ruta_librerias_js . _js_jquery; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_bootstrap; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_dataTable; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_select2; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_select2_es; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_bootstrap_tooltip; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_validarcampos; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_script_js . 'herramientas.js' ?>" type="text/javascript"></script>
    </head>
    <body>
        <div class="panel panel-default" style="width : 90%;margin: auto;height: auto;position: relative; top:25px;">
            <div class="panel-heading" style="font-weight: bold;font-size: 12px;">Registrar Herramientas</div>
            <div class="panel-body">
                <table width="742" border="0" align="center">
                    <tr>
                        <td width="736" align="center">
                            <form name="frmherramienta" id="frmherramienta" method="post" enctype="multipart/form-data">
                                <table width="736" align="center">
                                    <tr>
                                        <td width="105" height="40" align="left">Nombre Herramienta:</td>
                                         <td width="253">
                                            <div style="margin-top: 10px" class="form-group">
                                                <select  style="" name="nombre_herramienta" id="nombre_herramienta" class="form-control input-sm select2">
                                                        <option value="0">Seleccione</option>
                                                    <?php
                                                     $resultado = $objmod->getItems();
                                                    for ($i = 0; $i < count($resultado); $i++) {
                                                        ?>
                                                        <option style="font-size: 10px;" value="<?php echo $resultado[$i]['id_items']; ?>"><?php echo $resultado[$i]['nombre']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <!--<input type="text" class="form-control input-sm" id="nombre_herramienta" name="nombre_herramienta" value=""  maxlength="20" />-->
                                            </div>
                                        </td>
<!--                                        <td width="71">
                                            <img style="cursor: pointer" id="imgsector1" src="../../imagenes/img_info.png" width="15" height="15" alt="img_info"/>
                                        </td>-->
                                        <td width="116" height="40" align="right"><span style="margin-left: -750px;">Marca Herramienta:</span></td>
                                        <td width="237">
                                            <div style="margin-top: 10px;" class="form-group">
                                                <input type="text" class="form-control input-sm" id="marca_herramienta" name="marca_herramienta" value="" maxlength="20"/>
                                            </div>
                                        </td>
                                        <td width="1">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="105" height="40" align="left">Serial Herramienta:</td>
                                         <td width="253">
                                            <div style="margin-top: 10px" class="form-group">
                                                <input type="text" class="form-control input-sm" id="serial_herramienta" name="serial_herramienta" value=""  maxlength="20" />
                                            </div>
                                        </td>                                       
                                        <td width="116" height="40" align="right">Num Bien Herramienta:</td>
                                        <td width="237">
                                            <div style="margin-top: 10px;" class="form-group">
                                                <input type="text" class="form-control input-sm" id="num_bien_herramienta" name="num_bien_herramienta" value=""  maxlength="20"/>
                                            </div>
                                        </td>
                                        <td width="1">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="105" height="40" align="left">Nombre T&eacute;cnico:</td>
                                         <td width="253">
                                            <div style="margin-top: 10px" class="form-group">
                                                <select  style="" name="id_usuario_f" id="id_usuario_f" class="form-control input-sm select2">
                                                        <option value="0">Seleccione</option>
                                                    <?php                                                    
                                                    
                                                    $sql    = "SELECT 
                                                                uf.id_usuario_f,
                                                                uf.nombre,
                                                                uf.apellido
                                                              FROM
                                                                usuario_f AS uf 
                                                                INNER JOIN s_usuario AS su ON uf.id_usuario = su.id_usuario 
                                                                INNER JOIN s_perfil AS sp  ON su.codigo_perfil = sp.codigo_perfil 
                                                              WHERE sp.perfil = 'Informatico'";
                                                        $result = $objmod->ex_query($sql);
                                                            for ($i = 0; $i < count($result); $i++) {
                                                                ?>
                                                                <option style="font-size: 10px;" value="<?php echo $result[$i]['id_usuario_f']; ?>"><?php echo $result[$i]['nombre'].' '.$result[$i]['apellido'] ; ?></option>
                                                            <?php                                                            
                                                            
                                                            }
                                                        ?>
                                                </select>
                                                <!--<input type="text" class="form-control input-sm" id="nombre_herramienta" name="nombre_herramienta" value=""  maxlength="20" />-->
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  colspan="6" align="right">&nbsp;</td>
                                    </tr>
                                    <td colspan="7" align="center"> 
                                        <div id="botones" style="margin-top: 50px;">
                                            
                                            <button type="button" id="guardar" class="btn btn-primary btn-sm">Guardar</button>
                                            <button type="button" id="limpiar" class="btn btn-primary btn-sm">Limpiar</button>
                                            <button type="button" id="salir" class="btn btn-primary btn-sm">Salir</button>
                                        </div>
                                    </td>
                                    <tr>
                                        <td  colspan="6" align="center">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td  colspan="6" align="center">
                                            <table style="width:100%" border="0" align="center" cellspacing="1" class="dataTable" id="tabla_herramienta">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Nombre</th>
                                                        <th>Marca</th>
                                                        <th>Serial</th>
                                                        <th>Num de Bien</th>
                                                        <th>Usuario</th>
                                                        <th>Modificar</th>
                                                        <th>Eliminar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                  <?php
                                                  
                                                        $sql = "SELECT 
                                                                    ii.id_items,
                                                                    ii.nombre,
                                                                    h.marca_herramienta,
                                                                    h.serial_herramienta,
                                                                    h.num_bien_herramienta,
                                                                    h.id_herramientas,
                                                                    uf.nombre AS usuario,
                                                                    uf.apellido,
                                                                    uf.id_usuario_f 
                                                                FROM
                                                                  herramientas AS h 
                                                                  INNER JOIN items_inventario AS ii ON h.id_items = ii.id_items 
                                                                  INNER JOIN usuario_f AS uf ON h.id_usuario_f = uf.id_usuario_f;";
                                                        $result = $objmod->ex_query($sql);
                                                                            
                                                        $es_array = is_array($result) ? TRUE : FALSE;
                                                        if ($es_array === TRUE) {
                                                            for ($i = 0; $i < count($result); $i++) {
                                                                ?>
                                                                <tr> 
                                                                    <td>
                                                                        <?php echo $result[$i]['id_herramientas']; ?>
                                                                    </td>
                                                                    <td id="<?php echo $result[$i]['id_items']; ?>">
                                                                        <?php echo $result[$i]['nombre']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $result[$i]['marca_herramienta']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $result[$i]['serial_herramienta']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $result[$i]['num_bien_herramienta']; ?>
                                                                    </td>
                                                                    <td id="<?php echo $result[$i]['id_usuario_f']; ?>">
                                                                        <?php echo $result[$i]['usuario'] .' ' .$result[$i]['apellido']; ?>
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
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>