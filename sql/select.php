<?php

require_once 'conexion.php';

class select {

    function conEstudianteBusqueda($alias){
	
		$pdo = new \PDO(DB_Str, DB_USER, DB_PASS);
		
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
}

?>
