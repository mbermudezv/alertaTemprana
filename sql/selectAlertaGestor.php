<?php

require_once("select.php");		

try {

	$seccion_Id=$_GET['seccion'];
	$alerta_Mes=$_GET['mes'];

	$db = new select();		
	$rs = $db->conAlertaTemprana($seccion_Id, $alerta_Mes);			
	
	if(!empty($rs)) {
		$rsArray = array();
		$i = 1;
		foreach($rs as $rsAlerta) {
			$rsArray[$i] = $rsAlerta;
            $i++;	
		}
		$rs = null;
		$db = null;
		echo json_encode($rsArray);
	}
	else{
		echo "0";
	}
	
} 
catch (PDOException $e) {		
	$rs = null;
	$db = null;
	echo "Error al conectar con la base de datos: " . $e->getMessage() . "\n";
	exit;
}
?>
