<?php
session_start();

define('BASEPATH', dirname(__DIR__) . '/');
define('BASEURL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(BASEPATH))));

require_once '../../librerias/globales.php';
require_once '../../modelo/mantenimientos/Departamento.php';
require_once '../../modelo/seguridad/Login.php';
$objmod         = new Departamento();
$objuser        = new Login();
$tiempo_session = $objmod->tiempoSession();
if ($tiempo_session > 5) {
    $id_usuario = $_SESSION['id_usuario'];
    $objuser->logoutUsuario($id_usuario);
    header('location:../../controlador/seguridad/salir.php');
}
if (isset($_GET['modulo'])) {
    $objmod->url($_SERVER['SCRIPT_FILENAME'], $_GET['modulo']);
    $_SESSION['cod_modulo'] = $_GET['modulo'];
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
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_dataTablesbootstrap; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_dataTablesresponsive; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_animate; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_estilo; ?>"/>
        <script src="<?php echo _ruta_librerias_js . _js_jquery; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_bootstrap; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_dataTable; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_dataTableboostrap; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_dataTableresponsive; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_text_counter; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_validarcampos; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_librerias; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_script_js . 'departamentos.js' ?>" type="text/javascript"></script>
        <style type="text/css">
            .originalTextareaInfo {
                color: #000000;
                text-align: right;
                width: 99%
            }
            .warningTextareaInfo {
                color: #ff0000;
                text-align: right;
                width: 99%
            }
            .charleft{
                width: 99% !important;
            }
        </style>
    </head>
    <body>
        <div class="panel panel-default" style="width : 95%;margin: auto;height: auto;position: relative; top:25px; font-size: 12px;">
            <div class="panel-heading" style="font-weight: bold;font-size: 12px;">Registrar Departamento</div>
            <div class="panel-body">
                <form name="frmdepartamento" id="frmdepartamento" method="post" enctype="multipart/form-data">
                    <div class="form-inline">
                        <div class="form-group col-xs-4">
                            <label>Cod Departamento:</label>
                            <input type="text" disabled="disabled" style="width: 55%;color: #FF0000;font-weight: bold;background-color:#FFFFFF " class="form-control input-sm" id="codigo_departamento" name="codigo_departamento" value="" maxlength="22" />
                        </div>
                        <div class="form-group col-xs-8">
                            <label>Nombre Departamento:</label>
                            <input type="text"  style="width: 74%;" class="form-control input-sm" id="nombre_departamento" name="nombre_departamento" value="" maxlength="22" />
                        </div>                        
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <div class="form-inline col-xs-12">
                        <label>Descripci&oacute;n:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <textarea class="form-control input-sm"  style="width: 85%;resize: none" id="direccion_departamento" name="direccion_departamento" maxlength="150" ></textarea>    
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
                    <table  border="0" cellspacing="1" id="tabla_deparmento" class="tablas table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive" style="margin: auto;width:100%">
                        <thead>
                            <tr class="success">
                                <th></th>
                                <th>C&oacute;digo</th>
                                <th>Nombre Departamento</th>
                                <th>Direcci&oacute;n</th>
                                <th>Modificar</th>
                                <th>Eliminar</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result   = $objmod->getDepartamento();
                            $es_array = is_array($result) ? TRUE : FALSE;
                            if ($es_array === TRUE) {
                                for ($i = 0; $i < count($result); $i++) {
                                    ?>
                                    <tr id="<?php echo $result[$i]['id']; ?>">
                                        <td></td>
                                        <td>
                                            <?php echo $result[$i]['codigo_departamento']; ?>
                                        </td>
                                        <td>
                                            <?php echo $result[$i]['nombre_departamento']; ?>
                                        </td>
                                        <td>
                                            <?php echo $result[$i]['direccion_departamento']; ?>
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