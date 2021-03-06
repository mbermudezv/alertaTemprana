<?php
/**
* Mauricio Bermudez Vargas 22/10/2019 6:00 p.m.
*/
require_once 'conexion.php';

class insertAlerta {

    private $pdo;
    private $last;
    	
	function __construct()
	{
        $pdo = new \PDO(DB_Str, DB_USER, DB_PASS);		
        $this->pdo = $pdo;        
        
    }
        
    public function insert($estudiante_Id, $situacion_Id, $alerta_Comentario, $alerta_Mes){
                        		
        date_default_timezone_set('America/Costa_Rica');		
        $alerta_Fecha = date_create('now')->format('Y-m-d H:i:s');

        $sql = 'INSERT INTO alerta (estudiante_Id, situacion_Id, alerta_Comentario, alerta_Fecha) 
                VALUES (:estudiante_Id, :situacion_Id, :alerta_Comentario, :alerta_Fecha, :alerta_Mes)';
                
        try {
		
		$stmt = $this->pdo->prepare($sql);				
        $this->pdo->beginTransaction(); 			
        $stmt->execute([
            ':estudiante_Id' => $estudiante_Id,
            ':situacion_Id' => $situacion_Id,
            ':alerta_Comentario' => $alerta_Comentario,
            ':alerta_Fecha' => $alerta_Fecha,
            ':alerta_Mes' => $alerta_Mes        
            ]);
        $last = $this->pdo->lastInsertId();        
        $this->pdo->commit();     
                                    
        $stmt = null;
        $this->pdo = null;
                
        return $last; 
        
    } catch (\Throwable $th) {
                echo "Error al enviar email: " . $th->getMessage() . "\n";				
            }    
              
    }
} 

?>