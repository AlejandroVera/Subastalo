var wsuri = "ws://localhost:8080";

$(document).ready(function() {
	$("#buttonMsg").click(function() {

		$("#popupMsg").show();
		$("#sombra").show();
	});

	$("#buttonEnv").click(function() {
		$.post("enviarMensaje.php", {
			idFrom : USUARIO_LOGUEADO,
			idTo : getParameterByName("id_perfil"),
			asunto: $("#asuntoMsg").val(),
			cuerpo: $("#cuerpoMsg").val()
		}, function(respuesta) {
			$("#popupMsg").hide();
			enviarMensaje(USUARIO_LOGUEADO, getParameterByName("id_perfil"));
			message("El mensaje ha sido enviado correctamente");
		});

	});
	$("#buttonCan").click(function() {
		$("#popupMsg").hide();
		$("#sombra").hide();
	});
	$("#historial").tablesorter();
});


function enviarMensaje(origen, destino) {
	//conectamos con el servidor y enviamos el mensaje
	ab.connect(wsuri, function(session) {
		sessionE = session;
		var cuerpo = {
			from : origen,
			asunto: $("#asuntoMsg").val(),
			cuerpo : $("#cuerpoMsg").val()
		};
		sessionE.publish("msg:" + destino, cuerpo);
		console.log("Connected to " + wsuri);
	}, function(code, reason) {
		sessionE = null;
		console.log("Connection lost (" + reason + ")");
	});
}

function getParameterByName(name) {
	name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
	var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"), results = regex.exec(location.search);
	return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

