
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
			showTable(5, $('#tablaResultados'), data.msg);
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

function showTable(columns, tableElement, data){
	
	var content = "<tr>";
	content +="<th>Tipo</th>";
	content +="<th>Nombre</th>";
	content +="<th>Descripción</th>";
	content +="<th>Tiempo Restante<br/>/Puntos Necesarios</th>";
	content +="<th>Fecha de creación</th></tr>";	
	content +='<tr>';
	for (var i = 0; i < data.length; i++){
		if (i % columns == 0 && i !== 0){
			content +='</tr><tr>';
		}
		content +='<td>' + data[i] + '</td>';		
	}
	content +='</tr>';
	tableElement.append(content);
}
