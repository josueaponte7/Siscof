$(document).ready(function () {
    var TFallas = $('#tabla_fallas').dataTable({
        "iDisplayLength": 5,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "bLengthChange": false,
        "oLanguage": {"sUrl": "../../librerias/js/es.txt"},
        "order": [[1, "desc"]],
        "aoColumns": [
            {"sClass": "center", "sWidth": "20%"},
            {"sClass": "center", "sWidth": "20%"},
            {"sClass": "center", "sWidth": "20%"},
            {"sClass": "center", "sWidth": "20%"},
            {"sWidth": "8%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false}
        ]
    });
    
    var TFallasAsignar = $('#tabla_fallas_asig').dataTable({
        "iDisplayLength": 5,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "bLengthChange": false,
        "oLanguage": {"sUrl": "../../librerias/js/es.txt"},
        "order": [[1, "desc"]],
        "aoColumns": [
            {"sClass": "center", "sWidth": "20%"},
            {"sClass": "center", "sWidth": "20%"},
            {"sClass": "center", "sWidth": "20%"},
            {"sClass": "center", "sWidth": "20%"},
            {"sWidth": "20%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false}
        ]
    });
    
    $('#usuariof_id').select2();
    
    $('table#tabla_fallas').on('click', 'img.modificar', function() {
        var aPos  = TFallas.fnGetPosition(this.parentNode.parentNode);
        var oData  = TFallas.fnGetData(aPos);
 
        var cod_falla = parseInt(oData[1].substring(oData[1].length-2));
        $('#fila').val(aPos);
        $('#cod_falla').val(cod_falla);
        $('#usuario').val(oData[0]);
        $('#num_falla').val(oData[1]);
        $('#departamento').val(oData[2]);        
        $('#div_formulario').slideDown(2000);
        $('#div_asignar').slideUp(2000);
    });
    
    $('#cancelar').click(function(){
        $('#cod_falla,#num_falla').val('');
        $('usuariof_id').select2('val',0);
        $('#div_asignar').slideDown(2000);
        $('#div_formulario').slideUp(2000);
    });
      
    $('#asignar').click(function(){
        $('#num_falla').prop('disabled',false);
        var data_send = $('#formasignar').serialize() + '&' + $.param({accion: 'asignar'});
        $('#num_falla').prop('disabled',true);
        var $tecnico = $('#usuariof_id').find('option').filter(':selected');
        $.post('../../controlador/fallas/asignar.php',data_send,function(respuesta){
            
            if (respuesta['success'] == 'exitoso') {
                var fila = $('#fila').val();
                TFallas.fnDeleteRow(parseInt(fila));
                window.parent.apprise('<span style="color:#059102;font-weight:bold;display:block">' + respuesta.msg + '</span>', {'textOk': 'Aceptar'}, function () {
                    TFallasAsignar.fnAddData([$('#usuario').val(), $tecnico.text(), $('#num_falla').val(), $('#departamento').val(),'ASIGNADO']);       
                    $('.fila').slideDown(2000);
                    $('#div_falla').slideUp(2000);
                    $('select').select2('val',0);
                    $('input,textarea').val('');
                    $('#estatus').val('NO ASIGNADO');
                    $('#cancelar').trigger('click');
                });
            }
        },'json');
    });
});