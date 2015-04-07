
$(document).ready(function() {
    var TComponentes = $('#tabla_repuesto').dataTable({
        "iDisplayLength": 5,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [5, 10, 20, 30, 40, 50],
        "oLanguage": {"sUrl": "../../librerias/js/es.txt"},
        "aoColumns": [
        {"sClass": "center","sWidth": "4%"},
        {"sClass": "center", "sWidth": "22%"},
        {"sClass": "center", "sWidth": "20%"},
        {"sClass": "center", "sWidth": "20%"},
     
        {"sWidth": "4%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false},
        {"sWidth": "4%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false}
        ]
    });

    var $frmrepuesto         = $('form#frmrepuesto');
    var $nombre_repuesto     = $frmrepuesto.find('select#nombre_repuesto');
    var $marca_repuesto      = $frmrepuesto.find('input:text#marca_repuesto');
    var $modelo_repuesto     = $frmrepuesto.find('input:text#modelo_repuesto');
    
    var $btn_guardar            = $frmrepuesto.find('button#guardar');
    
    var vali_cod  = '1234567890';
    var val_letra = ' abcdefghijklmnopqrstuvwxyzáéíóúñ' + vali_cod;
    var val_letras = ' abcdefghijklmnopqrstuvwxyzáéíóúñ';
    
    $nombre_repuesto.select2();
    
    $nombre_repuesto.validar(val_letras);
    $marca_repuesto.validar(val_letras);
    $modelo_repuesto.validar(val_letra);

    
    var url = '../../controlador/inventario/repuesto.php';
    $btn_guardar.click(function(){
        
        var img_mod = ' <img class="modificar"  title="Modificar" style="cursor: pointer" src="../../imagenes/datatable/modificar.png " width="18" height="18" alt="Modificar"/>';
        var img_del = ' <img class="eliminar"  title="Eliminar" style="cursor: pointer" src="../../imagenes/datatable/eliminar.png " width="18" height="18" alt="Modificar"/>'
        var $nombre = $nombre_repuesto.find('option').filter(':selected');
        if ($(this).text() == 'Guardar') {
        
            $.post(url, $frmrepuesto.serialize()+'&accion=Agregar', function(respuesta) {
                var cod_msg = parseInt(respuesta.error_codmensaje);
                var mensaje = respuesta.error_mensaje;               

                // obtener el ultimo codigo del estado
                var codigo = 1;
                var TotalRow = TComponentes.fnGetData().length;
                if (TotalRow > 0) {
                    var lastRow = TComponentes.fnGetData(TotalRow - 1);
                    codigo = parseInt(lastRow[0]) + 1;
                }
                if (cod_msg == 21) {
                    window.parent.apprise(mensaje, {'textOk': 'Aceptar'}, function () {
                        var newRow = TComponentes.fnAddData([codigo,$nombre.text(), $marca_repuesto.val(), $modelo_repuesto.val(), img_mod, img_del]);                    
                        $nombre_repuesto.select2('val',0);
                        $('input:text').val('');
                        // Agregar el id a la fila estado
                        var oSettings = TComponentes.fnSettings();
                        var nTr = oSettings.aoData[ newRow[0] ].nTr;
                        $('td', nTr)[1].setAttribute('id', $nombre.val());
                       
                    });
                }
             },'json');
        }else {
            window.parent.apprise('<div class="msj-danger">&iquest;Desea Modificar el Registro?</div>', {'verify': true, 'textYes': 'Aceptar', 'textNo': 'Cancelar'}, function (r) {
                if (r) {
                    $.post(url, $frmrepuesto.serialize()+'&accion=Modificar', function(respuesta) {
                        var cod_msg = parseInt(respuesta.error_codmensaje);
                        var mensaje = respuesta.error_mensaje;
                        
                        if (cod_msg == 22) {
                            window.parent.apprise(mensaje, {'textOk': 'Aceptar'}, function () {
                                var fila = $("#fila").val();
                                TComponentes.fnUpdate( $nombre.text(), 0, 1 ); // Single cell
                                TComponentes.fnUpdate( $marca_repuesto.val(), 0, 2 ); // Single cell
                                TComponentes.fnUpdate( $modelo_repuesto.val(), 0, 3 ); // Single cell
                                $('#guardar').text('Guardar');
                                $nombre_repuesto.select2('val',0);
                                $('input:text').val('');
                             });
                        }
                    },'json');
                }
            });
        }
    });
    
    $('table#tabla_repuesto').on('click', 'img.modificar', function() {
        
        // borra el campo fila
        $('#fila').remove();
        $('#id_repuesto').remove();
        var padre = $(this).closest('tr');

        var id_repuesto       = padre.children('td:eq(0)').text();
        var id_items          = padre.children('td:eq(1)').attr('id');
        var marca_repuesto    = padre.children('td:eq(2)').text();
        var modelo_repuesto   = padre.children('td:eq(3)').html();
        
       // obtener la fila a modificar
        var fila = padre.index();

        $('#guardar').text('Modificar');

        $nombre_repuesto.select2('val', id_items);
        $marca_repuesto.val(marca_repuesto.trim());
        $modelo_repuesto.val(modelo_repuesto.trim());
          
        // crear el campo fila y añadir la fila
        var $fila = '<input type="hidden" id="fila"  value="' + fila + '" name="fila">';
        $($fila).prependTo($frmrepuesto);

        var $id_repuestos = '<input type="hidden" id="id_repuesto"  value="' + id_repuesto.trim() + '" name="id_repuesto">';
        $($id_repuestos).appendTo($frmrepuesto);
    });
    
    $('table#tabla_repuesto').on('click', 'img.eliminar', function() {
        
        $nombre_repuesto.select2('val',0);
        $('input:text').val('');
        $('#guardar').text('Guardar');
        var padre         = $(this).closest('tr');
        var id_repuesto = padre.children('td:eq(0)').text();
        var nRow          = padre[0];
        window.parent.apprise('<div class="msj-danger">&iquest;Desea Eliminar el Registro?</div>', {'verify': true, 'textYes': 'Aceptar', 'textNo': 'Cancelar'}, function(r) {
            if (r) {
                $.post(url, {id_repuesto: id_repuesto.trim(), accion: 'Eliminar'}, function(data) {
                    var cod_msg = parseInt(data.error_codmensaje);
                    var mensaje = data.error_mensaje;

                    window.parent.apprise(mensaje, {'textOk': 'Aceptar'},function(){
                        if (cod_msg === 23) {
                            TComponentes.fnDeleteRow(nRow);
                        }  
                    });
                    
                }, 'json');
            } else {
                limpiar($formulario);
            }
        });
    });
});


