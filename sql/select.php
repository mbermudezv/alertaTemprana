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

	function conParametros(){
		
		$pdo = new \PDO(DB_Str, DB_USER, DB_PASS , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));			
		if ($pdo != null){		
			$sql = $pdo->query('SELECT * FROM parametros');
			$rs = [];
			while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
					$rs[] = [
						'centroEducativo' => $row['centroEducativo'],	                
						'direccionRegional' => $row['direccionRegional']				
					];	
			}
			return $rs;
		}	
		$pdo = null;
	}

	function conAlertaEmail($id){

		$pdo = new \PDO(DB_Str, DB_USER, DB_PASS , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		if ($pdo != null) {		
			$sql = $pdo->query('SELECT situacion_Nombre, estudiante_Nombre, 
			estudiante_PrimerApellido, estudiante_SegundoApellido, alerta_Comentario FROM alerta 
			INNER JOIN situacion 
			ON alerta.situacion_Id = situacion.situacion_Id 
			INNER JOIN estudiante 
			ON alerta.estudiante_Id = estudiante.estudiante_Id WHERE alerta.alerta_Id ='.$id.'');
			$rs = [];
			while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
					$rs[] = [
						'situacion_Nombre' => $row['situacion_Nombre'],	                
						'estudiante_Nombre' => $row['estudiante_Nombre'],
						'estudiante_PrimerApellido' => $row['estudiante_PrimerApellido'],
						'estudiante_SegundoApellido' => $row['estudiante_SegundoApellido'],
						'alerta_Comentario' => $row['alerta_Comentario']						
					];	
			}
			return $rs;
		}	
		$pdo = null;
	}

	function conSeccion(){
		
		$pdo = new \PDO(DB_Str, DB_USER, DB_PASS , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));			
		if ($pdo != null){		
			$sql = $pdo->query('SELECT * FROM seccion');
			$rs = [];
			while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
					$rs[] = [
						'seccion_Id' => $row['seccion_Id'],	                
						'seccion_Descripcion' => $row['seccion_Descripcion']				
					];	
			}
			return $rs;
		}	
		$pdo = null;
	}

	function conSeccionProfesor($Id){
		
		$pdo = new \PDO(DB_Str, DB_USER, DB_PASS , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));			
		if ($pdo != null){		
			$sql = $pdo->query('SELECT * FROM seccion INNER JOIN profesor 
								ON seccion.profesor_Id = profesor.profesor_Id WHERE seccion_Id='. $Id);
			$rs = []; 
			while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
					$rs[] = [
						'seccion_Id' => $row['seccion_Id'],	                
						'seccion_Descripcion' => $row['seccion_Descripcion'],
						'profesor_Nombre' => $row['profesor_Nombre'],
						'profesor_Apellido1' => $row['profesor_Apellido1'],
						'profesor_Apellido2' => $row['profesor_Apellido2'],
						'seccion_Cantidad' => $row['seccion_Cantidad'],
						'seccion_Descripcion' => $row['seccion_Descripcion']				
					];	
			}
			return $rs;
		}	
		$pdo = null;
	}

	function conAlertaTemprana($seccion_Id, $alerta_Fecha){

		$pdo = new \PDO(DB_Str, DB_USER, DB_PASS , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		if ($pdo != null) {		
			$sql = $pdo->query('SELECT alerta_Id, situacion_Nombre, estudiante_Nombre, 
			estudiante_PrimerApellido, estudiante_SegundoApellido, alerta_Comentario FROM alerta 
			INNER JOIN situacion 
			ON alerta.situacion_Id = situacion.situacion_Id 
			INNER JOIN estudiante 
			ON alerta.estudiante_Id = estudiante.estudiante_Id 
			WHERE estudiante.seccion_Id ='.$seccion_Id.' AND Month(alerta_Fecha) = '.$alerta_Fecha.' ');
			$rs = [];
			while ($row = $sql->fetch(\PDO::FETCH_ASSOC)) {
					$rs[] = [						
						'situacion_Nombre' => $row['situacion_Nombre'],	                
						'estudiante_Nombre' => $row['estudiante_Nombre'],
						'estudiante_PrimerApellido' => $row['estudiante_PrimerApellido'],
						'estudiante_SegundoApellido' => $row['estudiante_SegundoApellido'],
						'alerta_Comentario' => $row['alerta_Comentario'],
						'alerta_Id' => $row['alerta_Id']												
					];	
			}
			return $rs;
		}	
		$pdo = null;
	}

}

?>
