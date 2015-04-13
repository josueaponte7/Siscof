
$(document).ready(function() {
    var THerramientas = $('#tabla_registrar').dataTable({
        "iDisplayLength": 5,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [5, 10, 20, 30, 40, 50],
        "oLanguage": {"sUrl": "../../librerias/js/es.txt"},
        "aoColumns": [
        {"sClass": "center", "sWidth": "20%"},
        {"sClass": "center", "sWidth": "15%"},
        {"sClass": "center", "sWidth": "20%"},
        {"sClass": "center", "sWidth": "20%"}
        ]
    });

    var $frmherramienta  = $('form#frmherramienta');
    var $id_departamento = $frmherramienta.find('select#departamento_id');
    var $usuariof_id     = $frmherramienta.find('select#usuariof_id');
    var $bien_id         = $frmherramienta.find('select#bien_id');
    var $asignado        = $frmherramienta.find('select#asignado');
    var $btn_guardar     = $frmherramienta.find('button#guardar');

    var url = '../../controlador/inventario/herramientas.php';
    
    $id_departamento.select2();
    $usuariof_id.select2();
    $bien_id.select2();
    $asignado.select2();
    
    $id_departamento.change(function(){
        
        var valor = $(this).val();
        var option = "";
        $('#usuariof_id').find('option:gt(0)').remove().end();
        if(valor > 0){
            $.post(url,{'departamento_id':valor,'accion':'buscar_usuario'},function (data){
                
                $.each(data, function(i, obj) {
                    option += "<option value=" + obj.id + ">" + obj.nombre + "</option>";
                });
                $('#usuariof_id').append(option);
            },'json');
        }
        
    });
        
    $btn_guardar.click(function(){
        $.update(url)
    }); 
    
    $.extend({
        update: function (url) {
            var id = $('#bien_id').find('option').filter(':selected').val();
            var depar = $id_departamento.find('option').filter(':selected').text();
            var usua = $usuariof_id.find('option').filter(':selected').text();
            var bien = $bien_id.find('option').filter(':selected').text();
            var asig = $asignado.find('option').filter(':selected').val();
            var asignado = 'Asignado';
            if(asig == 2){
                asignado = 'Reasignado';
            }
            var data_send = $frmherramienta.serialize() + '&' + $.param({id:id,accion: 'update_asignar'});
            $.post(url, data_send, function (respuesta) {
                if (respuesta.success === 'exitoso') {
                    window.parent.apprise('<span style="color:#059102;font-weight:bold;display:block">' + respuesta.msg + '</span>', {'textOk': 'Aceptar'}, function () {
                        var nuevaFila = THerramientas.fnAddData([depar, usua, bien, asignado]);
                    });
                }
            }, 'json');
        }
    });
    
});


