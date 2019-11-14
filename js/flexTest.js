function tablaDatos() {

    for (let index = 0; index < 5; index++) {
        

        var dir = "alerta.php?alerta=";

        var cellLinkNombreText = document.createTextNode("Mauricio Bermúdez Vargas");
        var cellLinkSituacionText = document.createTextNode("Notas bajas y ausentismo");

/*         var tabla = document.getElementById('tabla');
        var Col1 = document.createElement('div');
        var Col2 = document.createElement('div');

        var cellLinkNombre = document.createElement('a');        
        var cellLinkSituacion = document.createElement('a');

        Col1.id = "Col1";
        Col2.id = "Col2";
        cellLinkNombre.id = "cellLinkNombre";
        cellLinkSituacion.id = "cellLinkSituacion";
        
        cellLinkNombre.appendChild(cellLinkNombreText);
        cellLinkNombre.setAttribute('href', dir + "37");

        Col1.appendChild(cellLinkNombre);

        tabla.appendChild(Col1);

        //Situacion

        cellLinkSituacion.appendChild(cellLinkSituacionText);
        cellLinkSituacion.setAttribute('href', dir + "37");

        Col2.appendChild(cellLinkSituacion);        

        tabla.appendChild(Col2);        
 */
    var tabla = document.getElementById('parent5');

    var Col1 = document.createElement('div');
    var Col2 = document.createElement('div');    
    Col1.className = "left";
    Col2.className = "right";

    var cellLinkNombre = document.createElement('a');        
    var cellLinkSituacion = document.createElement('a');
    cellLinkNombre.appendChild(cellLinkNombreText);
    cellLinkNombre.setAttribute('href', dir + "37");
    cellLinkSituacion.appendChild(cellLinkSituacionText);
    cellLinkSituacion.setAttribute('href', dir + "37");
    Col1.appendChild(cellLinkNombre);
    Col2.appendChild(cellLinkSituacion);
    tabla.appendChild(Col1);
    tabla.appendChild(Col2);
    }

}