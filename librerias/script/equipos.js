$(document).ready(function () {
    var TEquipos = $('#tabla_equipos').dataTable({
        "iDisplayLength": 5,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [5, 10, 20, 30, 40, 50],
        "oLanguage": {"sUrl": "../../librerias/js/es.txt"},
        "aoColumns": [
            {"sClass": "center", "sWidth": "20%"},
            {"sClass": "center", "sWidth": "20%"},
            {"sClass": "center", "sWidth": "20%"},
            {"sClass": "center", "sWidth": "20%"},
            {"sClass": "center", "sWidth": "4%"},
            {"sWidth": "4%", "bSortable": false, "sClass": "center sorting_false", "bSearchable": false}
        ]
    });


    var $frmequipo       = $('form#frmequipo');
    var $cod_equipo      = $frmequipo.find('input:text#cod_equipo');
    var $marca           = $frmequipo.find('input:text#marca');
    var $modelo          = $frmequipo.find('input:text#modelo');
    var $serial_equipo   = $frmequipo.find('input:text#serial_equipo');
    var $num_bien        = $frmequipo.find('input:text#num_bien');
    var $id_departamento = $frmequipo.find('select#id_departamento');
    var $btn_guardar     = $frmequipo.find('button#guardar');
    
     
    $id_departamento.select2();
    var vali_cod  = '1234567890';
    var val_letra = ' abcdefghijklmnopqrstuvwxyzáéíóúñ' + vali_cod;
    //var letra = ' abcdefghijklmnopqrstuvwxyzáéíóúñ';

    $cod_equipo.validar(vali_cod);
    $marca.validar(val_letra);
    $modelo.validar(val_letra);
    $serial_equipo.validar(val_letra);
    $num_bien.validar(vali_cod);
    var url = '../../controlador/inventario/equipos.php';
    $btn_guardar.click(function () {

        var img_mod = ' <img class="modificar"  title="Modificar" style="cursor: pointer" src="../../imagenes/datatable/modificar.png " width="18" height="18" alt="Modificar"/>';
        var img_del = ' <img class="eliminar"  title="Eliminar" style="cursor: pointer" src="../../imagenes/datatable/eliminar.png " width="18" height="18" alt="Modificar"/>'
        $cod_equipo.prop('disabled',false);
        $.post(url, $frmequipo.serialize(), function (respuesta) {
            $cod_equipo.prop('disabled',true);
            var cod_msg = parseInt(respuesta.error_codmensaje);
            var mensaje = respuesta.error_mensaje;
            if (cod_msg == 21) {
                var id_equi = $('#id_equipo').val();
                var codigo_equipo = lpad(id_equi,7);
                window.parent.apprise(mensaje, {'textOk': 'Aceptar'}, function () {
                    TEquipos.fnAddData([codigo_equipo, $marca.val(), $modelo.val(), $serial_equipo.val(), img_mod, img_del]);
                    var id_equipo = parseInt(id_equi)+1
                    var codigo_e = lpad(id_equipo,7);
                    $cod_equipo.val(codigo_e);
                    $('#id_equipo').val(id_equipo);
                    $('select').select2('val',0);
                    $marca.val('');
                    $modelo.val('');
                    $serial_equipo.val('');
                    $num_bien.val('');
                });
            }
        }, 'json');
    });
    
     $('table#tabla_equipos').on('click', 'img.modificar', function() {
        // borra el campo fila
        $('#fila').remove();
        $('#id_equipos').remove();
        var padre = $(this).closest('tr');

        var cod_equipo  = padre.children('td:eq(0)').text();
        var marca = padre.children('td:eq(1)').html();
        var modelo = padre.children('td:eq(2)').text();
        var serial_equipo  = padre.children('td:eq(3)').text();
        var num_bien  = padre.children('td:eq(4)').text();
        var id_departamento = padre.children('td:eq(5)').attr('id');
       
        $('#guardar').text('Modificar');
        $('#cod_equipo ').val(cod_equipo .trim());
        $('#marca').val(marca.trim());
        $('#modelo').val(modelo.trim());
        $('#serial_equipo ').val(serial_equipo .trim());
        $('#num_bien').val(num_bien.trim());
        $('#id_departamento').select2('val', id_departamento);
       
    });


});

function lpad(number, digits) {
    return Array(Math.max(digits - String(number).length + 1, 0)).join(0) + number;
}