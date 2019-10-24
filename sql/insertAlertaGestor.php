<?php
/**
* Mauricio Bermudez Vargas 22/10/2019 6:00 p.m.
*/
require_once 'insertAlerta.php';
	
try {
    
    $estudiante_Id = $_POST['estudiante'];   
    $situacion_Id = $_POST['situacion'];    
    $alerta_Comentario = $_POST['alerta_Comentario'];
		 
	$db = new insertAlerta();
    $db-> insert($estudiante_Id, $situacion_Id, $alerta_Comentario);
	$db = null;	
} 
catch (Exception $e) {		
	console.log("Error de la aplicación: " + $e->getMessage());
	echo "Error al conectar con la base de datos: " . $e->getMessage() . "\n";
	$db = null;
	exit;
}

?>