<?php
session_start();
define('BASEPATH', dirname(__DIR__) . '/');
define('BASEURL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(BASEPATH))));

require_once '../../librerias/globales.php';
require_once '../../modelo/inventario/Equipos.php';
require_once '../../modelo/mantenimientos/Departamento.php';
$objmod = new Equipos();
$odjdep = new Departamento();

if (isset($_GET['modulo'])) {
    $objmod->url($_SERVER['SCRIPT_NAME'], $_GET['modulo']);
}
$objmod->autoIncrement('equipos', 'id_equipos');
$id_equipos = $objmod->auto_increment;
$ultimo = str_pad($objmod->auto_increment, 7, "0", STR_PAD_LEFT) ;

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
        <script src="<?php echo _ruta_librerias_js . _js_bootstrap_tooltip; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_select2; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_select2_es; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_validarcampos; ?>" type="text/javascript"></script>      
        <script src="<?php echo _ruta_librerias_script_js . 'equipos.js' ?>" type="text/javascript"></script>
        <style type="text/css">
            .tab-content {
                border-left: 1px solid #ddd;
                border-right: 1px solid #ddd;
                border-bottom: 1px solid #ddd;
                padding: 10px;
            }

            .nav-tabs {
                margin-bottom: 0;
            }
        </style>
    </head>
    <body>
        <div class="panel panel-default" style="width : 90%;margin: auto;height: auto;position: relative; top:25px;">
            <div class="panel-heading" style="font-weight: bold;font-size: 12px;">Registrar Equipos</div>
            <div class="panel-body">
                <table style="width: 100%" border="0" align="center">
                    <tr>
                        <td style="width: 100%" align="center">
                            <form name="frmequipo" id="frmequipo" method="post" enctype="multipart/form-data">
                                <table style="width:95%" border="0">
                                    <tr>
                                        <td width="10%" height="34" align="left">Cod Equipo:</td>
                                        <td width="38%">
                                            <div style="margin-top: 10px" class="form-group">
                                                <input type="hidden" id="id_equipo" name="id_equipo" value="<?php echo $id_equipos ?>"  />
                                                <input type="text" class="form-control input-sm" id="cod_equipo" name="cod_equipo" value="<?php echo $ultimo ?>" disabled="disabled" style="color: #FF0000; background-color: #FFFFFF" maxlength="20" />
                                            </div>
                                        </td>
<!--                                        <td width="8%">
                                            <img style="cursor: pointer" id="imgcedula" src="../../imagenes/img_info.png" width="15" height="15" alt="img_info"/>
                                        </td>-->
                                        <td width="14%" height="34" align="center"> <span style="margin-left: 10px;">Marca:</span></td>
                                        <td width="34%">
                                            <div style="margin-top: 10px" class="form-group">
                                                <input type="text" class="form-control input-sm" id="marca" name="marca" value="" maxlength="20" />
                                            </div>
                                        </td>
                                        <td width="4%">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td height="34" align="left">Modelo:</td>
                                        <td>
                                            <div style="margin-top: 10px" class="form-group">
                                                <input type="text" class="form-control input-sm" id="modelo" name="modelo" value="" maxlength="20" />
                                            </div>
                                        </td>
                                        <td height="34" align="right">Serial Equipo:</td>
                                        <td>
                                            <div style="margin-top: 10px" class="form-group">
                                                <input type="text" class="form-control input-sm" id="serial_equipo" name="serial_equipo" value="" maxlength="20" />
                                            </div>
                                        </td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td height="34" align="left">Num Bien.:</td>
                                        <td>
                                            <div style="margin-top: 10px" class="form-group">
                                                <input   type="text" class="form-control input-sm" id="num_bien" name="num_bien" value="" maxlength="20"/>
                                            </div>
                                        </td>
                                        <td width="98" height="58" align="right">Departamento:</td>
                                        <td width="219">
                                            <div id="div_deparamento" style="margin-top: 10px" class="form-group">
                                                <select name="id_departamento" class="form-control input-sm select2" id="id_departamento">
                                                    <option value="0">Seleccione</option>
                                                    <?php
                                                    $result = $odjdep->getDepartamento();
                                                    for ($i = 0; $i < count($result); $i++) {
                                                        ?>
                                                        <option value="<?php echo $result[$i]['id_departamento']; ?>"><?php echo $result[$i]['nombre_departamento']; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>&nbsp;</td>
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
                                        <td colspan="6">&nbsp;</td>
                                    </tr>

                                    <tr>
                                        <td  colspan="7" align="center">
                                            <div style="margin:auto;width:95%">
                                                         <table  border="0" cellspacing="1" id="tabla_equipos" class="dataTable" style="margin: auto;width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Cod. Equipo</th>
                                                            <th>Marca</th>
                                                            <th>Modelo</th>
                                                            <th>Serial Equipo</th>
                                                            <th>Modificar</th>
                                                            <th>Eliminar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $result = $objmod->getEquipos();
                                                        $es_array = is_array($result) ? TRUE : FALSE;
                                                        if ($es_array === TRUE) {
                                                            for ($i = 0; $i < count($result); $i++) {
                                                                $cod_equipo = str_pad( $result[$i]['cod_equipo'], 7, "0", STR_PAD_LEFT) ;
                                                                ?>
                                                                <tr>
                                                                    <td>
                                                                        <?php echo $cod_equipo; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $result[$i]['marca']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $result[$i]['modelo']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $result[$i]['serial_equipo']; ?>
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
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>