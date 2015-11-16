<?php
session_start();
define('BASEPATH', dirname(__DIR__) . '/');
define('BASEURL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(BASEPATH))));

require_once '../../librerias/globales.php';
require_once '../../modelo/seguridad/Perfil.php';
require_once '../../modelo/seguridad/SubModulo.php';
$seguridad     = new Seguridad();
$obj_submodulo = new SubModulo();
if (isset($_GET['modulo'])) {
    $_SESSION['cod_modulo'] = $_GET['modulo'];
    $seguridad->url($_SERVER['SCRIPT_NAME'], $_GET['modulo']);
}


$objperf                = new Perfil();
$datos_perfil['campos'] = 'id,perfil';
$result_perfil          = $objperf->getPerfil($datos_perfil);
$img_mod                = _img_dt . _img_dt_mod;
$img_del                = _img_dt . _img_dt_del;
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_boostrap; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_boostrap_theme; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_dataTablesbootstrap; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_dataTablesresponsive; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_animate; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_select2; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_select2_bootstrap; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_estilo; ?>"/>

        <script src="<?php echo _ruta_librerias_js . _js_jquery; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_bootstrap; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_bootstrap_tooltip; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_select2; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_dataTable; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_dataTableboostrap; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_dataTableresponsive; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_validarcampos; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_librerias; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_script_js . 'perfil.js' ?>" type="text/javascript"></script>
        <style type="text/css">
            #perfil {
                text-transform: capitalize;
            }
        </style>
    </head>
    <body>
        <div class="panel panel-default" id="divperfil" style="width : 90%;margin: auto;height: auto;position: relative; top:25px;">
            <div class="panel-heading" style="font-weight: bold;font-size: 12px;">Registro de Perfil</div>
            <div class="panel-body">
                <form name="frmperfil" id="frmperfil" method="post" enctype="multipart/form-data">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="Modulo" class="col-sm-1 control-label">Perfil:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control " id="perfil" name="perfil" value="" maxlength="20" placeholder="Perfil"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6" style="text-align: center">
                                <input class="btn btn-primary btn-sm" id="btnaccion" name="btnaccion" type="button" value="Guardar" />
                                <input style="display: none"  class="btn btn-danger btn-sm" id="btnlistar" name="btnlistar" type="button" value="Litar Perfiles"/>
                                <input class="btn btn-default btn-sm" id="btnlimpiar" name="btnlimpiar" type="button" value="Limpiar" />
                            </div>
                        </div>
                    </div>
                </form>

                <div style="width: 90%;margin: auto">
                    <table  align="center" cellspacing="1" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive"  id="tabla_perfil" >
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Perfil</th>
                                <th>Acci&oacute;n</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($i = 0; $i < count($result_perfil); $i++) {
                                ?>
                                <tr id="<?php echo $result_perfil[$i]['id']?>">
                                    <td style="cursor: pointer" title="Click para ver Privilegios"><?php echo $result_perfil[$i]['id']; ?></td>
                                    <td style="cursor: pointer" title="Click para ver Privilegios"><?php echo $result_perfil[$i]['perfil']; ?></td>
                                    <td>
                                        <img class="modificar"  title="Modificar" style="cursor: pointer" src="<?php echo $img_mod ?>" width="18" height="18" alt="Modificar"/>                                  
                                        <?php
                                        if ($result_perfil[$i]['id'] > 1) {
                                            ?>
                                            <img class="eliminar"  title="Eliminar" style="cursor: pointer" src="<?php echo $img_del ?>" width="18" height="18"  alt="Eliminar"/>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="panel panel-default" id="privilegios" style="width : 90%;margin: auto;height: auto; position: relative; top:25px;display: none">
            <div class="panel-heading" style="font-weight: bold;font-size: 12px;">Perfiles de Usuarios</div>
            <div class="panel-body">
                <table width="679" border="0" align="center">
                    <tr>
                        <td align="center">
                            <form name="frmprivilegio" id="frmprivilegio" method="post" enctype="multipart/form-data">
                                <table width="800" align="center">
                                    <tr>
                                        <th width="236" height="48">&nbsp;</th>
                                        <th width="30" align="right">Perfil:</th>
                                      <td width="298"> 
                                        <div style=";width: 290px;">
                                                <span style="font-size: 15px;width: 500px;" class="label label-info" id="nom_perfil"></span>
                                        </div>
                                      </td>
                                        <td width="170">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td  colspan="4" align="center">
                                            <table style="width:100%;" border="0" align="center" cellspacing="1" class="table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive" id="tabla_privilegios">
                                                <thead>
                                                    <tr>
                                                        <th>Modulo</th>
                                                        <th style="width: 30% !important">Sub Modulo</th>
                                                        <th>Activar</th>
                                                        <th>Agregar</th>
                                                        <th>Modificar</th>
                                                        <th>Eliminar</th>
                                                        <th>Consultar</th>
                                                        <th>Imprimir</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $data_mod['sql'] = 'SELECT 
                                                                            m.id AS modulo_id,
                                                                            sm.id,
                                                                            m.modulo,
                                                                            sm.sub_modulo,
                                                                            IF(pp.submodulo_id=sm.id,1,0) AS activar,
                                                                            IF(pp.agregar=1,1,0) AS agregar,IF(pp.modificar=1,1,0) AS modificar,
                                                                            IF(pp.eliminar=1,1,0) AS eliminar
                                                                        FROM s_modulo AS m
                                                                        INNER JOIN s_sub_modulo AS sm ON m.id=sm.modulo_id
                                                                        LEFT JOIN s_perfil_privilegio pp ON sm.id=pp.submodulo_id
                                                                        GROUP BY sm.id
                                                                        ORDER BY sm.id';
                                                    $resul_mod = $obj_submodulo->getSubModulo($data_mod);
                                                    
                                                    for ($i = 0; $i < count($resul_mod); $i++) {
                                                        $disabed = '';
                                                        if ($resul_mod[$i]['modulo_id'] <= 5) {
                                                            $disabed = 'disabled="disabled"';
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $resul_mod[$i]['modulo'] ?></td>
                                                            <td><?php echo $resul_mod[$i]['sub_modulo'] ?></td>
                                                            <td><input <?php echo $disabed?> type="checkbox" class="activar" name="activar[]" id="ac_<?php echo $resul_mod[$i]['id'] ?>"  value="<?php echo $resul_mod[$i]['id'] ?>" /></td>
                                                            <td><input disabled="disabled" type="checkbox" class="agregar" name="agregar[]" id="add_<?php echo $resul_mod[$i]['id'] ?>" value="1"/></td>
                                                            <td><input disabled="disabled" type="checkbox" class="modificar" name="modificar[]" id="up_<?php echo $resul_mod[$i]['id'] ?>" value="1"/></td>
                                                            <td><input disabled="disabled" type="checkbox" class="eliminar" name="eliminar[]" id="del_<?php echo $resul_mod[$i]['id'] ?>" value="1" /></td>
                                                            <td><input disabled="disabled" type="checkbox" class="consultar" name="consultar[]" id="con_<?php echo $resul_mod[$i]['id'] ?>" value="1" /></td>
                                                            <td><input disabled="disabled" type="checkbox" class="imprimir" name="imprimir[]" id="imp_<?php echo $resul_mod[$i]['id'] ?>" value="1" /></td>                                                         
                                                            
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  colspan="4" align="right"><span style="color: #ff0000;margin-left">Campo Obligatorio *</span></td>
                                    </tr>
                                    <tr>
                                        <td  colspan="4" align="center">
                                            <div id="botones">
                                                <input class="btn btn-default btn-sm"  id="btnaccpriv"  name="btnaccpriv"  type="button" value="Agregar" />
                                                <input class="btn btn-default btn-sm"  id="btnlimpriv"  name="btnlimpriv"  type="button" value="Limpiar" />
                                                <input class="btn btn-default btn-sm"  id="btnrestablecer"  name="btnrestablecer"  type="button" value="Restablecer" />
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                </table>
        
    </body>
</html>