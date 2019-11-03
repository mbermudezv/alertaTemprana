<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);

require_once("sql/select.php");

$trabajador_Cedula="";
$trabajador_Nombre="";
$trabajador_PrimerApellido="";
$trabajador_SegundoApellido="";
$trabajador_Salario=0;
$puesto_Nombre ="";
$periodo_Id=0;
$periodo_Descripcion = "";
$pago_HoraExtra=0;
$pago_Feriado=0;
$pago_OtrosIngresos=0;
$pago_CCSS=0;
$pago_Rebajos=0;
$pago_OtrosRebajos=0;
$pago_Comentario="";
$total=0;

try {

    $db = new select();
    $periodo_Id = $_GET['periodo'];    
    $pago_Id  = json_decode($_GET['pago']);    
    $rsPeriodo = $db->conPeriodo($periodo_Id);
    
    if (!empty($rsPeriodo)) {            
        foreach ($rsPeriodo as $key => $value) {
            $periodo_Descripcion = $value['periodo_Descripcion'];
        }                  
    }
                           
    $rsPeriodo = null;       
    $archivo = 'Comprobante-'.date("d/m/Y");
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
<?php

$count = count($pago_Id);
for ($i = 0; $i < $count; $i++) {
    
    $rsPago = $db->conPagoPeriodoEmail($periodo_Id, $pago_Id[$i]);

    if(!empty($rsPago)) {
           
        foreach($rsPago as $key => $valuePago) {
            
            $trabajador_Cedula = $valuePago['trabajador_Cedula'];
            $trabajador_Nombre = $valuePago['trabajador_Nombre'];
            $trabajador_PrimerApellido = $valuePago['trabajador_PrimerApellido'];
            $trabajador_SegundoApellido = $valuePago['trabajador_SegundoApellido'];
            $trabajador_Salario = $valuePago['trabajador_Salario'];            
            $puesto_Nombre = $valuePago['puesto_Nombre'];
            $pago_HoraExtra = $valuePago['pago_HoraExtra'];
            $pago_Feriado =$valuePago['pago_Feriado'];
            $pago_OtrosIngresos = $valuePago['pago_OtrosIngresos'];
            $pago_CCSS = $valuePago['pago_CCSS'];
            $pago_Rebajos = $valuePago['pago_Rebajos'];
            $pago_OtrosRebajos = $valuePago['pago_OtrosRebajos'];
            $pago_Comentario = $valuePago['pago_Comentario'];                
            $subtotalIngresos = $trabajador_Salario + $pago_HoraExtra + $pago_Feriado + $pago_OtrosIngresos;
            $subtotalRebajos = $pago_CCSS + $pago_Rebajos + $pago_OtrosRebajos;                
            $total= number_format(($subtotalIngresos - $subtotalRebajos),2,".",","); 
    ?>
    <center><h2>COMPROBANTE DE PAGO ASOCIACIÓN HOGAR BETANIA</h2></center>
    <center><h3>ORIGINAL TRABAJADOR</h3></center>
    <center><p>Daniel Flores, Pérez Zeledón</p></center>
    <center><p>Telefónos: 27726441 - 27713469</p></center>
    <table border="1" align="center" cellpadding="5">
        <tr><td width="50%">Nombre trabajador:</td><td><?php echo $trabajador_Nombre . " " . $trabajador_PrimerApellido. " ". $trabajador_SegundoApellido?></td></tr>
        <tr><td>Puesto:</td><td><?php echo $puesto_Nombre ?></td></tr>
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
}
$db = null;
?>        
</body>
</html>