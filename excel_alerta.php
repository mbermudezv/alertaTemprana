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
        foreach ($rsParamatros as $key => $value) {
                            
            $centroEducativo = $value['centroEducativo'];
            $direccionRegional = $value['direccionRegional'];           
        }
    }
    
    if (!empty($rsSeccion)) {            
        foreach ($rsSeccion as $key => $value) {
                            
            $profesor_Nombre = $value['profesor_Nombre'];
            $profesor_Apellido1 = $value['profesor_Apellido1'];
            $profesor_Apellido2 = $value['profesor_Apellido2'];
            $seccion_Cantidad = $value['seccion_Cantidad'];
            $seccion_Descripcion = $value['seccion_Descripcion'];           
        }
    }

    } catch (PDOException $e) {		
        echo "Error al conectar con la base de datos: " . $e->getMessage() . "\n";
        exit;
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
        <tr><td width="50%">Centro Educativo:</td><td><?php echo $centroEducativo ?></td></tr>
        <tr><td>Profesor guía:</td><td><?php echo $profesor_Nombre. " " . $profesor_Apellido1 . " " . $profesor_Apellido2 ?></td></tr>
        <tr><td>Sección:</td><td align="center"><?php echo $seccion_Descripcion?></td></tr>
        <tr><td>Cantidad de estudiantes:</td><td align="right"><?php echo $seccion_Cantidad?></td></tr>
        <tr><td>Direción Regional:</td><td align="left"><?php echo $direccionRegional?></td></tr>
        <tr><td>Mes:</td><td align="center"><?php echo $alerta_Fecha?></td></tr>
        <tr><td>Fecha reporte:</td><td align="center"><?php echo $reporte_Fecha?></td></tr>
    </table> 
<?php

    if(!empty($rsAlerta)) {
           
        foreach($rsAlerta as $key => $valuePago) {
            
            $situacion_Nombre = $value['situacion_Nombre'];
            $estudiante_Nombre = $value['estudiante_Nombre'];
            $estudiante_PrimerApellido = $value['estudiante_PrimerApellido'];
            $estudiante_SegundoApellido = $value['estudiante_SegundoApellido'];
            $alerta_Comentario = $value['alerta_Comentario'];
?>   
    <table border="1" align="left" cellpadding="5">
        <tr>         

        <tr>
            <td width="50%">Nombre del estudiante:</td><td><?php echo $estudiante_Nombre . " " . $estudiante_PrimerApellido. " ". $estudiante_SegundoApellido?></td>
            <td>Situación detectada:</td><td><?php echo $puesto_Nombre ?></td>
        </tr>
        <tr></tr>
        <tr><td>Período de pago:</td><td align="center"><?php echo $periodo_Descripcion?></td></tr>
        <tr><td>Salario:</td><td align="right"><?php echo number_format($trabajador_Salario,2,".",",")?></td></tr>
        <tr><td align="center">Más + </td><td></td></tr>
        <tr><td>Horas extras:</td><td align="right"><?php echo number_format($pago_HoraExtra,2,".",",")?></td></tr>
        <tr><td>Feriados:</td><td align="right"><?php echo number_format($pago_Feriado,2,".",",")?></td></tr>
        <tr><td>Otros:</td><td align="right"><?php echo number_format($pago_OtrosIngresos,2,".",",")?></td></tr>
        <tr><td align="center">Ménos - </td><td></td></tr>
        <tr><td>CCSS 9.34%:</td><td align="right"><?php echo number_format($pago_CCSS,2,".",",")?></td></tr>
        <tr><td>Rebajos:</td><td align="right"><?php echo number_format($pago_Rebajos,2,".",",")?></td></tr>
        <tr><td>Otros:</td><td align="right"><?php echo number_format($pago_OtrosRebajos,2,".",",")?></td></tr>
        <tr><td></td><td></td></tr>
        <tr><td>SALARIO NETO A DEPOSITAR:</td><td align="right"><?php echo $total?></td></tr>                    
    </table>
    <table align="center" cellpadding="5">
        <tr><td></td><td></td></tr>         
        <tr><td width="50%">Firma del trabajador:</td><td align="center">____________________________</td></tr>
        <tr><td>Cédula:</td><td align="center"><?php echo $trabajador_Cedula?></td></tr>
        <tr><td></td><td></td></tr>
        <tr><td>Observaciones:</td><td><?php echo $pago_Comentario?></td></tr>
    </table>
<?php
        } 
    }

    $rsPago = null;       

$db = null;
?>        
</body>
</html>