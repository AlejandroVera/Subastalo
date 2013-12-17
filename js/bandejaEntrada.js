$(document).ready(function() {
	$("#bCerrarM").click(function() {
		$("#vizualizador").hide();
	});
});
function mostrarMensaje(identificador){
	$.post("mostrarMensaje.php", {
		id : identificador.toString()
	}, function(respuesta) {
		var data = JSON.parse(respuesta);
		$("#containerBandeja").find("#"+identificador.toString()).removeClass("nuevo");
		$("#"+identificador.toString()).append("<div class=\"mostrarClass\"> <div id=\"asuntoID\" class=\"asuntoClass\">"+data.asunto+"</div><div id=\"cuerpoIDr\" class=\"cuerpoClass\">"+data.cuerpo+"</div><button id=\"cerrarID\" class=\"cerrarClass\">cerrar</button><button id=\"responderID\" class=\"responderClass\">responder</button></div>");
	});
}
