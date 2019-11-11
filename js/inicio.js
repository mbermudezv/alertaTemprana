
function cargaAlerta(seccion_Id , mes) {

  var dir = "alerta.php?alerta=";
  var tmpl = document.getElementsByTagName('template')[0];  
  var colNombre = tmpl.content.querySelector("#ColNombre");
  var ColSituacion = tmpl.content.querySelector("#ColSituacion");

  var div = document.getElementById('contenedor_Template');
  while(div.firstChild){
    div.removeChild(div.firstChild);
  }

  $.getJSON("./sql/selectAlertaGestor.php", { seccion: seccion_Id, mes: mes }).done(function(data)  {             
           
    $.each(data, function(i, item) {
            
            colNombre.setAttribute('href', dir + item.alerta_Id);				
            colNombre.textContent = item.estudiante_Nombre + " " + 
                                    item.estudiante_PrimerApellido  + " " + 
                                    item.estudiante_SegundoApellido;
            ColSituacion.setAttribute('href', dir + item.alerta_Id);
            ColSituacion.textContent = item.situacion_Nombre;
            var clon = tmpl.content.cloneNode(true);
            document.getElementById('mainArea').appendChild(clon);             
       });
              
    }).fail(function(jqXHR, textStatus, error) {			

		console.log("Error de la aplicación: " + error);    			
		$(body).append("Error al cargar audios: " + error);			
	});        
}
