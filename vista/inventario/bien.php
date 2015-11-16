<?php

session_start();
define('BASEPATH', dirname(__DIR__) . '/');
define('BASEURL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(BASEPATH))));


require_once '../../librerias/globales.php';
require_once '../../modelo/mantenimientos/Items.php';
require_once '../../modelo/mantenimientos/Departamento.php';

$objdep = new Departamento();
$objmod = new Items();

if (isset($_GET['modulo'])) {
    $objmod->url($_SERVER['SCRIPT_NAME'], $_GET['modulo']);
    $_SESSION['cod_modulo'] = $_GET['modulo'];
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
        <script src="<?php echo _ruta_librerias_js . _js_dataTable; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_dataTableboostrap; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_dataTableresponsive; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_text_counter; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_validarcampos; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_librerias; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_script_js . 'herramientas.js' ?>" type="text/javascript"></script>
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
            <div class="panel-heading" style="font-weight: bold;font-size: 12px;">Asignaci&oacute;n de Bienes</div>
            <div class="panel-body">
                <form name="frmherramienta" id="frmherramienta" method="post" enctype="multipart/form-data">
                    <div class="row form-inline">
                        <div class="form-group col-xs-6">
                            <label>Departamento:</label>
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
                            <label>Usuario:</label>
                            <select style="width: 70%"  id="usuariof_id"  name="usuariof_id"  class="form-control select2 input-sm">
                                <option value="0">Seleccione</option>
                            </select>
                        </div> 
                    </div>
                    <br/>
                    <div class="row form-inline">
                        <div class="form-group col-xs-6">
                            <label>Bien:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <select style="width: 70%"  id="bien_id"  name="bien_id"  class="form-control select2 input-sm">
                                <option value="0">Seleccione</option>
                                <?php
                                $datos['tabla']     = 'bien';
                                $datos['campos']    = 'id,nombre_bien,codigo_bien';
                                $datos['condicion'] = 'incorporado=1 AND asignado>=0';
                                $resultado_bien = $objmod->getItems($datos);
                                for ($i = 0; $i < count($resultado_bien); $i++) {
                                    ?>
                                    <option  value="<?php echo $resultado_bien[$i]['id'] ?>"><?php echo $resultado_bien[$i]['codigo_bien'] ?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div> 
                        <div class="form-group col-xs-6">
                            <label>Acci&oacute;n:&nbsp;</label>
                            <select style="width: 70%"  id="asignado"  name="asignado"  class="form-control select2 input-sm">
                                <option value="0">Seleccione</option>
                                <option value="1">Asignar</option>
                                <option value="2">Reasignar</option>
                            </select>
                        </div> 
                    </div>
                    <br/>
                    <br/>
                    <div class="row" style="text-align:center;">
                        <button type="button" id="guardar" class="btn btn-primary btn-sm">Guardar</button>
                        <button type="button" id="limpiar" class="btn btn-primary btn-sm">Limpiar</button>
                    </div>
                </form>
                <br/>
                <div style="margin:auto;width:95%">
                    <input type="hidden" name="fila" value="" id="fila"/>
                    <table  id="tabla_registrar" border="0" cellspacing="1" class="tablas table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
                        <thead>
                            <tr class="success">
                                <th>Cod Bien</th>
                                <th>Bien</th>
                                <th>Departamento</th>
                                <th>Usuario</th>
                                <th>Acci&oacute;n</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $datos['tabla']     = 'bien AS b, usuario_f AS u, departamento AS d';
                            $datos['campos']    = "d.nombre_departamento,CONCAT_WS(' ',u.nombre,u.apellido) AS nombre,b.codigo_bien, b.nombre_bien,b.asignado";
                            $datos['condicion'] = 'b.usuariof_id=u.id AND u.departamento_id=d.id';
                            $datos['ordenar']   = 'b.id';
                            $resultado_bien = $objmod->getItems($datos);
                                $es_array = is_array($resultado_bien) ? TRUE : FALSE;
                                if ($es_array === TRUE) {
                                for ($i = 0; $i < count($resultado_bien); $i++) {
                                    $asignado = 'Asignado';
                                     if($resultado_bien[$i]['asignado'] == 2){
                                         $asignado = 'Reasignado';
                                     }
                                    ?>
                                        <td>
                                            <?php echo $resultado_bien[$i]['codigo_bien']; ?>
                                        </td>
                                        <td>
                                            <?php echo $resultado_bien[$i]['nombre_departamento']; ?>
                                        </td>
                                        <td>
                                            <?php echo $resultado_bien[$i]['nombre']; ?>
                                        </td>
                                        <td>
                                            <?php echo $resultado_bien[$i]['nombre_bien']; ?>
                                        </td>
                                        <td>
                                            <?php echo $asignado; ?>
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