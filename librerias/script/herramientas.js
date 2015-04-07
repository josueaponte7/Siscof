
$(document).ready(function() {
    var THerramientas = $('#tabla_herramienta').dataTable({
        "iDisplayLength": 5,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [5, 10, 20, 30, 40, 50],
        "oLanguage": {"sUrl": "../../librerias/js/es.txt"},
        "aoColumns": [
        {"sClass": "center","sWidth": "4%"},
        {"sClass": "center", "sWidth": "15%"},
        {"sClass": "center", "sWidth": "20%"},
        {"sClass": "center", "sWidth": "15%"},
        {"sClass": "center", "sWidth": "20%"},
        {"sClass": "center", "sWidth": "20%"},
        {"sWidth": "4%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false},
        {"sWidth": "4%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false}
        ]
    });

    var $frmherramienta         = $('form#frmherramienta');
    var $nombre_herramienta     = $frmherramienta.find('select#nombre_herramienta');
    var $marca_herramienta      = $frmherramienta.find('input:text#marca_herramienta');
    var $serial_herramienta     = $frmherramienta.find('input:text#serial_herramienta');
    var $num_bien_herramienta   = $frmherramienta.find('input:text#num_bien_herramienta');
    var $id_usuario_f           = $frmherramienta.find('select#id_usuario_f');
    var $btn_guardar            = $frmherramienta.find('button#guardar');
    
    var vali_cod  = '1234567890';
    var val_letra = ' abcdefghijklmnopqrstuvwxyzáéíóúñ' + vali_cod;
    var val_letras = ' abcdefghijklmnopqrstuvwxyzáéíóúñ';
    
    $nombre_herramienta.select2();
    $id_usuario_f.select2();
    
    $nombre_herramienta.validar(val_letras);
    $marca_herramienta.validar(val_letras);
    $serial_herramienta.validar(val_letra);
    $num_bien_herramienta.validar(vali_cod);
    
    var url = '../../controlador/inventario/herramientas.php';
    $btn_guardar.click(function(){
        
        var img_mod = ' <img class="modificar"  title="Modificar" style="cursor: pointer" src="../../imagenes/datatable/modificar.png " width="18" height="18" alt="Modificar"/>';
        var img_del = ' <img class="eliminar"  title="Eliminar" style="cursor: pointer" src="../../imagenes/datatable/eliminar.png " width="18" height="18" alt="Modificar"/>'
        var $nombre = $nombre_herramienta.find('option').filter(':selected');
        var $usuario_f = $id_usuario_f.find('option').filter(':selected');
        if ($(this).text() == 'Guardar') {
        
            $.post(url, $frmherramienta.serialize()+'&accion=Agregar', function(respuesta) {
                var cod_msg = parseInt(respuesta.error_codmensaje);
                var mensaje = respuesta.error_mensaje;               

                // obtener el ultimo codigo del estado
                var codigo = 1;
                var TotalRow = THerramientas.fnGetData().length;
                if (TotalRow > 0) {
                    var lastRow = THerramientas.fnGetData(TotalRow - 1);
                    codigo = parseInt(lastRow[0]) + 1;
                }
                if (cod_msg == 21) {
                    window.parent.apprise(mensaje, {'textOk': 'Aceptar'}, function () {
                        var newRow = THerramientas.fnAddData([codigo,$nombre.text(), $marca_herramienta.val(), $serial_herramienta.val(),$num_bien_herramienta.val(),$usuario_f.text(), img_mod, img_del]);                    
                        $('select').select2('val',0);
                        $('input:text').val('');
                        // Agregar el id a la fila estado
                        var oSettings = THerramientas.fnSettings();
                        var nTr = oSettings.aoData[ newRow[0] ].nTr;
                        $('td', nTr)[1].setAttribute('id', $nombre.val());
                        $('td', nTr)[5].setAttribute('id', $usuario_f.val());
                       
                    });
                }
             },'json');
        }else {
            window.parent.apprise('<div class="msj-danger">&iquest;Desea Modificar el Registro?</div>', {'verify': true, 'textYes': 'Aceptar', 'textNo': 'Cancelar'}, function (r) {
                if (r) {
                    $.post(url, $frmherramienta.serialize()+'&accion=Modificar', function(respuesta) {
                        var cod_msg = parseInt(respuesta.error_codmensaje);
                        var mensaje = respuesta.error_mensaje;
                        if (cod_msg == 22) {
                            window.parent.apprise(mensaje, {'textOk': 'Aceptar'}, function () {
                                var fila = $("#fila").val();
                                THerramientas.fnUpdate( $nombre.text(), 0, 1 ); // Single cell
                                THerramientas.fnUpdate( $marca_herramienta.val(), 0, 2 ); // Single cell
                                THerramientas.fnUpdate( $serial_herramienta.val(), 0, 3 ); // Single cell
                                THerramientas.fnUpdate( $num_bien_herramienta.val(), 0, 4 ); // Single cell
                                $('#guardar').text('Guardar');
                                $('select').select2('val',0);
                                $('input:text').val('');
                            });
                       }
                    },'json');
                }
            });
        }
    });
    
    $('table#tabla_herramienta').on('click', 'img.modificar', function() {
        
        // borra el campo fila
        $('#fila').remove();
        $('#id_herramientas').remove();
        var padre = $(this).closest('tr');

        var id_herramientas      = padre.children('td:eq(0)').text();
        var id_items             = padre.children('td:eq(1)').attr('id');
        var marca_herramienta    = padre.children('td:eq(2)').text();
        var serial_herramienta   = padre.children('td:eq(3)').html();
        var num_bien_herramienta = padre.children('td:eq(4)').html();
        var id_usuario_f         = padre.children('td:eq(5)').attr('id');
       // obtener la fila a modificar
        var fila = padre.index();

        $('#guardar').text('Modificar');

        $nombre_herramienta.select2('val', id_items);
        $id_usuario_f.select2('val', id_usuario_f);
        $marca_herramienta.val(marca_herramienta.trim());
        $serial_herramienta.val(serial_herramienta.trim());
        $num_bien_herramienta.val(num_bien_herramienta.trim());
  
        // crear el campo fila y añadir la fila
        var $fila = '<input type="hidden" id="fila"  value="' + fila + '" name="fila">';
        $($fila).prependTo($frmherramienta);

        var $id_herramientas = '<input type="hidden" id="id_herramientas"  value="' + id_herramientas.trim() + '" name="id_herramientas">';
        $($id_herramientas).appendTo($frmherramienta);
    });
    
    $('table#tabla_herramienta').on('click', 'img.eliminar', function() {
        
        $nombre_herramienta.select2('val',0);
        $('input:text').val('');
        $('#guardar').text('Guardar');
        var padre            = $(this).closest('tr');
        var id_herramientas  = padre.children('td:eq(0)').text();
        var nRow             = padre[0];
        window.parent.apprise('<div class="msj-danger">&iquest;Desea Eliminar el Registro?</div>', {'verify': true, 'textYes': 'Aceptar', 'textNo': 'Cancelar'}, function(r) {
            if (r) {
                $.post(url, {id_herramientas: id_herramientas.trim(), accion: 'Eliminar'}, function(data) {
                    var cod_msg = parseInt(data.error_codmensaje);
                    var mensaje = data.error_mensaje;

                    window.parent.apprise(mensaje, {'textOk': 'Aceptar'},function(){
                        if (cod_msg === 23) {
                            THerramientas.fnDeleteRow(nRow);
                        }  
                    });
                    
                }, 'json');
            } else {
                limpiar($formulario);
            }
        });
    });
});


