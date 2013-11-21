function init() {
	$("#loginDiv").click(function() {

		window.parent.$("#marco").attr("src", "./login.php");
	});
	$("#logoutDiv").click(function() {

		window.parent.$("#marco").attr("src", "./logout.php");
	});
	$("#altaDiv").click(function() {
		window.parent.$("#marco").attr("src", "./alta.php");
	});

	$("#adminDiv").click(function() {
		window.parent.$("#marco").attr("src", "./admin/index.php");
	});
	
	$(document).ready(function() {
		$("#tablaResultados").tablesorter();
		return false;
	});
}

function realizaBusqueda() {
	$("#tablaResultados").tablesorter();
}



/**
 *
 * @param {String} columns Array de cabeceras de las columnas
 * @param {Object} tableElement Tabla html
 * @param {String} data los datos de la tabla en un Array contiguo
 */
function showTable(columns, tableElement, data) {

	var content = "<thead>";
	content += "<tr>";
	for (var i = 0; i < columns.length; i++) {
		content += "<th>" + columns[i] + "</th>";
	}
	content += '</tr></thead>';
	content += "<tbody><tr>";
	for (var i = 0; i < data.length; i++) {
		if (i % columns.length == 0 && i !== 0) {
			content += '</tr><tr>';
		}
		content += '<td>' + data[i] + '</td>';
	}
	content += '</tr></tbody>';

	tableElement.append(content);

}
