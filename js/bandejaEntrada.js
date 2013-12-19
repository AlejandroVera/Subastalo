var saco = [];

function mostrarMensaje(identificador) {

	if (saco.indexOf(identificador) == -1) {
		saco.push(identificador);
		if ($("#idM" + identificador).length > 0){
			$("#idM" + identificador).show();
			
		} else {				
				$.post("mostrarMensaje.php", {
				id : identificador.toString()
			}, function(respuesta) {
				var data = JSON.parse(respuesta);
				$("#containerBandeja").find("#" + identificador).removeClass("nuevo");
				$("#" + identificador).append("<div id=\"idM" + identificador + "\" class=\"mostrarClass\"> <div class=\"cuerpoClass\">" + data.cuerpo + "</div><button id=\"idC" + identificador + "\"class=\"redButton\">cerrar</button></div>");
			});		
		}
	} else {
		cerrar(identificador);
	}

}

function cerrar(id) {
	if ($("#idM" + id).length > 0){
		$("#idM" + id).hide();
		var indice = saco.indexOf(id);
		saco.splice(indice, 1);
	}
}
