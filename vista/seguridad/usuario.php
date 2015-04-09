<?php
session_start();
define('BASEPATH', dirname(__DIR__) . '/');
define('BASEURL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(BASEPATH))));

require '../../librerias/globales.php';
require_once '../../modelo/seguridad/SubModulo.php';

$obj_submodulo = new SubModulo();
if (isset($_GET['modulo'])) {
    $_SESSION['cod_modulo'] = $_GET['modulo'];
    $obj_submodulo->url($_SERVER['SCRIPT_NAME'], $_GET['modulo']);
}
require_once '../../modelo/seguridad/Usuario.php';
$obj = new Usuario();

$datos_perfil['tabla']  = 's_perfil';
$datos_perfil['campos'] = 'id,perfil';
$result_perfil          = $obj->getPerfil($datos_perfil);

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
        <script src="<?php echo _ruta_librerias_script_js . 'usuario.js' ?>" type="text/javascript"></script>
        <style>
            table.tablas tbody tr td,input[type='text']:not(.select2-input),textarea {
                text-transform:inherit;
            }
            input:disabled{
                background-color:#f4f4f4;
            }
        </style>
    </head>
    <body>

        <div class="panel panel-default" style="width : 95%;margin: auto;height: auto;position: relative; top:25px;">
            <div class="panel-heading" style="font-weight: bold;font-size: 12px;">Datos del Usuario</div>
            <div class="panel-body">
                <form name="frmusuario" id="frmusuario" method="post" enctype="multipart/form-data">
                    <div class="form-inline">
                        <div class="form-group col-xs-6">
                            <label>ID:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <input type="text" disabled="disabled" style="width: 75%;color: #FF0000;font-weight: bold;" id="id_usuario" name="id_usuario" class="form-control input-sm"  value="" maxlength="22" />
                        </div>
                        <div class="form-group col-xs-6">
                            <label>Usuario:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <input type="text" style="width: 75%" id="usuario" name="usuario" class="form-control input-sm"  value="" maxlength="22" />
                        </div>                 
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <div class="form-inline">
                        <div class="form-group col-xs-6">
                            <label>Clave:</label>
                            <input type="password" style="width: 75%" id="clave" name="clave" class="form-control input-sm"  value="" maxlength="22" />
                        </div>
                        <div class="form-group col-xs-6">
                            <label>Repetir Clave:</label>
                            <input type="password" style="width: 75%" id="r_clave" name="r_clave" class="form-control input-sm"  value="" maxlength="22" />
                        </div>                        
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <div class="form-inline">
                        <div class="form-group col-xs-6">
                            <label>Perfil:</label>
                            <select  style="width: 75%"  id="perfil_id"  name="perfil_id"  class="form-control select2 input-sm">
                                <option value="0">Seleccione</option>
                                <?php
                                for ($i = 0; $i < count($result_perfil); $i++) {
                                    ?>
                                    <option  value="<?php echo $result_perfil[$i]['id'] ?>"><?php echo $result_perfil[$i]['perfil'] ?></option>
                                <?php }
                                ?>
                            </select>
                        </div> 
                        <div class="form-group col-xs-6">
                            <label>Estatus:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <div class="btn-group" data-toggle="buttons" >
                                <label id="l_u_activo" class="btn btn-success active btn-sm">
                                    <input  type="radio" name="activo" checked="checked" id="u_activo" value="1">
                                    Activo
                                </label>
                                <label id="l_u_inactivo" class="btn btn-default btn-sm">
                                    <input type="radio" name="activo" id="u_inactivo" value="0">
                                    Inactivo
                                </label>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <div class="form-inline" style="text-align:center;">
                        <button type="button" id="guardar" class="btn btn-primary btn-sm">Guardar</button>
                        <button type="button" id="limpiar" class="btn btn-primary btn-sm">Limpiar</button>
                    </div>
                </form>
                <div style="margin:auto;width:95%">
                    <input type="hidden" name="fila" value="" id="fila"/>
                    <table id="tabla_usuarios" border="0" cellspacing="1"  class="tablas table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive" >
                        <thead>
                            <tr class="success">
                                <th>ID</th>
                                <th>Usuario</th>
                                <th>Perfil</th>
                                <th>Estatus</th>
                                <th>Fecha</th>
                                <th>Acci&oacute;n</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                             $datos['sql'] = "SELECT u.id_usuario, u.usuario, IF(u.activo=1,'Activo','Inactivo') AS activo, p.perfil, p.id, DATE_FORMAT(u.fecha_creacion, '%d-%m-%Y') AS fecha 
                                              FROM s_usuario AS u 
                                              INNER JOIN s_perfil AS p ON u.perfil_id=p.id ORDER BY u.id";
                            $result       = $obj->getUsuario($datos);
                            for ($i = 0; $i < count($result); $i++) {
                                ?>
                            <tr>
                                    <td><?php echo $result[$i]['id_usuario']; ?></td>
                                    <td><?php echo $result[$i]['usuario']; ?></td>
                                    <td id="<?php echo $result[$i]['id']; ?>"><?php echo $result[$i]['perfil']; ?></td>
                                    <td><?php echo $result[$i]['activo']; ?></td>
                                    <td><?php echo $result[$i]['fecha']; ?></td>
                                    <td>
                                        <img class="modificar"  title="Modificar" style="cursor: pointer" src="<?php echo $img_mod; ?>" width="18" height="18" alt="Modificar"/>
                                        <?php
                                        if ($result[$i]['id_usuario'] > 1) {
                                            ?>
                                            <img class="eliminar"  title="Eliminar" style="cursor: pointer" src="<?php echo $img_del; ?>" width="18" height="18"  alt="Eliminar"/>
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
    </body>
</html>