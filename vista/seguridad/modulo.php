<?php
session_start();
define('BASEPATH', dirname(__DIR__) . '/');
define('BASEURL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(BASEPATH))));
require_once '../../librerias/globales.php';
require_once '../../modelo/seguridad/SubModulo.php';

$obj_submodulo = new SubModulo();
if (isset($_GET['modulo'])) {
    $_SESSION['cod_modulo'] = $_GET['modulo'];
    $obj_submodulo->url($_SERVER['SCRIPT_NAME'], $_GET['modulo']);
}
$data_mod['menu']   = TRUE;
$data_mod['campos'] = 'id,modulo,posicion,activo';
$resul_mod          = $obj_submodulo->getModulo($data_mod);
$img_mod            = _img_dt . _img_dt_mod;
$img_del            = _img_dt . _img_dt_del;
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
        <script src="<?php echo _ruta_librerias_script_js . 'modulo.js' ?>" type="text/javascript"></script>
        <style type="text/css">
            tr td.registro{
                cursor: pointer;
            }
            div[class="tooltip-inner"] {
                max-width: 350px;
                font-family: Verdana,Arial,Helvetica,sans-serif;
                font-size: 10px;
            }
        </style>
    </head>
    <body>
        <input type="hidden" id="id" name="id"/>
        <!-- Inicio Modulo -->
        <div class="panel panel-default" id="divmodulo" style="display: block; width : 90%;margin: auto;height: auto;position: relative; top:25px;">
            <div class="panel-heading" style="font-weight: bold;font-size: 12px;">Registro de Modulo</div>
            <div class="panel-body">
                <form name="frmmodulo" id="frmmodulo" method="post" enctype="multipart/form-data">
                    
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="Modulo" class="col-sm-1 control-label">Modulo:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control " id="modulo" name="modulo" value="" maxlength="20" placeholder="Modulo"/>
                            </div>
                            <img  style="cursor: pointer;margin-top: 1%;margin-left: -1%" id="img_modulo" src="../../imagenes/img_info.png" width="15" height="15" alt="img_info"/>
                        </div>
                        <div class="form-group">
                            <label for="mod_posicion" class="col-sm-1 control-label">Posici&oacute;n</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control " id="mod_posicion" name="mod_posicion" value="" maxlength="2" placeholder="Posici&oacute;n"/>
                            </div>
                            <img style="cursor: pointer;margin-top: 1%;margin-left: -1%" id="img_posicion" src="../../imagenes/img_info.png" width="15" height="15" alt="img_info"/>
                        </div>
                        <div class="form-group">
                            <label for="mod_posicion" class="col-sm-1 control-label">Estatus</label>
                            <div style="margin-left: 0.3%" class="btn-group col-sm-5" data-toggle="buttons" >
                                <label id="l_mod_activo" class="btn btn-success active btn-sm">
                                    <input  type="radio" name="mod_estatus" checked="checked" id="mod_activo" value="1">
                                    Activo
                                </label>
                                <label id="l_mod_inactivo" class="btn btn-default btn-sm">
                                    <input type="radio" name="mod_estatus" id="mod_inactivo" value="0">
                                    Inactivo
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6" style="text-align: center">
                                <input class="btn btn-primary btn-sm" id="btnaccion" name="btnaccion" type="button" value="Guardar" />
                                <input style="display: none" class="btn btn-danger btn-sm" id="btnlistar" name="btnlistar" type="button" value="Sub Modulos"/>
                                <input class="btn btn-default btn-sm" id="btnlimpiar" name="btnlimpiar" type="button" value="Limpiar" />
                            </div>
                        </div>
                    </div>
                </form>

                <div style="width: 90%;margin: auto">
                    <table style="width:100%;" border="0" align="center" cellspacing="1" class="tbl-modulos table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive" id="tabla_modulo" >
                        <thead>
                            <tr>
                                <th width="58">Codigo</th>
                                <th width="64">Modulo</th>
                                <th width="64">Posici&oacute;n Men&uacute;</th>
                                <th width="64">Estatus</th>
                                <th width="81">Acción</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            for ($i = 0; $i < count($resul_mod); $i++) {
                                $estatus = 'Inactivo';
                                if ($resul_mod[$i]['activo'] == 1) {
                                    $estatus = 'Activo';
                                }
                                ?>
                                <tr id="<?php echo $resul_mod[$i]['id']; ?>">
                                    <td data-original-title="Click para ver los Sub Modulos"  data-container="body" data-toggle="tooltip" data-placement="top" class="registro"><?php echo $resul_mod[$i]['id']; ?></td>
                                    <td data-original-title="Click para ver los Sub Modulos"  data-container="body" data-toggle="tooltip" data-placement="top" class="registro"><?php echo $resul_mod[$i]['modulo']; ?></td>
                                    <td data-original-title="Click para ver los Sub Modulos"  data-container="body" data-toggle="tooltip" data-placement="top" class="registro" ><?php echo $resul_mod[$i]['posicion']; ?></td>
                                    <td data-original-title="Click para ver los Sub Modulos"  data-container="body" data-toggle="tooltip" data-placement="top" class="registro"><?php echo $estatus; ?></td>
                                    <td>
                                        <img class="modificar" style="cursor: pointer" src="<?php echo $img_mod ?>" width="18" height="18" alt="Modificar"/>                                  
                                        &nbsp;
                                        <?php
                                        if ($resul_mod[$i]['id'] > 2) {
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
       
    <!-- Fin Modulo-->

    <!-- Inicio Sub Modulos -->

    <div class="panel panel-default" id="divsubmodulo" style="width : 90%;margin: auto;height: auto;position: relative; top:25px; display: none">
        <div class="panel-heading" style="font-weight: bold;font-size: 12px;">Registro de SubModulo</div>
        <div class="panel-body">
            <form class="form-inline" id="frmsubmodulo">
                <div class="form-inline col-sm-12">
                    <div class="col-sm-6 form-group ">                    
                        <label for="modulo_id">Modulo</label>
                        <select  style="width: 73%" name="modulo_id" id="modulo_id" class="form-control select2">
                            <option value="0">Seleccione</option>
                            <?php
                            for ($i = 0; $i < count($resul_mod); $i++) {
                                ?>
                                <option style="font-size: 10px;" value="<?php echo $resul_mod[$i]['id']; ?>"><?php echo $resul_mod[$i]['modulo']; ?></option>
                            <?php } ?>
                        </select>                   
                        <img style="cursor: pointer" id="img_nommodulo" src="../../imagenes/img_info.png" width="15" height="15" alt="img_info"/>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="submodulo">Sub Modulo</label>
                        <input type="text" style="width: 73%" class="form-control input-sm" id="submodulo" name="submodulo"   value="" maxlength="50" />
                        <img style="cursor: pointer" id="img_submodulo" src="../../imagenes/img_info.png" width="15" height="15" alt="img_info"/>
                    </div>
                </div>
                <br/>
                <br/>
                <br/>
                <div class="form-inline col-sm-12">
                    <div class="col-sm-6 form-group">
                        <label for="submodulo">Posici&oacute;n</label>
                        <input type="text" style="width: 73%" class="form-control input-sm" id="sbm_posicion" name="sbm_posicion" value="" maxlength="20" />
                        <img style="cursor: pointer" id="img_submodulo" src="../../imagenes/img_info.png" width="15" height="15" alt="img_info"/>
                    </div>

                    <div class="col-sm-6 form-group">
                        <label for="ruta">Ruta:</label>
                        <input type="text" style="width: 73%" class="form-control input-sm" id="ruta" name="ruta" maxlength="50"  value="" />
                        <img style="cursor: pointer" id="img_ruta" src="../../imagenes/img_info.png" width="15" height="15" alt="img_info"/>
                    </div>
                </div>
                <br/>
                <br/>
                <br/>
                <div class="form-inline col-sm-12">
                    <div class="col-sm-6 form-group ">       
                        <label for="submodulo">Estatus</label>
                        <div class="btn-group" data-toggle="buttons" >
                            <label id="l_sbmod_activo" class="btn btn-success active btn-sm">
                                <input  type="radio" name="sbmod_estatus" checked="checked" id="sbmod_activo" value="1">
                                Activo 
                            </label>
                            <label id="l_sbmod_inactivo" class="btn btn-default btn-sm">
                                <input type="radio" name="sbmod_estatus" id="sbmod_inactivo" value="0">
                                Inactivo
                            </label>
                        </div>
                    </div>
                </div>
                <br/>
                <br/>
                <br/>
                <div class="form-inline col-sm-12">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6" style="text-align: center">
                        <input class="btn btn-primary btn-sm" id="btnaccionsub"   name="btnaccionsub"   type="button" value="Guardar" />
                        <input class="btn btn-default btn-sm" id="btnlimpiarsub"  name="btnlimpiarsub"  type="button" value="Limpiar" />
                        <input class="btn btn-danger btn-sm"  id="btnrestablecer"  name="btnrestablecer" type="button" value="Restablecer" />                          
                    </div>
                </div>
            </form>
            <br/>
            <br/>
            <br/>
            <div style="width: 100%;margin: auto" class="form-inline col-sm-12">
                <table style="width:100%;" border="0" align="center" cellspacing="1" class="table tbl-modulos table-bordered table-striped table-hover table-condensed dt-responsive table-responsive" id="tabla_submodulo" >
                    <thead>
                        <tr>
                            <th></th>
                            <th>Codigo</th>
                            <th>Modulo</th>
                            <th>SubModulo</th>
                            <th>Posici&oacute;n</th>
                            <th>Estatus</th>
                            <th>Acci&oacute;n</th>
                            <th>Ruta</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Fin SubModulo -->
    </body>
</html>
