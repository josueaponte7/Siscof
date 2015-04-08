$(document).ready(function () {

    var TRegistrar = $('#tabla_registrar').dataTable({
        "iDisplayLength": 5,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [5, 10, 20, 30, 40, 50],
        "oLanguage": {"sUrl": "../../librerias/js/es.txt"},
        "order": [[ 1, "asc" ]],
        "aoColumns": [
            {"sClass": "details-control", "sWidth": "2%"},
            {"sClass": "center", "sWidth": "4%"},
            {"sClass": "center", "sWidth": "40%"},
            {"sClass": "center", "sWidth": "15%"},
            {"sClass": "none", "sWidth": "20%"},
            {"sClass": "none", "sWidth": "4%"},
            {"sWidth": "4%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false},
            {"sWidth": "4%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false}
        ]
    });

    var $frmregistrar = $('form#frmregistrar');
    var $codigo = $frmregistrar.find('input:text#codigo_bien');
    var $nombre_bien = $frmregistrar.find('input:text#nombre_bien');
    var $serial_bien = $frmregistrar.find('input:text#serial_bien');
    var $numero_bien = $frmregistrar.find('input:text#numero_bien');
    var $descripcion_bien = $frmregistrar.find('textarea#descripcion_bien');
    var $btn_guardar = $frmregistrar.find('button#guardar');
    var $id = $frmregistrar.find('#id');

    $('table#tabla_registrar').on('mouseenter', 'img.modificar', function () {
        $(this).tooltip('show');
    });

    $('table#tabla_registrar').on('mouseenter', 'img.eliminar', function () {
        $(this).tooltip('show');
    });


    $codigo.codigo({otable:TRegistrar});    
    var url = '../../controlador/mantenimiento/items.php';
    $btn_guardar.on('click', function () {
        $codigo.prop('disabled', false);
        $('input[type=text],textarea').val(function () {
            return this.value.toUpperCase();
        });
        if ($(this).text() == 'Guardar') {
             $.save(url);
        }else{
            $.update(url);
        }
        $codigo.prop('disabled', true);
    });
    
    $('table#tabla_registrar').on('click', 'img.modificar,img.eliminar', function () {
        var aPos = TRegistrar.fnGetPosition(this.parentNode.parentNode);
        var clase = $(this).attr('class');
        $(this).tablaimage(aPos,clase);
    });
    
    
    $('#limpiar').click(function () {
        $('input[type="text"],textarea').val('');
        $codigo.codigo({otable:TRegistrar}); 
        $('#fila').val('');
        $('div').removeClass('has-error');
        $btn_guardar.text('Guardar');
        TRegistrar.fnPageChange(0);
        TRegistrar.fnResetAllFilters();
    });

    $.fn.tablaimage = function (fila,clase) {
        
        var nNodes = TRegistrar.fnGetNodes();
        var oData  = TRegistrar.fnGetData(fila);
        var id     = nNodes[fila]['id'];
        if(clase == 'modificar'){
            $id.val(id)
            $codigo.val(oData[1].trim());
            $nombre_bien.val(oData[2].trim());
            $serial_bien.val(oData[3].trim());
            $numero_bien.val(oData[4].trim());
            $descripcion_bien.val(oData[5].trim());
            $('#guardar').text('Modificar');
        }else{
            window.parent.apprise('<span style="color:#FF0000;font-weight:bold;text-align: center;display:block">&iquest;Desea Eliminar el registro?</span>', {'verify': true, 'textYes': 'Aceptar', 'textNo': 'Cancelar'}, function (r) {
                if (r) {
                    $.borrar(url, id, fila);
                }
            });
        }
    };
    
    $.extend({
        save: function (url) {
            var img_mod = ' <img class="modificar"  title="Modificar" style="cursor: pointer" src="../../imagenes/datatable/modificar.png " width="18" height="18" alt="Modificar"/>';
            var img_del = ' <img class="eliminar"  title="Eliminar" style="cursor: pointer" src="../../imagenes/datatable/eliminar.png " width="18" height="18" alt="Modificar"/>'
            var data_send = $frmregistrar.serialize() + '&' + $.param({accion: 'save'});
            $.post(url, data_send, function (respuesta) {
                if (respuesta.success === 'exitoso') {
                    window.parent.apprise('<span style="color:#059102;font-weight:bold;display:block">' + respuesta.msg + '</span>', {'textOk': 'Aceptar'}, function () {
                        var nuevaFila = TRegistrar.fnAddData(['', $codigo.val().trim(), $nombre_bien.val().trim(), $serial_bien.val().trim(), $numero_bien.val().trim(), $descripcion_bien.val().trim(), img_mod, img_del]);
                        var id        = respuesta.id;
                        var oSettings = TRegistrar.fnSettings();
                        var nTr       = oSettings.aoData[ nuevaFila[0] ].nTr;
  
                        nTr.setAttribute('id', id);
                        id = parseInt(id) + 1;
                        $('#limpiar').trigger('click');
                    });
                }
            }, 'json');
        },
        update: function (url) {
            var data_send = $frmregistrar.serialize() + '&' + $.param({accion: 'update'});
            $.post(url, data_send, function (respuesta) {
                if (respuesta.success === 'exitoso') {
                    window.parent.apprise('<span style="color:#059102;font-weight:bold;display:block">' + respuesta.msg + '</span>', {'textOk': 'Aceptar'}, function () {
                        var fila = $('#fila').val();
                        TRegistrar.fnUpdate($nombre_bien.val().trim(), parseInt(fila), 2);
                        TRegistrar.fnUpdate($numero_bien.val().trim(), parseInt(fila), 3);
                        TRegistrar.fnUpdate($numero_bien.val().trim(), parseInt(fila), 4);
                        TRegistrar.fnUpdate($descripcion_bien.val().trim(), parseInt(fila), 5);
                        $('#limpiar').trigger('click');
                    });
                }
            }, 'json');
        },
        borrar: function (url, id, fila) {
            $.post(url, {id: id, 'accion': 'delete'}, function (repuesta) {
                 if (repuesta.success === 'exitoso') {
                    window.parent.apprise('<span style="color:#059102;font-weight:bold">' + repuesta.msg + '</span>', {'textOk': 'Aceptar'}, function () {
                        TRegistrar.fnDeleteRow(fila);
                        $('#limpiar').trigger('click');
                    });
                }
            },'json');
        }
    });
});

$.fn.extend({
    codigo: function (options) {
        var defaults = {
            cod: 1,
            max: 3,
            otable:''
        };

        var settings = $.extend( defaults, options);
        var ids = settings.cod;
        var str = '' + settings.cod;
        if (settings.otable != '') {
            var TotalRow = settings.otable.fnGetData().length;
            if (TotalRow > 0) {
                var nNodes    = settings.otable.fnGetNodes();
                var ultimo_id = nNodes[TotalRow - 1]['id'];
                var id        = parseInt(ultimo_id) + 1;
                var str       = ''+id;
                var ids       = id;
            }
        }
        
        while (str.length < settings.max) {
            str = '0' + str;
        }

        $('#id').val(ids);
        this.each(function(){
            $(this).val(str);
        });
        return this;
    }
});

/*$.fn.extend({
    codigo: function (options) {
        var defaults = {
            cod: '001',
            id: 1
        };
        var settings = $.extend(defaults, options);
        $('#codigo_bien').pad({str:settings.cod});
        $('#id').val(settings.id);
    }
});*/