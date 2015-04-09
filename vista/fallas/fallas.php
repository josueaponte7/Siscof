<?php
session_start();
define('BASEPATH', dirname(__DIR__) . '/');
define('BASEURL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(BASEPATH))));

require_once '../../librerias/globales.php';
require_once '../../modelo/fallas/Fallas.php';
require_once '../../modelo/mantenimientos/Departamento.php';

$objmod = new Fallas();
$odjdep = new Departamento();

if (isset($_GET['modulo'])) {
    $objmod->url($_SERVER['SCRIPT_FILENAME'], $_GET['modulo']);
}
$usuario    = $_SESSION['usuario'];
$id_usuario = $_SESSION['id_usuario'];

$sql = "SELECT cod_falla FROM fallas WHERE fecha = CURRENT_DATE AND  id_usuario = $id_usuario ORDER BY fecha DESC LIMIT 1 ";
$result = $objmod->ex_query($sql);
$ul = (int)$result[0]['cod_falla'];
if($ul == 0){
   $cod_falla = 1;
   $num_falla = $usuario.date('dm')."-1";
}else{
 $cod_falla = $ul+1;
 $num_falla = $usuario.date('dm')."-$cod_falla";   
}

$id_equipos = $objmod->auto_increment;

$img_mod = _img_dt . _img_dt_mod;
$img_del = _img_dt . _img_dt_del;
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
        </style>
    </head>
    <body>
        <div class="panel panel-default" style="width : 90%;margin: auto;height: auto;position: relative; top:25px;">
            <div class="panel-heading" style="font-weight: bold;font-size: 12px;">Registrar Fallas</div>
            <div class="panel-body">
                <table width="681" border="0" align="center">
                    <tr>
                        <td width="675" align="center">
                            <form name="frmfallas" id="frmfallas" method="post" enctype="multipart/form-data">
<!--                                <img style="cursor: pointer" id="imgmunicipio" src="../../imagenes/img_info.png" width="15" height="15" alt="img_info"/>-->
                                <table width="750" align="center">
                                    <tr>
                                        <td width="98" height="58" align="left">Datos Usuario:</td>
                                        <td width="219">
                                            <div id="div_usuario" style="margin-top: 10px" class="form-group">
                                                <input type="hidden"  id="id_usuario" name="id_usuario" value="<?php echo $id_usuario;?>" />
                                                <input type="text"  class="form-control input-sm" id="datos_usuario" name="datos_usuario" style="background-color: #FFFFFF" disabled="disabled" value="<?php echo $usuario;?>" maxlength="22" />
                                            </div>
                                        </td>
                                        <td width="70">&nbsp;</td>
                                        <td width="70" height="58" align="left">N&uacute;mero Falla:</td>
                                        <td width="206">
                                            <div id="div_numfalla" style="margin-top: 10px" class="form-group">
                                                <input type="hidden" id="cod_falla" name="cod_falla" value="<?php echo $cod_falla ?>"  />
                                                <input type="text"  class="form-control input-sm" id="num_falla" name="num_falla" disabled="disabled" style="color: #FF0000;background-color: #FFFFFF" value="<?php echo $num_falla ?>" maxlength="22" />
                                            </div>
                                        </td>
<!--                                        <td width="17">
                                            <img style="cursor: pointer" id="imgsector" src="../../imagenes/img_info.png" width="15" height="15" alt="img_info"/>
                                        </td>-->
                                    </tr>
                                    <tr>
                                        <td width="98" height="58" align="left">Departamento:</td>
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
                                        <td width="70">&nbsp;</td>
                                        <td width="70" height="58" align="left">Estatus</td>
                                        <td width="206">
                                            <div id="div_nombre" style="margin-top: 10px" class="form-group">
                                                <input type="text"  class="form-control input-sm" id="estatus" name="estatus" disabled="disabled" value="NO ASIGNADO" style="background-color: #FFFFFF"  maxlength="22" />
                                            </div>
                                        </td>
<!--                                        <td width="17">
                                            <img style="cursor: pointer" id="imgsector" src="../../imagenes/img_info.png" width="15" height="15" alt="img_info"/>
                                        </td>-->
                                    </tr>
                                    <tr>
                                        <td width="98" height="49" align="left">Problema:</td>
                                        <td colspan="4">
                                            <div id="div_direccion" class="form-group">
                                                <textarea class="form-control input-sm" id="problema" name="problema" rows="2" cols="95"></textarea>
                                            </div>
                                        </td>
<!--                                        <td width="17">
                                            <img style="cursor: pointer" id="imgdireccion" src="../../imagenes/img_info.png" width="15" height="15" alt="img_info"/>
                                        </td>-->
                                    </tr>
                                    <tr>
                                        <td  colspan="9" align="right">&nbsp;</td>
                                    </tr>
                                    <td colspan="7" align="center"> 
                                        <div id="botones" style="margin-top: 50px;">
                                            <input type="hidden" name="accion" value="agregar" id="accion"/>
                                            <button type="button" id="guardar" class="btn btn-primary btn-sm">Guardar</button>
                                            <button type="button" id="limpiar" class="btn btn-primary btn-sm">Limpiar</button>
                                            <button type="button" id="salir" class="btn btn-primary btn-sm">Salir</button>
                                        </div>
                                    </td>
                                </table>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <table  border="0" cellspacing="1" id="tabla_fallas" class="dataTable" style="margin: auto;width:100%">
                                <thead>
                                    <tr>
                                        <th>Número Falla</th>
                                        <th>Departamento</th>
                                        <th>Estatus</th>
                                        <th>Modificar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    
                                    $sql = "SELECT 
                                            f.num_falla,
                                            d.nombre_departamento,
                                            e.estatus
                                            FROM fallas AS f 
                                            INNER JOIN departamento  AS d ON f.id_departamento=d.id_departamento
                                            INNER JOIN estatus_fallas AS e ON f.id_estatus=e.id_estatus
                                            WHERE f.id_usuario_f=$id_usuario
                                            ORDER BY num_falla DESC";
                                    $result = $objmod->ex_query($sql);
                                    $es_array = is_array($result) ? TRUE : FALSE;
                                    if ($es_array === TRUE) {
                                        for ($i = 0; $i < count($result); $i++) {
                                            
                                            ?>
                                            <tr>                                               
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
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>