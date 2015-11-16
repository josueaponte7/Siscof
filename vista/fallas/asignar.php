<?php
session_start();
define('BASEPATH', dirname(__DIR__) . '/');
define('BASEURL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(BASEPATH))));

require_once '../../librerias/globales.php';
require_once '../../modelo/fallas/AsignarFalla.php';
require_once '../../modelo/mantenimientos/UsuarioF.php';

$objmod  = new AsignarFalla();
$objuser = new UsuarioF();

if (isset($_GET['modulo'])) {
    $objmod->url($_SERVER['SCRIPT_NAME'], $_GET['modulo']);
}
$usuario    = $_SESSION['usuario'];
$id_usuario = $_SESSION['id_usuario'];
$where      = "";
if ($id_usuario > 2) {
    $where = "AND su.id_usuario=$id_usuario";
}
$sql    = "SELECT cod_falla FROM fallas WHERE fecha = CURRENT_DATE AND  id_usuario_f = $id_usuario ORDER BY fecha DESC LIMIT 1 ";
$result = $objmod->ex_query($sql);
$ul     = (int) $result[0]['cod_falla'];
if ($ul == 0) {
    $cod_falla = 1;
    $num_falla = $usuario . date('dm') . "-1";
} else {
    $cod_falla = $ul + 1;
    $num_falla = $usuario . date('dm') . "-$cod_falla";
}

$id_equipos = $objmod->auto_increment;

$img_mod  = _img_dt . _img_dt_mod;
$img_del  = _img_dt . _img_dt_del;
$img_acep = _img_dt . _img_dt_acep;
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
        <script src="<?php echo _ruta_librerias_script_js . 'asignar.js' ?>" type="text/javascript"></script>
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
        <div id="contenedor" class="panel panel-default animated slideInDown" style="width : 90%;margin: auto;height: auto;position: relative; top:25px;">
            <div class="panel-heading" style="font-weight: bold;font-size: 12px;">Asignar Fallas</div>
            <div class="panel-body">
                <div id="div_asignar" class="row" style="margin:auto;width:95%">
                    <fieldset>
                        <legend>
                            Fallas por Asignar
                        </legend>
                    </fieldset>
                    <input type="hidden" name="fila" value="" id="fila"/>
                    <input type="hidden" name="usuario" value="" id="usuario"/>
                    <input type="hidden" name="departamento" value="" id="departamento"/>
                    <table  border="0" cellspacing="1" id="tabla_fallas" class="tablas table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
                        <thead>
                            <tr class="success">
                                <th>Usuario</th>
                                <th>Número Falla</th>
                                <th>Departamento</th>
                                <th>Estatus</th>
                                <th>Asignar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql      = "SELECT 
                                            CONCAT(uf.nombre,' ', uf.apellido) AS nombres,f.num_falla,d.nombre_departamento,ef.estatus
                                         FROM fallas AS f
                                         INNER JOIN usuario_f AS uf ON f.usuario_fa_id=uf.id
                                         INNER JOIN  departamento AS d ON uf.departamento_id=d.id
                                         INNER JOIN  estatus_fallas ef on f.id_estatus=ef.id
                                         WHERE f.id_estatus = 1";
                            $result   = $objmod->ex_query($sql);
                            $es_array = is_array($result) ? TRUE : FALSE;
                            if ($es_array === TRUE) {
                                for ($i = 0; $i < count($result); $i++) {
                                    ?>
                                    <tr>  
                                        <td>
                                            <?php echo $result[$i]['nombres']; ?>
                                        </td>
                                        <td>
                                            <?php echo $result[$i]['num_falla']; ?>
                                        </td> 
                                        <td>
                                            <?php echo $result[$i]['nombre_departamento']; ?>
                                        </td>
                                        <td>
                                            <?php echo $result[$i]['estatus']; ?>
                                        </td>                                                
                                        <td>
                                            <img class="modificar"  title="ASignar" style="cursor: pointer" src="<?php echo $img_acep ?>" width="18" height="18" alt="Asignar"/>
                                        </td>                                                
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <br/>
                <div id="div_formulario" style="display: none">
                    <form id="formasignar">
                        
                        <div class="row form-inline">
                            <div class="form-group col-xs-6">
                                <label>N&uacute;mero de Falla:</label>
                                <input type="text" disabled="disabled" style="width: 70%;background-color:#FFFFFF;color:#FF0000 " class="form-control input-sm" id="num_falla" name="num_falla" value="" maxlength="22" />
                            </div> 
                            <div class="form-group col-xs-6">
                                <label>T&eacute;nico a Asignar:</label>
                                <select style="width: 70%"  id="usuariof_id"  name="usuariof_id"  class="form-control select2 input-sm">
                                    <option value="0">Seleccione</option>
                                    <?php
                                    $datos['tabla']     = 's_usuario AS su,s_perfil AS sp,usuario_f AS uf';
                                    $datos['campos']    = "uf.id,uf.id_usuario_f,CONCAT(uf.nombre,' ',uf.apellido) AS nombres";
                                    $datos['condicion'] = 'su.perfil_id=sp.id AND su.id=uf.usuario_id AND su.perfil_id=3';
                                    $result_depar       = $objuser->getUsuarioF($datos);
                                    for ($i = 0; $i < count($result_depar); $i++) {
                                        ?>
                                        <option  value="<?php echo $result_depar[$i]['id'] ?>"><?php echo $result_depar[$i]['nombres'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div> 
                        </div>
                        <br/>
                        <br/>
                        <div class="row form-inline">
                            <div class="form-group col-xs-12" style="text-align:center;">
                                <button type="button" id="asignar" class="btn btn-primary btn-sm">Asignar</button>
                                <button type="button" id="cancelar" class="btn btn-primary btn-sm">Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <br/>
                <br/>
                <div class="row" style="margin:auto;width:95%">
                    <fieldset>
                        <legend>
                            Fallas Asignadas
                        </legend>
                    </fieldset>
                   
                    <table  border="0" cellspacing="1" id="tabla_fallas_asig" class="tablas table table-bordered table-striped table-hover table-condensed dt-responsive table-responsive">
                        <thead>
                            <tr class="success">
                                <th>Usuario</th>
                                <th>Asignado</th>
                                <th>Número Falla</th>
                                <th>Departamento</th>
                                <th>Estatus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT
                                        (SELECT CONCAT(nombre,' ',apellido) FROM usuario_f  WHERE id=f.usuario_fa_id) AS usuario_falla,
                                        (SELECT CONCAT(nombre,' ',apellido) FROM usuario_f WHERE id=fa.usuariof_id) As usuario_asignado,
                                        fa.num_falla,
                                        d.nombre_departamento,
                                        ef.estatus
                                        FROM fallas_asignada AS fa
                                        INNER JOIN fallas AS f ON fa.num_falla=f.num_falla
                                        INNER JOIN usuario_f AS uf ON f.usuario_fa_id=uf.id
                                        INNER JOIN departamento AS d on uf.departamento_id=d.id
                                        INNER JOIN estatus_fallas AS ef ON f.id_estatus=ef.id;";
                            $result   = $objmod->ex_query($sql);
                            $es_array = is_array($result) ? TRUE : FALSE;
                            if ($es_array === TRUE) {
                                for ($i = 0; $i < count($result); $i++) {
                                    ?>
                                    <tr> 
                                        <td>
                                            <?php echo $result[$i]['usuario_falla']; ?>
                                        </td>
                                        <td>
                                            <?php echo $result[$i]['usuario_asignado']; ?>
                                        </td>
                                        <td>
                                            <?php echo $result[$i]['num_falla']; ?>
                                        </td> 
                                        <td>
                                            <?php echo $result[$i]['nombre_departamento']; ?>
                                        </td>
                                        <td>
                                            <?php echo $result[$i]['estatus']; ?>
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