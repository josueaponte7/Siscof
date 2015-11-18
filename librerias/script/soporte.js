$(document).ready(function () {
    var $tabla_fallas_asig = $('#tabla_fallas_asig');
    var TFallasAsignar = $tabla_fallas_asig.dataTable({
        "iDisplayLength": 5,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "bLengthChange": false,
        "oLanguage": {"sUrl": "../../librerias/js/es.txt"},
        "order": [[1, "desc"]],
        "aoColumns": [
            {"sClass": "center", "sWidth": "25%"},
            {"sClass": "center", "sWidth": "20%"},
            {"sClass": "center", "sWidth": "20%"},
            {"sWidth": "8%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false}
        ]
    });
    
    $('#estatus').select2({
        'minimumResultsForSearch': 'Infinity'
    });
    $tabla_fallas_asig.on('click', 'span.estatus', function() {
        
        var aPos    = TFallasAsignar.fnGetPosition(this.parentNode.parentNode);
        var oData   = TFallasAsignar.fnGetData(aPos);
        var estatus = $(this).text();
        if(estatus == 'PROCESAR'){
            $.post('../../controlador/fallas/fallas.php', {'num_falla': oData[1], 'accion': 'procesar'}, function (respuesta) {
                if (respuesta.success == 'exitoso') {
                    window.parent.apprise('<span style="color:#059102;font-weight:bold;display:block">' + respuesta.msg + '</span>', {'textOk': 'Aceptar'}, function () {
                        TFallasAsignar.fnUpdate('<span class="estatus">CERRAR</span>', aPos, 3);
                    });
                }
            }, 'json');
        }else{
            $('#fila').val(aPos);
            $('#num_falla').val(oData[1]);
        }
    });
    
    $('#cerrar').click(function () {
       $('#num_falla').prop('disabled',false);
        var data_send     = $('#frmfallas').serialize() + '&' + $.param({accion: 'cerrar'});
        $('#num_falla').prop('disabled',true);
        $.post('../../controlador/fallas/fallas.php', data_send, function (respuesta) {
            if (respuesta.success == 'exitoso') {
                var fila = $('#fila').val();
                
                window.parent.apprise('<span style="color:#059102;font-weight:bold;display:block">' + respuesta.msg + '</span>', {'textOk': 'Aceptar'}, function () {
                    TFallasAsignar.fnUpdate('<span style="color: #FF0000;font-weight: bold;">CERRADO</span>', parseInt(fila), 3);
                });
                $('#num_falla,#descripcion,#fila').val('')
                $('#estatus').select2('val',0);
            }
        }, 'json');
    });
});