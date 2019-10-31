<!-- Mauricio Bermudez Vargas 31/10/2019 10:29 a.m. -->
<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);
ini_set('display_errors', true);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Progressive Web Application">
    <meta name="theme-color" content="#499bea" />
    <title>Inicio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="manifest.json">
    <link rel="stylesheet" type="text/css" media="screen" href="css/css_inicio.css" /> 
    <script type="text/javascript" src="jq/jquery-3.2.1.min.js"></script>
</head>
<body>
<div id="menu">
    <a id="salir" href="https://www.lasesperanzas.ed.cr"></a>
    <a id="hyp_reporte" href="excel_alerta.php"></a>
</div>
<div id="mainArea">
    <div id="contenedor_Fila">
        <a id="add" href="alerta.php"></a>
    </div>
</div>
</body>
<script>
    $('#salir').html('<img src="img/salir.png">');
    $('#hyp_reporte').html('<img src=img/excel.png>');
    $('#add').html('<img src="img/add.png">');
    
    
</script>
</html>