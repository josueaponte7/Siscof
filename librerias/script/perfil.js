$.fn.extend({
    pirmer_mayuscula: function (options) {
        this.each(function () {
            $(this).val($(this).val().charAt(0).toUpperCase() + $(this).val().slice(1))
        });
        return this;
    }
});


$(document).ready(function() {

    var TPerfil = $('#tabla_perfil').dataTable({
        "iDisplayLength": 5,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [5, 10, 20, 30, 40, 50],
        "oLanguage": {"sUrl": "../../librerias/js/es.txt"},
        "aoColumns": [
            {"sClass": "agregar center", "sWidth": "10%"},
            {"sClass": "center"},
            {"sWidth": "3%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false}
        ]
    });

    var $frmperfil    = $('#frmperfil');
    var $perfil       = $frmperfil.find($('input:text#perfil'));
    var $btnaccion    = $frmperfil.find($('input:button#btnaccion'));
    var $btnlimpiar   = $frmperfil.find($('input:button#btnlimpiar'));
    var $btnlistar    = $frmperfil.find($('input:button#btnlistar'));
    var $tabla_perfil = $('#tabla_perfil');

    $('#img_perfil').tooltip({
        html: true,
        placement: 'right',
        title: '<span class="requerido">Requerido</span><br/>El Perfil no debe estar en <span class="alerta">blanco</span>'
    });

    var letra = ' abcdefghijklmnñopqrstuvwxyzáéíóú';

    $perfil.validar(letra);

    var urlperfil = '../../controlador/seguridad/perfil.php';

    // Aciones Agregar/Modificar
    $btnaccion.on('click', function() {

        if ($perfil.val() === null || $perfil.val().length === 0 || /^\s+$/.test($perfil.val())) {
            $perfil.parent('div').addClass('has-error');
            $perfil.focus();
        } else {
            if ($(this).val() === 'Guardar') {

                var accion = '<img class="modificar" title="Modificar" style="cursor: pointer" src="../../imagenes/datatable/modificar.png" width="18" height="18" alt="Modificar"/>';
                accion += '&nbsp;&nbsp;<img class="eliminar"  title="Eliminar"  style="cursor: pointer" src="../../imagenes/datatable/eliminar.png"  width="18" height="18" alt="Eliminar" />';
                
                var id = 1;
                var TotalRow = TPerfil.fnGetData().length;
                if(TotalRow > 0){
                    var nNodes = TPerfil.fnGetNodes();
                    var ultimo_id = nNodes[TotalRow - 1]['id'];
                    id = parseInt(ultimo_id) + 1;
                }
                $perfil.val($perfil.val().charAt(0).toUpperCase() + $perfil.val().slice(1));
                var data_send     = $frmperfil.serialize() + '&' + $.param({id:id,accion: 'save'});
                $.post(urlperfil, data_send, function(response) {
                    var mensaje = response.msg;
                    if (response.existe === 'ok') {
                        window.parent.apprise(mensaje, {'textOk': 'Aceptar'}, function () {
                            $perfil.parent('div').addClass('has-error');
                            $perfil.focus().select();
                        });
                    } else if (response.success === 'exitoso') {

                        window.parent.apprise('<span style="color:#059102;font-weight:bold;display:block">' + mensaje + '</span>', {'textOk': 'Aceptar'}, function () {
                            var nuevaFila = TPerfil.fnAddData([response.id, $perfil.val(), accion]);
                            var oSettings = TPerfil.fnSettings();
                            var nTr = oSettings.aoData[ nuevaFila[0] ].nTr;
                            nTr.setAttribute('id', response.id);
                            $perfil.val('')
                        });
                    }
                }, 'json');

            } else {
                window.parent.apprise('<div class="msj-danger">&iquest;Desea Modificar el Registro?</div>', {'verify': true, 'textYes': 'Aceptar', 'textNo': 'Cancelar'}, function(r) {
                    if (r) {
                        var id = $('#id').val();
                        $perfil.val($perfil.val().charAt(0).toUpperCase() + $perfil.val().slice(1));
                        var data_send = $frmperfil.serialize() + '&' + $.param({id: id, accion: 'update'});
                        $.post(urlperfil, data_send, function (respuesta) {
                            if (respuesta.success === 'exitoso') {
                                window.parent.apprise('<span style="color:#059102;font-weight:bold;display:block">' + respuesta.msg + '</span>', {'textOk': 'Aceptar'}, function () {
                                    var fila = $('#fila').val();
                                    TPerfil.fnUpdate($perfil.val(), parseInt(fila), 1);
                                    $perfil.val('')
                                    $('#fila,#id').remove();
                                });
                                $('#id').remove();
                            }
                        }, 'json');
                    }
                });

            }
        }
    });
    // fin btn accion

    // Click en la imagen modificar
    $tabla_perfil.on('click', 'img.modificar', function() {
        $('span.error_val').fadeOut();
        $('#fila,#id').remove();

        var padre = this.parentNode.parentNode
        var aPos   = TPerfil.fnGetPosition(padre);
        
        var nNodes = TPerfil.fnGetNodes();
        var oData  = TPerfil.fnGetData(aPos);
        var id     = nNodes[aPos]['id'];

        
        var $fila = '<input id="fila" type="hidden" value="'+aPos+'" name="fila">';
            var $id = '<input id="id" type="hidden" value="' + id + '" name="id">';
            $('#tabla_perfil').append($fila);
            $('#tabla_perfil').append($id);

        $($fila).prependTo($btnaccion);
        $perfil.val(oData[1]);
        $btnaccion.val('Modificar');
    });
    // Fin


    $tabla_perfil.on('click', 'img.eliminar', function() {
        $('input[type="text"]').val('');
        $btnaccion.val('Guardar');
        var padre = this.parentNode.parentNode
        window.parent.apprise('<span style="color:#FF0000;font-weight:bold;text-align: center;display:block">&iquest;Desea Eliminar el registro?</span>', {'verify': true, 'textYes': 'Aceptar', 'textNo': 'Cancelar'}, function (r) {
            if (r) {
                
                
                var aPos   = TPerfil.fnGetPosition(padre);
                var nNodes = TPerfil.fnGetNodes();
                var id     = nNodes[aPos]['id'];
                
                $.post(urlperfil, {id: id, accion: 'delete'}, function (response) {
                    if (response.success === 'exitoso') {
                        window.parent.apprise('<span style="color:#059102;font-weight:bold">' + response.msg + '</span>', {'textOk': 'Aceptar'}, function () {
                            TPerfil.fnDeleteRow(aPos);
                        });
                    }
                }, 'json');
            } else {
            }
        });

    });

    // Click en la imagen las primeras columnas
    $tabla_perfil.find('tr').on('click', 'td:lt(2)', function() {

        $('#id').remove();
        var padre = this.parentNode
        var aPos   = TPerfil.fnGetPosition(padre);
        var oData  = TPerfil.fnGetData(aPos);
        var nNodes = TPerfil.fnGetNodes();
        var id     = nNodes[aPos]['id'];
        var perfil      = oData[1];
        var $id = ' <input type="hidden" id="id" name="id" value="' + id + '" />';
        $($id).prependTo($btnaccion);

        $btnlistar.css("display",'inline');
        $perfil.attr('disabled', 'disabled').val(perfil);
        $btnaccion.attr('disabled', 'disabled').val('Guardar');
        $btnlimpiar.val('Restablecer');

        var mod = '../../imagenes/datatable/modificar.png';
        var eli = '../../imagenes/datatable/eliminar.png';

        var mod_dis = '../../imagenes/datatable/modificar_disabled.png';
        var eli_dis = '../../imagenes/datatable/eliminar_disabled.png';

//        $('table#tabla_perfil tbody tr td img.modificar_disabled').attr({'src': mod, 'title': 'Modificar'}).css({'cursor': 'pointer'}).addClass('modificar');
//        $('table#tabla_perfil tbody tr td img.eliminar_disabled').attr({'src': eli, 'title': 'Eliminar'}).css({'cursor': 'pointer'}).addClass('eliminar');
//        padre.children('td:eq(2)').find('img.modificar').attr({'src':mod_dis}).removeAttr('class style title').addClass('modificar_disabled');
//        padre.children('td:eq(2)').find('img.eliminar').attr({'src':eli_dis}).removeAttr('class style title').addClass('eliminar_disabled');

    });

    $btnlimpiar.click(function() {
        limpia_perfil();
    });

    $btnlimpiar.on('click', function() {

        if ($(this).val() == 'Restablecer') {

            $(this).val('Limpiar');

            var mod = '../../imagenes/datatable/modificar.png';
            var eli = '../../imagenes/datatable/eliminar.png';

            $('img.modificar_disabled').attr({'src': mod, 'title': 'Modificar'}).css({'cursor': 'pointer'}).addClass('modificar');
            $('img.eliminar_disabled').attr({'src': eli, 'title': 'Eliminar'}).css({'cursor': 'pointer'}).addClass('eliminar');
        }
    });

    var $frmfrmprivilegio = $('#frmprivilegio');
    var $nom_perfil       = $frmfrmprivilegio.find('span#nom_perfil');
    var $modulo           = $frmfrmprivilegio.find('select#modulo');
    var $sub_modulo       = $frmfrmprivilegio.find('select#sub_modulo');
    var $btnaccpriv       = $frmfrmprivilegio.find($('input:button#btnaccpriv'));
    var $btnlimpriv       = $frmfrmprivilegio.find($('input:button#btnlimpriv'));
    var $btnrestablecer   = $frmfrmprivilegio.find($('input:button#btnrestablecer'));

    var $tabla_privilegios = $('#tabla_privilegios');

    $modulo.select2();
    $sub_modulo.select2();

    var TPrivilegios = $('table#tabla_privilegios').dataTable({
        "iDisplayLength": 5,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [5, 10, 20, 30, 40, 50],
        "oLanguage": {"sUrl": "../../librerias/js/es.txt"},
        "aoColumns": [
            {"sWidth": "15%","sClass": "center"},
            {"sWidth": "30%","sClass": "center"},
            {"sWidth": "3%","bSortable": false, "sClass": "center sorting_false", "bSearchable": false},
            {"sWidth": "3%","bSortable": false, "sClass": "center sorting_false", "bSearchable": false},
            {"sWidth": "3%","bSortable": false, "sClass": "center sorting_false", "bSearchable": false},
            {"sWidth": "3%","bSortable": false, "sClass": "center sorting_false", "bSearchable": false},
            {"sWidth": "3%","bSortable": false, "sClass": "center sorting_false", "bSearchable": false},
            {"sWidth": "3%","bSortable": false, "sClass": "center sorting_false", "bSearchable": false}
        ]
    });


    $btnlistar.on('click', function() {
        var id = $('#id').val();
        
        $('div#divperfil').slideUp(3000);
        $('div#privilegios').slideDown(3000).css('display', 'block');
        $('table#tabla_privilegios.dataTable tr th:eq(0)').css('width','30% !important');
        $('table#tabla_privilegios.dataTable tr th:eq(1)').css('width','70% !important');
        

        $nom_perfil.text($perfil.val());
        
        var nodos = TPrivilegios.fnGetNodes();
        
        $("#tabla_privilegios input:checkbox",nodos).prop('disabled', true);
        
        $("#tabla_privilegios input:checkbox",nodos).prop('checked', false);

        $.post(urlperfil, {id: id, accion: 'BuscarPrivilegios'}, function(response) {
             $.each(response, function (i, item) {
                var id = parseInt(item.submodulo_id);
                $('#ac_' + id, nodos).prop('disabled', false);
                $('#ac_' + id, nodos).prop("checked", true);
                
                
                $('#add_' + id, nodos).prop('disabled', 0);
                $('#up_' + id, nodos).prop('disabled', 0);
                $('#del_' + id, nodos).prop('disabled', 0);
                $('#con_' + id, nodos).prop('disabled', 0);
                $('#imp_' + id, nodos).prop('disabled', 0);

                $('#add_' + id, nodos).prop("checked", 0);
                $('#up_' + id, nodos).prop('checked', 0);
                $('#del_' + id, nodos).prop('checked', 0);
                $('#con_' + id, nodos).prop('checked', 0);
                $('#imp_' + id, nodos).prop('checked', 0);
                
                if(item.agregar == 1){
                    $('#add_'+id,nodos).prop( "checked", item.agregar);
                }
                if(item.modificar == 1){
                    $('#up_'+id,nodos).prop( "checked", item.modificar);
                }
                if(item.eliminar == 1){
                    $('#del_'+id,nodos).prop( "checked", item.eliminar);
                }
                if(item.consultar == 1){
                    $('#con_'+id,nodos).prop( "checked", item.consultar);
                }
                if(item.imprimir == 1){
                    $('#imp_'+id,nodos).prop( "checked", item.imprimir);
                }
             });
        },'json');
    });


    $modulo.on('change', function() {

        var codigo = $(this).val();
        if (codigo > 0) {
            $sub_modulo.find('option:gt(0)').remove().end();
            $.post(urlperfil, {codigo: codigo, accion: 'BuscarSub'}, function(data) {
                var option = "";
                if (data != 0) {
                    $.each(data, function(i, obj) {
                        option += "<option value=" + obj.codigo + ">" + obj.descripcion + "</option>";
                    });
                    $sub_modulo.append(option);
                } else {
                    $sub_modulo.find('option:gt(0)').remove().end();
                }
            }, 'json');

        } else {
            $sub_modulo.find('option:gt(0)').remove().end();
        }
    });



    $('input:checkbox').change(function() {
        
        var padre = $(this).closest('tr');
        var clase = $(this).attr('class');
        var nodos = TPrivilegios.fnGetNodes();
        var padr = padre.find("td:gt(2)",nodos);
         
        if ($(this).is(':checked') == true) {
            if (clase == 'activar') {
                padr.find('input:checkbox').prop('disabled',false);
            }
        } else {
            if (clase == 'activar') {
                padr.find('input:checkbox').prop('disabled',true);
                padr.find('input:checkbox').prop('checked',false);
            }
        }
    });


    $btnaccpriv.click(function() {
        
        $('#activados').remove();
        var cod_perfil = $('#id').val();

        var $accion = '<input type="hidden" id="accion"  value="AgregarPrivilegios" name="accion">';
        var $cod_perfil = '<input type="hidden" id="cod_perfil"  value="' + cod_perfil + '" name="cod_perfil">';


        $($accion).prependTo($(this));
        $($cod_perfil).prependTo($(this));

        /*****************************************/

        var priv_activar = '';
        var nodos = TPrivilegios.fnGetNodes();
        var count = $("input:checkbox[name='activar[]']:checked", nodos).length;

        var rowactivar = $("input:checkbox[name='activar[]']:checked", nodos);
        if (count > 0) {
            rowactivar.each(function() {
                /*var checkbox_value = $(elem).val();
                 priv_activar.push(checkbox_value);*/
                var $chkbox    = $(this);
                var $actualrow = $chkbox.closest('tr');
                var $clonedRow = $actualrow.find('td');
                var insertar   = $clonedRow.find("input:checkbox[name='agregar[]']:checked", nodos).val();
                var modificar  = $clonedRow.find("input:checkbox[name='modificar[]']:checked", nodos).val();
                var eliminar   = $clonedRow.find("input:checkbox[name='eliminar[]']:checked", nodos).val();
                var consultar  = $clonedRow.find("input:checkbox[name='consultar[]']:checked", nodos).val();
                var imprimir   = $clonedRow.find("input:checkbox[name='imprimir[]']:checked", nodos).val();
                if (insertar == undefined) {
                    insertar = 0;
                }
                if (modificar == undefined) {
                    modificar = 0;
                }
                if (eliminar == undefined) {
                    eliminar = 0;
                }
                if (consultar == undefined) {
                    consultar = 0;
                }
                if (imprimir == undefined) {
                    imprimir = 0;
                }
                priv_activar += $chkbox.val() + ';' + insertar + ';' + modificar + ';' + eliminar + ';' + consultar + ';' + imprimir + ',';

            });
            priv_activar = priv_activar.substring(0, priv_activar.length - 1);
        }
        /*****************************************/

         var $activados = '<input type="hidden" id="activados"  value="' + priv_activar + '" name="activados">';
         $($activados).appendTo($(this));

        $.post(urlperfil, $frmfrmprivilegio.serialize(), function(data) {
            var cod_msg = parseInt(data.error_codmensaje);
            var mensaje = data.error_mensaje;
            if(cod_msg == 21){
                window.parent.apprise('<span style="color:#059102;font-weight:bold;display:block">' + mensaje+ '</span>', {'textOk': 'Aceptar'}, function() {
                    $("div.btn-group > label", nodos).removeClass('btn-success active');
                    $("div.btn-group > label", nodos).addClass('btn-primary');
                    $('div.btn-group > label > span', nodos).text('NO');
                    $("div.btn-group > label:not([id^='lbl_ac'])", nodos).addClass('btn-primary disabled');
                    $('#activados').remove();
                    priv_activar = '';
                    $('#activados').remove();
                    window.parent.apprise('<span style="color:#FF0000;fotn-wight:bold">La Aplicaci&oacute;n se va refrescar para realizar los cambios</span>', {'textOk': 'Aceptar'}, function() {
                        setTimeout(function(){window.parent.location.reload()},1000);
                    });
                   
                });
                
            }
        }, 'json');
    });

    $tabla_privilegios.on('click', 'img.modificar', function() {

        //$('span.error_val').fadeOut();
        $('#accion').remove();

        var $padre = $(this).parents('tr');
        var fila = $padre.index();
        var perfil = $padre.children('td:eq(0)').text();
        var modulo = $padre.children('td:eq(1)').text();
        var sub_modulo = $padre.children('td:eq(2)').text();
        var cod_sub = $padre.children('td:eq(3)').attr('id');
        /*var $cod  = ' <input type="hidden" id="cod" name="cod" value="' + cod + '" />';
         var $fila = '<input type="hidden" id="fila"  value="' + fila + '" name="fila">';
         $($fila).prependTo($btnaccion);
         $($cod).prependTo($btnaccion);
         $perfil.val(perfil);
         $btnaccion.val('Modificar');*/
    });

    $btnlimpriv.click(function() {
        limpiar_privilegio();

    });
    
    $btnrestablecer.click(function() {
        var nodos = TPrivilegios.fnGetNodes();
        $('div#divperfil').slideDown(3000);
        $('div#privilegios').slideUp(3000);
        $('#activados').remove();
        $('#cod_perfil').val('');
        $("div.btn-group > label", nodos).removeClass('btn-success active disabled');
        $("div.btn-group > label", nodos).addClass('btn-primary');
        $('div.btn-group > label > span', nodos).text('NO');
        $("div.btn-group > label:not([id^='lbl_ac'])", nodos).addClass('btn-primary disabled');
    });
});

function limpia_perfil() {
    $('#accion').remove();
    $('#fila').remove();
    $('#hperfil').remove();
    $('input:text#perfil').val('').prop('disabled', false);
    $('input:button#btnaccion').val('Agregar').prop('disabled', false);
    $('input:button#btnlimpiar').val('Limpiar');
    $('input:button#btnlistar').prop('disabled', true);
    var mod = '../../imagenes/datatable/modificar.png';
    var eli = '../../imagenes/datatable/eliminar.png';
    $('img.modificar_disabled').attr({'src': mod, 'title': 'Modificar'}).css({'cursor': 'pointer'}).addClass('modificar');
    $('img.eliminar_disabled').attr({'src': eli, 'title': 'Eliminar'}).css({'cursor': 'pointer'}).addClass('eliminar');
}
function limpiar_privilegio() {
    $('select#modulo').select2('val', 0);
    $('select#sub_modulo').select2('val', 0);
    $('select#sub_modulo').find('option:gt(0)').remove().end();
    $('input:button#btnaccpriv').val('Agregar');
    $("input:checkbox").parent('div').removeClass('red');
    $("input:checkbox + a").removeClass('checked');
}