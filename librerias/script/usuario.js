$(document).ready(function () {
    var TUsuario = $('#tabla_usuarios').dataTable({
        "iDisplayLength": 5,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [5, 10, 20, 30, 40, 50],
        "oLanguage": {"sUrl": "../../librerias/js/es.txt"},
        "aoColumns": [
            {"sClass": "center", "sWidth": "5%"},
            {"sClass": "center", "sWidth": "20%"},
            {"sClass": "center", "sWidth": "20%"},
            {"sClass": "center", "sWidth": "20%"},
            {"sClass": "center", "sWidth": "20%"},
            {"sWidth": "5%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false}
        ]
    });
    var $frmusuario = $('form#frmusuario');
    var $id_usuario = $frmusuario.find('input:text#id_usuario');
    var $usuario    = $frmusuario.find('input:text#usuario');
    var $clave      = $frmusuario.find('input:password#clave');
    var $repclave   = $frmusuario.find('input:password#repclave');
    var $perfil     = $frmusuario.find('select#perfil_id');
    var $btnaccion  = $frmusuario.find('button:button#guardar');
    var $btnlimpiar = $frmusuario.find('button:button#limpiar');

    $id_usuario.codigo({otable: TUsuario});

    $('input:radio[name="activo"]').change(function () {
        var $este = $(this);
        var valor = $este.val();
        var $padre = $este.closest('div');
        $padre.find('label').removeClass('btn-success btn-danger').addClass('btn-default');
        if (valor == 1) {
            $este.parent('label').removeClass('btn-default').addClass('btn-success');
        } else if (valor == 0) {
            $este.parent('label').removeClass('btn-default').addClass('btn-danger');
        }
    });

    $perfil.select2({
        formatNoMatches: function () {
            return "No se encontraron Resultados";
        }
    });

    var url = '../../controlador/seguridad/usuario.php';
    $btnaccion.on('click', function () {
        
        $id_usuario.prop('disabled', false);
        if ($(this).text() == 'Guardar') {
            $.save(url);
        }else{
            window.parent.apprise('<span style="color:#FF0000;font-weight:bold;display:block">&iquest;Desea Modificar los datos del registro?</span>', {'verify': true, 'textYes': 'Aceptar', 'textNo': 'Cancelar'}, function (r) {
                if (r) {
                    $.update(url);
                }
            })
        }
        $id_usuario.prop('disabled', true);
    });
    
    $('.tablas').on('click', 'img.modificar,img.eliminar', function () {
        $(this).tooltip('hide');
        var aPos  = TUsuario.fnGetPosition(this.parentNode.parentNode);
        var clase = $(this).attr('class');
        $(this).tablaimage(aPos,clase);
    });
    
    $('#limpiar').on('click', function () {
       
        $('input[type="text"],input[type="password"]').val('');
        $('select').select2('val',0);
        $id_usuario.codigo({otable:TUsuario}); 
        $('#fila').val('');
        $('div').removeClass('has-error');
        $usuario.prop('disabled',false);
        $btnaccion.text('Guardar');
        TUsuario.fnPageChange(0);
        TUsuario.fnResetAllFilters();
    });
    
    
    $.fn.tablaimage = function (fila, clase) {
        
        var data = TUsuario.fnGetData(fila);
        var este = $(this);
        
        var valor = este.closest('tr').find('td').eq(2).attr('id');
        
        if (clase == 'modificar') {
            $('#guardar').text('Modificar');
            $('#fila').val(fila);
            $id_usuario.val(data[0].trim());
            $usuario.val(data[1].trim()).prop('disabled',true);
            $perfil.select2('val',valor);
            var estatus = data[3].trim();

            var $padre = este.closest('div');
            
            $('input:radio[name="activo"]').prop('checked',true).closest('label').removeClass('btn-success btn-danger active').addClass('btn-default');
    
            if(estatus == 'Inactivo'){
               $('input:radio[name="activo"][value="0"]').prop('checked',true).closest('label').removeClass('btn-default').addClass('btn-danger active');
            }else{
               $('input:radio[name="activo"][value="1"]').prop('checked',true).closest('label').removeClass('btn-default').addClass('btn-success active'); 
            }
            
            $('#guardar').text('Modificar');
        } else {
            $('#limpiar').trigger('click');
            var id   = parseInt(data[0]);
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
            var img           = ' <img class="modificar"  title="Modificar" style="cursor: pointer" src="../../imagenes/datatable/modificar.png " width="18" height="18" alt="Modificar"/>';
            img               += ' <img class="eliminar"  title="Eliminar" style="cursor: pointer" src="../../imagenes/datatable/eliminar.png " width="18" height="18" alt="Modificar"/>'
            var $id           = parseInt($id_usuario.val());
            var data_send     = $frmusuario.serialize() + '&' + $.param({id: $id, accion: 'save'});
            var perfil        = $perfil.find('option').filter(':selected').text();
            var r_estatus     = $('input:radio[name="activo"]:checked').val();
            var estatus       = 'Activo';
            var f             = new Date();
            var dia           = f.getDate();
            var mes           = (f.getMonth() + 1);
            var anio          = f.getFullYear();
            
            if (dia<=9){
                    dia="0"+dia;
                }
                if (mes<=9){
                    mes="0"+mes;
                }
            
            var fecha = dia +'-'+mes+'-'+anio;
            if(r_estatus == 0){
                estatus       = 'Inactivo';
            }
            $.post(url, data_send, function (respuesta) {
                if (respuesta.success === 'exitoso') {
                    window.parent.apprise('<span style="color:#059102;font-weight:bold;display:block">' + respuesta.msg + '</span>', {'textOk': 'Aceptar'}, function () {
                        var nuevaFila = TUsuario.fnAddData([$id_usuario.val(),$usuario.val(), perfil,estatus, fecha,img]);
                        var id        = respuesta.id;
                        var oSettings = TUsuario.fnSettings();
                        var nTr       = oSettings.aoData[ nuevaFila[0] ].nTr;
                        
                        id = parseInt(id) + 1;
                        $('td', nTr)[2].setAttribute('id', id);
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
            var $id           = parseInt($id_usuario.val());
            var data_send     = $frmusuario.serialize() + '&' + $.param({id: $id, accion: 'update'});
            var fila          = $('#fila').val();
            var perfil        = $perfil.find('option').filter(':selected').text();
            var r_estatus     = $('input:radio[name="activo"]:checked').val();
            var estatus       = 'Activo';
            if(r_estatus == 0){
                estatus       = 'Inactivo';
            }
            $.post(url, data_send, function (respuesta) {
                if (respuesta.success === 'exitoso') {
                    window.parent.apprise('<span style="color:#059102;font-weight:bold;display:block">' + respuesta.msg + '</span>', {'textOk': 'Aceptar'}, function () {
                        if (respuesta.success === 'exitoso') {
                            TUsuario.fnUpdate(perfil, parseInt(fila), 2);
                            TUsuario.fnUpdate(estatus, parseInt(fila), 3);
                            $('#limpiar').trigger('click');
                        }
                       
                    });
                }
            }, 'json');
        },
        borrar: function (url, id, fila) {
            $.post(url, {id: id, 'accion': 'delete'}, function (respuesta) {
                if (respuesta.success === 'exitoso') {
                    window.parent.apprise('<span style="color:#059102;font-weight:bold">' + respuesta.msg + '</span>', {'textOk': 'Aceptar'}, function () {
                        TUsuario.fnDeleteRow(fila);
                        $('#limpiar').trigger('click');
                    });
                }
            }, 'json');
        }
    });

});


$.fn.extend({
    codigo: function (options) {
        var defaults = {cod: 1,max: 3,otable: ''};
        var settings = $.extend(defaults, options);
        var str      = '' + settings.cod;
        if (settings.otable != '') {
            var TotalRow = settings.otable.fnGetData().length;
            if (TotalRow > 0) {
                var data = settings.otable.fnGetData(parseInt(TotalRow)-1);
                var id   = parseInt(data[0]) + 1;
                var str = '' + id;
            }
        }
        while (str.length < settings.max) { str = '0' + str;}
        this.each(function () {$(this).val(str);});
        return this;
    }
});
