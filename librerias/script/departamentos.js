
$(document).ready(function () {
    var TDepartamento = $('#tabla_deparmento').dataTable({
        "iDisplayLength": 5,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [5, 10, 20, 30, 40, 50],
        "oLanguage": {"sUrl": "../../librerias/js/es.txt"},
        "aoColumns": [
            {"sClass": "details-control", "sWidth": "2%"},
            {"sClass": "right", "sWidth": "2%"},
            {"sClass": "left", "sWidth": "40%"},
            {"sClass": "none", "sWidth": "50%"},
            {"sWidth": "2%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false},
            {"sWidth": "2%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false}
        ]
    });
    
    
    
    $('table#tabla_deparmento').on('mouseenter', 'img.modificar', function () {
         $(this).tooltip('show');
    });
    
    $('table#tabla_deparmento').on('mouseenter', 'img.eliminar', function () {
         $(this).tooltip('show');
    });
    
    
    /*var nNodes = TDepartamento.fnGetNodes();
     console.log('TotalRow:'+TotalRow)
     console.log('Fila:'+nNodes[TotalRow-1]['id'])*/


    var $frmdepartamento        = $('form#frmdepartamento');
    var $codigo_departamento    = $frmdepartamento.find('input:text#codigo_departamento');
    var $nombre_departamento    = $frmdepartamento.find('input:text#nombre_departamento');
    var $direccion_departamento = $frmdepartamento.find('textarea#direccion_departamento');
    var $btn_guardar            = $frmdepartamento.find('button#guardar');
    var $id                     = $frmdepartamento.find('#id');

    $codigo_departamento.codigo({otable:TDepartamento}); 

    
    var options = {
        'maxCharacterSize': 90,
        'originalStyle': 'originalTextareaInfo',
        'warningStyle': 'warningTextareaInfo',
        'warningNumber': 40,
        'displayFormat': '#input/#max'
    };
    
    $direccion_departamento.textareaCount(options);

    var vali_cod = '1234567890';
    var val_letra = ' abcdefghijklmnopqrstuvwxyzáéíóúñ' + vali_cod;

    $codigo_departamento.validar(vali_cod);
    $nombre_departamento.validar(val_letra);
    $direccion_departamento.validar(val_letra);
    var url = '../../controlador/mantenimiento/departamento.php';
    $btn_guardar.click(function () {

        var nombreAnimate = 'animated shake';
        var finanimated   = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';

        if ($codigo_departamento.val() === null || $codigo_departamento.val().length === 0 || /^\s+$/.test($codigo_departamento.val())) {
            $codigo_departamento.parent('div').addClass('has-error').addClass(nombreAnimate).one(finanimated,
                    function () {
                        $(this).removeClass(nombreAnimate);
                    });
            $codigo_departamento.focus().selected();
        } else if ($nombre_departamento.val() === null || $nombre_departamento.val().length === 0 || /^\s+$/.test($nombre_departamento.val())) {
            $nombre_departamento.parent('div').addClass('has-error').addClass(nombreAnimate).one(finanimated,
                    function () {
                        $(this).removeClass(nombreAnimate);
                    });
            $nombre_departamento.focus();
        } else if ($direccion_departamento.val() === null || $direccion_departamento.val().length === 0 || /^\s+$/.test($direccion_departamento.val())) {
            $direccion_departamento.parent('div').addClass('has-error').addClass(nombreAnimate).one(finanimated,
                    function () {
                        $(this).removeClass(nombreAnimate);
                    });
            $direccion_departamento.focus();
        } else {
            $codigo_departamento.prop('disabled',false);
            if ($(this).text() === 'Guardar') {
                $.save(url);
            } else {
                window.parent.apprise('<span style="color:#FF0000;font-weight:bold;display:block">&iquest;Desea Modificar los datos del registro?</span>', {'verify': true, 'textYes': 'Aceptar', 'textNo': 'Cancelar'}, function (r) {
                    if (r) {
                        $.update(url);
                    }
                });
            }
            $codigo_departamento.prop('disabled',true);
        }
    });

    $('.tablas').on('click', 'img.modificar,img.eliminar', function () {
        $(this).tooltip('hide');
        var aPos  = TDepartamento.fnGetPosition(this.parentNode.parentNode);
        var clase = $(this).attr('class');
        $(this).tablaimage(aPos,clase);
    });
    
    $('#limpiar').on('click', function () {
       
        $('input[type="text"],textarea').val('');
        $codigo_departamento.codigo({otable:TDepartamento}); 
        $('#fila').val('');
        $('div').removeClass('has-error');
        $btn_guardar.text('Guardar');
        TDepartamento.fnPageChange(0);
        TDepartamento.fnResetAllFilters();
    });
    
    
    $.fn.tablaimage = function (fila, clase) {

        var nNodes = TDepartamento.fnGetNodes();
        var oData  = TDepartamento.fnGetData(fila);
        var id     = nNodes[fila]['id'];
        if (clase == 'modificar') {
            $('#guardar').text('Modificar');
            $('#id').val(id);
            $('#fila').val(fila);
            $('#codigo_departamento').val(oData[1].trim());
            $('#nombre_departamento').val(oData[2].trim());
            $('#direccion_departamento').val(oData[3].trim());
            $('#guardar').text('Modificar');
        } else {
            $('#limpiar').trigger('click');
            window.parent.apprise('<span style="color:#FF0000;font-weight:bold;text-align: center;display:block">&iquest;Desea Eliminar el registro?</span>', {'verify': true, 'textYes': 'Aceptar', 'textNo': 'Cancelar'}, function (r) {
                if (r) {
                    $.borrar(url, id, fila);
                }
            });
        }
    };
    
    $.extend({
        save: function (url) {
            var nombreAnimate = 'animated shake';
            var finanimated   = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
            var img_mod       = ' <img class="modificar"  title="Modificar" style="cursor: pointer" src="../../imagenes/datatable/modificar.png " width="18" height="18" alt="Modificar"/>';
            var img_del       = ' <img class="eliminar"  title="Eliminar" style="cursor: pointer" src="../../imagenes/datatable/eliminar.png " width="18" height="18" alt="Modificar"/>'
            var data_send     = $frmdepartamento.serialize() + '&' + $.param({accion: 'save'});
            $.post(url, data_send, function (respuesta) {
                if (respuesta.success === 'exitoso') {
                    window.parent.apprise('<span style="color:#059102;font-weight:bold;display:block">' + respuesta.msg + '</span>', {'textOk': 'Aceptar'}, function () {
                        var nuevaFila = TDepartamento.fnAddData(['', $codigo_departamento.val(), $nombre_departamento.val(), $direccion_departamento.val(), img_mod, img_del]);
                        var id        = respuesta.id;
                        var oSettings = TDepartamento.fnSettings();
                        var nTr       = oSettings.aoData[ nuevaFila[0] ].nTr;

                        nTr.setAttribute('id', id);
                        id = parseInt(id) + 1;
                        $codigo_departamento.codigo({cod:id});
                        
                        $('#limpiar').trigger('click');
                    });
                } else if (respuesta.existe === 'ok') {
                    window.parent.apprise('<span style="color:#FF0000;font-weight:bold;display:block">' + respuesta.msg + '</span>', {'textOk': 'Aceptar'}, function () {
                        $nombre_departamento.parent('div').addClass('has-error').addClass(nombreAnimate).one(finanimated,
                                function () {
                                    $(this).removeClass(nombreAnimate);
                                });
                        $nombre_departamento.focus().select();
                    });
                } else if (respuesta.success === 'error') {
                    window.parent.apprise('<span style="color:#FF0000;font-weight:bold;display:block">' + mensaje + '</span>', {'textOk': 'Aceptar'});
                }
            }, 'json');
        },
        update: function (url) {
            var data_send = $frmdepartamento.serialize() + '&' + $.param({accion: 'update'});
            $.post(url, data_send, function (respuesta) {
                if (respuesta.success === 'exitoso') {
                    window.parent.apprise('<span style="color:#059102;font-weight:bold;display:block">' + respuesta.msg + '</span>', {'textOk': 'Aceptar'}, function () {
                        var fila = $('#fila').val();
                        
                        var nombre_departamento    = $('#nombre_departamento').val().trim();
                        var direccion_departamento = $('#direccion_departamento').val().trim();

                        TDepartamento.fnUpdate(nombre_departamento, parseInt(fila), 2);
                        TDepartamento.fnUpdate(direccion_departamento, parseInt(fila), 3);
                        $('#limpiar').trigger('click');
                    });
                }
            }, 'json');
        },
        borrar: function (url,id,fila) {
            $.post(url, {id: id, 'accion': 'delete'}, function (respuesta) {
                if (respuesta.success === 'exitoso') {
                    window.parent.apprise('<span style="color:#059102;font-weight:bold">' + respuesta.msg + '</span>', {'textOk': 'Aceptar'}, function () {
                        TDepartamento.fnDeleteRow(fila);
                        $codigo_departamento.codigo({cod: id});
                    });
                }
            }, 'json');
        }
    });
    
    
    
});

$.fn.extend({
    codigo: function (options) {
        var defaults = {
            cod: 1,
            max: 3,
            otable: ''
        };

        var settings = $.extend(defaults, options);
        var ids = settings.cod;
        var str = '' + settings.cod;
        if (settings.otable != '') {
            var TotalRow = settings.otable.fnGetData().length;
            if (TotalRow > 0) {
                var nNodes = settings.otable.fnGetNodes();
                var ultimo_id = nNodes[TotalRow - 1]['id'];
                var id = parseInt(ultimo_id) + 1;
                var str = '' + id;
                var ids = id;
            }
        }

        while (str.length < settings.max) {
            str = '0' + str;
        }

        $('#id').val(ids);
        this.each(function () {
            $(this).val(str);
        });
        return this;
    }
});