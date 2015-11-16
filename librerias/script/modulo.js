$.fn.extend({
    ids: function (options) {
        var defaults = {
            otable: ''
        };

        var settings = $.extend(defaults, options);
        var id = 1;
        if (settings.otable != '') {
            var TotalRow = settings.otable.fnGetData().length;
            if (TotalRow > 0) {
                var nNodes = settings.otable.fnGetNodes();
                var ultimo_id = nNodes[TotalRow - 1]['id'];
                id = parseInt(ultimo_id) + 1;
            }
        }
        this.each(function () {
            //var ids_inpu = '<input id="id" type="hidden" value="'+id+'" name="id">';
            //$(this).append(ids_inpu);
            $('#id').val(id)
        });
        return this;
    }
});
$(document).ready(function() {
    
     $('input[type="text"], textarea').on({
        keypress: function() {
            $(this).parent('div').removeClass('has-error');
            $(this).parent('div').find('span').css('display','none');
        }
    });

    var TModulo = $('#tabla_modulo').dataTable({
        "iDisplayLength": 5,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [5, 10, 20, 30, 40, 50],
        "oLanguage": {"sUrl": "../../librerias/js/es.txt"},
        "aoColumns": [
            {"sClass": "registro center", "sWidth": "10%"},
            {"sClass": "registro center", "sWidth": "40%"},
            {"sClass": "registro center", "sWidth": "15%"},
            {"sClass": "registro center", "sWidth": "8%"},
            {"sWidth": "3%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false}
        ]
    });

    var $formulario      = $('form#frmmodulo');
  
    var $modulo          = $formulario.find('input:text#modulo');
    var $div_modposicion = $formulario.find('div#div_modposicion');
    var $mod_posicion    = $formulario.find('input:text#mod_posicion');
    var $btnaccion       = $formulario.find('input:button#btnaccion');
    var $btnlimpiar      = $formulario.find('input:button#btnlimpiar');
    var $btnlistar       = $formulario.find('input:button#btnlistar');
    var $tabla_modulo    = $('#tabla_modulo');
    
     $('#img_modulo').tooltip({
        html: true,
        placement: 'top',
        title: '<span class="requerido">Requerido</span><br/>El Modulo no debe estar en <span class="alerta">blanco</span>'
    });

    $('#img_posicion').tooltip({
        html: true,
        placement: 'top',
        title: '<span class="requerido">Requerido</span><br/>La Posici&oacute;n no debe estar en <span class="alerta">blanco</span> deber ser <span class="alerta">N&uacute;merico</span>'
    });

    $('.modificar').tooltip({
        html: true,
        placement: 'bottom',
        title: 'Modificar'
    });

    $('.eliminar').tooltip({
        html: true,
        placement: 'bottom',
        title: 'Eliminar'
    });
    
    $(".registro").popover({
        trigger: 'hover',
        placement: function (pop, ele) {
            if ($(ele).parent().is('td:last-child')) {
                return 'left';
            } else {
                return 'top';
            }
        }
    });
    
    $.extend({
        save: function (url, formulario,tipo,codigo,otable) {
            var TotalRow = otable.fnGetData().length;
            var id = 1;
            if (TotalRow > 0) {
                var nNodes = otable.fnGetNodes();
                var ultimo_id = nNodes[TotalRow - 1]['id'];
                id = parseInt(ultimo_id) + 1;
            }
            var data_send     = formulario.serialize() + '&' + $.param({id:id,accion: 'save'});
            $.post(url, data_send, function (data) {
                var cod_msg = parseInt(data.cod_msg);
                var mensaje = data.msg;
                var accion = '<img class="modificar" title="Modificar" style="cursor: pointer" src="../../imagenes/datatable/modificar.png" width="18" height="18" alt="Modificar"/>';
                accion += '&nbsp;&nbsp;<img class="eliminar"  title="Eliminar"  style="cursor: pointer" src="../../imagenes/datatable/eliminar.png"  width="18" height="18" alt="Eliminar" />';

                if (data.success === 'exitoso') {
                   
                    window.parent.apprise('<span style="color:#059102;font-weight:bold;display:block">' + mensaje + '</span>', {'textOk': 'Aceptar'}, function () {
                        
                        if (tipo == 'modulo') {
                            var estatus = $("input[name='mod_estatus']:checked")[0].nextSibling.nodeValue;
                            var nuevaFila = otable.fnAddData([codigo, $modulo.val(), $mod_posicion.val(), estatus, accion]);

                            var id = data.id;
                            var oSettings = otable.fnSettings();
                            var nTr = oSettings.aoData[ nuevaFila[0] ].nTr;
                            nTr.setAttribute('id', id);
                            //$('#id').remove();
                            
                            formulario.ids({otable:TModulo}); 
                            
                            var option = "<option value=" + codigo + ">" + $modulo.val() + "</option>";
                            $('select#nommodulo').append(option);

                            $("div").removeClass('has-error');
                            $("div").find('span').css('display', 'none');
                            $('input:radio').attr('checked', false);
                            formulario.find('input:text').val('');
                            $('#l_mod_activo').addClass('btn-success active');
                            $('#l_mod_inactivo').removeClass('btn-danger active').addClass('btn-default');
                            $('input:radio#mod_activo').prop('checked', true);
                        }else{
                            var estatus = $("input[name='sbmod_estatus']:checked")[0].nextSibling.nodeValue;
                            var id = data.id;
                            var modulo_id = $('#modulo_id').find('option').filter(':selected').val();
                            var modulo    = $('#modulo_id').find('option').filter(':selected').text();
                            var nuevaFila = otable.fnAddData(['',id, modulo,$sub_modulo.val(), $sbmposicion.val(), estatus, accion,$ruta.val()]);

                            
                            var oSettings = otable.fnSettings();
                            var nTr = oSettings.aoData[ nuevaFila[0] ].nTr;
                            nTr.setAttribute('id', id);
                            $('td', nTr)[2].setAttribute('id', modulo_id);
                            
                            formulario.find('input:text').val('');
                            formulario.find('input:radio').attr('checked', false);
                            $('#l_sbmod_activo').addClass('btn-success active');
                            $('#l_sbmod_inactivo').removeClass('btn-danger active').addClass('btn-default');
                            $('input:radio#sbmod_activo').prop('checked', true);
                        }
                    });

                } else if (data.existe === 'ok') {
                    window.parent.apprise(mensaje, {'textOk': 'Aceptar'}, function () {
                        $modulo.parent('div').addClass('has-error');
                        $modulo.focus().select();
                    });
                } else if (data.existe_pos === 'ok') {
                    window.parent.apprise(mensaje, {'textOk': 'Aceptar'}, function () {
                        $mod_posicion.parent('div').addClass('has-error');
                        $mod_posicion.focus().select();
                    });

                } else if (cod_msg === 16) {
                    window.parent.apprise(mensaje, {'textOk': 'Aceptar'}, function () {
                        $div_modposicion.addClass('has-error');
                        $mod_posicion.focus().select();
                    });

                }
            }, 'json');
        },
        update: function (url,formulario,tipo,otable) {
            var id = $('#id').val();
            var data_send = formulario.serialize() + '&' + $.param({id :id, accion: 'update'});
            $.post(url, data_send, function (respuesta) {
                if (respuesta.success === 'exitoso') {
                    window.parent.apprise('<span style="color:#059102;font-weight:bold;display:block">' + respuesta.msg + '</span>', {'textOk': 'Aceptar'}, function () {
                        var fila = $('#fila').val();
                        
                        if (tipo == 'modulo') {
                            var estatus = $("input[name='mod_estatus']:checked")[0].nextSibling.nodeValue;
                            
                            var cod_modulo = $('#cod_modulo').val();
                            $("select#nommodulo option[value='" + cod_modulo + "']").text($modulo.val());

                            otable.fnUpdate($modulo.val(), parseInt(fila), 1);
                            otable.fnUpdate($mod_posicion.val(), parseInt(fila), 2);
                            otable.fnUpdate(estatus, parseInt(fila), 3);
                            //$('#limpiar').trigger('click');
                            $("div").removeClass('has-error');
                            $("div").find('span').css('display', 'none');
                            formulario.find('input:radio').attr('checked', false);
                            formulario.find('input:text').val('');
                            $('#l_mod_activo').addClass('btn-success active');
                            $('#l_mod_inactivo').removeClass('btn-danger active').addClass('btn-default');
                            formulario.find('input:radio#sbmod_activo').prop('checked', true);
                            $btnaccion.val('Guardar');
                            formulario.ids({otable:otable}); 
                        }else{
                            
                            var modulo_id = $('#modulo_id').find('option').filter(':selected').val();
                            var nNodes = otable.fnGetNodes();
                            var oData  = otable.fnGetData(fila);
                            var ids = $('#tabla_submodulo tbody tr').eq(fila).find('td').eq(2).attr('id');
                            var estatus = $("input[name='mod_estatus']:checked")[0].nextSibling.nodeValue;
                            if(modulo_id != ids){
                                otable.fnDeleteRow(fila);
                            } else {
                                
                                var estatus = $("input[name='sbmod_estatus']:checked")[0].nextSibling.nodeValue;
                                var modulo    = $('#modulo_id').find('option').filter(':selected').text();
                                
                                otable.fnUpdate(modulo, parseInt(fila), 2);
                                otable.fnUpdate($sub_modulo.val(), parseInt(fila), 3);
                                otable.fnUpdate($sbmposicion.val(), parseInt(fila), 4);
                                otable.fnUpdate(estatus, parseInt(fila), 5);
                                otable.fnUpdate($ruta.val(), parseInt(fila), 7);
                            }
                            
                            
                            
                            formulario.find('input:radio').attr('checked', false);
                            formulario.find('input:text').val('');
                            formulario.find('input:radio').attr('checked', false);
                            $('#l_sbmod_activo').addClass('btn-success active');
                            $('#l_sbmod_inactivo').removeClass('btn-danger active').addClass('btn-default');
                            $('input:radio#sbmod_activo').prop('checked', true);
                            $nommodulo.select2('val',ids);
                            $btnaccionsub.val('Guardar');
                        }
                        
                    });
                    $('#id').remove();
                }
            }, 'json');
        },
        eliminar: function (url,id,fila,formulario,otable,tipo) {
            $.post(url, {id: id, 'accion': 'delete'}, function (respuesta) {
                if (respuesta.success === 'exitoso') {
                    window.parent.apprise('<span style="color:#059102;font-weight:bold">' + respuesta.msg + '</span>', {'textOk': 'Aceptar'}, function () {
                        otable.fnDeleteRow(fila);
                        formulario.ids({otable:otable}); 
                    });
                }
            }, 'json');
        }
    });
   
    
    $.fn.tablaimage = function (tabla,fila, clase,otable,tipo) {
        
        var nNodes = otable.fnGetNodes();
        var oData  = otable.fnGetData(fila);
        var id     = nNodes[fila]['id'];
        if (clase == 'modificar') {
            
            var $fila = '<input id="fila" type="hidden" value="'+fila+'" name="fila">';
            var $id = '<input id="id" type="hidden" value="' + id + '" name="id">';
            $('#' + tabla).append($fila);
            $('#' + tabla).append($id);
            
            if(tipo == 'modulo'){
                $btnaccion.val('Modificar');
                var modulo   = oData[1];
                var posicion = oData[2];
                var estatus  = oData[3];
              
                $('#modulo').val(modulo.trim());
                $('#mod_posicion').val(posicion.trim());
                $('input:radio').attr('checked', false);
                $('#id').val(id);
                if (estatus.trim() == 'Inactivo') {
                    $('input:radio#mod_inactivo').prop('checked', true);
                    $('#l_mod_activo').removeClass('btn-success active').addClass('btn-default');
                    $('#l_mod_inactivo').addClass('btn-danger active');
                } else {
                    $('input:radio#mod_activo').prop('checked', true);
                    $('#l_mod_activo').addClass('btn-success active');
                    $('#l_mod_inactivo').removeClass('btn-danger active').addClass('btn-default');
                }
            }else{
                $('#submodulo').val(oData[3]);
                $('#sbm_posicion').val(oData[4]);
                $('#ruta').val(oData[7]);
                $nommodulo.select2("enable", true);
                $btnaccionsub.val('Modificar');
            }
           
        } else {
            $('#limpiar').trigger('click');
            var url = urlmod;
            var oTable = TModulo;
            
            if(tipo == 'submodulo'){
                url = urlsub;
                oTable = TSubModulo;
            }
            window.parent.apprise('<span style="color:#FF0000;font-weight:bold;text-align: center;display:block">&iquest;Desea Eliminar el registro?</span>', {'verify': true, 'textYes': 'Aceptar', 'textNo': 'Cancelar'}, function (r) {
                if (r) {
                    $.eliminar(url, id, fila,$formulario,oTable,tipo);
                }
            });
        }
    };
    
    
    $('.tbl-modulos').on('click', 'img.modificar,img.eliminar', function () {
        $('#fila,#padre,#id').remove();

        var $this = $(this);
        $this.tooltip('hide');
        var padre = this.parentNode.parentNode
        var tabId  = $this.closest('table').attr('id');
        var aPos   = TModulo.fnGetPosition(padre);
        var otable = TModulo;
        var tipo   = 'modulo';
        if (tabId == 'tabla_submodulo') {
            aPos = TSubModulo.fnGetPosition(padre);
            otable = TSubModulo;
            tipo  = 'submodulo';
        }
        var clase = $(this).attr('class');
        $(this).tablaimage(tabId, aPos, clase, otable, tipo);
    });
    
    //$formulario.ids({otable:TModulo}); 
    
    $('input:radio[name="mod_estatus"]').change(function() {
        var valor = $(this).val();

        if (valor == 1) {
            $('#l_mod_activo').addClass('btn-success');
            $('#l_mod_inactivo').removeClass('btn-danger active').addClass('btn-default');
        } else if (valor == 0) {
            $('#l_mod_inactivo').addClass('btn-danger');
            $('#l_mod_activo').removeClass('btn-success active').addClass('btn-default');
        }
    });

    var letra  = ' abcdefghijklmnñopqrstuvwxyzáéíóú';
    var entero = '1234567890';

    $modulo.validar(letra);
    $mod_posicion.validar(entero);
    var urlmod = '../../controlador/seguridad/modulo.php';

    $btnaccion.on("click", function() {

        var nombreAnimate = 'animated shake';
        var finanimated = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        
        if ($modulo.val() === null || $modulo.val().length === 0 || /^\s+$/.test($modulo.val())) {
            $modulo.parent('div').addClass('has-error').addClass(nombreAnimate).one(finanimated,
                    function () {
                        $(this).removeClass(nombreAnimate);
                    });
            $modulo.focus();
        } else if ($mod_posicion.val() === null || $mod_posicion.val().length === 0 || /^\s+$/.test($mod_posicion.val())) {
            $mod_posicion.parent('div').addClass('has-error').addClass(nombreAnimate).one(finanimated,
                    function () {
                        $(this).removeClass(nombreAnimate);
                    });
            $mod_posicion.focus();
        } else {
            $('div').removeClass('has-error');

            if ($(this).val() == 'Guardar') {
                $('#cod_modulo').remove();
                // obtener el ultimo codigo del estado
                var ToltalRow = TModulo.fnGetData().length;
                var lastRow   = TModulo.fnGetData(ToltalRow - 1);
                var codigo    = parseInt(lastRow[0]) + 1;

                $.save(urlmod,$formulario,'modulo',codigo,TModulo);
                

            } else {
                window.parent.apprise('<div class="msj-danger">&iquest;Desea Modificar el Registro?</div>', {'verify': true, 'textYes': 'Aceptar', 'textNo': 'Cancelar'}, function(r) {
                    if (r) {
                        $.update(urlmod,$formulario,'modulo',TModulo);
                    } else {
                        limpiar($formulario);
                    }
                });
            }
        }
    });
    
    
    $tabla_modulo.find('tr').on('click', 'td:lt(4)', function() {
        if ($btnlistar.is(':hidden')) {
            $btnaccion.fadeOut(700, function() {
                $btnlistar.fadeIn(700);
            });
        }

        var padre = $(this).closest('tr');
        var modulo_id = padre.children('td:eq(0)').html();
        var modulo = padre.children('td').eq(1).html();
        var posicion = padre.children('td').eq(2).text().trim();
        $('#modulo_id').select2('val',modulo_id);
        /*var $codigo = '<input type="hidden" id="hmodulo_id"  value="' + modulo_id + '" name="hmodulo_id">';

        $($codigo).appendTo('input:button#btnaccionsub');*/

        $mod_posicion.val(posicion);
        $btnlimpiar.val('Restablecer');
        $modulo.val(modulo).prop('disabled', true);
        $mod_posicion.prop('disabled', true);
    });
    
    
     /*
     * Fin de Modulo
     */

    /*
     * Sub Modulos
     */
    
    // Tabla SubModulo
    var TSubModulo = $('#tabla_submodulo').dataTable({
        "iDisplayLength": 5,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [5, 10, 20, 30, 40, 50],
        "oLanguage": {"sUrl": "../../librerias/js/es.txt"},
        "aoColumns": [
            {"sClass": "details-control", "sWidth": "10%"},
            {"sClass": "center", "sWidth": "10%"},
            {"sClass": "center"},
            {"sClass": "center"},
            {"sClass": "center", "sWidth": "10%"},
            {"sClass": "center", "sWidth": "10%"},
            {"sWidth": "4%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false},
            {"sClass": "none", "sWidth": "10%"}
        ]
    });
    
    var $frmsubmodulo   = $('form#frmsubmodulo');
    var $nommodulo      = $frmsubmodulo.find('select#modulo_id');
    var $sub_modulo     = $frmsubmodulo.find('input:text#submodulo');
    var $sbmposicion    = $frmsubmodulo.find('input:text#sbm_posicion');
    var $ruta           = $frmsubmodulo.find('input:text#ruta');
    var $btnaccionsub   = $frmsubmodulo.find('input:button#btnaccionsub');
    var $btnlimpiarsub  = $frmsubmodulo.find('input:button#btnlimpiarsub');
    var $btnrestablecer = $frmsubmodulo.find('input:button#btnrestablecer');

    $nommodulo.select2();

//    var rutas = /^[a-zA-Z\.0-9/\-_]{4,50}$/;
    var num   = '1234567890';
    var ruta  = 'abcdefghijklmnopqrstuvwxyz/._-1234567890';

    $ruta.validar(ruta);
    $sbmposicion.validar(num);
    
     $('#img_nommodulo').tooltip({
        html: true,
        placement: 'top',
        title: '<span class="requerido">Requerido</span><br/>Debe Seleccionar un <span class="alerta">modulo</span>'
    });

    $('#img_submodulo').tooltip({
        html: true,
        placement: 'left',
        title: '<span class="requerido">Requerido</span><br/>El Subm&oacute;dulo no debe estar <span class="alerta">blanco</span>'
    });

    $('#img_ruta').tooltip({
        html: true,
        placement: 'right',
        title: '<span class="requerido">Requerido</span><br/>la Ruta no debe estar en <span class="alerta">blanco</span>,<br/>solo acepta (<span class="alerta">/_-.</span>)'
    });

    
    
    $sub_modulo.validar(letra);
    // Evento para buscar todos los SubModulos
    var urlsub = '../../controlador/seguridad/submodulo.php';
    
    $('input:radio[name="sbmod_estatus"]').change(function() {
        var valor = $(this).val();

        if (valor == 1) {
            $('#sbmod_activo').attr('checked', true);
            $('#sbmod_inactivo').attr('checked', false);
            $('#l_sbmod_activo').addClass('btn-success');
            $('#l_sbmod_inactivo').removeClass('btn-danger active').addClass('btn-default');
        } else if (valor == 0) {
            $('#sbmod_activo').attr('checked', false);
            $('#sbmod_inactivo').attr('checked', true);
            $('#l_sbmod_inactivo').addClass('btn-danger');
            $('#l_sbmod_activo').removeClass('btn-success active').addClass('btn-default');
        }
    });
    
    $btnlistar.on('click', function() {

        var id = $nommodulo.find('option').filter(':selected').val();
        var nommodulo = $nommodulo.find('option').filter(':selected').text();
        $nommodulo.select2("val", id);
        $nommodulo.select2("enable", false);
        $('div#divmodulo').slideUp(1500);
        $('div#divsubmodulo').slideDown(1500);

        
        TSubModulo.fnClearTable();

        $.post(urlsub, {id_mod: id, accion: 'BuscarSubModulos'}, function (resposnse) {
            if (resposnse.existe != 'no') {
                $.each(resposnse, function (i, item) {
                    var modificar = '<img class="modificar" title="Modificar" style="cursor: pointer" src="../../imagenes/datatable/modificar.png" width="18" height="18" alt="Modificar"/>';
                    var eli = '<img class="eliminar" width="18" height="18" alt="Eliminar" src="../../imagenes/datatable/eliminar.png" style="cursor: pointer" title="" data-original-title="Eliminar">';

                    var estatus = 'Activo';
                    if (item.estatus == 0) {
                        estatus = 'Inactivo';
                    }
                    if (item.id <= 5) {
                        var eli = '';
                    }
                    var accion = modificar + eli;
                    var nuevaFila =  TSubModulo.fnAddData(['', item.id, nommodulo, item.sub_modulo, item.posicion, estatus, accion, item.ruta]);
  
                    var id = item.id;
                    var oSettings = TSubModulo.fnSettings();
                    var nTr = oSettings.aoData[ nuevaFila[0] ].nTr;
                    nTr.setAttribute('id', id);
                    $('td', nTr)[2].setAttribute('id', item.modulo_id);
                });
            }
        },'json');
    });
 
    $btnrestablecer.on("click", function() {
        TSubModulo.fnDraw();
        TSubModulo.fnClearTable();
        $('div#divmodulo').slideDown(3000);
        $('div#divsubmodulo').slideUp(3000, function() {
            TSubModulo.fnClearTable();
        });
        $sub_modulo.val('');
        $btnaccionsub.val('Guardar');
    });
    
    
    
    var letras = /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]{2,20}$/;
    var rutas = /^[a-zA-Z\.0-9/\-_]{4,50}$/;
    $btnaccionsub.on("click", function() {

        if ($sub_modulo.val() === null || $sub_modulo.val().length === 0 || /^\s+$/.test($sub_modulo.val())) {
            $sub_modulo.parent('div').addClass('has-error');
            $sub_modulo.focus();
        } else if (!letras.test($sub_modulo.val())) {
            $sub_modulo.parent('div').addClass('has-error');
            $sub_modulo.focus();
        } else if ($sbmposicion.val().length < 1) {
            $sbmposicion.parent('div').addClass('has-error');
            $sbmposicion.focus();
        } else if ($ruta.val() === null || $ruta.val().length === 0 || /^\s+$/.test($ruta.val())) {
            $ruta.parent('div').addClass('has-error');
            $ruta.focus();
        } else if (!rutas.test($ruta.val())) {
            $ruta.parent('div').addClass('has-error');
            $ruta.focus();
        } else {
            $('div').removeClass('has-error');
            
            if ($(this).val() == 'Guardar') {
                var ToltalRow = TSubModulo.fnGetData().length;
                var lastRow = TSubModulo.fnGetData(ToltalRow - 1);
                var codigo = parseInt(lastRow[0]) + 1;
                $nommodulo.select2("enable", true);
                $.save(urlsub, $frmsubmodulo, 'sub_modulo', codigo, TSubModulo);
                $nommodulo.select2("enable", false);
            }else{
                window.parent.apprise('<div class="msj-danger">&iquest;Desea Modificar el Registro?</div>', {'verify': true, 'textYes': 'Aceptar', 'textNo': 'Cancelar'}, function(r) {
                    if (r) {
                        $nommodulo.select2("enable", true);
                        $.update(urlsub,$frmsubmodulo,'sub_modulo',TSubModulo);
                        $nommodulo.select2("enable", false);
                    } else {
                        limpiar($formulario);
                    }
                });
            }

        }
    });

});