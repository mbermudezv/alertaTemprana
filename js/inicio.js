
function cargaAlerta(seccion_Id , mes) {

  var dir = "alerta.php?alerta=";

  $( ".Col" ).remove();

  $.getJSON("./sql/selectAlertaGestor.php", { seccion: seccion_Id, mes: mes }).done(function(data)  {             
           
    $.each(data, function(i, linkData) {
          
            var itemNombre = document.getElementById("columnNombre");
            var colNombre = document.createElement('a');
            var createATextNombre = document.createTextNode(linkData.estudiante_Nombre + " " + 
                                                            linkData.estudiante_PrimerApellido  + " " + 
                                                            linkData.estudiante_SegundoApellido);
            
            colNombre.className = "Col";
            colNombre.id = "ColNombre"	;
            colNombre.setAttribute('href', dir + linkData.alerta_Id);				
            colNombre.appendChild(createATextNombre);
            itemNombre.appendChild(colNombre);				
        
            var itemSituacion = document.getElementById("columnSituacion");
            var ColSituacion = document.createElement('a');
            var createATextSituacion = document.createTextNode(linkData.situacion_Nombre);
            ColSituacion.className = "Col";
            ColSituacion.id = "ColSituacion";
            ColSituacion.setAttribute('href', dir + linkData.alerta_Id);
            ColSituacion.appendChild(createATextSituacion);
            itemSituacion.appendChild(ColSituacion);
            
       });
              
    }).fail(function(jqXHR, textStatus, error) {			

		console.log("Error de la aplicación: " + error);    			
		$(body).append("Error al cargar audios: " + error);			
	});        
}
