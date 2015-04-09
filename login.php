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
                left:55%;
                margin-left:-290px;
                margin-top:-155px
            }

            #login{
                width:400px;
                height:400px;
                background-image:url("logos/entrada_usuario.jpg"); 
                background-repeat:no-repeat;
                border: none;
                margin: auto;
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
            #login{
                -moz-animation-duration: 5s;
                -webkit-animation-duration: 5s;
                -o-animation-duration: 5s;
            }
            #frmlogin{
                -moz-animation-duration: 1s;
                -webkit-animation-duration: 1s;
                -o-animation-duration: 1s;
            }
            .form-control{
                box-shadow:inherit;
            }
            .form-control:focus{
                box-shadow:inherit;
            }
        </style>
    </head>
    <!--<body style="background-image:url(degradado.jpg);height:200px;">--> 
    <body> 
        <div id="logueo">
            <form  name="frmlogin" autocomplete="off" id="frmlogin" method="POST" enctype="multipart/form-data">
                <div class="animated zoomIn" id="login">
                    <div  class="row">
                        <div class="form-group" style="margin-top: 37%;position: relative">
                            <input type="text" name="usuario" id="usuario" style="border: none; background-color: transparent;width: 75%;margin-left:13%" class="form-control input-lg"   maxlength="33" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group" style="margin-top: 8%;position: relative">
                            <input type="password" name="clave" id="clave" style="border: none; background-color: transparent;width: 75%;margin-left:13%" class="form-control input-lg"  maxlength="33" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>