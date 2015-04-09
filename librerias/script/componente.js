
$(document).ready(function() {
    var TComponentes = $('#tabla_usuarios').dataTable({
        "iDisplayLength": 5,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [5, 10, 20, 30, 40, 50],
        "oLanguage": {"sUrl": "../../librerias/js/es.txt"},
        "aoColumns": [
        {"sClass": "center","sWidth": "4%"},
        {"sClass": "center", "sWidth": "40%"},
        {"sClass": "center", "sWidth": "15%"},
        {"sClass": "center", "sWidth": "25%"},
        {"sClass": "center", "sWidth": "10%"}
        ]
    });

    $('#bien,#incorporado').select2();
  
    
    /*$.each(rows, function (i, obj) {
        var aPos = TComponentes.fnGetPosition(i);
        var oData = TComponentes.fnGetData(aPos);
        console.log(oData[0]);
    });*/
    var url = '../../controlador/inventario/componente.php';
    $('#bien').change(function(){
        var valor = $(this).val();
        $.post(url,{'id':valor,'accion':'buscar_bien'},function (data){
            $('#codigo').val(data.codigo);
            $('#serial').val(data.serial);
            $('#numero').val(data.numero);
            $('#incorporado').select2('val',data.incorporado);
        },'json');
    });
    
    
    $('#guardar').click(function (){
        if($(this).text() == 'Guardar'){
            $.save(url);
        }else{
            
        }
        
    });
    
    $.extend({
        save: function (url) {
            var nombreAnimate = 'animated shake';
            var finanimated   = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
            var img_mod       = ' <img class="modificar"  title="Modificar" style="cursor: pointer" src="../../imagenes/datatable/modificar.png " width="18" height="18" alt="Modificar"/>';
            var img_del       = ' <img class="eliminar"  title="Eliminar" style="cursor: pointer" src="../../imagenes/datatable/eliminar.png " width="18" height="18" alt="Modificar"/>'
            var valor         = $('#bien').find('option').filter(':selected').val();
            var estatus       = $('#incorporado').find('option').filter(':selected').val();
            var data_send     = $('form').serialize() + '&' + $.param({'id':valor,'estatus':estatus,accion: 'up_estatus'});
            $.post(url, data_send, function (respuesta) {
                var bien  = $('#bien').find('option').filter(':selected').text();
                var incor = $('#incorporado').find('option').filter(':selected').val();
                var incorporado = 'INCORPORADO';
                if(incor == 0){
                    incorporado = 'DESINCORPORADO';
                }
                if (respuesta.success === 'exitoso') {
                    window.parent.apprise('<span style="color:#059102;font-weight:bold;display:block">' + respuesta.msg + '</span>', {'textOk': 'Aceptar'}, function () {
                        var rows = TComponentes.fnGetData();
                        $.each(rows, function (i, row) {
                            var cod = row[0]
                            var este = $(this);
                            if(cod == $('#codigo').val()){
                                TComponentes.fnUpdate(incorporado, parseInt(i), 4);
                            }
                        });

                        $('#limpiar').trigger('click');
                    });
               
                } else if (respuesta.success === 'error') {
                    window.parent.apprise('<span style="color:#FF0000;font-weight:bold;display:block">' + mensaje + '</span>', {'textOk': 'Aceptar'});
                }
            }, 'json');
        }
    });
    
    
});


