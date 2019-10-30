<?php
/**
* Mauricio Bermudez Vargas 22/10/2019 6:00 p.m.
*/
require_once 'insertAlerta.php';
require_once 'select.php';

try {
    
    $estudiante_Id = $_POST['estudiante'];   
    $situacion_Id = $_POST['situacion'];    
    $alerta_Comentario = $_POST['alerta_Comentario'];
		 
	$dbId = new insertAlerta();
    $dbId-> insert($estudiante_Id, $situacion_Id, $alerta_Comentario);
	//$db = null;	
	$subject = "";
	$htmlContent = "";
	$headers = "";
	$liceo_Email = "mauriciobermudez@hotmail.com";
		
	//envia notificacion por correo
	$db = new select();
	$rsAlerta = $db->conAlertaEmail($dbId);
	if (!empty($rsAlerta)) {            
		foreach ($rsAlerta as $key => $value) {
							
			$situacion_Nombre = $value['situacion_Nombre'];
			$estudiante_Nombre = $value['estudiante_Nombre'];
			$estudiante_PrimerApellido = $value['estudiante_PrimerApellido'];
			$estudiante_SegundoApellido = $value['estudiante_SegundoApellido'];
			$alerta_Comentario = $value['alerta_Comentario'];

			$subject = "Alerta Temprana ". $situacion_Nombre;
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=utf-8" . "\r\n";    
			$headers .= 'From: wappcom<mauriciobermudez@wappcom.net>' . "\r\n";                
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
			mail($liceo_Email,$subject,$htmlContent,$headers);
		}
	}
	$rsAlerta = null;
    $db = null;                                     
	
} 
catch (Exception $e) {		
	console.log("Error de la aplicación: " + $e->getMessage());
	echo "Error al conectar con la base de datos: " . $e->getMessage() . "\n";
	$db = null;
	exit;
}

?>