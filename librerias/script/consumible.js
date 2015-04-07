
$(document).ready(function() {
    var TRegistrar = $('#tabla_registrar').dataTable({
        "iDisplayLength": 5,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [5, 10, 20, 30, 40, 50],
        "oLanguage": {"sUrl": "../../librerias/js/es.txt"},
        "aoColumns": [
//        {"sClass": "center", "sWidth": "20%"},
        {"sClass": "center", "sWidth": "22%"},
        {"sClass": "center", "sWidth": "20%"},
        {"sClass": "center","sWidth": "4%"},
        {"sWidth": "4%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false}
        ]
    });

    var $frmregistrar        = $('form#frmregistrar');
    var $nombre_consumible   = $frmregistrar.find('input:text#nombre_consumible');
    var $marca_consumible    = $frmregistrar.find('input:text#marca_consumible');
    var $btn_guardar         = $frmregistrar.find('button#guardar');
    
//    var vali_cod  = '1234567890';
//    var val_letra = ' abcdefghijklmnopqrstuvwxyzáéíóúñ' + vali_cod;
    var val_letras = ' abcdefghijklmnopqrstuvwxyzáéíóúñ';
    
    $nombre_consumible.validar(val_letras);
    $marca_consumible.validar(val_letras);
    
    var url = '../../controlador/inventario/consumible.php';
    $btn_guardar.click(function(){
        
        var img_mod = ' <img class="modificar"  title="Modificar" style="cursor: pointer" src="../../imagenes/datatable/modificar.png " width="18" height="18" alt="Modificar"/>';
        var img_del = ' <img class="eliminar"  title="Eliminar" style="cursor: pointer" src="../../imagenes/datatable/eliminar.png " width="18" height="18" alt="Modificar"/>'
        $.post(url, $frmregistrar.serialize(), function(respuesta) {
            var cod_msg = parseInt(respuesta.error_codmensaje);
            var mensaje = respuesta.error_mensaje;
            if (cod_msg == 21) {
                window.parent.apprise(mensaje, {'textOk': 'Aceptar'}, function () {
                    TRegistrar.fnAddData([$nombre_consumible.val(), $marca_consumible.val(), img_mod, img_del]);
                    $nombre_consumible.val('');
                    $marca_consumible.val('');
                });
            }
         },'json');
    });
    
     $('table#tabla_registrar').on('click', 'img.modificar', function() {
        // borra el campo fila
        $('#fila').remove();
        $('#id_consumible').remove();
        var padre = $(this).closest('tr');

        var nombre_consumible = padre.children('td:eq(0)').text();
        var marca_consumible = padre.children('td:eq(1)').html();
        
        $('#guardar').text('Modificar');
        $('#nombre_consumible').val( nombre_consumible.trim());
        $('#marca_consumible').val(marca_consumible.trim());
    });
    
});


