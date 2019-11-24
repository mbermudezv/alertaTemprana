<?php
/**
* Mauricio Bermudez Vargas 22/10/2019 6:00 p.m.
*/
//require_once 'insertAlerta.php';
require_once 'conexion.php';

try {
    
    $estudiante_Id = $_GET['estudiante'];   
    $situacion_Id = $_GET['situacion'];    
	$alerta_Comentario = $_GET['alerta_Comentario'];
	$alerta_Mes = $_GET['alerta_Mes'];	
	
	date_default_timezone_set('America/Costa_Rica');		
	$alerta_Fecha = date_create('now')->format('Y-m-d H:i:s');
	//$db = new insertAlerta();
    //$db-> insert($estudiante_Id, $situacion_Id, $alerta_Comentario);
	//$db = null;

	$pdo = new \PDO(DB_Str, DB_USER, DB_PASS);		
	//$this->pdo = $pdo;
	$sql = 'INSERT INTO alerta (estudiante_Id, situacion_Id, alerta_Comentario, alerta_Fecha, alerta_Mes) VALUES (?,?,?,?,?)';
	$stmt= $pdo->prepare($sql);
	//$stmt= $pdo->beginTransaction();
	$stmt->execute([$estudiante_Id, $situacion_Id, $alerta_Comentario, $alerta_Fecha, $alerta_Mes]);
	$last = $pdo->lastInsertId();
	//$stmt= $pdo->commit();
	
	$stmt = null;
	$pdo = null;

	echo $last; // no se puede convertir lastInsertId() a int o str desde la clase InsertAlerta
} 
catch (Exception $e) {		
	console.log("Error de la aplicación: " + $e->getMessage());
	echo "Error al conectar con la base de datos: " . $e->getMessage() . "\n";
	$db = null;
	exit;
}

?>