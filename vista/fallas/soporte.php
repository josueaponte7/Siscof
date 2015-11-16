<?php
session_start();
define('BASEPATH', dirname(__DIR__) . '/');
define('BASEURL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(BASEPATH))));

require_once '../../librerias/globales.php';
require_once '../../modelo/fallas/AsignarFalla.php';
require_once '../../modelo/mantenimientos/UsuarioF.php';

$objmod  = new AsignarFalla();

if (isset($_GET['modulo'])) {
    $objmod->url($_SERVER['SCRIPT_NAME'], $_GET['modulo']);
    $_SESSION['cod_modulo'] = $_GET['modulo'];
}
$usuario    = $_SESSION['usuario'];
$id_usuario = $_SESSION['id_usuario'];

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
        <script src="<?php echo _ruta_librerias_script_js . 'soporte.js' ?>" type="text/javascript"></script>
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
            span.estatus{
                color: #016305;
                font-weight: bold;
            }
            span.estatus:hover{
                text-decoration: underline;
                cursor: pointer
            }
        </style>
    </head>
    <body>
        <div id="contenedor" class="panel panel-default animated slideInDown" style="width : 90%;margin: auto;height: auto;position: relative; top:25px;">
            <div class="panel-heading" style="font-weight: bold;font-size: 12px;">Asignar Fallas</div>
            <div class="panel-body">
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
                                <th>Número Falla</th>
                                <th>Departamento</th>
                                <th>Estatus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT
                                        CONCAT(uf.nombre,' ',uf.apellido) AS usuario_falla,
                                        fa.num_falla,
                                        d.nombre_departamento,
                                        ef.estatus,
                                        ef.id
                                    FROM fallas_asignada AS fa
                                    INNER JOIN fallas AS f ON fa.num_falla=f.num_falla
                                    INNER JOIN usuario_f AS uf ON f.usuario_fa_id=uf.id
                                    INNER JOIN departamento AS d on uf.departamento_id=d.id
                                    INNER JOIN estatus_fallas AS ef ON f.id_estatus=ef.id
                                    WHERE fa.usuariof_id=(SELECT uf.id FROM usuario_f AS uf
                                    INNER JOIN s_usuario AS su ON uf.usuario_id=su.id
                                    WHERE su.id='".$id_usuario."');";
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
                                            <?php echo $result[$i]['num_falla']; ?>
                                        </td> 
                                        <td>
                                            <?php echo $result[$i]['nombre_departamento']; ?>
                                        </td>
                                        <td>
                                            
                                            <?php 
                                            if($result[$i]['id'] == 2){
                                            ?>
                                                <span class="estatus">PROCESAR</span> 
                                            <?php
                                               
                                            }else if($result[$i]['id'] == 3){
                                              ?>
                                                <span class="estatus">CERRAR</span> 
                                            <?php
                                            }
                                            ?>                                           
                                        </td>                                              
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table> 
                </div>
                
                <input type="hidden"  id="fila" name="fila" value="" />
                <br/>
                <br/>
                <form name="frmfallas" id="frmfallas" method="post" enctype="multipart/form-data">
                    <div class="row form-inline">
                        <div class="form-group col-xs-6">
                            <label>Num Falla:&nbsp;&nbsp;&nbsp;</label>
                            <input type="hidden"  id="usuario_id" name="usuario_id" value="<?php echo $id_usuario; ?>" />
                            <input type="text" disabled="disabled" style="width: 70%;color: #FF0000;font-weight: bold;background-color:#FFFFFF " class="form-control input-sm" id="num_falla" name="num_falla" value=""  />
                        </div> 
                        <div class="form-group col-xs-6">
                            <label>Estatus:&nbsp;&nbsp;&nbsp;</label>
                            <select style="width: 70%"  id="estatus"  name="estatus"  class="form-control select2 input-sm">
                                <option value="0">Seleccione</option>
                                <?php
                                $data['tabla']     = "estatus_fallas";
                                $data['campos']    = "id,estatus";
                                $data['condicion'] = "id > 3";
                                $result_depar      = $objmod->getEstatusFallas($data);
                                for ($i = 0; $i < count($result_depar); $i++) {
                                    ?>
                                    <option  value="<?php echo $result_depar[$i]['id'] ?>"><?php echo $result_depar[$i]['estatus'] ?></option>
                                <?php }
                                ?>
                            </select>
                        </div> 
                    </div>
                    <br/>
                    <div class="row form-inline">
                        <div class="form-group col-xs-12">
                            <label>Descripci&oacute;n:</label>
                            <textarea class="form-control input-sm"  style="width: 88%;resize: none" id="descripcion" name="descripcion" maxlength="150" ></textarea>    
                        </div>
                    </div>
                    <br/>
                    <div class="row form-inline">
                        <div class="form-group col-xs-12" style="text-align:center;">
                            <button type="button" id="cerrar" class="btn btn-primary btn-sm">Cerrar</button>
                            <button type="button" id="cancelar" class="btn btn-primary btn-sm">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>