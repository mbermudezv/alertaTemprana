<?php

error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);

require_once("sql/select.php");

$subject = "";
$htmlContent = "";
$headers = "";
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

    $db = new Select();
    $periodo_Id = $_GET['periodo'];
    $pago_Id = $_GET['pago'];   

    $rsPeriodo = $db->conPeriodo($periodo_Id);
    
    if (!empty($rsPeriodo)) {            
        foreach ($rsPeriodo as $key => $value) {
            $periodo_Descripcion = $value['periodo_Descripcion'];
        }                  
    }
                
    $rsPago = $db->conPagoPeriodoEmail($periodo_Id, $pago_Id);       
    
    $rsPeriodo = null;       


} catch (PDOException $e) {		
	echo "Error al conectar con la base de datos: " . $e->getMessage() . "\n";
	exit;
}

if(!empty($rsPago)) {

    $subject = "Comprobante de Pago ". $periodo_Descripcion;
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=utf-8" . "\r\n";    
    $headers .= 'From: HogarBetania<info@hogarbetaniapz.org>' . "\r\n";
    
    foreach($rsPago as $key => $valuePago) {
        
        $trabajador_Cedula = $valuePago['trabajador_Cedula'];
        $trabajador_Nombre = $valuePago['trabajador_Nombre'];
        $trabajador_PrimerApellido = $valuePago['trabajador_PrimerApellido'];
        $trabajador_SegundoApellido = $valuePago['trabajador_SegundoApellido'];
        $trabajador_Salario = $valuePago['trabajador_Salario'];
        $trabajador_Email = $valuePago['trabajador_Email'];
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
        
        $htmlContent = '
        <html>
        <body>
        <center><h2>COMPROBANTE DE PAGO ASOCIACIÓN HOGAR BETANIA</h2></center>
        <center><h3>ORIGINAL TRABAJADOR</h3></center>
        <center><p>Daniel Flores, Pérez Zeledón</p></center>
        <center><p>Telefónos: 27726441 - 27713469</p></center>
        <table border="1" align="center" cellpadding="5">';
        $htmlContent .= '<tr><td width="50%">Nombre trabajador:</td><td>'. $trabajador_Nombre. " ". $trabajador_PrimerApellido. " ". $trabajador_SegundoApellido. '</td></tr>';
        $htmlContent .= '<tr><td>Puesto:</td><td>'. $puesto_Nombre . '</td></tr>';
        $htmlContent .= '<tr><td>Período de pago:</td><td align="center">'. $periodo_Descripcion. '</td></tr>';
        $htmlContent .= '<tr><td>Salario:</td><td align="right">'. number_format($trabajador_Salario,2,".",","). '</td></tr>';
        $htmlContent .= '<tr><td align="center">Más + </td><td></td></tr>';
        $htmlContent .= '<tr><td>Horas extras:</td><td align="right">'. number_format($pago_HoraExtra,2,".",","). '</td></tr>';
        $htmlContent .= '<tr><td>Feriados:</td><td align="right">'. number_format($pago_Feriado,2,".",","). '</td></tr>';
        $htmlContent .= '<tr><td>Otros:</td><td align="right">'. number_format($pago_OtrosIngresos,2,".",","). '</td></tr>';
        $htmlContent .= '<tr><td align="center">Ménos - </td><td></td></tr>';
        $htmlContent .= '<tr><td>CCSS 9.34%:</td><td align="right">'. number_format($pago_CCSS,2,".",","). '</td></tr>';
        $htmlContent .= '<tr><td>Rebajos:</td><td align="right">'. number_format($pago_Rebajos,2,".",","). '</td></tr>';
        $htmlContent .= '<tr><td>Otros:</td><td align="right">'. number_format($pago_OtrosRebajos,2,".",","). '</td></tr>';
        $htmlContent .= '<tr><td></td><td></td></tr>';
        $htmlContent .= '<tr><td>SALARIO NETO A DEPOSITAR:</td><td align="right">'.$total. '</td></tr>';                       
        $htmlContent .= '
        </table>
        <table align="center" cellpadding="5">
            <tr><td></td><td></td></tr>          
            <tr><td width="50%">Firma del trabajador:</td><td align="center">____________________________</td></tr>
            <tr><td>Cédula:</td><td align="center">'.$trabajador_Cedula.'</td></tr>
            <tr><td></td><td></td></tr>
            <tr><td>Observaciones:</td><td>'.$pago_Comentario.'</td></tr>
        </table>
        </body>
        </html>';
                
        try {

            mail($trabajador_Email,$subject,$htmlContent,$headers);
        
        } catch (\Throwable $th) {
            echo "Error al enviar email: " . $th->getMessage() . "\n";				
        }                        
    } 
}
$rsPago = null;
$db = null;

//  echo  $htmlContent. "\r\n";


?>