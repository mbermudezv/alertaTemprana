<?php
/**
* Mauricio Bermudez Vargas 22/10/2019 6:41 p.m.
*/

require_once 'updateAlerta.php';
	
try {

    $alerta_Id = $_POST['alerta'];
    $situacion_Id = $_POST['situacion'];
    $estudiante_Id = $_POST['estudiante'];
	$alerta_Comentario = $_POST['alerta_Comentario'];
	$alerta_Mes = $_POST['alerta_Mes'];
    
 	$db = new updateAlerta();
 	$db-> update($alerta_Id, $situacion_Id, $estudiante_Id, $alerta_Comentario, $alerta_Mes);
     $db = null;   

} 
catch (Exception $e) {		
	console.log("Error de la aplicación: " + $e->getMessage());
	echo "Error al conectar con la base de datos: " . $e->getMessage() . "\n";
	$db = null;
	exit;
}

?>