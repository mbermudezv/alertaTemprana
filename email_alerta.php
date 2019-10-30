<?php

error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);

require_once("sql/select.php");

$alerta_Id = $_GET['alerta'];
$subject = "";
$htmlContent = "";
$headers = "";
$situacion_Nombre = "";
$estudiante_Nombre = "";
$estudiante_PrimerApellido = "";
$estudiante_SegundoApellido = "";
$alerta_Comentario = "";
$liceo_Email = "mauriciobermudez@hotmail.com";

try {

$db = new select();
$rsAlerta = $db->conAlertaEmail($alerta_Id);
    
if (!empty($rsAlerta)) {            
    foreach ($rsAlerta as $key => $value) {
                        
        $situacion_Nombre = $value['situacion_Nombre'];
        $estudiante_Nombre = $value['estudiante_Nombre'];
        $estudiante_PrimerApellido = $value['estudiante_PrimerApellido'];
        $estudiante_SegundoApellido = $value['estudiante_SegundoApellido'];
        $alerta_Comentario = $value['alerta_Comentario'];
    }
}
	
} catch (PDOException $e) {		
	echo "Error al conectar con la base de datos: " . $e->getMessage() . "\n";
	exit;
}

if(!empty($rsAlerta)) {

    $subject = "Alerta Temprana ". $situacion_Nombre;
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=utf-8" . "\r\n";    
    $headers .= 'From: wappcom<mauriciobermudez@wappcom.net>' . "\r\n";                

    foreach($rsAlerta as $key => $value) {
        
        $situacion_Nombre = $value['situacion_Nombre'];
        $estudiante_Nombre = $value['estudiante_Nombre'];
        $estudiante_PrimerApellido = $value['estudiante_PrimerApellido'];
        $estudiante_SegundoApellido = $value['estudiante_SegundoApellido'];
        $alerta_Comentario = $value['alerta_Comentario'];

        $htmlContent = '
        <html>
        <body>
        <center><h2>LICEO LAS ESPERANZAS</h2></center>
        <center><h3>ALERTA TEMPRANA</h3></center>
        <table border="1" align="center" cellpadding="5">';
        $htmlContent .= '<tr><td width="50%">Estudiante:</td><td>'. $estudiante_Nombre. " ". $estudiante_PrimerApellido. " ". $estudiante_SegundoApellido. '</td></tr>';
        $htmlContent .= '<tr><td>Situación:</td><td>'. $situacion_Nombre . '</td></tr>';
        $htmlContent .= '<tr><td>Observaciones:</td><td align="center">'. $alerta_Comentario. '</td></tr>';
        $htmlContent .= 
        '</body>
        </html>';                        
        

        try {

            //mail($liceo_Email,$subject,$htmlContent,$headers);
        
        } catch (\Throwable $th) {
            echo "Error al enviar email: " . $th->getMessage() . "\n";				
        }                        
    } 
}
$rsAlerta = null;
$db = null;     

echo  $htmlContent. "\r\n";

?>