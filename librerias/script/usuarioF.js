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
        
    var url = '../../controlador/mantenimiento/usuarioF.php';
    $guardar.click(function(){
        
        $id_usuario_f.prop('disabled', false);
        if ($(this).text() == 'Guardar') {
            $.save(url);            
        }
        /*$.post(url, $frmusuarioF.serialize(), function(respuesta) {
            var cod_msg = parseInt(respuesta.error_codmensaje);
            var mensaje = respuesta.error_mensaje;
            
            var estatus      = $estatus.find('option').filter(':selected');
            var tipousuario  = $perfil.find('option').filter(':selected');
            var departamento = $id_departamento.find('option').filter(':selected');
            if (cod_msg == 21) {
                window.parent.apprise(mensaje, {'textOk': 'Aceptar'}, function () {
                    TUsuariof.fnAddData([$usuario.val(),$nombre.val(),$apellido.val(),tipousuario.text(),departamento.text(), estatus.text(), img_mod, img_del]);                    
                    $('input:text,input:password').val('');
                    $tipo_usuario.val(0);
                    $id_departamento.val(0);
                    $estatus.val(2);   
                });
            }else{
                window.parent.apprise(mensaje, {'textOk': 'Aceptar'});
            }
         },'json');*/
    });
    
    $.extend({
        save: function (url) {
            var nombreAnimate = 'animated shake';
            var finanimated   = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
            var img           = ' <img class="modificar"  title="Modificar" style="cursor: pointer" src="../../imagenes/datatable/modificar.png " width="18" height="18" alt="Modificar"/>';
            img               += ' <img class="eliminar"  title="Eliminar" style="cursor: pointer" src="../../imagenes/datatable/eliminar.png " width="18" height="18" alt="Modificar"/>'
            var $id           = parseInt($id_usuario_f.val());
            var data_send     = $frmusuarioF.serialize() + '&' + $.param({id: $id, accion: 'save'});
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
    
    /*$('table#tabla_usuariof').on('click', 'img.modificar', function() {
        // borra el campo fila
        $('#fila').remove();
        $('#id_usuariodf').remove();
        var padre = $(this).closest('tr');

        var usuario = padre.children('td:eq(0)').text();
        var nombre = padre.children('td:eq(1)').html();
        var apellido = padre.children('td:eq(2)').text();
        var id_usuario = padre.children('td:eq(3)').attr('id');
        var id_departamento = padre.children('td:eq(4)').attr('id');
        var estatus = padre.children('td:eq(5)').attr('id');
        // obtener la fila a modificar
        var fila = padre.index();
        var id_estatus = 0;
        if(estatus == 'Activo'){
            id_estatus = 1;
        }
        $('#guardar').text('Modificar');
        $('#usuario').val(usuario.trim());
        $('#nombre').val(nombre.trim());
        $('#apellido').val(apellido.trim());
        $('#tipo_usuario').select2('val', id_usuario);
        $('#id_departamento').select2('val', id_departamento);
        $('#estatus').select2('val', id_estatus);
    });*/
    
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