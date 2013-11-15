var sessionE = null;
var wsuri = "ws://localhost:8080";

function enviarMensaje() {
	//conectamos con el servidor y enviamos el mensaje
	ab.connect(wsuri, function(session) {
		sessionE = session;
		var cuerpo = {
			from : $("#idUsuarioOrigen").val(),
			cuerpo : $("#cuerpoMsg").val()
		};
		sessionE.publish("msg://" + $("#idUsuarioDestino").val(), cuerpo);
		console.log("Connected to " + wsuri);
	}, function(code, reason) {
		sessionE = null;
		console.log("Connection lost (" + reason + ")");
	});
}
