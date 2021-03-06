<?php
/**
* Mauricio Bermudez Vargas 22/10/2019 6:46 p.m.
*/
require_once 'conexion.php';

class updateAlerta
{
	private $pdo;
	
	function __construct()
	{
        $pdo = new \PDO(DB_Str, DB_USER, DB_PASS);	
		$this->pdo = $pdo;
	}

    public function update($alerta_Id, $situacion_Id, $estudiante_Id, $alerta_Comentario){

        date_default_timezone_set('America/Costa_Rica');		
        $alerta_Fecha = date_create('now')->format('Y-m-d H:i:s');

        $sql = 'UPDATE alerta SET situacion_Id = :situacion_Id, estudiante_Id = :estudiante_Id, 
        alerta_Comentario = :alerta_Comentario, alerta_Fecha = :alerta_Fecha
        WHERE alerta_Id = :alerta_Id';
					
		try {
		
		$stmt = $this->pdo->prepare($sql);
				
		$stmt->execute([
		':alerta_Id' => $alerta_Id,            
        ':situacion_Id' => $situacion_Id,
        ':estudiante_Id' => $estudiante_Id,
        ':alerta_Comentario' => $alerta_Comentario,
        ':alerta_Fecha' => $alerta_Fecha
		]);     
		      				
        $stmt = null;
        $this->pdo = null;

        return 0;

        } catch (Exception $e) {
            echo "Error al conectar con la base de datos: " . $e->getMessage() . "\n";
		exit;				
	}	
	}
}

?>