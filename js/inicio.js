
function cargaAlerta(seccion_Id , mes) {

  var dir = "alerta.php?alerta=";

  $( ".trAlerta" ).remove();

  $.getJSON("./sql/selectAlertaGestor.php", { seccion: seccion_Id, mes: mes }).done(function(data)  {             
    
    var table = document.getElementsByTagName("table")[0];
    
    $.each(data, function(i, linkData) {
          
            // var itemNombre = document.getElementById("columnNombre");
            // var colNombre = document.createElement('a');
            // var createATextNombre = document.createTextNode(linkData.estudiante_Nombre + " " + 
            //                                                 linkData.estudiante_PrimerApellido  + " " + 
            //                                                 linkData.estudiante_SegundoApellido);
            
            // colNombre.className = "Col";
            // colNombre.id = "ColNombre"	;
            // colNombre.setAttribute('href', dir + linkData.alerta_Id);				
            // colNombre.appendChild(createATextNombre);
            // itemNombre.appendChild(colNombre);				
        
            // var itemSituacion = document.getElementById("columnSituacion");
            // var ColSituacion = document.createElement('a');
            // var createATextSituacion = document.createTextNode(linkData.situacion_Nombre);
            // ColSituacion.className = "Col";
            // ColSituacion.id = "ColSituacion";
            // ColSituacion.setAttribute('href', dir + linkData.alerta_Id);
            // ColSituacion.appendChild(createATextSituacion);
            // itemSituacion.appendChild(ColSituacion);
            
            var tr = document.createElement('tr');
            tr.id = "contenedor_Fila";
            tr.className = "trAlerta";
            tr.innerHTML = '<td id="columnNombre">' + '<a id="ColNombre" class="Col" href="' + 
                                                            dir + linkData.alerta_Id + '">' + 
                                                            linkData.estudiante_Nombre + " " + 
                                                            linkData.estudiante_PrimerApellido  + " " + 
                                                            linkData.estudiante_SegundoApellido + 
                                      '</a>' + '</td>' +
                                      '<td id="columnSituacion">' + '<a id="ColSituacion" class="Col" href="' + 
                                                          dir + linkData.alerta_Id + '">' + linkData.situacion_Nombre + 
                                      '</a>' + '</td>';
            table.appendChild(tr);
       });
              
    }).fail(function(jqXHR, textStatus, error) {			

		console.log("Error de la aplicación: " + error);    			
		$(body).append("Error al cargar audios: " + error);			
	});        
}
