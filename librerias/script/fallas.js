$(document).ready(function () {
    var TFallas = $('#tabla_fallas').dataTable({
        "iDisplayLength": 5,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [5, 10, 20, 30, 40, 50],
        "oLanguage": {"sUrl": "../../librerias/js/es.txt"},
        "order": [[ 1, "desc" ]],
        "aoColumns": [
            
            {"sClass": "center", "sWidth": "25%"},
            {"sClass": "center", "sWidth": "20%"},
            {"sClass": "center", "sWidth": "25%"},
            {"sWidth": "8%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false},
            {"sWidth": "8%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false}
        ]
    });   
    
    var $frmfallas         = $('form#frmfallas');
    var $datos_usuario     = $frmfallas.find('input:text#datos_usuario');
    var $num_falla         = $frmfallas.find('input:text#num_falla');
    var $id_departamento   = $frmfallas.find('select#id_departamento');
    var $estatus           = $frmfallas.find('input:text#estatus');
    var $problema          = $frmfallas.find('textarea#problema');
    var $btn_guardar       = $frmfallas.find('button#guardar');    

    $id_departamento.select2();
    var vali_cod  = '1234567890';
    var val_letra = ' abcdefghijklmnopqrstuvwxyzáéíóúñ' + vali_cod;
    var letras    = ' abcdefghijklmnopqrstuvwxyzáéíóúñ';
    
    $datos_usuario.validar(letras);
    $num_falla.validar(vali_cod);
    $id_departamento.validar(letras);
    $estatus.validar(letras);
    $problema.validar(val_letra);
    
    var url = '../../controlador/fallas/fallas.php';
    $btn_guardar.click(function(){
        
        var img_mod = ' <img class="modificar"  title="Modificar" style="cursor: pointer" src="../../imagenes/datatable/modificar.png " width="18" height="18" alt="Modificar"/>';
        var img_del = ' <img class="eliminar"  title="Eliminar" style="cursor: pointer" src="../../imagenes/datatable/eliminar.png " width="18" height="18" alt="Modificar"/>'
        
        $num_falla.prop('disabled',false);
        $.post(url, $frmfallas.serialize(), function(respuesta) {
            
            var cod_msg = parseInt(respuesta.error_codmensaje);
            var mensaje = respuesta.error_mensaje;
            var departamento = $id_departamento.find('option').filter(':selected');
            if (cod_msg == 21) {
                
                var res = $num_falla.val().split("-");
                
                var num_fa      = $('#cod_falla').val();
                var cod_fall    = parseInt(num_fa)+1;
                var id_falla    = parseInt(num_fa);
                var num_falla   = res[0]+'-'+id_falla; 
                var num_falla_n = res[0]+'-'+cod_fall; 
               window.parent.apprise(mensaje, {'textOk': 'Aceptar'}, function () {
                    TFallas.fnAddData([$problema.val(), num_falla, departamento.text(), $estatus.val(), img_mod, img_del]);                    

                    var num_fal = lpad(id_falla,7);
                    $num_falla.val(num_fal);
                    $('#cod_falla').val(cod_fall);
                    $problema.val('');
                    $id_departamento.val(0);
                    $num_falla.val(num_falla_n).prop('disabled',true);
                });
            }
         },'json');
    });
    
});
function lpad(number, digits) {
    return Array(Math.max(digits - String(number).length + 1, 0)).join(0) + number;
}