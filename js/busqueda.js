
function init(){
	$("#formularioBusqueda").submit(function(){
		realizaBusqueda();
		return false;
	});
}

function realizaBusqueda() {
	$("#formularioBusqueda > :submit").prop('disabled', true);
	$.ajax({
		type: "POST",
		url: "busqueda.php?validate",
		data : $("#formularioBusqueda").serialize(),
	})
	.done(function(info){
		var data = JSON.parse(info);
		if (data.status == 200){
			$('#tablaResultados').empty();
			columns = ["Tipo", 
						"Nombre", 
						"Descripción", 
						"Tiempo Restante",///</br>Puntos Necesarios",
						"Fecha de creación"];
			showTable(columns, $('#tablaResultados'), data.msg);
			$(document).ready(function() 
    		{ 
        		$("#tablaResultados").tablesorter(); 
    		}); 
		}else
			error(data.msg);
	})

	.fail(function(){
		alert("Error al enviar el formulario. Revise su conexión a Internet.");
	})
	.always(function(){
		$("#formularioBusqueda > :submit").prop('disabled', false);
	});

}

/**
 * 
 * @param {String} columns Array de cabeceras de las columnas
 * @param {Object} tableElement Tabla html
 * @param {String} data los datos de la tabla en un Array contiguo
 */
function showTable(columns, tableElement, data){
	
	var content = "<thead>";
	content += "<tr>";
	for (var i=0; i < columns.length; i++){
		content += "<th>" + columns[i] + "</th>";
	}	
	content +='</tr></thead>';
	content += "<tbody><tr>";
	for (var i = 0; i < data.length; i++){
		if (i % columns.length == 0 && i !== 0){
			content +='</tr><tr>';
		}
		content +='<td>' + data[i] + '</td>';		
	}
	content +='</tr></tbody>';
	
	tableElement.append(content);
	
}
