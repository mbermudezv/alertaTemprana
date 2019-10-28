<?php
/**
* Mauricio Bermudez Vargas 22/10/2019 6:00 p.m.
*/
require_once 'conexion.php';
require_once("sql/select.php");

class insertAlerta {

	private $pdo;
	
	function __construct()
	{
        $pdo = new \PDO(DB_Str, DB_USER, DB_PASS);		
		$this->pdo = $pdo;
	}
    
    public function insert($estudiante_Id, $situacion_Id, $alerta_Comentario){
                        		
        $sql = 'INSERT INTO alerta (estudiante_Id, situacion_Id, alerta_Comentario) 
                VALUES (:estudiante_Id, :situacion_Id, :alerta_Comentario)';
        
        $subject = "";
        $htmlContent = "";
        $headers = "";
        $liceo_Email = "mauriciobermudez@hotmail.com";

        try {
		
		$stmt = $this->pdo->prepare($sql);				
        $this->pdo->beginTransaction(); 			
        $stmt->execute([
            ':estudiante_Id' => $estudiante_Id,
            ':situacion_Id' => $situacion_Id,
            ':alerta_Comentario' => $alerta_Comentario       
            ]);
        $this->pdo->commit();     
        
        $last = $this->pdo->lastInsertId();
        
        //envia notificacion por correo
        $db = new select();
        $rsAlerta = $db->conAlertaEmail($last);
        if (!empty($rsAlerta)) {            
            foreach ($rsAlerta as $key => $value) {
                                
                $situacion_Nombre = $value['situacion_Nombre'];
                $estudiante_Nombre = $value['estudiante_Nombre'];
                $estudiante_PrimerApellido = $value['estudiante_PrimerApellido'];
                $estudiante_SegundoApellido = $value['estudiante_SegundoApellido'];
                $alerta_Comentario = $value['alerta_Comentario'];
    
                $subject = "Alerta Temprana ". $situacion_Nombre;
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=utf-8" . "\r\n";    
                $headers .= 'From: wappcom<mauriciobermudez@wappcom.net>' . "\r\n";                
                $htmlContent = '
                <html>
                <body>
                <center><h2>LICEO LAS ESPERANZAS</h2></center>
                <center><h3>ALERTA TEMPRANA</h3></center>
                <table border="1" align="center" cellpadding="5">';
                $htmlContent .= '<tr><td width="50%">Estudiante:</td><td>'. $estudiante_Nombre. " ". $estudiante_PrimerApellido. " ". $estudiante_SegundoApellido. '</td></tr>';
                $htmlContent .= '<tr><td>Situación:</td><td>'. $situacion_Nombre . '</td></tr>';
                $htmlContent .= '<tr><td>Observaciones:</td><td align="center">'. $alerta_Comentario. '</td></tr>';
                $htmlContent .= 
                '</body>
                </html>';                        
                //mail($liceo_Email,$subject,$htmlContent,$headers);
            }
        }                                    
        $stmt = null;
        $this->pdo = null;
        $rsAlerta = null;
        $db = null;  
        return 0;    
        } catch (\Throwable $th) {
                echo "Error al enviar email: " . $th->getMessage() . "\n";				
            }    
              
    }
} 

?>