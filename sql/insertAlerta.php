<?php
/**
* Mauricio Bermudez Vargas 22/10/2019 6:00 p.m.
*/
require_once 'conexion.php';

class insertAlerta
{
	private $pdo;
	
	function __construct()
	{
        $pdo = new \PDO(DB_Str, DB_USER, DB_PASS);		
		$this->pdo = $pdo;
	}
    
    public function insert($estudiante_Id, $situacion_Id, $alerta_Comentario){
                        		
        $sql = 'INSERT INTO alerta (estudiante_Id, situacion_Id, alerta_Comentario) 
                VALUES (:estudiante_Id, :situacion_Id, :alerta_Comentario)';
									
		try {
		
		$stmt = $this->pdo->prepare($sql);				
        			
        $stmt->execute([
            ':estudiante_Id' => $estudiante_Id,
            ':situacion_Id' => $situacion_Id,
            ':alerta_Comentario' => $alerta_Comentario       
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