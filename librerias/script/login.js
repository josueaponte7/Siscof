$(document).ready(function () {
    $('input#usuario').focus();

    var url = 'controlador/seguridad/login.php';
     $(document).on('keypress', function (e) {
         if (e.keyCode == 13) {
            $.login(url);
        }
    });

    $.extend({
        login: function (url) {
            
            var nombreAnimate = 'animated zoomOut';
            var finanimated   = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
            var send_data = $('#frmlogin').serialize()+ '&' + $.param({ accion: 'Ingresar'});
            $.post(url, send_data, function (respuesta) {
                 var cod_msg = parseInt(respuesta);
                if (cod_msg === 21) {
                    
                    $('#frmlogin').addClass(nombreAnimate,function(){
                        
                    }).one(finanimated,
                    function () {
                        window.location = 'controlador/seguridad/acceso.php'
                    });
                    
                    //setTimeout(function(){  }, 5000);
                   
                } else if (respuesta.existe === 'ok') {

                } else if (respuesta.success === 'error') {
                    window.parent.apprise('<span style="color:#FF0000;font-weight:bold;display:block">' + mensaje + '</span>', {'textOk': 'Aceptar'});
                }
            }, 'json');
        }
    });
});
