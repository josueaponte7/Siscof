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
            {"sClass": "center", "sWidth": "25%"},
            {"sClass": "center", "sWidth": "20%"},
            {"sClass": "center", "sWidth": "20%"},
            {"sClass": "center", "sWidth": "20%"},
            {"sWidth": "8%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false}
        ]
    });
    
    $('#estatus').select2();
    $('table#tabla_fallas').on('click', 'img.modificar', function() {
        var padre = $(this).closest('tr');
        var fila = padre.index();
        $('#fila').val(fila);
        var usuario      = padre.children('td:eq(0)').text().trim();
        var num_falla    = padre.children('td:eq(1)').text().trim();
        var id_falla     = padre.children('td:eq(1)').attr('id');  
        var departamento = padre.children('td:eq(2)').text().trim();
        $('#datos_usuario').val(usuario);
        $('#num_falla').val(num_falla);
        $('#id_falla').val(id_falla);
        $('#departamento').val(departamento);
        $.post('buscar_falla.php',{id_falla:id_falla},function(repuesta){
            $('#problema').val(repuesta);
        });
        $('#div_falla').slideDown(2000);
        $('.fila').slideUp(2000);
    });
    
    
    $('table#tabla_fallas').on('click', 'img.resolver', function() {
        var padre = $(this).closest('tr');
        var fila = padre.index();
        $('#fila').val(fila);
        var usuario      = padre.children('td:eq(0)').text().trim();
        var num_falla    = padre.children('td:eq(1)').text().trim();
        var id_falla     = padre.children('td:eq(1)').attr('id');  
        var departamento = padre.children('td:eq(2)').text().trim();
        $('#datos_usuario').val(usuario);
        $('#num_falla').val(num_falla);
        $('#id_falla').val(id_falla);
        $('#departamento').val(departamento);
        $.post('buscar_falla.php',{id_falla:id_falla},function(repuesta){
            $('#problema').val(repuesta);
        });
        $('#div_falla').slideDown(2000);
        $('.fila').slideUp(2000);
    });
    
    $('#asignar').click(function(){
        $.post('../../controlador/fallas/asignar.php',$('#frmfallas').serialize()+'&accion=Asignar',function(respuesta){
            var cod_msg  = parseInt(respuesta.error_codmensaje);
            var mensaje  = respuesta.error_mensaje;
            var $tecnico = $('#tecnico').find('option').filter(':selected');
            if (cod_msg == 21) {
                var fila = $('#fila').val();
                TFallas.fnDeleteRow(parseInt(fila));
                window.parent.apprise(mensaje, {'textOk': 'Aceptar'}, function () {
                    TFallasAsignar.fnAddData([$('#datos_usuario').val(), $tecnico.text(), $('#num_falla').val(), $('#departamento').val(),'ASIGNADO']);       
                    $('.fila').slideDown(2000);
                    $('#div_falla').slideUp(2000);
                    $('select').select2('val',0);
                    $('input,textarea').val('');
                    $('#estatus').val('NO ASIGNADO');
                });
            }
        },'json');
    });
    
    $('#resolver').click(function(){
        $.post('../../controlador/fallas/resolver.php',$('#frmfallas').serialize()+'&accion=Resolver',function(respuesta){
            var cod_msg  = parseInt(respuesta.error_codmensaje);
            var mensaje  = respuesta.error_mensaje;
            var $tecnico = $('#estatus').find('option').filter(':selected');
            if (cod_msg == 21) {
                var fila = $('#fila').val();
                window.parent.apprise(mensaje, {'textOk': 'Aceptar'}, function () {
                    TFallas.fnUpdate( $tecnico.text().trim(), parseInt(fila), 3 ); // Single cell
                    $('.fila').slideDown(2000);
                    $('#div_falla').slideUp(2000);
                    $('select').select2('val',0);
                    $('input,textarea').val('');
                    $('#estatus').val('NO ASIGNADO');
                });
            }
        },'json');
    });
    
});