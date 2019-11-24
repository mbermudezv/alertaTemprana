
function cargaAlerta(seccion_Id , alerta_Mes) {

  var dir = "alerta.php?alerta=";  
  $('#btnbuscar').html('<img src="img/cargando.gif">');
  $('.tabla').remove();

  $.getJSON("./sql/selectAlertaGestor.php", { seccion: seccion_Id, mes: alerta_Mes }).done(function(data)  {             
    
    $.each(data, function(i, linkData) {            

      var tabla = document.createElement('div');
      tabla.className = "tabla";
      
      var Col1 = document.createElement('div');
      Col1.id = "Col1";
      Col1.className = "Col";

      var colNombre = document.createElement('a');
      colNombre.id = "ColNombre";
      colNombre.className = "CellStyle";
      var createATextNombre = document.createTextNode(linkData.estudiante_Nombre + " " + 
                                                      linkData.estudiante_PrimerApellido  + " " + 
                                                      linkData.estudiante_SegundoApellido);
                                                            
      colNombre.appendChild(createATextNombre);
      colNombre.setAttribute('href', dir + linkData.alerta_Id);
          
      Col1.appendChild(colNombre);
      tabla.appendChild(Col1);

      document.getElementById('mainArea').appendChild(tabla);

      var Col2 = document.createElement('div');
      Col2.id = "Col2";
      Col2.className = "Col";
      var ColSituacion = document.createElement('a');
      var createATextSituacion = document.createTextNode(linkData.situacion_Nombre);
      ColSituacion.className = "CellStyle";
      ColSituacion.id = "ColSituacion";
      ColSituacion.setAttribute('href', dir + linkData.alerta_Id);
      ColSituacion.appendChild(createATextSituacion);
    
      Col2.appendChild(ColSituacion);
      tabla.appendChild(Col2);

       });
       $('#cboSeccion').val(seccion_Id);
       $('#cboMes').val(alerta_Mes);
       $('#btnbuscar').html('<img src="img/refresh.png">');       
    }).fail(function(jqXHR, textStatus, error) {			

		console.log("Error de la aplicación: " + error);    			
		$(body).append("Error al cargar audios: " + error);			
	});        
}
