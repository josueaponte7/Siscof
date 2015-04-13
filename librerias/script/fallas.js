$(document).ready(function () {
    var TFallas = $('#tabla_fallas').dataTable({
        "iDisplayLength": 5,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [5, 10, 20, 30, 40, 50],
        "oLanguage": {"sUrl": "../../librerias/js/es.txt"},
        "order": [[ 1, "desc" ]],
        "aoColumns": [
            
            {"sClass": "center", "sWidth": "25%"},
            {"sClass": "center", "sWidth": "20%"},
            {"sClass": "center", "sWidth": "25%"},
            {"sWidth": "8%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false},
            {"sWidth": "8%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false}
        ]
    });   
    
    var $frmfallas         = $('form#frmfallas');
    var $datos_usuario     = $frmfallas.find('input:text#datos_usuario');
    var $num_falla         = $frmfallas.find('input:text#num_falla');
    var $departamento_id   = $frmfallas.find('select#departamento_id');
    var $bien_id           = $frmfallas.find('select#bien_id');
    var $estatus           = $frmfallas.find('input:text#estatus');
    var $problema          = $frmfallas.find('textarea#problema');
    var $btn_guardar       = $frmfallas.find('button#guardar');    

    $departamento_id.select2();
    $bien_id.select2();
    
    var val_letra = ' abcdefghijklmnopqrstuvwxyzáéíóúñ1234567890';

    $problema.validar(val_letra);
    
    
    var url = '../../controlador/fallas/fallas.php';
    $departamento_id.change(function (){
        var valor = $(this).val();
        if(valor > 0){
           $.buscar(url,valor,'bien'); 
        }
        
    });
    
    
    $btn_guardar.click(function(){
        
        var img_mod = ' <img class="modificar"  title="Modificar" style="cursor: pointer" src="../../imagenes/datatable/modificar.png " width="18" height="18" alt="Modificar"/>';
        var img_del = ' <img class="eliminar"  title="Eliminar" style="cursor: pointer" src="../../imagenes/datatable/eliminar.png " width="18" height="18" alt="Modificar"/>'
        
        $num_falla.prop('disabled',false);
        $.post(url, $frmfallas.serialize(), function(respuesta) {
            
            var cod_msg = parseInt(respuesta.error_codmensaje);
            var mensaje = respuesta.error_mensaje;
            var departamento = $id_departamento.find('option').filter(':selected');
            if (cod_msg == 21) {
                
                var res = $num_falla.val().split("-");
                
                var num_fa      = $('#cod_falla').val();
                var cod_fall    = parseInt(num_fa)+1;
                var id_falla    = parseInt(num_fa);
                var num_falla   = res[0]+'-'+id_falla; 
                var num_falla_n = res[0]+'-'+cod_fall; 
               window.parent.apprise(mensaje, {'textOk': 'Aceptar'}, function () {
                    TFallas.fnAddData([$problema.val(), num_falla, departamento.text(), $estatus.val(), img_mod, img_del]);                    

                    var num_fal = lpad(id_falla,7);
                    $num_falla.val(num_fal);
                    $('#cod_falla').val(cod_fall);
                    $problema.val('');
                    $id_departamento.val(0);
                    $num_falla.val(num_falla_n).prop('disabled',true);
                });
            }
         },'json');
    });
    
    
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
        buscar: function (url,id,accion) {
            $bien_id.find('option:gt(0)').remove().end();
            $.post(url, {id: id, 'accion': accion}, function (respuesta) {
                var option = "";
                $.each(respuesta, function(i, obj) {
                    option += "<option value=" + obj.id + ">" + obj.nombre_bien + "</option>";
                });
                $bien_id.append(option);
            }, 'json');
        }
    });
    
});
