<?php

header('Content-Type: text/html; charset=utf-8');

require_once 'conexion.php';

class select {

    function conEstudianteBusqueda($alias){
	
		$pdo = new \PDO(DB_Str, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		
		if ($pdo != null) {
			$consultaSQL = "SELECT * FROM estudiante WHERE estudiante_Nombre like '%$alias%' 
							OR estudiante_PrimerApellido like '%$alias%' OR 
							estudiante_SegundoApellido like '%$alias%' ORDER BY estudiante_Nombre DESC";
			$sql = $pdo->query($consultaSQL);	
			$rs = [];
			while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
					$rs[] = [
						'estudiante_Id' => $row['estudiante_Id'],	                
						'estudiante_Nombre' => $row['estudiante_Nombre'],
						'estudiante_PrimerApellido' => $row['estudiante_PrimerApellido'],
						'estudiante_SegundoApellido' => $row['estudiante_SegundoApellido']	
					];
			}	
			return $rs;
		}
	}

	function conEstudiante($id){
		
		$pdo = new \PDO(DB_Str, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		if ($pdo != null) {		
			$sql = $pdo->query('SELECT * FROM estudiante WHERE estudiante_Id ='.$id.' ');			
			$rs = [];
			while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
					$rs[] = [
						'estudiante_Id' => $row['estudiante_Id'],
						'estudiante_Nombre' => $row['estudiante_Nombre'],	                
						'estudiante_PrimerApellido' => $row['estudiante_PrimerApellido'],						
						'estudiante_SegundoApellido' => $row['estudiante_SegundoApellido']												
					];				
			}
			return $rs;
		}	
		$pdo = null;	    
	}

	function conSituacion(){
		
		$pdo = new \PDO(DB_Str, DB_USER, DB_PASS , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));			
		if ($pdo != null){		
			$sql = $pdo->query('SELECT * FROM situacion');
			$rs = [];
			while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
					$rs[] = [
						'situacion_Id' => $row['situacion_Id'],	                
						'situacion_Nombre' => $row['situacion_Nombre']				
					];	
			}
			return $rs;
		}	
		$pdo = null;
	}
}

?>
