<!DOCTYPE html>
<html>
    <head>
        <title>Sistema de Control de Citas</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="librerias/css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="librerias/css/bootstrap-theme.css"/>
        <link rel="stylesheet" type="text/css" href="librerias/css/animate.css"/>
        <script src="librerias/js/jquery-1.11.2.min.js" type="text/javascript"></script>
        <script src="librerias/js/bootstrap.js" type="text/javascript"></script> 
        <script src="librerias/script/login.js" type="text/javascript"></script> 
        <style type="text/css">
            div#logueo{
                position:fixed;
                top:40%;
                left:50%;
                margin-left:-290px;
                margin-top:-155px
            }

            table#login{
                width:580px;
                height:380px;
                background-image:url(logo.png); 
                background-repeat:no-repeat;
                border: none;
            }
            .tabla {
                position: absolute;
                top: 285px;
                height: 149px;
            }
            #recuperar:hover{
                color:red;
                text-decoration: underline;

            }
            #divrecuperar{
                display: none;
            }

            .container {
                width: 350px;
            }

            /* The white background content wrapper */
            .container > .content {
                background-color: #e6f6fe;
                padding: 20px;
                margin: 0 -20px; 
                -webkit-border-radius: 10px 10px 10px 10px;
                -moz-border-radius: 10px 10px 10px 10px;
                border-radius: 10px 10px 10px 10px;
                -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
                -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
                box-shadow: 0 1px 2px rgba(0,0,0,.15);
                margin-top: 30%;
            }
            .login {
                margin-left: 65px;

            } 
            iput{
                border: none;
            }
            html, body {
                height: 100%;
                background-color: #FFFFFF;
            }
            #frmlogin{
                -moz-animation-duration: 5s;
                -webkit-animation-duration: 5s;
                -o-animation-duration: 5s;
            }
        </style>
    </head>
    <!--<body style="background-image:url(degradado.jpg);height:200px;">--> 
    <body> 
        <div id="logueo">
            <form class="animated fadeIn" name="frmlogin" autocomplete="off" id="frmlogin" method="POST" enctype="multipart/form-data">
                <table width="352"  align="center" cellpadding="0" cellspacing="0" id="login">
                    <tbody>
                        <tr>
                            <td width="423">
                                <div class="tabla" style="width: 340px;">
                                    <table  width="255" border="0" style="margin-top: -36px; margin-left: 20px;">
                                        <tbody>
                                            <tr style="height: 52px;">
                                                <td>
                                                    <input style="border:0;background-color:transparent;width:255px;height: 30px;padding: 5px 10px" type="text" name="usuario" id="usuario" maxlength="20"  value="" />
                                                </td>
                                            </tr>
                                            <tr style="height: 50px;">
                                                <td>
                                                    <input style="border:0;background-color:transparent;width:255px;height: 30px;padding: 5px 10px" type="password" name="clave" id="clave" maxlength="20" value="" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td  colspan="2" align="left" >
                                                    <input type="hidden" name="accion" id="accion"  value="Ingresar"/>
                                                    <!--<img src="iniciar.png" alt="cajas" width="130" height="29" id="ingresar" style="margin-left:40px;cursor:pointer"></td>-->
                                                    <!--<span id="recuperar" style="font-size: 12px;color: #ffffff;cursor: pointer">Recuperar Contraseña</span>-->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" align="center">
                                                    <div style="display: none" class="alert alert-danger" id="error" role="alert"></div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </body>
</html>