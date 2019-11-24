<!-- Mauricio Bermudez Vargas 14/10/2019 04:12 p.m. -->
<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);
ini_set('display_errors', true);

try {
    
require_once("sql/select.php");
           
$situacion_Id = 0;
$alerta_Comentario="";
$estudiante_Nombre="";
$estudiante_PrimerApellido="";
$estudiante_SegundoApellido="";
$estudiante_Descripcion="";
$seccion_Id = 0;
$alerta_Fecha = 0;
$estudiante_Id = 0;
$alerta_Mes = 0; 

$db = new select();
$rsSituacion = $db->conSituacion();

if (isset($_GET['seccion'])) {
    $seccion_Id = $_GET['seccion'];
}

if (isset($_GET['mes'])) {
    $alerta_Mes = $_GET['mes'];
}

if (isset($_GET['alerta'])) {  
    $alerta_Id = $_GET['alerta'];
    $rsAlerta = $db->conAlertaId($alerta_Id);
    if (!empty($rsAlerta)) {            
        foreach ($rsAlerta as $key => $value) {
            $estudiante_Nombre = $value['estudiante_Nombre'];
            $estudiante_PrimerApellido = $value['estudiante_PrimerApellido'];
            $estudiante_SegundoApellido = $value['estudiante_SegundoApellido'];
            $situacion_Id = $value['situacion_Id'];
            $alerta_Comentario = $value['alerta_Comentario'];
            $seccion_Id = $value['seccion_Id'];
            $alerta_Fecha = $value['alerta_Fecha'];
            $estudiante_Id = $value['estudiante_Id'];

        }
        $estudiante_Descripcion = $estudiante_Nombre . " " . $estudiante_PrimerApellido . " " . $estudiante_SegundoApellido;                      
    }            
} else {
    $alerta_Id = 0;    
}

if (isset($_GET['estudiante'])) { 
    $estudiante_Id = $_GET['estudiante'];   
    $rsEstudiante = $db->conEstudiante($estudiante_Id);    
    if (!empty($rsEstudiante)) {            
        foreach ($rsEstudiante as $key => $value) {
            $estudiante_Nombre = $value['estudiante_Nombre'];
            $estudiante_PrimerApellido = $value['estudiante_PrimerApellido'];
            $estudiante_SegundoApellido = $value['estudiante_SegundoApellido'];
        }
        $estudiante_Descripcion = $estudiante_Nombre . " " . $estudiante_PrimerApellido . " " . $estudiante_SegundoApellido;                      
    }            
} 

if ($estudiante_Id==0) {
    $estudiante_Descripcion = "Seleccione el estudiante";
}

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
    <script type="text/javascript" src="jq/jquery-3.2.1.min.js"></script>
    <link rel="manifest" href="manifest.json">
    <link rel="stylesheet" type="text/css" media="screen" href="css/css_alerta.css" />    
</head>
<body>
<div id="menu">
    <a id="salir" href="inicio.php?seccion=<?php echo $seccion_Id; ?>&mes=<?php echo $alerta_Mes; ?>"></a>           
</div>
<div id="mainArea">
    <div id="contenedor_Fila">
        <a id="add" href="busca_Estudiante.php?seccion=<?php echo $seccion_Id; ?>&mes=<?php echo $alerta_Mes; ?>"></a>
    </div>
    <div id="contenedor_Fila">
        <div id="ColNombre"> <?php echo $estudiante_Descripcion; ?> </div>
    </div>
    <div id="contenedor_Fila">
        <select id="cboPuesto" class="txtDescripcion" onchange="getval(this.value);">
            <?php
            foreach($rsSituacion as $cc => $name) {
                echo '<option value="' . $name['situacion_Id'] . '">' . $name['situacion_Nombre'] . '</option>';
            }
            ?>
        </select>
    </div>
    <div id="contenedor_Fila">
        <textarea id="txtComentario" rows="5"><?php echo $alerta_Comentario; ?></textarea>
    </div>
    <div id="contenedor_Fila">
        <div id="guardar" onclick="guardar()"></div>
    </div>
    <!-- <div id="test"> </div> -->
</div>
<div id="statusBar">
    <a id="linkHogar" href="https://www.lasesperanzas.ed.cr">lasesperanzas.ed.cr</a>
    <a id="linkWappcom"href="https://www.wappcom.net">wappcom.net</a>                                       
</div>

<script language='javascript'>

var situacion_Id = <?php echo $situacion_Id;?>;

function getval(sel){             
    //alert(sel);
    situacion_Id = sel;           
}
    
//Cuando carga por primera vez, seleciona el item segun $situacion_Id
if (situacion_Id > 0) {                
    $("#cboPuesto").val(situacion_Id);
}else{
    situacion_Id=1;//Para que por defecto quede seleccionado la primera opcion
}

function guardar() {

    var alerta_Id = <?php echo $alerta_Id; ?>;    
    var estudiante_Id = <?php echo $estudiante_Id; ?>;
    var alerta_Comentario = $('#txtComentario').val();
    var alerta_Mes = <?php echo $alerta_Mes; ?>;    

    if (estudiante_Id == 0) {
        alert("Seleccione el estudiante");
        return;
    }

    $('#guardar').html('<img src="img/cargando.gif">');	
    if (alerta_Id==0)	{
        
        $.get("sql/insertAlertaGestor.php", {estudiante: estudiante_Id, 
                                                situacion: situacion_Id,
                                                alerta_Comentario: alerta_Comentario,
                                                alerta_Mes: alerta_Mes})
        .done(function(data) {         
            //email
            alerta_Id = data;
            //document.getElementById("test").innerHTML += data;
            $.get("email_alerta.php", { alerta: alerta_Id })
            .done(function(dataEmail) {
                //document.getElementById("test").innerHTML += dataEmail;
            }).fail(function(jqXHR, textStatus, error) {			
                console.log("Error de la aplicación: " + error);    			
                $(body).append("Error al conectar con la base de datos: " + error);			
            });
            //email
            $('#guardar').html('<img src="img/guardar.png">');
        })
        .fail(function(jqXHR, textStatus, error) {
            console.log("Error de la aplicación: " + error);    			
            $(body).append("Error al conectar con la base de datos: " + error);			
            });	      
    } else	{
        $.post("sql/updateAlertaGestor.php", {alerta: alerta_Id, 
                                            estudiante: estudiante_Id, 
                                            situacion: situacion_Id,
                                            alerta_Comentario: alerta_Comentario })
        .done(function(data) { $('#guardar').html('<img src="img/guardar.png">');})
        .fail(function(jqXHR, textStatus, error) {
            console.log("Error de la aplicación: " + error);    			
            $(body).append("Error al conectar con la base de datos: " + error);                			
            });			            
        }
}

$('#salir').html('<img src="img/salir.png">');
$('#add').html('<img src="img/add.png">');
$('#guardar').html('<img src="img/guardar.png">');

</script>
</body>
</html>