
<?php

header('Content-Type: text/html; charset=utf-8');
require_once("sql/select.php");
require_once 'sql/conexion.php';

$estudiante_Id = 1;
$situacion_Id = 1;
$alerta_Comentario = "Prueba en liceo";


$pdo = new \PDO(DB_Str, DB_USER, DB_PASS);		
$this->pdo = $pdo;
$sql = 'INSERT INTO alerta (estudiante_Id, situacion_Id, alerta_Comentario) VALUES (?,?,?)';
$stmt= $pdo->prepare($sql);
$stmt->execute([$estudiante_Id, $situacion_Id, $alerta_Comentario]);
$last = $this->pdo->lastInsertId();

$subject = "";
$htmlContent = "";
$headers = "";
$liceo_Email = "mauriciobermudez@hotmail.com";

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
         echo  $htmlContent. "\r\n";
     }
 }                                    
 $stmt = null;
 $pdo = null;
 $rsAlerta = null;
 $db = null;  
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Progressive Web Application">
    <meta name="theme-color" content="#499bea" />
    <title>Inicio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="manifest.json">
    <link rel="stylesheet" type="text/css" media="screen" href="css/css_inicio.css" />    
</head>
<body>
</body>
</html>