<!-- Mauricio Bermudez Vargas 14/10/2019 04:12 p.m. -->
<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);
ini_set('display_errors', true);

try {
  
require_once("sql/select.php");

$tipo = $_POST['tipo'];

if ($tipo == 'CARGARALERTAS'){

    $seccion_Id=$_POST['seccion'];
	$alerta_Fecha=$_POST['mes'];

	$db = new select();		
	$rs = $db->conAlertaTemprana($seccion_Id, $alerta_Fecha);			
	
	if(!empty($rs)) {
		$rsArray = array();
        $i = 1;
        echo '<table width="100%">';
		foreach($rs as $rsAlerta) {
			/*$rsArray[$i] = $rsAlerta;
            $i++;*/
            echo '<tr><td style="border-top: 1px dashed #e9e9e9">';
            echo '<a href="javascript: void(0)" onclick="memitoRico()">'.$rsAlerta['estudiante_Nombre'].'</a>';
            echo '</td></tr>';
            echo '<tr><td><i>';
            echo '&deg; ';
            echo $rsAlerta['situacion_Nombre'];
            echo '</i></td></tr>';

        }
        echo '</table>';
		$rs = null;
		$db = null;
		//echo json_encode($rsArray);
	}
	else{
        //echo "0";
        echo 'No se registran alertas.';
	}

}

if ($tipo == 'MEMORICO'){
    echo "Memito riiiico";
}


} catch (PDOException $e) {		
	echo "Error al conectar con la base de datos: " . $e->getMessage() . "\n";
	exit;
}