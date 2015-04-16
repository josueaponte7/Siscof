$(document).ready(function () {
    var TFallas = $('#tabla_registrar').dataTable({
        "iDisplayLength": 5,
        "iDisplayStart": 0,
        "sPaginationType": "full_numbers",
        "aLengthMenu": [5, 10, 20, 30, 40, 50],
        "oLanguage": {"sUrl": "../../librerias/js/es.txt"},
        "aoColumns": [
            {"sClass": "details-control", "sWidth": "2%"},
            {"sClass": "center", "sWidth": "12%"},
            {"sClass": "none", "sWidth": "25%"},
            {"sClass": "center", "sWidth": "12%"},
            {"sClass": "center", "sWidth": "25%"},
            {"sClass": "center", "sWidth": "20%"},
            {"sClass": "center", "sWidth": "10%"},
            {"sClass": "center", "sWidth": "25%"}
        ]
    });   
    var $frmfallas         = $('form#frmfallas');
    var $num_falla         = $frmfallas.find('input:text#num_falla');
    var $departamento_id   = $frmfallas.find('select#departamento_id');
    var $bien_id           = $frmfallas.find('select#bien_id');
    var $estatus           = $frmfallas.find('input:text#estatus');
    var $problema          = $frmfallas.find('textarea#problema');
    var $btn_guardar       = $frmfallas.find('button#guardar');    
    var $btn_limpiar       = $frmfallas.find('button#limpiar');  
    
    $departamento_id.select2();
    $bien_id.select2();
    
    var val_letra = ' abcdefghijklmnopqrstuvwxyzáéíóúñ1234567890';

    $problema.validar(val_letra);
    
    
    var url = '../../controlador/fallas/fallas.php';
    $departamento_id.change(function (){
        var valor = $(this).val();
        $bien_id.select2('val', 0);
        $bien_id.find('option:gt(0)').remove().end();
        $('#num_falla').val('');
        $('#usuariof').val('');
        $('#usuariof_id').val('');
        if(valor > 0){
           $.buscar(url,valor,'bien'); 
        }
    });
    
    
    $bien_id.change(function (){
        var valor = $(this).val();
        $('#num_falla').val('');
        $('#usuariof').val('');
        $('#usuariof_id').val('');
        if(valor > 0){
           $.usuario(url,valor,'usuario'); 
        }
    });
    $btn_guardar.click(function(){
       $.save(url);
    });
    
    $btn_limpiar.click(function(){
        $('select').select2('val', 0);
        $bien_id.find('option:gt(0)').remove().end();
        $('#num_falla,#usuariof,#usuariof_id,#problema').val('');
    });
    $.extend({
        save: function (url) {
            $num_falla.prop('disabled',false);
            var nombreAnimate = 'animated shake';
            var finanimated   = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
            
            var data_send = $frmfallas.serialize() + '&' + $.param({accion: 'save'});
            var $bien     = $bien_id.find('option').filter(':selected');
            var $bien     = $bien_id.find('option').filter(':selected');
            $.post(url, data_send, function (respuesta) {
                $num_falla.prop('disabled',true);
                if (respuesta.success === 'exitoso') {
                    window.parent.apprise('<span style="color:#059102;font-weight:bold;display:block">' + respuesta.msg + '</span>', {'textOk': 'Aceptar'}, function () {
                        var f = new Date();
                        var dia = f.getDate();
                        var mes = f.getMonth() + 1;
                        var pad = '00';
                        var dia = (pad + dia).slice(-pad.length);
                        var mes = (pad + mes).slice(-pad.length);
                        var fecha = dia + "/" + mes + "/" + f.getFullYear();
                        var cod_bien  = $bien.val().lpad('0',3);
                        var nuevaFila = TFallas.fnAddData(['',$num_falla.val(), $problema.val(),cod_bien,$bien.text(),$('#usuariof').val(),fecha,$estatus.val()]);
                        $('#limpiar').trigger('click');
                    });
                } else if (respuesta.success === 'error') {
                    window.parent.apprise('<span style="color:#FF0000;font-weight:bold;display:block">' + mensaje + '</span>', {'textOk': 'Aceptar'});
                }
            }, 'json');
        },        
        buscar: function (url,id,accion) {
            $.post(url, {id: id, 'accion': accion}, function (respuesta) {
                var option = "";
                $.each(respuesta, function(i, obj) {
                    option += "<option value=" + obj.id + ">" + obj.nombre_bien + "</option>";
                });
                $bien_id.append(option);
            }, "json");
        },
        usuario: function (url,id,accion) {
            $('#usuariof').val('');
            $('#usuariof_id').val('');
            $.post(url, {id: id, 'accion': accion}, function (respuesta) {
                $('#num_falla').val(respuesta.num_falla);
                $('#usuariof').val(respuesta.nombres);
                $('#usuariof_id').val(respuesta.id);
            }, "json");
        }
    });
    
});

String.prototype.lpad = function(padString, length) {
    var str = this;
    while (str.length < length)
        str = padString + str;
    return str;
}

$.strPad = function(i,l) {
	var o = i.toString();
	var s = '0';
	while (o.length < l) {
		o = s + o;
	}
	return o;
};