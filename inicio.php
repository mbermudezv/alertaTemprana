<!-- Mauricio Bermudez Vargas 31/10/2019 10:29 a.m. -->
<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);
ini_set('display_errors', true);
require_once("sql/select.php");

try {
    $db = new select();
    $rsSeccion = $db->conSeccion();

} catch (PDOException $e) {		
	echo "Error al conectar con la base de datos: " . $e->getMessage() . "\n";
	exit;
}
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
    <script type="text/javascript" src="jq/jquery-3.2.1.min.js"></script>
    <script src="js/inicio.js"></script>  
</head>
<body>
<div id="menu">
    <a id="salir" href="https://www.lasesperanzas.ed.cr"></a>
    <a id="hyp_reporte" href="#" onclick='javascript:window.location.replace("excel_alerta.php?seccion=" + seccion_Id + "&mes=" + mes)'></a>
</div>
<div id="mainArea">
    <div id="contenedor_Fila">
        <a id="add" href="alerta.php"></a>
    </div>
    <div id="contenedor_Fila">
        <select id="cboSeccion" class="txtDescripcion" onchange="getvalSeccion(this.value);">
            <?php
            foreach($rsSeccion as $cc => $name) {
                echo '<option value="' . $name['seccion_Id'] . '">' . $name['seccion_Descripcion'] . '</option>';
            }
            ?>
        </select>
    </div>
    <div id="contenedor_Fila">
        <select id="cboMes" class="txtDescripcion" onchange="getvalFecha(this.value);">
        <?php
            foreach($rsSeccion as $cc => $name) {
                echo '<option value="' . "1" . '">' . "Enero" . '</option>';
                echo '<option value="' . "2" . '">' . "Febrero" . '</option>';
                echo '<option value="' . "3" . '">' . "Marzo" . '</option>';
                echo '<option value="' . "4" . '">' . "Abril" . '</option>';
                echo '<option value="' . "5" . '">' . "Mayo" . '</option>';
                echo '<option value="' . "6" . '">' . "Junio" . '</option>';
                echo '<option value="' . "7" . '">' . "Julio" . '</option>';
                echo '<option value="' . "8" . '">' . "Agosto" . '</option>';
                echo '<option value="' . "9" . '">' . "Setiembre" . '</option>';
                echo '<option value="' . "10" . '">' . "Octubre" . '</option>';
                echo '<option value="' . "11" . '">' . "Noviembre" . '</option>';
                echo '<option value="' . "12" . '">' . "Diciembre" . '</option>';
            }
        ?>
        </select>                
    </div>
    <div id="contenedor_Fila">
        <div id="btnbuscar" onclick="cargaAlerta(seccion_Id,mes);"></div>
    </div>
    
    <div id="contenedor_Template">
        <div id="columnNombre">            
            <a id="ColNombre" class="Col"></a>
        </div>
        <div id="columnSituacion">
            <a id="ColSituacion" class="Col"></a>
        </div>    
    </div>

</div>
</body>
<script language='javascript'>
 
var cboSeccion = document.getElementById('cboSeccion');
var cboMes = document.getElementById('cboMes');
var seccion_Id = cboSeccion.options[cboSeccion.selectedIndex].value;
var mes = cboMes.options[cboMes.selectedIndex].value;

cargaAlerta(seccion_Id,mes);

function getvalhref() {                 
    return "excel_alerta.php?seccion=" + seccion_Id + "&mes=" + mes;                
}

function getvalSeccion(sel) {             
        //alert(sel);
        seccion_Id = sel;           
}

function getvalFecha(sel) {             
        //alert(sel);
        mes = sel;           
}

$('#salir').html('<img src="img/salir.png">');
$('#hyp_reporte').html('<img src=img/excel.png>');
$('#add').html('<img src="img/add.png">'); 
$('#btnbuscar').html('<img src="img/refresh.png">');

</script>
</html>