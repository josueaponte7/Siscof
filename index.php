<?php
session_start();
if (isset($_SESSION['menu'])) {

    $menu = $_SESSION['menu'];
} else {
    $menu = 'index1.php';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Página Principal</title>
        <link rel="shortcut icon"   href="imagenes/sistema/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="librerias/css/apprise.css"  />
        <script type="text/javascript" src="librerias/js/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="librerias/js/apprise.js"></script>
        <style type="text/css">
            html, body, iframe { margin:0; padding:0; height:100%;background-color:transparent; }
            html { overflow:hidden; }
            iframe {display:block; width:100%; border:none; background-color:transparent;}
            div{font-size: 12px;}
        </style>   
    </head>
    <body>  
        <iframe align="middle" src="<?php echo $menu; ?>"  id="ifrmcuerpo" name="ifrmcuerpo"  frameborder="0" scrolling="si"></iframe>
    <!--<object type="text/html" data="<?php echo $menu; ?>"></object>-->
    </body>
</html>