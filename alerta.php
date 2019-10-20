<!-- Mauricio Bermudez Vargas 14/10/2019 04:12 p.m. -->
<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);
ini_set('display_errors', true);

try {
    
    require_once("sql/select.php");
    
    $estudiante_Nombre="";
    $estudiante_PrimerApellido="";
    $estudiante_SegundoApellido="";
    $db = new select(); 
            
if (isset($_GET['estudiante'])) { 
    $estudiante_Id = $_GET['estudiante'];
    $rsEstudiante = $db->conEstudiante($estudiante_Id);
    if (!empty($rsEstudiante)) {            
        foreach ($rsEstudiante as $key => $value) {
            $estudiante_Nombre = $value['estudiante_Nombre'];
            $estudiante_PrimerApellido = $value['estudiante_PrimerApellido'];
            $estudiante_SegundoApellido = $value['estudiante_SegundoApellido'];
        }                      
    }            
} else {
    $estudiante_Id = 0;
}

} catch (PDOException $e) {		
	echo "Error al conectar con la base de datos: " . $e->getMessage() . "\n";
	exit;
}
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
    <script type="text/javascript" src="jq/jquery-3.2.1.min.js"></script>
    <link rel="manifest" href="manifest.json">
    <link rel="stylesheet" type="text/css" media="screen" href="css/css_alerta.css" />    
</head>
<body>
<div id="menu">
    <a id="salir" href="https://www.lasesperanzas.ed.cr"></a>           
</div>
<div id="mainArea">
    <div id="contenedor_Fila">
        <a id="add" href="busca_Estudiante.php"></a>
    </div>
    <div id="contenedor_Fila">
        <div id="ColNombre"> <?php echo $estudiante_Nombre . " " . $estudiante_PrimerApellido . " " . $estudiante_SegundoApellido ?> </div>
    </div>
</div>
<div id="statusBar">
    <a href="https://www.lasesperanzas.ed.cr">lasesperanzas.ed.cr</a>
    <a href="https://www.wappcom.net">wappcom.net</a>                                       
</div>
<script>
$('#salir').html('<img src="img/salir.png">');
$('#add').html('<img src="img/add.png">');
</script>
</body>
</html>