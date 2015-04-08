$(document).ready(function () {
    var TUsuariof = $('#tabla_usuariof').dataTable({
        "iDisplayLength": 5,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [5, 10, 20, 30, 40, 50],
        "oLanguage": {"sUrl": "../../librerias/js/es.txt"},
        "aoColumns": [
            {"sClass": "details-control", "sWidth": "2%"},
            {"sClass": "center", "sWidth": "2%"},
            {"sClass": "center", "sWidth": "20%"},
            {"sClass": "center", "sWidth": "25%"},
            {"sClass": "center", "sWidth": "25%"},
            {"sClass": "center", "sWidth": "30%"},
            {"sClass": "none", "sWidth": "20%"},
            {"sClass": "center", "sWidth": "25%"},
            {"sWidth": "8%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false},
            {"sWidth": "8%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false}
        ]
    });   
    
    var $frmusuarioF     = $('form#frmusuarioF');
    var $id_usuario_f    = $frmusuarioF.find('input:text#id_usuario_f');
    var $usuario         = $frmusuarioF.find('input:text#usuario');
    var $nombre          = $frmusuarioF.find('input:text#nombre');
    var $apellido        = $frmusuarioF.find('input:text#apellido');
    var $clave           = $frmusuarioF.find('input:text#clave');
    var $perfil          = $frmusuarioF.find('select#perfil_id');
    var $id_departamento = $frmusuarioF.find('select#departamento_id');
    var $estatus         = $frmusuarioF.find('select#estatus');    
    var $guardar         = $frmusuarioF.find('button#guardar');    
    
    $id_usuario_f.codigo({otable: TUsuariof,col:1});
    
    $perfil.select2();
    $id_departamento.select2();

    
    var vali_cod  = '1234567890';
    var val_letra = ' abcdefghijklmnopqrstuvwxyzáéíóúñ' + vali_cod;
    var letras    = ' abcdefghijklmnopqrstuvwxyzáéíóúñ';
    
    $usuario.validar(letras);
    $nombre.validar(letras);
    $apellido.validar(letras);
    
    $('input:radio[name="activo"]').change(function () {
        var $este  = $(this);
        var valor  = $este.val();
        var $padre = $este.closest('div');
        $padre.find('label').removeClass('btn-success btn-danger').addClass('btn-default');
        if (valor == 1) {
            $este.parent('label').removeClass('btn-default').addClass('btn-success');
        } else if (valor == 0) {
            $este.parent('label').removeClass('btn-default').addClass('btn-danger');
        }
    });
    
    
    var url = '../../controlador/mantenimiento/usuarioF.php';
    $guardar.click(function(){
        
        $id_usuario_f.prop('disabled', false);
        if ($(this).text() == 'Guardar') {
            $.save(url);            
        }else{
            $.update(url)
        }
        
    });
    
    $('.tablas').on('click', 'img.modificar,img.eliminar', function () {
        $(this).tooltip('hide');
        var aPos  = TUsuariof.fnGetPosition(this.parentNode.parentNode);
        var clase = $(this).attr('class');
        $(this).tablaimage(aPos,clase);
    });
    
    $('#limpiar').on('click', function () {
       
        $('input[type="text"],input[type="password"]').val('');
        $('select').select2('val',0);
        $id_usuario_f.codigo({otable:TUsuariof,col:1}); 
        $('#fila').val('');
        $('div').removeClass('has-error');
        $usuario.prop('disabled',false);
        $guardar.text('Guardar');
        TUsuariof.fnPageChange(0);
        TUsuariof.fnResetAllFilters();
    });
    
    
    $.fn.tablaimage = function (fila, clase) {
        
        var data = TUsuariof.fnGetData(fila);
        var nNodes = TUsuariof.fnGetNodes();
        var id     = nNodes[fila]['id'];
        
        var este = $(this);
        
        var departamento_id = este.closest('tr').find('td').eq(0).attr('id');
        var perfil_id       = este.closest('tr').find('td').eq(5).attr('id');

        if (clase == 'modificar') {
            $('#guardar').text('Modificar');
            $('#fila').val(fila);
            
            $id_usuario_f.val(data[1].trim());
            $usuario.val(data[2].trim()).prop('disabled',true);
            $nombre.val(data[3].trim()).prop('disabled',true);
            $apellido.val(data[4].trim()).prop('disabled',true);
            $perfil.select2('val',perfil_id);
            $id_departamento.select2('val',departamento_id);
            var estatus = data[7].trim();

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
            var img_mod       = ' <img class="modificar"  title="Modificar" style="cursor: pointer" src="../../imagenes/datatable/modificar.png " width="18" height="18" alt="Modificar"/>';
            var img_del       = ' <img class="eliminar"  title="Eliminar" style="cursor: pointer" src="../../imagenes/datatable/eliminar.png " width="18" height="18" alt="Modificar"/>'
            var $id           = parseInt($id_usuario_f.val());
            var data_send     = $frmusuarioF.serialize() + '&' + $.param({id: $id, accion: 'save'});
            var perfil        = $perfil.find('option').filter(':selected');
            var departamento  = $id_departamento.find('option').filter(':selected');
            var estatus       = $('input:radio[name="activo"]:checked + span').text();

            $.post(url, data_send, function (respuesta) {
                if (respuesta.success === 'exitoso') {
                    window.parent.apprise('<span style="color:#059102;font-weight:bold;display:block">' + respuesta.msg + '</span>', {'textOk': 'Aceptar'}, function () {
                        var nuevaFila = TUsuariof.fnAddData(['',$id_usuario_f.val(), $usuario.val(),$nombre.val(),$apellido.val(),perfil.text(),departamento.text(),estatus, img_mod, img_del]); 

                        var oSettings = TUsuariof.fnSettings();
                        var nTr       = oSettings.aoData[ nuevaFila[0] ].nTr;
    
                        $('td', nTr)[0].setAttribute('id', $id_departamento.val());
                        $('td', nTr)[5].setAttribute('id', $perfil.val());
                        //$('td', nTr)[6].setAttribute('id', r_estatus);
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
            var $id           = parseInt($id_usuario_f.val());
            var data_send     = $frmusuarioF.serialize() + '&' + $.param({id: $id, accion: 'update'});
            var fila          = $('#fila').val();
            var perfil        = $perfil.find('option').filter(':selected').text();
            var departamento  = $id_departamento.find('option').filter(':selected').text();
            console.log(perfil)
            var estatus       = $('input:radio[name="activo"]:checked + span').text();
            $.post(url, data_send, function (respuesta) {
                if (respuesta.success === 'exitoso') {
                    window.parent.apprise('<span style="color:#059102;font-weight:bold;display:block">' + respuesta.msg + '</span>', {'textOk': 'Aceptar'}, function () {
                        if (respuesta.success === 'exitoso') {
                            TUsuariof.fnUpdate(perfil, parseInt(fila), 5);
                            TUsuariof.fnUpdate(departamento, parseInt(fila), 6);
                            TUsuariof.fnUpdate(estatus, parseInt(fila), 7);
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
        var defaults = {cod: 1,max: 3,otable: '',col:0};
        var settings = $.extend(defaults, options);
        var str      = '' + settings.cod;
        if (settings.otable != '') {
            var TotalRow = settings.otable.fnGetData().length;
            if (TotalRow > 0) {
                var data = settings.otable.fnGetData(parseInt(TotalRow)-1);
                var id   = parseInt(data[settings.col]) + 1;
                var str = '' + id;
            }
        }
        while (str.length < settings.max) { str = '0' + str;}
        this.each(function () {$(this).val(str);});
        return this;
    }
});