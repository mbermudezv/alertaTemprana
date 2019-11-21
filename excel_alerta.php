<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);

require_once("sql/select.php");

$seccion_Id=$_GET['seccion'];
$alerta_Fecha=$_GET['mes'];
$situacion_Nombre = "";
$estudiante_Nombre = "";
$estudiante_PrimerApellido = "";
$estudiante_SegundoApellido = "";
$alerta_Comentario = "";
$centroEducativo = "";
$direccionRegional = "";
$profesor_Nombre = "";
$profesor_Apellido1 = "";
$profesor_Apellido2 = "";
$seccion_Cantidad = "";
$seccion_Descripcion = "";
date_default_timezone_set('America/Costa_Rica');		
$reporte_Fecha = date_create('now')->format('Y-m-d H:i:s');

try {

    $db = new select();    
    $rsAlerta = $db->conAlertaTemprana($seccion_Id, $alerta_Fecha);
    $rsParamatros = $db->conParametros();    
    $rsSeccion = $db->conSeccionProfesor($seccion_Id);
    
    if (!empty($rsParamatros)) {            
        foreach ($rsParamatros as $keyParamatros => $valueParamatros) {
                            
            $centroEducativo = $valueParamatros['centroEducativo'];
            $direccionRegional = $valueParamatros['direccionRegional'];           
        }
    }
    
    if (!empty($rsSeccion)) {            
        foreach ($rsSeccion as $keySeccion => $valueSeccion) {
                            
            $profesor_Nombre = $valueSeccion['profesor_Nombre'];
            $profesor_Apellido1 = $valueSeccion['profesor_Apellido1'];
            $profesor_Apellido2 = $valueSeccion['profesor_Apellido2'];
            $seccion_Cantidad = $valueSeccion['seccion_Cantidad'];
            $seccion_Descripcion = $valueSeccion['seccion_Descripcion'];           
        }
    }
                            
    $archivo = 'Alerta-'.date("d/m/Y");
    $extension = '.xls';
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=$archivo$extension");
    header("Pragma: no-cache");
    header("Expires: 0");

} catch (PDOException $e) {		
	echo "Error al conectar con la base de datos: " . $e->getMessage() . "\n";
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="autor" content="Mauricio Bermúdez Vargas" />
<title>Exportar</title>
</head>  
<body>
<center><h2>ALERTA TEMPRANA</h2></center>
<table border="1" align="left" cellpadding="5">
    <tr><td width="50%">Centro Educativo:</td><td><?php echo $centroEducativo; ?></td></tr>
    <tr><td>Profesor guía:</td><td><?php echo $profesor_Nombre. " " . $profesor_Apellido1 . " " . $profesor_Apellido2 ?></td></tr>
    <tr><td>Sección:</td><td align="center"><?php echo str_replace("-", " ", $seccion_Descripcion); ?></td></tr>
    <tr><td>Cantidad de estudiantes:</td><td align="right"><?php echo $seccion_Cantidad;?></td></tr>
    <tr><td>Direción Regional:</td><td align="left"><?php echo $direccionRegional;?></td></tr>
    <tr><td>Mes:</td><td align="center"><?php echo $alerta_Fecha;?></td></tr>
    <tr><td>Fecha reporte:</td><td align="center"><?php echo $reporte_Fecha;?></td></tr>
    <tr><td></td><td></td></tr>
</table> 
<table border="1" align="left" cellpadding="5">
        <tr>         
            <td width="50%">Nombre del estudiante</td>
            <td>Situación detectada</td>
            <td>Comentario</td>
        </tr>    

<?php
    if(!empty($rsAlerta)) {
           
        foreach($rsAlerta as $keyAlerta => $valueAlerta) {
            
            $situacion_Nombre = $valueAlerta['situacion_Nombre'];
            $estudiante_Nombre = $valueAlerta['estudiante_Nombre'];
            $estudiante_PrimerApellido = $valueAlerta['estudiante_PrimerApellido'];
            $estudiante_SegundoApellido = $valueAlerta['estudiante_SegundoApellido'];
            $alerta_Comentario = $valueAlerta['alerta_Comentario'];
?>   
        <tr>
            <td><?php echo $estudiante_Nombre . " " . $estudiante_PrimerApellido. " ". $estudiante_SegundoApellido?></td>
            <td><?php echo $situacion_Nombre?> </td>
            <td><?php echo $alerta_Comentario?> </td>            
        </tr>
<?php
        } 
    }
    $rsAlerta = null;
    $rsParamatros = null;
    $rsSeccion = null;
    $db = null;
?>
</table>
<table align="center" cellpadding="5">
    <tr><td></td><td></td></tr>         
    <tr><td></td><td width="50%">Firma del profesor:</td><td align="center">____________________________</td></tr>
    <tr><td></td><td>Nombre profesor </td><td align="center"><?php echo $profesor_Nombre. " " . $profesor_Apellido1 . " " . $profesor_Apellido2 ?></td></tr>    
</table> 
</body>
</html>