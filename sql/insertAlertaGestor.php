<?php
/**
* Mauricio Bermudez Vargas 22/10/2019 6:00 p.m.
*/
require_once 'insertAlerta.php';
require_once 'testClass.php';

try {
    
    $estudiante_Id = $_GET['estudiante'];   
    $situacion_Id = $_GET['situacion'];    
    $alerta_Comentario = $_GET['alerta_Comentario'];
		 
	$db = new insertAlerta();
    $db-> insert($estudiante_Id, $situacion_Id, $alerta_Comentario);
	//$db = null;
	//$myAssociativeArray = json_decode(json_encode($db), true);// Converts the object to an associative array
	echo (int)$db;

							
} 
catch (Exception $e) {		
	console.log("Error de la aplicación: " + $e->getMessage());
	echo "Error al conectar con la base de datos: " . $e->getMessage() . "\n";
	$db = null;
	exit;
}

?>