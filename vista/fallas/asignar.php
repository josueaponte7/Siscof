<?php
session_start();
define('BASEPATH', dirname(__DIR__) . '/');
define('BASEURL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(BASEPATH))));

require_once '../../librerias/globales.php';
require_once '../../modelo/fallas/AsignarFalla.php';

$objmod = new AsignarFalla();

if (isset($_GET['modulo'])) {
    $objmod->url($_SERVER['SCRIPT_FILENAME'], $_GET['modulo']);
}
$usuario    = $_SESSION['usuario'];
$id_usuario = $_SESSION['id_usuario'];
$where = "";
if($id_usuario > 2){
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
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_estilos; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_select2; ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo _ruta_librerias_css . _css_select2_bootstrap; ?>"/>

        <script src="<?php echo _ruta_librerias_js . _js_jquery; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_bootstrap; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_dataTable; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_select2; ?>" type="text/javascript"></script>
        <script src="<?php echo _ruta_librerias_js . _js_select2_es; ?>" type="text/javascript"></script>
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
        </style>
    </head>
    <body>
        <div class="panel panel-default" style="width : 90%;margin: auto;height: auto;position: relative; top:25px;">
            <div class="panel-heading" style="font-weight: bold;font-size: 12px;">Asignar Fallas</div>
            <div class="panel-body">
                <table style="width:100%" border="0" align="center">

                    <tr>
                        <td class="fila">
                            <fieldset>
                                <legend>
                                    Fallas por Asignar
                                </legend>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <div  class="fila">
                                <table  border="0" cellspacing="1" id="tabla_fallas" class="dataTable" style="margin: auto;width:100%;">
                                <thead>
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Número Falla</th>
                                        <th>Departamento</th>
                                        <th>Estatus</th>
                                        <th>Asignar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT 
                                            f.id_falla,
                                            f.num_falla,
                                            d.nombre_departamento,
                                            e.estatus,
                                            su.usuario
                                            FROM
                                            fallas AS f 
                                            INNER JOIN departamento AS d ON f.id_departamento = d.id_departamento 
                                            INNER JOIN estatus_fallas AS e ON f.id_estatus = e.id_estatus 
                                            INNER JOIN s_usuario AS su ON f.id_usuario=su.id_usuario
                                            WHERE f.id_estatus = 1
                                            ORDER BY num_falla DESC";
                                    $result   = $objmod->ex_query($sql);
                                    $es_array = is_array($result) ? TRUE : FALSE;
                                    if ($es_array === TRUE) {
                                        for ($i = 0; $i < count($result); $i++) {
                                            ?>
                                            <tr>  
                                                <td>
                                                    <?php echo $result[$i]['usuario']; ?>
                                                </td>
                                                <td id="<?php echo $result[$i]['id_falla']; ?>">
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
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="fila">
                            <fieldset>
                                <legend>
                                    Fallas Asignadas
                                </legend>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div  class="fila">
                                <table  border="0" cellspacing="1" id="tabla_fallas_asig" class="dataTable" style="margin: auto;width:100%;">
                                <thead>
                                    <tr>
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
                                                    f.num_falla,
                                                    d.nombre_departamento,
                                                    e.estatus,
                                                    (
                                                    SELECT 
                                                      su.usuario 
                                                    FROM
                                                      s_usuario AS su 
                                                      INNER JOIN usuario_f AS uf 
                                                        ON su.id_usuario = uf.id_usuario 
                                                    WHERE uf.id_usuario_f = f.id_usuario_f
                                                    ) AS usuario,
                                                    (
                                                    SELECT DISTINCT 
                                                      CONCAT(uf.nombre,' ',uf.apellido) 
                                                    FROM
                                                      s_usuario AS su 
                                                      INNER JOIN usuario_f AS uf ON su.id_usuario = uf.id_usuario 
                                                      INNER JOIN fallas_asignada AS fa ON uf.id_usuario_f = fa.id_usuario_f 
                                                      INNER JOIN fallas AS fn ON fa.id_falla = fn.id_falla 
                                                    WHERE fn.id_estatus = 2
                                                    ) AS usuario_asig 
                                                  FROM
                                                    fallas AS f 
                                                    INNER JOIN departamento AS d  ON f.id_departamento = d.id_departamento 
                                                    INNER JOIN estatus_fallas AS e ON f.id_estatus = e.id_estatus 
                                                  WHERE f.id_estatus = 2 
                                                  ORDER BY num_falla DESC ;";
                                        $result   = $objmod->ex_query($sql);
                                        $es_array = is_array($result) ? TRUE : FALSE;
                                        if ($es_array === TRUE) {
                                            for ($i = 0; $i < count($result); $i++) {
                                                ?>
                                            <tr> 
                                                <td>
                                            <?php echo $result[$i]['usuario']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $result[$i]['usuario_asig']; ?>
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
                        </td>
                    </tr>
                  
                    <tr>
                        <td>
                            <div id="div_falla" style="display: none">
                                <form  name="frmfallas" id="frmfallas" method="post" enctype="multipart/form-data">
    <!--                                <img style="cursor: pointer" id="imgmunicipio" src="../../imagenes/img_info.png" width="15" height="15" alt="img_info"/>-->
                                    <table width="750" align="center">
                                        <tr>
                                            <td width="98" height="58" align="left">Datos Usuario:</td>
                                            <td width="219">
                                                <div id="div_usuario" style="margin-top: 10px" class="form-group">

                                                    <input type="text"  class="form-control input-sm" id="datos_usuario" name="datos_usuario" style="background-color: #FFFFFF" disabled="disabled" value="" maxlength="22" />
                                                </div>
                                            </td>
                                            <td width="70">&nbsp;</td>
                                            <td width="70" height="58" align="left">N&uacute;mero Falla:</td>
                                            <td width="206">
                                                <div id="div_numfalla" style="margin-top: 10px" class="form-group">
                                                    <input type="hidden" id="id_falla" name="id_falla" value=""  />
                                                    <input type="text"  class="form-control input-sm" id="num_falla" name="num_falla" disabled="disabled" style="color: #FF0000;background-color: #FFFFFF" value="" maxlength="22" />
                                                </div>
                                            </td>
    <!--                                        <td width="17">
                                                <img style="cursor: pointer" id="imgsector" src="../../imagenes/img_info.png" width="15" height="15" alt="img_info"/>
                                            </td>-->
                                        </tr>
                                        <tr>
                                            <td width="98" height="58" align="left">Tecnico:</td>
                                            <td width="219">
                                                <div id="div_deparamento" style="margin-top: 10px" class="form-group">
                                                    <select name="tecnico" class="form-control input-sm select2" id="tecnico">
                                                        <option value="0">Seleccione</option>
                                                        <?php
                                                        $sql    = " SELECT 
                                                                        su.id_usuario,
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
                                                            <option style="font-size: 10px;" value="<?php echo $result[$i]['id_usuario']; ?>"><?php echo $result[$i]['nombre'] . ' ' . $result[$i]['apellido']; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td width="70">&nbsp;</td>
                                            <td width="70" height="58" align="left">Estatus:</td>
                                            <td width="206">
                                                <div id="div_nombre" style="margin-top: 10px" class="form-group">
                                                    <input type="text"  class="form-control input-sm" id="estatus" name="estatus" disabled="disabled" value="NO ASIGNADO" style="background-color: #FFFFFF"  maxlength="22" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="98" height="58" align="left">Departamento:</td>
                                            <td  width="219">
                                                <div id="div_usuario" style="margin-top: 10px" class="form-group">
                                                    <input type="text"  class="form-control input-sm" id="departamento" name="departamento" style="background-color: #FFFFFF" disabled="disabled" value="" maxlength="22" />
                                                </div>
                                            </td>
                                            <td width="70">&nbsp;</td>
                                            <td width="70">&nbsp;</td>
                                            <td width="70">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td width="98" height="49" align="left">Problema:</td>
                                            <td colspan="4">
                                                <div id="div_direccion" class="form-group">
                                                    <textarea class="form-control input-sm" id="problema" name="problema" rows="2" cols="95"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td  colspan="5" align="right">&nbsp;</td>
                                        </tr>
                                        <td colspan="5" align="center"> 
                                            <div id="botones" style="margin-top: 50px;">  
                                                <input type="hidden" name="fila" id="fila" value="" />
                                                <button type="button" id="asignar" class="btn btn-primary btn-sm">Asignar</button>
                                                <button type="button" id="limpiar" class="btn btn-primary btn-sm">Limpiar</button>
                                                <button type="button" id="salir" class="btn btn-primary btn-sm">Salir</button>
                                            </div>
                                        </td>
                                    </table>
                                </form>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>