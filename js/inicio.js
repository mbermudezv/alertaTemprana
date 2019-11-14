
function cargaAlerta(seccion_Id , mes) {

  var dir = "alerta.php?alerta=";

  //$(".trAlerta").remove();
  //$(".Col").remove();
  //$("#columnNombre").remove();

    //$("#fila").remove(); 
    //var element = document.getElementById("fila");
    //element.parentNode.removeChild(element);

    // if ( $("#fila").length) {
 
    //   $("#fila").remove();
   
    // }

    if(document.querySelectorAll("#fila").length){
      alert("si");
      var element = document.getElementById("fila");
      element.style.display = 'none';
    }

  $.getJSON("./sql/selectAlertaGestor.php", { seccion: seccion_Id, mes: mes }).done(function(data)  {             
    
    //var table = document.getElementsByTagName("table")[0];
    
    $.each(data, function(i, linkData) {
          
            var tabla = document.getElementById("tabla");
            
            var filaNombre = document.createElement('div');
            filaNombre.id = "fila";
            //filaNombre.className = "trAlerta";
            var Col1Nombre = document.createElement('div');
            Col1Nombre.id = "Col1";

            var colNombre = document.createElement('a');
            var createATextNombre = document.createTextNode(linkData.estudiante_Nombre + " " + 
                                                            linkData.estudiante_PrimerApellido  + " " + 
                                                            linkData.estudiante_SegundoApellido);
            
            //colNombre.className = "Col";
            colNombre.id = "ColNombre"	;
            colNombre.setAttribute('href', dir + linkData.alerta_Id);				
            colNombre.appendChild(createATextNombre);
            
            Col1Nombre.appendChild(colNombre);

            filaNombre.appendChild(Col1Nombre);				
      
            //var itemSituacion = document.getElementById("columnSituacion");
            var filaSituacion = document.createElement('div');
            filaSituacion.id = "fila";

            var Col1Situacion = document.createElement('div');
            Col1Situacion.id = "Col1";

            var ColSituacion = document.createElement('a');
            var createATextSituacion = document.createTextNode(linkData.situacion_Nombre);
            //ColSituacion.className = "Col";
            ColSituacion.id = "ColSituacion";
            ColSituacion.setAttribute('href', dir + linkData.alerta_Id);
            ColSituacion.appendChild(createATextSituacion);
            Col1Situacion.appendChild(ColSituacion);
            filaSituacion.appendChild(Col1Situacion);

            tabla.appendChild(filaNombre);
            tabla.appendChild(filaSituacion);
            
            // var tr = document.createElement('tr');
            // tr.id = "contenedor_Fila";
            // tr.className = "trAlerta";
            // tr.innerHTML = '<td id="columnNombre">' + '<a id="ColNombre" class="Col" href="' + 
            //                                                 dir + linkData.alerta_Id + '">' + 
            //                                                 linkData.estudiante_Nombre + " " + 
            //                                                 linkData.estudiante_PrimerApellido  + " " + 
            //                                                 linkData.estudiante_SegundoApellido + 
            //                           '</a>' + '</td>' +
            //                           '<td id="columnSituacion">' + '<a id="ColSituacion" class="Col" href="' + 
            //                                               dir + linkData.alerta_Id + '">' + linkData.situacion_Nombre + 
            //                           '</a>' + '</td>';
            // table.appendChild(tr);
       });
              
    }).fail(function(jqXHR, textStatus, error) {			

		console.log("Error de la aplicación: " + error);    			
		$(body).append("Error al cargar audios: " + error);			
	});        
}
