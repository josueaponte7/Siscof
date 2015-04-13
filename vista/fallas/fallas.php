<?php
session_start();
define('BASEPATH', dirname(__DIR__) . '/');
define('BASEURL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(BASEPATH))));

require_once '../../librerias/globales.php';
require_once '../../modelo/fallas/Fallas.php';
require_once '../../modelo/mantenimientos/Departamento.php';

$objmod = new Fallas();
$objdep = new Departamento();

if (isset($_GET['modulo'])) {
    $objmod->url($_SERVER['SCRIPT_FILENAME'], $_GET['modulo']);
    $_SESSION['cod_modulo'] = $_GET['modulo'];
}
$usuario    = $_SESSION['usuario'];
$id_usuario = $_SESSION['id_usuario'];

$img_mod = _img_dt . _img_dt_mod;
$img_del = _img_dt . _img_dt_del;
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
        <script src="<?php echo _ruta_librerias_script_js . 'fallas.js' ?>" type="text/javascript"></script>
        <style type="text/css">
            ul#cod_local,ul#cod_cel,ul#nacionalidad{
                min-width:50px !important;
                width: 50px !important;

            }
            ul#cod_local > li > span,ul#cod_cel > li > span{
                text-align:center !important;
                padding: 2px !important;
            }
            #contenedor{
                -moz-animation-duration: 5s;
                -webkit-animation-duration: 5s;
                -o-animation-duration: 5s;
            }
        </style>
    </head>
    <body>
        <div id="contenedor" class="panel panel-default animated slideInDown" style="width : 95%;margin: auto;height: auto;position: relative; top:25px;">
            <div class="panel-heading" style="font-weight: bold;font-size: 12px;">Registrar Fallas</div>
            <div class="panel-body">
                <form name="frmfallas" id="frmfallas" method="post" enctype="multipart/form-data">
                    <div class="row form-inline">
                        <div class="form-group col-xs-6">
                            <label>Usuario:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <input type="hidden"  id="usuario_id" name="usuario_id" value="<?php echo $id_usuario; ?>" />
                            <input type="text" disabled="disabled" style="width: 70%;color: #FF0000;font-weight: bold;background-color:#FFFFFF " value="<?php echo $usuario; ?>" class="form-control input-sm" id="usuario" name="usuario" value="" maxlength="22" />
                        </div> 
                        <div class="form-group col-xs-6">
                            <label>Num Falla:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <input type="text" disabled="disabled" style="width: 70%;color: #FF0000;font-weight: bold;background-color:#FFFFFF " class="form-control input-sm" id="num_falla" name="num_falla" value=""  />
                        </div> 
                    </div>
                    <br/>
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
                            <label>Nombre del Bien:</label>
                            <select style="width: 70%"  id="bien_id"  name="bien_id"  class="form-control select2 input-sm">
                                <option value="0">Seleccione</option>
                            </select>
                        </div> 
                    </div> 
                    <br/>
                    <div class="row form-inline">
                        <div class="form-group col-xs-6">
                            <label>Usuario:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <input type="hidden"  id="usuariof_id" name="usuariof_id" value="" />
                            <input type="text" disabled="disabled" style="width: 70%;font-weight: bold;background-color:#FFFFFF " class="form-control input-sm" id="usuariof" name="usuariof" value="" maxlength="22" />
                        </div> 
                        <div class="form-group col-xs-6">
                            <label>Estatus Falla:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <input type="text" disabled="disabled" style="width: 70%;color: #FF0000;font-weight: bold;background-color:#FFFFFF;color: #FF0000 " class="form-control input-sm" id="estatus" name="estatus" value="NO ASIGNADO"  />
                        </div> 
                    </div>
                    <br/>
                    <div class="row form-inline">
                        <div class="form-group col-xs-12">
                            <label>Descripci&oacute;n:&nbsp;&nbsp;</label>
                            <textarea class="form-control input-sm"  style="width: 88%;resize: none" id="problema" name="problema" maxlength="150" ></textarea>    
                        </div>
                    </div>
                    <br/>
                    <div class="row form-inline">
                        <div class="form-group col-xs-12" style="text-align:center;">
                            <button type="button" id="guardar" class="btn btn-primary btn-sm">Guardar</button>
                            <button type="button" id="limpiar" class="btn btn-primary btn-sm">Limpiar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>