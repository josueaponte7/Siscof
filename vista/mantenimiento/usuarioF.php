<?php
session_start();
define('BASEPATH', dirname(__DIR__) . '/');
define('BASEURL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(BASEPATH))));

require_once '../../librerias/globales.php';
require_once '../../modelo/mantenimientos/UsuarioF.php';
require_once '../../modelo/mantenimientos/Departamento.php';

$objmod = new UsuarioF();
$objdep = new Departamento();

if (isset($_GET['modulo'])) {
    $_SESSION['cod_modulo'] = $_GET['modulo'];
    $objmod->url($_SERVER['SCRIPT_NAME'], $_GET['modulo']);
}

$img_mod = _img_dt . _img_dt_mod;
$img_del = _img_dt . _img_dt_del;
$_SESSION['perfil'];
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
        <script src="<?php echo _ruta_librerias_script_js . 'usuarioF.js' ?>" type="text/javascript"></script>
        <style type="text/css">
            table.tablas tbody tr td,input[type='text']:not(.select2-input),textarea {
                text-transform:inherit;
            }
            input:disabled{
                background-color:#f4f4f4;
            }
            .panel input[type="text"],.panel select,.panel input[type="password"]{
                width: 70% !important
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
            <div class="panel-heading" style="font-weight: bold;font-size: 12px;">Registrar Usuario Final</div>
            <div class="panel-body">
                <form name="frmusuarioF" id="frmusuarioF" method="post" enctype="multipart/form-data">
                    <div class="row form-inline">
                        <div class="form-group col-xs-6">
                            <label>ID:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <input type="text" disabled="disabled" style="color: #FF0000;font-weight: bold;" id="id_usuario_f" name="id_usuario_f" class="form-control input-sm"  value="" maxlength="22" />
                        </div>
                        <div class="form-group col-xs-6">
                            <label>Usuario:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <input type="text" id="usuario" name="usuario" class="form-control input-sm"  value="" maxlength="22" />
                        </div>                 
                    </div>
                    <br/>
                    <div class="row form-inline">
                        <div class="form-group col-xs-6">
                            <label>Nombre:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <input type="text"  id="nombre" name="nombre" class="form-control input-sm"  value="" maxlength="22" />
                        </div>
                        <div class="form-group col-xs-6">
                            <label>Apellido:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <input type="text"  id="apellido" name="apellido" class="form-control input-sm"  value="" maxlength="22" />
                        </div>                 
                    </div>
                    <br/>
                    <div class="row form-inline">
                        <div class="form-group col-xs-6">
                            <label>Clave:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <input type="password" id="clave" name="clave" class="form-control input-sm"  value="" maxlength="22" />
                        </div>
                        <div class="form-group col-xs-6">
                            <label>Confirmar Clave:</label>
                            <input type="password" id="r_clave" name="r_clave" class="form-control input-sm"  value="" maxlength="22" />
                        </div>                        
                    </div>
                    <br/>
                    <div class="row form-inline">
                        <div class="form-group col-xs-6">
                            <label>Tipo Usuario:</label>
                            <select style="width: 70%"  id="perfil_id"  name="perfil_id"  class="form-control select2 input-sm">
                                <option value="0">Seleccione</option>
                                <?php
                                $datos_perfil['tabla']  = 's_perfil';
                                $datos_perfil['campos']    = 'id,perfil';
                                $result_perfil          = $objmod->getPerfil($datos_perfil);
                                for ($i = 0; $i < count($result_perfil); $i++) {
                                    ?>
                                    <option  value="<?php echo $result_perfil[$i]['id'] ?>"><?php echo $result_perfil[$i]['perfil'] ?></option>
                                <?php }
                                ?>
                            </select>
                        </div> 
                        <div class="form-group col-xs-6">
                            <label>Departamento:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <select style="width: 70%"  id="departamento_id"  name="departamento_id"  class="form-control select2 input-sm">
                                <option value="0">Seleccione</option>
                                <?php
                                $result_depar          = $objdep->getDepartamento();
                                for ($i = 0; $i < count($result_depar); $i++) {
                                    ?>
                                    <option  value="<?php echo $result_depar[$i]['id'] ?>"><?php echo $result_depar[$i]['nombre_departamento'] ?></option>
                                <?php }
                                ?>
                            </select>
                        </div> 
                    </div>
                    <br/>
                    <div class="row form-inline">
                        <div class="form-group col-xs-6">
                            <label>Estatus:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <div class="btn-group" data-toggle="buttons" >
                                <label id="l_u_activo" class="btn btn-success active btn-sm">
                                    <input  type="radio" name="activo" checked="checked" id="u_activo" value="1">
                                    <span>Activo</span>
                                </label>
                                <label id="l_u_inactivo" class="btn btn-default btn-sm">
                                    <input type="radio" name="activo" id="u_inactivo" value="0">
                                    <span>Inactivo</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="form-inline" style="text-align:center;">
                        <button type="button" id="guardar" class="btn btn-primary btn-sm">Guardar</button>
                        <button type="button" id="limpiar" class="btn btn-primary btn-sm">Limpiar</button>
                    </div>
                </form>
            </div>
            <div class="row form-inline" style="margin:auto;width:99%">
                <div class="form-group col-xs-12">
                    <table  border="0" cellspacing="1" id="tabla_usuariof" class="tablas table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive" >
                        <thead>
                            <tr class="success"> 
                                <th>&nbsp;</th>
                                <th>ID</th>
                                <th>Usuario</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Tipo Usuario</th>
                                <th>Departamento</th>
                                <th>Estatus</th>
                                <th>Modificar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result   = $objmod->getUsuarioF();
                            $es_array = is_array($result) ? TRUE : FALSE;
                            if ($es_array === TRUE) {
                                for ($i = 0; $i < count($result); $i++) {
                                    $estatus = 'Activo';
                                    if ($result[$i]['activo'] == 0) {
                                        $estatus = 'Inactivo';
                                    }
                                    ?>
                                    <tr>
                                        <td id="<?php echo $result[$i]['departamento_id']; ?>">&nbsp;</td>
                                        <td>
                                            <?php echo $result[$i]['id_usuario_f']; ?>
                                        </td>
                                        <td>
                                            <?php echo $result[$i]['usuario']; ?>
                                        </td>
                                        <td>
                                            <?php echo $result[$i]['nombre']; ?>
                                        </td> 
                                        <td>
                                            <?php echo $result[$i]['apellido']; ?>
                                        </td> 
                                        <td id="<?php echo $result[$i]['perfil_id']; ?>">
                                            <?php echo $result[$i]['perfil']; ?>
                                        </td>
                                        <td>
                                            <?php echo $result[$i]['nombre_departamento']; ?>
                                        </td>
                                        <td id="<?php echo $result[$i]['activo']; ?>">
                                            <?php echo $estatus; ?>
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